"use strict";
var paused = true;

function camera_refresh(){
    $("#stream").attr("src", "modules/camera/snapshot.php?"+new Date().getTime());
}

$( "#stream").load(function(){
    //console.log("Image loaded");
//  refresh_rate = (new Date() - start);
//  refresh_rate_seconds = Math.round(1/(refresh_rate / 1000))
//  $("#frame_rate_icon").html(refresh_rate_seconds + " fps");
    if(!paused){
        camera_refresh();
    }
});


function camera_play(){
    
    if(paused){
        $("#playstop").attr("class","glyphicon glyphicon-stop");
             //refresh the image every refresh_rate seconds
            // timer = setInterval(refresh, refresh_rate);
        camera_refresh();
        paused = false;
    }
    else
    {
        $("#playstop").attr("class","glyphicon glyphicon-play");
        paused = true;
    }
    //console.log(paused);
}

//Manage Fullscreen
$(function() {
    // open in fullscreen
    $("#fullscreen").click(function() {
        $("#stream").fullscreen();
        return false;
    });
    // exit fullscreen when you click on the image
    $("#stream").click(function() {
        $.fullscreen.exit();
        return false;
    });
    
});