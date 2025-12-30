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

    // Set defaults
    if ( $month === null ) {
        $month = (int) date( 'm' );
    }
    $month = max( 1, min( 12, (int) $month ) ); // clamp 1–12
    $month_str = str_pad( (string) $month, 2, '0', STR_PAD_LEFT );

    // Change this to your actual UM birthday field meta key
    if ( $meta_key === null ) {
        $meta_key = 'birth_date'; // e.g. 'date_of_birth', 'dob', etc.
    }

    // Query all users whose birthday meta contains "-MM-"
    $users = get_users( array(
        'number'     => -1,
        'meta_query' => array(
            array(
                'key'     => $meta_key,
                'value'   => '-' . $month_str . '-',
                'compare' => 'LIKE',
            ),
        ),
        'orderby' => 'display_name',
        'order'   => 'ASC',
        'fields'  => 'all',
    ) );

    if ( empty( $users ) ) {
        return array();
    }

    $results = array();

    foreach ( $users as $user ) {
        $raw_date = get_user_meta( $user->ID, $meta_key, true );

        // Try to format nicely (assumes YYYY-MM-DD)
        $formatted_date = '';
        if ( $raw_date ) {
            $timestamp = strtotime( $raw_date );
            if ( $timestamp ) {
                $formatted_date = date_i18n( 'j F', $timestamp ); // e.g. 23 April
            } else {
                $formatted_date = $raw_date;
            }
        }

        // UM profile URL (fallback to author page)
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
