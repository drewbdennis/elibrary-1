jQuery(document).ready(function($){
    $("a.delete_book").click(function(e){
        var shouldDelete = confirm("Are you sure ?");
        if(!shouldDelete){
            e.preventDefault();
        }
    });
    $( "#born , #died" ).datepicker({
        dateFormat : 'yy-mm-dd'
    });
});