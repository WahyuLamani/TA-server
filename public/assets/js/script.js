(function ($) {
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

    $('#agent-details').slimscroll({
        position: "right",
        size: "10px",
        height: "350px",
        // alwaysVisible: true,
        start: "top"
    });

    $('#posts-agent').slimscroll({
        position: "right",
        size: "10px",
        height: "300px",
        // alwaysVisible: true,
        start: "top"
    });
    $('#posts-distributor').slimscroll({
        position: "right",
        size: "10px",
        height: "300px",
        // alwaysVisible: true,
        start: "top"
    });
    $('#profile').slimscroll({
        position: "right",
        size: "10px",
        height: "300px",
        // alwaysVisible: true,
        start: "top"
    });





})(jQuery);


$("#toastr-export-agents").on("click", function () {
    toastr.success("Export data Agent berhasil", "Export Excel !",
        {
            timeOut: 5e3, closeButton: !0, debug: !1, newestOnTop: !0, progressBar: !0, positionClass: "toast-top-right", preventDuplicates: !0, onclick: null, showDuration: "300", hideDuration: "1000", extendedTimeOut: "1000", showEasing: "swing", hideEasing: "linear", showMethod: "fadeIn", hideMethod: "fadeOut", tapToDismiss: !1
        })
})

// document.querySelector(".sweet-message").onclick=function(){swal(`ahahaha`)} 

