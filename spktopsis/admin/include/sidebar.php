<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.php">40% Coffee SPK</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.php">40%</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="index"><a class="nav-link" href="index.php"><i class="far fa-square"></i> <span>Dashboard</span></a></li>
            <?php if ($role !== 3) : ?>
                <li class="menu-header">Data Master</li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Menu</span></a>
                    <ul class="dropdown-menu">
                        <?php if ($role == 2) : ?>
                            <li class="kriteria tambahkriteria"><a class="nav-link" href="index.php?page=kriteria">Kriteria</a></li>
                            <li class="subkriteria tambahsubkriteria"><a class="nav-link" href="index.php?page=subkriteria">Sub Kriteria</a></li>
                            <li class="nilai tambahnilai"><a class="nav-link" href="index.php?page=nilai">Nilai</a></li>
                        <?php endif; ?>
                        <li class="produk tambahproduk"><a class="nav-link" href="index.php?page=produk">Produk</a></li>
                        <li class="admin tambahadmin"><a class="nav-link" href="index.php?page=admin">Admin</a></li>
                        <li class="customer tambahcustomer"><a class="nav-link" href="index.php?page=customer">Customer</a></li>

                    </ul>
                </li>

            <?php endif; ?>

            <?php if ($role == 3) : ?>
                <li class="menu-header">Pencarian Menu</li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Pencarian Menu</span></a>
                    <ul class="dropdown-menu">
                        <li class="menu tambahmenu"><a class="nav-link" href="index.php?page=menu">Pencarian Menu</a></li>

                    </ul>
                </li>
            <?php endif; ?>
            <li class="menu-header">Laporan</li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <?php if ($role !== 3) : ?>
                        <li class="laporankriteria"><a class="nav-link" href="index.php?page=laporankriteria">Laporan Kriteria</a></li>
                        <li class="laporansubkriteria"><a class="nav-link" href="index.php?page=laporansubkriteria">Laporan Sub Kriteria</a></li>
                        <li class="laporanproduk"><a class="nav-link" href="index.php?page=laporanproduk">Laporan Produk</a></li>

                    <?php endif; ?>
                    <li class="laporanpencarian"><a class="nav-link" href="index.php?page=laporanpencarian">Laporan Pencarian</a></li>


                </ul>
            </li>

        </ul>


    </aside>
</div>