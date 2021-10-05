console.log("CustomAction.js");

var customAction;

(function ($) {
    customAction = function (buttonId,url,type) {
        $("#"+buttonId).on("click", function(){
            var selected = $("#gridid").yiiGridView("getSelectedRows");
            $.ajax({
                url:  url,
                type: type,
                data: {keylist: selected}
            })
            // success: function(){
            //     alert("yes");
            // }
        });
    }
})(window.jQuery);