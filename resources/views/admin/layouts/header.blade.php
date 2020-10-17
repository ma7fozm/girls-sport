<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sabaya</title>
    <!-- Viewport metatags -->
    <meta name="HandheldFriendly" content="true"/>
    <meta name="MobileOptimized" content="320"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <!-- iOS webapp metatags -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>

    <!-- iOS webapp icons -->
    <link rel="apple-touch-icon-precomposed" href="{{asset('design/admin')}}/assets/images/ios/fickle-logo-72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{asset('design/admin')}}/assets/images/ios/fickle-logo-72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{asset('design/admin')}}/assets/images/ios/fickle-logo-114.png"/>

    <!-- TODO: Add a favicon -->
    <link rel="shortcut icon" href="{{asset('design/admin')}}/assets/images/ico/fab.ico">

    <title>{{config('app.name','Girls Sport')}}</title>

    <!-- Plugin Css End -->
    <!--Page loading plugin Start -->
    <link rel="stylesheet" href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/pace-rtl.css">
    <script src="{{asset('design/admin')}}/assets/js/pace.min.js"></script>

    <!--Page loading plugin End   -->


    <link rel="stylesheet"
          href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/bootstrap-progressbar-3.1.1-rtl.css">
    <link rel="stylesheet" href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/jquery-jvectormap-rtl.css">

    <!--AmaranJS Css Start-->
    <link href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/amaranjs/jquery.amaran-rtl.css" rel="stylesheet">
    <link href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/amaranjs/theme/all-themes-rtl.css"
          rel="stylesheet">
    <link href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/amaranjs/theme/awesome-rtl.css" rel="stylesheet">
    <link href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/amaranjs/theme/default-rtl.css" rel="stylesheet">
    <link href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/amaranjs/theme/blur-rtl.css" rel="stylesheet">
    <link href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/amaranjs/theme/user-rtl.css" rel="stylesheet">
    <link href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/amaranjs/theme/rounded-rtl.css" rel="stylesheet">
    <link href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/amaranjs/theme/readmore-rtl.css" rel="stylesheet">
    <link href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/amaranjs/theme/metro-rtl.css" rel="stylesheet">
    <!--AmaranJS Css End -->

    <!-- Plugin Css Put Here -->
    <link href="{{asset('design/admin')}}/assets/css/bootstrap-rtl.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/summernote-rtl.css">

    <!-- Plugin Css End -->
    <!-- Custom styles Style -->
    <link href="{{asset('design/admin')}}/assets/css/rtl-css/style-rtl.css" rel="stylesheet">
    <!-- Custom styles Style End-->

    <!-- Responsive Style For-->
    <link href="{{asset('design/admin')}}/assets/css/rtl-css/responsive-rtl.css" rel="stylesheet">
    <!-- Responsive Style For-->

    <!-- Custom styles for this template -->


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"
          type='text/css'>

    @yield('css')

</head>
<body class="">