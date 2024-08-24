// Carousel Box
(function($, window, document, undefined) {
    "use strict";

    var masterCarouselBox = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config");
    };

    masterCarouselBox.prototype = {
        defaults: {
            contain: !1,
            imagesLoaded: !0,
            arrowShape: "M38.1,47.1L35.2,50l22.6,22.6l2.8-2.8L40.9,50l19.7-19.7l-2.8-2.8L46.5,38.7L38.1,47.1z",
            // M8,12.1l8.7-8.7c0.3-0.3,0.3-0.8,0-1.1c-0.3-0.3-0.8-0.3-1.1,0l-9.2,9.2c-0.3,0.3-0.3,0.8,0,1.1l9.2,9.2c0.3,0.3,0.8,0.3,1.1,0s0.3-0.8,0-1.1L8,12.1z

            percentPosition: !1,
            adaptiveHeight: !1,
            cellAlign: "left",
            groupCells: !0,
            dragThreshold: 20,
            wrapAround: !1,
            autoPlay: !1,
            navArrow: 1,
            filters: !1,
            equalHeightCells: !1,
            randomVerOffset: !1,
            draggable: !0,

            column: 3,
            gap: "30px",
            fullRight: !1,
            prevNextButtons: !1,
            arrowStyle: "arrow-style-1",
            arrowPosition: "middle",
            arrowMiddleOffset: "0px",
            arrowTopOffset: "40px",
            pageDots: !1,
            dotStyle: "dot-style-1",
            dotOffset: "40px",
            filter: !1
        },
        init: function() {
            this.args = $.extend({}, this.defaults, this.opts, this.config);
            this.build();
            this.event();
            return this;
        },
        build: function() {
            var
            t = this,
            css = "",
            cls = "",
            arr = [],
            a = t.args.column,
            b = t.args.gap,
            c = t.args.fullRight,
            d = t.args.prevNextButtons,
            e = t.args.arrowStyle,
            f = t.args.arrowPosition,
            g = t.args.arrowMiddleOffset,
            h = t.args.arrowTopOffset,
            i = t.args.arrowShape,
            j = t.args.pageDots,
            k = t.args.dotStyle,
            l = t.args.dotOffset,
            m = t.args.filter,
            n = t.args.fullRightOpacity,
            z = t.$elm.attr("class").split(" ");

            $(z).each(function(i, e) { 
                e.indexOf("mlr-") == 0 && (cls = "." + z[0] + "." + e)
            })

            if (m) {
                var id = "filter-" + (new Date).getTime();
                t.$elm.alterClass("filter-*", id)
                t.filter(id)
            }

            t.$elm.alterClass("column-*", "column-" + a + "-gap-" + b),
            t.$elm.alterClass("gap-*", "gap-" + b),
            t.$elm.alterClass("arrow-style-*", "arrow-style-" + a + "-gap-" + b),
            t.$elm.alterClass("arrow-position-*", "arrow-position-" + f),
            j && t.$elm.alterClass("bullets-*", "bullets-" + l)

            if ( !t.$elm.find('.flickity-viewport').length ) {
                t.$elm.children().addClass("item-carousel")  
            }
            t.$elm.waitForImages(function() {
                t.$elm.flickity(t.args);
            })
            
            c && (n = n ? "opacity:" + n + ";" : "",
                css += cls + " .item-carousel {" + n + "}",
                css += "@media screen and (max-width: 767px) {" + cls + " .item-carousel {" + "opacity:0;" + "}}"),

            css += cls + " .item-carousel.is-selected {" + "opacity:1;" + "}\n",
            css && $("#master-dynamic").length
                ? ((arr = $("#master-dynamic").html().split("\n")),
                  $.each(arr, function(i, e) {
                      e && e.indexOf(cls) > -1 && arr.splice(e, 1)
                  }),
                  $("#master-dynamic").empty().append(arr.join("\n")).append(css))
                : $("head").append("<style type='text/css' id='master-dynamic'>" + css + "</style>")

            t.$elm.waitForImages(function() { 
                var
                u = $(t.elm).data("flickity");
                if (u) {
                    var
                    v = u.size.width,
                    w = $(u.viewport),
                    x = window.innerWidth - (v + w.offset().left),
                    y = $("<div />").addClass("flickity-aside-wrap");

                    c && w.wrap(y).css("overflow", "visible")
                    .parent().css({"padding-right": x, "margin-right": -x, "overflow": "hidden"})
                }
                
            })  
        },
        filter: function(id) {
            var
            t = this,
            css = "",
            cls = "#" + id,
            arr = [],
            a = t.args.filterAll,
            b = t.args.filterCat,
            c = b.split(","),
            d = t.args.filterAlign,
            e = t.args.filterMargin,
            f = t.args.filterMarginMobi,
            g = t.args.filterMarginSmobi,
            y = $('<div class="master-spacer" data-config=\'{"desktop": "50px", "mobi": "50px", "smobi": "50px"}\'></div>'),
            z = $("<div />").attr("id", id).addClass("carousel-filter");
            
            t.$elm.before(z)
            a && $('<div class="filter-item" data-filter="*">All</div>').appendTo(z)
            for (var i1 = 0; i1 < c.length; i1++) {
                $('<div class="filter-item" data-filter="' + c[i1].replace(" ", "-").toLowerCase() + '">' + c[i1] + '</div>').appendTo(z)
            }

            d && z.alterClass("align-*", "align-" + d)
            e = e ? "margin:" + e + ";" : "",
            f = f ? "margin:" + f + ";" : "",
            g = g ? "margin:" + g + ";" : "",

            f ? css += "@media screen and (max-width: 991px) and (min-width: 768px) {" + cls + " {" + f + "}}" : css += "",
            g ? css += "@media only screen and (max-width: 767px) {" + cls + " {" + g + "}}" : css += "",
            css += cls + " {" + e + "}\n",

            css && $("#master-dynamic").length
                ? ((arr = $("#master-dynamic").html().split("\n")),
                  $.each(arr, function(i, e) {
                      e && e.indexOf(cls) > -1 && arr.splice(e, 1)
                  }),
                  $("#master-dynamic").empty().append(arr.join("\n")).append(css))
                : $("head").append("<style type='text/css' id='master-dynamic'>" + css + "</style>")
        },
        event: function() {
            var 
            t = this;

            // Filter
            $(".carousel-filter .filter-item").on("click", function() {
                var 
                a = $(this).parent().attr("id"),
                b = $(this).data("filter");
                
                if (b !== "*") {
                    var
                    c = $("." + a + " .item-carousel").not("." + b),
                    d = $("." + a + " .item-carousel." + b);
                    c.hide()
                    d.show()
                } else {
                    $("." + a + " .item-carousel").show()
                }

                // Remove other element before destroy
                $("." + a).find(".ctr-edit").remove(),
                t.args.fullRight && t.$elm.find(".flickity-viewport").unwrap()

                t.$elm.flickity("destroy");
                t.$elm.waitForImages(function() {
                    t.$elm.flickity(t.args);
                })
                
                t.$elm.waitForImages(function() { 
                    if (t.args.fullRight) {
                        var
                        u = $(t.elm).data("flickity"),
                        v = u.size.width,
                        w = $(u.viewport),
                        x = window.innerWidth - (v + w.offset().left),
                        y = $("<div />").addClass("flickity-aside-wrap");

                        var z = $("<div />").addClass("flickity-aside-wrap");
                        t.$elm.find(".flickity-viewport").wrap(y).css("overflow", "visible")
                            .parent().css({"padding-right": x, "margin-right": -x, "overflow": "hidden"})
                    }
                })           
            })

            // Position
            var selected = t.$elm.find('.item-carousel.is-selected');
            selected.first().addClass('left');
            selected.last().addClass('right');

            // Selected change
            t.$elm.on( 'select.flickity', function( event, index ) {
                var selected = t.$elm.find('.item-carousel.is-selected'),
                    item = t.$elm.find('.item-carousel');

                item.removeClass('left right');
                selected.first().addClass('left');
                selected.last().addClass('right');                  
            });

            // Center
            if ( t.$elm.cellAlign == 'center' ) {
                var selected = t.$elm.find('.item-carousel.is-selected'),
                    item = t.$elm.find('.item-carousel');

                // Init
                if ( selected.length > 1 ) {
                    var column = selected.length,
                        centerIndex = selected.index() + Math.floor(column/2);
                    item.removeClass('center');
                    item.eq(centerIndex).addClass('center');
                } else {
                    item.removeClass('center');
                    selected.addClass('center');
                }

                // Selected change
                t.$elm.on( 'select.flickity', function( event, index ) {
                    var selected = t.$elm.find('.item-carousel.is-selected'),
                        item = t.$elm.find('.item-carousel');

                    if ( selected.length > 1 ) {
                        var column = selected.length,
                        centerIndex = selected.index() + Math.floor(column/2);
                        item.removeClass('center');
                        item.eq(centerIndex).addClass('center');
                    } else {
                        $(item).removeClass('center');
                        $(selected).addClass('center');
                    }                    
                });
            }
        }
    };

    masterCarouselBox.defaults = masterCarouselBox.prototype.defaults;

    $.fn.masterCarouselBox = function(opts) {
        return this.each(function() {
            new masterCarouselBox(this, opts).init();
        });
    };
}(jQuery, window, document));

