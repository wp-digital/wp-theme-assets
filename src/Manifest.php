<?php

namespace Innocode\WPThemeAssets;

/**
 * Class Queue
 * @package Innocode\WPThemeAssets
 */
final class Manifest
{
    /**
     * @var string
     */
    private static $_file = 'assets/build/manifest.json.php';
    /**
     * @var array|null
     */
    private static $_entries = null;

    /**
     * Sets project manifest filename
     *
     * @param string $file
     */
    public static function set_file( $file )
    {
        static::$_file = $file;
    }

    /**
     * Returns project manifest filename
     *
     * @return string
     */
    public static function get_file()
    {
        return get_theme_file_path( static::$_file );
    }

    /**
     * Returns all assets from manifest
     *
     * @return array
     */
    public static function get_entries()
    {
        if ( is_null( static::$_entries ) ) {
            static::$_entries = static::_load_file();
        }

        return static::$_entries;
    }

    /**
     * Loads manifest
     *
     * @return array
     */
    private static function _load_file()
    {
        $file = static::get_file();

        return file_exists( $file )
            ? include $file
            : [];
    }
}
