document.addEventListener("DOMContentLoaded", function() {
    var lazyImages = document.querySelectorAll('img[lazy-images]');
    function handlerLazyLoadImages() {
        Array.prototype.forEach.call(lazyImages, function(img) {
            if ((img.getBoundingClientRect().top <= window.innerHeight && img.getBoundingClientRect().bottom >= 0) && getComputedStyle(img).display != 'none') {
                setImage(img);
            }
        });
        lazyImages = document.querySelectorAll('img[lazy-images]:not([data-loaded="true"])');
    }
    function setImage(img) {
        img.setAttribute('data-loaded', 'true');
        $.get(img.getAttribute('lazy-images'), function(){
            img.setAttribute('src', img.getAttribute('lazy-images'));
            img.removeAttribute('lazy-images');
            img.removeAttribute('data-loaded');
        });
    }
    handlerLazyLoadImages();
    document.addEventListener('scroll', handlerLazyLoadImages);
    window.addEventListener("resize", handlerLazyLoadImages);
    window.addEventListener("orientationchange", handlerLazyLoadImages);
});

$(function() {

    //for ie8
    var alertFallback = false;
    if (typeof console === "undefined" || typeof console.log === "undefined") {
        console = {};
        if (alertFallback) {
            console.log = function(msg) {
                alert(msg);
            };
        } else {
            console.log = function() {};
        }
    }

    $('table').wrap('<div class="table-responsive">');
});

function SetImagePage(e) {
    console.log(e);
}

$(document).ready(function() {

    $('input[type="tel"]').inputmask('+7 (999) 999-99-99');

    $('.js-init-clear__cart').on('click', function(e){
        e.preventDefault();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            data: {
                'action': 'clear_all'
            },
            success: function (response) {
                console.log(response);
            }
        });
        return false;
    });

    $('.js-init__menu').on('click', function(){
        if($(this).hasClass('fixed')){
            $.arcticmodal('close');
        }
        $('.head-nav__modal').arcticmodal({
            overlay: {
                css: {
                    backgroundColor: '#fff',
                    opacity: 1
                }
            },
            beforeOpen: function() {
                $('.head-nav__modal').show().addClass('animated').addClass('slideInUp');
                $('.js-init__menu').addClass('box-modal_close').addClass('fixed');
            },
            afterOpen: function() {
                openModalFix();
            },
            beforeClose: function() {
                $('.js-init__menu').removeClass('fixed').removeClass('box-modal_close');
                $('.head-nav__modal').removeClass('slideInUp').addClass('slideOutDown');
                closeModalFix();
            },
            afterClose: function () {
                $('.head-nav__modal').hide().removeClass('slideOutDown').removeClass('animated');
            }
        });
    });


    $('.settings__panel-nav ul').on('click', 'li:not(.active)', function() {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('.settings__panel').find('.settings__panel-content').removeClass('active').eq($(this).index()).addClass('active');
    });

    $('.hrefpop').fancybox({
        'overlayOpacity' : 1,
        'autoDimensions'	: false,
        'width'         		: 350,
        'height'        		: 500,
        'padding': 0
    });

    $('.navN .firstpage').attr('title', 'На первую');
    $('.navN .lastpage').attr('title', 'На последнюю');
    $('.navN .nextpage').attr('title', 'На следующую');
    $('.navN .prevpage').attr('title', 'На предыдущую');

    // img alt fix
    $('img').each(function () {
        if (!$(this).attr('alt')) {
            $(this).attr('alt', "");
        }
    });
    $(document).on('click', '.js-init_more_menu', function () {
        return false;
    });

    var sPanelNav = $('.settings__panel-nav');
    var sPanelContent = $('.settings__panel-content');
    var applySetting = $('.js-init_apply_settings');

    $(document).on('click', '.js-init-modal__form', function () {
        $.arcticmodal({
            type: 'ajax',
            url: '/local/tools/ajax_form.php',
            overlay: {
                css: {
                    backgroundColor: '#000',
                    opacity: .65
                }
            },
            afterOpen: function() {
                openModalFix();
            },
            beforeClose: function() {
                closeModalFix();
            },
            afterLoadingOnShow: function (data, el) {
                $('.arcticmodal-container .callback__modal-form').addClass('modal__window');
            },
            ajax: {
                type: 'GET',
                data: {
                    ajax_form: $(this).data('modal') || null,
                    sign: $(this).data('sign') || null
                },
                cache: false,
                dataType: 'html',
                success: function (data, el, responce) {
                    data.body.html(responce);

                    $(":input").inputmask();

                    $('.modal__form').off('submit').on('submit', function (e) {
                        e.preventDefault();
                        $('.modal__box').closest('div').prepend('<div class="arcticmodal-loading"></div>');
                        $.ajax({
                            type: 'GET',
                            url: $(this).attr('action') || window.location.href,
                            data: $(this).serialize(),
                            dataType: 'json',
                            success: function(response) {
                                /*console.log(response);*/
                                $('.arcticmodal-loading').detach();
                                $('.form__group').each(function(){
                                    $(this).removeClass('error');
                                });
                                if (response['error']) {
                                    $.each(response['error'], function(code, val){
                                        $('#' + code).attr('placeholder', val).closest('.form__group').addClass('error');
                                    });
                                }
                                if (response['success']) {
                                    $('.modal__content').empty()
                                        .append('<div class="modal__box-title">' + response['success'] + '</div>')
                                        .append('<p class="modal__content-text">Наш менеджер свяжется с Вами в ближайшее время</p>');

                                }
                                $('.error input').focus(function () {
                                    $(this).attr('placeholder', '').closest('.form__group').removeClass('error');
                                });
                                $('.error input[type="checkbox"]').on('click', function(){
                                    if($(this).prop('checked')){
                                        $(this).closest('.form__group').removeClass('error');
                                    }
                                });
                                $(":input").inputmask();

                            }
                        });
                        return false;
                    });
                }
            }
        });
        return false;
    });

    //detail product tabs
    $('.product__tabs-head').on('click', 'li:not(.active)', function() {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('.product__tabs').find('.tab__content').removeClass('active').eq($(this).index()).addClass('active');
    });

    $('.form__group.error input').keyup(function () {
        $(this).closest('.form__group').removeClass('error');
    });
});

