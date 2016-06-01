<!DOCTYPE html>
<html lang="fr-fr" class="{{device('isMobile') ? "mobile" : "desktop"}}">

<head>
    <title ng-bind="('site_title'|translate)"></title>
    <base href="/">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <link rel="shortcut icon" href="{{$route_prefix}}/assets/images/favicon.gif" type="image/gif">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{$route_prefix}}/assets/styles/style.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700,700italic' rel='stylesheet' type='text/css'>    
   
    <!--[if lt IE 10]>
        <link rel="stylesheet" type="text/css" href="{{$route_prefix}}/assets/styles/ie.css">
         <div class="noSupport"><p>Please use IE 10 or above to view this page</p></div>
    <![endif]-->

</head>

<body ng-controller="MainController as vm" ng-class="{ 'quote-form': showQuoteResponseScreen, 'quote-result': !showQuoteResponseScreen, 'showMenu': vm.toggleMenu }">
    <header>
        <a href="#" ng-click="vm.toggleMenuClass($event)"><!-- Mobile Menu --></a>
        <nav>
            <h2>Nos autres applications</h2>
            <a href="#" ng-bind ="('header_menu_faq'|translate)"></a>
            <a href="#" ng-bind="('header_menu_localiser'|translate)"></a>
            <a href="#" ng-bind="('header_menu_demande'|translate)"></a>
            <a href="http://www.dhl-france.com/fita/contact/" target="_blank" ng-bind="('header_menu_nous'|translate)"></a>
        </nav>        
    </header>
    <ng-view></ng-view>
    <footer>
        <nav>
            <a href="#" ng-bind="('footer_menu_faq'|translate)"></a>
            <a href="#" ng-bind="('footer_menu_localiser'|translate)"></a>
            <a href="#" ng-bind="('footer_menu_demande'|translate)"></a>
            <a href="http://www.dhl-france.com/fita/contact/" target="_blank" ng-bind="('footer_menu_nous'|translate)"></a>
        </nav>
    </footer>
    <div class="dataLoader" ng-show="showLoader">        
        <div class="loaderCircle">
            <div class="circle1 circle"></div>
            <div class="circle2 circle"></div>
            <div class="circle3 circle"></div>
            <div class="circle4 circle"></div>
            <div class="circle5 circle"></div>
            <div class="circle6 circle"></div>
            <div class="circle7 circle"></div>
            <div class="circle8 circle"></div>
            <div class="circle9 circle"></div>
            <div class="circle10 circle"></div>
            <div class="circle11 circle"></div>
            <div class="circle12 circle"></div>
        </div>
    </div>
    <script type="text/javascript">
    //Add route prefix based on the environment variable from lumen
    var dhl_config = {
        route_prefix : "/{{$route_prefix}}",
        app_env : "{{getenv('APP_ENV')}}"
    };
    </script>
    <script type="text/javascript" src="{{$route_prefix}}/assets/build/main.js"></script>
    <script>

      window.fbAsyncInit = function() {
        FB.init({
          appId      : '{{conf('facebook.app_id')}}',
          xfbml      : true,
          version    : 'v2.5'
        });
        FB.Canvas.setSize({ height: 580 });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
</body>

</html>
