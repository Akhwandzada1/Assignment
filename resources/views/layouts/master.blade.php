<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>@yield('title')</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ mix('css/theme.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ mix('css/theme.css') }}">
    <style>
        .dataTables_length label select{
            margin-right: 5px;
            margin-left: 5px;
        }
        .dataTables_paginate ul{
            float: right;
        }
        .required:after {
        content:" *";
        color: red;
        }
        .col-sm-12 table{
        border: 1px solid #e5e9f2;
        border-radius: 4px;
        margin-top: 1rem !important;
        }

</style>
    </style>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-main ">
            @include('partials.sidebar')
        <div class="nk-wrap ">
            @include('partials.header') 
            <div class="nk-content ">
            @yield('content')
        </div>    
        </div>
    </div>
    </div>

    <div class="modal fade" id="modalForm">

    </div>



    <script src="{{ mix('js/theme.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>