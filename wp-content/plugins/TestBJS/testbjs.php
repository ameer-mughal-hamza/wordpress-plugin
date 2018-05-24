<?php
/*
Plugin Name: TestBJS
Plugin URI: http://www.bjs-softsolution.com/
Description: This plugin allows WordPress to embed live real estate data from an MLS directly into a blog. You MUST have a dsIDXpress account to use this plugin.
Text Domain: testbjs
Author: BJS Soft Solutions
Author URI: http://www.bjs-softsolution.com/
Version: 1.0.0
*/

defined('ABSPATH') or die('Unauthorize');

class TestBJS
{
    function __construct()
    {
        add_action('init', array($this, 'custom_post_type'));
    }

    public function register()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue'));
    }

    /**
     * We don't need this methods in this class any more because we split them into different classes.
     * This is more better way of writing code.
     * function activate()
     * {
     * $this->custom_post_type();
     * flush_rewrite_rules();
     * }
     *
     * function deactivate()
     * {
     * flush_rewrite_rules();
     * }
     */

    function custom_post_type()
    {
        register_post_type('book', [
            'public' => true,
            'label' => 'Books'
        ]);
    }

    public function activate()
    {
        require_once plugin_dir_path(__FILE__) . 'inc/test-bjs-plugin-activate.php';
        TestBJSPluginActivate::activate();
    }

    function enqueue()
    {
        // enqueue all scripts
        //If you want to show this script in admin dashboard use the code below
        wp_enqueue_style('mypluginstyle', plugins_url('/css/style.css', __FILE__));
        wp_enqueue_script('mypluginscript', plugins_url('/js/style.js', __FILE__));
        //If you want to show the code in main web use the code below
//        wp_enqueue_style('mypluginstyle', plugins_url('/js/style.js', __FILE__));
    }
}

if (class_exists('TestBJS')) {
    $ameerhamza = new TestBJS();
    $ameerhamza->register();
}

//activation
//This will call the activate method inside the main class and in that method we call the
//static method of TestBJSPluginActivate method activate
//These are three different ways of doing the same thing.
register_activation_hook(__FILE__, array($ameerhamza, 'activate'));


//deactivation
require_once plugin_dir_path(__FILE__) . 'inc/test-bjs-plugin-deactivate.php';
register_deactivation_hook(__FILE__, array('TestBJSPluginDeactivate', 'deactivate'));