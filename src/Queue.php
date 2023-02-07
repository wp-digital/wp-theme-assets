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
    static $is_public_path_set = false;

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
            Queue::maybe_set_public_path( $handle );
        }
    }

    /**
     * @return mixed
     */
    public static function get_public_path()
    {
        $path = get_theme_file_uri( '/assets/build/' );

        /**
         * Integration with https://github.com/innocode-digital/wp-cdn
         */
        if (
            defined( 'CDN_DOMAIN' ) &&
            function_exists( 'get_cdn_attachment_url' )
        ) {
            $path = get_cdn_attachment_url( $path, true );
        }

        return $path;
    }

    /**
     * @param string $handle
     */
    public static function set_public_path( $handle )
    {
        $path = Queue::get_public_path();

        wp_add_inline_script(
            $handle,
            "var __PUBLIC_PATH__ = \"$path\";",
            'before'
        );

        Queue::$is_public_path_set = true;
    }

    /**
     * @param string $handle
     */
    public static function maybe_set_public_path( $handle )
    {
        if ( ! Queue::$is_public_path_set ) {
            Queue::set_public_path( $handle );
        }
    }
}
