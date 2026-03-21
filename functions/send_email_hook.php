<?php
/**
 * Notify UM users (with a specific checkbox ticked) when a page is updated.
 * Place in: child-theme/functions.php
 */

add_action( 'acf/save_post', 'notify_users_on_page_update', 20 );

function notify_users_on_page_update( $post_id ) {

    // -------------------------------------------------------
    // CONFIG — update these three values
    // -------------------------------------------------------
    $target_page_id = 408;                        // Your page ID
    $um_meta_key    = 'notify';    // Your UM field key
    $from_email     = 'abactis@svmaximus.nl';    // Your sending address
    $from_name      = 'sv-maximus.nl';          // Your sender name
    // -------------------------------------------------------

    // Only run for the specific page
    if ( (int) $post_id !== $target_page_id ) {
        return;
    }

    // Only fire on published pages, skip drafts/autosaves/revisions
    if ( get_post_status( $post_id ) !== 'publish' ) {
        return;
    }

    // Prevent duplicate sends if "Update" is clicked rapidly
    $lock_key = 'page_notify_lock_' . $post_id;
    if ( get_transient( $lock_key ) ) {
        return;
    }
    set_transient( $lock_key, true, 5 * MINUTE_IN_SECONDS );

    // Find all users who have the checkbox ticked (value stored as '1')
    $users = get_users( array(
        'meta_key'   => $um_meta_key,
        'meta_value' => 'Ja',
        'fields'     => array( 'ID', 'user_email', 'display_name' ),
    ) );

    if ( empty( $users ) ) {
        return;
    }

    // Page details for the email
    $page_title = get_the_title( $post_id );
    $page_url   = get_permalink( $post_id );
    $subject    = 'Update: ' . $page_title;
    $headers    = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $from_name . ' <' . $from_email . '>',
    );

    foreach ( $users as $user ) {
        $body = '
        <p>Hi ' . esc_html( $user->display_name ) . ',</p>
        <p>The page <strong>' . esc_html( $page_title ) . '</strong> has just been updated.</p>
        <p><a href="' . esc_url( $page_url ) . '">Click here to view it</a></p>
        <p>Thanks,<br>' . esc_html( $from_name ) . '</p>
        ';

        wp_mail( $user->user_email, $subject, $body, $headers );
    }
}