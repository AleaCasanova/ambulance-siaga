@php
    $isAdminRole = auth()->user() && (auth()->user()->isAdmin() || auth()->user()->isOperator() || auth()->user()->isMitra());
@endphp

@if($isAdminRole)
    <x-admin-layout>
        <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
            <div class="flex-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider mb-2.5">
                    Pengaturan Akun & Keamanan
                </span>
                <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight leading-tight">
                    Profil Pengguna
                </h1>
                <p class="text-slate-500 text-[14px] mt-1.5 font-medium max-w-2xl">
                    Kelola informasi data diri, kredensial login, dan pengaturan keamanan akun Anda.
                </p>
            </div>
        </div>

        <div class="space-y-8 max-w-5xl">
            <!-- Card 1: Update Profile Information -->
            <div class="p-6 sm:p-8 bg-white border border-slate-200/80 rounded-3xl shadow-xs">
                <div class="max-w-4xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Card 2: Update Password -->
            <div class="p-6 sm:p-8 bg-white border border-slate-200/80 rounded-3xl shadow-xs">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Card 3: Delete Account -->
            <div class="p-6 sm:p-8 bg-white border border-slate-200/80 rounded-3xl shadow-xs">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </x-admin-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-primary-600"></span>
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
@endif
