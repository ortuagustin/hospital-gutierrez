<?php

/**
 * Returns an HTML hyperlink tag that links to the given named route.
 * The Text is optional
 *
 * @param  string  $route_name  a named route
 * @param  string  $route_args  arguments for the named route
 * @param  string  $text        display value of the link
 * @return string
 */
function link_to($text, $route_name, $route_args)
{
    $url = route($route_name, $route_args);

    return "<a href=$url>$text</a>";
}

/**
 * Returns an HTML hyperlink tag that links to the given named route.
 * The a tag contains a child <i> tag with an icon.
 * The icon parameter specifies the icon to display
 * The Text is optional
 *
 * @param  string        $icon          the icon to display
 * @param  string        $route_name    a named route
 * @param  string|array  $route_args    arguments for the named route
 * @param  string        $text          display value of the link
 * @param  string        $icon_class  additional classes for the icon itself
 * @param  string        $button_class  additional classes for the icon container
 * @return string
 */
function link_to_with_icon($icon, $route_name, $route_args = [], $text = '', $icon_class = '', $button_class = '')
{
    $url = route($route_name, $route_args);
    $button_class = 'button is-white' . $button_class;
    $icon_class = 'icon ' . $icon_class;

    return
        "<p class='field'>
            <a class='$button_class' href=$url>
                <span class='$icon_class'>
                    <i class='$icon'></i>
                </span>
                <span>$text</span>
            </a>
        </p>";
}

/**
 * Returns an HTML hyperlink tag that links to the given named route.
 * The a tag contains a child <i> tag with an icon.
 * The icon parameter specifies the icon to display
 * The Text is optional
 *
 * @param  string  $icon           the icon to display
 * @param  string  $route_name     a named route
 * @param  string  $route_args     arguments for the named route
 * @param  string  $text           display value of the link
 * @return string
 */
function delete_link_with_icon($icon, $route_name, $route_args, $text = '')
{
    $url = route($route_name, $route_args);

    $button =
    "<p class='field'>
        <button class='button has-text-danger is-white'>
            <span class='icon'>
                <i class='$icon'></i>
            </span>
            <span>$text</span>
        </button>
    </p>";

    $method_field = method_field('DELETE');
    $csrf_field = csrf_field();

    return
        "<form method='POST' action=$url>
            $method_field
            $csrf_field
            $button
        </form>";
}
