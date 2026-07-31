<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-sky-600"></span>
            <h2 class="font-extrabold text-xl text-slate-800 leading-tight">
                {{ __('Pengaturan Akun & Profil') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Card 1: Update Profile Information -->
            <div class="p-6 sm:p-8 bg-white shadow-sm border border-slate-200/80 rounded-3xl">
                <div class="max-w-4xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Card 2: Update Password -->
            <div class="p-6 sm:p-8 bg-white shadow-sm border border-slate-200/80 rounded-3xl">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Card 3: Delete Account -->
            <div class="p-6 sm:p-8 bg-white shadow-sm border border-slate-200/80 rounded-3xl">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
