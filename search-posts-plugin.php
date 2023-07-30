<?php
/*
Plugin Name: Search Posts Plugin
Description: Plugin que permite buscar posts publicados.
Version: 1.0
Author: YECID TOVAR TOVAR
*/

function search_posts_form()
{

    $form = '<form id="search-posts-form" style="display:flex;" method="get" action="' . esc_url(home_url('/')) . '">';
    $form .= '<input id="namanyay-search-box" name="s" type="text" placeholder="Buscar posts"/>';
    $form .= '<input id="namanyay-search-btn" value="Buscar" type="submit"/>';
    $form .= '</form>';


    return $form;

}
add_shortcode('search_posts', 'search_posts_form');

function search_posts_plugin_scripts()
{
    wp_enqueue_style('search-posts-plugin-style', plugins_url('style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'search_posts_plugin_scripts');

function custom_search_filter($query)
{
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts', 'custom_search_filter');