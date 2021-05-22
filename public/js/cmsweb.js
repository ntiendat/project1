
(function ($) {


    $('#check_all').on('click', function(e) {

        if($(this).is(':checked',true))  {
            $(".checkbox").prop('checked', true);  
        } else {  
            $(".checkbox").prop('checked',false);  
        }  

    });

    $('.checkbox').on('click',function() {
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#check_all').prop('checked',true);
        }else{
            $('#check_all').prop('checked',false);
        }
     });

    $(function () {
        var $chk = $("#checkboxes input:checkbox"); 
        var $tbl = $("#someTable");
        var $tblhead = $("#someTable th");

        $chk.prop('checked', true); 

        $chk.click(function () {

            var colToHide = $tblhead.filter("." + $(this).attr("name"));
            var index = $(colToHide).index();

            $tbl.find('tr :nth-child(' + (index + 1) + ')').toggle();
        });
    });

})(jQuery)


var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

function showMessage(message,type) {

    if (type == 1) {
        notify("<div style='font-size:15px'><i class='fa fa-check'></i>" + message + " </div>",'success');
    } else {
        notify("<div style='font-size:15px'><i class='fa fa-check'></i> " + message + " </div>",'error');
    }
  
}  







     