function modalClose(event) {
    if (typeof(event) != "undefined") {
        event.preventDefault();
    }
    $.arcticmodal('close');
}


function fz152Module() {
    var baseUrl = '',
        modalClass = 'js-cookie--modal';

    return {
        run: function (apiUrl, cancelUrl) {
            var modal = $('.' + modalClass);
            baseUrl = apiUrl;

            modal.find('.js-confirm').on('click', function (event) {
                event.preventDefault();
                $.get(baseUrl, {}, function () {});
                modal.hide();

                return false;
            });

            modal.find('.js-cancel').on('click', function () {
                document.location.href = cancelUrl;
            });
        },
        init: function (content) {
            var modal = '<div class="modal__box c-fz152__block ' + modalClass + '">';
            modal += content;
            modal += '<div class="c-fz152__buttons">';
            modal += '<div class="c-fz152__buttons-block c-fz152__buttons--left">';
            modal += '<span class="c-fz152__button c-fz152__button--confirm js-confirm modal__close"></span>';
            modal += '</div>';
            modal += '<div class="c-fz152__buttons-block c-fz152__buttons--right">';
            modal += '<span class="c-fz152__button c-fz152__button--cancel js-confirm btn btn-default">Согласен</span>';
            modal += '</div>';
            modal += '</div>';

            $('body').append(modal);
        }
    };
}

//input number
$(function() {

    (function quantityProducts() {

        $(document).on("click", ".quantity-arrow-minus", quantityMinus);
        $(document).on("click", ".quantity-arrow-plus", quantityPlus);


        function quantityMinus(e) {
            var num = $(e.target).siblings('.quantity-num');
            if (num.val() > 1) {
                num.val(+num.val() - 1);
            }
            num.change();

            return false;
        }

        function quantityPlus(e) {
            var num = $(e.target).siblings('.quantity-num');
            num.val(+num.val() + 1);
            num.change();

            return false;
        }

    })();



});



function openModalFix() {
    var modalMoreHeight = 0;
    if (window.innerWidth < 575) {
        $('.page').css({
            'max-height': '100vh',
            'overflow': 'hidden'
        });
        modalMoreHeight = 50;
    }
    setTimeout(function() {
        if (document.querySelector('.arcticmodal-container_i2 > div') != null) {
            var height = document.querySelector('.arcticmodal-container_i2 > div').getBoundingClientRect().height+modalMoreHeight+'px';
            $('.arcticmodal-container .arcticmodal-container_i2 > div').css('height', height);
        }
    }, 1000);
}

function closeModalFix() {
    $('.page').css({
        'max-height': 'none',
        'overflow': 'auto'
    });
}

if($('#cart__page-select').length > 0) {
    var cartSelect = new customSelect({
        elem: 'cart__page-select'
    });
}
