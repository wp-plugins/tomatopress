<?php
/*******************************************************************************
 * THIS FILE CONTAINS THE METABOX MARKUP                                       *
 ******************************************************************************/
$options = get_option('TomatoPress');
wp_enqueue_style('TomatoPress_style', plugins_url('/TomatoPress/css/TP_style.css'));
wp_enqueue_style('TomatoPress_skins_style', plugins_url('/TomatoPress/skins/css/skins.css'));
wp_enqueue_script('TomatoPress_behavior', plugins_url('/TomatoPress/script/TP_behavior.js'), 'jquery');
?>
<script type="text/javascript">
    var tomatoDuration = <?php echo $options['tomato_duration']; ?>;
    var shortBreakDuration = <?php echo $options['short_break_duration']; ?>;
    var longBreakDuration = <?php echo $options['long_break_duration']; ?>;
    var tomatoesBeforeLongBreak = <?php echo $options['tomatoes_before_long_break']; ?>;
</script>
<div id="TomatoPress_skin">
    <div id="TomatoPress_timer">
        <p></p>
    </div>
</div>
<div id="TomatoPress_counters">
    <p><?php _e('Tomato number:','TomatoPress'); ?> <span></span></p>
</div>
<div id="TomatoPress_controls">
    <button id="TomatoPress_start" class="button-primary"><?php _e('Start','TomatoPress'); ?></button>
    <button id="TomatoPress_reset" class="button-secondary"><?php _e('Reset Tomatoes','TomatoPress'); ?></button>
    <button id="TomatoPress_stop" class="button-secondary"><?php _e('Stop','TomatoPress'); ?></button>        
</div>
