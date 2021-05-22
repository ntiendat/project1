$(document).ready(function() {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        interval: 4000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })

    


    $('.icon-close-cart').click(function() {
        // var h = $(window).scrollTop();
        $('.wp-on-cart').removeClass('show-cart');
        $('#check-overlay').removeClass('overlay');

        return false;
    });
    $('#wrapper').click(function() {
        $('.wp-on-cart').removeClass('show-cart');
        $('#check-overlay').removeClass('overlay');


    });


    $(window).scroll(function() {
        $('.wp-on-cart').removeClass('show-cart');
        $('#check-overlay').removeClass('overlay');
        $('.wp-on-cart').css("top", 0);
    });



    //lấy img đầu tiên đặt lm show mặc định
    var first_link_img = $(".thumb-item:first-child img").attr('src');

    //hiển src của mỗi ảnh khi click vào 
    $('.thumb-item a').click(function() {
        var link_img = $(this).children().attr('src');
        // hiển thị ảnh đã lấy lên show 
        $('#show img').attr('src', link_img);
        // console.log(link_img);
        $('.thumb-item a ').removeClass('active-thumb');
        $(this).addClass('active-thumb');
        return false;
    });



});