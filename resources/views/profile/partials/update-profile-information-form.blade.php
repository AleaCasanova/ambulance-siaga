<section class="space-y-6">
    <header>
        <div class="flex items-center gap-2 mb-2">
            <span class="px-2.5 py-1 rounded-full text-xs font-extrabold bg-primary-100 text-primary-700 uppercase tracking-wider">
                Data Diri & Identitas
            </span>
        </div>
        <h2 class="text-xl font-extrabold text-slate-800">
            Informasi Akun & Kedaruratan
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            Perbarui data diri, nomor telepon, dan identitas darurat. Data NIK, Tanggal Lahir, Kontak Darurat, dan Alamat yang dilengkapi di sini akan otomatis digunakan pada setiap Pemesanan Ambulans Darurat agar Anda tidak perlu mengisinya berulang kali saat situasi darurat.
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
                    Nama Lengkap <span class="text-primary-600">*</span>
                </label>
                <input id="name" name="name" type="text"
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium transition-all"
                       value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                @error('name') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Alamat Email -->
            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 mb-1.5">
                    Alamat Email <span class="text-primary-600">*</span>
                </label>
                <input id="email" name="email" type="email"
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium transition-all"
                       value="{{ old('email', $user->email) }}" required autocomplete="username" />
                @error('email') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-xs text-slate-600">
                            Email Anda belum diverifikasi.
                            <button form="send-verification" class="underline font-bold text-primary-600 hover:text-primary-700">
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
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium transition-all"
                       value="{{ old('phone', $user->phone) }}" />
                @error('phone') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

        </div>

        <!-- FORM DINAMIS BERDASARKAN ROLE -->
        @if($user->isSupir())
            <div class="mt-6 p-6 rounded-3xl bg-primary-50/70 border border-primary-100 space-y-6">
                <div class="flex items-center gap-2 pb-3 border-b border-primary-200/60">
                    <span class="w-2.5 h-2.5 rounded-full bg-primary-600"></span>
                    <h3 class="text-sm font-extrabold text-primary-900 uppercase tracking-wider">Informasi Lembaga Mitra & Armada Supir</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_lembaga" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Nama Lembaga / Organisasi
                        </label>
                        <input id="nama_lembaga" name="nama_lembaga" type="text"
                               placeholder="Contoh: PMI Cilacap / LAZ Peduli / RS Mitra"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium bg-white transition-all"
                               value="{{ old('nama_lembaga', $user->supir?->nama_lembaga) }}" />
                        @error('nama_lembaga') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="nama_penanggung_jawab" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Nama Driver / Penanggung Jawab
                        </label>
                        <input id="nama_penanggung_jawab" name="nama_penanggung_jawab" type="text"
                               placeholder="Nama PJ Armada"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium bg-white transition-all"
                               value="{{ old('nama_penanggung_jawab', $user->supir?->nama_penanggung_jawab) }}" />
                        @error('nama_penanggung_jawab') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="no_wa" class="block text-sm font-bold text-slate-700 mb-1.5">
                            No. WhatsApp (WA) Aktif
                        </label>
                        <input id="no_wa" name="no_wa" type="text"
                               placeholder="0812xxxxxx (WhatsApp)"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium bg-white transition-all"
                               value="{{ old('no_wa', $user->supir?->no_wa) }}" />
                        @error('no_wa') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="alamat_unit" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Alamat Unit Ambulance / Posko
                        </label>
                        <input id="alamat_unit" name="alamat_unit" type="text"
                               placeholder="Alamat penempatan unit ambulans"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium bg-white transition-all"
                               value="{{ old('alamat_unit', $user->supir?->alamat_unit) }}" />
                        @error('alamat_unit') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="merk_kendaraan" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Merk Kendaraan
                        </label>
                        <input id="merk_kendaraan" name="merk_kendaraan" type="text"
                               placeholder="Contoh: Toyota HiAce Commuter / Suzuki APV"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium bg-white transition-all"
                               value="{{ old('merk_kendaraan', $user->supir?->merk_kendaraan) }}" />
                        @error('merk_kendaraan') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="plat_nomor" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Plat No. Kendaraan
                        </label>
                        <input id="plat_nomor" name="plat_nomor" type="text"
                               placeholder="Contoh: R 9988 ZZ"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium bg-white transition-all"
                               value="{{ old('plat_nomor', $user->supir?->plat_nomor) }}" />
                        @error('plat_nomor') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="nomor_sim" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Nomor SIM (SIM A / B1 Umum)
                        </label>
                        <input id="nomor_sim" name="nomor_sim" type="text"
                               placeholder="Nomor SIM Driver"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium bg-white transition-all"
                               value="{{ old('nomor_sim', $user->supir?->nomor_sim) }}" />
                        @error('nomor_sim') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="nomor_stnk" class="block text-sm font-bold text-slate-700 mb-1.5">
                            STNK Kendaraan
                        </label>
                        <input id="nomor_stnk" name="nomor_stnk" type="text"
                               placeholder="Nomor STNK"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium bg-white transition-all"
                               value="{{ old('nomor_stnk', $user->supir?->nomor_stnk) }}" />
                        @error('nomor_stnk') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

        @elseif(!$user->isSupir() && !$user->isDispatcher() && !$user->isAdminOperasional())
            <div class="mt-6 p-6 rounded-3xl bg-slate-50/70 border border-slate-200 space-y-6">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-200">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                    <div>
                        <h3 class="text-sm font-extrabold text-slate-800 uppercase tracking-wider">Informasi Warga & Kedaruratan Pasien</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Data ini otomatis dihubungkan saat Anda melakukan panggilan ambulans darurat 24 Jam.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nik" class="block text-sm font-bold text-slate-700 mb-1.5">
                            NIK / No. KTP (16 Digit)
                        </label>
                        <input id="nik" name="nik" type="text" maxlength="16"
                               placeholder="330101xxxxxxxxxx"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium bg-white transition-all"
                               value="{{ old('nik', $user->masyarakat?->nik) }}" />
                        @error('nik') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Tanggal Lahir
                        </label>
                        <input id="tanggal_lahir" name="tanggal_lahir" type="date"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium bg-white transition-all"
                               value="{{ old('tanggal_lahir', $user->masyarakat?->tanggal_lahir?->format('Y-m-d')) }}" />
                        @error('tanggal_lahir') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Jenis Kelamin
                        </label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium bg-white transition-all">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L" {{ old('jenis_kelamin', $user->masyarakat?->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki (Pria)</option>
                            <option value="P" {{ old('jenis_kelamin', $user->masyarakat?->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan (Wanita)</option>
                        </select>
                        @error('jenis_kelamin') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="kontak_darurat" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Nomor Kontak Darurat Keluarga
                        </label>
                        <input id="kontak_darurat" name="kontak_darurat" type="text"
                               placeholder="0813-xxxx-xxxx (Keluarga/Kerabat)"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium bg-white transition-all"
                               value="{{ old('kontak_darurat', $user->masyarakat?->kontak_darurat) }}" />
                        @error('kontak_darurat') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-bold text-slate-700 mb-1.5">
                            Alamat Lengkap Tempat Tinggal
                        </label>
                        <textarea id="alamat" name="alamat" rows="3"
                                  placeholder="Contoh: Jl. Gatot Subroto No. 45, Sidanegara, Cilacap"
                                  class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 text-sm font-medium bg-white transition-all">{{ old('alamat', $user->masyarakat?->alamat) }}</textarea>
                        @error('alamat') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        @endif

        <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
            <button type="submit"
                    class="px-6 py-3 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-extrabold text-sm shadow-md shadow-primary-600/30 transition-all">
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
