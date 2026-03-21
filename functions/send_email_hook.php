<?php
/**
 * Notify UM users (with a specific checkbox ticked) when a page is updated.
 * Place in: child-theme/functions.php
 */
add_action('acf/save_post', 'notify_users_on_page_update', 20);
function notify_users_on_page_update($post_id)
{
    // -------------------------------------------------------
    // CONFIG — update these three values
    // -------------------------------------------------------
    $target_page_id = 408;
    $um_meta_key = 'notify';
    $from_email = 'abactis@svmaximus.nl';
    $from_name = 'sv-maximus.nl';
    // -------------------------------------------------------

    error_log('--- NOTIFY DEBUG --- acf/save_post fired for post_id: ' . $post_id);

    // Only run for the specific page
    if ((int) $post_id !== $target_page_id) {
        error_log('NOTIFY DEBUG: ID mismatch — got ' . $post_id . ', expected ' . $target_page_id . '. Bailing.');
        return;
    }

    error_log('NOTIFY DEBUG: Page ID matched.');

    // Only fire on published pages, skip drafts/autosaves/revisions
    $status = get_post_status($post_id);
    if ($status !== 'publish') {
        error_log('NOTIFY DEBUG: Post status is "' . $status . '", not published. Bailing.');
        return;
    }

    error_log('NOTIFY DEBUG: Post status is publish. Continuing.');

    // Prevent duplicate sends if "Update" is clicked rapidly
    $lock_key = 'page_notify_lock_' . $post_id;
    if (get_transient($lock_key)) {
        error_log('NOTIFY DEBUG: Transient lock active — duplicate send prevented. Bailing.');
        return;
    }
    set_transient($lock_key, true, 5 * MINUTE_IN_SECONDS);

    // Find all users who have the checkbox ticked (value stored as '1')
    $users = get_users(array(
        'meta_key' => 'notify',
        'meta_value' => '"Ja"',
        'meta_compare' => 'LIKE',
        'fields' => array('ID', 'user_email', 'display_name'),
    ));

    error_log('NOTIFY DEBUG: Users found with meta_key "' . $um_meta_key . '" = "1": ' . count($users));

    if (empty($users)) {
        error_log('NOTIFY DEBUG: No matching users. Bailing.');
        return;
    }

    // Page details for the email
    $page_title = get_the_title($post_id);
    $page_url = get_permalink($post_id);
    $subject = 'Update: ' . $page_title;
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $from_name . ' <' . $from_email . '>',
    );

    foreach ($users as $user) {
        error_log('NOTIFY DEBUG: Sending email to ' . $user->user_email);

        $body = '
        <p>Hi ' . esc_html($user->display_name) . ',</p>
        <p>The page <strong>' . esc_html($page_title) . '</strong> has just been updated.</p>
        <p><a href="' . esc_url($page_url) . '">Click here to view it</a></p>
        <p>Thanks,<br>' . esc_html($from_name) . '</p>
        ';

        $result = wp_mail($user->user_email, $subject, $body, $headers);
        error_log('NOTIFY DEBUG: wp_mail result for ' . $user->user_email . ': ' . ($result ? 'SUCCESS' : 'FAILED'));
    }

    error_log('--- NOTIFY DEBUG COMPLETE ---');
}