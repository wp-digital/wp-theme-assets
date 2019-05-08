<?php

namespace Innocode\WPThemeAssets;

/**
 * Class Queue
 * @package Innocode\WPThemeAssets
 */
final class Queue
{
    /**
     * Adds style to WordPress styles queue
     *
     * @param string $handle
     * @param string $uri
     * @param array  $deps
     * @param string $media
     */
    public static function add_style( $handle, $uri, array $deps = [], $media = 'all' )
    {
        if ( false !== ( $src = Helpers::url( $uri ) ) ) {
            wp_enqueue_style( $handle, $src, $deps, null, $media );
        }
    }

    /**
     * Adds style to WordPress scripts queue
     *
     * @param string $handle
     * @param string $uri
     * @param array  $deps
     * @param bool   $in_footer
     */
    public static function add_script( $handle, $uri, array $deps = [], $in_footer = false )
    {
        if ( false !== ( $src = Helpers::url( $uri ) ) ) {
            wp_enqueue_script( $handle, $src, $deps, null, $in_footer );
        }
    }
}
