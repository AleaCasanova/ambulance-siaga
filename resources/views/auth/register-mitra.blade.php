<x-guest-layout>
    <div x-data="{
        step: 1,
        agreeTerms: false,
        email: '',
        phone: '',
        namaLembaga: '',
        name: '',
        alamat: '',
        password: '',
        password_confirmation: '',
        nikPj: '',
        nomorLegalitas: '',
        platNomorUnit: '',
        merkKendaraan: '',
        previewKtpPj: null,
        previewLegalitas: null,
        previewAmbulans: null,
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
            const canvas = document.getElementById('webcam-canvas-mitra');
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
                this.errorMessage = 'Alamat email resmi lembaga wajib diisi dengan format yang benar.';
                return;
            }
            this.phone = this.phone ? this.phone.replace(/^(\+?62|0)+/, '').replace(/\D/g, '') : '';
            if (!this.phone || this.phone.length < 8) {
                this.errorMessage = 'Nomor telepon / WhatsApp resmi lembaga wajib diisi (minimal 8 digit).';
                return;
            }
            if (!this.agreeTerms) {
                this.errorMessage = 'Anda harus menyetujui Syarat & Ketentuan serta Kebijakan Privasi Kemitraan.';
                return;
            }
            this.step = 3;
        },
        validateStep3() {
            this.errorMessage = '';
            if (!this.namaLembaga || this.namaLembaga.trim().length < 3) {
                this.errorMessage = 'Nama resmi lembaga / yayasan / instansi wajib diisi.';
                return;
            }
            if (!this.password || this.password.length < 8) {
                this.errorMessage = 'Kata sandi akun minimal 8 karakter.';
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
            if (!this.name || this.name.trim().length < 3) {
                this.errorMessage = 'Nama penanggung jawab wajib diisi.';
                return;
            }
            if (!this.previewKtpPj) {
                this.errorMessage = 'Foto fisik e-KTP penanggung jawab wajib diambil / diunggah.';
                return;
            }
            this.step = 5;
        },
        validateStep5() {
            this.errorMessage = '';
            if (!this.previewLegalitas) {
                this.errorMessage = 'Foto dokumen legalitas / izin operasional lembaga wajib diunggah.';
                return;
            }
            this.step = 6;
        },
        validateStep6() {
            this.errorMessage = '';
            if (!this.platNomorUnit || this.platNomorUnit.trim() === '') {
                this.errorMessage = 'Plat nomor unit ambulans utama wajib diisi.';
                return;
            }
            if (!this.previewAmbulans) {
                this.errorMessage = 'Foto fisik unit ambulans wajib diambil / diunggah.';
                return;
            }
            this.step = 7;
        },
        validateAndSubmit(e) {
            this.errorMessage = '';
            return true;
        }
    }" class="w-full max-w-[480px] sm:max-w-[540px] my-auto">

        <!-- Card Container Panel Kanan -->
        <div class="bg-white rounded-3xl p-5 sm:p-7 shadow-[0_15px_40px_-10px_rgba(0,156,166,0.15)] border border-slate-100 relative overflow-hidden transition-all duration-300">

            <!-- Global Hidden Canvas for in-place photo capture -->
            <canvas id="webcam-canvas-mitra" class="hidden"></canvas>

            <!-- ========================================================================= -->
            <!-- SLIDE 1: WELCOME SCREEN MITRA LEMBAGA -->
            <!-- ========================================================================= -->
            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <!-- Brand Header -->
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center p-1.5 shadow-xs">
                            <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo Ambulans Siaga" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <span class="text-sm font-black text-[#0F2747] tracking-tight block leading-none">Ambulans Siaga</span>
                            <span class="text-[10px] font-bold text-slate-400">Portal Kemitraan</span>
                        </div>
                    </div>
                    <span class="text-[11px] font-extrabold px-2.5 py-1 rounded-full bg-teal-50 text-primary-700 border border-teal-200/60">Mitra Lembaga</span>
                </div>

                <!-- Headline & Subtitle -->
                <div class="text-center space-y-2 my-8">
                    <h2 class="text-xl sm:text-2xl font-black text-[#0F2747] tracking-tight">
                        Daftarkan Armada Lembaga Anda <br>
                        <span class="text-primary-600">Bergabung Bersama Jaringan Siaga</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium max-w-sm mx-auto leading-relaxed">
                        Integrasikan armada ambulans yayasan/instansi Anda untuk pelayanan darurat yang lebih luas dan terkoordinasi.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    <button type="button" 
                            @click="step = 2"
                            class="w-full py-3.5 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-lg shadow-primary-600/20 hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer active:scale-95">
                        <span>Daftarkan Lembaga & Armada</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>

                    <a href="{{ route('login') }}" 
                       class="w-full py-3.5 px-6 rounded-full bg-transparent hover:bg-slate-50 border-2 border-primary-600 text-primary-700 font-black text-sm transition-all duration-200 flex items-center justify-center gap-2">
                        <span>Sudah Memiliki Akun Mitra? Masuk</span>
                    </a>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 text-center flex flex-col gap-1.5">
                    <p class="text-[11px] font-semibold text-slate-500">
                        Ingin mendaftar sebagai pengemudi perorangan? 
                        <a href="{{ route('register.supir') }}" class="font-extrabold text-primary-600 hover:underline ms-1">Daftar Pengemudi</a>
                    </p>
                    <p class="text-[10px] text-slate-400">
                        Hak Cipta Dilindungi &copy; {{ date('Y') }} Ambulans Siaga Indonesia
                    </p>
                </div>
            </div>

            <!-- ========================================================================= -->
            <!-- MAIN REGISTRATION FORM (SLIDES 2 TO 7) -->
            <!-- ========================================================================= -->
            <form method="POST" action="{{ route('register.mitra.store') }}" enctype="multipart/form-data" autocomplete="off" @submit="validateAndSubmit($event)">
                @csrf

                <!-- ========================================================================= -->
                <!-- STEPPER HEADER (Clean Pill Badge & Back Button) -->
                <!-- ========================================================================= -->
                <div x-show="step >= 2" class="mb-5 pb-4 border-b border-slate-100 flex items-center justify-between">
                    <!-- Back Button -->
                    <button type="button" 
                            @click="step > 1 ? step-- : step = 1; stopCamera();" 
                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-all cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span>Kembali</span>
                    </button>

                    <!-- Step Pill Badge -->
                    <span class="text-xs font-black tracking-tight px-3.5 py-1.5 rounded-full border transition-all"
                          :class="step === 7 ? 'bg-emerald-50 text-emerald-800 border-emerald-200' : 'bg-teal-50 text-primary-800 border-teal-200'"
                          x-text="step === 7 ? 'Langkah Terakhir (6 dari 6)' : 'Langkah ' + (step - 1) + ' dari 6'">
                    </span>
                </div>

                <!-- ========================================================================= -->
                <!-- SLIDE 2: AKUN & KONTAK RESMI LEMBAGA -->
                <!-- ========================================================================= -->
                <div x-show="step === 2" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="mb-5">
                        <h3 class="text-xl font-black text-[#0F2747] tracking-tight">Akun & Kontak Lembaga</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Gunakan email & nomor telepon resmi instansi / yayasan Anda.</p>
                    </div>

                    <div class="space-y-4 mb-6">
                        <!-- Email Field -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                Email Resmi Lembaga <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   x-model="email" 
                                   autocomplete="off"
                                   placeholder="contoh: yayasan.peduli@gmail.com" 
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-bold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-primary-600 outline-none transition-all">
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-[11px]" />
                        </div>

                        <!-- Phone / WA Field -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                Nomor Telepon / WhatsApp Resmi <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1 px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-xs font-black text-slate-800 shrink-0">
                                    <span>🇮🇩 +62</span>
                                </div>
                                <input type="tel" 
                                       name="phone"
                                       x-model="phone" 
                                       @input="phone = phone.replace(/^(\+?62|0)+/, '').replace(/\D/g, '')"
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
                                Lembaga kami menyetujui <a href="#" class="font-bold text-primary-600 hover:underline">Syarat & Ketentuan Kemitraan</a> serta <a href="#" class="font-bold text-primary-600 hover:underline">Kebijakan Privasi</a> Ambulans Siaga.
                            </span>
                        </label>
                    </div>

                    <div x-show="errorMessage" class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs font-bold text-red-600" x-text="errorMessage"></div>

                    <button type="button" 
                            @click="validateStep2()"
                            class="w-full py-3.5 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-md shadow-primary-600/20 hover:shadow-lg transition-all transform active:scale-95 cursor-pointer">
                        Lanjut ke Profil Lembaga →
                    </button>
                </div>

                <!-- ========================================================================= -->
                <!-- SLIDE 3: DATA PROFIL LEMBAGA & KATA SANDI -->
                <!-- ========================================================================= -->
                <div x-show="step === 3" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="mb-5">
                        <h3 class="text-xl font-black text-[#0F2747] tracking-tight">Profil Lembaga & Kata Sandi</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Nama resmi instansi/yayasan dan kata sandi akun pengelola.</p>
                    </div>

                    <div class="space-y-4 mb-6">
                        <!-- Nama Lembaga -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                Nama Lembaga / Yayasan / Rumah Sakit <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="nama_lembaga"
                                   x-model="namaLembaga"
                                   placeholder="contoh: RS Kasih Ibu / Yayasan Relawan Peduli"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-bold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-primary-600 outline-none transition-all">
                            <x-input-error :messages="$errors->get('nama_lembaga')" class="mt-1 text-[11px]" />
                        </div>

                        <!-- Alamat Kantor Lembaga -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                Alamat Kantor / Posko Operasional
                            </label>
                            <input type="text" 
                                   name="alamat"
                                   x-model="alamat"
                                   placeholder="contoh: Jl. Merdeka No. 45, Cilacap"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-[#0F2747] placeholder:text-slate-400 focus:bg-white focus:border-primary-600 outline-none transition-all">
                        </div>

                        <!-- Password Fields -->
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
                        Lanjut ke Penanggung Jawab →
                    </button>
                </div>

                <!-- ========================================================================= -->
                <!-- SLIDE 4: PENANGGUNG JAWAB & FOTO E-KTP PJ -->
                <!-- ========================================================================= -->
                <div x-show="step === 4" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="mb-4">
                        <h3 class="text-xl font-black text-[#0F2747] tracking-tight">Penanggung Jawab Lembaga</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Identitas pimpinan / pengelola resmi yang bertanggung jawab.</p>
                    </div>

                    <div class="space-y-4 mb-6">
                        <!-- Nama Penanggung Jawab -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                Nama Lengkap Penanggung Jawab <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   x-model="name" 
                                   placeholder="contoh: Dr. H. Ahmad Fauzi / Budi Santoso, S.Sos"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-bold text-[#0F2747] focus:bg-white focus:border-primary-600 outline-none transition-all">
                            <x-input-error :messages="$errors->get('name')" class="mt-1 text-[11px]" />
                        </div>

                        <!-- NIK PJ -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                Nomor Induk Kependudukan (NIK) PJ
                            </label>
                            <input type="text" 
                                   name="nik_pj" 
                                   x-model="nikPj" 
                                   maxlength="16"
                                   placeholder="contoh: 3301012304900001"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-bold text-[#0F2747] focus:bg-white focus:border-primary-600 outline-none transition-all">
                        </div>

                        <!-- Camera / Upload KTP PJ -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1.5">
                                Foto Fisik e-KTP Penanggung Jawab <span class="text-red-500">*</span>
                            </label>

                            <template x-if="activeCamera === 'previewKtpPj'">
                                <div class="rounded-2xl bg-slate-900 text-white p-3 space-y-2.5 shadow-md border border-slate-800">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-black text-white">Posisikan e-KTP di Dalam Kotak</span>
                                        <button type="button" @click="stopCamera()" class="w-6 h-6 rounded-full bg-slate-800 text-slate-300 text-xs flex items-center justify-center hover:bg-slate-700 cursor-pointer">✕</button>
                                    </div>
                                    <div class="relative w-full h-56 bg-black rounded-xl overflow-hidden flex items-center justify-center">
                                        <video id="webcam-video-previewKtpPj" autoplay playsinline muted class="w-full h-full object-cover"></video>
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
                                        <button type="button" @click="switchCamera()" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                            <span>Putar Kamera</span>
                                        </button>
                                        <button type="button" @click="capturePhoto()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-black shadow-md active:scale-95 transition-all cursor-pointer">
                                            Ambil Foto
                                        </button>
                                        <button type="button" @click="stopCamera()" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewKtpPj' && !previewKtpPj">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3.5 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/70 hover:border-primary-400 transition-all">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-primary-600 shadow-xs">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-xs font-bold text-slate-700">Foto e-KTP Penanggung Jawab</p>
                                            <p class="text-[10px] text-slate-400">Buka kamera atau unggah file</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" 
                                                @click="startCamera('previewKtpPj', 'foto_ktp_pj', 'e-KTP PJ harus muat di kotak', 'environment', 'card')" 
                                                class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold shadow-xs cursor-pointer active:scale-95 transition-all">
                                            Buka Kamera
                                        </button>
                                        <label for="foto_ktp_pj" class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 rounded-full bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-bold cursor-pointer transition-colors shadow-xs">
                                            Pilih File
                                        </label>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewKtpPj' && previewKtpPj">
                                <div class="flex items-center justify-between p-3 rounded-2xl border border-teal-200 bg-teal-50/40">
                                    <div class="flex items-center gap-3">
                                        <img :src="previewKtpPj" class="w-14 h-10 object-cover rounded-xl border border-teal-300 shadow-xs">
                                        <div>
                                            <p class="text-xs font-bold text-teal-900 flex items-center gap-1">
                                                <span class="text-emerald-600 font-black">✓</span> e-KTP PJ Terpilih
                                            </p>
                                            <p class="text-[10px] text-slate-400">Siap diunggah</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" 
                                                @click="startCamera('previewKtpPj', 'foto_ktp_pj', 'e-KTP PJ harus muat di kotak', 'environment', 'card')" 
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-white hover:bg-slate-100 border border-slate-200 text-primary-700 text-xs font-bold shadow-2xs transition-all cursor-pointer">
                                            <svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                            <span>Ganti Foto</span>
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <input id="foto_ktp_pj" type="file" name="foto_ktp_pj" accept="image/*" capture="environment" @change="handleFileChange($event, 'previewKtpPj')" class="hidden">
                            <x-input-error :messages="$errors->get('foto_ktp_pj')" class="mt-1 text-[11px]" />
                        </div>
                    </div>

                    <div x-show="errorMessage" class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs font-bold text-red-600" x-text="errorMessage"></div>

                    <button type="button" 
                            @click="validateStep4()"
                            class="w-full py-3.5 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-md shadow-primary-600/20 hover:shadow-lg transition-all transform active:scale-95 cursor-pointer">
                        Lanjut ke Legalitas Lembaga →
                    </button>
                </div>

                <!-- ========================================================================= -->
                <!-- SLIDE 5: LEGALITAS & SURAT IZIN LEMBAGA -->
                <!-- ========================================================================= -->
                <div x-show="step === 5" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="mb-4">
                        <h3 class="text-xl font-black text-[#0F2747] tracking-tight">Legalitas / Izin Operasional</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Surat Izin Operasional, Akta Notaris Yayasan, NIB, atau SK Lembaga Resmi.</p>
                    </div>

                    <div class="space-y-4 mb-6">
                        <!-- Nomor Dokumen Legalitas -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                Nomor Izin / Akta Yayasan / NIB
                            </label>
                            <input type="text" 
                                   name="nomor_legalitas" 
                                   x-model="nomorLegalitas" 
                                   placeholder="contoh: AHU-0012345.AH.01.04 / 503/012/IZIN/2024"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm font-bold text-[#0F2747] focus:bg-white focus:border-primary-600 outline-none transition-all">
                        </div>

                        <!-- Camera / Upload Dokumen Legalitas -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1.5">
                                Foto Dokumen Legalitas (NIB / Akta Notaris Yayasan) <span class="text-red-500">*</span>
                            </label>

                            <template x-if="activeCamera === 'previewLegalitas'">
                                <div class="rounded-2xl bg-slate-900 text-white p-3 space-y-2.5 shadow-md border border-slate-800">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-black text-white">Posisikan Dokumen Legalitas di Dalam Kotak</span>
                                        <button type="button" @click="stopCamera()" class="w-6 h-6 rounded-full bg-slate-800 text-slate-300 text-xs flex items-center justify-center hover:bg-slate-700 cursor-pointer">✕</button>
                                    </div>
                                    <div class="relative w-full h-56 bg-black rounded-xl overflow-hidden flex items-center justify-center">
                                        <video id="webcam-video-previewLegalitas" autoplay playsinline muted class="w-full h-full object-cover"></video>
                                        <div class="absolute inset-3 rounded-xl border-2 border-dashed border-teal-400 pointer-events-none flex flex-col justify-between p-2.5 bg-teal-500/5 shadow-[0_0_0_9999px_rgba(0,0,0,0.4)]">
                                            <span class="text-[9px] font-black uppercase tracking-wider bg-teal-500/80 text-white px-2 py-0.5 rounded-md w-max">
                                                Dokumen Pas di Kotak
                                            </span>
                                            <div class="flex justify-between">
                                                <div class="w-4 h-4 border-b-2 border-l-2 border-teal-300"></div>
                                                <div class="w-4 h-4 border-b-2 border-r-2 border-teal-300"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between pt-1">
                                        <button type="button" @click="switchCamera()" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                            <span>Putar Kamera</span>
                                        </button>
                                        <button type="button" @click="capturePhoto()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-black shadow-md active:scale-95 transition-all cursor-pointer">
                                            Ambil Foto
                                        </button>
                                        <button type="button" @click="stopCamera()" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewLegalitas' && !previewLegalitas">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3.5 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/70 hover:border-primary-400 transition-all">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-primary-600 shadow-xs">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-xs font-bold text-slate-700">Foto Dokumen Legalitas</p>
                                            <p class="text-[10px] text-slate-400">NIB / Akta Notaris Yayasan</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" 
                                                @click="startCamera('previewLegalitas', 'foto_legalitas', 'Dokumen Legalitas harus muat di kotak', 'environment', 'card')" 
                                                class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold shadow-xs cursor-pointer active:scale-95 transition-all">
                                            Buka Kamera
                                        </button>
                                        <label for="foto_legalitas" class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 rounded-full bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-bold cursor-pointer transition-colors shadow-xs">
                                            Pilih File
                                        </label>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewLegalitas' && previewLegalitas">
                                <div class="flex items-center justify-between p-3 rounded-2xl border border-teal-200 bg-teal-50/40">
                                    <div class="flex items-center gap-3">
                                        <img :src="previewLegalitas" class="w-14 h-10 object-cover rounded-xl border border-teal-300 shadow-xs">
                                        <div>
                                            <p class="text-xs font-bold text-teal-900 flex items-center gap-1">
                                                <span class="text-emerald-600 font-black">✓</span> Dokumen Legalitas Terpilih
                                            </p>
                                            <p class="text-[10px] text-slate-400">Siap diunggah</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" 
                                                @click="startCamera('previewLegalitas', 'foto_legalitas', 'Dokumen Legalitas harus muat di kotak', 'environment', 'card')" 
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-white hover:bg-slate-100 border border-slate-200 text-primary-700 text-xs font-bold shadow-2xs transition-all cursor-pointer">
                                            <svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                            <span>Ganti Foto</span>
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <input id="foto_legalitas" type="file" name="foto_legalitas" accept="image/*" capture="environment" @change="handleFileChange($event, 'previewLegalitas')" class="hidden">
                            <x-input-error :messages="$errors->get('foto_legalitas')" class="mt-1 text-[11px]" />
                        </div>
                    </div>

                    <div x-show="errorMessage" class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs font-bold text-red-600" x-text="errorMessage"></div>

                    <button type="button" 
                            @click="validateStep5()"
                            class="w-full py-3.5 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-md shadow-primary-600/20 hover:shadow-lg transition-all transform active:scale-95 cursor-pointer">
                        Lanjut ke Data Unit Ambulans →
                    </button>
                </div>

                <!-- ========================================================================= -->
                <!-- SLIDE 6: DATA ARMADA AMBULANS LEMBAGA -->
                <!-- ========================================================================= -->
                <div x-show="step === 6" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="mb-4">
                        <h3 class="text-xl font-black text-[#0F2747] tracking-tight">Armada Ambulans Utama</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Daftarkan unit ambulans operasional utama lembaga Anda.</p>
                    </div>

                    <div class="space-y-4 mb-6">
                        <!-- Plat & Merk Kendaraan -->
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                    Plat Nomor Unit <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="plat_nomor_unit" 
                                       x-model="platNomorUnit" 
                                       placeholder="contoh: R 1234 AB"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-[#0F2747] focus:bg-white focus:border-primary-600 outline-none uppercase">
                                <x-input-error :messages="$errors->get('plat_nomor_unit')" class="mt-1 text-[11px]" />
                            </div>

                            <div>
                                <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1">
                                    Tipe / Merk Unit
                                </label>
                                <input type="text" 
                                       name="merk_kendaraan" 
                                       x-model="merkKendaraan" 
                                       placeholder="contoh: HiAce / APV / Luxio"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-[#0F2747] focus:bg-white focus:border-primary-600 outline-none">
                            </div>
                        </div>

                        <!-- Camera / Upload Foto Ambulans -->
                        <div>
                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-wider mb-1.5">
                                Foto Fisik Unit Ambulans <span class="text-red-500">*</span>
                            </label>

                            <template x-if="activeCamera === 'previewAmbulans'">
                                <div class="rounded-2xl bg-slate-900 text-white p-3 space-y-2.5 shadow-md border border-slate-800">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-black text-white">Posisikan Unit Ambulans di Dalam Kotak</span>
                                        <button type="button" @click="stopCamera()" class="w-6 h-6 rounded-full bg-slate-800 text-slate-300 text-xs flex items-center justify-center hover:bg-slate-700 cursor-pointer">✕</button>
                                    </div>
                                    <div class="relative w-full h-56 bg-black rounded-xl overflow-hidden flex items-center justify-center">
                                        <video id="webcam-video-previewAmbulans" autoplay playsinline muted class="w-full h-full object-cover"></video>
                                        <div class="absolute inset-3 rounded-xl border-2 border-dashed border-teal-400 pointer-events-none flex flex-col justify-between p-2.5 bg-teal-500/5 shadow-[0_0_0_9999px_rgba(0,0,0,0.4)]">
                                            <span class="text-[9px] font-black uppercase tracking-wider bg-teal-500/80 text-white px-2 py-0.5 rounded-md w-max">
                                                Ambulans Pas di Kotak
                                            </span>
                                            <div class="flex justify-between">
                                                <div class="w-4 h-4 border-b-2 border-l-2 border-teal-300"></div>
                                                <div class="w-4 h-4 border-b-2 border-r-2 border-teal-300"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between pt-1">
                                        <button type="button" @click="switchCamera()" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                            <span>Putar Kamera</span>
                                        </button>
                                        <button type="button" @click="capturePhoto()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-black shadow-md active:scale-95 transition-all cursor-pointer">
                                            Ambil Foto
                                        </button>
                                        <button type="button" @click="stopCamera()" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold cursor-pointer">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewAmbulans' && !previewAmbulans">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3.5 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/70 hover:border-primary-400 transition-all">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-primary-600 shadow-xs">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 16l-4-4m0 0l-4 4m4-4v12M5 8h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V10a2 2 0 012-2z"/></svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-xs font-bold text-slate-700">Foto Unit Ambulans</p>
                                            <p class="text-[10px] text-slate-400">Tampak bodi mobil & plat nomor jelas</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" 
                                                @click="startCamera('previewAmbulans', 'foto_ambulans', 'Foto Ambulans harus muat di kotak', 'environment', 'card')" 
                                                class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold shadow-xs cursor-pointer active:scale-95 transition-all">
                                            Buka Kamera
                                        </button>
                                        <label for="foto_ambulans" class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 rounded-full bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-bold cursor-pointer transition-colors shadow-xs">
                                            Pilih File
                                        </label>
                                    </div>
                                </div>
                            </template>

                            <template x-if="activeCamera !== 'previewAmbulans' && previewAmbulans">
                                <div class="flex items-center justify-between p-3 rounded-2xl border border-teal-200 bg-teal-50/40">
                                    <div class="flex items-center gap-3">
                                        <img :src="previewAmbulans" class="w-14 h-10 object-cover rounded-xl border border-teal-300 shadow-xs">
                                        <div>
                                            <p class="text-xs font-bold text-teal-900 flex items-center gap-1">
                                                <span class="text-emerald-600 font-black">✓</span> Foto Unit Ambulans Terpilih
                                            </p>
                                            <p class="text-[10px] text-slate-400">Siap diunggah</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" 
                                                @click="startCamera('previewAmbulans', 'foto_ambulans', 'Foto Ambulans harus muat di kotak', 'environment', 'card')" 
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-white hover:bg-slate-100 border border-slate-200 text-primary-700 text-xs font-bold shadow-2xs transition-all cursor-pointer">
                                            <svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                            <span>Ganti Foto</span>
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <input id="foto_ambulans" type="file" name="foto_ambulans" accept="image/*" capture="environment" @change="handleFileChange($event, 'previewAmbulans')" class="hidden">
                            <x-input-error :messages="$errors->get('foto_ambulans')" class="mt-1 text-[11px]" />
                        </div>
                    </div>

                    <div x-show="errorMessage" class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs font-bold text-red-600" x-text="errorMessage"></div>

                    <button type="button" 
                            @click="validateStep6()"
                            class="w-full py-3.5 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-md shadow-primary-600/20 hover:shadow-lg transition-all transform active:scale-95 cursor-pointer">
                        Lanjut ke Konfirmasi Akhir →
                    </button>
                </div>

                <!-- ========================================================================= -->
                <!-- SLIDE 7: KONFIRMASI & KIRIM PENDAFTARAN MITRA LEMBAGA -->
                <!-- ========================================================================= -->
                <div x-show="step === 7" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="mb-4">
                        <h3 class="text-xl font-black text-[#0F2747] tracking-tight">Konfirmasi Pendaftaran</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Periksa kembali ringkasan data sebelum mengirimkan pendaftaran.</p>
                    </div>

                    <!-- Summary Card Grid -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2.5 mb-5 text-xs">
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200/80">
                            <span class="text-slate-500 font-semibold">Nama Lembaga:</span>
                            <span class="font-black text-[#0F2747]" x-text="namaLembaga"></span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200/80">
                            <span class="text-slate-500 font-semibold">Penanggung Jawab:</span>
                            <span class="font-bold text-[#0F2747]" x-text="name"></span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200/80">
                            <span class="text-slate-500 font-semibold">Email Resmi:</span>
                            <span class="font-bold text-primary-700" x-text="email"></span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200/80">
                            <span class="text-slate-500 font-semibold">No. Telepon / WA:</span>
                            <span class="font-bold text-slate-800" x-text="'+62 ' + (phone ? phone.replace(/^(\+?62|0)+/, '') : '')"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 font-semibold">Plat Armada Utama:</span>
                            <span class="font-black text-slate-900 uppercase" x-text="platNomorUnit"></span>
                        </div>
                    </div>

                    <!-- Final Notice Banner -->
                    <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-start gap-2.5 mb-6">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <p class="text-xs font-semibold text-emerald-900 leading-tight">
                            Data pendaftaran lembaga Anda akan diverifikasi oleh Administrator Ambulans Siaga sebelum akun diaktifkan secara resmi.
                        </p>
                    </div>

                    <div x-show="errorMessage" class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs font-bold text-red-600" x-text="errorMessage"></div>

                    <!-- Final Submission Button -->
                    <button type="submit"
                            class="w-full py-4 px-6 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-black text-sm shadow-xl shadow-primary-600/25 hover:shadow-2xl transition-all transform active:scale-95 flex items-center justify-center gap-2 cursor-pointer">
                        <span>Kirim Pendaftaran Mitra Armada</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </button>
                </div>

            </form>
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
