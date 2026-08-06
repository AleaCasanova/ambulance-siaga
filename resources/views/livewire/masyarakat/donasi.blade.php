<div>
    <x-landing-navbar />

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-[#009CA6] to-[#007b83] pt-40 pb-20 px-6 lg:px-12 overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12 relative z-10">
            <div class="md:w-1/2 text-white z-10 text-center md:text-left">
                <span class="inline-flex items-center gap-2 mb-6 bg-white/10 backdrop-blur px-4 py-2 rounded-full border border-white/20 shadow-xl">
                    <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path></svg>
                    <span class="font-bold tracking-wider text-xs uppercase">Program Kemanusiaan GSC</span>
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-[1.15] mb-6 drop-shadow-lg">
                    Bersama Kita Selamatkan Lebih Banyak Nyawa
                </h1>
                <p class="text-lg text-sky-100 mb-8 max-w-lg mx-auto md:mx-0 leading-relaxed font-medium">
                    Ribuan pasien gawat darurat dan keluarga kurang mampu menanti uluran tangan Anda. Donasi Anda menjadi energi operasional Ambulance Siaga 24 Jam.
                </p>
                <div class="flex gap-4 justify-center md:justify-start">
                    <button onclick="document.getElementById('form-donasi').scrollIntoView({behavior: 'smooth'})" class="bg-white text-[#009CA6] px-8 py-4 rounded-full font-bold text-lg hover:bg-slate-50 transition-all shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:scale-105 flex items-center gap-2">
                        Donasi Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </button>
                </div>
            </div>
            <div class="md:w-1/2 relative hidden md:block">
                <div class="absolute right-0 top-1/2 -translate-y-1/2 w-[350px] h-[350px] bg-white/20 rounded-full blur-3xl"></div>
                <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Ilustrasi Medis" class="relative z-10 rounded-[3rem] shadow-2xl border-4 border-white/30 hover:-translate-y-2 transition-transform duration-500 object-cover w-full h-[400px]">
            </div>
        </div>
    </section>

    <!-- Donation Section (Form & Info) -->
    <section id="form-donasi" class="py-16 px-6 lg:px-12 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-12 lg:gap-16">
            
            <!-- Left: Donation Form -->
            <div class="lg:w-[55%]">
                <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgb(0,0,0,0.05)] border border-slate-100 p-8 sm:p-12 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#009CA6]/5 rounded-bl-full -z-0"></div>
                    
                    <h2 class="text-3xl font-black text-slate-800 mb-2 relative z-10">Mulai Berdonasi</h2>
                    <p class="text-slate-500 mb-8 font-medium relative z-10">Pilih nominal atau masukkan nominal donasi terbaik Anda.</p>

                    <form class="relative z-10">
                        <!-- Nominal Selection -->
                        <div class="mb-8">
                            <label class="block text-sm font-bold text-slate-700 mb-3">Nominal Donasi</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-3">
                                @php
                                    $pilihanNominal = [10000, 25000, 50000, 100000, 250000, 500000];
                                @endphp
                                @foreach($pilihanNominal as $nom)
                                    <button type="button" wire:click="$set('nominal', {{ $nom }})" class="py-3 px-4 rounded-xl border-2 font-bold text-center transition-all @if($nominal == $nom) bg-[#009CA6]/10 border-[#009CA6] text-[#009CA6] @else bg-white border-slate-200 text-slate-600 hover:border-slate-300 hover:bg-slate-50 @endif">
                                        Rp {{ number_format($nom, 0, ',', '.') }}
                                    </button>
                                @endforeach
                            </div>
                            <div class="relative flex items-center w-full">
                                <span class="absolute text-slate-500 font-extrabold text-lg pointer-events-none" style="left: 1.25rem;">Rp</span>
                                <input type="number" wire:model.live="nominalLainnya" placeholder="Nominal Lainnya" class="w-full bg-white border border-slate-200 rounded-xl text-slate-800 font-bold focus:ring-2 focus:ring-[#009CA6]/20 focus:border-[#009CA6] transition-all placeholder:font-normal shadow-sm" style="padding-left: 3.5rem; padding-right: 1rem; padding-top: 1rem; padding-bottom: 1rem;">
                            </div>
                        </div>

                        <!-- Data Donatur -->
                        <div class="space-y-5 mb-8">
                            <label class="block text-sm font-bold text-slate-700 mb-1 border-b pb-2 border-slate-100">Data Donatur</label>
                            
                            <!-- Toggle Anonim -->
                            <div class="flex items-center justify-between bg-white border border-slate-200 p-4 rounded-xl shadow-sm">
                                <span class="text-sm font-bold text-slate-700">Sembunyikan nama saya (Hamba Allah)</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model.live="isAnonim" class="sr-only peer">
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#009CA6]"></div>
                                </label>
                            </div>

                            <div>
                                <input type="text" wire:model="nama" placeholder="Nama Lengkap" class="w-full px-4 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:ring-2 focus:ring-[#009CA6]/20 focus:border-[#009CA6] transition-all disabled:opacity-50 disabled:bg-slate-100 disabled:cursor-not-allowed" @if($isAnonim) disabled @endif>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <input type="email" wire:model="email" placeholder="Email (Opsional)" class="w-full px-4 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:ring-2 focus:ring-[#009CA6]/20 focus:border-[#009CA6] transition-all">
                                </div>
                                <div>
                                    <input type="tel" wire:model="whatsapp" placeholder="Nomor WhatsApp" class="w-full px-4 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:ring-2 focus:ring-[#009CA6]/20 focus:border-[#009CA6] transition-all">
                                </div>
                            </div>
                            <div>
                                <textarea wire:model="pesan" rows="3" placeholder="Pesan atau Doa (Opsional)" class="w-full px-4 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:ring-2 focus:ring-[#009CA6]/20 focus:border-[#009CA6] transition-all resize-none"></textarea>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-10">
                            <label class="block text-sm font-bold text-slate-700 mb-3 border-b pb-2 border-slate-100">Metode Pembayaran</label>
                            <div class="grid grid-cols-3 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model.live="metodePembayaran" value="qris" class="peer sr-only">
                                    <div class="py-3 px-2 rounded-xl border-2 text-center transition-all peer-checked:bg-[#009CA6]/10 peer-checked:border-[#009CA6] peer-checked:text-[#009CA6] bg-white border-slate-200 text-slate-600 hover:bg-slate-50 flex flex-col items-center gap-1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                        <span class="font-bold text-sm">QRIS</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model.live="metodePembayaran" value="transfer" class="peer sr-only">
                                    <div class="py-3 px-2 rounded-xl border-2 text-center transition-all peer-checked:bg-[#009CA6]/10 peer-checked:border-[#009CA6] peer-checked:text-[#009CA6] bg-white border-slate-200 text-slate-600 hover:bg-slate-50 flex flex-col items-center gap-1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                        <span class="font-bold text-sm">Transfer</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model.live="metodePembayaran" value="ewallet" class="peer sr-only">
                                    <div class="py-3 px-2 rounded-xl border-2 text-center transition-all peer-checked:bg-[#009CA6]/10 peer-checked:border-[#009CA6] peer-checked:text-[#009CA6] bg-white border-slate-200 text-slate-600 hover:bg-slate-50 flex flex-col items-center gap-1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                        <span class="font-bold text-sm">E-Wallet</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Payment Details based on selection -->
                        <div class="mb-8 p-6 bg-slate-50 rounded-2xl border border-slate-100">
                            @if($metodePembayaran == 'qris')
                                <div class="text-center">
                                    <p class="text-sm font-bold text-slate-700 mb-4">Scan QR Code di bawah ini</p>
                                    <!-- Placeholder QRIS -->
                                    <div class="w-48 h-48 mx-auto bg-white border-2 border-dashed border-slate-300 rounded-xl flex items-center justify-center p-2 mb-2">
                                        <svg class="w-24 h-24 text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h6v6H4V4zm2 2v2h2V6H6zm10-2h6v6h-6V4zm2 2v2h2V6h-2zM4 14h6v6H4v-6zm2 2v2h2v-2H6zm10-2h6v6h-6v-6zm2 2v2h2v-2h-2zm-6-2h2v2h-2v-2zm-2 2h2v2h-2v-2zm-2 2h2v2h-2v-2zm4 0h2v2h-2v-2zm-4 2h2v2h-2v-2zm-2-2h2v2h-2v-2zm10 0h2v2h-2v-2z"></path></svg>
                                    </div>
                                    <p class="text-xs text-slate-500">Mendukung Gopay, OVO, Dana, ShopeePay, LinkAja, BCA Mobile, dll.</p>
                                </div>
                            @elseif($metodePembayaran == 'transfer')
                                <div x-data="{ copied: false }" class="flex flex-col gap-4">
                                    <div class="flex items-center gap-4 bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                                        <div class="w-16 h-10 bg-slate-100 rounded flex items-center justify-center font-black text-blue-700 text-lg italic">BSI</div>
                                        <div class="flex-1">
                                            <p class="text-xs text-slate-500 font-medium">Bank Syariah Indonesia (BSI)</p>
                                            <p class="text-lg font-black text-slate-800" id="rek-bsi">7123456789</p>
                                            <p class="text-xs text-slate-500">a.n Yayasan Gerak Sedekah Cilacap</p>
                                        </div>
                                        <button @click="navigator.clipboard.writeText('7123456789'); copied = true; setTimeout(() => copied = false, 2000)" class="px-4 py-2 bg-slate-50 hover:bg-sky-50 text-[#009CA6] rounded-lg text-xs font-bold transition flex items-center gap-1 border border-slate-200">
                                            <span x-show="!copied"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg> Copy</span>
                                            <span x-show="copied" x-cloak class="text-green-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Copied</span>
                                        </button>
                                    </div>
                                    <div class="flex items-center gap-4 bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                                        <div class="w-16 h-10 bg-slate-100 rounded flex items-center justify-center font-black text-blue-600 text-lg">BCA</div>
                                        <div class="flex-1">
                                            <p class="text-xs text-slate-500 font-medium">Bank Central Asia (BCA)</p>
                                            <p class="text-lg font-black text-slate-800" id="rek-bca">0987654321</p>
                                            <p class="text-xs text-slate-500">a.n Yayasan Gerak Sedekah Cilacap</p>
                                        </div>
                                        <button @click="navigator.clipboard.writeText('0987654321'); copied = true; setTimeout(() => copied = false, 2000)" class="px-4 py-2 bg-slate-50 hover:bg-sky-50 text-[#009CA6] rounded-lg text-xs font-bold transition flex items-center gap-1 border border-slate-200">
                                            <span x-show="!copied"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg> Copy</span>
                                            <span x-show="copied" x-cloak class="text-green-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Copied</span>
                                        </button>
                                    </div>
                                </div>
                            @elseif($metodePembayaran == 'ewallet')
                                <div class="text-center text-slate-500 text-sm font-medium py-6">
                                    <svg class="w-12 h-12 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    <p>Pilih dompet digital favorit Anda saat konfirmasi (Gopay, OVO, Dana, dll).</p>
                                </div>
                            @endif
                        </div>

                        <!-- CTA Button -->
                        <button type="button" class="w-full bg-[#009CA6] text-white py-5 rounded-2xl font-black text-lg hover:bg-[#007b83] transition-all shadow-[0_10px_30px_rgba(0,156,166,0.3)] hover:shadow-[0_15px_40px_rgba(0,156,166,0.4)] flex justify-center items-center gap-2 group">
                            Donasi Sekarang
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right: Info & Stats -->
            <div class="lg:w-[45%] flex flex-col gap-10">
                <!-- Usage Cards Section -->
                <div>
                    <span class="text-[#009CA6] font-black tracking-widest text-xs mb-2 block uppercase">Transparansi</span>
                    <h3 class="text-2xl font-black text-slate-800 mb-6">Donasi Anda Digunakan Untuk:</h3>
                    
                    <div class="space-y-4">
                        <div class="bg-white p-5 rounded-2xl flex items-start gap-4 border border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                            <div class="w-12 h-12 bg-sky-50 rounded-xl flex items-center justify-center text-sky-500 group-hover:bg-sky-500 group-hover:text-white transition-colors shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 mb-1">Bahan Bakar Ambulans</h4>
                                <p class="text-sm text-slate-500 leading-relaxed">Memastikan armada selalu siap menjemput pasien tanpa hambatan bensin.</p>
                            </div>
                        </div>

                        <div class="bg-white p-5 rounded-2xl flex items-start gap-4 border border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-500 group-hover:bg-emerald-500 group-hover:text-white transition-colors shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 mb-1">Perawatan & Pengadaan Alat Medis</h4>
                                <p class="text-sm text-slate-500 leading-relaxed">Melengkapi isi dalam ambulans dengan peralatan medis yang memadai dan tabung oksigen.</p>
                            </div>
                        </div>

                        <div class="bg-white p-5 rounded-2xl flex items-start gap-4 border border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                            <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-colors shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 mb-1">Dukungan Operasional Relawan</h4>
                                <p class="text-sm text-slate-500 leading-relaxed">Memberikan dukungan konsumsi dan kebutuhan dasar bagi relawan medis dan supir.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Animated Stats Counter -->
                <div class="bg-[#009CA6] rounded-3xl p-8 text-white relative overflow-hidden" x-data="{ count: 0 }" x-init="setTimeout(() => { let start = 0; let end = 2665; let duration = 2000; let timer = setInterval(() => { start += Math.ceil(end/50); if(start >= end) { count = end; clearInterval(timer); } else { count = start; } }, 40); }, 500)">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="grid grid-cols-2 gap-8 relative z-10">
                        <div>
                            <p class="text-sky-100 text-sm font-bold uppercase tracking-wider mb-1">Total Donasi</p>
                            <h4 class="text-2xl font-black">Rp 125<span class="text-lg text-sky-200">Jt+</span></h4>
                        </div>
                        <div>
                            <p class="text-sky-100 text-sm font-bold uppercase tracking-wider mb-1">Donatur</p>
                            <h4 class="text-2xl font-black">1.250<span class="text-lg text-sky-200">+</span></h4>
                        </div>
                        <div>
                            <p class="text-sky-100 text-sm font-bold uppercase tracking-wider mb-1">Pasien Terbantu</p>
                            <h4 class="text-2xl font-black"><span x-text="count">2665</span><span class="text-lg text-sky-200">+</span></h4>
                        </div>
                        <div>
                            <p class="text-sky-100 text-sm font-bold uppercase tracking-wider mb-1">Armada Aktif</p>
                            <h4 class="text-2xl font-black">8<span class="text-lg text-sky-200"> Unit</span></h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Recent Donors -->
    <section class="py-16 px-6 lg:px-12 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-black text-slate-800 mb-3">Terima Kasih Kepada Para Donatur</h2>
                <p class="text-slate-500 font-medium">Jazakumullah Khairan Katsiran atas kebaikan Anda. Semoga Allah membalas dengan kebaikan yang berlipat ganda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Mock Donors -->
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100 hover:shadow-md transition">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center font-bold">HA</div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Hamba Allah</h4>
                            <p class="text-xs text-slate-400">10 Menit yang lalu</p>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-[#009CA6] mb-2">Berdonasi Rp 50.000</p>
                    <p class="text-xs text-slate-500 italic">"Semoga bermanfaat untuk yang membutuhkan."</p>
                </div>
                
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100 hover:shadow-md transition">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold">BP</div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Bapak Budi</h4>
                            <p class="text-xs text-slate-400">1 Jam yang lalu</p>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-[#009CA6] mb-2">Berdonasi Rp 100.000</p>
                    <p class="text-xs text-slate-500 italic">"Semoga program ini terus berjalan."</p>
                </div>

                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100 hover:shadow-md transition">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center font-bold">HA</div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Hamba Allah</h4>
                            <p class="text-xs text-slate-400">3 Jam yang lalu</p>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-[#009CA6] mb-2">Berdonasi Rp 25.000</p>
                    <p class="text-xs text-slate-500 italic">"Aamiin yarabbal alamin"</p>
                </div>

                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100 hover:shadow-md transition">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center font-bold">IF</div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Ibu Fitri</h4>
                            <p class="text-xs text-slate-400">5 Jam yang lalu</p>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-[#009CA6] mb-2">Berdonasi Rp 200.000</p>
                    <p class="text-xs text-slate-500 italic">"Sehat selalu untuk para relawan"</p>
                </div>
            </div>
            
            <div class="text-center mt-8">
                <button class="text-slate-500 font-bold text-sm hover:text-[#009CA6] transition">Lihat Donatur Lainnya</button>
            </div>
        </div>
    </section>

    <!-- Testimonials Slider -->
    <section class="py-16 px-6 lg:px-12 bg-slate-50 border-t border-slate-100">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-black text-slate-800 mb-8 text-center">Apa Kata Mereka?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Testi 1 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="flex text-yellow-400 mb-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-4">"Alhamdulillah, sangat terbantu saat ibu saya harus dirujuk ke RSUD malam hari. Responnya sangat cepat dan tim relawannya ramah. Gratis tanpa dipungut biaya apapun."</p>
                    <p class="font-bold text-slate-800 text-sm">- Keluarga Pasien, Cilacap Utara</p>
                </div>
                <!-- Testi 2 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="flex text-yellow-400 mb-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-4">"Saya rutin berdonasi tiap bulan di sini. Laporannya transparan dan layanannya benar-benar dirasakan oleh masyarakat menengah ke bawah."</p>
                    <p class="font-bold text-slate-800 text-sm">- Bapak Supriyanto, Donatur</p>
                </div>
                <!-- Testi 3 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="flex text-yellow-400 mb-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-4">"Melihat ambulan siaga lalu-lalang membantu orang kecelakaan tanpa pamrih membuat saya tergerak untuk ikut berdonasi."</p>
                    <p class="font-bold text-slate-800 text-sm">- Ibu Siti, Relawan Sosial</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="py-20 px-6 lg:px-12 bg-white text-center">
        <div class="max-w-3xl mx-auto bg-gradient-to-br from-slate-900 to-slate-800 rounded-[3rem] p-10 md:p-16 shadow-2xl relative overflow-hidden text-white">
            <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, white 10px, white 20px);"></div>
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-black mb-4">Setiap Rupiah yang Anda Donasikan Sangat Berarti</h2>
                <p class="text-slate-300 font-medium text-lg mb-10 max-w-xl mx-auto">Satu aksi kebaikan Anda hari ini, bisa jadi adalah jawaban atas doa mereka yang sedang dalam kesulitan darurat medis.</p>
                <button onclick="document.getElementById('form-donasi').scrollIntoView({behavior: 'smooth'})" class="bg-[#009CA6] text-white px-10 py-5 rounded-full font-black text-lg hover:bg-[#007b83] transition-all shadow-[0_10px_30px_rgba(0,156,166,0.4)] hover:-translate-y-1 hover:scale-105 inline-block">
                    Mulai Donasi Sekarang
                </button>
            </div>
        </div>
    </section>

    <x-landing-footer />
</div>
