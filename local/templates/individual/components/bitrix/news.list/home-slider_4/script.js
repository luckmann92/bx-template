$(document).ready(function() {
    $('.slider-home[data-autoheight = false]').on('setPosition', function () {
        $(this).find('.slick-slide').height('auto');
        var slickTrack = $(this).find('.slick-track');
        var slickTrackHeight = $(slickTrack).height();
        $(this).find('.slick-slide').css('height', slickTrackHeight + 'px');
    });

    $('.slider-home').slick({
        dots: false,
        autoplay: ($('.slider-home').attr('data-autoplay') == 'true') ? true : false,
        autoplaySpeed:$('.slider-home').attr('data-speed'),
        appendDots: $('.slider-home-dots'),
        fade: true,
        arrows: false,
        adaptiveHeight: true,
        responsive:[
            {
                breakpoint: 576,
                settings: {
                    dots: true
                }
            }
        ]
    });
    
    $('.slider-home__next').click(function(){
        $('.slider-home').slick("slickNext");
    });
    $('.slider-home__prev').click(function(){
        $('.slider-home').slick("slickPrev");
    });
    
    $('.slider-links__box').slick({
        dots: false,
        arrows: false,
        autoplay: false,
        adaptiveHeight: true,
        vertical: true,
        verticalSwiping: true,
        slidesToShow: 3,
        ariableWidth: true,
        responsive:[
            {
                breakpoint: 992,
                settings: {
                    vertical: false,
                    verticalSwiping: false,
                    slidesToShow: 1,
                    centerMode: true
                }
            },
            {
                breakpoint: 576,
                settings: {
                    vertical: true,
                    verticalSwiping: true,
                    slidesToShow: 3,
                    centerMode: false
                }
            }
        ]
    });
});