<!DOCTYPE html>
<html lang="fr-fr" class="{{device('isMobile') ? "mobile" : "desktop"}}">

<head>
    <title ng-bind="('site_title'|translate)"></title>
    <base href="/">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
  	<link rel="shortcut icon" href="{{$route_prefix}}/assets/images/favicon.gif" type="image/gif">
    <link rel="stylesheet" type="text/css" href="{{$route_prefix}}/assets/styles/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{$route_prefix}}/assets/styles/style.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700,700italic' rel='stylesheet' type='text/css'>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css">
    <!--[if lt IE 10]>
        <link rel="stylesheet" type="text/css" href="{{$route_prefix}}/assets/styles/ie.css">
         <div class="noSupport"><p>Please use IE 10 or above to view this page</p></div>
    <![endif]-->

</head>

<body ng-controller="MainController as vm" class="back-office">
    <header>
        <div class="container">
            <h1 class="page-header">Back Office DHL FAQ
                <button ng-click="logout()" class="pull-right btn btn-primary" ng-show="isLoggedIn">Logout</button>
            </h1>
        </div>
    </header>
    <ng-view></ng-view>
 
    <script type="text/javascript">
    //Add route prefix based on the environment variable from lumen
    var dhl_config = {
        route_prefix : "/{{$route_prefix}}",
        app_env : "{{getenv('APP_ENV')}}"
    };
    </script>
    <script type="text/javascript" src="{{$route_prefix}}/assets/build/main.js"></script>
    
</body>

</html>
