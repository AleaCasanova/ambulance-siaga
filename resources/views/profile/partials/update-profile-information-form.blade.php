@php
    $score = 0;
    if(!empty($user->name)) $score += 15;
    if(!empty($user->email)) $score += 15;
    if(!empty($user->phone)) $score += 15;
    if(!empty($user->avatar)) $score += 10;
    
    if($user->isSupir()) {
        if(!empty($user->supir?->plat_nomor) && $user->supir->plat_nomor !== '-') $score += 15;
        if(!empty($user->supir?->nomor_sim)) $score += 15;
        if(!empty($user->supir?->foto_sim)) $score += 15;
    } else {
        if(!empty($user->masyarakat?->nik) && $user->masyarakat->nik !== '-') $score += 15;
        if(!empty($user->masyarakat?->tanggal_lahir)) $score += 10;
        if(!empty($user->masyarakat?->jenis_kelamin)) $score += 10;
        if(!empty($user->masyarakat?->alamat) && $user->masyarakat->alamat !== '-') $score += 10;
    }
    $score = min(100, $score);
@endphp

<section class="space-y-6">
    <!-- Banner Kelengkapan Profil (Clean Dompet Dhuafa Style) -->
    <div class="bg-primary-50/70 border border-primary-200/60 rounded-lg px-4 py-3 mb-6 flex items-center justify-between">
        <span class="text-sm font-semibold text-primary-900">Kelengkapan profil Anda {{ $score }}%</span>
        <div class="w-36 bg-primary-200/50 rounded-full h-2 overflow-hidden">
            <div class="bg-primary-600 h-2 rounded-full transition-all duration-500" style="width: {{ $score }}%"></div>
        </div>
    </div>

    <!-- Hidden Resend Verification Form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Main Update Form -->
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
            
            <!-- Sub-Column Kiri: Foto Profil (Dompet Dhuafa Style) -->
            <div class="md:col-span-4 flex flex-col items-center text-center pt-1">
                <div class="w-32 h-32 rounded-full bg-slate-100 border-2 border-slate-200 overflow-hidden flex items-center justify-center relative mb-4">
                    @if($user->avatar)
                        <img id="avatar-preview-img" src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        <svg id="avatar-placeholder" class="w-20 h-20 text-slate-400 hidden" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    @else
                        <img id="avatar-preview-img" src="" alt="Preview" class="w-full h-full object-cover hidden">
                        <svg id="avatar-placeholder" class="w-20 h-20 text-slate-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    @endif
                </div>

                <!-- Hidden Native File Input -->
                <input type="file" id="avatar" name="avatar" class="hidden" accept="image/jpeg,image/png,image/jpg,image/webp" onchange="previewAvatar(this)">
                
                <!-- PILIH FOTO Button (Clean Dompet Dhuafa Style) -->
                <button type="button" onclick="document.getElementById('avatar').click()"
                        class="px-5 py-2 rounded-md border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold text-xs uppercase tracking-wider transition-colors cursor-pointer">
                    PILIH FOTO
                </button>
                @error('avatar') <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p> @enderror

                <!-- Caption Format & Ukuran Gambar -->
                <div class="mt-3 text-[11px] text-slate-400 space-y-0.5">
                    <p>Ukuran gambar: maks. 1 MB</p>
                    <p>Format gambar: .JPEG, .PNG</p>
                </div>
            </div>

            <!-- Sub-Column Kanan: Input Form Bersih & Natural -->
            <div class="md:col-span-8 space-y-4">
                
                <!-- Nama -->
                <div>
                    <label for="name" class="block text-xs font-semibold text-slate-700 mb-1">
                        Nama
                    </label>
                    <input id="name" name="name" type="text"
                           class="w-full px-3.5 py-2 rounded-md border border-slate-300 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 text-sm text-slate-800 transition-colors"
                           value="{{ old('name', $user->name) }}" required autocomplete="name" />
                    @error('name') <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Row: Gender & Tanggal Lahir (Dompet Dhuafa Style) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="jenis_kelamin" class="block text-xs font-semibold text-slate-700 mb-1">
                            Gender
                        </label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                                class="w-full px-3.5 py-2 rounded-md border border-slate-300 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 text-sm text-slate-800 transition-colors bg-white">
                            <option value="">Pilih Gender</option>
                            <option value="L" {{ old('jenis_kelamin', $user->masyarakat?->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $user->masyarakat?->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="tanggal_lahir" class="block text-xs font-semibold text-slate-700 mb-1">
                            Tanggal Lahir
                        </label>
                        <input id="tanggal_lahir" name="tanggal_lahir" type="date"
                               class="w-full px-3.5 py-2 rounded-md border border-slate-300 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 text-sm text-slate-800 transition-colors bg-white"
                               value="{{ old('tanggal_lahir', $user->masyarakat?->tanggal_lahir?->format('Y-m-d')) }}" />
                        @error('tanggal_lahir') <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Nomor KTP / NIK -->
                <div>
                    <label for="nik" class="block text-xs font-semibold text-slate-700 mb-1">
                        Nomor KTP
                    </label>
                    <input id="nik" name="nik" type="text" maxlength="16"
                           placeholder="330101xxxxxxxxxx"
                           class="w-full px-3.5 py-2 rounded-md border border-slate-300 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 text-sm text-slate-800 transition-colors"
                           value="{{ old('nik', $user->masyarakat?->nik) }}" />
                    @error('nik') <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Nomor Handphone -->
                <div>
                    <label for="phone" class="block text-xs font-semibold text-slate-700 mb-1">
                        Nomor Handphone
                    </label>
                    <input id="phone" name="phone" type="text"
                           placeholder="0812-3456-7890"
                           class="w-full px-3.5 py-2 rounded-md border border-slate-300 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 text-sm text-slate-800 transition-colors"
                           value="{{ old('phone', $user->phone) }}" />
                    @error('phone') <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">
                        Alamat Email
                    </label>
                    <input id="email" name="email" type="email"
                           class="w-full px-3.5 py-2 rounded-md border border-slate-300 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 text-sm text-slate-800 transition-colors"
                           value="{{ old('email', $user->email) }}" required autocomplete="username" />
                    @error('email') <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p> @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2 text-xs text-slate-500">
                            Email belum diverifikasi.
                            <button form="send-verification" class="text-primary-600 hover:underline font-semibold">
                                Kirim ulang email verifikasi
                            </button>
                            @if (session('status') === 'verification-link-sent')
                                <span class="text-emerald-600 block mt-1 font-medium">Link verifikasi baru telah dikirimkan.</span>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Nomor Kontak Darurat -->
                <div>
                    <label for="kontak_darurat" class="block text-xs font-semibold text-slate-700 mb-1">
                        Nomor Kontak Darurat (Keluarga)
                    </label>
                    <input id="kontak_darurat" name="kontak_darurat" type="text"
                           placeholder="0813-xxxx-xxxx"
                           class="w-full px-3.5 py-2 rounded-md border border-slate-300 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 text-sm text-slate-800 transition-colors"
                           value="{{ old('kontak_darurat', $user->masyarakat?->kontak_darurat) }}" />
                    @error('kontak_darurat') <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat Lengkap -->
                <div>
                    <label for="alamat" class="block text-xs font-semibold text-slate-700 mb-1">
                        Alamat
                    </label>
                    <textarea id="alamat" name="alamat" rows="3"
                              placeholder="Alamat lengkap..."
                              class="w-full px-3.5 py-2 rounded-md border border-slate-300 focus:border-primary-600 focus:ring-1 focus:ring-primary-600 text-sm text-slate-800 transition-colors">{{ old('alamat', $user->masyarakat?->alamat) }}</textarea>
                    @error('alamat') <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Bagian Khusus Supir / Driver -->
                @if($user->isSupir())
                    <div class="mt-5 p-4 rounded-lg bg-slate-50 border border-slate-200 space-y-3">
                        <h4 class="text-xs font-bold text-slate-700">Informasi Armada & Driver</h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="nama_lembaga" class="block text-xs text-slate-600 mb-1">Nama Mitra</label>
                                <input id="nama_lembaga" name="nama_lembaga" type="text"
                                       class="w-full px-3 py-1.5 rounded-md border border-slate-300 text-sm bg-white"
                                       value="{{ old('nama_lembaga', $user->supir?->mitra?->nama_mitra) }}" />
                            </div>

                            <div>
                                <label for="nama_penanggung_jawab" class="block text-xs text-slate-600 mb-1">Penanggung Jawab</label>
                                <input id="nama_penanggung_jawab" name="nama_penanggung_jawab" type="text"
                                       class="w-full px-3 py-1.5 rounded-md border border-slate-300 text-sm bg-white"
                                       value="{{ old('nama_penanggung_jawab', $user->supir?->mitra?->penanggung_jawab) }}" />
                            </div>

                            <div>
                                <label for="merk_kendaraan" class="block text-xs text-slate-600 mb-1">Merk Kendaraan</label>
                                <input id="merk_kendaraan" name="merk_kendaraan" type="text"
                                       class="w-full px-3 py-1.5 rounded-md border border-slate-300 text-sm bg-white"
                                       value="{{ old('merk_kendaraan', $user->supir?->merk_kendaraan) }}" />
                            </div>

                            <div>
                                <label for="plat_nomor" class="block text-xs text-slate-600 mb-1">Plat Nomor</label>
                                <input id="plat_nomor" name="plat_nomor" type="text"
                                       class="w-full px-3 py-1.5 rounded-md border border-slate-300 text-sm bg-white"
                                       value="{{ old('plat_nomor', $user->supir?->plat_nomor) }}" />
                            </div>

                            <div>
                                <label for="nomor_sim" class="block text-xs text-slate-600 mb-1">Nomor SIM</label>
                                <input id="nomor_sim" name="nomor_sim" type="text"
                                       class="w-full px-3 py-1.5 rounded-md border border-slate-300 text-sm bg-white"
                                       value="{{ old('nomor_sim', $user->supir?->nomor_sim) }}" />
                            </div>

                            <div>
                                <label for="nomor_stnk" class="block text-xs text-slate-600 mb-1">Nomor STNK</label>
                                <input id="nomor_stnk" name="nomor_stnk" type="text"
                                       class="w-full px-3 py-1.5 rounded-md border border-slate-300 text-sm bg-white"
                                       value="{{ old('nomor_stnk', $user->supir?->nomor_stnk) }}" />
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Tombol Simpan (Dompet Dhuafa Style: Clean Green/Cyan Rectangle) -->
                <div class="pt-3 flex items-center gap-4">
                    <button type="submit"
                            class="px-7 py-2.5 rounded-md bg-primary-600 hover:bg-primary-700 text-white font-bold text-sm shadow-xs transition-colors cursor-pointer">
                        Simpan
                    </button>

                    @if (session('status') === 'profile-updated')
                        <span x-data="{ show: true }"
                              x-show="show"
                              x-transition
                              x-init="setTimeout(() => show = false, 4000)"
                              class="text-xs font-semibold text-emerald-600">
                            Perubahan profil berhasil disimpan.
                        </span>
                    @endif
                </div>

            </div>
        </div>
    </form>
</section>

<!-- Vanilla JS Live Preview untuk Avatar -->
<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('avatar-preview-img');
                const placeholder = document.getElementById('avatar-placeholder');
                if (preview) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
