<x-guest-layout>
    <div class="w-full max-w-[460px] sm:max-w-[500px] lg:max-w-[520px] my-auto">
        <!-- Card Container Panel Kanan -->
        <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-6 lg:p-7 shadow-[0_12px_35px_-8px_rgba(14,138,205,0.12)] border border-slate-100/90">
            
            <!-- Header Icon & Title -->
            <div class="text-center mb-4">
                <div class="w-14 h-14 bg-sky-50 text-[#009CA6] rounded-2xl mx-auto flex items-center justify-center mb-3 border border-sky-100 shadow-sm">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-xl sm:text-2xl font-black text-[#0F2747] tracking-tight">Verifikasi Kode OTP</h2>
                <p class="text-xs font-semibold text-slate-500 mt-1 leading-relaxed max-w-sm mx-auto">
                    Masukkan 6 digit kode verifikasi yang telah kami kirimkan ke alamat email:
                </p>
                <div class="mt-2 inline-flex items-center gap-1.5 px-3 py-1 bg-sky-50 border border-sky-200/80 rounded-full text-xs font-extrabold text-[#009CA6]">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 11-8 0 4 4 0 018 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                    <span>{{ $email }}</span>
                </div>
            </div>

            <!-- Session Status Alert -->
            @if(session('status'))
                <div class="mb-4 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-start gap-2.5 shadow-xs">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="leading-relaxed">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <!-- Session Error Alert -->
            @if(session('error') || $errors->any())
                <div class="mb-4 p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-start gap-2.5 shadow-xs">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="leading-relaxed">
                        {{ session('error') ?? $errors->first() }}
                    </div>
                </div>
            @endif

            <!-- OTP Form Component (Alpine.js) -->
            <div x-data="otpComponent({{ $expireSeconds }}, {{ $resendSeconds }})" x-init="initTimer()">
                <form method="POST" action="{{ route('verification.otp.verify') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="otp_code" x-model="combinedOtp">

                    <!-- 6 Digit Inputs Container -->
                    <div class="flex justify-center items-center gap-1.5 sm:gap-2.5 py-2">
                        <template x-for="(digit, index) in digits" :key="index">
                            <input type="text"
                                   maxlength="1"
                                   pattern="[0-9]*"
                                   inputmode="numeric"
                                   x-ref="`input_${index}`"
                                   :id="`otp-input-${index}`"
                                   x-model="digits[index]"
                                   @input="handleInput(index, $event)"
                                   @keydown="handleKeydown(index, $event)"
                                   @paste="handlePaste($event)"
                                   class="w-10 h-12 sm:w-12 sm:h-14 text-center text-xl font-black text-[#0F2747] bg-slate-50 border-2 rounded-xl focus:bg-white focus:border-[#009CA6] focus:ring-4 focus:ring-[#009CA6]/15 transition-all outline-none"
                                   :class="digits[index] ? 'border-[#009CA6] bg-emerald-50/20' : 'border-slate-200'"
                                   autocomplete="off">
                        </template>
                    </div>

                    <!-- Expiry Timer Indicator -->
                    <div class="text-center py-1">
                        <template x-if="expireTimer > 0">
                            <p class="text-xs font-semibold text-slate-500 inline-flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-[#009CA6] animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Kode berlaku hingga:</span>
                                <span class="font-extrabold text-[#0F2747] font-mono text-sm" x-text="formatTime(expireTimer)"></span>
                            </p>
                        </template>
                        <template x-if="expireTimer <= 0">
                            <p class="text-xs font-bold text-rose-600 inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                Kode OTP telah kedaluwarsa. Silakan minta kode baru.
                            </p>
                        </template>
                    </div>

                    <!-- Submit Button VERIFIKASI -->
                    <div>
                        <button type="submit"
                                :disabled="combinedOtp.length < 6"
                                class="w-full py-3 px-5 rounded-xl bg-[#009CA6] hover:bg-[#007b83] disabled:bg-slate-200 disabled:text-slate-400 disabled:cursor-not-allowed text-white font-extrabold text-xs sm:text-sm shadow-md shadow-[#009CA6]/20 transition-all duration-200 transform active:scale-[0.99] flex items-center justify-center tracking-wider uppercase cursor-pointer">
                            VERIFIKASI KODE OTP
                        </button>
                    </div>
                </form>

                <!-- Resend OTP Section -->
                <div class="mt-4 pt-4 border-t border-slate-100 text-center">
                    <form method="POST" action="{{ route('verification.otp.resend') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">

                        <p class="text-xs font-medium text-slate-500 mb-2">
                            Tidak menerima kode OTP?
                        </p>

                        <button type="submit"
                                :disabled="resendTimer > 0"
                                class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-lg text-xs font-bold transition-all"
                                :class="resendTimer > 0 ? 'bg-slate-100 text-slate-400 cursor-not-allowed' : 'bg-sky-50 hover:bg-sky-100 text-[#009CA6] hover:text-[#007b83] border border-sky-200 cursor-pointer'">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            <template x-if="resendTimer > 0">
                                <span>Kirim Ulang OTP (<span x-text="resendTimer"></span>s)</span>
                            </template>
                            <template x-if="resendTimer <= 0">
                                <span>Kirim Ulang Kode OTP</span>
                            </template>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Return to Login Link -->
            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-xs font-semibold text-slate-500 hover:text-[#009CA6] transition-colors inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali ke Halaman Login</span>
                </a>
            </div>
        </div>

        <!-- Copyright Global -->
        <p class="mt-3 text-[10px] font-semibold text-slate-400 text-center">
            &copy; {{ date('Y') }} Ambulance Siaga. Platform Layanan Darurat untuk Berbagai Mitra. Dikembangkan oleh GSC.
        </p>
    </div>

    <!-- Alpine.js Script for 6-Digit OTP Box Interactivity -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('otpComponent', (initialExpire, initialResend) => ({
                digits: ['', '', '', '', '', ''],
                expireTimer: initialExpire > 0 ? initialExpire : 0,
                resendTimer: initialResend > 0 ? initialResend : 0,
                timerInterval: null,

                get combinedOtp() {
                    return this.digits.join('');
                },

                initTimer() {
                    // Auto-focus first input on load
                    this.$nextTick(() => {
                        const firstInput = document.getElementById('otp-input-0');
                        if (firstInput) firstInput.focus();
                    });

                    this.timerInterval = setInterval(() => {
                        if (this.expireTimer > 0) this.expireTimer--;
                        if (this.resendTimer > 0) this.resendTimer--;
                    }, 1000);
                },

                formatTime(seconds) {
                    const mins = Math.floor(seconds / 60);
                    const secs = seconds % 60;
                    return `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
                },

                handleInput(index, event) {
                    const val = event.target.value.replace(/[^0-9]/g, '');
                    this.digits[index] = val;

                    if (val && index < 5) {
                        const nextInput = document.getElementById(`otp-input-${index + 1}`);
                        if (nextInput) nextInput.focus();
                    }
                },

                handleKeydown(index, event) {
                    if (event.key === 'Backspace') {
                        if (!this.digits[index] && index > 0) {
                            const prevInput = document.getElementById(`otp-input-${index - 1}`);
                            if (prevInput) {
                                prevInput.focus();
                                this.digits[index - 1] = '';
                            }
                        }
                    }
                },

                handlePaste(event) {
                    event.preventDefault();
                    const pastedData = (event.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
                    if (!pastedData) return;

                    const pastedDigits = pastedData.slice(0, 6).split('');
                    for (let i = 0; i < 6; i++) {
                        this.digits[i] = pastedDigits[i] || '';
                    }

                    const focusIndex = Math.min(pastedDigits.length, 5);
                    const targetInput = document.getElementById(`otp-input-${focusIndex}`);
                    if (targetInput) targetInput.focus();
                }
            }));
        });
    </script>
</x-guest-layout>
