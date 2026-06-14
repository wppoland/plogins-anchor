<?php
/**
 * Constants needed by PHPStan to analyse the plugin without bootstrapping WordPress.
 *
 * @package Anchor
 */

declare(strict_types=1);

namespace {
    if (! defined('ABSPATH')) {
        define('ABSPATH', '/tmp/wordpress/');
    }
    if (! defined('ANCHOR_DIR')) {
        define('ANCHOR_DIR', '/tmp/anchor/');
    }
    if (! defined('ANCHOR_URL')) {
        define('ANCHOR_URL', 'https://example.test/wp-content/plugins/anchor/');
    }
}

namespace Anchor {
    if (! defined('Anchor\\VERSION')) {
        define('Anchor\\VERSION', '0.1.0');
    }
    if (! defined('Anchor\\PLUGIN_FILE')) {
        define('Anchor\\PLUGIN_FILE', '/tmp/anchor/anchor.php');
    }
}
