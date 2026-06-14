<?php
/**
 * Uninstall cleanup for Anchor.
 *
 * Runs when the plugin is deleted from wp-admin. Removes the options Anchor
 * creates. No per-product data is stored, so there is nothing else to clean up.
 *
 * @package Anchor
 */

declare(strict_types=1);

defined('WP_UNINSTALL_PLUGIN') || exit;

delete_option('anchor_settings');
delete_option('anchor_db_version');
