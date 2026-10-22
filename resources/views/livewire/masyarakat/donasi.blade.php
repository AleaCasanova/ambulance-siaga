<div>


    <!-- Dedicated Hero Section: Donasi (Sedekah Operasional Kemanusiaan) -->
    <section class="relative pt-20 overflow-hidden bg-[#002b2f]">
        <!-- Background Image (Penyaluran Donasi Kemanusiaan - Unik untuk Donasi) -->
        <div class="absolute inset-0 z-0 bg-cover bg-center"
             style="background-image: url('{{ asset('images/donation (4).jpg') }}');">
            <!-- Overlay Transparan untuk Mempertajam Teks (Terang & Jernih) -->
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/65 via-black/25 to-transparent"></div>
        </div>

        <!-- Hero Content -->
        <div class="max-w-7xl mx-auto px-6 lg:px-12 min-h-[460px] sm:min-h-[500px] lg:min-h-[540px] flex items-center relative z-20 py-14 sm:py-16">
            <div class="max-w-3xl text-left text-white pr-4 lg:pr-12">
                <!-- Badge -->
                <div class="mb-4 sm:mb-5">
                    <span class="inline-flex items-center gap-2 bg-black/45 backdrop-blur-md text-white border border-white/20 px-4 py-1.5 rounded-full text-[10px] sm:text-xs font-bold tracking-widest uppercase shadow-md">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>PROGRAM KEMANUSIAAN & DONASI OPERASIONAL 24 JAM</span>
                    </span>
                </div>

                <!-- Big Headline -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black leading-tight sm:leading-[1.15] mb-4 text-white drop-shadow-[0_3px_6px_rgba(0,0,0,0.85)] tracking-tight">
                    Bersama Kita Selamatkan Lebih Banyak Nyawa
                </h1>

                <!-- Subtitle -->
                <p class="text-xs sm:text-base lg:text-lg text-slate-100 mb-8 max-w-2xl leading-relaxed font-medium drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                    Ribuan pasien gawat darurat dan keluarga kurang mampu menanti uluran tangan Anda. Donasi dan sedekah Anda menjadi energi kelangsungan operasional armada Ambulans Siaga 24 Jam secara 100% gratis bagi dhuafa.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                    <a href="#form-donasi" 
                       class="inline-flex items-center justify-center gap-2 border-2 border-white text-white hover:bg-white hover:text-primary-600 px-6 sm:px-8 py-3 sm:py-3.5 rounded-lg font-bold text-xs sm:text-sm uppercase tracking-wider transition-all shadow-[0_4px_15px_rgba(0,0,0,0.4)] hover:shadow-xl active:scale-95 bg-black/25 backdrop-blur-xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Donasi Sekarang</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    </a>

                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $telepon ?? '081234567890') }}" 
                       class="inline-flex items-center justify-center gap-2 bg-primary-600 hover:bg-primary-700 text-white px-5 sm:px-7 py-3 sm:py-3.5 rounded-lg font-bold text-xs sm:text-sm uppercase tracking-wider transition-all shadow-[0_4px_15px_rgba(0,156,166,0.4)] hover:shadow-lg active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>Hotline: {{ $telepon ?? '0812-3456-7890' }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Donation Section (Form & Info) -->
    <section id="form-donasi" class="scroll-mt-20 py-16 px-6 lg:px-12 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-12 lg:gap-16">
            
            <!-- Left: Donation Form -->
            <div class="lg:w-[55%]">
                <div class="bg-white rounded-2xl sm:rounded-[2.5rem] shadow-[0_20px_50px_rgb(0,0,0,0.05)] border border-slate-100 p-6 sm:p-8 md:p-12 relative overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-36 h-36 sm:w-44 sm:h-44 rounded-full bg-gradient-to-br from-primary-600/15 to-primary-600/5 pointer-events-none -z-0"></div>
                    <div class="absolute -top-6 -right-6 w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-primary-600/10 pointer-events-none -z-0"></div>
                    
                    <h2 class="text-xl sm:text-3xl font-black text-slate-800 mb-1.5 sm:mb-2 relative z-10">Mulai Berdonasi</h2>
                    <p class="text-xs sm:text-base text-slate-500 mb-6 sm:mb-8 font-medium relative z-10">Pilih nominal atau masukkan nominal donasi terbaik Anda.</p>

                    <form wire:submit.prevent="kirimDonasi" class="relative z-10">
                        <!-- Nominal Selection -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-slate-700 mb-3">Donasi Terbaik Anda</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-3">
                                @php
                                    $pilihanNominal = [
                                        100000 => 'Rp 100rb',
                                        250000 => 'Rp 250rb',
                                        500000 => 'Rp 500rb',
                                        1000000 => 'Rp 1jt'
                                    ];
                                @endphp
                                @foreach($pilihanNominal as $nom => $label)
                                    <button type="button" wire:click="$set('nominal', '{{ $nom }}')" class="py-2 px-4 rounded-xl border-2 text-center transition-all relative flex flex-col items-center justify-center @if($nominal == $nom) bg-primary-50 border-primary-600 text-primary-950 shadow-sm ring-1 ring-primary-600/30 @else bg-white border-slate-100 text-slate-600 hover:border-slate-200 shadow-sm @endif" style="min-height: 4.5rem;">
                                        <div class="font-bold text-sm">{{ $label }}</div>
                                        @if($nom == 100000)
                                            <div class="text-[10px] text-slate-400 font-normal">sering dipilih</div>
                                        @endif
                                        @if($nominal == $nom)
                                            <div class="absolute top-1.5 right-1.5 text-primary-600 bg-white rounded-full leading-none shadow-xs">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            </div>
                                        @endif
                                    </button>
                                @endforeach
                                <button type="button" wire:click="$set('nominal', 'lainnya')" class="py-2 px-4 rounded-xl border-2 text-center transition-all relative flex flex-col items-center justify-center @if($nominal == 'lainnya') bg-primary-50 border-primary-600 text-primary-950 shadow-sm ring-1 ring-primary-600/30 @else bg-white border-slate-100 text-slate-600 hover:border-slate-200 shadow-sm @endif" style="min-height: 4.5rem;">
                                    <div class="font-bold text-sm">Nominal</div>
                                    <div class="text-[10px] text-slate-400 font-normal">lainnya</div>
                                    @if($nominal == 'lainnya')
                                        <div class="absolute top-1.5 right-1.5 text-primary-600 bg-white rounded-full leading-none shadow-xs">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        </div>
                                    @endif
                                </button>
                            </div>
                            @if($nominal == 'lainnya')
                                <div class="relative flex items-center w-full mt-3">
                                    <span class="absolute text-slate-500 font-bold text-base pointer-events-none" style="left: 1.25rem;">Rp</span>
                                    <input type="number" wire:model.live="nominalLainnya" placeholder="Masukkan Nominal" class="w-full bg-white border border-slate-200 rounded-xl text-slate-700 text-right font-medium focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all placeholder:font-normal placeholder:text-slate-400 placeholder:text-right shadow-sm" style="padding-left: 3.5rem; padding-right: 1.25rem; padding-top: 1rem; padding-bottom: 1rem;">
                                </div>
                            @endif
                        </div>

                        <!-- Data Donatur -->
                        <div class="space-y-4 mb-8">
                            <div>
                                <input type="text" wire:model="nama" placeholder="Nama Lengkap" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all disabled:opacity-50 disabled:bg-slate-100 disabled:cursor-not-allowed" @if($isAnonim) disabled @endif>
                            </div>
                            
                            <!-- Toggle Anonim -->
                            <div class="flex items-center justify-between">
                                <span class="text-[13px] font-medium text-slate-600">Sembunyikan nama saya (Orang Baik)</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model.live="isAnonim" class="sr-only peer">
                                    <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                                </label>
                            </div>
                            <div class="mb-8">
                                <input type="tel" wire:model="whatsapp" placeholder="No Whatsapp atau Handphone" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all">
                            </div>
                            <div class="mb-8">
                                <input type="email" wire:model="email" placeholder="Email (optional)" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all">
                            </div>
                            <div class="mb-8">
                                <textarea wire:model="pesan" rows="4" placeholder="Tuliskan pesan atau doa disini (optional)" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg text-slate-800 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all resize-none"></textarea>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <button type="submit" class="w-full bg-primary-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-primary-700 transition-all flex justify-center items-center gap-2 group mt-2 shadow-md hover:shadow-lg">
                            Kirim Donasi @if($nominal != 'lainnya' && $nominal) - Rp {{ number_format($nominal, 0, ',', '.') }} @elseif($nominal == 'lainnya' && $nominalLainnya) - Rp {{ number_format($nominalLainnya, 0, ',', '.') }} @endif
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                        @error('nominal')
                            <p class="text-red-500 text-sm mt-3 text-center font-medium">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>

            <!-- Right: Info & Stats -->
            <div class="lg:w-[45%] flex flex-col gap-10">
                <!-- Usage Cards Section -->
                <div>
                    <div class="mb-3 sm:mb-4">
                        <span class="inline-block bg-white text-primary-600 border border-primary-100 shadow-xs font-black tracking-widest text-[10px] sm:text-xs px-3.5 py-1.5 sm:px-4 sm:py-2 rounded-full uppercase">
                            Transparansi
                        </span>
                    </div>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-black text-slate-900 tracking-tight leading-tight mb-5">Donasi Anda Digunakan Untuk:</h3>
                    
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
                <div class="bg-primary-600 rounded-3xl p-8 text-white relative overflow-hidden" x-data="{ count: 0 }" x-init="setTimeout(() => { let start = 0; let end = 2665; let duration = 2000; let timer = setInterval(() => { start += Math.ceil(end/50); if(start >= end) { count = end; clearInterval(timer); } else { count = start; } }, 40); }, 500)">
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

    <!-- Recent Donors (Dynamic Database) -->
    <section id="daftar-donatur" class="scroll-mt-20 py-16 px-6 lg:px-12 bg-white relative">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10 sm:mb-12">
                <div class="mb-3 sm:mb-4">
                    <span class="inline-block bg-white text-primary-600 border border-primary-100 shadow-xs font-black tracking-widest text-[10px] sm:text-xs px-4 py-1.5 sm:px-5 sm:py-2 rounded-full uppercase">
                        Transparansi & Amanah Donasi
                    </span>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-slate-900 tracking-tight leading-tight mb-3">Terima Kasih Kepada Para Donatur</h2>
                <p class="text-slate-500 font-medium max-w-2xl mx-auto text-xs sm:text-base leading-relaxed">
                    Jazakumullah Khairan Katsiran atas kebaikan Anda. Total terkumpul <strong class="text-primary-600 font-black">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</strong> dari <strong class="text-slate-700">{{ $totalDonaturCount }} Orang Baik</strong> untuk operasional ambulans siaga gratis.
                </p>
            </div>

            @php
                $donaturChunks = $donaturList->chunk(3);
                $totalChunks = count($donaturChunks);
                $totalDonaturItems = count($donaturList);
            @endphp

            @if($totalDonaturItems > 0)
                <!-- ================= DESKTOP VIEW: 3 CARDS PER SLIDE (hidden md:block) ================= -->
                <div class="hidden md:block relative"
                     x-data="{
                         currentSlide: 0,
                         totalSlides: {{ max(1, $totalChunks) }},
                         paused: false,
                         next() {
                             if (this.totalSlides > 1) {
                                 this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                             }
                         },
                         prev() {
                             if (this.totalSlides > 1) {
                                 this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                             }
                         },
                         init() {
                             setInterval(() => {
                                 if (!this.paused && this.totalSlides > 1) {
                                     this.next();
                                 }
                             }, 4500);
                         }
                     }"
                     @mouseenter="paused = true"
                     @mouseleave="paused = false">
                    
                    <!-- Desktop Cards Container -->
                    <div class="relative min-h-[175px]">
                        @foreach($donaturChunks as $chunkIndex => $chunk)
                            <div x-show="currentSlide === {{ $chunkIndex }}"
                                 x-transition:enter="transition ease-out duration-500 transform"
                                 x-transition:enter-start="opacity-0 translate-x-8"
                                 x-transition:enter-end="opacity-100 translate-x-0"
                                 x-transition:leave="transition ease-in duration-300 transform absolute inset-0"
                                 x-transition:leave-start="opacity-100 translate-x-0"
                                 x-transition:leave-end="opacity-0 -translate-x-8"
                                 class="grid grid-cols-2 lg:grid-cols-3 gap-5"
                                 x-cloak>
                                @foreach($chunk as $index => $d)
                                    @php
                                        $displayName = $d->is_anonim ? 'Hamba Allah' : ($d->nama ?: 'Hamba Allah');
                                        $words = explode(' ', trim($displayName));
                                        $initials = count($words) >= 2 
                                            ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                                            : strtoupper(substr($displayName, 0, 2));
                                        $colors = [
                                            ['bg' => 'bg-sky-100', 'text' => 'text-sky-700'],
                                            ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700'],
                                            ['bg' => 'bg-amber-100', 'text' => 'text-amber-700'],
                                            ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-700'],
                                            ['bg' => 'bg-rose-100', 'text' => 'text-rose-700'],
                                            ['bg' => 'bg-teal-100', 'text' => 'text-teal-700'],
                                        ];
                                        $theme = $colors[($chunkIndex * 3 + $loop->index) % count($colors)];
                                    @endphp
                                    <div class="bg-slate-50/80 rounded-2xl p-5 border border-slate-200/70 hover:border-primary-600/30 hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                                        <div>
                                            <div class="flex items-center gap-3.5 mb-3.5">
                                                <div class="w-11 h-11 rounded-full {{ $theme['bg'] }} {{ $theme['text'] }} flex items-center justify-center font-black text-sm shadow-xs shrink-0 group-hover:scale-105 transition-transform">
                                                    {{ $initials }}
                                                </div>
                                                <div class="min-w-0">
                                                    <h4 class="font-extrabold text-slate-800 text-sm truncate">{{ $displayName }}</h4>
                                                    <p class="text-xs text-slate-400 font-medium">{{ $d->created_at ? $d->created_at->diffForHumans() : 'Baru saja' }}</p>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <span class="inline-block px-2.5 py-0.5 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-black">
                                                    Berdonasi Rp {{ number_format($d->nominal, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <p class="text-xs sm:text-sm text-slate-600 italic leading-relaxed line-clamp-3">
                                                "{{ $d->pesan ?: 'Semoga berkah dan bermanfaat untuk masyarakat yang membutuhkan pertolongan medis.' }}"
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <!-- Desktop Slide Controls -->
                    @if($totalChunks > 1)
                        <div class="flex items-center justify-center gap-3 mt-6">
                            <button @click="prev()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-primary-50 text-slate-600 hover:text-primary-600 flex items-center justify-center transition border border-slate-200/80 shadow-xs" title="Sebelumnya">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            
                            <div class="flex items-center gap-1.5">
                                @for($i = 0; $i < $totalChunks; $i++)
                                    <button @click="currentSlide = {{ $i }}" 
                                            class="h-2 rounded-full transition-all duration-300"
                                            :class="currentSlide === {{ $i }} ? 'w-6 bg-primary-600' : 'w-2 bg-slate-300 hover:bg-slate-400'"></button>
                                @endfor
                            </div>

                            <button @click="next()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-primary-50 text-slate-600 hover:text-primary-600 flex items-center justify-center transition border border-slate-200/80 shadow-xs" title="Selanjutnya">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    @endif
                </div>

                <!-- ================= MOBILE VIEW: 1 CARD PERIODIC AUTO-SLIDER (md:hidden) ================= -->
                <div class="md:hidden relative"
                     x-data="{
                         current: 0,
                         total: {{ $totalDonaturItems }},
                         paused: false,
                         touchStartX: 0,
                         touchEndX: 0,
                         next() {
                             if (this.total > 1) {
                                 this.current = (this.current + 1) % this.total;
                             }
                         },
                         prev() {
                             if (this.total > 1) {
                                 this.current = (this.current - 1 + this.total) % this.total;
                             }
                         },
                         init() {
                             setInterval(() => {
                                 if (!this.paused && this.total > 1) {
                                     this.next();
                                 }
                             }, 3800);
                         }
                     }"
                     @mouseenter="paused = true"
                     @mouseleave="paused = false"
                     @touchstart="paused = true; touchStartX = $event.changedTouches[0].screenX"
                     @touchend="paused = false; touchEndX = $event.changedTouches[0].screenX; if (touchStartX - touchEndX > 40) next(); if (touchEndX - touchStartX > 40) prev();">
                    
                    <div class="relative overflow-hidden rounded-2xl shadow-sm">
                        <div class="flex transition-transform duration-500 ease-out"
                             :style="'transform: translateX(-' + (current * 100) + '%)'">
                            @foreach($donaturList as $index => $d)
                                @php
                                    $displayName = $d->is_anonim ? 'Hamba Allah' : ($d->nama ?: 'Hamba Allah');
                                    $words = explode(' ', trim($displayName));
                                    $initials = count($words) >= 2 
                                        ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                                        : strtoupper(substr($displayName, 0, 2));
                                    $colors = [
                                        ['bg' => 'bg-sky-100', 'text' => 'text-sky-700'],
                                        ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700'],
                                        ['bg' => 'bg-amber-100', 'text' => 'text-amber-700'],
                                        ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-700'],
                                        ['bg' => 'bg-rose-100', 'text' => 'text-rose-700'],
                                        ['bg' => 'bg-teal-100', 'text' => 'text-teal-700'],
                                    ];
                                    $theme = $colors[$loop->index % count($colors)];
                                @endphp
                                <div class="w-full flex-shrink-0">
                                    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex flex-col justify-between min-h-[175px]">
                                        <div>
                                            <div class="flex items-center gap-3.5 mb-3">
                                                <div class="w-10 h-10 rounded-full {{ $theme['bg'] }} {{ $theme['text'] }} flex items-center justify-center font-black text-xs shadow-xs shrink-0">
                                                    {{ $initials }}
                                                </div>
                                                <div class="min-w-0">
                                                    <h4 class="font-extrabold text-slate-800 text-sm truncate">{{ $displayName }}</h4>
                                                    <p class="text-xs text-slate-400 font-medium">{{ $d->created_at ? $d->created_at->diffForHumans() : 'Baru saja' }}</p>
                                                </div>
                                            </div>
                                            <div class="mb-2.5">
                                                <span class="inline-block px-2.5 py-0.5 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-black">
                                                    Berdonasi Rp {{ number_format($d->nominal, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <p class="text-xs text-slate-600 italic leading-relaxed line-clamp-3">
                                                "{{ $d->pesan ?: 'Semoga berkah dan bermanfaat untuk masyarakat yang membutuhkan pertolongan medis.' }}"
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Mobile Slide Controls (Dots & Arrows) -->
                    @if($totalDonaturItems > 1)
                        <div class="flex items-center justify-center gap-3 mt-4">
                            <button @click="prev()" type="button" aria-label="Sebelumnya" class="w-7 h-7 rounded-full bg-white hover:bg-primary-50 text-slate-600 hover:text-primary-600 flex items-center justify-center transition border border-slate-200 shadow-xs active:scale-95">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            
                            <div class="flex items-center gap-1.5">
                                @foreach($donaturList as $i => $d)
                                    <button @click="current = {{ $i }}" 
                                            type="button"
                                            class="h-1.5 rounded-full transition-all duration-300"
                                            :class="current === {{ $i }} ? 'w-5 bg-primary-600' : 'w-1.5 bg-slate-300 hover:bg-slate-400'"></button>
                                @endforeach
                            </div>

                            <button @click="next()" type="button" aria-label="Berikutnya" class="w-7 h-7 rounded-full bg-white hover:bg-primary-50 text-slate-600 hover:text-primary-600 flex items-center justify-center transition border border-slate-200 shadow-xs active:scale-95">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-8 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                    <p class="text-slate-500 font-semibold text-sm">Belum ada data donasi tercatat. Jadilah donatur pertama hari ini!</p>
                </div>
            @endif
            
            <div class="text-center mt-8">
                <button wire:click="toggleAllDonaturModal" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-slate-100 hover:bg-primary-50 text-slate-700 hover:text-primary-700 font-bold text-sm transition-all duration-200 border border-slate-200">
                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Lihat Semua Donatur
                </button>
            </div>
        </div>

        <!-- Modal Semua Donatur -->
        @if($showAllDonaturModal)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4" x-transition>
            <div class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl border border-slate-100 relative max-h-[85vh] flex flex-col">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h3 class="text-xl font-black text-slate-800">Daftar Seluruh Donatur</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Total {{ $totalDonaturCount }} transaksi donasi tercatat</p>
                    </div>
                    <button wire:click="toggleAllDonaturModal" class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="overflow-y-auto py-4 space-y-3 flex-1 pr-1 custom-scrollbar">
                    @forelse($allDonaturList as $d)
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 flex items-start justify-between gap-4">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                                {{ strtoupper(substr($d->is_anonim ? 'HA' : ($d->nama ?: 'HA'), 0, 2)) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm">{{ $d->is_anonim ? 'Hamba Allah' : $d->nama }}</h4>
                                <p class="text-xs text-slate-500 italic mt-0.5">"{{ $d->pesan ?: 'Semoga berkah.' }}"</p>
                                <span class="text-[11px] text-slate-400 block mt-1">{{ $d->created_at ? $d->created_at->format('d M Y, H:i') : '-' }}</span>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <span class="text-sm font-black text-emerald-600">Rp {{ number_format($d->nominal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-slate-400 py-8 text-sm">Belum ada data donatur.</p>
                    @endforelse
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end">
                    <button wire:click="toggleAllDonaturModal" class="px-6 py-2.5 bg-slate-800 text-white rounded-full font-bold text-xs hover:bg-slate-900 transition">Tutup</button>
                </div>
            </div>
        </div>
        @endif
    </section>

    <!-- Bottom CTA Redesign (Gallery & Video Dokumentasi Kegiatan) -->
    <section class="relative py-12 sm:py-16 px-4 sm:px-6 lg:px-12 bg-white overflow-hidden">
        
        <!-- Soft Blue Gradient Background -->
        <div class="absolute inset-0 bg-gradient-to-b from-sky-50/40 via-white to-white pointer-events-none"></div>

        <!-- Soft Glow Behind Gallery (Right side) -->
        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-[500px] md:w-[700px] h-[500px] md:h-[700px] bg-gradient-to-tr from-primary-600/5 to-sky-300/5 rounded-full blur-[80px] pointer-events-none"></div>

        <!-- Star of Life Watermark (Top Left) -->
        <div class="absolute -left-10 -top-10 pointer-events-none rotate-12 text-primary-600" style="opacity: 0.04;">
            <svg class="w-48 h-48 md:w-72 md:h-72" viewBox="0 0 512 512" fill="currentColor">
                <path d="M213.3 22.5h85.4v149.3l129.3-74.6 42.7 73.9-129.3 74.6 129.3 74.6-42.7 73.9-129.3-74.6v149.3h-85.4V319.6l-129.3 74.6-42.7-73.9 129.3-74.6-129.3-74.6 42.7-73.9 129.3 74.6V22.5z"/>
            </svg>
        </div>

        <!-- ECG Line Watermark (Bottom Right) -->
        <div class="absolute -right-5 bottom-5 pointer-events-none text-primary-600" style="opacity: 0.05;">
            <svg class="w-72 md:w-96 h-24 md:h-32" viewBox="0 0 512 150" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M0,75 L50,75 L70,60 L90,75 L120,75 L150,20 L180,130 L210,75 L250,75 L270,55 L290,75 L512,75" />
            </svg>
        </div>
        
        <div class="max-w-7xl mx-auto relative z-10" x-data="{
            activeMedia: 0,
            media: [
                {
                    type: 'video',
                    src: '{{ asset('images/videogsc (1).mp4') }}',
                    thumb: '{{ asset('images/beranda_utama_thumb.jpg') }}',
                    badge: 'Video Testimoni',
                    title: 'Video Testimoni: Respon Cepat Evakuasi Medis',
                    desc: 'Ungkapan rasa syukur keluarga pasien saat diantar ke fasilitas kesehatan rujukan secara gratis dan tepat waktu.'
                },
                {
                    type: 'video',
                    src: '{{ asset('images/videogsc (2).mp4') }}',
                    thumb: '{{ asset('images/mitra.jpg') }}',
                    badge: 'Video Testimoni',
                    title: 'Video Testimoni: Pelayanan Ramah & Siaga 24 Jam',
                    desc: 'Testimoni warga dan kerabat atas dedikasi supir serta relawan Ambulans Siaga dalam melayani masyarakat.'
                },
                {
                    type: 'image',
                    src: '{{ asset('images/dokumgsc (27).JPG') }}',
                    thumb: '{{ asset('images/dokumgsc (27).JPG') }}',
                    badge: 'Foto Dokumentasi',
                    title: 'Armada & Driver Siaga 24 Jam',
                    desc: 'Ambulans Siaga selalu siap siaga 24 jam untuk melayani masyarakat yang membutuhkan evakuasi medis darurat.'
                },
                {
                    type: 'image',
                    src: '{{ asset('images/dokumgsc (7).JPG') }}',
                    thumb: '{{ asset('images/dokumgsc (7).JPG') }}',
                    badge: 'Foto Dokumentasi',
                    title: 'Tim Tanggap Darurat Medis & Relawan',
                    desc: 'Didukung oleh tenaga lapangan dan relawan yang terlatih dan berdedikasi dalam penanganan darurat serta bencana.'
                },
                {
                    type: 'image',
                    src: '{{ asset('images/dokumgsc (21).JPG') }}',
                    thumb: '{{ asset('images/dokumgsc (21).JPG') }}',
                    badge: 'Foto Dokumentasi',
                    title: 'Peduli Pasien & Masyarakat Dhuafa',
                    desc: 'Pelayanan kemanusiaan yang tulus menyentuh langsung masyarakat prasejahtera yang membutuhkan bantuan medis.'
                },
                {
                    type: 'image',
                    src: '{{ asset('images/dokumgsc (3).JPG') }}',
                    thumb: '{{ asset('images/dokumgsc (3).JPG') }}',
                    badge: 'Foto Dokumentasi',
                    title: 'Bantuan Logistik Darurat & Air Bersih',
                    desc: 'Aksi tanggap darurat menjangkau wilayah krisis dengan penyaluran air bersih dan logistik kesehatan terpadu.'
                },
                {
                    type: 'image',
                    src: '{{ asset('images/dokumgsc (24).JPG') }}',
                    thumb: '{{ asset('images/dokumgsc (24).JPG') }}',
                    badge: 'Foto Dokumentasi',
                    title: 'Dedikasi Relawan Kemanusiaan',
                    desc: 'Para relawan bekerja dengan penuh kepedulian, menyalurkan amanah donasi langsung kepada penerima manfaat secara tepat sasaran.'
                }
            ]
        }">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-center">
                
                <!-- Left Column (Text & CTA) -->
                <div class="w-full lg:w-[42%] flex flex-col justify-center text-center lg:text-left">
                    <div class="mb-3 sm:mb-4">
                        <span class="inline-flex items-center gap-2 bg-white text-primary-600 border border-primary-100 shadow-sm font-black tracking-widest text-[10px] sm:text-xs px-4 py-1.5 sm:px-5 sm:py-2 rounded-full uppercase w-fit mx-auto lg:mx-0">
                            <svg class="w-3.5 h-3.5 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                            Dokumentasi Aksi Nyata & Video
                        </span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl lg:text-[2.2rem] font-black text-slate-900 tracking-tight leading-tight sm:leading-snug mb-4 sm:mb-6">
                        Satu aksi kebaikan Anda hari ini, bisa jadi adalah jawaban atas doa mereka yang sedang dalam kesulitan darurat medis.
                    </h2>
                    <div class="w-14 sm:w-16 h-1 bg-primary-600 rounded-full mb-6 sm:mb-8 mx-auto lg:mx-0"></div>
                    <div class="flex justify-center lg:justify-start">
                        <button onclick="document.getElementById('form-donasi').scrollIntoView({behavior: 'smooth'})" class="bg-primary-600 hover:bg-primary-700 text-white px-7 sm:px-8 py-3.5 sm:py-4 rounded-xl font-black text-xs sm:text-sm uppercase tracking-wider transition-all duration-300 shadow-lg shadow-primary-600/25 hover:shadow-xl hover:shadow-primary-600/35 hover:-translate-y-1 active:scale-95 flex items-center gap-2.5 w-fit group cursor-pointer">
                            <span>Donasi Sekarang</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Right Column (Interactive Gallery with Video & Photos) -->
                <div class="w-full lg:w-[58%]">
                    <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-xl shadow-slate-200/50 border border-slate-200/80">
                        
                        <!-- Main Media Container -->
                        <div class="relative w-full aspect-video rounded-xl sm:rounded-2xl overflow-hidden mb-4 sm:mb-5 bg-slate-900 shadow-inner group">
                            <template x-for="(item, index) in media" :key="index">
                                <div x-show="activeMedia === index" 
                                     x-transition:enter="transition ease-out duration-300" 
                                     x-transition:enter-start="opacity-0 scale-[1.02]" 
                                     x-transition:enter-end="opacity-100 scale-100"
                                     class="absolute inset-0 w-full h-full flex items-center justify-center bg-black">
                                    
                                    <template x-if="item.type === 'video'">
                                        <video :src="item.src" :poster="item.thumb" controls class="w-full h-full object-contain">
                                            Browser Anda tidak mendukung tag video HTML5.
                                        </video>
                                    </template>
                                    
                                    <template x-if="item.type === 'image'">
                                        <img :src="item.src" :alt="item.title" class="w-full h-full object-cover">
                                    </template>
                                </div>
                            </template>
                        </div>

                        <!-- Caption & Badge -->
                        <div class="mb-4 px-1 min-h-[3.6rem] sm:min-h-[4rem]">
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="px-2.5 py-0.5 rounded-md text-[10px] font-black uppercase tracking-wider bg-primary-100 text-primary-800"
                                      x-text="media[activeMedia].badge"></span>
                                <h3 class="text-base sm:text-lg font-bold text-slate-800 line-clamp-1" x-text="media[activeMedia].title"></h3>
                            </div>
                            <p class="text-slate-500 leading-relaxed text-xs sm:text-sm line-clamp-2" x-text="media[activeMedia].desc"></p>
                        </div>

                        <!-- Thumbnails (With Video Play Indicator) -->
                        <div class="flex gap-2.5 sm:gap-3 overflow-x-auto pb-2 pt-1 px-1 custom-scrollbar snap-x">
                            <template x-for="(item, index) in media" :key="index">
                                <div @click="activeMedia = index" 
                                     class="relative w-16 sm:w-20 md:w-24 aspect-video rounded-lg sm:rounded-xl overflow-hidden cursor-pointer shrink-0 snap-center border-2 transition-all duration-300 group/thumb hover:-translate-y-0.5 shadow-2xs"
                                     :class="activeMedia === index ? 'border-primary-600 ring-2 ring-primary-500/30 scale-[1.03] z-10' : 'border-slate-200/80 opacity-75 hover:opacity-100 hover:border-primary-400'">
                                    
                                    <img :src="item.thumb" :alt="item.title" class="w-full h-full object-cover transition-transform duration-500" :class="activeMedia === index ? 'scale-105' : 'group-hover/thumb:scale-110'">
                                    
                                    <!-- Video Play Icon Badge on Thumbnail -->
                                    <template x-if="item.type === 'video'">
                                        <div class="absolute inset-0 bg-black/35 flex items-center justify-center">
                                            <div class="w-5 h-5 rounded-full bg-amber-400 text-slate-900 flex items-center justify-center shadow-md">
                                                <svg class="w-3 h-3 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                            </div>
                                        </div>
                                    </template>

                                    <!-- Active State Inner Gradient -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-primary-600/40 to-transparent opacity-0 transition-opacity duration-300 pointer-events-none" :class="activeMedia === index ? 'opacity-100' : ''"></div>
                                </div>
                            </template>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Testimonials & Interactive Feedback Section (Di Paling Bawah Setelah Dokumentasi) -->
    <section class="py-12 sm:py-16 px-4 sm:px-6 lg:px-12 bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-10">
                <div class="mb-3 sm:mb-4">
                    <span class="inline-block bg-white text-primary-600 border border-primary-100 shadow-xs font-black tracking-widest text-[10px] sm:text-xs px-4 py-1.5 sm:px-5 sm:py-2 rounded-full uppercase">
                        Rating & Testimoni
                    </span>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-slate-900 tracking-tight leading-tight mb-2.5 sm:mb-3">Apa Kata Mereka?</h2>
                <p class="text-slate-500 font-medium text-xs sm:text-sm md:text-base max-w-2xl mx-auto leading-relaxed">Pengalaman nyata masyarakat, keluarga pasien, dan donatur terhadap layanan Ambulans Siaga.</p>
            </div>
            
            <!-- ================= DESKTOP VIEW: 3 CARDS GRID (hidden md:grid) ================= -->
            <div class="hidden md:grid md:grid-cols-3 gap-5 mb-6 sm:mb-8">
                @forelse($testimoniList as $t)
                <div class="bg-white p-5 sm:p-6 rounded-2xl shadow-xs border border-slate-200/80 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex text-amber-400 mb-3 items-center gap-1">
                            @for($s = 1; $s <= ($t->skor ?: 5); $s++)
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-4 font-medium italic">"{!! e($t->ulasan) !!}"</p>
                    </div>
                    <div class="pt-3.5 border-t border-slate-100">
                        <p class="font-extrabold text-slate-800 text-xs sm:text-sm">- {{ $t->nama_tampil }}</p>
                        <p class="text-[11px] sm:text-xs text-primary-600 font-semibold mt-0.5">{{ $t->peran_tampil }}</p>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-8 bg-white rounded-2xl border border-slate-200">
                    <p class="text-slate-500 font-semibold text-sm">Belum ada ulasan tersimpan. Tulis pesan umpan balik pertama Anda di bawah ini!</p>
                </div>
                @endforelse
            </div>

            <!-- ================= MOBILE VIEW: 1 CARD PERIODIC AUTO-SLIDER (md:hidden) ================= -->
            <div class="md:hidden mb-6 relative"
                 x-data="{
                     current: 0,
                     total: {{ count($testimoniList) }},
                     paused: false,
                     touchStartX: 0,
                     touchEndX: 0,
                     next() {
                         if (this.total > 1) {
                             this.current = (this.current + 1) % this.total;
                         }
                     },
                     prev() {
                         if (this.total > 1) {
                             this.current = (this.current - 1 + this.total) % this.total;
                         }
                     },
                     init() {
                         setInterval(() => {
                             if (!this.paused && this.total > 1) {
                                 this.next();
                             }
                         }, 4200);
                     }
                 }"
                 @mouseenter="paused = true"
                 @mouseleave="paused = false"
                 @touchstart="paused = true; touchStartX = $event.changedTouches[0].screenX"
                 @touchend="paused = false; touchEndX = $event.changedTouches[0].screenX; if (touchStartX - touchEndX > 40) next(); if (touchEndX - touchStartX > 40) prev();">
                 
                <div class="relative overflow-hidden rounded-2xl shadow-xs">
                    <div class="flex transition-transform duration-500 ease-out"
                         :style="'transform: translateX(-' + (current * 100) + '%)'">
                        @forelse($testimoniList as $t)
                        <div class="w-full flex-shrink-0">
                            <div class="bg-white p-5 rounded-2xl shadow-xs border border-slate-200/80 flex flex-col justify-between min-h-[160px] sm:min-h-[175px]">
                                <div>
                                    <div class="flex text-amber-400 mb-2.5 items-center gap-1">
                                        @for($s = 1; $s <= ($t->skor ?: 5); $s++)
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @endfor
                                    </div>
                                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-4 font-medium italic">"{!! e($t->ulasan) !!}"</p>
                                </div>
                                <div class="pt-3 border-t border-slate-100">
                                    <p class="font-extrabold text-slate-800 text-xs sm:text-sm">- {{ $t->nama_tampil }}</p>
                                    <p class="text-[11px] sm:text-xs text-primary-600 font-semibold mt-0.5">{{ $t->peran_tampil }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="w-full text-center py-8 bg-white rounded-2xl border border-slate-200">
                            <p class="text-slate-500 font-semibold text-sm">Belum ada ulasan tersimpan. Tulis pesan umpan balik pertama Anda di bawah ini!</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Mobile Slide Controls (Dots & Arrows) -->
                @if(count($testimoniList) > 1)
                    <div class="flex items-center justify-center gap-3 mt-4">
                        <button @click="prev()" type="button" aria-label="Sebelumnya" class="w-7 h-7 rounded-full bg-white hover:bg-primary-50 text-slate-600 hover:text-primary-600 flex items-center justify-center transition border border-slate-200 shadow-xs active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        
                        <div class="flex items-center gap-1.5">
                            @foreach($testimoniList as $i => $t)
                                <button @click="current = {{ $i }}" 
                                        type="button"
                                        class="h-1.5 rounded-full transition-all duration-300"
                                        :class="current === {{ $i }} ? 'w-5 bg-primary-600' : 'w-1.5 bg-slate-300 hover:bg-slate-400'"></button>
                            @endforeach
                        </div>

                        <button @click="next()" type="button" aria-label="Berikutnya" class="w-7 h-7 rounded-full bg-white hover:bg-primary-50 text-slate-600 hover:text-primary-600 flex items-center justify-center transition border border-slate-200 shadow-xs active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Tombol Lihat Semua Ulasan -->
            <div class="text-center mb-10 sm:mb-12">
                <button wire:click="toggleAllReviewModal" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white hover:bg-primary-50 text-slate-700 hover:text-primary-700 font-bold text-sm transition-all duration-200 border border-slate-200 active:scale-95 cursor-pointer">
                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <span>Lihat Semua Ulasan</span>
                </button>
            </div>

            <!-- Interaktif: Form Kirim Pesan Kebaikan & Umpan Balik Layanan -->
            <div class="max-w-2xl mx-auto bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 shadow-xl shadow-slate-200/60 border border-slate-200/80 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 rounded-full bg-gradient-to-br from-primary-600/10 to-teal-500/5 pointer-events-none"></div>

                <div class="text-center mb-6">
                    <div class="mb-3">
                        <span class="inline-block bg-sky-50 text-primary-600 border border-primary-200/80 shadow-xs font-black tracking-widest text-[10px] sm:text-xs px-3.5 py-1.5 rounded-full uppercase">
                            Umpan Balik Publik
                        </span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight leading-tight">Kirimkan Doa, Pesan Kebaikan, atau Ulasan Layanan</h3>
                    <p class="text-slate-500 text-xs sm:text-sm mt-2 max-w-md mx-auto leading-relaxed">Pesan Anda akan tampil di halaman ini dan memberikan semangat bagi para pejuang kemanusiaan.</p>
                </div>

                @if($feedbackSuccessMessage)
                <div class="mb-5 p-3.5 sm:p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm font-bold flex items-center gap-3 shadow-xs"
                     x-data="{ show: true }" x-show="show" x-transition>
                    <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="flex-1">{{ $feedbackSuccessMessage }}</span>
                </div>
                @endif

                <form wire:submit.prevent="kirimUmpanBalik" class="space-y-4 sm:space-y-5">
                    
                    <!-- Rating Star Picker Section (Center Box) -->
                    <div class="bg-gradient-to-b from-slate-50 to-amber-50/20 rounded-xl sm:rounded-2xl p-4 sm:p-5 border border-slate-200/70 text-center"
                         x-data="{ 
                             hoverRating: 0,
                             ratingLabels: {
                                 1: 'Perlu Peningkatan (1/5)',
                                 2: 'Kurang Puas (2/5)',
                                 3: 'Cukup Baik (3/5)',
                                 4: 'Puas & Membantu (4/5)',
                                 5: 'Sangat Puas & Luar Biasa (5/5)'
                             }
                         }">
                        <label class="block text-[11px] sm:text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">
                            Beri Rating Penilaian <span class="text-red-500">*</span>
                        </label>
                        
                        <!-- 5 Interactive Stars -->
                        <div class="flex items-center justify-center gap-1.5 sm:gap-2.5 my-1.5" @mouseleave="hoverRating = 0">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" 
                                        @mouseenter="hoverRating = {{ $i }}"
                                        wire:click="$set('feedbackSkor', {{ $i }})"
                                        class="p-1 rounded-lg transition-all duration-200 transform hover:scale-125 focus:outline-none group active:scale-95 cursor-pointer"
                                        aria-label="Beri rating {{ $i }} bintang">
                                    <svg class="w-7 h-7 sm:w-8 sm:h-8 transition-colors duration-200 filter drop-shadow-xs"
                                         :class="(hoverRating ? hoverRating >= {{ $i }} : {{ $feedbackSkor }} >= {{ $i }}) ? 'text-amber-400 fill-amber-400' : 'text-slate-200 fill-slate-200'"
                                         viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                </button>
                            @endfor
                        </div>

                        <!-- Dynamic Label Text -->
                        <p class="text-xs sm:text-sm font-bold text-amber-800 transition-all min-h-[18px] mt-1"
                           x-text="ratingLabels[hoverRating || {{ $feedbackSkor }}]">
                        </p>
                    </div>

                    <!-- Input Grid: Nama & Peran -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 sm:gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap / Inisial <span class="text-red-500">*</span></label>
                            <input type="text" wire:model="feedbackNama" placeholder="Contoh: Bapak Hendra / Hamba Allah" class="w-full px-3.5 py-2.5 sm:py-3 rounded-xl border border-slate-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 text-xs sm:text-sm transition bg-white">
                            @error('feedbackNama') <span class="text-xs text-red-500 font-semibold block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Status / Peran <span class="text-red-500">*</span></label>
                            <div class="relative" x-data="{ open: false }">
                                <button type="button" @click="open = !open" @click.outside="open = false"
                                        class="w-full flex items-center justify-between px-3.5 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-white text-xs sm:text-sm font-semibold text-slate-800 shadow-2xs hover:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-600/20 transition-all cursor-pointer">
                                    <span class="truncate">{{ $feedbackPeran ?? 'Pilih Status / Peran' }}</span>
                                    <svg class="w-4 h-4 text-slate-400 ml-2 flex-shrink-0 transition-transform duration-200" :class="open ? 'rotate-180 text-primary-600' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>

                                <!-- Floating Menu (Admin Style) -->
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-100"
                                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                     x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                                     class="absolute left-0 top-full mt-1.5 w-full bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50 overflow-hidden"
                                     style="display: none;">
                                    @php
                                        $peranOptions = ['Donatur', 'Keluarga Pasien', 'Relawan Medis', 'Masyarakat Umum'];
                                    @endphp
                                    @foreach($peranOptions as $opt)
                                        <button type="button" @click="$wire.set('feedbackPeran', '{{ $opt }}'); open = false"
                                                class="w-full text-left px-4 py-2.5 text-xs sm:text-sm font-semibold flex items-center justify-between transition-colors cursor-pointer {{ $feedbackPeran === $opt ? 'text-primary-600 bg-sky-50/70 font-bold' : 'text-slate-700 hover:bg-sky-50/50 hover:text-primary-600' }}">
                                            <span>{{ $opt }}</span>
                                            @if($feedbackPeran === $opt)
                                                <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            @endif
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                            @error('feedbackPeran') <span class="text-xs text-red-500 font-semibold block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Kota / Domisili -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kota / Domisili <span class="text-slate-400 font-normal">(Opsional)</span></label>
                        <input type="text" wire:model="feedbackLokasi" placeholder="Contoh: Cilacap, Jawa Tengah" class="w-full px-3.5 py-2.5 sm:py-3 rounded-xl border border-slate-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 text-xs sm:text-sm transition bg-white">
                    </div>

                    <!-- Pesan Testimoni / Doa Kebaikan -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pesan Testimoni / Doa Kebaikan <span class="text-red-500">*</span></label>
                        <textarea wire:model="feedbackPesan" rows="3" placeholder="Tuliskan apresiasi, pengalaman layanan ambulans, atau doa untuk para relawan..." class="w-full px-3.5 py-2.5 sm:py-3 rounded-xl border border-slate-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 text-xs sm:text-sm transition bg-white leading-relaxed"></textarea>
                        @error('feedbackPesan') <span class="text-xs text-red-500 font-semibold block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center pt-1">
                        <button type="submit" 
                                class="inline-flex items-center justify-center bg-primary-600 hover:bg-primary-700 text-white px-7 sm:px-8 py-3 sm:py-3.5 rounded-full font-black text-xs sm:text-sm uppercase tracking-wider active:scale-95 transition-all shadow-md hover:shadow-lg shadow-primary-600/25 w-full sm:w-auto cursor-pointer">
                            <span>Kirim Ulasan & Pesan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Semua Ulasan -->
        @if($showAllReviewModal)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4" x-transition>
            <div class="bg-white rounded-3xl max-w-3xl w-full p-6 sm:p-8 shadow-2xl border border-slate-100 relative max-h-[85vh] flex flex-col">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h3 class="text-xl font-black text-slate-800">Semua Ulasan & Testimoni</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Total {{ $totalRatingCount }} ulasan dari masyarakat dan donatur</p>
                    </div>
                    <button wire:click="toggleAllReviewModal" class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="overflow-y-auto py-4 space-y-3 flex-1 pr-1 custom-scrollbar">
                    @forelse($allReviewList as $t)
                    <div class="bg-slate-50 p-4 sm:p-5 rounded-2xl border border-slate-100">
                        <div class="flex text-yellow-400 mb-2 items-center gap-1">
                            @for($s = 1; $s <= ($t->skor ?: 5); $s++)
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                        <p class="text-slate-700 text-sm leading-relaxed mb-3">"{!! e($t->ulasan) !!}"</p>
                        <div class="flex items-center justify-between text-xs text-slate-400 pt-2 border-t border-slate-200/60">
                            <span class="font-bold text-slate-700">{{ $t->nama_tampil }} <span class="text-primary-600 font-semibold">({{ $t->peran_tampil }})</span></span>
                            <span>{{ $t->created_at ? $t->created_at->format('d M Y') : '' }}</span>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-slate-400 py-8 text-sm">Belum ada data ulasan.</p>
                    @endforelse
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end">
                    <button wire:click="toggleAllReviewModal" class="px-6 py-2.5 bg-slate-800 text-white rounded-full font-bold text-xs hover:bg-slate-900 transition">Tutup</button>
                </div>
            </div>
        </div>
        @endif
    </section>

    <x-landing-footer />

    @push('scripts')
    <script src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('snap-token-created', (event) => {
                let token = event?.[0]?.token || event?.token; // Safe extraction of token
                snap.pay(token, {
                    onSuccess: function(result){
                        window.location.href = '/donasi';
                    },
                    onPending: function(result){
                        window.location.href = '/donasi';
                    },
                    onError: function(result){
                        console.log('Pembayaran gagal', result);
                    },
                    onClose: function(){
                        console.log('Popup ditutup sebelum pembayaran selesai');
                    }
                });
            });
        });
    </script>
    @endpush
</div>
