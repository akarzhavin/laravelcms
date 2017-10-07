{{--<div class="flash-alerts">--}}
    {{--@foreach (['danger', 'warning', 'success', 'info'] as $msg)--}}
        {{--@if(Session::has('alert-' . $msg))--}}
            {{--<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>--}}
        {{--@endif--}}
    {{--@endforeach--}}
{{--</div>--}}

{{--TODO move css to sheet--}}

{{--<style>--}}
    {{--.panel-body .btn:not(.btn-block) {--}}
        {{--width: 150px;--}}
        {{--margin-bottom: 12px;--}}
    {{--}--}}

    {{--@media (min-width: 768px) {--}}
        {{--nav.sidebar  nav.sidebar .navbar-header{--}}
            {{--text-align: center;--}}
            {{--width: 100%;--}}
            {{--margin-left: 0px;--}}
        {{--}--}}

        {{--nav.sidebar .navbar-nav .open .dropdown-menu {--}}
            {{--position: static;--}}
            {{--float: none;--}}
            {{--width: auto;--}}
            {{--margin-top: 0;--}}
            {{--background-color: transparent;--}}
        {{--}--}}

        {{--nav.sidebar .navbar-collapse, nav.sidebar .container-fluid{--}}
            {{--padding: 0 0px 0 0px;--}}
        {{--}--}}

        {{--nav.sidebar{--}}
            {{--width: 200px;--}}
            {{--height: 100%;--}}
            {{--margin-left: 0px;--}}
            {{--float: left;--}}
            {{--z-index: 10000;--}}
            {{--margin-bottom: 0px;--}}
        {{--}--}}

        {{--nav.sidebar li {--}}
            {{--width: 100%;--}}
        {{--}--}}
    {{--}--}}

    {{--@media (min-width: 1330px) {--}}
        {{--nav.sidebar{--}}
            {{--margin-left: 0px;--}}
            {{--float: left;--}}
        {{--}--}}
    {{--}--}}

    {{--nav.sidebar .navbar-nav .open .dropdown-menu>li>a:hover, nav.sidebar .navbar-nav .open .dropdown-menu>li>a:focus {--}}
        {{--background-color: transparent;--}}
    {{--}--}}


{{--</style>--}}


<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE Laravel </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"></span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"></li>
                        <li>
                            <!-- inner menu: contains the messages -->
                            <ul class="menu">
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <!-- User Image -->
                                            <img src="" class="img-circle" alt="User Image"/>
                                        </div>
                                        <!-- Message title and timestamp -->
                                        <h4>

                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <!-- The message -->
                                        <p></p>
                                    </a>
                                </li><!-- end message -->
                            </ul><!-- /.menu -->
                        </li>
                        <li class="footer"><a href="#">c</a></li>
                    </ul>
                </li><!-- /.messages-menu -->

                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"></li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                <li><!-- start notification -->
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i>
                                    </a>
                                </li><!-- end notification -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#"></a></li>
                    </ul>
                </li>
                <!-- Tasks Menu -->
                <li class="dropdown tasks-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"></li>
                        <li>
                            <!-- Inner menu: contains the tasks -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <!-- Task title and progress text -->
                                        <h3>

                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <!-- The progress bar -->
                                        <div class="progress xs">
                                            <!-- Change the css width attribute to simulate progress -->
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#"></a>
                        </li>
                    </ul>
                </li>

                    <li><a href="</a></li>
                    <li><a href="</a></li>

                <!-- User Account Menu -->
                    <li class="dropdown user user-menu" id="user_menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="" class="user-image" alt="User Image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="" class="img-circle" alt="User Image" />
                                <p>

                                    <small> Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#"></a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#"></a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#"></a>
                                </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="" class="btn btn-default btn-flat"></a>
                                </div>
                                <div class="pull-right">
                                    <a href="" class="btn btn-default btn-flat" id="logout"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    </a>
                                    <form id="logout-form" action="" method="POST" style="display: none;">
                                        <input type="submit" value="logout" style="display: none;">
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>


            <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>



{{--<nav class="navbar navbar-default navbar-static-top">--}}
    {{--<div class="container-fluid">--}}
        {{--<div class="navbar-header">--}}
            {{--<button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">--}}
               {{--Admin MENU--}}
            {{--</button>--}}
            {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">--}}
                {{--<span class="sr-only">Toggle navigation</span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
            {{--</button>--}}

            {{--<h1> <a class="shop-name" href="/admin">--}}
                    {{--Shop Administrator--}}
                {{--</a></h1>--}}

        {{--</div>--}}

        {{--<div class="collapse navbar-collapse" id="navbar-collapse-1">--}}

            {{--<ul class="nav navbar-nav navbar-right">--}}
                {{--<li><a href="/" target="_blank">View Shop</a></li>--}}
                {{--<li class="dropdown ">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                        {{--Account--}}
                        {{--<span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu" role="menu">--}}


                        {{--TODO--}}
                        {{--<li class=""><a href="#">Notifications</a></li>--}}
                        {{--<li class=""><a href="#">Alerts</a></li>--}}
                        {{--<li class="divider"></li>--}}
                        {{--<form method="POST" action="{{ url('logout') }}">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--<input type="submit" value="Logout">--}}
                        {{--</form>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</nav>--}}



