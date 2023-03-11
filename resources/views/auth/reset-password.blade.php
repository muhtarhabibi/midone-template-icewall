<x-midone.login-layout>
    <!-- BEGIN: Login Form -->
    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
        <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
            <form method="POST" action="{{ route('password.store') }}">
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
                <button type="submit" id="btn-login" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">{{ __('Reset Password') }}</button>
            </div>
        </form>
        </div>
    </div>
<!-- END: Login Form -->
</x-midone.login-layout>
