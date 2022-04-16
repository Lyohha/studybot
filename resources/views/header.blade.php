<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Admin panel'}}</title>

    <link href="{{ Config::get('app.url') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ Config::get('app.url') }}/css/font-awesome/font-awesome.css" rel="stylesheet">

    <link href="{{ Config::get('app.url') }}/css/animate.css" rel="stylesheet">
    <link href="{{ Config::get('app.url') }}/css/style.css" rel="stylesheet">
    <meta name="robots" content="noindex">
</head>
<body class="antialiased">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" src="/images/profile_small.jpg"/>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">имя</span>
                                <span class="text-muted text-xs block">роль<b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                {{-- <li><a class="dropdown-item" href="{{ Config::get('app.url') }}/admin/self">Profile</a></li>
                                <li class="dropdown-divider"></li> --}}
                                <li><a class="dropdown-item" href="/admin/logout">Выход</a></li>
                            </ul>
                        </div>
                        <v-profile-info></v-profile-info>
                        <div class="logo-element">
                            LCMS
                        </div>
                    </li>
                    <v-menu-list></v-menu-list>
                </ul>
    
            </div>
        </nav>
        
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        {{-- <form role="search" class="navbar-form-custom" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form> --}}
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to Admin Panel.</span>
                        </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                    <i class="fa fa-bell"></i>  <span class="label label-primary">0</span>
                                </a>
                                <ul class="dropdown-menu dropdown-alerts">
                                    <v-notify-list></v-notify-list>
                                    <li>
                                        <div class="text-center link-block">
                                            <a href="/admin/notify" class="dropdown-item">
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
    
    
                            <li>
                                <a href="/admin/logout">
                                    <i class="fa fa-sign-out"></i> Выход
                                </a>
                            </li>
                            {{-- <li>
                                <a class="right-sidebar-toggle">
                                    <i class="fa fa-tasks"></i>
                                </a>
                            </li> --}}
                    </ul>
    
                </nav>
            </div>
    