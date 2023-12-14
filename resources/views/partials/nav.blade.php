<!--  Header Start -->
<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                @if (auth()->user()->role === 'admin')
                    <a href="/dashboard/books/create" class="btn btn-primary">Tambah Buku <i class="ti ti-plus"></i></a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="/dashboard/types/create" class="btn btn-success">Tambah Genre <i
                            class="ti ti-plus"></i></a>
                @endif
                @if (auth()->user()->role === 'member')
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-bell-ringing"></i>
                            @if ($notifications->count())
                                <div class="notification bg-primary rounded-circle"></div>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            @if ($notifications->count())
                                @foreach ($notifications as $notif)
                                    <div class="message-body p-2">
                                        <div class="row">
                                            <div class="col-lg-9" style="margin-right: 18px">
                                                <!-- Adjust the width as needed -->
                                                <a href="/dashboard/bookings/{{ $notif->booking_id }}"
                                                    class="d-flex align-items-center dropdown-item">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <p class="mb-0 fs-3 h5"><strong>{{ $notif->title }}</strong>
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <p>{{ Str::limit($notif->desc, 20, '...') }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-2 d-flex align-items-center justify-content-center">
                                                <!-- Adjust the width as needed -->
                                                <form action="/dashboard/delete/notification/{{ $notif->id }}"
                                                    method="post" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-link text-danger delete-button">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="message-body">
                                    <a href="/dashboard/profile" class="d-flex align-items-center dropdown-item">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="mb-0 fs-3 h5"><strong>Belum ada notifikasi</strong></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link nav-icon-hover" href="{{ route('qr-scanner') }}">
                        <img src="{{ asset('images/qr-code.png') }}" alt="" width="35" height="35"
                            class="rounded-circle">
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('storage/' . auth()->user()->prof_pic) }}" alt="" width="35"
                            height="35" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="/dashboard/profile" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-outline-danger mx-3 mt-2 d-block my-2"
                                    style="width: 200px;">Keluar <i class="ti ti-door-exit"></i></button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!--  Header End -->
