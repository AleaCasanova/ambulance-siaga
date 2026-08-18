@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col sm:flex-row items-center justify-between gap-4 py-2">
        
        {{-- Mobile Simple Pagination Buttons --}}
        <div class="flex justify-between items-center w-full sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center gap-1 px-3.5 py-2 text-xs font-semibold text-slate-400 bg-slate-100 border border-slate-200 rounded-xl cursor-not-allowed select-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    <span>Sebelumnya</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="inline-flex items-center gap-1 px-3.5 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl shadow-2xs hover:bg-primary-50 hover:text-primary-700 hover:border-primary-300 transition-all">
                    <span>Sebelumnya</span>
                </a>
            @endif

            <div class="text-xs font-semibold text-slate-600">
                Hal <span class="text-primary-700 font-bold">{{ $paginator->currentPage() }}</span> / {{ $paginator->lastPage() }}
            </div>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="inline-flex items-center gap-1 px-3.5 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl shadow-2xs hover:bg-primary-50 hover:text-primary-700 hover:border-primary-300 transition-all">
                    <span>Berikutnya</span>
                    <svg class="w-4 h-4 text-slate-500 group-hover:text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <span class="inline-flex items-center gap-1 px-3.5 py-2 text-xs font-semibold text-slate-400 bg-slate-100 border border-slate-200 rounded-xl cursor-not-allowed select-none">
                    <span>Berikutnya</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>

        {{-- Desktop Full Pagination Bar --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between w-full">
            {{-- Information Counter --}}
            <div>
                <p class="text-xs text-slate-500 font-medium flex items-center gap-1">
                    <span>Menampilkan</span>
                    <span class="font-bold text-slate-800">{{ $paginator->firstItem() ?? 0 }}</span>
                    <span>sampai</span>
                    <span class="font-bold text-slate-800">{{ $paginator->lastItem() ?? 0 }}</span>
                    <span>dari</span>
                    <span class="font-bold text-primary-700 bg-primary-50 px-2 py-0.5 rounded-md border border-primary-200/80">{{ $paginator->total() }}</span>
                    <span>total data</span>
                </p>
            </div>

            {{-- Page Links Group --}}
            <div>
                <span class="inline-flex items-center gap-1 bg-white p-1 rounded-2xl border border-slate-200 shadow-2xs">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}"
                              class="inline-flex items-center justify-center w-8 h-8 rounded-xl text-slate-300 bg-slate-50/50 cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 19l-7-7 7-7"/></svg>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}"
                           rel="prev"
                           aria-label="{{ __('pagination.previous') }}"
                           class="inline-flex items-center justify-center w-8 h-8 rounded-xl text-slate-600 hover:text-primary-700 hover:bg-primary-50 border border-transparent hover:border-primary-200 transition-all"
                           title="Halaman Sebelumnya">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 19l-7-7 7-7"/></svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true" class="inline-flex items-center justify-center w-8 h-8 text-xs font-bold text-slate-400">
                                {{ $element }}
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page"
                                          class="inline-flex items-center justify-center min-w-[32px] h-8 px-2.5 rounded-xl text-xs font-bold bg-primary-600 text-white shadow-xs">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                       class="inline-flex items-center justify-center min-w-[32px] h-8 px-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-primary-700 hover:bg-primary-50 border border-transparent hover:border-primary-200 transition-all">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}"
                           rel="next"
                           aria-label="{{ __('pagination.next') }}"
                           class="inline-flex items-center justify-center w-8 h-8 rounded-xl text-slate-600 hover:text-primary-700 hover:bg-primary-50 border border-transparent hover:border-primary-200 transition-all"
                           title="Halaman Berikutnya">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                              class="inline-flex items-center justify-center w-8 h-8 rounded-xl text-slate-300 bg-slate-50/50 cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    @endif
                </span>
            </div>
        </div>

    </nav>
@endif
