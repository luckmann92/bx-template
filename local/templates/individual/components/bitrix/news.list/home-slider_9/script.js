$(document).ready(function() {
    $('.slider-home[data-autoheight = false]').on('setPosition', function () {
        $(this).find('.slick-slide').height('auto');
        var slickTrack = $(this).find('.slick-track');
        var slickTrackHeight = $(slickTrack).height();
        $(this).find('.slick-slide').css('height', slickTrackHeight + 'px');
    });

    $('.slider-home').slick({
        dots: false,
        arrows: ($('.slider-home').attr('data-arrows') == 'true') ? true : false,
        autoplay: ($('.slider-home').attr('data-autoplay') == 'true') ? true : false,
        autoplaySpeed:$('.slider-home').attr('data-speed'),
        appendDots: $('.slider-home-dots'),
        prevArrow: '<button type="button" class="slide-prev slick-prev"></button>',
        nextArrow: '<button type="button" class="slide-next slick-next"></button>',
        appendArrows: $('.slider__arrows-box'),
        adaptiveHeight: true,
        responsive:[
            {
                breakpoint: 576,
                settings: {
                    arrows: false,
                    dots: true
                }
            }
        ]
    });
});