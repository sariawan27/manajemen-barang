
<div id="sidebar">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="index.html"><img src="https://i.imgur.com/dOV359L.png" style="height: 3.2rem !important;" alt="Logo" srcset=""></a>
            </div>
            <div class="sidebar-toggler  x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li
                class="sidebar-item {{ ((request()->routeIs('dashboard.index')) ? 'active' : '') }}">
                <a href="{{ route('dashboard.index') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li
                class="sidebar-item {{ ((request()->routeIs('pengajuan.*')) ? 'active' : '') }}">
                <a href="{{ route('pengajuan.index') }}" class='sidebar-link'>
                    <i class="bi bi-book-half"></i>
                    <span>Pengajuan</span>
                </a>
            </li>

            <!-- sebagai kepala asrama -->
            @if(Auth::user()->level == 'kepala_asrama')
            <li
                class="sidebar-item  {{ ((request()->routeIs('laporan.*')) ? 'active' : '') }}">
                <a href="{{ route('laporan.index') }}" class='sidebar-link'>
                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
                    <span>Laporan</span>
                </a>
            </li>
            @endif

            <!-- sebagai pengasuh -->
            @if(Auth::user()->level == 'pengasuh')
            <li
                class="sidebar-item  {{ ((request()->routeIs('laporan.*')) ? 'active' : '') }}">
                <a href="{{ route('laporan.index') }}" class='sidebar-link'>
                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
                    <span>Laporan</span>
                </a>
            </li>

            <li class="sidebar-title">Master Data</li>
            <li
                class="sidebar-item {{ ((request()->routeIs('barang.*')) ? 'active' : '') }}">
                <a href="{{ route('barang.index') }}" class='sidebar-link'>
                    <i class="bi bi-box-fill"></i>
                    <span>Barang</span>
                </a>
            </li>
            <li
                class="sidebar-item {{ ((request()->routeIs('kamar.*')) ? 'active' : '') }}">
                <a href="{{ route('kamar.index') }}" class='sidebar-link'>
                    <i class="bi bi-door-closed-fill"></i>
                    <span>Kamar</span>
                </a>
            </li>
            <li
                class="sidebar-item {{ ((request()->routeIs('users.*')) ? 'active' : '') }}">
                <a href="{{ route('users.index') }}" class='sidebar-link'>
                    <i class="bi bi-person-fill"></i>
                    <span>User</span>
                </a>
            </li>
            @endif

        </ul>

        <ul class="menu">
            <li
                class="sidebar-item  {{ ((request()->routeIs('auth.logout')) ? 'active' : '') }}">
                <a href="{{ route('auth.logout') }}" class='sidebar-link' style="color: red;">
                    <i class="bi bi-door-open-fill" style="color: red;"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
</div>
