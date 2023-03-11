
<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="{{ route('dashboard') }}" class="flex mr-auto">
            <img alt="" class="w-6" src="{{ asset('build/assets/images/logo.svg') }}">
        </a>
        <a href="javascript:;" class="mobile-menu-toggler">
            <i icon-name="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
    </div>
    <div class="scrollable">
        <a href="javascript:;" class="mobile-menu-toggler">
            <i icon-name="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
        <ul class="scrollable__content py-2">
            <li>
                <a href="{{ route('dashboard') }}" class="menu {{ request()->routeIs('dashboard') ? ' menu--active' : null }}">
                    <div class="menu__icon">
                        <i icon-name="home"></i>
                    </div>
                    <div class="menu__title">
                        Dashboard
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Mobile Menu -->


<div class="top-bar-boxed h-[70px] z-[51] relative border-b border-white/[0.08] mt-12 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 md:pt-0 mb-12">
    <div class="h-full flex items-center">
        <!-- BEGIN: Logo -->
        <a href="{{ route('dashboard') }}" class="-intro-x hidden md:flex">
            <img alt="" class="w-6" src="{{ asset('build/assets/images/logo.svg') }}">
            <span class="text-white text-lg ml-3">
                {{ config('app.name', 'Laravel') }}
            </span>
        </a>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        <nav aria-label="breadcrumb" class="-intro-x h-full mr-auto">
            {{ $breadcrumb ?? null}}
        </nav>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown w-8 h-8">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                <img alt="" src="{{ asset('build/assets/images/profile-12.jpg') }}">
            </div>
            <div class="dropdown-menu w-56">
                <ul class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                    <li class="p-2">
                        <div class="font-medium">{{ Auth::user()->name }}</div>
                        {{-- <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">{{ $fakers[0]['jobs'][0] }}</div> --}}
                    </li>
                    <li><hr class="dropdown-divider border-white/[0.08]"></li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item hover:bg-white/5">
                            <i icon-name="user" class="w-4 h-4 mr-2"></i> {{ __('Profile') }}
                        </a>
                    </li>
                    <li><hr class="dropdown-divider border-white/[0.08]"></li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li>
                            <a class="dropdown-item hover:bg-white/5"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                            <i icon-name="toggle-right" class="w-4 h-4 mr-2"></i> {{ __('Log Out') }}
                            </a>
                        </li>
                    </form>
                </ul>
            </div>
        </div>
        <!-- END: Account Menu -->
    </div>
</div>
