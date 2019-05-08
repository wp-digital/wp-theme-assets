<?php

namespace Innocode\WPThemeAssets;

/**
 * Class Helpers
 * @package Innocode\WPThemeAssets
 */
final class Helpers
{
    /**
     * Returns entry URL from manifest
     *
     * @param string $uri
     * @return string|false
     */
    public static function url( $uri ) {
        $entries = Manifest::get_entries();

        if ( ! isset( $entries[ $uri ] ) ) {
            return false;
        }

        return get_theme_file_uri( $entries[ $uri ] );
    }
}
