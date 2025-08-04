<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container mb-0">
        <a class="navbar-brand" href="{{ url('/') }}">
            GMS
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                {{-- {{Auth::user()->name}} --}}
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                @if (Auth::check())
                    {{-- Dynamic Navigation based on role --}}
                    @php
                        $menuItems = App\Helpers\MenuHelper::getNavbarMenuItems(Auth::user()->role);
                    @endphp
                    
                    @if (!empty($menuItems))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Menu') }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                                @foreach ($menuItems as $item)
                                    <a class="dropdown-item" href="{{ route($item['route']) }}">{{ $item['title'] }}</a>
                                @endforeach
                            </div>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nama_lengkap }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav> 