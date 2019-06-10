<?php

namespace Innocode\WPThemeAssets;

/**
 * Class Helpers
 * @package Innocode\WPThemeAssets
 */
final class Helpers
{
    /**
     * Returns entry path from manifest
     *
     * @param string $uri
     * @return string|false
     */
    public static function path( $uri )
    {
        $entries = Manifest::get_entries();

        if ( ! isset( $entries[ $uri ] ) ) {
            return false;
        }

        return get_theme_file_path( $entries[ $uri ] );
    }

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

    /**
     * Loads entry template part
     *
     * @param $uri
     */
    public static function template( $uri )
    {
        $entries = Manifest::get_entries();

        if ( ! isset( $entries[ $uri ] ) ) {
            return;
        }

        get_template_part( $entries[ $uri ] );
    }

    /**
     * Returns entry svg icon html
     *
     * @param string $name
     * @return string
     */
    public static function get_icon( $name )
    {
        $url = "#$name";

        if (
            is_admin() &&
            false !== ( $sprite_url = static::url( 'sprite.svg' ) )
        ) {
            $url = "$sprite_url$url";
        }

        return "<svg role=\"img\" class=\"sprite-icon sprite-icon-$name\"><use xlink:href=\"$url\"></svg>";
    }

    /**
     * Returns entry image html
     *
     * @param string $uri
     * @param array  $attrs
     * @return string
     */
    public static function get_image( $uri, array $attrs = [] )
    {
        if ( false === ( $url = static::url( $uri ) ) ) {
            return '';
        }

        if ( ! isset( $attrs['alt'] ) ) {
            $attrs['alt'] = pathinfo( $uri, PATHINFO_FILENAME );
        }

        return "<img src=\"$url\" " . array_reduce(
            array_keys( $attrs ),
            function ( $carry, $attr ) use ( $attrs ) {
                return "$carry $attr=\"" . esc_attr( $attrs[ $attr ] ) . '"';
            }, '' ) . '>';
    }
}
