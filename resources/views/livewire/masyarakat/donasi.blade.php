<div>


    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-600 to-primary-700 pt-40 pb-20 px-6 lg:px-12 overflow-hidden">
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
                    <button onclick="document.getElementById('form-donasi').scrollIntoView({behavior: 'smooth'})" class="bg-white text-primary-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-slate-50 transition-all shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:scale-105 flex items-center gap-2">
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
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary-600/5 rounded-bl-full -z-0"></div>
                    
                    <h2 class="text-3xl font-black text-slate-800 mb-2 relative z-10">Mulai Berdonasi</h2>
                    <p class="text-slate-500 mb-8 font-medium relative z-10">Pilih nominal atau masukkan nominal donasi terbaik Anda.</p>

                    <form class="relative z-10">
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

                        <!-- Payment Method Modal Button -->
                        <div x-data="{ openMetode: false }" class="mb-8">
                            <button @click="openMetode = true" type="button" class="w-full flex items-center justify-between p-4 bg-sky-50/50 border border-sky-100 rounded-xl hover:bg-sky-50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="bg-white p-2 rounded-lg shadow-sm border border-slate-100">
                                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                    </div>
                                    <span class="text-sm font-medium text-slate-700">
                                        @if($metodePembayaran == 'qris') QRIS
                                        @elseif($metodePembayaran == 'gopay') Gopay
                                        @elseif($metodePembayaran == 'shopeepay') ShopeePay
                                        @elseif($metodePembayaran == 'dana') DANA
                                        @elseif($metodePembayaran == 'ovo') OVO
                                        @elseif($metodePembayaran == 'bni') VA Bank BNI
                                        @elseif($metodePembayaran == 'cimb') VA Bank CIMB Niaga
                                        @elseif($metodePembayaran == 'bsi') Transfer Bank Syariah Indonesia
                                        @elseif($metodePembayaran == 'bca') Transfer Bank BCA
                                        @elseif($metodePembayaran == 'mandiri') Transfer Bank Mandiri
                                        @elseif($metodePembayaran == 'bri') Transfer Bank BRI
                                        @else Metode Pembayaran @endif
                                    </span>
                                </div>
                                <div class="bg-white px-3 py-1.5 rounded-md border border-slate-200 text-xs font-medium text-slate-600 flex items-center gap-1 shadow-sm">
                                    Pilih <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </button>

                            <!-- Modal Metode Pembayaran -->
                            <div x-show="openMetode" x-cloak class="fixed inset-0 z-50 flex items-end justify-center sm:items-center">
                                <div x-show="openMetode" x-transition.opacity class="fixed inset-0 bg-black/50" @click="openMetode = false"></div>
                                <div x-show="openMetode" 
                                     x-transition:enter="transition ease-out duration-300 transform" 
                                     x-transition:enter-start="translate-y-full sm:translate-y-0 sm:scale-95" 
                                     x-transition:enter-end="translate-y-0 sm:scale-100" 
                                     x-transition:leave="transition ease-in duration-200 transform" 
                                     x-transition:leave-start="translate-y-0 sm:scale-100" 
                                     x-transition:leave-end="translate-y-full sm:translate-y-0 sm:scale-95" 
                                     class="relative bg-white w-full max-w-md mx-auto h-[85vh] sm:h-auto sm:max-h-[85vh] rounded-t-3xl sm:rounded-3xl shadow-2xl flex flex-col">
                                    
                                    <!-- Modal Header -->
                                    <div class="bg-[#0092ff] text-white p-4 rounded-t-3xl sm:rounded-t-3xl flex items-center justify-between">
                                        <h3 class="text-lg font-bold w-full text-center">Metode Pembayaran</h3>
                                        <button type="button" @click="openMetode = false" class="absolute right-4 text-white hover:bg-white/20 p-1 rounded-full transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                    
                                    <!-- Modal Body (Scrollable) -->
                                    <div class="overflow-y-auto flex-1 p-0 pb-6 custom-scrollbar">
                                        
                                        <!-- Pembayaran Instan -->
                                        <div class="bg-sky-50/50 py-2.5 px-5 text-[11px] font-bold text-slate-600">Pembayaran Instan</div>
                                        <div class="divide-y divide-slate-100">
                                            <label class="flex items-center gap-5 px-5 py-3 hover:bg-slate-50 cursor-pointer transition-colors" @click="openMetode = false">
                                                <input type="radio" wire:model.live="metodePembayaran" value="qris" class="hidden">
                                                <div class="w-16 font-black italic text-lg text-slate-800">QRIS</div>
                                                <span class="text-sm font-medium text-slate-700">QRIS</span>
                                            </label>
                                            <label class="flex items-center gap-5 px-5 py-3 hover:bg-slate-50 cursor-pointer transition-colors" @click="openMetode = false">
                                                <input type="radio" wire:model.live="metodePembayaran" value="gopay" class="hidden">
                                                <div class="w-16 font-black text-[#00AED6] text-lg tracking-tighter">Gopay</div>
                                                <span class="text-sm font-medium text-slate-700">Gopay</span>
                                            </label>
                                            <label class="flex items-center gap-5 px-5 py-3 hover:bg-slate-50 cursor-pointer transition-colors" @click="openMetode = false">
                                                <input type="radio" wire:model.live="metodePembayaran" value="shopeepay" class="hidden">
                                                <div class="w-16 font-black text-[#EE4D2D] text-sm leading-tight">ShopeePay</div>
                                                <span class="text-sm font-medium text-slate-700">ShopeePay</span>
                                            </label>
                                            <label class="flex items-center gap-5 px-5 py-3 hover:bg-slate-50 cursor-pointer transition-colors" @click="openMetode = false">
                                                <input type="radio" wire:model.live="metodePembayaran" value="dana" class="hidden">
                                                <div class="w-16 font-black text-[#118EEA] text-lg tracking-tight">DANA</div>
                                                <span class="text-sm font-medium text-slate-700">DANA</span>
                                            </label>
                                            <label class="flex items-center gap-5 px-5 py-3 hover:bg-slate-50 cursor-pointer transition-colors" @click="openMetode = false">
                                                <input type="radio" wire:model.live="metodePembayaran" value="ovo" class="hidden">
                                                <div class="w-16 font-black text-[#4C2A86] text-lg tracking-widest">OVO</div>
                                                <span class="text-sm font-medium text-slate-700">OVO</span>
                                            </label>
                                        </div>

                                        <!-- Virtual Account -->
                                        <div class="bg-sky-50/50 py-2.5 px-5 text-[11px] font-bold text-slate-600 mt-2">Virtual Account</div>
                                        <div class="divide-y divide-slate-100">
                                            <label class="flex items-center gap-5 px-5 py-3 hover:bg-slate-50 cursor-pointer transition-colors" @click="openMetode = false">
                                                <input type="radio" wire:model.live="metodePembayaran" value="bni" class="hidden">
                                                <div class="w-16 font-black text-[#006699] text-xl tracking-tight">BNI</div>
                                                <span class="text-sm font-medium text-slate-700">VA Bank BNI</span>
                                            </label>
                                            <label class="flex items-center gap-5 px-5 py-3 hover:bg-slate-50 cursor-pointer transition-colors" @click="openMetode = false">
                                                <input type="radio" wire:model.live="metodePembayaran" value="cimb" class="hidden">
                                                <div class="w-16 font-black text-[#E4002B] text-xs leading-none">CIMB NIAGA</div>
                                                <span class="text-sm font-medium text-slate-700">VA Bank CIMB Niaga</span>
                                            </label>
                                        </div>

                                        <!-- Transfer Bank -->
                                        <div class="bg-sky-50/50 py-2.5 px-5 text-[11px] font-bold text-slate-600 mt-2">Transfer Bank</div>
                                        <div class="divide-y divide-slate-100">
                                            <label class="flex items-center gap-5 px-5 py-3 hover:bg-slate-50 cursor-pointer transition-colors" @click="openMetode = false">
                                                <input type="radio" wire:model.live="metodePembayaran" value="bsi" class="hidden">
                                                <div class="w-16 font-black text-[#00A39D] text-xl tracking-tight italic">BSI</div>
                                                <span class="text-sm font-medium text-slate-700">Transfer Bank Syariah Indonesia</span>
                                            </label>
                                            <label class="flex items-center gap-5 px-5 py-3 hover:bg-slate-50 cursor-pointer transition-colors" @click="openMetode = false">
                                                <input type="radio" wire:model.live="metodePembayaran" value="bca" class="hidden">
                                                <div class="w-16 font-black text-[#003399] text-xl tracking-tight italic">BCA</div>
                                                <span class="text-sm font-medium text-slate-700">Transfer Bank BCA</span>
                                            </label>
                                            <label class="flex items-center gap-5 px-5 py-3 hover:bg-slate-50 cursor-pointer transition-colors" @click="openMetode = false">
                                                <input type="radio" wire:model.live="metodePembayaran" value="mandiri" class="hidden">
                                                <div class="w-16 font-black text-[#003D79] text-lg tracking-tight italic">mandiri</div>
                                                <span class="text-sm font-medium text-slate-700">Transfer Bank Mandiri</span>
                                            </label>
                                            <label class="flex items-center gap-5 px-5 py-3 hover:bg-slate-50 cursor-pointer transition-colors" @click="openMetode = false">
                                                <input type="radio" wire:model.live="metodePembayaran" value="bri" class="hidden">
                                                <div class="w-16 font-black text-[#00529C] text-lg tracking-tight italic">BRI</div>
                                                <span class="text-sm font-medium text-slate-700">Transfer Bank BRI</span>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
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
                    <p class="text-sm font-bold text-primary-600 mb-2">Berdonasi Rp 50.000</p>
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
                    <p class="text-sm font-bold text-primary-600 mb-2">Berdonasi Rp 100.000</p>
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
                    <p class="text-sm font-bold text-primary-600 mb-2">Berdonasi Rp 25.000</p>
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
                    <p class="text-sm font-bold text-primary-600 mb-2">Berdonasi Rp 200.000</p>
                    <p class="text-xs text-slate-500 italic">"Sehat selalu untuk para relawan"</p>
                </div>
            </div>
            
            <div class="text-center mt-8">
                <button class="text-slate-500 font-bold text-sm hover:text-primary-600 transition">Lihat Donatur Lainnya</button>
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
                    src: 'https://images.unsplash.com/photo-1587559070757-f72a388edbba?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                    thumb: 'https://images.unsplash.com/photo-1587559070757-f72a388edbba?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80',
                    title: 'Armada Siaga 24 Jam',
                    desc: 'Ambulance Siaga selalu siap siaga 24 jam untuk melayani masyarakat yang membutuhkan evakuasi medis darurat.'
                },
                {
                    src: 'https://images.unsplash.com/photo-1576091160550-2173ff9e5ee5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                    thumb: 'https://images.unsplash.com/photo-1576091160550-2173ff9e5ee5?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80',
                    title: 'Tim Medis Profesional',
                    desc: 'Didukung oleh tenaga medis yang terlatih dan berpengalaman dalam menangani berbagai situasi kegawatdaruratan.'
                },
                {
                    src: 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                    thumb: 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80',
                    title: 'Penanganan Pasien Terpadu',
                    desc: 'Pelayanan yang mengutamakan keselamatan dan kenyamanan pasien selama perjalanan menuju fasilitas kesehatan.'
                },
                {
                    src: 'https://images.unsplash.com/photo-1516549655169-df83a0774514?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                    thumb: 'https://images.unsplash.com/photo-1516549655169-df83a0774514?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80',
                    title: 'Fasilitas Medis Lengkap',
                    desc: 'Interior ambulance dilengkapi dengan peralatan medis berstandar untuk memantau dan menstabilkan kondisi pasien.'
                },
                {
                    src: 'https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                    thumb: 'https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80',
                    title: 'Dedikasi Relawan Kemanusiaan',
                    desc: 'Para relawan bekerja tanpa pamrih, menyalurkan amanah donatur langsung kepada masyarakat prasejahtera.'
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
</div>
