<?php
/*
 * Plugin Name: TomatoPress
 * Plugin URI: http://thetibashole.tumblr.com
 * Description: Do you like time management techniques? With this plugin you'll be able to set timers for writing posts.
 * Version: 1.0
 * Author: Tiziano Basile
 * Author URI: http://thetibashole.tumblr.com
 */

class TomatoPress
{
    public function __construct()
    {
        if(is_admin())
        {
            add_action('admin_init', array($this,'TomatoPress_install'));
            add_action('admin_menu', array($this,'TomatoPress_add_option_page'));
            add_action('add_meta_boxes', array($this,'TomatoPress_add_metabox'));
        }
        
    }
    
    public function TomatoPress_install()
    {
        include_once dirname(__FILE__).'/include/installation.php';
    }
    
    public function TomatoPress_add_option_page()
    {
        add_menu_page
        (
                __('TomatoPress Settings','TomatoPress'),
                __('TomatoPress','TomatoPress'),
                'edit_posts',
                'TomatoPress_settings_page',
                array($this,'TomatoPress_add_option_page_cb'),
                plugins_url('/TomatoPress/images/menu_icon_16.png')
        );
    }
    
    public function TomatoPress_add_metabox()
    {
        add_meta_box(
                'TomatoPress_metabox',
                __('TomatoPress','TomatoPress'),
                array($this,'TomatoPress_metabox_cb'),
                'post',
                'side',
                'high',
                array('Text')
        );
    }
    
/*******************************************************************************
 * CALLBACKS                                                                   *
 ******************************************************************************/
    public function TomatoPress_add_option_page_cb()
    {
        include_once dirname(__FILE__).'/include/admin_page.php';
    }
    
    public function TomatoPress_metabox_cb($args)
    {
        include_once dirname(__FILE__).'/include/metabox_markup.php';
    }
}

$TomatoPress = new TomatoPress();
?>
