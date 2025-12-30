<?php
/**
 * Get Ultimate Member users with birthdays in a given month.
 *
 * @param int|null    $month    Month number 1–12. Defaults to current month.
 * @param string|null $meta_key Meta key of the UM birthday field.
 *
 * @return array[] Each item: [
 *   'user'           => WP_User,
 *   'raw_date'       => string,
 *   'formatted_date' => string,
 *   'profile_url'    => string,
 * ]
 */
function evx_get_um_birthdays_by_month( $month = null, $meta_key = null ) {

    if ( $month === null ) {
        $month = (int) date( 'm' );
    }

    if ( $meta_key === null ) {
        $meta_key = 'birth_date';
    }

    // Fetch all users who have the field set
    $users = get_users( array(
        'number'     => -1,
        'meta_key'   => $meta_key,
        'orderby'    => 'display_name',
        'order'      => 'ASC',
        'fields'     => 'all',
    ) );

    $results = array();

    foreach ( $users as $user ) {

        $raw_date = get_user_meta( $user->ID, $meta_key, true );

        if ( ! $raw_date ) {
            continue;
        }

        /**
         * strtotime() is tolerant:
         * - "1999-04-23"  (ISO)
         * - "23-04-1999"  (Dutch)
         * - "23/04/1999"
         */
        $timestamp = strtotime( str_replace('/', '-', $raw_date ) );

        if ( ! $timestamp ) {
            continue; // skip invalid dates
        }

        $stored_month = (int) date( 'm', $timestamp );

        if ( $stored_month !== (int) $month ) {
            continue;
        }

        // Output formatted date in a nice localized format
        $formatted_date = date_i18n( 'j F', $timestamp );

        if ( function_exists( 'um_user_profile_url' ) ) {
            $profile_url = um_user_profile_url( $user->ID );
        } else {
            $profile_url = get_author_posts_url( $user->ID );
        }

        $results[] = array(
            'user'           => $user,
            'raw_date'       => $raw_date,
            'formatted_date' => $formatted_date,
            'profile_url'    => $profile_url,
        );
    }

    return $results;
}
