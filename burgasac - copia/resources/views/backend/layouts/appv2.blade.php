<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="author" content="@yield('meta_author', 'DbRot Soluciones EIRL')">
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        @langRTL
            {{ Html::style(elixir('css/backend-rtl.css')) }}
            {{ Html::style(elixir('css/rtl.css')) }}
        @else
            {{ Html::style(elixir('css/backend.css')) }}
        @endif

        @yield('after-styles')

        <!-- Html5 Shim and Respond.js IE8 support of Html5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        {{ Html::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
        {{ Html::script('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js') }}
        <![endif]-->

        <!-- Scripts -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" media="screen" title="no title">
        <link rel="stylesheet" href="{{ asset('css/backend/plugin/datepicker/bootstrap-datepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/backend/spin.css') }}">
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <link rel="stylesheet" href="{{ asset('css/backend/custom.css') }}">
    </head>
    <body class="skin-{{ config('backend.theme') }} {{ config('backend.layout') }}">
        @include('includes.partials.logged-in-as')

        <div class="wrapper">
            @include('backend.includes.header')
            @include('backend.includes.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('page-header')

                    {{-- Change to Breadcrumbs::render() if you want it to error to remind you to create the breadcrumbs for the given route --}}
                    {!! Breadcrumbs::renderIfExists() !!}
                </section>

                <!-- Main content -->
                <section class="content">
                    @include('includes.partials.messages')
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            @include('backend.includes.footer')
        </div><!-- ./wrapper -->

        <!-- JavaScripts -->
        @yield('before-scripts')
        {{ Html::script(elixir('js/backend.js')) }}
        @yield('after-scripts')
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"> </script>
        <script type="text/javascript" src="{{ asset('js/backend/plugin/datepicker/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js") }}"></script>
        <script src="{{ asset("js/jquery.numeric.min.js") }}"></script>
        <script src="{{ asset("js/utils.js") }}"></script>
        @stack('scripts')
        <div class="contenedor-spinner">
            <div class="spinner">
              <div class="cube1"></div>
              <div class="cube2"></div>
            </div>
        </div>
    </body>
</html>
