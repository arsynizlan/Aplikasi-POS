<div class="layout-container">
    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
                <span class="app-brand-text menu-text fw-bolder">POS APP</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>


            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">MASTER</span>
            </li>

            <li class="menu-item">
                <a href="{{ route('kategori.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-category-alt'></i>
                    <div data-i18n="Analytics">Kategori</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('produk.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-package'></i>
                    <div data-i18n="Analytics">Produk</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('member.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-user'></i>
                    <div data-i18n="Analytics">Member</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('supplier.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bxs-truck'></i>
                    <div data-i18n="Analytics">Supplier</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">TRANSAKSI</span>
            </li>

            <li class="menu-item">
                <a href="{{ route('pengeluaran.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-money'></i>
                    <div data-i18n="Analytics">Pengeluaran</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('pembelian.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bxs-down-arrow-square'></i>
                    <div data-i18n="Analytics">Pembelian</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('penjualan.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bxs-up-arrow-square'></i>
                    <div data-i18n="Analytics">Penjualan</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('transaksi.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-transfer-alt'></i>
                    <div data-i18n="Analytics">Transaksi Aktif</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('transaksi.baru') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-transfer-alt'></i>
                    <div data-i18n="Analytics">Transaksi Baru</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">REPORT</span>
            </li>

            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class='menu-icon tf-icons bx bxs-file'></i>
                    <div data-i18n="Analytics">Laporan</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">SYSTEM</span>
            </li>

            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class='menu-icon tf-icons bx bxs-cog'></i>
                    <div data-i18n="Analytics">User</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class='menu-icon tf-icons bx bxs-cog'></i>
                    <div data-i18n="Analytics">Pengaturan</div>
                </a>
            </li>



        </ul>
    </aside>
    <!-- / Menu -->
