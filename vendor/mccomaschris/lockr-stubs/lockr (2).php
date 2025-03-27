<?php
/**
 * Generated stub declarations for Lockr.
 * https://www.lockr.com/
 */

/**
 * Create a table to display all keys currently stored in Lockr.
 */
class Lockr_Key_List extends \WP_List_Table
{
    /**
     *  Get things started with the table.
     */
    public function __construct()
    {
    }
    /**
     *  Text displayed when no key data is available.
     */
    public function no_items()
    {
    }
    /**
     *  Format the data for the row item
     *
     * @param array $item The row item to display.
     */
    public function column_cb($item)
    {
    }
    /**
     * Get columns and their names.
     */
    public function get_columns()
    {
    }
    /**
     * Get sortable columns and their config.
     */
    public function get_sortable_columns()
    {
    }
    /**
     * Set the content for each row's column.
     *
     * @param array  $item The row item to be displayed.
     * @param string $column_name The name of the column to put the data in.
     */
    public function column_default($item, $column_name)
    {
    }
    /**
     * Get the data from the database to put into the table.
     */
    public function prepare_items()
    {
    }
    /**
     * Delete a Lockr key.
     *
     * @param string $key_name machine name of the key.
     */
    public static function delete_key($key_name)
    {
    }
    /**
     * Returns an associative array containing the bulk action
     *
     * @return array
     */
    public function get_bulk_actions()
    {
    }
    /**
     * Do the bulk action submitted.
     */
    public function process_bulk_action()
    {
    }
}
/**
 * Create a simple status table to easily see the status of the Lockr integration.
 */
class Lockr_Status extends \WP_List_Table
{
    /**
     * Get things started with the table.
     */
    public function __construct()
    {
    }
    /**
     * Text displayed when no data is available.
     */
    public function no_items()
    {
    }
    /**
     * Get columns and their names.
     */
    public function get_columns()
    {
    }
    /**
     * Create the row data for Lock status.
     *
     * @param array  $item The row Item to display.
     * @param string $column_name The column to put the data into.
     */
    public function column_default($item, $column_name)
    {
    }
    /**
     * Prepare the row items for display.
     */
    public function prepare_items()
    {
    }
}
/**
 * Class to handle all the metadata like wrapping keys used to store secrets in Lockr.
 */
class Lockr_WP_Secret_Info implements \Lockr\SecretInfoInterface
{
    /**
     * Data array for secrets stored in Lockr
     *
     * @var array $data the data array of secrets stored in Lockr.
     * **/
    private $data;
    /**
     * Get all the data on secrets stored in Lockr on when constructed.
     **/
    public function __construct()
    {
    }
    /**
     * {@inheritdoc}
     *
     * @param string $name The name of the key stored in Lockr.
     */
    public function getSecretInfo($name)
    {
    }
    /**
     * {@inheritdoc}
     *
     * @param string $name The name of the key stored in Lockr.
     * @param array  $info The array of information used to find and decrypt the value.
     *
     * @throws \Exception If the database does not connect we cannot store information.
     */
    public function setSecretInfo($name, array $info)
    {
    }
    /**
     * {@inheritdoc}
     */
    public function getAllSecretInfo()
    {
    }
}
/**
 * Add a key to Lockr from the submitted form.
 */
function lockr_admin_submit_add_key()
{
}
/**
 * Create the form to add a key to Lockr.
 */
function lockr_add_form()
{
}
/**
 * Create our admin settings fields.
 */
function register_lockr_settings()
{
}
/**
 * Create token text field.
 */
function lockr_token_text()
{
}
/**
 * Create advanced text field.
 */
function lockr_advanced_text()
{
}
/**
 * Create Lockr token text input.
 */
function lockr_client_token_input()
{
}
/**
 * Create Lockr prod token text input.
 */
function lockr_client_prod_token_input()
{
}
/**
 * Create Lockr cert path text field.
 */
function lockr_cert_path_input()
{
}
/**
 * Create Lockr password text field.
 */
function lockr_account_password_input()
{
}
/**
 * Get the region input value.
 */
function lockr_region_input()
{
}
/**
 * Get the password hash input value.
 */
function lockr_encrypt_posts_input()
{
}
/**
 * Get the password hash input value.
 */
function lockr_hash_pass_input()
{
}
/**
 * Validate the form submissions.
 *
 * @param array $input the input values from the form.
 */
function lockr_options_validate($input)
{
}
/**
 * Create the HTML of the Lockr configuration form.
 */
