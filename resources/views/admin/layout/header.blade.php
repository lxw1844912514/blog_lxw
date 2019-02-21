<header class="main-header">
    <a href="/admin/index" class="logo">
        <span class="logo-mini"></span>
        <span class="logo-lg">博客后台管理系统</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{\Auth::user()->avatar}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{\Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu ">
                        <li class="user-footer " style="float: left">
                            <div class="pull-right">
                                <a href="/admin/logout" class="btn btn-default btn-flat ">
                                    <i class="glyphicon glyphicon-off"></i>退出
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
