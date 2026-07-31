<section class="space-y-6">
    <header>
        <div class="flex items-center gap-2 mb-2">
            <span class="px-2.5 py-1 rounded-full text-xs font-extrabold bg-sky-100 text-sky-700 uppercase tracking-wider">
                Data Diri & Identitas
            </span>
        </div>
        <h2 class="text-xl font-extrabold text-slate-800">
            Informasi Akun & Kedaruratan
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            Perbarui data diri, nomor telepon, dan identitas medis/darurat untuk mempercepat proses pelayanan ambulans GSC SIAGA Cilacap.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Nama Lengkap -->
            <div>
                <label for="name" class="block text-sm font-bold text-slate-700 mb-1.5">
                    Nama Lengkap <span class="text-sky-600">*</span>
                </label>
                <input id="name" name="name" type="text"
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all"
                       value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                @error('name') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Alamat Email -->
            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 mb-1.5">
                    Alamat Email <span class="text-sky-600">*</span>
                </label>
                <input id="email" name="email" type="email"
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all"
                       value="{{ old('email', $user->email) }}" required autocomplete="username" />
                @error('email') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-xs text-slate-600">
                            Email Anda belum diverifikasi.
                            <button form="send-verification" class="underline font-bold text-sky-600 hover:text-sky-700">
                                Klik di sini untuk mengirim ulang email verifikasi.
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-semibold text-xs text-emerald-600">
                                Link verifikasi baru telah dikirimkan ke alamat email Anda.
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Nomor Telepon / WhatsApp -->
            <div>
                <label for="phone" class="block text-sm font-bold text-slate-700 mb-1.5">
                    No. Telepon / WhatsApp
                </label>
                <input id="phone" name="phone" type="text"
                       placeholder="0812-3456-7890"
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all"
                       value="{{ old('phone', $user->phone) }}" />
                @error('phone') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- NIK / No. KTP -->
            <div>
                <label for="nik" class="block text-sm font-bold text-slate-700 mb-1.5">
                    NIK / No. KTP (16 Digit)
                </label>
                <input id="nik" name="nik" type="text" maxlength="16"
                       placeholder="330101xxxxxxxxxx"
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all"
                       value="{{ old('nik', $user->masyarakat?->nik) }}" />
                @error('nik') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <label for="tanggal_lahir" class="block text-sm font-bold text-slate-700 mb-1.5">
                    Tanggal Lahir
                </label>
                <input id="tanggal_lahir" name="tanggal_lahir" type="date"
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all"
                       value="{{ old('tanggal_lahir', $user->masyarakat?->tanggal_lahir?->format('Y-m-d')) }}" />
                @error('tanggal_lahir') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <label for="jenis_kelamin" class="block text-sm font-bold text-slate-700 mb-1.5">
                    Jenis Kelamin
                </label>
                <select id="jenis_kelamin" name="jenis_kelamin"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="L" {{ old('jenis_kelamin', $user->masyarakat?->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki (Pria)</option>
                    <option value="P" {{ old('jenis_kelamin', $user->masyarakat?->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan (Wanita)</option>
                </select>
                @error('jenis_kelamin') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Nomor Kontak Darurat -->
            <div>
                <label for="kontak_darurat" class="block text-sm font-bold text-slate-700 mb-1.5">
                    Nomor Kontak Darurat Keluarga
                </label>
                <input id="kontak_darurat" name="kontak_darurat" type="text"
                       placeholder="0813-xxxx-xxxx (Keluarga/Kerabat)"
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all"
                       value="{{ old('kontak_darurat', $user->masyarakat?->kontak_darurat) }}" />
                @error('kontak_darurat') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            @if($user->isSupir())
                <!-- Nomor SIM (Khusus Supir) -->
                <div>
                    <label for="nomor_sim" class="block text-sm font-bold text-slate-700 mb-1.5">
                        Nomor SIM (Khusus Supir)
                    </label>
                    <input id="nomor_sim" name="nomor_sim" type="text"
                           placeholder="Nomor SIM B1 / Umum"
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all"
                           value="{{ old('nomor_sim', $user->supir?->nomor_sim) }}" />
                    @error('nomor_sim') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                </div>
            @endif

            <!-- Alamat Lengkap -->
            <div class="md:col-span-2">
                <label for="alamat" class="block text-sm font-bold text-slate-700 mb-1.5">
                    Alamat Lengkap Tempat Tinggal
                </label>
                <textarea id="alamat" name="alamat" rows="3"
                          placeholder="Contoh: Jl. Gatot Subroto No. 45, Sidanegara, Cilacap"
                          class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 text-sm font-medium transition-all">{{ old('alamat', $user->masyarakat?->alamat) }}</textarea>
                @error('alamat') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
            <button type="submit"
                    class="px-6 py-3 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-sm shadow-md shadow-sky-600/30 transition-all">
                SIMPAN PERUBAHAN
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 4000)"
                   class="flex items-center gap-1.5 text-sm font-bold text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Perubahan profil berhasil disimpan.</span>
                </p>
            @endif
        </div>
    </form>
</section>
