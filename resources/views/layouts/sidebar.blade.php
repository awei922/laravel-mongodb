<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">菜单栏</li>
            <li @if($currentUri==route('admin.index'))class="active"@endif><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> <span>控制台</span></a></li>
            <li @if($currentUri==route('log.index'))class="active"@endif><a href="{{route('log.index')}}"><i class="fa fa-book"></i> <span>日志记录</span></a></li>
            <li @if($currentUri==route('alert.index'))class="active"@endif><a href="{{route('alert.index')}}"><i class="fa fa-exclamation-circle"></i> <span>警报记录</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>