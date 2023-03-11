<x-midone.login-layout>
    <!-- BEGIN: Forgot Form -->
        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Forgot your password?</h2>
                <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
                <form method="POST" action="{{ route('password.email') }}">
                    <div class="intro-x mt-8">
                        @csrf
                        <input id="email" name="email" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Email" value="{{ old('email') }}">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                    <div class="flex items-center mr-auto">

                    </div>
                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                    <button type="submit" id="btn-login" class="btn btn-primary  align-top">Email Password Reset Link</button>
                </div>
            </form>
            </div>
        </div>
    <!-- END: Forgot Form -->
</x-midone.login-layout>
