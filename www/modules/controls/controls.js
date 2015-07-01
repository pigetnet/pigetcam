"use strict";

$.fn.bootstrapSwitch.defaults.onColor = "success";
$.fn.bootstrapSwitch.defaults.offColor = "danger";
$(".switches").bootstrapSwitch();

//Manage Switches event
$(".switches").on("switchChange.bootstrapSwitch", function(event, state) {
    var control_id = event.target.dataset.id;
    var control_state = state;
    var url = "?controls&"+control_id;

    if (control_state) {
        url = url + "=start";
    } else {
        url = url + "=stop";
    }
    //$("#"+control_id+"_controls").bootstrapSwitch('toggleDisabled');
     //$("#"+control_id).bootstrapSwitch('toggleDisabled');
     sendRequest(url);
     //$("#"+control_id+"_controls").bootstrapSwitch('toggleDisabled');
  

});

//Manage buttons event
function buttonsClicked(button){
    button = $(button).data();
    console.log(button);
    var control_command = button.command;
    var control_id = button.id;
    var url = "?controls&"+control_id+"="+ control_command;
    sendRequest(url);
}

function sendRequest(url){
      //Ajax request to execute actions
    $.ajax ({
        url: url,
        dataType: "json"
    }).done(function (data){
        switch (data.err) {
        
        case 0:
            Notify("Action done!",data.out);
        break;

        default:
            Notify("Error "+data.err,data.out);
        break;
        }
    });
}