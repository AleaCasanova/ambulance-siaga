<!-- Footer -->
<footer class="text-slate-300 pt-20 pb-10 px-6 lg:px-12 border-t border-white/10 relative overflow-hidden" style="background: linear-gradient(to bottom, #005A60, #002b2e);">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-primary-600/10 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-sky-900/10 rounded-full blur-3xl -ml-20 -mb-20 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 mb-16 relative z-10">
        <!-- Brand & About -->
        <div class="lg:col-span-5 pr-0 lg:pr-12">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-14 h-14 bg-white rounded-full p-1 flex items-center justify-center shadow-lg shadow-white/5 overflow-hidden">
                    <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <span class="text-white font-black text-2xl tracking-tight block leading-none">{{ \App\Models\SettingAplikasi::getVal('nama_organisasi', 'Ambulance Siaga') }}</span>
                    <span class="text-primary-600 text-xs font-bold tracking-widest uppercase mt-1 block">Siaga Darurat Medis</span>
                </div>
            </div>
            <p class="leading-relaxed mb-8 text-sm md:text-base font-medium text-sky-100/70">
                Platform layanan antar jemput pasien dan penanganan gawat darurat medis berbasis relawan dan donasi umat di wilayah Kabupaten Cilacap. Kami siap siaga 24 jam untuk melayani umat dengan profesional dan sepenuh hati.
            </p>
            
            <!-- Social Media -->
            <div class="flex items-center gap-4">
                <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary-600 hover:text-white hover:-translate-y-1 transition-all duration-300 shadow-lg group">
                    <svg class="w-4 h-4 text-sky-200/50 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary-600 hover:text-white hover:-translate-y-1 transition-all duration-300 shadow-lg group">
                    <svg class="w-4 h-4 text-sky-200/50 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary-600 hover:text-white hover:-translate-y-1 transition-all duration-300 shadow-lg group">
                    <svg class="w-4 h-4 text-sky-200/50 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                </a>
            </div>
        </div>

        <!-- Links -->
        <div class="lg:col-span-3">
            <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-sm flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-primary-600"></span> Menu Navigasi
            </h4>
            @php
                $user = auth()->user();
                $footerLinks = [];
                
                if (!$user) {
                    // Guest (Belum Login)
                    $footerLinks = [
                        ['url' => route('home'), 'label' => 'Beranda'],
                        ['url' => route('masyarakat.info'), 'label' => 'Tentang Kami'],
                        ['url' => route('masyarakat.order.create'), 'label' => 'Layanan Kami'],
                    ];
                } elseif ($user->hasRole('masyarakat') || !$user->role_id) {
                    // Masyarakat (Sudah Login)
                    $footerLinks = [
                        ['url' => route('home'), 'label' => 'Beranda'],
                        ['url' => route('masyarakat.order.create'), 'label' => 'Pesan Ambulance'],
                        ['url' => route('masyarakat.orders.index'), 'label' => 'Riwayat & Tracking'],
                        ['url' => route('masyarakat.info'), 'label' => 'Tentang Kami'],
                    ];
                } elseif ($user->isSupir()) {
                    $footerLinks = [
                        ['url' => route('supir.dashboard'), 'label' => 'Dashboard Supir'],
                        ['url' => route('supir.tugas.index'), 'label' => 'Pesanan Saya'],
                        ['url' => route('masyarakat.info'), 'label' => 'Tentang Kami'],
                    ];
                } elseif ($user->isOperator()) {
                    $footerLinks = [
                        ['url' => route('operator.dashboard'), 'label' => 'Dashboard Operator'],
                        ['url' => route('operator.orders.index'), 'label' => 'Permintaan Ambulance'],
                        ['url' => route('operator.monitoring'), 'label' => 'Tracking Aktif'],
                        ['url' => route('masyarakat.info'), 'label' => 'Tentang Kami'],
                    ];
                } elseif ($user->isAdmin()) {
                    $footerLinks = [
                        ['url' => route('admin.dashboard'), 'label' => 'Dashboard Admin'],
                        ['url' => route('admin.orders.index'), 'label' => 'Semua Order'],
                        ['url' => route('admin.users.index'), 'label' => 'Kelola Pengguna'],
                        ['url' => route('admin.laporan.index'), 'label' => 'Laporan Sistem'],
                    ];
                }
            @endphp
            <ul class="space-y-4 font-medium text-sm">
                @foreach($footerLinks as $link)
                <li><a href="{{ $link['url'] }}" class="flex items-center gap-2 text-sky-100/70 hover:text-white transition-all hover:translate-x-1 group"><svg class="w-4 h-4 text-sky-200/40 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg> {{ $link['label'] }}</a></li>
                @endforeach
            </ul>
        </div>

        <!-- Contact Info -->
        <div class="lg:col-span-4">
            <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-sm flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-red-500"></span> Pusat Bantuan
            </h4>
            <div class="space-y-5">
                <!-- Location -->
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center shrink-0 border border-white/10">
                        <svg class="w-5 h-5 text-[#4ddae3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <span class="block text-white font-bold text-sm mb-1">Sekretariat Pusat</span>
                        <span class="text-sm font-medium leading-relaxed text-sky-100/70">{{ \App\Models\SettingAplikasi::getVal('alamat_kantor', 'Jl. Kemanusiaan No. 99, Kabupaten Cilacap, Jawa Tengah') }}</span>
                    </div>
                </div>
                
                <!-- Phone -->
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center shrink-0 border border-white/10">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <div>
                        <span class="block text-white font-bold text-sm mb-1">Hotline Darurat (24 Jam)</span>
                        <span class="text-lg font-black text-white tracking-wider">{{ \App\Models\SettingAplikasi::getVal('telepon_darurat', '0812-3456-7890') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between pt-8 border-t border-white/10 font-medium text-xs md:text-sm relative z-10 gap-4">
        <p class="text-sky-100/50">&copy; {{ date('Y') }} {{ \App\Models\SettingAplikasi::getVal('nama_organisasi', 'LAZ Gerak Sedekah Cilacap') }}. Seluruh hak cipta dilindungi.</p>
        <div class="flex items-center gap-6 text-sky-100/50">
            <a href="javascript:void(0)" class="hover:text-white transition-colors">Kebijakan Privasi</a>
            <a href="javascript:void(0)" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
        </div>
    </div>
</footer>
