$(document).ready(function() {
    $('.slider-home[data-autoheight = false]').on('setPosition', function () {
        $(this).find('.slick-slide').height('auto');
        var slickTrack = $(this).find('.slick-track');
        var slickTrackHeight = $(slickTrack).height();
        $(this).find('.slick-slide').css('height', slickTrackHeight + 'px');
    });
    $('.slider-home').slick({
        dots: false,
        arrows: false,
        autoplay: ($('.slider-home').attr('data-autoplay') == 'true') ? true : false,
        autoplaySpeed:$('.slider-home').attr('data-speed'),
        appendDots: $('.slider-home-dots'),
        fade: true,
        appendArrows: $('.slider__arrows-box'),
        speed: 300,
        adaptiveHeight: true
    });
    
    $('.slider-home__next').click(function(){
        $('.slider-home').slick("slickNext");
    });
    $('.slider-home__prev').click(function(){
        $('.slider-home').slick("slickPrev");
    });

    /*function topOffset() {
        var top = document.querySelector('.slider-home .slick-current .slide-item__bottom').offsetTop + 115 + 50;
        document.querySelector('.slider-home+.slider__arrows').style.transform = 'translateY(' + top + 'px)';
    }

    $('.slider-home').on('afterChange', function(event, slick, currentSlide, nextSlide){
        topOffset();
    });*/




});