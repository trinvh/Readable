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
            <li class="header">MAIN</li>
            <li class="active"><a href="/admin"><i class='fa fa-link'></i> Dashboard</a></li>
            <li class="header">NOVELS</li>
            <li><a href="/admin/novels/stories"><i class='fa fa-link'></i> Danh sách truyện <small class="label pull-right bg-yellow">{{ \App\Models\Novel\Story::count() }}</small></a></li>
            <li><a href="/admin/novels/categories"><i class='fa fa-link'></i> Quản lí thể loại</a></li>
            <li><a href="/admin/novels/authors"><i class='fa fa-link'></i> Quản lí tác giả</a></li>
            <li><a href="/admin/novels/tags"><i class='fa fa-link'></i> Quản lí tags</a></li>
            <li><a href="{{ route('admin.novels.collections.index') }}"><i class='fa fa-link'></i> Bộ sưu tập truyện<small class="label pull-right bg-green">new</small></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
