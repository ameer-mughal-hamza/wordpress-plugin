<?php
/*
Plugin Name: TestBJS
Plugin URI: http://www.bjs-softsolution.com/
Description: This plugin allows WordPress to embed live real estate data from an MLS directly into a blog. You MUST have a BJS account to use this plugin.
Text Domain: testbjs
Author: BJS Soft Solutions
Author URI: http://www.bjs-softsolution.com/
Version: 1.0.0
*/

/*
	Copyright 2017, BJS Soft Solutions

	Licensed under the Apache License, Version 2.0 (the "License");
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an "AS IS" BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License.
*/

defined('ABSPATH') or die('Unauthorize');


class TestBJS
{
    public $plugin_name;

    function __construct()
    {
        $this->plugin_name = plugin_basename(__FILE__);
        add_action('init', array($this, 'custom_post_type'));
    }

    public function register()
    {
        //We write all our actions in register method because this is the only method that is called when the object is created.


        //Methods for adding scripts and styles.
        add_action('wp_enqueue_scripts', array($this, 'enqueue'));

        //Method for adding menu in the toolbar. e.g. Settings
        add_action('admin_menu', array($this, 'add_admin_pages'));

        //Method for showing settings link
        add_filter("plugin_action_links_".$this->plugin_name, array($this, 'admin_settings_link'));
    }

    public function admin_settings_link($links)
    {
        //You can add as many links as you want in this.
        //Wordpress automatically split them and show them on the plugins sections
        $settings_link = '<a href="admin.php?page=testbjs_plugin">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }

    public function add_admin_pages()
    {
        add_menu_page('TestBjs', 'TestBJS',
            'manage_options', 'testbjs_plugin',
            array($this, 'settings_page'), 'dashicons-admin-multisite', '110');
    }

    public function settings_page()
    {
        require_once plugin_dir_path(__FILE__) . 'templates/admin_settings.php';
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

//    $ameerhamza = new TestBJS();
//    $ameerhamza->register();

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