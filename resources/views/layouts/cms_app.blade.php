<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{csrf_token()}}' }</script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>D'Hungry Buddy | CMS</title>
        <link rel="icon" type="image/png" href="{{ asset('site-template/img/favicon.ico') }}">
        @include('cms/partials/css_files')

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    </head>

    <body>
        <script src="{{ asset('cms-template/js/app.js') }}"></script>
        @include('cms/partials/js_files')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>
        @yield('javascript')

        <header class="header navbar navbar-fixed-top custom-header" role="banner">
            <div class="container">
                <!-- Only visible on smartphones, menu toggle -->
                <ul class="nav navbar-nav">
                    <li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a></li>
                </ul>
                <!--/-->

                <a class="navbar-brand" href="{{ route('site.home') }}">
                    <strong>
                        <i class="icon-food"></i>
                        D'Hungry Buddy
                    </strong>
                </a>

                <!-- Sidebar Toggler -->
                <a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation">
                    <i class="icon-reorder"></i>
                </a>
                <!--/-->

                <!-- Top Left Menu -->
                <ul class="nav navbar-nav navbar-left">
                    <li class="hidden-xs hidden-sm">
                        <a>
                            <?php $user = Auth::user(); ?>
                            {{ ucfirst($user->fullname?? $user->email) }}
                        </a>
                    </li>

                    {{-- <li><a>SY: {{$academicYearTitle}}</a></li> --}}
                </ul>
                <!-- /Top Left Menu -->

                <!-- Top Right Menu -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- User Login Dropdown -->
                    <li class="dropdown user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="username">{{ $user->fullname }}</span>
                            <i class="icon-caret-down small"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#!"><i class="icon-user"></i> My Account</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="icon-key"></i> Log Out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!-- /user login dropdown -->
                </ul>
                <!-- /Top Right Menu -->
            </div>
        </header>

        <div id="container">
            <div id="sidebar" class="sidebar-fixed">
                <div id="sidebar-content">
                    @include('cms/partials/sidebar')
                </div>
                <div id="divider" class="resizeable"></div>
            </div>

            <div id="content" class="wrapper">
                <div id="app">
                    @yield('content')
                </div>
            </div>
        </div>

    </body>
</html>