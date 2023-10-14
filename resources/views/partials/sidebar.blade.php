            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="/" class="text-nowrap logo-img">
                        <img src="{{ asset('images/logos/logo-perpus.png') }}" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Dashboard</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        {{-- member --}}
                        @if (auth()->user()->role === 'member')
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Buku</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/dashboard/books" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-book"></i>
                                    </span>
                                    <span class="hide-menu">Pinjam Buku</span>
                                </a>
                            </li>

                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Peminjaman</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/dashboard/bookings" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-notebook"></i>
                                    </span>
                                    <span class="hide-menu">Pinjaman Buku</span>
                                </a>
                            </li>
                        @endif

                        {{-- admin --}}
                        @if (auth()->user()->role === 'admin')
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Admin</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/dashboard/bookings" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-list"></i>
                                    </span>
                                    <span class="hide-menu">Daftar Peminjaman</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/dashboard/users" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-user"></i>
                                    </span>
                                    <span class="hide-menu">Kelola Pengguna</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/dashboard/books" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-book"></i>
                                    </span>
                                    <span class="hide-menu">Kelola Buku</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            </aside>
            <!--  Sidebar End -->
