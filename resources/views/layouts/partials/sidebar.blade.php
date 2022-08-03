<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('assets/img/bps.png') }}" class="img-circle" alt="User Image">
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
        <ul class="sidebar-menu" data-widget="tree">
            @if (auth()->user()->role == 'admin')
                <li class="header">Admin</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="{{ request()->url() == route('employee.index') ? 'active' : '' }}"><a
                        href="{{ route('employee.index') }}"><i class="fa-solid fa-person-chalkboard"></i>
                        <span>Pegawai</span></a></li>
                <li class="{{ request()->url() == route('penilai.index') ? 'active' : '' }}"><a
                        href="{{ route('penilai.index') }}"><i class="fa-solid fa-list-check"></i>
                        <span>Penilai</span></a></li>
                <li class="{{ request()->url() == route('position.index') ? 'active' : '' }}"><a
                        href="{{ route('position.index') }}"><i class="fa-solid fa-user-doctor"></i>
                        <span>Jabatan</span></a></li>
                <li class="{{ request()->url() == route('activity.index') ? 'active' : '' }}"><a
                        href="{{ route('activity.index') }}"><i class="fa-solid fa-business-time"></i>
                        <span>Kegiatan</span></a></li>
                <li class="{{ request()->url() == route('criteria.index') ? 'active' : '' }}"><a
                        href="{{ route('criteria.index') }}"><i class="fa-solid fa-chart-line"></i>
                        <span>Kriteria</span></a></li>
                <li class="{{ request()->url() == route('struktur.index') ? 'active' : '' }}"><a
                        href="{{ route('struktur.index') }}"><i class="fa-solid fa-people-line"></i>
                        <span>Struktur</span></a></li>
                <li class="{{ request()->url() == route('user.index') ? 'active' : '' }}"><a
                        href="{{ route('user.index') }}"><i class="fa-solid fa-user"></i>
                         <span>Manajemen
                            User</span></a></li>
                <li class="{{ request()->url() == route('laporan.index') ? 'active' : '' }}"><a
                        href="{{ route('laporan.index') }}"><i class="fa-solid fa-book"></i>
                        <span>laporan</span></a></li>
            @endif
            <li class="header">Penilai</li>
            <li class="{{ request()->url() == route('penilai.index') ? 'active' : '' }}"><a
                    href="{{ route('nilai.index') }}"><i class="fa-solid fa-file"></i>
                    <span>Input Nilai Pegawai</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
