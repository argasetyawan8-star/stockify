<footer class="mt-auto border-t border-slate-200 bg-white">

    <div class="px-6 py-5">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

            {{-- Left --}}
            <div>

                <h3 class="text-sm font-semibold text-slate-800">
                    Stockify Inventory System
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Sistem manajemen inventaris untuk mengelola produk, stok, supplier, dan laporan secara efisien.
                </p>

            </div>

            {{-- Right --}}
            <div class="text-left md:text-right">

                <p class="text-sm text-slate-600">
                    Developed by
                    <span class="font-semibold text-slate-800">
                        Arga Setyawan
                    </span>
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Version 1.0.0
                </p>

            </div>

        </div>

        {{-- Bottom --}}
        <div class="mt-5 border-t border-slate-200 pt-4">

            <div class="flex flex-col items-center justify-between gap-3 md:flex-row">

                <p class="text-xs text-slate-500">
                    © {{ date('Y') }} Stockify Inventory System. All rights reserved.
                </p>

                <div class="flex items-center gap-5 text-slate-400">

                    <span class="flex items-center gap-1">
                        <i class="bi bi-box-seam"></i>
                        Inventory
                    </span>

                    <span class="flex items-center gap-1">
                        <i class="bi bi-shield-check"></i>
                        Secure
                    </span>

                    <span class="flex items-center gap-1">
                        <i class="bi bi-code-slash"></i>
                        Laravel 10
                    </span>

                </div>

            </div>

        </div>

    </div>

</footer>