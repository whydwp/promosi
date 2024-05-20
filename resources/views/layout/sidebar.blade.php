<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rounded-circle">
            <img src="{{ url('icon/icon.png') }}" alt="Logo" width="40px">
        </div>
        <div class="sidebar-brand-text mx-3">Gacoan Menyala</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Post</span>
        </a>
    </li>

    <!-- If the user is an admin -->
    @if(auth()->user()->role == 'admin')
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#masterDataCollapse"
                aria-expanded="true" aria-controls="masterDataCollapse">
                <i class="fas fa-fw fa-cog"></i>
                <span>Master Data</span>
            </a>
            <div id="masterDataCollapse" class="collapse" aria-labelledby="headingMasterData"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Master Data:</h6>
                    <a class="collapse-item" href="{{ route('branches.index') }}">Nama Cabang</a>
                    <a class="collapse-item" href="{{ route('regions.index') }}">Regional</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Users</span>
            </a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
