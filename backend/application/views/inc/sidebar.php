
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url() . 'admin' ?>">
        <div class="sidebar-brand-text mx-3">Admin</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url() . 'admin' ?>">
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Nav Item - Portfolio -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url() . 'admin/portfolio' ?>">
            <span>Portfolio</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

        <!-- Nav Item - Logout -->
        <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url() . 'admin/logout' ?>">
            <span>Logout</span>
        </a>
    </li>
</ul>
<!-- End of Sidebar -->