function lockr_configuration_form()
{
}
/**
 * Remove a directory recursively.
 *
 * @param string $path The name of the path to delete.
 */
function _lockr_rmtree($path)
{
}
/**
 * Submit handler for editing an existing key in Lockr.
 */
function lockr_admin_submit_edit_key()
{
}
/**
 * Constructs a form to edit an existing key in Lockr.
 */
function lockr_edit_form()
{
}
/**
 * Submit handler for creating an override of a WordPress option.
 */
function lockr_admin_submit_override_key()
{
}
/**
 * Form builder for creating an override of a WordPress option.
 */
function lockr_override_form()
{
}
/**
 * Create our admin pages and put them into the admin menu.
 */
function lockr_admin_menu()
{
}
/**
 * Queue up our stylesheet for the admin interface.
 *
 * @param string $hook The name of the admin page we're on.
 */
function lockr_admin_styles($hook)
{
}
/**
 * Create a table of all the keys in Lockr.
 */
function lockr_keys_table()
{
}
/**
 * Allow for key retrieval from WP-CLI.
 *
 * @param array $args an array of arguments passed into the command.
 * @param array $assoc_args an array of associated arguments passed into the command.
 */
function lockr_command_get_key($args, $assoc_args)
{
}
/**
 * Register a site from WP-CLI.
 *
 * @param array $args an array of arguments passed into the command.
 * @param array $assoc_args an array of associated arguments passed into the command.
 */
function lockr_command_register_site($args, $assoc_args)
{
}
/**
 * Set a key from WP CLI.
 *
 * @param array $args an array of arguments passed into the command.
 * @param array $assoc_args an array of associated arguments passed into the command.
 */
function lockr_command_set_key($args, $assoc_args)
{
}
/**
 * Apply patches to plugins for Lockr.
 *
 * @param array $args an array of arguments passed into the command.
 * @param array $assoc_args an array of associated arguments passed into the command.
 */
function lockr_command_lockdown($args, $assoc_args)
{
}
/**
 * Set an array with a list of all the keys in Lockr.
 */
function lockr_init_all_keys()
{
}
/**
 * Set an array with a list of all the overrides in Lockr.
 */
function lockr_init_overrides_list()
{
}
/**
 * Get an existing Lockr override
 *
 * @param mixed  $value The value coming from the options table with our placeholder.
 * @param string $option_name The name of the option being requested.
 */
function lockr_option_get_override($value, $option_name)
{
}
/**
 * Update an existing Lockr override
 *
 * @param string $option The name of the option to be updated in Lockr.
 * @param string $old_value The existing value of the secret.
 * @param string $value The new value to store in Lockr.
 */
function lockr_option_update_override($option, $old_value, $value)
{
}
/**
 * Remove a Lockr override
 *
 * @param string $option The name of the option to be removed from Lockr.
 */
function lockr_option_delete_override($option)
{
}
/**
 * DEPRECATED OVERRIDES - USE OVERRIDE UI FOR THIS NOW.
 * MailChimp for WordPress Plugin
 *
 * @param array $settings The MailChimp for WordPress.
 */
function lockr_mailchimp_load_override($settings)
{
}
/**
 * DEPRECATED OVERRIDES - USE OVERRIDE UI FOR THIS NOW.
 * GiveWP Plugin overrides
 *
 * @param string $value The secret value.
 * @param string $key The name of the key.
 * @param string $default The default value.
 */
function lockr_give_get($value, $key, $default)
{
}
/**
 * DEPRECATED OVERRIDES - USE OVERRIDE UI FOR THIS NOW.
 * GiveWP Plugin overrides
 *
 * @param string $return The secret value.
 * @param array  $options The name of the key.
 * @param string $cbm2 The default CBM2 value.
 */
function lockr_give_cmb2_get($return, $options, $cbm2)
{
}
/**
 * Returns the detected partner, if available.
 */
function lockr_get_partner()
{
}
/**
 * Setup the necessary partner registration certs.
 *
 * @param string $client_token The client token given by accounts.lockr.io for authorization.
 * @param string $client_prod_token The production client token given by accounts.lockr.io for authorization.
 * @param array  $partner The Partner array.
 * @param string $env The Envrionment to register.
 *
 * @return bool If the registration was successful.
 */
