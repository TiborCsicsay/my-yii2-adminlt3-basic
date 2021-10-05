console.log("DeleteSelected.js");

$("#deletSelectedModalButt").on("click", function(){
    $.pjax.reload({container:"#modal_content"});
     //var selected = $("#gridid").yiiGridView("getSelectedRows");
     // $('.modalContent').html(selected[0]);
    // $.ajax({
    //     url:  'index',
    //     type: 'POST',
    //     data: {keylistt: selected}
    //     // success: function(){
    //     //     alert("posted");
    //     // }
    // })
    $('#deleteModal').modal('show');
});

$("document").ready(function(){
    $("#pjax_form").on("pjax:end", function() {
        $.pjax.reload({container:"#modal_content"});  //Reload GridView
    });
});