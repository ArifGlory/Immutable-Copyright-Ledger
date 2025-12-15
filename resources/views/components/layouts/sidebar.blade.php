<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
       id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
            <img src="{{asset('assets/img/psikotest_logo2.png')}}"
                 class="navbar-brand-img w-25 h-100" alt="...">
            <span class="ms-3 font-weight-bold"></span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse h-100 w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('dashboard') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                           class="fas fa-lg fa-home ps-2 pe-2 text-center text-dark {{ (Request::routeIs('dashboard') ? 'text-white' : 'text-dark') }} "
                           aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @hasanyrole(['superadmin', 'admin'])
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('category.index') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                               class="fas fa-lg fa-list ps-2 pe-2 text-center text-dark {{ (Request::routeIs('category.index') ? 'text-white' : 'text-dark') }} "
                               aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kategori</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('wallpaper.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('wallpaper.index') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                               class="fas fa-database fa-list ps-2 pe-2 text-center text-dark {{ (Request::routeIs('wallpaper.index') ? 'text-white' : 'text-dark') }} "
                               aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Wallpaper</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('user.index') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                               class="fas fa-users ps-2 pe-2 text-center text-dark {{ (Request::routeIs('user.index') ? 'text-white' : 'text-dark') }} "
                               aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pengguna</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('setting.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md {{ (Request::routeIs('setting.index') ? 'bg-gradient-dark' : 'bg-white') }} text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                               class="fas fa-lg fa-gear ps-2 pe-2 text-center text-dark {{ (Request::routeIs('setting.index') ? 'text-white' : 'text-dark') }} "
                               aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Setting</span>
                    </a>
                </li>
            @endhasanyrole
            <hr class="horizontal dark mt-2 mb-3">
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fa fa-sign-out-alt me-2"></i>Sign Out
                    </button>
                </form>
            </li>
        </ul>
    </div>

</aside>
