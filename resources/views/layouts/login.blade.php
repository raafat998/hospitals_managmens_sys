
@extends('../layouts/base')

@section('body')
    <body class="login">
        
        @yield('content')
        @include('../layouts/components/dark-mode-switcher')
        @include('../layouts/components/main-color-switcher')

        <!-- BEGIN: JS Assets-->
        @vite('resources/js/app.js')
        <!-- END: JS Assets-->
     
        @yield('script')
    </body>
@endsection
