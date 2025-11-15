<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Portal Islami') ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --info-gradient: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
            --purple-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --green-gradient: linear-gradient(135deg, #0ba360 0%, #3cba92 100%);
            --orange-gradient: linear-gradient(135deg, #f46b45 0%, #eea849 100%);
            --blue-gradient: linear-gradient(135deg, #2196f3 0%, #1e88e5 100%);
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #764ba2;
        }

        /* Navbar Modern */
        .main-header {
            background: white !important;
            border-bottom: none !important;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
        }

        .navbar-light .navbar-nav .nav-link {
            color: #333 !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #667eea !important;
            transform: translateY(-2px);
        }

        /* Sidebar Modern */
        .main-sidebar {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1);
        }

        .brand-link {
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .sidebar {
            padding-top: 10px;
        }

        .nav-sidebar .nav-item .nav-link {
            border-radius: 10px;
            margin: 4px 10px;
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .nav-sidebar .nav-item .nav-link:hover {
            background: rgba(255, 255, 255, 0.15) !important;
            transform: translateX(5px);
        }

        .nav-sidebar .nav-item .nav-link.active {
            background: rgba(255, 255, 255, 0.2) !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .nav-header {
            color: rgba(255, 255, 255, 0.6) !important;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 1px;
            margin-top: 15px;
        }

        /* Content Wrapper Modern */
        .content-wrapper {
            background: transparent !important;
            padding: 20px;
        }

        /* Modern Cards */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
            background: white;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background: transparent !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px 25px;
        }

        .card-body {
            padding: 25px;
        }

        .islamic-card {
            border-top: none !important;
            position: relative;
            overflow: hidden;
        }

        .islamic-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        /* Small Box Modern */
        .small-box {
            border-radius: 20px;
            border: none;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .small-box::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
            transition: all 0.5s ease;
        }

        .small-box:hover::before {
            top: -100%;
            right: -100%;
        }

        .small-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .small-box .icon {
            font-size: 70px;
            opacity: 0.3;
        }

        .small-box-footer {
            background: rgba(0, 0, 0, 0.1) !important;
            color: white !important;
            font-weight: 500;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .small-box-footer:hover {
            background: rgba(0, 0, 0, 0.2) !important;
            padding-left: 20px;
        }

        .bg-info {
            background: var(--blue-gradient) !important;
        }

        .bg-success {
            background: var(--green-gradient) !important;
        }

        .bg-warning {
            background: var(--warning-gradient) !important;
        }

        .bg-danger {
            background: var(--secondary-gradient) !important;
        }

        .bg-primary {
            background: var(--purple-gradient) !important;
        }

        .bg-secondary {
            background: var(--info-gradient) !important;
        }

        /* Verse Text Modern */
        .verse-text {
            font-family: 'Amiri', 'Traditional Arabic', serif;
            font-size: 1.8rem;
            line-height: 3rem;
            text-align: right;
            direction: rtl;
            padding: 25px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 15px;
            border-left: 5px solid #667eea;
        }

        /* Buttons Modern */
        .btn {
            border-radius: 12px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary {
            background: var(--primary-gradient);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        /* Alerts Modern */
        .alert {
            border-radius: 15px;
            border: none;
            padding: 15px 20px;
            animation: slideInDown 0.5s ease;
        }

        /* Badge Modern */
        .badge {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 500;
        }

        /* Footer Modern */
        .main-footer {
            background: white;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 15px;
            box-shadow: 0 -2px 20px rgba(0, 0, 0, 0.05);
        }

        /* Form Modern */
        .form-control {
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        }

        /* Table Modern */
        .table {
            border-radius: 15px;
            overflow: hidden;
        }

        .table thead th {
            background: var(--primary-gradient);
            color: white;
            border: none;
            font-weight: 600;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
        }

        /* Loading Animation */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .loading {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Dropdown Modern */
        .dropdown-menu {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        .dropdown-item {
            border-radius: 10px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateX(5px);
        }

        /* Custom Switch Modern */
        .custom-switch .custom-control-label::before {
            border-radius: 20px;
            background: #e0e0e0;
        }

        .custom-switch .custom-control-input:checked ~ .custom-control-label::before {
            background: var(--primary-gradient);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 10px;
            }

            .card-body {
                padding: 15px;
            }

            .verse-text {
                font-size: 1.4rem;
                line-height: 2.5rem;
                padding: 15px;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in {
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Hero Section */
        .hero-section {
            background: var(--primary-gradient);
            color: white;
            border-radius: 20px;
            padding: 50px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,106.7C1248,96,1344,96,1392,96L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat;
            opacity: 0.3;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .hero-section p {
            font-size: 1.2rem;
            position: relative;
            z-index: 1;
        }
    </style>

    <?= $this->renderSection('styles') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= base_url('/') ?>" class="nav-link">
                    <i class="fas fa-home"></i> Beranda
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <?php if (session()->get('isLoggedIn')): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <div class="d-flex align-items-center">
                            <div class="mr-2 d-none d-sm-block">
                                <strong><?= esc(session()->get('name')) ?></strong><br>
                                <small class="text-muted"><?= esc(session()->get('role')) ?></small>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 40px; height: 40px; background: var(--primary-gradient); color: white; font-weight: bold;">
                                <?= strtoupper(substr(session()->get('name'), 0, 1)) ?>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animate__animated animate__fadeIn animate__faster">
                        <a href="<?= base_url('/habit') ?>" class="dropdown-item">
                            <i class="fas fa-tasks mr-2 text-primary"></i> Habit Tracker
                        </a>
                        <a href="<?= base_url('/quiz') ?>" class="dropdown-item">
                            <i class="fas fa-graduation-cap mr-2 text-success"></i> My Quizzes
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('/auth/logout') ?>" class="dropdown-item text-danger">
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
                <li class="nav-item">
                    <a href="<?= base_url('/auth/register') ?>" class="btn btn-primary btn-sm ml-2">
                        <i class="fas fa-user-plus"></i>
                        <span class="d-none d-sm-inline-block ml-1">Register</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?= base_url('/') ?>" class="brand-link text-center">
            <i class="fas fa-moon mr-2"></i>
            <span class="brand-text">Portal Islami</span>
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
                    <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fas fa-check-circle mr-2"></i>
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeInDown">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fas fa-exclamation-circle mr-2"></i>
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
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0 | <b>Framework</b> CodeIgniter 4.6.3
        </div>
        <strong>&copy; <?= date('Y') ?> <a href="<?= base_url('/') ?>">Portal Islami</a>.</strong>
        Dibuat dengan <i class="fas fa-heart text-danger"></i> untuk umat Islam
    </footer>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script>
// Add fade-in animation to cards on load
$(document).ready(function() {
    $('.card').each(function(index) {
        $(this).css('animation-delay', (index * 0.1) + 's');
        $(this).addClass('animate__animated animate__fadeInUp');
    });

    // Smooth scroll
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        var target = $(this.getAttribute('href'));
        if(target.length) {
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 800);
        }
    });
});
</script>

<?= $this->renderSection('scripts') ?>

</body>
</html>
