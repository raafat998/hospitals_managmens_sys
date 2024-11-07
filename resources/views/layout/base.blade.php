<!DOCTYPE html>
<!--
Template Name: Rubick - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $dark_mode ? 'dark' : '' }}{{ $color_scheme != 'default' ? ' ' . $color_scheme : '' }}">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="{{ asset('build/assets/images/logo.svg') }}" rel="shortcut icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rubick admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">

    @yield('head')
    @livewireStyles
    <!-- BEGIN: CSS Assets-->
    @vite('resources/css/app.css')
    <!-- END: CSS Assets-->
    <style>
        .notification {
        position: relative;
    }
    
    .notification--bullet::before {
        content: ""; /* يُنشئ النقطة الحمراء */
        position: absolute;
        top: -30% !important ;
        right: -20% !important;
        background-color: red;
        border-radius: 50%;
        width: 15px !important;
        height: 14px !important;
    
    }
    
    .notification-count {
        position: absolute;
        top: 5%;
        right: 15%;
        transform: translate(50%, -50%);
        color: rgb(255, 255, 255);
        font-size: 11px;
        font-weight: bold;
    }
    
    </style>
</head>
<!-- END: Head -->

@yield('body')

</html>
