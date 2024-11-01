<!-- sidebar.php -->
<section>
<div class="sidebar">
    <div class="logo_details">
        <i class="bx bxl_audible icon"></i>
        <div class="logo_name">NazahPhone</div>
        <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul class="nav-list">
        <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
        <li class="menu-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
            <a href="index.php">
                <i class="bx bx-home"></i>
                <span class="link_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li class="menu-item <?php echo ($current_page == 'pengguna.php') ? 'active' : ''; ?>">
            <a href="pengguna.php">
                <i class="bx bx-user"></i>
                <span class="link_name">Pengguna</span>
            </a>
            <span class="tooltip">Pengguna</span>
        </li>
        <li class="menu-item <?php echo ($current_page == 'produk.php') ? 'active' : ''; ?>">
            <a href="produk.php">
                <i class="bx bx-package"></i>
                <span class="link_name">Produk</span>
            </a>
            <span class="tooltip">Produk</span>
        </li>
        <li class="menu-item <?php echo ($current_page == 'transaksi.php') ? 'active' : ''; ?>">
            <a href="transaksi.php">
                <i class="bx bx-cart"></i>
                <span class="link_name">Transaksi</span>
            </a>
            <span class="tooltip">Transaksi</span>
        </li>
        <li class="menu-item <?php echo ($current_page == 'laporan.php') ? 'active' : ''; ?>">
            <a href="laporan.php">
                <i class="bx bx-clipboard"></i>
                <span class="link_name">Laporan</span>
            </a>
            <span class="tooltip">Laporan</span>
        </li>
        <li class="profile">
            <a href="logout.php">
                <i class="bx bx-log-out"></i>
                <span class="link_name">Keluar</span>
            </a>
        </li>
    </ul>
</div>
</section>