<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}}</title>

    <!-- Semantic UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css">


    <!-- Font awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- css -->
    @yield('css')


    <!-- mobilizator specific css-->
    <!--{!! Html::style('/css/all.css?v7') !!}-->


    <!-- head -->
    @yield('head')
</head>

<body>

    @include('partials.nav')

    <div class="ui main container">

        @include('partials.errors')
        @yield('content')

        <div class="footer">{{trans('messages.made_with')}} <a href="https://github.com/philippejadin/Mobilizator">Mobilizator</a></div>
    </div>


    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.js"></script>



    <!-- js -->
    @yield('js')


    <!-- footer -->
    @yield('footer')



</body>
</html>
