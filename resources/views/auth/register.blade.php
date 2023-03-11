
<x-midone.login-layout>
    <!-- BEGIN: Reg Form -->
        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Sign Up</h2>
                <div class="intro-x mt-2 text-slate-400 xl:hidden text-center"></div>
                <form method="POST" action="{{ route('register') }}">
                <div class="intro-x mt-8">
                        @csrf
                        <input id="name" name="name" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Name" value="{{ old('name') }}">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <input id="email" name="email" type="text" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Email" value="{{ old('email') }}">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <input id="password" type="password" name="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <input id="password_confirmation" type="password" name="password_confirmation" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password Confirmation">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                    <button type="submit" id="btn-login" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register</button>
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Login</a>
                    @endif
                </div>
            </form>
                <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left">
                    By signin up, you agree to our <a class="text-primary dark:text-slate-200" href="">Terms and Conditions</a> & <a class="text-primary dark:text-slate-200" href="">Privacy Policy</a>
                </div>
            </div>
        </div>
    <!-- END: Reg Form -->
</x-midone.login-layout>
