<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <!-- Hero Section -->
        <div class="card islamic-card">
            <div class="card-body text-center py-5">
                <h1 class="mb-3"><i class="fas fa-moon text-primary"></i> Selamat Datang di Portal Islami</h1>
                <p class="lead">Platform lengkap untuk meningkatkan pemahaman dan pengamalan Islam Anda</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Al-Quran -->
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Al-Quran</h3>
                <p>Baca & Pelajari 114 Surah</p>
            </div>
            <div class="icon">
                <i class="fas fa-book-quran"></i>
            </div>
            <a href="<?= base_url('/quran') ?>" class="small-box-footer">
                Buka Al-Quran <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Quiz -->
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Quiz</h3>
                <p>Uji Pengetahuan Al-Quran</p>
            </div>
            <div class="icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <a href="<?= base_url('/quiz') ?>" class="small-box-footer">
                Mulai Quiz <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Doa & Dzikir -->
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>Doa & Dzikir</h3>
                <p>Kumpulan Doa Harian</p>
            </div>
            <div class="icon">
                <i class="fas fa-hands-praying"></i>
            </div>
            <a href="<?= base_url('/doa') ?>" class="small-box-footer">
                Lihat Doa <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Jadwal Shalat -->
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Jadwal Shalat</h3>
                <p>Waktu Shalat & Hijriyah</p>
            </div>
            <div class="icon">
                <i class="fas fa-mosque"></i>
            </div>
            <a href="<?= base_url('/shalat') ?>" class="small-box-footer">
                Cek Jadwal <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Hadits -->
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Hadits</h3>
                <p>Koleksi Hadits Shahih</p>
            </div>
            <div class="icon">
                <i class="fas fa-scroll"></i>
            </div>
            <a href="<?= base_url('/hadith') ?>" class="small-box-footer">
                Baca Hadits <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Kisah -->
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>Kisah Islami</h3>
                <p>Kisah Nabi & Sahabat</p>
            </div>
            <div class="icon">
                <i class="fas fa-book-open"></i>
            </div>
            <a href="<?= base_url('/kisah') ?>" class="small-box-footer">
                Baca Kisah <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<?php if (session()->get('isLoggedIn')): ?>
<div class="row">
    <div class="col-12">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-tasks"></i> Habit Tracker</h3>
            </div>
            <div class="card-body">
                <p>Pantau amalan harian Anda untuk menjadi lebih baik setiap hari.</p>
                <a href="<?= base_url('/habit') ?>" class="btn btn-primary">
                    <i class="fas fa-chart-line"></i> Lihat Habit Tracker
                </a>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="row">
    <div class="col-12">
        <div class="card islamic-card">
            <div class="card-body text-center">
                <h4>Belum punya akun?</h4>
                <p>Daftar sekarang untuk mengakses fitur Habit Tracker dan Quiz!</p>
                <a href="<?= base_url('/auth/register') ?>" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </a>
                <a href="<?= base_url('/auth/login') ?>" class="btn btn-outline-primary">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>
