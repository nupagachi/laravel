<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title','Trang Chủ')</title>
    <!--Css-->
@include('layouts._main.css')
<!--Css-->
</head>

<body class="animsition">
<div class="page-wrapper">
    <!-- MENU SIDEBAR-->
@yield('sidebar')
{{--    @include('layouts._main.sidebar')--}}
<!-- END MENU SIDEBAR-->
    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
    {{--        @yield('heard_desktop')--}}
    @include('layouts._main.header_desktop')
    <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    @yield('content')
                    {{--            @include('layouts._main.indec')--}}
                </div>
            </div>
        </div>

        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

<!-- Jquery JS-->
@include('layouts._main.js');

</body>

</html>
<!-- end document-->
