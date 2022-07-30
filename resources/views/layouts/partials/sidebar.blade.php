<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        @if(auth()->user()->role == 'admin')
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Admin</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ route('employee.index') }}"><i class="fa fa-circle"></i>
                    <span>Pegawai</span></a></li>
            <li class="active"><a href="{{ route('penilai.index') }}"><i class="fa fa-circle"></i>
                    <span>Penilai</span></a></li>
            <li class="active"><a href="{{ route('position.index') }}"><i class="fa fa-circle"></i>
                    <span>Jabatan</span></a></li>
            <li class="active"><a href="{{ route('activity.index') }}"><i class="fa fa-circle"></i>
                    <span>Kegiatan</span></a></li>
            <li class="active"><a href="{{ route('criteria.index') }}"><i class="fa fa-circle"></i>
                    <span>Kriteria</span></a></li>
            <li class="active"><a href="{{ route('struktur.index') }}"><i class="fa fa-circle"></i>
                    <span>Struktur</span></a></li>
            <li class="active"><a href="{{ route('user.index') }}"><i class="fa fa-circle"></i> <span>Manajemen
                        User</span></a></li>
            <li class="active"><a href="{{ route('laporan.index') }}"><i class="fa fa-circle"></i>
                    <span>laporan</span></a></li>
        </ul>
        @endif
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
