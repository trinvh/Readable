<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{!! auth()->user()->gravatar() !!}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <li class="active"><a href="/admin"><i class='fa fa-link'></i> <span>Dashboard</span></a></li>
            <li><a href="#"><i class='fa fa-link'></i> <span>Another Link</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Quản lý truyện</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/admin/novels/stories">Danh sách truyện</a></li>
                    <li><a href="/admin/novels/categories">Quản lý thể loại</a></li>
                    <li><a href="/admin/novels/authors">Quản lý tác giả</a></li>
                    <li><a href="/admin/novels/tags">Quản lý tags</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
