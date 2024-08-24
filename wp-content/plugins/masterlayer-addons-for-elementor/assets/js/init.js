(function($) {
    'use strict';

    var counter = function() {
        $('.master-counter').each(function() {
            var $this = $(this);

            $this.appear(function() {
                $this.find('.number').countTo();
            });
        });
    };

    var progressBar = function() {
        $('.master-progress-bar').each(function() {
            var
            t = $(this),
            v = t.find(".progress"),
            p = v.data('percent');

            t.appear(function() {
                v.css({
                    'width': p
                }, "slow");
            });
        });
    };

     var popupVideo = function() {
        $('.popup-video').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: true
        });
    };

    var inViewport =  function() {
        $('[data-in-viewport="true"]').appear(function() {
            $(this).addClass('is-in-view');
        });
    };

    var tabs = function() {
        $('.master-tabs').each(function() {
            var t = $(this),
            number = t.find('.tab-link-wrap').length;

            t.find('.tab-link-wrap li').css('max-width', (100 / 3) + '%').first().addClass('active');
            t.find('.tab-content').first().addClass('active');
        });

        $('.tab-link-wrap li').on('click', function() {
            var
            t = $(this),
            id = t.attr('data-tab');

            t.addClass('active')
                .siblings().removeClass('active')
                .closest('.master-tabs')
                .find('.tab-content').removeClass('active').hide();
            $("#" + id).addClass('active').fadeIn("slow");
        });
    };

    var parallaxImage =  function() {
        $('.master-parallax-box').each(function() {
            var
            p = $(this).find('.parallax-wrap'),
            item = $(this).find(".master-parallax-item");

            function calcHeight(){
                var arr = [];
                $(p).waitForImages(function() {
                    item.each(function() {
                        var t = $(this),
                            top = $(this).data("top");

                        if (top.indexOf("%") >= 0) {
                            var total = t.height()/(100 - parseFloat(top))*100;
                            arr.push(total);
                        } else {
                            arr.push(parseInt(top) + t.height());
                        }
                    });

                    $(p).css("height", Math.max.apply(null, arr));
                });
            }       

            $(window).resize(calcHeight);
            calcHeight();
        })
        
    };

    var carousel = function() {
        $(".master-carousel-box").masterCarouselBox();
    }

    var portfolio = function() {
        $(".master-portfolio").masterPortfolio();
    }

    var link = function() {
        $(".master-link").masterLink();
    }

    var icon = function() {
        $(".master-icon").masterIcon();
    }


    // Settings for page
    // var mae_header_style = function( newValue ) {
    //     $('body').alterClass("header-style-*", "header-" + newValue);
    // }

    var mae_custom_logo = function( newValue ) {
        $('#site-logo img').attr("src", newValue['url']);
    }

    var mae_featured_title_bg = function( newValue ) {
        $('#featured-title').css('background-image', 'url(' + newValue['url'] + ')' );
    }

    var mae_custom_featured_title = function( newValue ) {
        $('#featured-title .main-title').text(newValue);
    }
    /**
     * Elementor JS Hooks
     */
    $(window).on("elementor/frontend/init", function() {

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-counter.default", counter);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-gallery-carousel.default", carousel);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-service-carousel.default", carousel);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-team-carousel.default", carousel);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-project-carousel.default", carousel);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-news-carousel.default", carousel);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-partner-carousel.default", carousel);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-testimonial-carousel.default", carousel);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-tabs.default", tabs);

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-project-grid.default", portfolio);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-progress-bar.default", progressBar);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-video-icon.default", popupVideo);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-fancy-image.default", popupVideo);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-fancy-image.default", inViewport);
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-parallax-image.default", parallaxImage);


        if ( typeof elementor != "undefined" && typeof elementor.settings.page != "undefined" ) {
            //elementor.settings.page.addChangeCallback( 'header_style', mae_header_style );
            elementor.settings.page.addChangeCallback( 'custom_logo', mae_custom_logo );
            elementor.settings.page.addChangeCallback( 'featured_title_bg', mae_featured_title_bg );
            elementor.settings.page.addChangeCallback( 'custom_featured_title', mae_custom_featured_title );
        }
    
    });


})(jQuery);
