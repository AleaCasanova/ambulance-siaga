<!-- Footer -->
<footer class="bg-slate-900 text-slate-400 pt-16 pb-8 px-6 border-t border-slate-800">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
        <div class="md:col-span-2">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-white rounded-full p-1.5 flex items-center justify-center">
                    <img src="{{ asset('images/logo_ambulansiaga.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <span class="text-white font-black text-2xl tracking-tight block leading-none">{{ \App\Models\SettingAplikasi::getVal('nama_organisasi', 'Ambulance Siaga') }}</span>
                </div>
            </div>
            <p class="max-w-md leading-relaxed mb-6 font-medium">Platform layanan antar jemput pasien dan penanganan gawat darurat medis berbasis relawan dan donasi umat di Kabupaten Cilacap.</p>
            <div class="flex gap-4">
                <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-[#009CA6] hover:text-white transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-[#009CA6] hover:text-white transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
            </div>
        </div>
        <div>
            <h4 class="text-white font-bold mb-4 uppercase tracking-wider text-sm">Tautan Berguna</h4>
            <ul class="space-y-3 font-medium">
                <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                <li><a href="{{ route('masyarakat.order.create') }}" class="hover:text-white transition">Layanan</a></li>
                <li><a href="{{ route('masyarakat.info') }}" class="hover:text-white transition">Tentang Kami</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-white font-bold mb-4 uppercase tracking-wider text-sm">Hubungi Kami</h4>
            <ul class="space-y-3 font-medium">
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-[#009CA6] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>{{ \App\Models\SettingAplikasi::getVal('alamat_kantor', 'Jl. Kemanusiaan No. 99, Kabupaten Cilacap') }}</span>
                </li>
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-[#009CA6] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    <span>{{ \App\Models\SettingAplikasi::getVal('telepon_darurat', '0812-3456-7890') }}</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="text-center pt-8 border-t border-slate-800 font-medium text-sm">
        <p>&copy; {{ date('Y') }} LAZ Gerak Sedekah Cilacap. All rights reserved.</p>
    </div>
</footer>
