<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{--    Styles--}}
    @stack('before-styles')
    <style>
        .buttonAncak{
            align-items: center;
            border-radius: 500px;
            bottom: 16px;
            cursor: pointer;
            display: flex;
            height: 32px;
            justify-content: center;
            min-width: 32px;
            position: fixed;
            right: 16px;
            width: fit-content;
            line-height: 16px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, .16), 0 1px 2px rgba(0, 0, 0, .23);
        }
        /* Popup container */
        .popup {
        position: relative;
        display: inline-block;
        cursor: pointer;
        }

        /* The actual popup (appears on top) */
        .popup .popuptext {
        visibility: hidden;
        width: 160px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 8px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -80px;
        }

        /* Popup arrow */
        .popup .popuptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
        }

        /* Toggle this class when clicking on the popup container (hide and show the popup) */
        .popup .show {
        visibility: visible;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s
        }

        /* Add animation (fade in the popup) */
        @-webkit-keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
        }

        @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity:1 ;}
        }
    </style>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/se-2.2.13/dt-1.10.20/datatables.min.css"/>

    <link href="{{ mix('css/backend.css') }}" rel="stylesheet" >
    @stack('after-styles')
</head>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'					- Fixed Header

// Brand options
1. '.brand-minimized'       - Minimized brand (Only symbol)

// Sidebar options
1. '.sidebar-fixed'					- Fixed Sidebar
2. '.sidebar-hidden'				- Hidden Sidebar
3. '.sidebar-off-canvas'		- Off Canvas Sidebar
4. '.sidebar-minimized'			- Minimized Sidebar (Only icons)
5. '.sidebar-compact'			  - Compact Sidebar

// Aside options
1. '.aside-menu-fixed'			- Fixed Aside Menu
2. '.aside-menu-hidden'			- Hidden Aside Menu
3. '.aside-menu-off-canvas'	- Off Canvas Aside Menu

// Breadcrumb options
1. '.breadcrumb-fixed'			- Fixed Breadcrumb

// Footer options
1. '.footer-fixed'					- Fixed footer

-->

<body class="app header-fixed sidebar-fixed aside-menu-off-canvas aside-menu-hidden sidebar-lg-show">

@include('backend.layouts.header')

<div class="app-body">

    @include('backend.layouts.sidebar')

<!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            @yield('breadcrumb')

            <li class="breadcrumb-menu d-md-down-none">
                <div class="btn-group" role="group" aria-label="Button group">
                    @yield('toolbar')
                </div>
            </li>
        </ol>


        <div class="container-fluid">

{{--            @include('errors.validation')--}}

            <div class="animated fadeIn">
                @yield('content')
            </div>

        </div>
        <!-- /.conainer-fluid -->
    </main>
    @include('backend.layouts.aside')

</div>

@include('backend.layouts.footer')

{{--Scripts--}}
@stack('before-scripts')
<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/backend.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#file_report").hide();
        $("#editfile").click(function(e){
            $("#file_report").click();
            // $("#form_file").submit();
            $("#file_report").change(function(e){
                $("#form_file").submit();
            });
        });
    });
</script>

<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/v/se-2.2.13/dt-1.10.20/datatables.min.js"></script>

@stack('after-scripts')

@isset(Auth::user()->id)

@endisset
@yield('javascript')

</body>
<style>
    .buttonancak{
        align-items: center;
        border-radius: 500px;
        bottom: 16px;
        cursor: pointer;
        display: flex;
        height: 64px;
        justify-content: center;
        min-width: 64px;
        position: fixed;
        right: 16px;
        width: fit-content;
        color: white;
        font-size: 32px;
    }
</style>
</html>
