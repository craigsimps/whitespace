/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 * ======================================================================== */
(function ($) {

    var Whitespace = {
        common: {
            init: function () {
            }
        },
        home: {
            init: function () {
                $('.welcome').backstretch([
                    'https://craigsimpson.scot/wp-content/themes/whitespace/assets/images/high-performance-wordpress-themes.jpg'
                ], {
                    duration: 3000,
                    fade: 750
                });
            }
        },
        archive: {
            init: function () {
                $('.content .entry').click(function () {
                    window.location = $(this).find('.entry-title a').attr('href');
                });
            }
        },
        code_snippets: {
            init: function () {
                var options = {
                    listClass: "snippets",
                    valueNames: ["title", "tag"]
                };
                var userList = new List("snippet-search", options);

                $('.snippet-filter').on('click', function (e) {
                    var $text = $(this).text();
                    if ($(this).hasClass('selected')) {
                        userList.filter();
                        $(this).removeClass('selected');
                    } else {
                        userList.filter(function (item) {
                            return (item.values().tag == $text);
                        });
                        $(this).addClass('selected');
                    }
                });

                $('.search-header').backstretch([
                    'https://craigsimpson.scot/wp-content/themes/whitespace/assets/images/high-performance-wordpress-themes.jpg'
                ], {
                    duration: 3000,
                    fade: 750
                });
            }
        }
    };

    var util = {
        fire: function (func, funcname, args) {
            var namespace = Whitespace;
            funcname = (funcname === undefined) ? 'init' : funcname;
            if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function () {
            util.fire('common');

            $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
                util.fire(classnm);
            });
        }
    };

    $(document).ready(util.loadEvents);

})(jQuery);