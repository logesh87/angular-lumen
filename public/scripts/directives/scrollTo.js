var $ = require("jquery");
module.exports = function() {
    return {
        restrict: 'E',
        scope: {
            target: "="
        },
        replace: true,
        template: '<button scroll-to ng-click="scrollTo()" class="onlyLandscape onlyMobile" id="scrollDown"> <span>Scroll Down</span> <span>Scroll Top</span></button>',
        link: function(scope, $elm) {


            $(window).scroll(function(){
              if ($(this).scrollTop() > 0) {
                $('.scrollToTop').fadeIn();
              } else {
                $('.scrollToTop').fadeOut();
              }
            });

            scope.scrollTo = function() {

                if ($("#scrollDown").hasClass('scrollTop')) {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 'slow', function() {
                        $("#scrollDown").removeClass('scrollTop');
                    });
                } else {

                    $('html, body').animate({
                        scrollTop: $('#store-data').offset().top
                    }, 'slow', function() {
                        $("#scrollDown").addClass('scrollTop');
                    });
                }


            };
        }
    }
}
