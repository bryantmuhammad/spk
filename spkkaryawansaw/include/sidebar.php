 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         <i class="fa fa-envelope" style="margin-left:10px;margin-right:-20px;"></i>
         <span class="brand-text font-weight-light ml-5">SPK Karyawan</span>
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
                 <a href=""><?= $namaPengguna ?></a>
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

                 <?php if ($role == 1) : ?>
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-copy"></i>
                             <p>
                                 Data Master
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="index.php?page=kri" class="nav-link kri tkri">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Kriteria</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="index.php?page=sub" class="nav-link sub tsub">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Sub Kriteria</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="index.php?page=spv" class="nav-link spv tambahspv">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>SPV</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="index.php?page=karyawan" class="nav-link karyawan tambahkaryawan lihatabsensi">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Karyawan</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="index.php?page=pemilik" class="nav-link pemilik">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Pemilik</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="index.php?page=nilai" class="nav-link nilai tambahnilai">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Nilai</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-copy"></i>
                             <p>
                                 Perhitungan
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="index.php?page=perhitungan" class="nav-link perhitungan">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>
                                         Perhitungan Nilai
                                     </p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="index.php?page=hasilakhir" class="nav-link hasilakhir">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>
                                         Hasil Akhir
                                     </p>
                                 </a>
                             </li>
                         </ul>
                     </li>


                 <?php endif; ?>

                 <?php if ($role == 2) : ?>
                     <li class="nav-item">
                         <a href="index.php?page=hasil" class="nav-link hasil">
                             <i class="nav-icon fas fa-user"></i>
                             <p>
                                 Karyawan Terbaik
                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <?php
                            $nip = ambilData("SELECT nip FROM karyawan WHERE id_karyawan = {$_SESSION['login']['id']}")[0]['nip'];
                            ?>
                         <a href="index.php?page=lihatabsensi&id=<?= $nip ?>" class="nav-link lihatabsensi">
                             <i class="fas fa-calendar nav-icon"></i>
                             <p>Absensi</p>
                         </a>
                     </li>
                 <?php endif; ?>


                 <?php if ($role == 3) : ?>
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-copy"></i>
                             <p>
                                 Laporan
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="index.php?page=kri" class="nav-link kri tkri">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Laporan Kriteria</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="index.php?page=sub" class="nav-link sub tsub">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Laporan Sub Kriteria</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="index.php?page=spv" class="nav-link spv tambahspv">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Laporan SPV</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="index.php?page=karyawan" class="nav-link karyawan tambahkaryawan lihatabsensi">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Laporan Karyawan</p>
                                 </a>
                             </li>

                             <li class="nav-item">
                                 <a href="index.php?page=perhitungan" class="nav-link perhitungan">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>
                                         Laporan Perhitungan Nilai
                                     </p>
                                 </a>
                             </li>

                         </ul>
                     </li>
                 <?php endif; ?>

             </ul>
         </nav>

     </div>

 </aside>