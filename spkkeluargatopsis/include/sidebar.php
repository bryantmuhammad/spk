<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <i class="fa fa-users" style="margin-left:10px;margin-right:-20px;"></i>
        <span class="brand-text font-weight-light ml-5">SPK KELUARGA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="assets/img/user.jpg" class="img-circle elevation-2" alt="User Image" style="margin-top: 5px;">
            </div>
            <div class="info">
                <!-- <a href="#" class="d-block"><?= $_SESSION["login"][1] ?></a> -->
                <a href="">Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index.php" class="nav-link index">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Master
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?page=kriteria" class="nav-link tambahkriteria kriteria">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kriteria</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=subkriteria" class="nav-link tambahsubkriteria subkriteria">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Kriteria</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=keluarga" class="nav-link tambahkeluarga keluarga">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Keluarga</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=nilai" class="nav-link tambahnilai nilai">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nilai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=user" class="nav-link tambahuser user">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Transaksi
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?page=perhitungan" class="nav-link tambahperhitungan perhitungan">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Perhitungan Nilai</p>
                            </a>
                        </li>

                    </ul>
                </li>


            </ul>
        </nav>

    </div>

</aside>