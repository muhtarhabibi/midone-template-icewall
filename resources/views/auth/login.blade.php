<x-midone.login-layout>
    <!-- BEGIN: Login Form -->
    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
        <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Sign In</h2>
            <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
            <form method="POST" action="{{ route('login') }}">
            <div class="intro-x mt-8">
                    @csrf
                    <input id="email" name="email" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Email" value="{{ old('email') }}">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <input id="password" type="password" name="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                <div class="flex items-center mr-auto">
                    <input id="remember_me" type="checkbox" name="remember" class="form-check-input border mr-2">
                    <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                </div>
                @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
            </div>
            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                <button type="submit" id="btn-login" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Register</a>
                @endif
            </div>
        </form>
        </div>
    </div>
<!-- END: Login Form -->
</x-midone.login-layout>
