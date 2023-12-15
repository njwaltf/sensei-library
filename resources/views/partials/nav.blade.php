<!--  Header Start -->
<style>
    #userDropdownContent {
        display: none;
        position: absolute;
        background-color: #fff;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        right: 0;
        opacity: 0;
        transition: opacity 0.3s ease;
        /* Animation transition */
    }

    #userDropdownContent.show {
        display: block;
        opacity: 1;
    }

    /* Add styles for the dropdown menu */
    #notificationDropdownContent {
        display: none;
        position: absolute;
        background-color: #fff;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        right: 0;
        opacity: 0;
        transition: opacity 0.3s ease;
        /* Animation transition */
    }

    #notificationDropdownContent.show {
        display: block;
        opacity: 1;
    }
</style>
<script>
    function toggleDropdown(dropdownId) {
        var dropdown = document.getElementById(dropdownId + 'Content');
        dropdown.classList.toggle('show'); // Toggle the 'show' class for animation
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        var dropdown = document.getElementById('userDropdownContent');
        var navLink = document.getElementById('userDropdown');
        if (!event.target.matches('.nav-link') && !event.target.matches('.dropdown-menu') &&
            !event.target.matches('.rounded-circle') && !event.target.matches('.nav-icon-hover')) {
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        }
    }
</script>
<script>
    function toggleDropdown(dropdownId) {
        var dropdown = document.getElementById(dropdownId + 'Content');
        dropdown.classList.toggle('show'); // Toggle the 'show' class for animation
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        var dropdown = document.getElementById('notificationDropdownContent');
        var navLink = document.getElementById('notificationDropdown');
        if (!event.target.matches('.nav-link') && !event.target.matches('.dropdown-menu') &&
            !event.target.matches('.notification') && !event.target.matches('.nav-icon-hover')) {
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        }
    }
</script>
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
                {{-- fav --}}
                @if (auth()->user()->role === 'member')
                    <li class="nav-item">
                        <a class="nav-link nav-icon-hover" href="{{ route('book-favorite') }}">
                            @if ($favorites->count())
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-heart-filled text-danger" width="20"
                                    height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M6.979 3.074a6 6 0 0 1 4.988 1.425l.037 .033l.034 -.03a6 6 0 0 1 4.733 -1.44l.246 .036a6 6 0 0 1 3.364 10.008l-.18 .185l-.048 .041l-7.45 7.379a1 1 0 0 1 -1.313 .082l-.094 -.082l-7.493 -7.422a6 6 0 0 1 3.176 -10.215z"
                                        stroke-width="0" fill="currentColor" />
                                </svg>
                                <div class="notification bg-danger rounded-circle"></div>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                </svg>
                            @endif
                        </a>
                    </li>
                @endif
                {{-- adm cta --}}
                @if (auth()->user()->role === 'admin')
                    <a href="/dashboard/books/create" class="btn btn-primary">Tambah Buku <i class="ti ti-plus"></i></a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="/dashboard/types/create" class="btn btn-success">Tambah Genre <i
                            class="ti ti-plus"></i></a>
                @endif
                {{-- notif --}}
                @if (auth()->user()->role === 'member')
                    <li class="nav-item dropdown" id="notificationDropdown">
                        <a class="nav-link nav-icon-hover" href="#" id="drop2"
                            onclick="toggleDropdown('notificationDropdown')" aria-expanded="false">
                            <i class="ti ti-bell-ringing"></i>
                            @if ($notifications->count())
                                <div class="notification bg-primary rounded-circle"></div>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                            id="notificationDropdownContent" aria-labelledby="drop2">
                            @if ($notifications->count())
                                @foreach ($notifications as $notif)
                                    <div class="message-body p-2">
                                        <div class="row">
                                            <div class="col-lg-9" style="margin-right: 18px">
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
                                                <form action="/dashboard/delete/notification/{{ $notif->id }}"
                                                    method="post" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
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
                <li class="nav-item dropdown" id="userDropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)"
                        onclick="toggleDropdown('userDropdown')">
                        <img src="{{ asset('storage/' . auth()->user()->prof_pic) }}" alt="" width="35"
                            height="35" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu" id="userDropdownContent">
                        <a href="/dashboard/profile" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-user fs-6"></i>
                            <p class="mb-0 fs-3">My Profile</p>
                        </a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="btn btn-outline-danger mx-3 mt-2 d-block my-2" style="width: 200px;">Keluar
                                <i class="ti ti-door-exit"></i></button>
                        </form>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>
<!--  Header End -->
