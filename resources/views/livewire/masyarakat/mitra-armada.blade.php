<div>
    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-6 lg:px-12 bg-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div class="space-y-8">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-[#0F2747] leading-[1.1] tracking-tight">
                    Daftarkan Armada Anda Bersama <span class="text-[#009CA6]">Siaga Ambulans</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-600 font-medium leading-relaxed max-w-lg">
                    Perluas jangkauan layanan ambulans Anda dan bergabung dalam jaringan layanan yang lebih terkoordinasi.
                </p>
                <div class="pt-4 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register.mitra') }}" class="inline-flex items-center justify-center px-8 py-4 bg-[#009CA6] hover:bg-[#007b83] text-white font-extrabold text-base rounded-full transition-all shadow-md hover:shadow-lg w-full sm:w-auto">
                        Daftarkan Armada
                    </a>
                </div>
            </div>
            <div class="relative flex justify-center lg:justify-end group">
                <div class="absolute inset-0 bg-[#009CA6]/5 rounded-3xl transform rotate-3 scale-105 transition-transform group-hover:rotate-1"></div>
                <img src="https://images.unsplash.com/photo-1599839619722-39751411ea63?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Armada Ambulans" class="relative w-full max-w-lg rounded-3xl shadow-xl object-cover h-[400px] lg:h-[500px]">
            </div>
        </div>
    </section>

    <!-- Mengapa Bergabung Section -->
    <section class="py-24 px-6 lg:px-12 bg-slate-50 border-y border-slate-100">
        <div class="max-w-7xl mx-auto">
            <div class="mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-[#0F2747] tracking-tight">
                    Mengapa Menjadi Mitra Armada?
                </h2>
                <div class="w-16 h-1.5 bg-[#009CA6] mt-6 rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-20 gap-y-16">
                <!-- Poin 1 -->
                <div class="flex items-start gap-6 group">
                    <div class="w-14 h-14 shrink-0 bg-white shadow-sm border border-slate-100 text-[#009CA6] rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-[#0F2747] mb-3">Memperluas Jangkauan Layanan</h3>
                        <p class="text-slate-600 font-medium leading-relaxed">
                            Membantu memperluas jangkauan armada ambulans Anda agar dapat diakses oleh lebih banyak masyarakat yang membutuhkan.
                        </p>
                    </div>
                </div>

                <!-- Poin 2 -->
                <div class="flex items-start gap-6 group">
                    <div class="w-14 h-14 shrink-0 bg-white shadow-sm border border-slate-100 text-[#009CA6] rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-[#0F2747] mb-3">Sistem Koordinasi Terstruktur</h3>
                        <p class="text-slate-600 font-medium leading-relaxed">
                            Armada Anda akan terhubung ke sistem terpadu yang mengatur penugasan darurat secara cepat, efisien, dan transparan.
                        </p>
                    </div>
                </div>

                <!-- Poin 3 -->
                <div class="flex items-start gap-6 group">
                    <div class="w-14 h-14 shrink-0 bg-white shadow-sm border border-slate-100 text-[#009CA6] rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-[#0F2747] mb-3">Informasi Permintaan Jelas</h3>
                        <p class="text-slate-600 font-medium leading-relaxed">
                            Dapatkan detail penjemputan, data medis awal, dan panduan fasilitas tujuan secara *real-time* langsung dari aplikasi.
                        </p>
                    </div>
                </div>

                <!-- Poin 4 -->
                <div class="flex items-start gap-6 group">
                    <div class="w-14 h-14 shrink-0 bg-white shadow-sm border border-slate-100 text-[#009CA6] rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-[#0F2747] mb-3">Mendukung Pelayanan Masyarakat</h3>
                        <p class="text-slate-600 font-medium leading-relaxed">
                            Berkontribusi mengoptimalkan alokasi ambulans dan meningkatkan keselamatan pasien melalui sistem yang andal.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pendaftaran Section -->
    <section class="py-24 px-6 lg:px-12 bg-white">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-black text-[#0F2747] tracking-tight mb-20 text-center">
                Alur Menjadi Mitra Armada
            </h2>

            <div class="space-y-0">
                <!-- Step 1 -->
                <div class="flex flex-col md:flex-row gap-6 md:gap-12 relative group">
                    <div class="hidden md:block absolute left-[3.25rem] top-16 bottom-0 w-px bg-slate-100 group-last:hidden"></div>
                    <div class="md:w-32 shrink-0 pt-1">
                        <span class="text-6xl font-black text-slate-100 group-hover:text-slate-200 transition-colors">01</span>
                    </div>
                    <div class="md:w-full pb-14">
                        <h3 class="text-2xl font-bold text-[#0F2747] mb-3">Registrasi</h3>
                        <p class="text-slate-600 font-medium text-lg leading-relaxed">
                            Isi data diri Anda sebagai pengelola beserta informasi dasar lembaga / armada ambulans.
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col md:flex-row gap-6 md:gap-12 relative group">
                    <div class="hidden md:block absolute left-[3.25rem] top-16 bottom-0 w-px bg-slate-100 group-last:hidden"></div>
                    <div class="md:w-32 shrink-0 pt-1">
                        <span class="text-6xl font-black text-slate-100 group-hover:text-slate-200 transition-colors">02</span>
                    </div>
                    <div class="md:w-full pb-14">
                        <h3 class="text-2xl font-bold text-[#0F2747] mb-3">Data Armada</h3>
                        <p class="text-slate-600 font-medium text-lg leading-relaxed">
                            Masukkan kelengkapan dokumen instansi dan operasional kendaraan untuk setiap unit yang Anda daftarkan.
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col md:flex-row gap-6 md:gap-12 relative group">
                    <div class="hidden md:block absolute left-[3.25rem] top-16 bottom-0 w-px bg-slate-100 group-last:hidden"></div>
                    <div class="md:w-32 shrink-0 pt-1">
                        <span class="text-6xl font-black text-slate-100 group-hover:text-slate-200 transition-colors">03</span>
                    </div>
                    <div class="md:w-full pb-14">
                        <h3 class="text-2xl font-bold text-[#0F2747] mb-3">Verifikasi</h3>
                        <p class="text-slate-600 font-medium text-lg leading-relaxed">
                            Tim admin Siaga Ambulans akan melakukan pemeriksaan mendalam terhadap legalitas dan kelengkapan.
                        </p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="flex flex-col md:flex-row gap-6 md:gap-12 relative group">
                    <div class="hidden md:block absolute left-[3.25rem] top-16 bottom-0 w-px bg-slate-100 group-last:hidden"></div>
                    <div class="md:w-32 shrink-0 pt-1">
                        <span class="text-6xl font-black text-slate-100 group-hover:text-slate-200 transition-colors">04</span>
                    </div>
                    <div class="md:w-full pb-14">
                        <h3 class="text-2xl font-bold text-[#0F2747] mb-3">Aktivasi</h3>
                        <p class="text-slate-600 font-medium text-lg leading-relaxed">
                            Jika disetujui, akun pengelola dan status unit armada akan aktif di dalam sistem.
                        </p>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="flex flex-col md:flex-row gap-6 md:gap-12 relative group">
                    <div class="md:w-32 shrink-0 pt-1">
                        <span class="text-6xl font-black text-slate-100 group-hover:text-slate-200 transition-colors">05</span>
                    </div>
                    <div class="md:w-full">
                        <h3 class="text-2xl font-bold text-[#0F2747] mb-3">Mulai Beroperasi</h3>
                        <p class="text-slate-600 font-medium text-lg leading-relaxed">
                            Armada Anda resmi terdaftar dan pengemudi Anda siap menerima pesanan layanan darurat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Data yang Dibutuhkan Section -->
    <section class="py-24 px-6 lg:px-12 bg-slate-50 border-t border-slate-100">
        <div class="max-w-5xl mx-auto">
            <div class="mb-12">
                <h2 class="text-3xl md:text-4xl font-black text-[#0F2747] tracking-tight mb-4">
                    Data dan Dokumen yang Dibutuhkan
                </h2>
                <p class="text-lg text-slate-600 font-medium">
                    Pastikan seluruh dokumen masih berlaku dan dapat diverifikasi.
                </p>
            </div>
            
            <div class="bg-white border border-slate-200 p-8 lg:p-12 rounded-3xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    <!-- Item -->
                    <div class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 shrink-0 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-lg text-[#0F2747] font-bold leading-snug">Identitas pemilik / pengelola armada</span>
                    </div>
                    <!-- Item -->
                    <div class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 shrink-0 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-lg text-[#0F2747] font-bold leading-snug">Data instansi / organisasi / faskes</span>
                    </div>
                    <!-- Item -->
                    <div class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 shrink-0 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-lg text-[#0F2747] font-bold leading-snug">Spesifikasi kendaraan (Jenis, Fasilitas Medis)</span>
                    </div>
                    <!-- Item -->
                    <div class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 shrink-0 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-lg text-[#0F2747] font-bold leading-snug">Kelengkapan kendaraan (STNK / BPKB)</span>
                    </div>
                    <!-- Item -->
                    <div class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 shrink-0 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-lg text-[#0F2747] font-bold leading-snug">Lokasi pool operasional & kontak aktif</span>
                    </div>
                    <!-- Item -->
                    <div class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 shrink-0 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-lg text-[#0F2747] font-bold leading-snug">Dokumen legalitas / izin operasional lainnya</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 px-6 lg:px-12 bg-white text-center border-t border-slate-100">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-black text-[#0F2747] tracking-tight mb-6">
                Siap Bergabung Bersama Siaga Ambulans?
            </h2>
            <p class="text-lg md:text-xl text-slate-600 font-medium mb-10 leading-relaxed">
                Daftarkan armada Anda sekarang dan mari wujudkan pelayanan darurat yang lebih responsif untuk seluruh masyarakat.
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('register.mitra') }}" class="px-8 py-4 bg-[#009CA6] hover:bg-[#007b83] text-white font-extrabold text-base rounded-full transition-all shadow-md hover:shadow-lg w-full sm:w-auto">
                    Daftar Sebagai Mitra
                </a>
                <a href="{{ route('masyarakat.info') }}" class="px-8 py-4 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-[#0F2747] font-extrabold text-base rounded-full transition-all w-full sm:w-auto">
                    Pelajari Sistem Kami &rarr;
                </a>
            </div>
        </div>
    </section>
</div>
