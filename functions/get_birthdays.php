<?php
/**
 * Get Ultimate Member users with birthdays in a given month, sorted by day.
 *
 * @param int|null    $month    Month number 1–12. Defaults to current month.
 * @param string|null $meta_key Meta key of the UM birthday field.
 *
 * @return array[] Each item: [
 *   'user'           => WP_User,
 *   'raw_date'       => string,
 *   'formatted_date' => string,
 *   'profile_url'    => string,
 *   'timestamp'      => int,
 *   'day'            => int,
 * ]
 */
function evx_get_um_birthdays_by_month( $month = null, $meta_key = null ) {

    if ( $month === null ) {
        $month = (int) wp_date( 'm' ); // WP timezone-aware
    }
    $month = (int) $month;

    if ( $meta_key === null ) {
        $meta_key = 'birth_date';
    }

    // Fetch all users who have the field set (ordering here doesn't matter; we sort later)
    $users = get_users( array(
        'number'   => -1,
        'fields'   => 'all',
        'meta_key' => $meta_key,
    ) );

    $results = array();

    // Helper: parse a date string safely
    $parse_date = function( $raw ) {
        $raw = trim( (string) $raw );
        if ( $raw === '' ) return 0;

        // normalize separators
        $norm = str_replace( array('.', '/', ' '), '-', $raw );

        // Try explicit formats first (avoids strtotime ambiguity)
        $formats = array(
            'Y-m-d',
            'd-m-Y',
            'd-m-y',
            'Y-m-d H:i:s',
            'd-m-Y H:i:s',
        );

        foreach ( $formats as $fmt ) {
            $dt = DateTime::createFromFormat( $fmt, $norm );
            if ( $dt instanceof DateTime ) {
                $errors = DateTime::getLastErrors();
                if ( empty($errors['warning_count']) && empty($errors['error_count']) ) {
                    return $dt->getTimestamp();
                }
            }
        }

        // Fallback: tolerant parse
        $ts = strtotime( $norm );
        return $ts ? $ts : 0;
    };

    foreach ( $users as $user ) {
        $raw_date = get_user_meta( $user->ID, $meta_key, true );
        if ( ! $raw_date ) continue;

        $timestamp = $parse_date( $raw_date );
        if ( ! $timestamp ) continue;

        $stored_month = (int) wp_date( 'm', $timestamp );
        if ( $stored_month !== $month ) continue;

        $day = (int) wp_date( 'd', $timestamp );

        $formatted_date = wp_date( 'j F', $timestamp );

        $profile_url = function_exists( 'um_user_profile_url' )
            ? um_user_profile_url( $user->ID )
            : get_author_posts_url( $user->ID );

        $results[] = array(
            'user'           => $user,
            'raw_date'       => $raw_date,
            'formatted_date' => $formatted_date,
            'profile_url'    => $profile_url,
            'timestamp'      => $timestamp,
            'day'            => $day,
        );
    }

    // Sort by day-of-month, then display name
    usort( $results, function( $a, $b ) {
        if ( $a['day'] === $b['day'] ) {
            return strcasecmp( $a['user']->display_name, $b['user']->display_name );
        }
        return $a['day'] <=> $b['day'];
    } );

    return $results;
}