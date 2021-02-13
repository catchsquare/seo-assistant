<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Seo_Assistant
 * @subpackage Seo_Assistant/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php $current_screen = isset($_GET['tab']) ? $_GET['tab'] : ''; ?>
<div class="wrap">
    <h1>Easy Tag And Tracking Id Insert Settings</h1>
    <?php do_action('seo_assistant_settings_tabs', $current_screen); ?>
    <form method="post" action="options.php">
        <?php
        wp_nonce_field("seo-assistant-page-nonce");
        if ('google-webmaster' == $current_screen) {
            settings_fields('seo_assistant_google_webmaster');
            do_settings_sections('seo-assistant-webmaster');
        } else if ('google-analytics' == $current_screen) {
            settings_fields('seo_assistant_google_analytical');
            do_settings_sections('easy-tag-and-tracking-id-inserter_section');
        } else if ('google-tag-manager' == $current_screen) {
            settings_fields('seo_assistant_google_tag_manager');
            do_settings_sections('seo-assistant-google-tag-manager_section');
        } else {
            /* settings_fields('all_in_once_setting_google-intro');
            do_settings_sections('all_in_once_setting_google-intro'); */

            echo wpautop("<b>Seo Assistant</b> is an essential plugin for your WordPress website. It doesn't only help to insert your tracking ids and site verification tags but also help to stay connected even when you update or change your WordPress theme without much trouble.");
        }
        if ('intro' != $current_screen || '' == $current_screen) {
            submit_button();
        }
        ?>
    </form>
</div>