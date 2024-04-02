<head>
    <meta charset="utf-8" />
    <title>{{settings('app_name')}} - @yield('title', 'Welcome') </title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{settings('description')}}" name="description" />
    <meta content="" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset(settings("favicon"))}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @stack('amicrud_css')
    <!-- Layout config Js -->
    <link href="/assets/admin/plugins/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/admin/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

    <link href="/assets/admin/plugins/summernote/summernote-bs4.css" rel="stylesheet" type="text/css" />

    <script src="/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="/assets/admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/assets/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/admin/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="/assets/admin/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- jsvectormap css -->
    <link href="/assets/admin/assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <!--Swiper slider css-->
    <link href="/assets/admin/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />


</head>