function lockr_partner_register($client_token, $client_prod_token, $partner, $env = \null)
{
}
/**
 * Encrypt data coming out of the post editor when password protected, private or unpublished.
 *
 * @param array $data The post data to be saved.
 * @param array $postarr The post array to be saved.
 */
function lockr_secure_post_encrypt($data, $postarr)
{
}
/**
 * Decrypt data coming out of the post editor when password protected, private or unpublished.
 *
 * @param string $content The content of the post.
 */
function lockr_secure_post_decrypt($content)
{
}
/**
 * Decrypt data coming out of the post query when password protected, private or unpublished.
 */
function lockr_secure_post_result_decrypt()
{
}
/**
 * Set a session with the postpass instead of the current cookie hashing method.
 */
function lockr_secure_post_postpass_check()
{
}
/**
 * Set a session with the postpass instead of the current cookie hashing method.
 */
function lockr_secure_post_postpass_session()
{
}
/**
 * Check for hashed passwords used for protecting posts.
 *
 * @param bool  $required If a password form is required.
 * @param array $post The post in question.
 */
function lockr_password_form_check($required, $post)
{
}
/**
 * Initial setup when the plugin is activated.
 */
function lockr_install()
{
}
/**
 * Create Lockr certificate files.
 *
 * @param string $dir The directory to save the files to.
 * @param array  $texts The text of the certificate files.
 */
function lockr_write_cert_pair($dir, $texts)
{
}
/**
 * Check if any DB updates are needed, and if so run install over again.
 */
function lockr_update_db_check()
{
}
/**
 * Returns the Lockr client for this site.
 *
 * @param bool $force If the cached client (if exists) should be recreated.
 */
function lockr_client($force = \false)
{
}
/**
 * Returns the Lockr settings for this site.
 */
function lockr_settings()
{
}
/**
 * Returns if this site is currently registered with Lockr.
 *
 * @return array An array of the site status.
 */
function lockr_check_registration()
{
}
/**
 * Create Lockr client certs.
 *
 * @param string $client_token The client token passed back from accounts.lockr.io .
 * @param array  $dn The dn array for the CSR.
 * @param string $dirname The directory to put the certificates in.
 * @param array  $partner The partner information if it exists.
 * @param bool   $partner_certs If the partner already has certificates provisioned.
 *
 * @return bool If the certs were successfully created.
 */
function create_certs($client_token, $dn = array(), $dirname = \ABSPATH . '.lockr', $partner = array(), $partner_certs = \false)
{
}
/**
 * Encrypt plaintext using a key from Lockr.
 *
 * @param string $plaintext The plaintext to be encrypted.
 * @param string $key_name The key name in Lockr.
 *
 * @return string|null
 *   The encrypted and encoded ciphertext or null if encryption fails.
 */
function lockr_encrypt($plaintext, $key_name = 'lockr_default_key')
{
}
/**
 * Decrypt ciphertext using a key from Lockr.
 *
 * @param string $encoded The encrypted and encoded ciphertext.
 *
 * @return string|null The plaintext or null if decryption fails.
 */
function lockr_decrypt($encoded)
{
}
/**
 * Gets a key from Lockr.
 *
 * @param string $key_name The key name.
 * @return string | false
 * Returns the key value, or false on failure.
 */
function lockr_get_key($key_name)
{
}
/**
 * Sets a key value in lockr.
 *
 * @param string      $key_name The key name.
 * @param string      $key_value The key value.
 * @param string      $key_label The key label.
 * @param string|bool $option_override The exisiting key metadata if it exists.
 * @param bool        $auto_created if the key was programatically created by Lockr.
 *
 * @return bool       true if the key set successfully, false if not.
 */
function lockr_set_key($key_name, $key_value, $key_label, $option_override = \null, $auto_created = \false)
{
}
/**
 * Deletes a key from Lockr.
 *
 * @param string $key_name The key name.
 */
function lockr_delete_key($key_name)
{
}
/**
 * Migrate the abstracts into their correct environment display.
 *
 * @param string $environment What environment the site is in.
 */
function lockr_update_abstracts($environment)
{
}
/**
 * Performs a generic option-override.
 *
 * @param string $option_name The name of the option to override.
 * @param string $key_name The key name in Lockr to override with.
 * @param string $key_desc The description of the key to be stored.
 */
function lockr_override_option($option_name, $key_name, $key_desc)
{
}
/**
 * Gets a possibly overridden option value.
 *
 * @param string $option_name The name of the overridden option.
 */
function lockr_get_override_value($option_name)
{
}
