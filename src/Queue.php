<?php

namespace Innocode\WPThemeAssets;

/**
 * Class Queue
 * @package Innocode\WPThemeAssets
 */
final class Queue
{
    /**
     * @var bool
     */
    static $_is_public_path_set = false;

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
            static::maybe_set_public_path( $handle );
        }
    }

    /**
     * @param string $handle
     */
    public static function set_public_path( $handle )
    {
        wp_localize_script(
            $handle,
            '__PUBLIC_PATH__',
            get_theme_file_uri( '/assets/build/' )
        );
        static::$_is_public_path_set = true;
    }

    /**
     * @param string $handle
     */
    public static function maybe_set_public_path( $handle )
    {
        if ( ! static::$_is_public_path_set ) {
            static::set_public_path( $handle );
        }
    }
}
