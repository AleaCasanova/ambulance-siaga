<x-guest-layout>
    <!-- Header Form -->
    <div class="mb-6 text-center">
        <h2 class="text-xl font-extrabold text-slate-800">Masuk ke Ambulance Siaga</h2>
        <p class="text-xs font-semibold text-slate-500 mt-1">
            Kelola operasional ambulans, penugasan medis, atau pantau pesanan Anda.
        </p>
    </div>

    <!-- Pending Emergency Order Alert -->
    @if(session('pending_order_code'))
        <div class="mb-5 p-4 rounded-2xl bg-sky-50 border border-sky-200 text-sky-900 text-left flex items-start gap-3 shadow-sm">
            <div class="w-7 h-7 rounded-lg bg-sky-600 text-white flex items-center justify-center font-bold flex-shrink-0 text-xs mt-0.5">
                !
            </div>
            <div>
                <h4 class="font-extrabold text-sm">Pesanan #{{ session('pending_order_code') }} Telah Terkirim!</h4>
                <p class="text-xs mt-0.5 text-sky-700 leading-relaxed font-medium">
                    Silakan masuk atau daftar akun di bawah ini agar Anda dapat melengkapi formulir kebutuhan medis pasien.
                </p>
            </div>
        </div>
    @endif

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                Alamat Email
            </label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                   placeholder="contoh: admin@ambulancesiaga.org"
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50/50 text-sm font-semibold text-slate-800 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1">
                <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Kata Sandi (Password)
                </label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-sky-600 hover:underline" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   placeholder="••••••••"
                   class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-slate-50/50 text-sm font-semibold text-slate-800 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                       class="w-4 h-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                <span class="ms-2 text-xs font-semibold text-slate-600">Ingat sesi saya</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit"
                    class="w-full py-3.5 px-6 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm shadow-lg shadow-sky-600/30 transition-all transform active:scale-[0.98]">
                MASUK KE SISTEM &rarr;
            </button>
        </div>
    </form>

    <!-- Register Link -->
    <div class="mt-6 pt-6 border-t border-slate-100 text-center">
        <p class="text-xs font-medium text-slate-500">
            Belum memiliki akun?
            <a href="{{ route('register') }}" class="font-extrabold text-sky-600 hover:underline ms-1">
                Daftar Akun Masyarakat
            </a>
        </p>
    </div>

    <!-- Quick Info Demo Accounts for Evaluator -->
    <div class="mt-6 p-4 rounded-2xl bg-slate-50 border border-slate-200/80 text-[11px] text-slate-600">
        <p class="font-extrabold text-slate-700 mb-2 flex items-center gap-1.5 uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-sky-600"></span>
            Kredensial Akun Demo (Seeder):
        </p>
        <div class="space-y-1.5">
            <div class="flex justify-between items-center">
                <span><strong>Super Admin:</strong> superadmin@ambulancesiaga.org</span>
                <code class="bg-white px-1.5 py-0.5 rounded border border-slate-200 text-slate-700 font-mono">password</code>
            </div>
            <div class="flex justify-between items-center">
                <span><strong>Dispatcher:</strong> dispatcher@ambulancesiaga.org</span>
                <code class="bg-white px-1.5 py-0.5 rounded border border-slate-200 text-slate-700 font-mono">password</code>
            </div>
            <div class="flex justify-between items-center">
                <span><strong>Supir Ambulans:</strong> supir1@ambulancesiaga.org</span>
                <code class="bg-white px-1.5 py-0.5 rounded border border-slate-200 text-slate-700 font-mono">password</code>
            </div>
            <div class="flex justify-between items-center">
                <span><strong>Masyarakat:</strong> masyarakat@ambulancesiaga.org</span>
                <code class="bg-white px-1.5 py-0.5 rounded border border-slate-200 text-slate-700 font-mono">password</code>
            </div>
        </div>
    </div>
</x-guest-layout>
