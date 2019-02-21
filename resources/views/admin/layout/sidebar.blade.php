<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            @can('category')
            <li class="active treeview">
                <a href="{{url('/admin/categorys')}}">
                    <i class="glyphicon glyphicon-list"></i> <span>栏目管理</span>
                </a>
            </li>
            @endcan

            @can('post')
                <li class="active treeview">
                    <a href="{{url('/admin/posts')}}">
                        <i class="fa fa-file-word-o"></i> <span>文章管理</span>
                    </a>
                </li>
            @endcan
            @can('tag')
                    <li class="active treeview">
                        <a href="{{url('/admin/tags')}}">
                            <i class="fa fa-tags"></i> <span>标签管理</span>
                        </a>
                    </li>
            @endcan
            @can('topic')
                <li class="active treeview">
                    <a href="{{url('/admin/topics')}}">
                        <i class="fa  fa-file-image-o"></i> <span>专题管理</span>
                    </a>
                </li>
            @endcan
            @can('notice')
                <li class="active treeview">
                    <a href="{{url('/admin/notices')}}">
                        <i class="fa  fa-bell"></i> <span>通知管理</span>
                    </a>
                </li>
            @endcan
            @can('file')
                    <li class="active treeview">
                        <a href="{{url('/admin/files')}}">
                            <i class="fa fa-book"></i> <span>文件管理</span>
                        </a>
                    </li>
            @endcan
            @can('system')
                    <li class="treeview active">
                        <a href="#systemSetting" class="nav-header collapsed" data-toggle="collapse">
                            <i class="glyphicon glyphicon-cog"></i>
                            系统管理
                            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
                        </a>

                        <ul id="systemSetting" class="nav nav-list collapse secondmenu" >
                            <li><a href="{{url('/admin/permissions')}}"><span class="nav-right"><i class="fa  fa-sitemap "></i> 权限管理</span></a></li>
                            <li><a href="{{url('/admin/users')}}"><span class="nav-right"><i class="glyphicon glyphicon-user"></i> 用户管理</span></a></li>
                            <li><a href="{{url('/admin/roles')}}"><span class="nav-right"><i class="fa  fa-check-square"></i> 角色管理</span></a></li>
                        </ul>
                    </li>
            @endcan
        </ul>

    </section>
    <!-- /.sidebar -->
</aside>