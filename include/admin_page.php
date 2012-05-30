<?php
/*******************************************************************************
 * THIS FILE CONTAINS THE ADMIN PAGE MARKUP                                    *
 ******************************************************************************/
wp_enqueue_style('TomatoPress_style', plugins_url('/TomatoPress/css/TP_admin_style.css'));
?>
<div class="wrap">
    
    <div id="icon-options-tomato" class="icon32"></div>
    
    <h2><?php _e('TomatoPress Settings', 'TomatoPress'); ?></h2>
    
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php settings_fields('TomatoPress'); ?>
        <?php do_settings_sections('TomatoPress_settings_page'); ?>
        <?php submit_button(__('Save options', 'TomatoPress')); ?>
    </form>
    
</div>