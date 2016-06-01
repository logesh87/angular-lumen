var angular = require('angular');

var _ = require('lodash'),
    $ = require("jquery"),
    slick = require('slick-carousel-browserify');

require('angular-google-analytics');
require('angular-simple-logger');
require('angular-google-maps');
var app = angular.module('dhlApp', [
    'nemLogging',
    'angular-google-analytics',
    require('angular-ui-bootstrap'),
    require('ui-select'),
    require('angular-route'),
    require('angular-translate'),
    require('angular-sanitize'),
    require('angular-cookies'),
    require('angular-translate'),
    require('angular-messages'),
    require('angular-translate-interpolation-messageformat')
]);


require('angular-translate-storage-local');
require('angular-translate-storage-cookie');
require('angular-translate-loader-static-files');
require('../node_modules/angular-i18n/angular-locale_fr-fr.js');

app.config(['$routeProvider', '$locationProvider', '$translateProvider', 'AnalyticsProvider',
    function($routeProvider, $locationProvider, $translateProvider, AnalyticsProvider) {

        //set google analytics
        //AnalyticsProvider.setAccount('UA-XXXXX-xx');
        AnalyticsProvider.enterDebugMode(true);

        //Load translations faster from local storage or cookie
        //fetch translations from static path
        //set default translation language
        $translateProvider
            .useLocalStorage()
            .useStaticFilesLoader({
                prefix: dhl_config.route_prefix + 'assets/languages/',
                suffix: '.json'
            })
            .addInterpolation('$translateMessageFormatInterpolation')
            .preferredLanguage('fr');
        //sanitize the translation text 
        //$translateProvider.useSanitizeValueStrategy('sanitize');

        //$locationProvider.html5Mode(true);

        $routeProvider
            .when('/faq', {
                templateUrl: 'scripts/partials/faq.tmpl.html',
                controller: 'FAQController',
                controllerAs: 'vm'
            })
            .when('/bo', {
                templateUrl: 'scripts/partials/bo.tmpl.html',
                controller: 'FAQController',
                controllerAs: 'vm'
            })
            .when('/bo-login', {
                templateUrl: 'scripts/partials/boLogin.tmpl.html',
                controller: 'FAQController',
                controllerAs: 'vm',
                allowLogin: true
            })
            .otherwise('/faq');
    }
]);

app.run(["$rootScope", "$location", "FAQService", function($rootScope, $location, FAQService) {
    $rootScope.isLoggedIn = false;
    var paths = $location.absUrl().split('/');
    var bo = paths.filter(function(d) {
        return d.replace('#', '') == "bo";
    });

    if (FAQService.getToken()) {
        $rootScope.isLoggedIn = true;
    };

    if (bo.length > 0) {

        $rootScope.$on('$routeChangeStart', function(event, next) {
            var userAuthenticated = $rootScope.isLoggedIn;
            if (userAuthenticated) {
                $location.path('/bo');
            } else if (!userAuthenticated && !next.allowLogin) {
                $rootScope.savedLocation = $location.url();
                $location.path('/bo-login');
            }
        });

    }

}])


//Lumen API URL 
app.constant('BASE_URL', dhl_config.route_prefix + 'api/');
app.directive('inputLoader', require('./scripts/directives/loaderDirective.js'));
app.directive('scrollTo', require('./scripts/directives/scrollTo.js'));
app.controller('MainController', require('./scripts/controllers/MainController.js'));
app.controller('FAQController', require('./scripts/controllers/FAQController.js'));
app.factory('FAQService', require('./scripts/services/FAQService.js'));

angular.element(document).ready(function() {
    angular.bootstrap(document, ['dhlApp']);
});
