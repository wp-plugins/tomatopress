jQuery(document).ready(function($){
    
    //APPEND AND EXTRA DIV TO THE BODY
    $('body').append('<div id="TomatoPress_overlay">\n\
                        <div id="TomatoPress_timer_overlay">\n\
                            <p></p>\n\
                            <button id="TomatoPress_overlay_stop" class="button-secondary">Stop</button>\n\
                        </div>\n\
                      </div>');
    
/**********************************************************************************************************
* WORK VARIABLES                                                  											         *
***********************************************************************************************************/
    var tomatoId;
    var doneTomatoes = 0;
    var doneTomatoesShown = 0;
    var timerActive = false;
    
/**********************************************************************************************************
* WRAPPER VARIABLES                                                  											         *
***********************************************************************************************************/
    var startButton = $('#TomatoPress_start');
    var stopButton = $('#TomatoPress_stop, #TomatoPress_overlay_stop');
    var resetButton = $('#TomatoPress_reset');
    var timerP = $('#TomatoPress_timer p');
    var timerOverlayP = $('#TomatoPress_timer_overlay p');
    var counterText = $('#TomatoPress_counters p span');
    
	
/**********************************************************************************************************
* FUNCTIONS TO INITIALIZE METABOX VALUES											         *
***********************************************************************************************************/
    counterText.text(doneTomatoes);
    buttonsEnableToggler();
    tomatoTimer(tomatoDuration,timerP);
    
    

    
    function padZero(num)
    {
        return (num < 10 ? '0' : '') + num;
    }
    
    
    function tomatoTimer(duration,whereToCount)
    {
        var minutes = padZero(Math.floor(duration/60));
        var seconds = padZero(Math.floor(duration%60));
        whereToCount.text(minutes + ':' + seconds);
    }
    
/**********************************************************************************************************
* TIMING FUNCTIONS															         *
***********************************************************************************************************/
    //This function is used to start the "work timer"
	function startTomato()
    {
       $('#TomatoPress_overlay').fadeOut('slow'); 
       var elapsedTime = tomatoDuration;
       tomatoTimer(elapsedTime,timerP);
           tomatoId = setInterval(function(){
                if(elapsedTime > 0)
                {
                    elapsedTime--;
                }else{
                    clearInterval(tomatoId);
                    doneTomatoes++;
                    counterText.text(++doneTomatoesShown);
                    startBreak();
                    return;
                }
                tomatoTimer(elapsedTime,timerP);
           },1000);
    }
    
    //This function is used to start the "break timer"
    function startBreak()
    {   
        showOverlay();
        var elapsedTime;
        if(doneTomatoes == tomatoesBeforeLongBreak)
        {
            doneTomatoes = 0;
            elapsedTime = longBreakDuration;
        }else{
            elapsedTime = shortBreakDuration;
        }
        
        tomatoTimer(elapsedTime,timerOverlayP);
        tomatoId = setInterval(function(){
            if(elapsedTime > 0)
            {
                elapsedTime--;
            }else{
                clearInterval(tomatoId);
                startTomato();
                return;
            }
            tomatoTimer(elapsedTime,timerOverlayP);
        },1000);
    }
/*******************************************************************************
* BUTTONS FUNCTIONS                                                            *							         *
********************************************************************************/
    /****************************************************************************************************
	* THIS FUNCTION TOGGLES THE "DISABLED" ATTRIBUTE FROM START AND STOP BUTTONS		        *
	*****************************************************************************************************/
	function buttonsEnableToggler()
    {
        if(timerActive == true)
        {
            startButton.attr('disabled','disabled');
            stopButton.removeAttr('disabled');
        }else if(timerActive == false){
            startButton.removeAttr('disabled');
            stopButton.attr('disabled', 'disabled');
        }
    }
    
    startButton.click(function(event){
        event.preventDefault();
        timerActive = true;
        buttonsEnableToggler();
        startTomato();
    });
    
    
    stopButton.click(function(event){
       event.preventDefault();
       if($('#TomatoPress_overlay').is(':visible')){
           $('#TomatoPress_overlay').fadeOut('slow');
       }
       timerActive = false;
       buttonsEnableToggler();
       clearInterval(tomatoId);
       tomatoTimer(tomatoDuration, timerP);  
    });
    
     resetButton.click(function(event){
       event.preventDefault();
       doneTomatoes = 0;
       doneTomatoesShown = 0;
       counterText.text(doneTomatoesShown); 
       $('#TomatoPress_stop').click();
     })
/*******************************************************************************
* OVERLAY FUNCTIONS                                                            *							         *
********************************************************************************/  
     function showOverlay()
     {
         var height = $(document).height();
         $('#TomatoPress_overlay').css('height', height+'px').fadeIn('slow');
     }
})
