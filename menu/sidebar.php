<ul class="navbar-nav bg-gradient-info bg-opacity-10 sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../dashboard/index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-seedling"></i>
                </div>
                <div class="sidebar-brand-text mx-4">Si Caca</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if ($pages == 'lapor') {
                echo 'active';
            } ?>">
                <a class="nav-link" href="../dashboard/lapor.php">
                    <i class="fas fa-edit"></i>
                    <span>Lapor Cacah</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if ($pages == 'dashboard') {
                echo "active";
            } ?>">
                <a class="nav-link" href="../dashboard/index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
             <!-- Nav Item - Kegiatan -->
             <li class="nav-item <?php if ($pages == 'kegiatan') {
                echo 'active';
            } ?>">
                <a class="nav-link" href="../dashboard/kegiatan.php">
                    <i class="fas fa-list-alt"></i>
                    <span>Kegiatan</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            </ul>
        <!-- End of Sidebar -->