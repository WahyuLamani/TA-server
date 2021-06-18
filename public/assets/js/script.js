(function($) {
    "use strict"


    $('#todo_list').slimscroll({
        position: "right",
        size: "5px",
        height: "250px",
        color: "transparent"
    });

    $('#activity').slimscroll({
        position: "right",
        size: "5px",
        height: "350px",
        color: "transparent"
    });

    $('#reporting').slimscroll({
        position: "right",
        size: "5px",
        height: "500px",
        alwaysVisible: true,
        start: "bottom"
    });

    $('#agent-details').slimscroll({
        position: "right",
        size: "10px",
        height: "350px",
        // alwaysVisible: true,
        start: "top"
    });





})(jQuery);

// document.querySelector(".sweet-message").onclick=function(){swal(`ahahaha`)} 

