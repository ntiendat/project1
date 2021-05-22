
<script>
    $(".menu-item").mouseenter(function(){
        $(this).children(".sub-menu").show();
    });
    $(".menu-item").mouseleave(function(){
        // console.log('ád')
        $(this).children('.sub-menu').css('display','none');
    });
</script>
