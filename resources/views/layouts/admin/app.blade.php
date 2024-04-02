<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
@include("layouts.admin.head")

<body>
<!-- Begin page -->
<div id="layout-wrapper">

    @include("layouts.admin.header")
     <!-- ========== App Menu ========== -->
     <div class="app-menu navbar-menu">
         <!-- LOGO -->
         <div class="navbar-brand-box">
             <!-- Dark Logo-->
             <a href="/" class="logo logo-dark">
                     <span class="logo-sm">
                         <img src="{{asset(settings("logo"))}}" alt="{{ settings("app_name") }}" height="22">
                     </span>
                 <span class="logo-lg">
                         <img src="{{asset(settings("logo"))}}" alt="{{ settings("app_name") }}" height="17">
                     </span>
             </a>
             <!-- Light Logo-->
             <a href="/" class="logo logo-light">
                     <span class="logo-sm">
                         <img src="{{asset(settings("logo"))}}" alt="{{ settings("app_name") }}" height="40">
                     </span>
                     <span class="logo-lg">
                         <img src="{{asset(settings("logo"))}}" alt="{{ settings("app_name") }}" height="60">
                     </span>
             </a>
             <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                     id="vertical-hover">
                 <i class="ri-record-circle-line"></i>
             </button>
         </div>
 
         <div id="scrollbar">
             <div class="container-fluid">
 
                 <div id="two-column-menu">
                 </div>
                 @include("layouts.admin.sidebar")
             </div>
             <!-- Sidebar -->
         </div>
     </div>
     <!-- Left Sidebar End -->
     <div class="vertical-overlay"></div>
     <div class="main-content">
 
         <div class="page-content">
             <div class="container-fluid">
                 @include('layouts.admin.page-header')
 
                 @yield("content")


             </div>
             <!-- container-fluid -->
         </div>
         <!-- End Page-content -->
 
         @include("layouts.admin.footer")
     </div>
 
 </div>
    <!-- end auth-page-wrapper -->
<!-- end auth-page-wrapper -->
@include("layouts.admin.scripts")
</body>
</html>
