@if (!isset($disabled_sidebar))
    <div>
        <nav class="side-nav">
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="side-menu {{request()->routeIs('dashboard') ? 'side-menu--active' : null}}">
                        <div class="side-menu__icon">
                            <i icon-name="home"></i>
                        </div>
                        <div class="side-menu__title">
                            Dashboard
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endif
