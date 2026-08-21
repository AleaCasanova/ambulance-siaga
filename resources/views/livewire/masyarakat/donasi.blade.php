<div>


    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-600 to-primary-700 pt-40 pb-20 px-6 lg:px-12 overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12 relative z-10">
            <div class="md:w-1/2 text-white z-10 text-center md:text-left">
                <span class="inline-flex items-center gap-2 mb-6 bg-white/10 backdrop-blur px-4 py-2 rounded-full border border-white/20 shadow-xl">
                    <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path></svg>
                    <span class="font-bold tracking-wider text-xs uppercase">Program Kemanusiaan & Donasi Operasional</span>
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-[1.15] mb-6 drop-shadow-lg">
                    Bersama Kita Selamatkan Lebih Banyak Nyawa
                </h1>
                <p class="text-lg text-sky-100 mb-8 max-w-lg mx-auto md:mx-0 leading-relaxed font-medium">
                    Ribuan pasien gawat darurat dan keluarga kurang mampu menanti uluran tangan Anda. Donasi Anda menjadi energi operasional Ambulans Siaga 24 Jam.
                </p>
                <div class="flex gap-4 justify-center md:justify-start">
                    <button onclick="document.getElementById('form-donasi').scrollIntoView({behavior: 'smooth'})" class="bg-white text-primary-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-slate-50 transition-all shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:scale-105 flex items-center gap-2">
                        Donasi Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </button>
                </div>
            </div>
            <div class="md:w-1/2 relative hidden md:block">
                <div class="absolute right-0 top-1/2 -translate-y-1/2 w-[350px] h-[350px] bg-white/20 rounded-full blur-3xl"></div>
                <img src="{{ asset('images/dokumgsc (28).JPG') }}" alt="Aksi Nyata Relawan Ambulans Siaga" class="relative z-10 rounded-[3rem] shadow-2xl border-4 border-white/30 hover:-translate-y-2 transition-transform duration-500 object-cover w-full h-[400px]">
            </div>
        </div>
    </section>

    <!-- Donation Section (Form & Info) -->
    <section id="form-donasi" class="py-16 px-6 lg:px-12 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-12 lg:gap-16">
            
            <!-- Left: Donation Form -->
            <div class="lg:w-[55%]">
                <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgb(0,0,0,0.05)] border border-slate-100 p-8 sm:p-12 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary-600/5 rounded-bl-full -z-0"></div>
                    
                    <h2 class="text-3xl font-black text-slate-800 mb-2 relative z-10">Mulai Berdonasi</h2>
                    <p class="text-slate-500 mb-8 font-medium relative z-10">Pilih nominal atau masukkan nominal donasi terbaik Anda.</p>

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
                                    <button type="button" wire:click="$set('nominal', '{{ $nom }}')" class="py-2 px-4 rounded-xl border-2 text-center transition-all relative flex flex-col items-center justify-center @if($nominal == $nom) bg-[#f4faef] border-[#8DC63F] text-slate-800 shadow-sm @else bg-white border-slate-100 text-slate-600 hover:border-slate-200 shadow-sm @endif" style="min-height: 4.5rem;">
                                        <div class="font-bold text-sm">{{ $label }}</div>
                                        @if($nom == 100000)
                                            <div class="text-[10px] text-slate-400 font-normal">sering dipilih</div>
                                        @endif
                                        @if($nominal == $nom)
                                            <div class="absolute top-1.5 right-1.5 text-[#8DC63F] bg-white rounded-full leading-none">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            </div>
                                        @endif
                                    </button>
                                @endforeach
                                <button type="button" wire:click="$set('nominal', 'lainnya')" class="py-2 px-4 rounded-xl border-2 text-center transition-all relative flex flex-col items-center justify-center @if($nominal == 'lainnya') bg-[#f4faef] border-[#8DC63F] text-slate-800 shadow-sm @else bg-white border-slate-100 text-slate-600 hover:border-slate-200 shadow-sm @endif" style="min-height: 4.5rem;">
                                    <div class="font-bold text-sm">Nominal</div>
                                    <div class="text-[10px] text-slate-400 font-normal">lainnya</div>
                                    @if($nominal == 'lainnya')
                                        <div class="absolute top-1.5 right-1.5 text-[#8DC63F] bg-white rounded-full leading-none">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        </div>
                                    @endif
                                </button>
                            </div>
                            @if($nominal == 'lainnya')
                                <div class="relative flex items-center w-full mt-3">
                                    <span class="absolute text-slate-500 font-bold text-base pointer-events-none" style="left: 1.25rem;">Rp</span>
                                    <input type="number" wire:model.live="nominalLainnya" placeholder="Masukkan Nominal" class="w-full bg-white border border-slate-200 rounded-xl text-slate-500 text-right font-medium focus:ring-2 focus:ring-[#8DC63F]/20 focus:border-[#8DC63F] transition-all placeholder:font-normal placeholder:text-slate-400 placeholder:text-right shadow-sm" style="padding-left: 3.5rem; padding-right: 1.25rem; padding-top: 1rem; padding-bottom: 1rem;">
                                </div>
                            @endif
                        </div>

                        <!-- Data Donatur -->
                        <div class="space-y-4 mb-8">
                            <div>
                                <input type="text" wire:model="nama" placeholder="Nama Lengkap" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg text-slate-800 focus:ring-2 focus:ring-[#8DC63F]/20 focus:border-[#8DC63F] transition-all disabled:opacity-50 disabled:bg-slate-100 disabled:cursor-not-allowed" @if($isAnonim) disabled @endif>
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
                                <input type="tel" wire:model="whatsapp" placeholder="No Whatsapp atau Handphone" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg text-slate-800 focus:ring-2 focus:ring-[#8DC63F]/20 focus:border-[#8DC63F] transition-all">
                            </div>
                            <div class="mb-8">
                                <input type="email" wire:model="email" placeholder="Email (optional)" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg text-slate-800 focus:ring-2 focus:ring-[#8DC63F]/20 focus:border-[#8DC63F] transition-all">
                            </div>
                            <div class="mb-8">
                                <textarea wire:model="pesan" rows="4" placeholder="Tuliskan pesan atau doa disini (optional)" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg text-slate-800 focus:ring-2 focus:ring-[#8DC63F]/20 focus:border-[#8DC63F] transition-all resize-none"></textarea>
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
                    <span class="text-primary-600 font-black tracking-widest text-xs mb-2 block uppercase">Transparansi</span>
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
    <section class="py-16 px-6 lg:px-12 bg-white relative">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-50 border border-emerald-200/60 text-emerald-700 text-xs font-bold uppercase tracking-wider mb-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Transparansi & Amanah Donasi
                </div>
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-3">Terima Kasih Kepada Para Donatur</h2>
                <p class="text-slate-500 font-medium max-w-2xl mx-auto text-sm sm:text-base">
                    Jazakumullah Khairan Katsiran atas kebaikan Anda. Total terkumpul <strong class="text-primary-600 font-black">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</strong> dari <strong class="text-slate-700">{{ $totalDonaturCount }} Orang Baik</strong> untuk operasional ambulans siaga gratis.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($donaturList as $index => $d)
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
                        $theme = $colors[$index % count($colors)];
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
                @empty
                    <div class="col-span-full text-center py-8 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                        <p class="text-slate-500 font-semibold text-sm">Belum ada data donasi tercatat. Jadilah donatur pertama hari ini!</p>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-8">
                <button wire:click="toggleAllDonaturModal" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-slate-100 hover:bg-primary-50 text-slate-700 hover:text-primary-700 font-bold text-sm transition-all duration-200 border border-slate-200">
                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Lihat Semua Donatur ({{ $totalDonaturCount }})
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

    <!-- SECTION VIDEO DOKUMENTASI & TESTIMONI NYATA PASIEN -->
    <section class="py-20 px-6 lg:px-12 bg-gradient-to-b from-slate-900 to-slate-950 text-white relative overflow-hidden">
        <!-- Background Ambient Glow -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-primary-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-yellow-300 text-xs font-bold uppercase tracking-wider mb-3">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                    Dokumentasi Video Lapangan
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight mb-4">
                    Suara Hati & Umpan Balik Pasien Terbantu
                </h2>
                <p class="text-slate-300 text-sm sm:text-base font-normal leading-relaxed">
                    Setiap rupiah donasi Anda menjadi bahan bakar dan perawatan armada untuk menjemput harapan mereka yang sedang berjuang di saat kritis.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <!-- Video Player Container -->
                <div class="lg:col-span-8">
                    <div class="relative bg-slate-800/80 rounded-[2.5rem] p-3 sm:p-4 border border-white/15 shadow-2xl overflow-hidden group">
                        <div class="relative aspect-video rounded-[2rem] overflow-hidden bg-black flex items-center justify-center">
                            @if($activeVideo === 1)
                                <video controls class="w-full h-full object-contain" poster="{{ asset('images/dokumgsc (27).JPG') }}">
                                    <source src="{{ asset('images/videogsc (1).mp4') }}" type="video/mp4">
                                    Browser Anda tidak mendukung pemutar video HTML5.
                                </video>
                            @else
                                <video controls class="w-full h-full object-contain" poster="{{ asset('images/dokumgsc (28).JPG') }}">
                                    <source src="{{ asset('images/videogsc (2).mp4') }}" type="video/mp4">
                                    Browser Anda tidak mendukung pemutar video HTML5.
                                </video>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Video Playlist & Highlights -->
                <div class="lg:col-span-4 space-y-4">
                    <h3 class="text-lg font-bold text-slate-200 mb-2">Pilih Video Testimoni:</h3>
                    
                    <!-- Video Card 1 -->
                    <button wire:click="setVideo(1)" class="w-full text-left p-4 rounded-2xl transition-all duration-300 flex items-start gap-4 border {{ $activeVideo === 1 ? 'bg-white/15 border-primary-400 shadow-lg ring-2 ring-primary-400/40' : 'bg-white/5 border-white/10 hover:bg-white/10' }}">
                        <div class="w-12 h-12 rounded-xl bg-primary-600/30 border border-primary-400/30 flex items-center justify-center shrink-0 mt-0.5 text-primary-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-extrabold uppercase bg-yellow-400/20 text-yellow-300 mb-1">Video 1</span>
                            <h4 class="font-bold text-white text-sm leading-snug">Respon Cepat Evakuasi Medis Pasien</h4>
                            <p class="text-xs text-slate-400 mt-1 line-clamp-2">Ungkapan rasa syukur keluarga pasien saat diantar ke fasilitas kesehatan secara gratis.</p>
                        </div>
                    </button>

                    <!-- Video Card 2 -->
                    <button wire:click="setVideo(2)" class="w-full text-left p-4 rounded-2xl transition-all duration-300 flex items-start gap-4 border {{ $activeVideo === 2 ? 'bg-white/15 border-primary-400 shadow-lg ring-2 ring-primary-400/40' : 'bg-white/5 border-white/10 hover:bg-white/10' }}">
                        <div class="w-12 h-12 rounded-xl bg-sky-600/30 border border-sky-400/30 flex items-center justify-center shrink-0 mt-0.5 text-sky-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-extrabold uppercase bg-sky-400/20 text-sky-300 mb-1">Video 2</span>
                            <h4 class="font-bold text-white text-sm leading-snug">Pelayanan Ramah & Siaga 24 Jam</h4>
                            <p class="text-xs text-slate-400 mt-1 line-clamp-2">Testimoni warga dan kerabat atas dedikasi supir serta relawan ambulans di lapangan.</p>
                        </div>
                    </button>

                    <!-- Call to Action Box inside Video Section -->
                    <div class="pt-4">
                        <div class="p-5 rounded-2xl bg-gradient-to-r from-primary-900/60 to-slate-800/80 border border-primary-500/30">
                            <p class="text-xs text-slate-300 mb-3 font-medium">Bantu operasional armada tetap bergerak melayani pasien dhuafa setiap hari.</p>
                            <button onclick="document.getElementById('form-donasi').scrollIntoView({behavior: 'smooth'})" class="w-full py-3 rounded-xl bg-yellow-400 hover:bg-yellow-300 text-slate-900 font-extrabold text-sm transition shadow-lg flex items-center justify-center gap-2">
                                Salurkan Donasi Sekarang
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials & Interactive Feedback Section -->
    <section class="py-20 px-6 lg:px-12 bg-slate-50 border-t border-slate-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-800 text-xs font-bold uppercase tracking-wider mb-3">
                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    Rating Kepuasan {{ $averageRating }} / 5.0 ({{ $totalRatingCount }} Ulasan)
                </div>
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-3">Apa Kata Mereka?</h2>
                <p class="text-slate-500 font-medium text-sm sm:text-base">Pengalaman nyata masyarakat, keluarga pasien, dan donatur terhadap layanan Ambulans Siaga.</p>
            </div>
            
            <!-- Cards Grid: Dynamic Testimonials -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
                @forelse($testimoniList as $t)
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-200/80 hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <div class="flex text-yellow-400 mb-4 items-center gap-1">
                            @for($s = 1; $s <= ($t->skor ?: 5); $s++)
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6 font-medium">"{!! e($t->ulasan) !!}"</p>
                    </div>
                    <div class="pt-4 border-t border-slate-100">
                        <p class="font-extrabold text-slate-800 text-sm">- {{ $t->nama_tampil }}</p>
                        <p class="text-xs text-primary-600 font-semibold mt-0.5">{{ $t->peran_tampil }}</p>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-8 bg-white rounded-2xl border border-slate-200">
                    <p class="text-slate-500 font-semibold text-sm">Belum ada ulasan tersimpan. Tulis pesan umpan balik pertama Anda di bawah ini!</p>
                </div>
                @endforelse
            </div>

            <!-- Interaktif: Form Kirim Pesan Kebaikan & Umpan Balik Layanan -->
            <div class="max-w-3xl mx-auto bg-white rounded-[2.5rem] p-8 sm:p-10 shadow-xl border border-slate-200/80 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-600/5 rounded-bl-full pointer-events-none"></div>

                <div class="text-center mb-8">
                    <span class="text-primary-600 font-extrabold text-xs uppercase tracking-wider block mb-1">Umpan Balik Publik</span>
                    <h3 class="text-2xl font-black text-slate-800">Kirimkan Doa, Pesan Kebaikan, atau Ulasan Layanan</h3>
                    <p class="text-slate-500 text-xs sm:text-sm mt-1">Pesan Anda akan tampil di halaman ini dan memberikan semangat bagi para pejuang kemanusiaan.</p>
                </div>

                @if($feedbackSuccessMessage)
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-bold flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    {{ $feedbackSuccessMessage }}
                </div>
                @endif

                <form wire:submit.prevent="kirimUmpanBalik" class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap / Inisial <span class="text-red-500">*</span></label>
                            <input type="text" wire:model="feedbackNama" placeholder="Contoh: Bapak Hendra / Hamba Allah" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 text-sm transition">
                            @error('feedbackNama') <span class="text-xs text-red-500 font-semibold">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Status / Peran</label>
                            <select wire:model="feedbackPeran" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 text-sm transition bg-white">
                                <option value="Donatur">Donatur</option>
                                <option value="Keluarga Pasien">Keluarga Pasien</option>
                                <option value="Relawan Medis">Relawan Medis</option>
                                <option value="Masyarakat Umum">Masyarakat Umum</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Kota / Domisili</label>
                            <input type="text" wire:model="feedbackLokasi" placeholder="Contoh: Cilacap, Jawa Tengah" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 text-sm transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Rating Kepuasan</label>
                            <select wire:model="feedbackSkor" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 text-sm transition bg-white">
                                <option value="5">⭐⭐⭐⭐⭐ (5/5 - Sangat Puas / Luar Biasa)</option>
                                <option value="4">⭐⭐⭐⭐ (4/5 - Puas)</option>
                                <option value="3">⭐⭐⭐ (3/5 - Cukup)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Pesan Testimoni / Doa Kebaikan <span class="text-red-500">*</span></label>
                        <textarea wire:model="feedbackPesan" rows="3" placeholder="Tuliskan apresiasi, pengalaman layanan ambulans, atau doa untuk para relawan..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 text-sm transition"></textarea>
                        @error('feedbackPesan') <span class="text-xs text-red-500 font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <div class="text-center pt-2">
                        <button type="submit" class="inline-flex items-center gap-2 bg-primary-600 text-white px-8 py-3.5 rounded-full font-bold text-sm hover:bg-primary-700 transition shadow-lg hover:shadow-primary-600/30">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            Kirim Ulasan & Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Redesign (Gallery) -->
    <section class="relative py-24 px-6 lg:px-12 bg-white overflow-hidden">
        
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
            activeImage: 0,
            images: [
                {
                    src: '{{ asset('images/dokumgsc (27).JPG') }}',
                    thumb: '{{ asset('images/dokumgsc (27).JPG') }}',
                    title: 'Armada & Driver Siaga 24 Jam',
                    desc: 'Ambulans Siaga selalu siap siaga 24 jam untuk melayani masyarakat yang membutuhkan evakuasi medis darurat.'
                },
                {
                    src: '{{ asset('images/dokumgsc (7).JPG') }}',
                    thumb: '{{ asset('images/dokumgsc (7).JPG') }}',
                    title: 'Tim Tanggap Darurat Medis & Relawan',
                    desc: 'Didukung oleh tenaga lapangan dan relawan yang terlatih dan berdedikasi dalam penanganan darurat serta bencana.'
                },
                {
                    src: '{{ asset('images/dokumgsc (21).JPG') }}',
                    thumb: '{{ asset('images/dokumgsc (21).JPG') }}',
                    title: 'Peduli Pasien & Masyarakat Dhuafa',
                    desc: 'Pelayanan kemanusiaan yang tulus menyentuh langsung masyarakat prasejahtera yang membutuhkan bantuan medis.'
                },
                {
                    src: '{{ asset('images/dokumgsc (3).JPG') }}',
                    thumb: '{{ asset('images/dokumgsc (3).JPG') }}',
                    title: 'Bantuan Logistik Darurat & Air Bersih',
                    desc: 'Aksi tanggap darurat menjangkau wilayah krisis dengan penyaluran air bersih dan logistik kesehatan terpadu.'
                },
                {
                    src: '{{ asset('images/dokumgsc (24).JPG') }}',
                    thumb: '{{ asset('images/dokumgsc (24).JPG') }}',
                    title: 'Dedikasi Relawan Kemanusiaan',
                    desc: 'Para relawan bekerja dengan penuh kepedulian, menyalurkan amanah langsung kepada penerima manfaat secara tepat sasaran.'
                }
            ]
        }">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-center">
                
                <!-- Left Column (Text & CTA) -->
                <div class="w-full lg:w-[40%] flex flex-col justify-center text-center lg:text-left">
                    <h2 class="text-3xl md:text-4xl lg:text-[2.5rem] font-black text-slate-800 leading-[1.3] mb-8">
                        Satu aksi kebaikan Anda hari ini, bisa jadi adalah jawaban atas doa mereka yang sedang dalam kesulitan darurat medis.
                    </h2>
                    <div class="w-20 h-1.5 bg-primary-600 rounded-full mb-10 mx-auto lg:mx-0"></div>
                    <div class="flex justify-center lg:justify-start">
                        <button onclick="document.getElementById('form-donasi').scrollIntoView({behavior: 'smooth'})" class="bg-primary-600 text-white px-10 py-5 rounded-full font-bold text-lg hover:bg-primary-700 transition-all duration-300 shadow-[0_10px_25px_rgba(0,156,166,0.3)] hover:shadow-[0_15px_35px_rgba(0,156,166,0.4)] hover:-translate-y-1.5 flex items-center gap-3 w-fit group">
                            Donasi Sekarang
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Right Column (Interactive Gallery) -->
                <div class="w-full lg:w-[60%]">
                    <div class="bg-white/80 backdrop-blur-sm rounded-[2rem] p-5 sm:p-7 shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-white/50">
                        
                        <!-- Main Image Container -->
                        <div class="relative w-full aspect-video rounded-[1.5rem] overflow-hidden mb-6 bg-slate-100 shadow-inner group">
                            <template x-for="(image, index) in images" :key="index">
                                <img x-show="activeImage === index" 
                                     x-transition:enter="transition ease-out duration-500" 
                                     x-transition:enter-start="opacity-0 scale-[1.05]" 
                                     x-transition:enter-end="opacity-100 scale-100" 
                                     :src="image.src" 
                                     :alt="image.title"
                                     class="absolute inset-0 w-full h-full object-cover" x-cloak>
                            </template>
                        </div>

                        <!-- Caption -->
                        <div class="mb-6 px-2 min-h-[4.5rem]">
                            <h3 class="text-xl font-bold text-slate-800 mb-2" x-text="images[activeImage].title"></h3>
                            <p class="text-slate-500 leading-relaxed text-sm" x-text="images[activeImage].desc"></p>
                        </div>

                        <!-- Thumbnails -->
                        <div class="flex gap-4 overflow-x-auto pb-6 pt-4 px-2 custom-scrollbar snap-x">
                            <template x-for="(image, index) in images" :key="index">
                                <div @click="activeImage = index" 
                                     class="relative w-20 md:w-28 aspect-video rounded-xl overflow-hidden cursor-pointer shrink-0 snap-center border-[3px] transition-all duration-300 group/thumb hover:-translate-y-2 hover:scale-[1.06] hover:shadow-[0_12px_25px_rgba(0,0,0,0.15)]"
                                     :class="activeImage === index ? 'border-primary-600 shadow-[0_8px_20px_rgba(0,156,166,0.3)] scale-[1.05] z-10' : 'border-transparent opacity-75 hover:opacity-100 hover:border-primary-600/30'">
                                    
                                    <img :src="image.thumb" :alt="image.title" class="w-full h-full object-cover transition-transform duration-500" :class="activeImage === index ? 'scale-110' : 'group-hover/thumb:scale-110'">
                                    
                                    <!-- Hover Overlay -->
                                    <div class="absolute inset-0 bg-primary-600/50 opacity-0 group-hover/thumb:opacity-100 transition-opacity duration-300 flex items-center justify-center overflow-hidden backdrop-blur-[2px]">
                                        <!-- Plus Icon (Animated from bottom) -->
                                        <div class="flex items-center justify-center transform translate-y-12 group-hover/thumb:translate-y-0 transition-transform duration-500 ease-out">
                                            <div class="bg-white p-2 rounded-full shadow-lg">
                                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Active State Inner Gradient -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-primary-600/40 to-transparent opacity-0 transition-opacity duration-300 pointer-events-none" :class="activeImage === index ? 'opacity-100' : ''"></div>
                                </div>
                            </template>
                        </div>

                    </div>
                </div>

            </div>
        </div>
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
