<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="30" alt="Logo UNAND">
        <img class="navbar-brand-minimized" src="{{ asset('img/logo.png') }}" width="30" alt="CoreUI Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    {{--Right Menu--}}

    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item d-md-down-none">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" onclick="readNotif()">
                <i class="icon-bell"></i>
                <span class="badge badge-pill badge-danger count-nof">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                <div class="dropdown-header text-center">
                    <strong class="text-nof">Anda Memiliki 0 Pemberitahuan</strong>
                </div>
                <div class="new-nof">
                </div>
                <div class="dropdown-header text-center" style="display: none">
                    <strong>Batas Notifikasi Belum Dilihat</strong>
                </div>
                <div class="target-nof">
                </div>
                <div class="dropdown-header text-center more-nof">
                    <strong>Tampilkan Lagi</strong>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false">
               @if(Auth::user()->type == 2 && Auth::user()->student->photo)
                <img src="{{ url('/images')}}/{{ Auth::user()->student->photo }}" style="" class="img-avatar" width="35" heigth="35" alt="{{ Auth::user()->email }}">
               @else
                <img src="{{ Avatar::create(Auth::user()->email)->toBase64() }}" class="img-avatar" alt="{{ Auth::user()->email }}">
               @endif
                <span class="d-md-down-none">{{ optional(Auth::user()->pegawai)->nama }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Personal</strong>
                </div>
                <a class="dropdown-item" href="{{ route('profile.show') }}">
                    <i class="fa fa-pencil"></i> Edit Profil
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Logout
                </a>
            </div>
        </li>
    </ul>

    <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

</header>
