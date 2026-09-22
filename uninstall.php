<?php
/**
 * Uninstall cleanup for Ankro.
 *
 * Runs when the plugin is deleted from wp-admin. Removes the options Ankro
 * creates and the per-user dismissal of the PRO banner. No per-product data is
 * stored, so there is nothing else to clean up.
 *
 * @package Anchor
 */

declare(strict_types=1);

defined('WP_UNINSTALL_PLUGIN') || exit;

delete_option('anchor_settings');
delete_option('anchor_db_version');

// The PRO banner's dismissal is stored per user, so it belongs to the
// plugin rather than to the site content. User meta is global, not
// per-site, which is why this uses delete_metadata's \$delete_all rather
// than a loop over the users of one blog.
delete_metadata('user', 0, 'anchor_pro_banner_dismissed', '', true);
