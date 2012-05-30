<?php
/*******************************************************************************
 * THIS FILE CONTAINS FUNCTIONS USED IN ORDER TO INSTALL THE PLUGIN            *
 ******************************************************************************/

/*------------------------------------------------------------------------------
 *  OPTIONS VERIFY AND INIT                                                    
 *----------------------------------------------------------------------------*/
    if(false == get_option('TomatoPress'))
    {
        add_option
        (
                'TomatoPress',
                array(
                    'tomato_duration' => '1500', // 25 minutes
                    'short_break_duration' => '300', // 5 minutes
                    'long_break_duration' => '1800', // 30 minutes
                    'tomatoes_before_long_break' => '4',
                )
        );
    }

/*------------------------------------------------------------------------------
 *  SECTIONS INIT
 *----------------------------------------------------------------------------*/
    add_settings_section
    (
            'TomatoPress_settings_section', 
            __('TomatoPress Settings','TomatoPress'),
            'TomatoPress_section_cb',
            'TomatoPress_settings_page'
    );
    
/*------------------------------------------------------------------------------
 *  SECTIONS CALLBACK
 *----------------------------------------------------------------------------*/
    function TomatoPress_section_cb()
    {
        echo '<p>'.__('Here you can set the default duration for your Tomatoes','TomatoPress').'</p>';
    }
/*------------------------------------------------------------------------------
 *  FIELDS INIT
 *----------------------------------------------------------------------------*/
    /*******************
     * TOMATO DURATION *
     *******************/
    add_settings_field
    (
            'tomato_duration',
            '<h4><label for="tomato_duration">'.__('Tomato Duration','TomatoPress').'</label></h4>', 
            'TP_tomato_duration_field_cb',
            'TomatoPress_settings_page',
            'TomatoPress_settings_section',
            array
            (
                __('Set the duration for a single Tomato','TomatoPress')
            )
    );
    
    /************************
     * SHORT BREAK DURATION *
     ************************/
    add_settings_field
    (
            'short_break_duration',
            '<h4><label for="short_break_duration">'.__('Short Break Duration','TomatoPress').'</label></h4>', 
            'TP_short_break_duration_field_cb',
            'TomatoPress_settings_page',
            'TomatoPress_settings_section',
            array
            (
                __('Set the duration for the short break beetween tomatoes','TomatoPress')
            )
    );
    /***********************
     * LONG BREAK DURATION *
     ***********************/
    add_settings_field
    (
            'long_break_duration',
            '<h4><label for="long_break_duration">'.__('Long Break Duration','TomatoPress').'</label></h4>', 
            'TP_long_break_duration_field_cb',
            'TomatoPress_settings_page',
            'TomatoPress_settings_section',
            array
            (
                __('Set the duration for the long break after "x" tomatoes','TomatoPress')
            )
    );
    /******************************
     * TOMATOES BEFORE LONG BREAK *
     ******************************/
    add_settings_field
    (
            'tomatoes_before_long_break',
            '<h4><label for="tomatoes_before_long_break">'.__('Tomatoes Before Long Break','TomatoPress').'</label></h4>', 
            'TP_tomatoes_before_long_break_field_cb',
            'TomatoPress_settings_page',
            'TomatoPress_settings_section',
            array
            (
                __('Set how many Tomatoes must finish to have a long break','TomatoPress')
            )
    );
/*------------------------------------------------------------------------------
 *  FIELDS CALLBACK
 *----------------------------------------------------------------------------*/
    /*******************
     * TOMATO DURATION *
     *******************/
    function TP_tomato_duration_field_cb($args)
    {
        $options = get_option('TomatoPress');
        $html  = '<ul>';
        $html .=    '<li>';
        $html .=        '<select id="tomato_duration" name="TomatoPress[tomato_duration]">';
        for($i=300;$i<=3600;$i+=300){
            $html .=           '<option value="' . $i . '" '.selected($i, $options['tomato_duration'], FALSE).'>' . __(($i/60). ' minutes','TomatoPress') . '</option>';
        }
        $html .=        '</select>';
        $html .=        '<span class="description">' . __($args[0],'TomatoPress') . '</span>';
        $html .=    '</li>';
        $html .= '</ul>';        
        echo $html;
    }
    /************************
     * SHORT BREAK DURATION *
     ************************/
    function TP_short_break_duration_field_cb($args)
    {
        $options = get_option('TomatoPress');
        $html  = '<ul>';
        $html .=    '<li>';
        $html .=        '<select id="short_break_duration" name="TomatoPress[short_break_duration]">';
        for($i=60;$i<=600;$i+=60){
            $html .=           '<option value="' . $i . '" '.selected($i, $options['short_break_duration'], FALSE).'>' . ($i == 60 ? __('1 minute', 'TomatoPress') : __(($i/60). ' minutes','TomatoPress')) . '</option>';
        }
        $html .=        '</select>';
        $html .=     '<span class="description">' . __($args[0],'TomatoPress') . '</span>';
        $html .=    '</li>';
        $html .= '</ul>';
        
        echo $html;
    }
    /***********************
     * LONG BREAK DURATION *
     ***********************/
    function TP_long_break_duration_field_cb($args)
    {
        $options = get_option('TomatoPress');
        $html  = '<ul>';
        $html .=    '<li>';
        $html .=        '<select id="long_break_duration" name="TomatoPress[long_break_duration]">';
        for($i=300;$i<=3600;$i+=300){
            $html .=           '<option value="' . $i . '" '.selected($i, $options['long_break_duration'], FALSE).'>' . __(($i/60). ' minutes','TomatoPress') . '</option>';
        }
        $html .=        '</select>';
        $html .=        '<span class="description">' . __($args[0],'TomatoPress') . '</span>';
        $html .=    '</li>';
        $html .= '</ul>';
        
        echo $html;
    }
    /******************************
     * TOMATOES BEFORE LONG BREAK *
     ******************************/
    function TP_tomatoes_before_long_break_field_cb($args)
    {
        $options = get_option('TomatoPress');
        $html  = '<ul>';
        $html .=    '<li>';
        $html .=        '<select id="long_break_duration" name="TomatoPress[tomatoes_before_long_break]">';
        for($i=1;$i<=10;$i++){
            $html .=           '<option value="' . $i . '" '.selected($i, $options['tomatoes_before_long_break'], FALSE).'>'. ($i == 60 ? __('1 Tomato', 'TomatoPress') : __($i. ' Tomatoes','TomatoPress')). '</option>';
        }
        $html .=        '</select>';
        $html .=        '<span class="description">' . __($args[0],'TomatoPress') . '</span>';
        $html .=    '</li>';
        $html .= '</ul>';
        
        echo $html;
    }
/*------------------------------------------------------------------------------
 *  SETTINGS REGISTRATION
 *----------------------------------------------------------------------------*/
register_setting('TomatoPress', 'TomatoPress');
?>