// Project Grid
(function( $, window, document, undefined ) {
    "use strict";

    var masterPortfolio = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config" );
    };

    masterPortfolio.prototype = {
        defaults: {
            filters: ".projects-filter",
            layoutMode: "grid",
            defaultFilter: "*",
            gapHorizontal: 30,
            gapVertical: 30,
            showNavigation: !0,
            showPagination: !0,
            gridAdjustment: "responsive",
            rewindNav: !1,
            auto: !1,
            mediaQueries: [{
                width: 1200,
                cols: 4,
            }, {
                width: 992,
                cols: 3,
            }, {
                width: 768,
                cols: 2,
            }, {
                width: 480,
                cols: 1,
            }],
            columns: "5,3,2,1",
            filterStyle: "filter-style-1",
            filterColor: "light",
            filterMargin: "0px 0px 50px 0px",
            displayType: 'bottomToTop',
            displayTypeSpeed: 100
        },
        init: function() {
            this.args = $.extend({}, this.defaults, this.opts, this.config);
            this.build();
            return this;
        },
        build: function() {
            var
            t = this,
            css = "",
            cls = "",
            arr = [],
            a = t.config.columns,
            b = t.args.mediaQueries,
            c = t.args.filterStyle,
            d = t.args.filterColor,
            e = t.args.filterMargin,
            z = t.$elm.attr("class").split(" ");

            $(z).each(function(i, e) { 
                e.indexOf("mlr-") == 0 && (cls = "." + z[0] + "." + e)
            }),

            t.$elm.find(".projects-filter").alterClass("filter-style-*", c),
            t.$elm.find(".projects-filter").alterClass("filter-color-*", "filter-color" + d),

            b = a == "2,2,1,1" ? [{"width": 1200, "cols": 2},{"width": 830, "cols": 2},{"width": 768, "cols": 1},{"width": 480, "cols": 1}] : b,
            b = a == "3,3,2,1" ? [{"width": 1200, "cols": 3},{"width": 830, "cols": 2},{"width": 768, "cols": 2},{"width": 480, "cols": 1}] : b,
            b = a == "4,3,2,1" ? [{"width": 1200, "cols": 4},{"width": 830, "cols": 3},{"width": 768, "cols": 2},{"width": 480, "cols": 1}] : b,
            b = a == "5,3,2,1" ? [{"width": 1200, "cols": 5},{"width": 830, "cols": 3},{"width": 768, "cols": 2},{"width": 480, "cols": 1}] : b,
            b = a == "6,4,3,2" ? [{"width": 1200, "cols": 6},{"width": 830, "cols": 4},{"width": 768, "cols": 3},{"width": 480, "cols": 2}] : b,
            t.args.mediaQueries = b;

            t.$elm.find(".galleries").cubeportfolio(t.args),

            e = e ? "margin:" + e + " !important;" : "",

            css += cls + " .projects-filter {" + e + "}\n",
            css && $("#master-dynamic").length
                ? ((arr = $("#master-dynamic").html().split("\n")),
                  $.each(arr, function(i, e) {
                      e && e.indexOf(cls) > -1 && arr.splice(e, 1)
                  }),
                  $("#master-dynamic").empty().append(arr.join("\n")).append(css))
                : $("head").append("<style type='text/css' id='master-dynamic'>" + css + "</style>")
        },
    };

    masterPortfolio.defaults = masterPortfolio.prototype.defaults;

    $.fn.masterPortfolio = function(opts) {
        return this.each(function() {
            new masterPortfolio(this, opts).init();
        });
    };
}(jQuery, window, document));