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
    <title>Blank - Layout | DashLite Admin Template</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ mix('css/theme.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ mix('css/theme.css') }}">
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




    <script src="{{ mix('js/theme.js') }}"></script>
    <script src="{{ mix('js/theme.js') }}"></script>
</body>

</html>