<?php

/**
 * A negative scroll threshold must clamp to 0, not flip to a positive number.
 *
 * sanitize() ran the value through absint() before clamping, so -800 was saved
 * as 800 and the bar appeared far later than the merchant asked for.
 *
 * Run: php tests/threshold-clamp-check.php
 */

declare(strict_types=1);

namespace Anchor\Contract {
    interface HasHooks
    {
    }
}

namespace {
    define('ABSPATH', __DIR__);

    function apply_filters(string $hook, mixed $value, mixed ...$args): mixed
    {
        return $value;
    }

    function absint(mixed $value): int
    {
        return abs((int) $value);
    }

    require __DIR__ . '/../src/Admin/Settings.php';

    $settings = (new ReflectionClass(\Anchor\Admin\Settings::class))->newInstanceWithoutConstructor();
    $cases    = ['-800' => 0, '0' => 0, '450' => 450, '99999' => 5000];
    $failures = 0;

    foreach ($cases as $in => $want) {
        $got = $settings->sanitize(['enabled' => '1', 'scroll_threshold' => (string) $in])['scroll_threshold'];
        if ($got !== $want) {
            echo "FAIL: {$in} saved as {$got}, expected {$want}\n";
            $failures++;
        }
    }

    echo 0 === $failures ? "OK: scroll threshold clamps to 0..5000\n" : '';
    exit($failures > 0 ? 1 : 0);
}
