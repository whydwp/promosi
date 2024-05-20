        <div class="side-content-wrap">
            <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
                <ul class="navigation-left">
                    <li class="nav-item " data-item="dashboard">
                        <a class="nav-item-hold" href="#">
                            <i class="nav-icon i-Bar-Chart"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item active" data-item="uikits">
                        <a class="nav-item-hold" href="#">
                            <i class="nav-icon i-Library"></i>
                            <span class="nav-text">Master Data</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                </ul>
            </div>
            <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
                <i class="sidebar-close i-Close" (click)="toggelSidebar()"></i>
                <header>
                    <div class="logo">
                        <img src="../../dist-assets/images/logo-text.png" alt="">
                    </div>
                </header>
                <!-- Submenu Dashboards -->
                <div class="submenu-area" data-parent="uikits">
                    <header>
                        <h6>Master Data</h6>
                        <p>Master Data Management</p>
                    </header>
                    <ul class="childNav">
                        <li class="nav-item">
                            <a  href="{{ route('posts.index') }}">
                                <i class="nav-icon i-Bell1"></i>
                                <span class="item-name">Post Management</span>
                            </a>
                        </li>
                        @if(auth()->user()->role == 'admin')
						<li class="nav-item">
                            <a href="{{ route('branches.index') }}">
                                <i class="nav-icon i-Checked-User"></i>
                                <span class="item-name">Nama Cabang</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('regions.index') }}">
                                <i class="nav-icon i-Medal-2"></i>
                                <span class="item-name">Nama Regional</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}">
                                <i class="nav-icon i-Split-Horizontal-2-Window"></i>
                                <span class="item-name">Setting User</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
