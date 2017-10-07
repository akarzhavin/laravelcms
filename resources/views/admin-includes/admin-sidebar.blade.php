{{--<div class="row">--}}
    {{--<div class="absolute-wrapper"> </div>--}}
    {{--<nav class="navbar navbar-inverse sidebar" role="navigation">--}}
        {{--<div class="container-fluid">--}}
            {{--<div class="navbar-header">--}}
                {{--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">--}}
                    {{--<span class="sr-only">Toggle navigation</span>--}}
                    {{--<span class="icon-bar"></span>--}}
                    {{--<span class="icon-bar"></span>--}}
                    {{--<span class="icon-bar"></span>--}}
                {{--</button>--}}
            {{--</div>--}}
            {{--<div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">--}}
                {{--<ul class="nav navbar-nav">--}}

                    {{--<li class="active"><a href="/admin"> Dashboard <span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>--}}
                    {{--<li><a href="/admin/products"><span class="glyphicon glyphicon-gift"></span> Products</a></li>--}}
                    {{--<li><a href="/admin/categories"><span class="glyphicon glyphicon-th-list"></span> Categories</a></li>--}}
                    {{--<li><a href="/admin/users"><span class="glyphicon glyphicon-user"></span> Users</a></li>--}}
                    {{--<li><a href="/admin/orders"><span class="glyphicon glyphicon-user"></span> Orders</a></li>--}}
                    {{--<li><a href="/admin/reports"><span class="glyphicon glyphicon-user"></span> Reports</a></li>--}}
                    {{--<li><a href="/admin/payments"><span class="glyphicon glyphicon-user"></span> Manage Payments</a> </li>--}}
                    {{--<li><a href="/admin/pages"><span class="glyphicon glyphicon-user"></span> Shop Pages</a></li>--}}
                    {{--<li><a href="/admin/plugins"><span class="glyphicon glyphicon-user"></span>Manage Plugins</a></li>--}}
                    {{--<li><a href="/admin/themes"><span class="glyphicon glyphicon-user"></span> Manage Themes</a></li>--}}
                    {{--<li><a href="/admin/settings"><span class="glyphicon glyphicon-user"></span> Shop Settings</a></li>--}}


                   {{--@if(is_array(get_admin_extra_menu()))--}}
                    {{--@foreach(get_admin_extra_menu() as $item)--}}


                    {{--@endforeach--}}
                    {{--@endif--}}




                    {{--TODO--}}

                    {{--<li class="dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">Danger Zone <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span></a>--}}
                        {{--<ul class="dropdown-menu forAnimate" role="menu">--}}
                            {{--<li><a href="/admin/maintenance">Enter Maintenance Mode</a></li>--}}
                            {{--<li><a href="/admin/reset">Reset all data</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</nav>--}}


{{--</div>--}}

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p></p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> </a>
                </div>
            </div>

    <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header"></li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href=""><i class='fa fa-link'></i> <span></span></a></li>
            <li><a href="#"><i class='fa fa-link'></i> <span></span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span></span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>