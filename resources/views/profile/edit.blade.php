<x-midone.app-layout>
    <x-slot name="breadcrumb">
        <nav aria-label="breadcrumb" class="-intro-x h-full mr-auto">
            <ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
    </x-slot>

    <x-slot name="disabled_sidebar">

    </x-slot>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Profil</h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 p-4 bg-white dark:bg-gray-800 shadow rounded intro-y">
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        <div class="col-span-12 p-4 bg-white dark:bg-gray-800 shadow rounded intro-y">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        <div class="col-span-12 p-4 bg-white dark:bg-gray-800 shadow rounded intro-y">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: General Report -->
            </div>
        </div>
    </div>
</x-midone.app-layout>
