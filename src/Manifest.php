<?php

namespace Innocode\WPThemeAssets;

/**
 * Class Manifest
 * @package Innocode\WPThemeAssets
 */
final class Manifest
{
    /**
     * @var string
     */
    private static $file = 'assets/build/manifest.json.php';
    /**
     * @var array|null
     */
    private static $entries = null;

    /**
     * Sets project manifest filename
     *
     * @param string $file
     */
    public static function set_file( $file )
    {
        static::$file = $file;
    }

    /**
     * Returns project manifest filename
     *
     * @return string
     */
    public static function get_file()
    {
        return get_theme_file_path( static::$file );
    }

    /**
     * Returns all assets from manifest
     *
     * @return array
     */
    public static function get_entries()
    {
        if ( is_null( static::$entries ) ) {
            static::$entries = static::load_file();
        }

        return static::$entries;
    }

    /**
     * Loads manifest
     *
     * @return array
     */
    private static function load_file()
    {
        $file = static::get_file();

        return file_exists( $file )
            ? include $file
            : [];
    }
}
