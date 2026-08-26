<x-guest-layout>
    <div x-data="{
        step: 1,
        agreeTerms: false,
        email: '',
        phone: '',
        name: '',
        password: '',
        password_confirmation: '',
        nik: '',
        nomorSim: '',
        platNomor: '',
        merkKendaraan: '',
        nomorSkck: '',
        previewKtp: null,
        previewAvatar: null,
        previewSim: null,
        previewStnk: null,
        previewSkck: null,
        showProfileGuideModal: false,
        showSimGuideModal: false,
        showPassword: false,
        errorMessage: '',
        activeCamera: null,
        cameraTarget: '',
        cameraTargetInputId: '',
        cameraTitle: '',
        cameraFacingMode: 'environment',
        cameraGuideType: 'card',
        cameraError: '',
        cameraStream: null,
        async startCamera(target, inputId, title, facingMode = 'environment', guideType = 'card') {
            this.activeCamera = target;
            this.cameraTarget = target;
            this.cameraTargetInputId = inputId;
            this.cameraTitle = title;
            this.cameraFacingMode = facingMode;
            this.cameraGuideType = guideType;
            this.cameraError = '';

            await this.$nextTick();
            const video = document.getElementById('webcam-video-' + target);
            if (!video) return;

            try {
                if (this.cameraStream) {
                    this.cameraStream.getTracks().forEach(track => track.stop());
                }
                const constraints = {
                    video: {
                        facingMode: { ideal: facingMode },
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    },
                    audio: false
                };
                const stream = await navigator.mediaDevices.getUserMedia(constraints);
                this.cameraStream = stream;
                video.srcObject = stream;
                video.play();
            } catch (err) {
                console.error('Camera access error:', err);
                this.cameraError = 'Tidak dapat mengakses kamera. Pastikan izin kamera telah diizinkan atau gunakan tombol File.';
            }
        },
        stopCamera() {
            if (this.cameraStream) {
                this.cameraStream.getTracks().forEach(track => track.stop());
                this.cameraStream = null;
            }
            if (this.activeCamera) {
                const video = document.getElementById('webcam-video-' + this.activeCamera);
                if (video) video.srcObject = null;
            }
            this.activeCamera = null;
            this.cameraError = '';
        },
        switchCamera() {
            this.cameraFacingMode = (this.cameraFacingMode === 'environment') ? 'user' : 'environment';
            this.startCamera(this.cameraTarget, this.cameraTargetInputId, this.cameraTitle, this.cameraFacingMode, this.cameraGuideType);
        },
        capturePhoto() {
            const video = document.getElementById('webcam-video-' + this.activeCamera);
            const canvas = document.getElementById('webcam-canvas');
            if (!video || !canvas) return;

            const width = video.videoWidth || 1280;
            const height = video.videoHeight || 720;
            canvas.width = width;
            canvas.height = height;

            const ctx = canvas.getContext('2d');
            if (this.cameraFacingMode === 'user') {
                ctx.translate(width, 0);
                ctx.scale(-1, 1);
            }
            ctx.drawImage(video, 0, 0, width, height);

            const dataUrl = canvas.toDataURL('image/jpeg', 0.9);
            this[this.cameraTarget] = dataUrl;

            canvas.toBlob((blob) => {
                if (blob) {
                    const file = new File([blob], `${this.cameraTargetInputId}_${Date.now()}.jpg`, { type: 'image/jpeg' });
                    const input = document.getElementById(this.cameraTargetInputId);
                    if (input) {
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        input.files = dataTransfer.files;
                    }
                }
            }, 'image/jpeg', 0.9);

            this.stopCamera();
        },
        handleFileChange(event, target) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file maksimal 5MB.');
                    event.target.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = (e) => {
                    this[target] = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        removeFile(inputId, target) {
            this[target] = null;
            const input = document.getElementById(inputId);
            if (input) input.value = '';
        },
        validateStep2() {
            this.errorMessage = '';
            if (!this.email || !this.email.includes('@') || !this.email.includes('.')) {
                this.errorMessage = 'Alamat email aktif wajib diisi dengan format yang benar.';
                return;
            }
            if (!this.phone || this.phone.length < 8) {
                this.errorMessage = 'Nomor WhatsApp wajib diisi dengan benar (minimal 8 digit).';
                return;
            }
            if (!this.agreeTerms) {
                this.errorMessage = 'Anda harus menyetujui Syarat & Ketentuan serta Kebijakan Privasi.';
                return;
            }
            this.step = 3;
        },
        validateStep3() {
            this.errorMessage = '';
            if (!this.name || this.name.trim().length < 3) {
                this.errorMessage = 'Nama lengkap sesuai KTP wajib diisi.';
                return;
            }
            if (!this.password || this.password.length < 8) {
                this.errorMessage = 'Kata sandi minimal 8 karakter.';
                return;
            }
            if (this.password !== this.password_confirmation) {
                this.errorMessage = 'Konfirmasi kata sandi tidak cocok.';
                return;
            }
            this.step = 4;
        },
        validateStep4() {
            this.errorMessage = '';
            if (!this.previewAvatar) {
                this.errorMessage = 'Pas foto wajah pengemudi wajib diambil / diunggah.';
                return;
            }
            this.step = 5;
        },
        validateStep5() {
            this.errorMessage = '';
            if (!this.previewKtp) {
                this.errorMessage = 'Foto fisik e-KTP wajib diambil / diunggah.';
                return;
            }
            if (!this.nik || this.nik.trim().length < 16) {
                this.errorMessage = 'Nomor NIK 16 digit wajib diisi.';
                return;
            }
            this.step = 6;
        },
        validateStep6() {
            this.errorMessage = '';
            if (!this.previewSim) {
                this.errorMessage = 'Foto fisik SIM (A / B1) wajib diambil / diunggah.';
                return;
            }
            if (!this.nomorSim || this.nomorSim.trim() === '') {
                this.errorMessage = 'Nomor SIM wajib diisi.';
                return;
            }
            this.step = 7;
        },
        validateStep7() {
            this.errorMessage = '';
            if (!this.platNomor || this.platNomor.trim() === '') {
                this.errorMessage = 'Plat nomor kendaraan ambulans wajib diisi.';
                return;
            }
            this.step = 8;
        },
        validateAndSubmit(e) {
            this.errorMessage = '';
            if (!this.previewSkck) {
                this.errorMessage = 'Foto fisik surat SKCK kepolisian wajib diunggah.';
                e.preventDefault();
                return false;
            }
            return true;
        }
    }" class="w-full max-w-[480px] sm:max-w-[540px] my-auto">

        <!-- Card Container Panel Kanan -->
        <div class="bg-white rounded-3xl p-5 sm:p-7 shadow-[0_15px_40px_-10px_rgba(0,156,166,0.15)] border border-slate-100 relative overflow-hidden transition-all duration-300">

            <!-- Global Hidden Canvas for in-place photo capture -->
            <canvas id="webcam-canvas" class="hidden"></canvas>

            <!-- ========================================================================= -->
            <!-- SLIDE 1: WELCOME SCREEN -->
            <!-- ========================================================================= -->
            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <!-- Brand Header -->
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-primary-600/10 text-primary-600 flex items-center justify-center font-black">
                            🚑
                        </div>
                        <span class="text-sm font-black text-[#0F2747] tracking-tight">Ambulans Siaga</span>
                    </div>
                    <span class="text-[11px] font-bold text-slate-400">v1.2.0</span>
                </div>

                <!-- Hero Graphic Container -->
                <div class="my-6 text-center">
                    <div class="relative w-full h-44 rounded-2xl bg-gradient-to-br from-primary-600 via-[#009CA6] to-[#0F2747] p-4 flex items-center justify-center overflow-hidden shadow-md">
                        <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
                        <div class="absolute -left-8 -bottom-8 w-32 h-32 bg-black/15 rounded-full blur-xl"></div>
                        
                        <div class="relative z-10 flex items-center gap-4 text-white">
                            <div class="w-20 h-20 rounded-full bg-white/20 backdrop-blur-md border-2 border-white/40 flex items-center justify-center shadow-lg">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <span class="inline-block px-2.5 py-0.5 rounded-full bg-teal-300/20 border border-teal-200/40 text-[10px] font-black uppercase tracking-wider text-teal-100 mb-1">
                                    Siaga Tanggap Darurat
                                </span>
                                <h3 class="text-lg font-black leading-tight text-white">Mitra Pengemudi</h3>
                                <p class="text-xs text-sky-100/90 font-medium">Pahlawan Kemanusiaan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Headline & Subtitle -->
                <div class="text-center space-y-1.5 mb-8">
                    <h2 class="text-xl sm:text-2xl font-black text-[#0F2747] tracking-tight">
                        Halo, Calon Driver Siaga! <br>
                        <span class="text-primary-600">Mari Bergabung Bersama Kami</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium max-w-sm mx-auto">
                        Lengkapi formulir pendaftaran bertahap untuk bergabung menjadi pahlawan kemanusiaan.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    <button type="button" 
                            @click="step = 2"
                            class="w-full py-3.5 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-lg shadow-primary-600/20 hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer active:scale-95">
                        <span>Daftar Menjadi Pengemudi</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>

                    <a href="{{ route('login') }}" 
                       class="w-full py-3.5 px-6 rounded-full bg-transparent hover:bg-slate-50 border-2 border-primary-600 text-primary-700 font-black text-sm transition-all duration-200 flex items-center justify-center gap-2">
                        <span>Sudah Punya Akun? Masuk</span>
                    </a>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 text-center">
                    <p class="text-[11px] font-semibold text-slate-400">
                        Hak Cipta Dilindungi &copy; {{ date('Y') }} Ambulans Siaga Indonesia
                    </p>
                </div>
            </div>

            <!-- ========================================================================= -->
            <!-- MAIN REGISTRATION FORM (SLIDES 2 TO 8) -->
            <!-- ========================================================================= -->
            <form method="POST" action="{{ route('register.supir.store') }}" enctype="multipart/form-data" autocomplete="off" @submit="validateAndSubmit($event)">
                @csrf

                <!-- ========================================================================= -->
                <!-- SLIDE 2: AKUN & KONTAK (EMAIL & WA) -->
                <!-- ========================================================================= -->
                <div x-show="step === 2" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <!-- Step Progress Header -->
                    <div class="flex items-center justify-between mb-4">
                        <button type="button" @click="step = 1; stopCamera();" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </button>
                        <span class="text-xs font-black text-primary-600 bg-primary-50 px-3 py-1 rounded-full border border-primary-200">Langkah 1 dari 7</span>
                    </div>

                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mb-5">
                        <div class="bg-primary-600 h-full w-[14%] transition-all duration-300"></div>
                    </div>

                    <div class="mb-5">
                        <h3 class="text-xl font-black text-[#0F2747] tracking-tight">Akun & Kontak</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Masukkan email & nomor WhatsApp aktif untuk verifikasi.</p>
                    </div>

                    <div class="space-y-4 mb-6">
                        <!-- Email Field -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                Alamat Email Aktif <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm">✉️</span>
                                <input type="email" 
                                       name="email"
                                       x-model="email" 
                                       autocomplete="off"
                                       placeholder="contoh: driver@gmail.com" 
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-bold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-primary-600 outline-none transition-all">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-[11px]" />
                        </div>

                        <!-- Phone / WhatsApp Field -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                Nomor WhatsApp / HP <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1 px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-xs font-black text-slate-800 shrink-0">
                                    <span>🇮🇩 +62</span>
                                </div>
                                <input type="tel" 
                                       name="phone"
                                       x-model="phone" 
                                       autocomplete="off"
                                       placeholder="81234567890" 
                                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-bold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-primary-600 outline-none transition-all">
                            </div>
                            <x-input-error :messages="$errors->get('phone')" class="mt-1 text-[11px]" />
                        </div>

                        <!-- Terms Checkbox -->
                        <label class="flex items-start gap-3 cursor-pointer pt-1 select-none">
                            <input type="checkbox" 
                                   x-model="agreeTerms"
                                   class="mt-1 w-4 h-4 rounded border-slate-300 text-primary-600 focus:ring-primary-600 cursor-pointer">
                            <span class="text-xs font-semibold text-slate-600 leading-relaxed">
                                Saya menyetujui <a href="#" class="font-bold text-primary-600 hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="font-bold text-primary-600 hover:underline">Kebijakan Privasi</a> Ambulans Siaga.
                            </span>
                        </label>
                    </div>

                    <!-- Error Alert -->
                    <div x-show="errorMessage" class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs font-bold text-red-600" x-text="errorMessage"></div>

                    <button type="button" 
                            @click="validateStep2()"
                            class="w-full py-3.5 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-md shadow-primary-600/20 hover:shadow-lg transition-all transform active:scale-95 cursor-pointer">
                        Lanjut ke Data Diri →
                    </button>
                </div>

                <!-- ========================================================================= -->
                <!-- SLIDE 3: DATA DIRI & KATA SANDI -->
                <!-- ========================================================================= -->
                <div x-show="step === 3" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="flex items-center justify-between mb-4">
                        <button type="button" @click="step = 2; stopCamera();" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </button>
                        <span class="text-xs font-black text-primary-600 bg-primary-50 px-3 py-1 rounded-full border border-primary-200">Langkah 2 dari 7</span>
                    </div>

                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mb-5">
                        <div class="bg-primary-600 h-full w-[28%] transition-all duration-300"></div>
                    </div>

                    <div class="mb-5">
                        <h3 class="text-xl font-black text-[#0F2747] tracking-tight">Nama & Keamanan Akun</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Isi nama lengkap sesuai KTP dan tentukan kata sandi.</p>
                    </div>

                    <div class="space-y-4 mb-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                Nama Lengkap Sesuai KTP <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="name"
                                   x-model="name"
                                   placeholder="contoh: Budi Santoso"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-bold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-primary-600 outline-none transition-all">
                            <x-input-error :messages="$errors->get('name')" class="mt-1 text-[11px]" />
                        </div>

                        <!-- Kata Sandi & Konfirmasi Sandi -->
                        <div class="grid grid-cols-2 gap-2.5">
                            <div>
                                <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                    Kata Sandi <span class="text-red-500">*</span>
                                </label>
                                <input :type="showPassword ? 'text' : 'password'" 
                                       name="password"
                                       x-model="password"
                                       placeholder="Min. 8 karakter"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-[#0F2747] focus:bg-white focus:border-primary-600 outline-none">
                            </div>
                            <div>
                                <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                    Ulangi Sandi <span class="text-red-500">*</span>
                                </label>
                                <input :type="showPassword ? 'text' : 'password'" 
                                       name="password_confirmation"
                                       x-model="password_confirmation"
                                       placeholder="Ulangi sandi"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-[#0F2747] focus:bg-white focus:border-primary-600 outline-none">
                            </div>
                        </div>

                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" x-model="showPassword" class="rounded border-slate-300 text-primary-600 focus:ring-primary-600">
                            <span class="text-[11px] font-semibold text-slate-500">Tampilkan Kata Sandi</span>
                        </label>
                    </div>

                    <div x-show="errorMessage" class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs font-bold text-red-600" x-text="errorMessage"></div>

                    <button type="button" 
                            @click="validateStep3()"
                            class="w-full py-3.5 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-md shadow-primary-600/20 hover:shadow-lg transition-all transform active:scale-95 cursor-pointer">
                        Lanjut ke Pas Foto →
                    </button>
                </div>

                <!-- ========================================================================= -->
                <!-- SLIDE 4: PAS FOTO PENGEMUDI (SELFIE / WAJAH) -->
                <!-- ========================================================================= -->
                <div x-show="step === 4" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="flex items-center justify-between mb-4">
                        <button type="button" @click="step = 3; stopCamera();" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </button>
                        <span class="text-xs font-black text-primary-600 bg-primary-50 px-3 py-1 rounded-full border border-primary-200">Langkah 3 dari 7</span>
                    </div>

                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mb-5">
                        <div class="bg-primary-600 h-full w-[42%] transition-all duration-300"></div>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-black text-[#0F2747] tracking-tight">Pas Foto Pengemudi</h3>
                            <p class="text-xs text-slate-500 font-medium mt-0.5">Wajah tampak depan, tegak, dan latar belakang netral.</p>
                        </div>
                        <button type="button" @click="showProfileGuideModal = true" class="text-[11px] font-extrabold text-primary-600 hover:underline shrink-0 bg-primary-50 px-2.5 py-1 rounded-lg border border-primary-200">
                            Panduan Foto
                        </button>
                    </div>

                    <!-- Upload / In-Place Camera Box -->
                    <div class="mb-6">
                        <!-- Camera Viewport when active -->
                        <template x-if="activeCamera === 'previewAvatar'">
                            <div class="rounded-2xl bg-slate-900 text-white p-3 space-y-2.5 shadow-md border border-slate-800">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black text-white">📸 Posisikan Wajahmu di Kotak Foto</span>
                                    <button type="button" @click="stopCamera()" class="w-6 h-6 rounded-full bg-slate-800 text-slate-300 text-xs flex items-center justify-center hover:bg-slate-700 cursor-pointer">✕</button>
                                </div>
                                <div class="relative w-full h-56 bg-black rounded-xl overflow-hidden flex items-center justify-center">
                                    <video id="webcam-video-previewAvatar" autoplay playsinline muted class="w-full h-full object-cover"></video>
                                    <div class="absolute w-36 h-48 rounded-[50%] border-2 border-dashed border-teal-400 pointer-events-none flex items-center justify-center bg-teal-500/5 shadow-[0_0_0_9999px_rgba(0,0,0,0.4)]">
                                        <span class="text-[9px] font-black uppercase tracking-wider bg-teal-500/80 text-white px-2 py-0.5 rounded-full mt-32">
                                            Wajah Di Sini
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-1">
                                    <button type="button" @click="switchCamera()" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                        🔄 Putar
                                    </button>
                                    <button type="button" @click="capturePhoto()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-black shadow-md active:scale-95 transition-all cursor-pointer">
                                        📸 Ambil Foto
                                    </button>
                                    <button type="button" @click="stopCamera()" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </template>

                        <!-- Choice Buttons when inactive and no file chosen -->
                        <template x-if="activeCamera !== 'previewAvatar' && !previewAvatar">
                            <div class="p-6 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/70 hover:border-primary-400 transition-all text-center flex flex-col items-center justify-center">
                                <div class="w-14 h-14 rounded-full bg-white border border-slate-200 flex items-center justify-center text-primary-600 shadow-sm mb-3">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-800 mb-1">Ambil Foto Wajah Pengemudi</h4>
                                <p class="text-xs text-slate-400 max-w-xs mb-4">Gunakan kamera depan HP/laptop atau unggah file foto terbaik Anda.</p>
                                
                                <div class="flex items-center gap-3 w-full max-w-xs justify-center">
                                    <button type="button" 
                                            @click="startCamera('previewAvatar', 'avatar', 'Posisikan Wajahmu di Kotak Foto', 'user', 'face')" 
                                            class="flex-1 inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold shadow-md cursor-pointer active:scale-95 transition-all">
                                        <span>📸</span> Buka Kamera
                                    </button>
                                    <label for="avatar" class="flex-1 inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-full bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-bold cursor-pointer transition-colors shadow-xs">
                                        <span>📁</span> Pilih File
                                    </label>
                                </div>
                            </div>
                        </template>

                        <!-- Preview Card -->
                        <template x-if="activeCamera !== 'previewAvatar' && previewAvatar">
                            <div class="p-4 rounded-2xl border border-teal-200 bg-teal-50/40 flex items-center justify-between">
                                <div class="flex items-center gap-3.5">
                                    <img :src="previewAvatar" class="w-14 h-14 object-cover rounded-full border-2 border-teal-400 shadow-sm">
                                    <div>
                                        <p class="text-sm font-black text-teal-900 flex items-center gap-1">
                                            <span>✓</span> Pas Foto Berhasil Dipilih
                                        </p>
                                        <p class="text-xs text-slate-400">Siap dikirim untuk verifikasi</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button type="button" @click="startCamera('previewAvatar', 'avatar', 'Posisikan Wajahmu di Kotak Foto', 'user', 'face')" class="text-xs font-bold text-primary-600 hover:underline px-2 py-1">
                                        Ulang
                                    </button>
                                    <button type="button" @click="removeFile('avatar', 'previewAvatar')" class="text-xs font-bold text-red-500 hover:text-red-700 px-2 py-1">
                                        ✕
                                    </button>
                                </div>
                            </div>
                        </template>

                        <input id="avatar" type="file" name="avatar" accept="image/*" capture="user" @change="handleFileChange($event, 'previewAvatar')" class="hidden">
                    </div>

                    <div x-show="errorMessage" class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs font-bold text-red-600" x-text="errorMessage"></div>

                    <button type="button" 
                            @click="validateStep4()"
                            class="w-full py-3.5 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-md shadow-primary-600/20 hover:shadow-lg transition-all transform active:scale-95 cursor-pointer">
                        Lanjut ke Data e-KTP →
                    </button>
                </div>

                <!-- ========================================================================= -->
                <!-- SLIDE 5: IDENTITAS E-KTP & NOMOR NIK -->
                <!-- ========================================================================= -->
                <div x-show="step === 5" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="flex items-center justify-between mb-4">
                        <button type="button" @click="step = 4; stopCamera();" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </button>
                        <span class="text-xs font-black text-primary-600 bg-primary-50 px-3 py-1 rounded-full border border-primary-200">Langkah 4 dari 7</span>
                    </div>

                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mb-5">
                        <div class="bg-primary-600 h-full w-[57%] transition-all duration-300"></div>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-xl font-black text-[#0F2747] tracking-tight">Identitas e-KTP</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Ambil foto asli fisik e-KTP dan masukkan 16 digit NIK Anda.</p>
                    </div>

                    <div class="space-y-4 mb-6">
                        <!-- Camera / Upload e-KTP -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1.5">
                                Foto Fisik Asli e-KTP <span class="text-red-500">*</span>
                            </label>

                            <template x-if="activeCamera === 'previewKtp'">
                                <div class="rounded-2xl bg-slate-900 text-white p-3 space-y-2.5 shadow-md border border-slate-800">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-black text-white">📸 Posisikan e-KTP di Dalam Kotak</span>
                                        <button type="button" @click="stopCamera()" class="w-6 h-6 rounded-full bg-slate-800 text-slate-300 text-xs flex items-center justify-center hover:bg-slate-700 cursor-pointer">✕</button>
                                    </div>
                                    <div class="relative w-full h-56 bg-black rounded-xl overflow-hidden flex items-center justify-center">
                                        <video id="webcam-video-previewKtp" autoplay playsinline muted class="w-full h-full object-cover"></video>
                                        <div class="absolute inset-3 rounded-xl border-2 border-dashed border-teal-400 pointer-events-none flex flex-col justify-between p-2.5 bg-teal-500/5 shadow-[0_0_0_9999px_rgba(0,0,0,0.4)]">
                                            <span class="text-[9px] font-black uppercase tracking-wider bg-teal-500/80 text-white px-2 py-0.5 rounded-md w-max">
                                                e-KTP Pas di Kotak
                                            </span>
                                            <div class="flex justify-between">
                                                <div class="w-4 h-4 border-b-2 border-l-2 border-teal-300"></div>
                                                <div class="w-4 h-4 border-b-2 border-r-2 border-teal-300"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between pt-1">
                                        <button type="button" @click="switchCamera()" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            🔄 Putar
                                        </button>
                                        <button type="button" @click="capturePhoto()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-black shadow-md active:scale-95 transition-all cursor-pointer">
                                            📸 Ambil Foto
                                        </button>
                                        <button type="button" @click="stopCamera()" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewKtp' && !previewKtp">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3.5 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/70 hover:border-primary-400 transition-all">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-primary-600 shadow-xs">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-xs font-bold text-slate-700">Foto Fisik e-KTP</p>
                                            <p class="text-[10px] text-slate-400">Buka kamera atau unggah file</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" 
                                                @click="startCamera('previewKtp', 'foto_ktp', 'e-KTP-mu harus muat di kotak', 'environment', 'card')" 
                                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold shadow-xs cursor-pointer active:scale-95 transition-all">
                                            <span>📸</span> Buka Kamera
                                        </button>
                                        <label for="foto_ktp" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-full bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-bold cursor-pointer transition-colors shadow-xs">
                                            <span>📁</span> File
                                        </label>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewKtp' && previewKtp">
                                <div class="flex items-center justify-between p-3 rounded-2xl border border-teal-200 bg-teal-50/40">
                                    <div class="flex items-center gap-3">
                                        <img :src="previewKtp" class="w-14 h-10 object-cover rounded-xl border border-teal-300 shadow-xs">
                                        <div>
                                            <p class="text-xs font-bold text-teal-900 flex items-center gap-1">
                                                <span>✓</span> Foto e-KTP Terpilih
                                            </p>
                                            <p class="text-[10px] text-slate-400">Siap diunggah</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" @click="startCamera('previewKtp', 'foto_ktp', 'e-KTP-mu harus muat di kotak', 'environment', 'card')" class="text-xs text-primary-600 hover:underline font-bold">
                                            Ulang
                                        </button>
                                        <button type="button" @click="removeFile('foto_ktp', 'previewKtp')" class="text-xs text-red-500 hover:text-red-700 font-bold px-1.5">
                                            ✕
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <input id="foto_ktp" type="file" name="foto_ktp" accept="image/*" capture="environment" @change="handleFileChange($event, 'previewKtp')" class="hidden">
                            <x-input-error :messages="$errors->get('foto_ktp')" class="mt-1 text-[11px]" />
                        </div>

                        <!-- Input NIK -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                Nomor Induk Kependudukan (NIK) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="nik" 
                                   x-model="nik" 
                                   maxlength="16"
                                   placeholder="contoh: 3301012304900001"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-bold text-[#0F2747] focus:bg-white focus:border-primary-600 outline-none transition-all">
                            <span class="text-[10px] text-slate-400 font-medium mt-0.5 block">16 digit angka sesuai KTP.</span>
                        </div>
                    </div>

                    <div x-show="errorMessage" class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs font-bold text-red-600" x-text="errorMessage"></div>

                    <button type="button" 
                            @click="validateStep5()"
                            class="w-full py-3.5 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-md shadow-primary-600/20 hover:shadow-lg transition-all transform active:scale-95 cursor-pointer">
                        Lanjut ke Surat Izin Mengemudi (SIM) →
                    </button>
                </div>

                <!-- ========================================================================= -->
                <!-- SLIDE 6: SURAT IZIN MENGEMUDI (SIM) -->
                <!-- ========================================================================= -->
                <div x-show="step === 6" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="flex items-center justify-between mb-4">
                        <button type="button" @click="step = 5; stopCamera();" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </button>
                        <span class="text-xs font-black text-primary-600 bg-primary-50 px-3 py-1 rounded-full border border-primary-200">Langkah 5 dari 7</span>
                    </div>

                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mb-5">
                        <div class="bg-primary-600 h-full w-[71%] transition-all duration-300"></div>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-black text-[#0F2747] tracking-tight">Surat Izin Mengemudi (SIM)</h3>
                            <p class="text-xs text-slate-500 font-medium mt-0.5">Ambil foto SIM asli (A / B1) dan masukkan nomor SIM.</p>
                        </div>
                        <button type="button" @click="showSimGuideModal = true" class="text-[11px] font-extrabold text-primary-600 hover:underline shrink-0 bg-primary-50 px-2.5 py-1 rounded-lg border border-primary-200">
                            Panduan SIM
                        </button>
                    </div>

                    <div class="space-y-4 mb-6">
                        <!-- Camera / Upload SIM -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1.5">
                                Foto Kartu SIM (A / B1) <span class="text-red-500">*</span>
                            </label>

                            <template x-if="activeCamera === 'previewSim'">
                                <div class="rounded-2xl bg-slate-900 text-white p-3 space-y-2.5 shadow-md border border-slate-800">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-black text-white">📸 Posisikan SIM di Dalam Kotak</span>
                                        <button type="button" @click="stopCamera()" class="w-6 h-6 rounded-full bg-slate-800 text-slate-300 text-xs flex items-center justify-center hover:bg-slate-700 cursor-pointer">✕</button>
                                    </div>
                                    <div class="relative w-full h-56 bg-black rounded-xl overflow-hidden flex items-center justify-center">
                                        <video id="webcam-video-previewSim" autoplay playsinline muted class="w-full h-full object-cover"></video>
                                        <div class="absolute inset-3 rounded-xl border-2 border-dashed border-teal-400 pointer-events-none flex flex-col justify-between p-2.5 bg-teal-500/5 shadow-[0_0_0_9999px_rgba(0,0,0,0.4)]">
                                            <span class="text-[9px] font-black uppercase tracking-wider bg-teal-500/80 text-white px-2 py-0.5 rounded-md w-max">
                                                SIM Pas di Kotak
                                            </span>
                                            <div class="flex justify-between">
                                                <div class="w-4 h-4 border-b-2 border-l-2 border-teal-300"></div>
                                                <div class="w-4 h-4 border-b-2 border-r-2 border-teal-300"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between pt-1">
                                        <button type="button" @click="switchCamera()" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            🔄 Putar
                                        </button>
                                        <button type="button" @click="capturePhoto()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-black shadow-md active:scale-95 transition-all cursor-pointer">
                                            📸 Ambil Foto
                                        </button>
                                        <button type="button" @click="stopCamera()" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewSim' && !previewSim">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3.5 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/70 hover:border-primary-400 transition-all">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-primary-600 shadow-xs">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-xs font-bold text-slate-700">Foto Kartu SIM Asli</p>
                                            <p class="text-[10px] text-slate-400">Masih berlaku & jelas</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" 
                                                @click="startCamera('previewSim', 'foto_sim', 'SIM-mu harus muat di kotak', 'environment', 'card')" 
                                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold shadow-xs cursor-pointer active:scale-95 transition-all">
                                            <span>📸</span> Buka Kamera
                                        </button>
                                        <label for="foto_sim" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-full bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-bold cursor-pointer transition-colors shadow-xs">
                                            <span>📁</span> File
                                        </label>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewSim' && previewSim">
                                <div class="flex items-center justify-between p-3 rounded-2xl border border-teal-200 bg-teal-50/40">
                                    <div class="flex items-center gap-3">
                                        <img :src="previewSim" class="w-14 h-10 object-cover rounded-xl border border-teal-300 shadow-xs">
                                        <div>
                                            <p class="text-xs font-bold text-teal-900 flex items-center gap-1">
                                                <span>✓</span> Foto SIM Terpilih
                                            </p>
                                            <p class="text-[10px] text-slate-400">Siap diunggah</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" @click="startCamera('previewSim', 'foto_sim', 'SIM-mu harus muat di kotak', 'environment', 'card')" class="text-xs text-primary-600 hover:underline font-bold">
                                            Ulang
                                        </button>
                                        <button type="button" @click="removeFile('foto_sim', 'previewSim')" class="text-xs text-red-500 hover:text-red-700 font-bold px-1.5">
                                            ✕
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <input id="foto_sim" type="file" name="foto_sim" accept="image/*" capture="environment" @change="handleFileChange($event, 'previewSim')" class="hidden">
                            <x-input-error :messages="$errors->get('foto_sim')" class="mt-1 text-[11px]" />
                        </div>

                        <!-- Input Nomor SIM -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                Nomor SIM (A / B1) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="nomor_sim" 
                                   x-model="nomorSim" 
                                   placeholder="contoh: 123456789012"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-bold text-[#0F2747] focus:bg-white focus:border-primary-600 outline-none transition-all">
                            <x-input-error :messages="$errors->get('nomor_sim')" class="mt-1 text-[11px]" />
                        </div>
                    </div>

                    <div x-show="errorMessage" class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs font-bold text-red-600" x-text="errorMessage"></div>

                    <button type="button" 
                            @click="validateStep6()"
                            class="w-full py-3.5 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-md shadow-primary-600/20 hover:shadow-lg transition-all transform active:scale-95 cursor-pointer">
                        Lanjut ke Kendaraan & STNK →
                    </button>
                </div>

                <!-- ========================================================================= -->
                <!-- SLIDE 7: KENDARAAN & STNK -->
                <!-- ========================================================================= -->
                <div x-show="step === 7" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="flex items-center justify-between mb-4">
                        <button type="button" @click="step = 6; stopCamera();" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </button>
                        <span class="text-xs font-black text-primary-600 bg-primary-50 px-3 py-1 rounded-full border border-primary-200">Langkah 6 dari 7</span>
                    </div>

                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mb-5">
                        <div class="bg-primary-600 h-full w-[85%] transition-all duration-300"></div>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-xl font-black text-[#0F2747] tracking-tight">Kendaraan & STNK</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Lengkapi foto lembar STNK dan data plat kendaraan.</p>
                    </div>

                    <div class="space-y-4 mb-6">
                        <!-- Camera / Upload STNK -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1.5">
                                Foto Lembar STNK
                            </label>

                            <template x-if="activeCamera === 'previewStnk'">
                                <div class="rounded-2xl bg-slate-900 text-white p-3 space-y-2.5 shadow-md border border-slate-800">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-black text-white">📸 Posisikan STNK di Dalam Kotak</span>
                                        <button type="button" @click="stopCamera()" class="w-6 h-6 rounded-full bg-slate-800 text-slate-300 text-xs flex items-center justify-center hover:bg-slate-700 cursor-pointer">✕</button>
                                    </div>
                                    <div class="relative w-full h-56 bg-black rounded-xl overflow-hidden flex items-center justify-center">
                                        <video id="webcam-video-previewStnk" autoplay playsinline muted class="w-full h-full object-cover"></video>
                                        <div class="absolute inset-3 rounded-xl border-2 border-dashed border-teal-400 pointer-events-none flex flex-col justify-between p-2.5 bg-teal-500/5 shadow-[0_0_0_9999px_rgba(0,0,0,0.4)]">
                                            <span class="text-[9px] font-black uppercase tracking-wider bg-teal-500/80 text-white px-2 py-0.5 rounded-md w-max">
                                                STNK Pas di Kotak
                                            </span>
                                            <div class="flex justify-between">
                                                <div class="w-4 h-4 border-b-2 border-l-2 border-teal-300"></div>
                                                <div class="w-4 h-4 border-b-2 border-r-2 border-teal-300"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between pt-1">
                                        <button type="button" @click="switchCamera()" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            🔄 Putar
                                        </button>
                                        <button type="button" @click="capturePhoto()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-black shadow-md active:scale-95 transition-all cursor-pointer">
                                            📸 Ambil Foto
                                        </button>
                                        <button type="button" @click="stopCamera()" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewStnk' && !previewStnk">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3.5 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/70 hover:border-primary-400 transition-all">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-primary-600 shadow-xs">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-xs font-bold text-slate-700">Foto Lembar STNK</p>
                                            <p class="text-[10px] text-slate-400">Pajak & STNK aktif</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" 
                                                @click="startCamera('previewStnk', 'foto_stnk', 'STNK-mu harus muat di kotak', 'environment', 'card')" 
                                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold shadow-xs cursor-pointer active:scale-95 transition-all">
                                            <span>📸</span> Buka Kamera
                                        </button>
                                        <label for="foto_stnk" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-full bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-bold cursor-pointer transition-colors shadow-xs">
                                            <span>📁</span> File
                                        </label>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewStnk' && previewStnk">
                                <div class="flex items-center justify-between p-3 rounded-2xl border border-teal-200 bg-teal-50/40">
                                    <div class="flex items-center gap-3">
                                        <img :src="previewStnk" class="w-14 h-10 object-cover rounded-xl border border-teal-300 shadow-xs">
                                        <div>
                                            <p class="text-xs font-bold text-teal-900 flex items-center gap-1">
                                                <span>✓</span> Foto STNK Terpilih
                                            </p>
                                            <p class="text-[10px] text-slate-400">Siap diunggah</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" @click="startCamera('previewStnk', 'foto_stnk', 'STNK-mu harus muat di kotak', 'environment', 'card')" class="text-xs text-primary-600 hover:underline font-bold">
                                            Ulang
                                        </button>
                                        <button type="button" @click="removeFile('foto_stnk', 'previewStnk')" class="text-xs text-red-500 hover:text-red-700 font-bold px-1.5">
                                            ✕
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <input id="foto_stnk" type="file" name="foto_stnk" accept="image/*" capture="environment" @change="handleFileChange($event, 'previewStnk')" class="hidden">
                        </div>

                        <!-- Plat Nomor & Tipe Kendaraan -->
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                    Plat Nomor <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="plat_nomor" 
                                       x-model="platNomor" 
                                       placeholder="contoh: R 1234 AB"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-[#0F2747] focus:bg-white focus:border-primary-600 outline-none uppercase">
                                <x-input-error :messages="$errors->get('plat_nomor')" class="mt-1 text-[11px]" />
                            </div>

                            <div>
                                <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                    Tipe Kendaraan
                                </label>
                                <input type="text" 
                                       name="merk_kendaraan" 
                                       x-model="merkKendaraan" 
                                       placeholder="contoh: HiAce / APV"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-[#0F2747] focus:bg-white focus:border-primary-600 outline-none">
                            </div>
                        </div>
                    </div>

                    <div x-show="errorMessage" class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs font-bold text-red-600" x-text="errorMessage"></div>

                    <button type="button" 
                            @click="validateStep7()"
                            class="w-full py-3.5 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-md shadow-primary-600/20 hover:shadow-lg transition-all transform active:scale-95 cursor-pointer">
                        Lanjut ke SKCK Kepolisian (Langkah Terakhir) →
                    </button>
                </div>

                <!-- ========================================================================= -->
                <!-- SLIDE 8: DOKUMEN SKCK KEPOLISIAN (TERAKHIR & SUBMISSION) -->
                <!-- ========================================================================= -->
                <div x-show="step === 8" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="flex items-center justify-between mb-4">
                        <button type="button" @click="step = 7; stopCamera();" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </button>
                        <span class="text-xs font-black text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">Langkah Terakhir (7 dari 7)</span>
                    </div>

                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mb-5">
                        <div class="bg-emerald-500 h-full w-[100%] transition-all duration-300"></div>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-xl font-black text-[#0F2747] tracking-tight">Dokumen SKCK Kepolisian</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Surat Keterangan Catatan Kepolisian wajib diunggah untuk keamanan.</p>
                    </div>

                    <div class="space-y-4 mb-6">
                        <!-- Camera / Upload SKCK -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1.5">
                                Foto Fisik Surat SKCK <span class="text-red-500">*</span>
                            </label>

                            <template x-if="activeCamera === 'previewSkck'">
                                <div class="rounded-2xl bg-slate-900 text-white p-3 space-y-2.5 shadow-md border border-slate-800">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-black text-white">📸 Posisikan SKCK di Dalam Kotak</span>
                                        <button type="button" @click="stopCamera()" class="w-6 h-6 rounded-full bg-slate-800 text-slate-300 text-xs flex items-center justify-center hover:bg-slate-700 cursor-pointer">✕</button>
                                    </div>
                                    <div class="relative w-full h-56 bg-black rounded-xl overflow-hidden flex items-center justify-center">
                                        <video id="webcam-video-previewSkck" autoplay playsinline muted class="w-full h-full object-cover"></video>
                                        <div class="absolute inset-3 rounded-xl border-2 border-dashed border-teal-400 pointer-events-none flex flex-col justify-between p-2.5 bg-teal-500/5 shadow-[0_0_0_9999px_rgba(0,0,0,0.4)]">
                                            <span class="text-[9px] font-black uppercase tracking-wider bg-teal-500/80 text-white px-2 py-0.5 rounded-md w-max">
                                                Surat SKCK Pas di Kotak
                                            </span>
                                            <div class="flex justify-between">
                                                <div class="w-4 h-4 border-b-2 border-l-2 border-teal-300"></div>
                                                <div class="w-4 h-4 border-b-2 border-r-2 border-teal-300"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between pt-1">
                                        <button type="button" @click="switchCamera()" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            🔄 Putar
                                        </button>
                                        <button type="button" @click="capturePhoto()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-black shadow-md active:scale-95 transition-all cursor-pointer">
                                            📸 Ambil Foto
                                        </button>
                                        <button type="button" @click="stopCamera()" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewSkck' && !previewSkck">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3.5 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/70 hover:border-primary-400 transition-all">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-primary-600 shadow-xs">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-xs font-bold text-slate-700">Foto Surat SKCK Asli</p>
                                            <p class="text-[10px] text-slate-400">Dari Polsek / Polres aktif</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" 
                                                @click="startCamera('previewSkck', 'foto_skck', 'Surat SKCK harus muat di kotak', 'environment', 'card')" 
                                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold shadow-xs cursor-pointer active:scale-95 transition-all">
                                            <span>📸</span> Buka Kamera
                                        </button>
                                        <label for="foto_skck" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-full bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-bold cursor-pointer transition-colors shadow-xs">
                                            <span>📁</span> File
                                        </label>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewSkck' && previewSkck">
                                <div class="flex items-center justify-between p-3 rounded-2xl border border-teal-200 bg-teal-50/40">
                                    <div class="flex items-center gap-3">
                                        <img :src="previewSkck" class="w-14 h-10 object-cover rounded-xl border border-teal-300 shadow-xs">
                                        <div>
                                            <p class="text-xs font-bold text-teal-900 flex items-center gap-1">
                                                <span>✓</span> Foto SKCK Terpilih
                                            </p>
                                            <p class="text-[10px] text-slate-400">Siap diunggah</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" @click="startCamera('previewSkck', 'foto_skck', 'Surat SKCK harus muat di kotak', 'environment', 'card')" class="text-xs text-primary-600 hover:underline font-bold">
                                            Ulang
                                        </button>
                                        <button type="button" @click="removeFile('foto_skck', 'previewSkck')" class="text-xs text-red-500 hover:text-red-700 font-bold px-1.5">
                                            ✕
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <input id="foto_skck" type="file" name="foto_skck" accept="image/*" capture="environment" @change="handleFileChange($event, 'previewSkck')" class="hidden">
                            <x-input-error :messages="$errors->get('foto_skck')" class="mt-1 text-[11px]" />
                        </div>

                        <!-- Input Nomor SKCK -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                Nomor SKCK (dari Kepolisian)
                            </label>
                            <input type="text" 
                                   name="nomor_skck" 
                                   x-model="nomorSkck" 
                                   placeholder="contoh: SKCK/2026/POL/0192"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-bold text-[#0F2747] focus:bg-white focus:border-primary-600 outline-none transition-all">
                        </div>

                        <!-- Final Summary Banner -->
                        <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-start gap-2.5">
                            <span class="text-emerald-600 text-base">🛡️</span>
                            <p class="text-xs font-semibold text-emerald-900 leading-tight">
                                Data Anda akan diverifikasi oleh Admin Ambulans Siaga sebelum akun diaktifkan.
                            </p>
                        </div>
                    </div>

                    <div x-show="errorMessage" class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs font-bold text-red-600" x-text="errorMessage"></div>

                    <!-- Final Submission Button -->
                    <button type="submit"
                            class="w-full py-4 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-xl shadow-primary-600/25 hover:shadow-2xl transition-all transform active:scale-95 flex items-center justify-center gap-2 cursor-pointer">
                        <span>Kirim Pendaftaran Pengemudi</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </button>
                </div>

            </form>
        </div>

        <!-- ========================================================================= -->
        <!-- MODAL 1: PANDUAN FOTO PROFIL -->
        <!-- ========================================================================= -->
        <div x-show="showProfileGuideModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
             style="display: none;">

            <div @click.outside="showProfileGuideModal = false"
                 class="relative bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 overflow-hidden max-h-[90vh] overflow-y-auto">
                
                <h3 class="text-xl font-black text-[#0F2747] mb-4 text-center">
                    Panduan Foto Profil Pengemudi
                </h3>

                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div class="p-3 rounded-2xl bg-emerald-50/60 border border-emerald-200 text-center">
                        <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl font-black mb-2 shadow-inner">
                            👤
                        </div>
                        <span class="inline-flex items-center gap-1 text-[11px] font-black text-emerald-700">
                            <span>✓</span> Foto 1 (Benar)
                        </span>
                    </div>

                    <div class="p-3 rounded-2xl bg-red-50/60 border border-red-200 text-center">
                        <div class="w-16 h-16 mx-auto rounded-full bg-red-100 text-red-600 flex items-center justify-center text-2xl font-black mb-2 shadow-inner">
                            🕶️
                        </div>
                        <span class="inline-flex items-center gap-1 text-[11px] font-black text-red-700">
                            <span>✕</span> Foto 2 (Salah)
                        </span>
                    </div>

                    <div class="p-3 rounded-2xl bg-red-50/60 border border-red-200 text-center">
                        <div class="w-16 h-16 mx-auto rounded-full bg-red-100 text-red-600 flex items-center justify-center text-2xl font-black mb-2 shadow-inner">
                            🧱
                        </div>
                        <span class="inline-flex items-center gap-1 text-[11px] font-black text-red-700">
                            <span>✕</span> Foto 3 (Salah)
                        </span>
                    </div>

                    <div class="p-3 rounded-2xl bg-red-50/60 border border-red-200 text-center">
                        <div class="w-16 h-16 mx-auto rounded-full bg-red-100 text-red-600 flex items-center justify-center text-2xl font-black mb-2 shadow-inner">
                            🌑
                        </div>
                        <span class="inline-flex items-center gap-1 text-[11px] font-black text-red-700">
                            <span>✕</span> Foto 4 (Salah)
                        </span>
                    </div>
                </div>

                <ul class="space-y-2 text-xs font-semibold text-slate-600 mb-6 ps-2">
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-600 font-bold">•</span>
                        <span><strong>Foto 1 (benar):</strong> Foto diambil tegak lurus, wajah terlihat jelas, dan tidak kabur (blur).</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-red-500 font-bold">•</span>
                        <span><strong>Foto 2 (salah):</strong> Lepaskan kacamata hitam, topi, masker, atau helm. Gunakan pakaian rapi.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-red-500 font-bold">•</span>
                        <span><strong>Foto 3 (salah):</strong> Gunakan latar belakang polos/netral tanpa objek lain.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-red-500 font-bold">•</span>
                        <span><strong>Foto 4 (salah):</strong> Pastikan pencahayaan cukup dan wajah tidak terpotong.</span>
                    </li>
                </ul>

                <button type="button" 
                        @click="showProfileGuideModal = false"
                        class="w-full py-3 px-5 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-xs uppercase tracking-wider shadow-md cursor-pointer">
                    Oke, Saya Mengerti
                </button>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- MODAL 2: PANDUAN FOTO SIM -->
        <!-- ========================================================================= -->
        <div x-show="showSimGuideModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
             style="display: none;">

            <div @click.outside="showSimGuideModal = false"
                 class="relative bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 overflow-hidden max-h-[90vh] overflow-y-auto">
                
                <h3 class="text-xl font-black text-[#0F2747] mb-4 text-center">
                    Panduan Foto SIM (Surat Izin Mengemudi)
                </h3>

                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div class="p-3 rounded-2xl bg-emerald-50/60 border border-emerald-200 text-center">
                        <div class="w-16 h-12 mx-auto rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl font-black mb-2 shadow-inner">
                            🪪
                        </div>
                        <span class="inline-flex items-center gap-1 text-[11px] font-black text-emerald-700">
                            <span>✓</span> Foto Asli & Jelas
                        </span>
                    </div>

                    <div class="p-3 rounded-2xl bg-red-50/60 border border-red-200 text-center">
                        <div class="w-16 h-12 mx-auto rounded-lg bg-red-100 text-red-600 flex items-center justify-center text-xl font-black mb-2 shadow-inner">
                            ✂️
                        </div>
                        <span class="inline-flex items-center gap-1 text-[11px] font-black text-red-700">
                            <span>✕</span> Jangan Terpotong
                        </span>
                    </div>

                    <div class="p-3 rounded-2xl bg-red-50/60 border border-red-200 text-center">
                        <div class="w-16 h-12 mx-auto rounded-lg bg-red-100 text-red-600 flex items-center justify-center text-xl font-black mb-2 shadow-inner">
                            ⚡
                        </div>
                        <span class="inline-flex items-center gap-1 text-[11px] font-black text-red-700">
                            <span>✕</span> Hindari Silau/Flash
                        </span>
                    </div>

                    <div class="p-3 rounded-2xl bg-red-50/60 border border-red-200 text-center">
                        <div class="w-16 h-12 mx-auto rounded-lg bg-red-100 text-red-600 flex items-center justify-center text-xl font-black mb-2 shadow-inner">
                            📄
                        </div>
                        <span class="inline-flex items-center gap-1 text-[11px] font-black text-red-700">
                            <span>✕</span> Jangan Fotokopi
                        </span>
                    </div>
                </div>

                <ul class="space-y-2 text-xs font-semibold text-slate-600 mb-6 ps-2">
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-600 font-bold">•</span>
                        <span>Pastikan SIM masih aktif dan memfoto kartu SIM asli fisik.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-red-500 font-bold">•</span>
                        <span>Seluruh informasi pada nomor SIM, nama, dan tanggal kadaluarsa terbaca jelas.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-red-500 font-bold">•</span>
                        <span>Pastikan foto tidak kabur (blur) dan tidak tertutup pantulan cahaya.</span>
                    </li>
                </ul>

                <button type="button" 
                        @click="showSimGuideModal = false"
                        class="w-full py-3 px-5 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-xs uppercase tracking-wider shadow-md cursor-pointer">
                    Oke, Saya Mengerti
                </button>
            </div>
        </div>

        <!-- Tautan Kembali ke Beranda -->
        <div class="mt-4 text-center">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center justify-center gap-1.5 text-xs font-bold text-slate-500 hover:text-primary-600 transition-colors">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali ke Beranda Ambulans Siaga</span>
            </a>
        </div>

    </div>
</x-guest-layout>
