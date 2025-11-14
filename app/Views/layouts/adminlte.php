<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Portal Islami') ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <style>
        .brand-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .islamic-card {
            border-top: 3px solid #667eea;
        }
        .verse-text {
            font-family: 'Amiri', 'Traditional Arabic', serif;
            font-size: 1.5rem;
            line-height: 2.5rem;
            text-align: right;
            direction: rtl;
        }
    </style>

    <?= $this->renderSection('styles') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= base_url('/') ?>" class="nav-link">Beranda</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <?php if (session()->get('isLoggedIn')): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                        <span class="d-none d-sm-inline-block ml-1"><?= esc(session()->get('name')) ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="<?= base_url('/habit') ?>" class="dropdown-item">
                            <i class="fas fa-tasks mr-2"></i> My Habits
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('/auth/logout') ?>" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a href="<?= base_url('/auth/login') ?>" class="nav-link">
                        <i class="fas fa-sign-in-alt"></i>
                        <span class="d-none d-sm-inline-block ml-1">Login</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?= base_url('/') ?>" class="brand-link text-center">
            <span class="brand-text font-weight-light"><i class="fas fa-moon"></i> Portal Islami</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="<?= base_url('/') ?>" class="nav-link <?= uri_string() === '' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Beranda</p>
                        </a>
                    </li>
                    <li class="nav-header">IBADAH</li>
                    <li class="nav-item">
                        <a href="<?= base_url('/quran') ?>" class="nav-link <?= str_starts_with(uri_string(), 'quran') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-book-quran"></i>
                            <p>Al-Quran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/shalat') ?>" class="nav-link <?= str_starts_with(uri_string(), 'shalat') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-mosque"></i>
                            <p>Jadwal Shalat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/doa') ?>" class="nav-link <?= str_starts_with(uri_string(), 'doa') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-hands-praying"></i>
                            <p>Doa & Dzikir</p>
                        </a>
                    </li>
                    <li class="nav-header">PEMBELAJARAN</li>
                    <li class="nav-item">
                        <a href="<?= base_url('/quiz') ?>" class="nav-link <?= str_starts_with(uri_string(), 'quiz') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>Quiz Al-Quran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/hadith') ?>" class="nav-link <?= str_starts_with(uri_string(), 'hadith') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-scroll"></i>
                            <p>Hadits</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/kisah') ?>" class="nav-link <?= str_starts_with(uri_string(), 'kisah') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>Kisah Islami</p>
                        </a>
                    </li>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <li class="nav-header">PERSONAL</li>
                        <li class="nav-item">
                            <a href="<?= base_url('/habit') ?>" class="nav-link <?= str_starts_with(uri_string(), 'habit') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>Habit Tracker</p>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>&copy; <?= date('Y') ?> <a href="<?= base_url('/') ?>">Portal Islami</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<?= $this->renderSection('scripts') ?>

</body>
</html>
