<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('styles') ?>
<style>
    .hero-banner {
        background: linear-gradient(135deg, var(--secondary-green) 0%, var(--primary-green-dark) 100%);
        border-radius: 25px;
        padding: 60px 40px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
        box-shadow: 0 10px 40px rgba(16, 185, 129, 0.3);
    }

    .hero-banner::before {
        content: '☪';
        position: absolute;
        top: -20px;
        right: 5%;
        font-size: 250px;
        opacity: 0.08;
        transform: rotate(15deg);
    }

    .hero-banner::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-banner h1 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .hero-banner p {
        font-size: 1.2rem;
        opacity: 0.95;
        margin-bottom: 25px;
        line-height: 1.8;
    }

    .hero-stats {
        display: flex;
        gap: 40px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .hero-stat-item {
        text-align: center;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 15px 25px;
        border-radius: 15px;
        transition: all 0.3s ease;
    }

    .hero-stat-item:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-5px);
    }

    .hero-stat-item .number {
        font-size: 2.5rem;
        font-weight: 700;
        display: block;
        line-height: 1;
    }

    .hero-stat-item .label {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-top: 5px;
    }

    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        height: 100%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid #e5e7eb;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-green), var(--secondary-green));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .feature-card:hover::before {
        transform: scaleX(1);
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
        border-color: var(--primary-green);
    }

    .feature-icon {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 20px;
        background: linear-gradient(135deg, var(--secondary-green) 0%, var(--primary-green-dark) 100%);
        color: white;
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
    }

    .feature-card h3 {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #1f2937;
    }

    .feature-card p {
        color: #6b7280;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .feature-card .btn {
        width: 100%;
        padding: 12px;
        font-weight: 600;
    }

    .quick-action {
        background: white;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .quick-action:hover {
        border-color: var(--primary-green);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.2);
    }

    .quick-action-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 1.8rem;
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: var(--primary-green);
    }

    .quick-action h4 {
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 25px;
        position: relative;
        padding-left: 20px;
    }

    .section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 30px;
        background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
        border-radius: 3px;
    }

    .stats-mini {
        background: white;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s ease;
        border: 2px solid #e5e7eb;
    }

    .stats-mini:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.1);
        border-color: var(--primary-green);
    }

    .stats-mini .icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
    }

    .stats-mini .number {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2937;
        display: block;
    }

    .stats-mini .label {
        color: #6b7280;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    .cta-card {
        background: linear-gradient(135deg, var(--secondary-green) 0%, var(--primary-green-dark) 100%);
        border: none;
        border-radius: 25px;
        overflow: hidden;
        position: relative;
    }

    .cta-card::before {
        content: '☪';
        position: absolute;
        bottom: -30px;
        right: -20px;
        font-size: 200px;
        opacity: 0.1;
        transform: rotate(-15deg);
    }

    @media (max-width: 768px) {
        .hero-banner {
            padding: 40px 25px;
        }

        .hero-banner h1 {
            font-size: 2rem;
        }

        .hero-stats {
            gap: 15px;
        }

        .hero-stat-item {
            padding: 10px 15px;
        }

        .hero-stat-item .number {
            font-size: 1.8rem;
        }

        .feature-card {
            padding: 20px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.5rem;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Hero Banner -->
<div class="hero-banner animate__animated animate__fadeIn">
    <div class="hero-content">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1><i class="fas fa-moon mr-3"></i>Portal Islami</h1>
                <p class="lead mb-0">Platform digital lengkap untuk meningkatkan pemahaman dan pengamalan Islam Anda. Akses Al-Quran, Hadits, Doa, Quiz, dan tracking ibadah harian.</p>

                <div class="hero-stats">
                    <div class="hero-stat-item animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                        <span class="number">114</span>
                        <span class="label">Surah</span>
                    </div>
                    <div class="hero-stat-item animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                        <span class="number">6,236</span>
                        <span class="label">Ayat</span>
                    </div>
                    <div class="hero-stat-item animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                        <span class="number">1000+</span>
                        <span class="label">Hadits</span>
                    </div>
                    <div class="hero-stat-item animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
                        <span class="number">50+</span>
                        <span class="label">Doa Harian</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block text-center">
                <i class="fas fa-quran" style="font-size: 150px; opacity: 0.2;"></i>
            </div>
        </div>
    </div>
</div>

<!-- Main Features -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="section-title">Fitur Utama</h2>
    </div>
</div>

<div class="row mb-5">
    <!-- Al-Quran -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
            <div class="feature-icon">
                <i class="fas fa-book-quran"></i>
            </div>
            <h3>Al-Quran Digital</h3>
            <p>Baca dan pelajari 114 surah Al-Quran lengkap dengan terjemahan Bahasa Indonesia. Interface yang mudah dan nyaman dibaca.</p>
            <a href="<?= base_url('/quran') ?>" class="btn btn-primary">
                <i class="fas fa-book-open mr-2"></i>Baca Al-Quran
            </a>
        </div>
    </div>

    <!-- Quiz -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
            <div class="feature-icon" style="background: linear-gradient(135deg, #0ba360 0%, #3cba92 100%);">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h3>Quiz Interaktif</h3>
            <p>Uji dan tingkatkan pemahaman Al-Quran Anda dengan quiz interaktif. Lacak progres dan lihat statistik pembelajaran Anda.</p>
            <a href="<?= base_url('/quiz') ?>" class="btn btn-success">
                <i class="fas fa-play mr-2"></i>Mulai Quiz
            </a>
        </div>
    </div>

    <!-- Jadwal Shalat -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
            <div class="feature-icon" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                <i class="fas fa-mosque"></i>
            </div>
            <h3>Jadwal Shalat</h3>
            <p>Lihat jadwal waktu shalat berdasarkan lokasi Anda dan kalender Hijriyah. Tidak akan terlewat waktu shalat lagi.</p>
            <a href="<?= base_url('/shalat') ?>" class="btn btn-info">
                <i class="fas fa-clock mr-2"></i>Lihat Jadwal
            </a>
        </div>
    </div>

    <!-- Doa & Dzikir -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
            <div class="feature-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <i class="fas fa-hands-praying"></i>
            </div>
            <h3>Doa & Dzikir</h3>
            <p>Kumpulan doa dan dzikir harian lengkap dengan teks Arab, latin, dan terjemahan untuk diamalkan sehari-hari.</p>
            <a href="<?= base_url('/doa') ?>" class="btn btn-warning">
                <i class="fas fa-praying-hands mr-2"></i>Lihat Doa
            </a>
        </div>
    </div>

    <!-- Hadits -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.5s">
            <div class="feature-icon" style="background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);">
                <i class="fas fa-scroll"></i>
            </div>
            <h3>Hadits Shahih</h3>
            <p>Koleksi hadits dari Bukhari, Muslim, Tirmidzi, dan lainnya. Pelajari sunnah Rasulullah SAW dengan mudah.</p>
            <a href="<?= base_url('/hadith') ?>" class="btn btn-success">
                <i class="fas fa-book mr-2"></i>Baca Hadits
            </a>
        </div>
    </div>

    <!-- Kisah Islami -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.6s">
            <div class="feature-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <i class="fas fa-book-open"></i>
            </div>
            <h3>Kisah Inspiratif</h3>
            <p>Baca kisah-kisah inspiratif para Nabi dan Sahabat. Ambil pelajaran dan hikmah untuk kehidupan Anda.</p>
            <a href="<?= base_url('/kisah') ?>" class="btn btn-primary">
                <i class="fas fa-bookmark mr-2"></i>Baca Kisah
            </a>
        </div>
    </div>
</div>

<?php if (session()->get('isLoggedIn')): ?>
<!-- Personal Dashboard -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="section-title">Dashboard Personal</h2>
    </div>
</div>

<div class="row mb-5">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-mini animate__animated animate__fadeInUp">
            <div class="icon text-primary">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <span class="number">0</span>
            <div class="label">Quiz Selesai</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-mini animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
            <div class="icon text-success">
                <i class="fas fa-tasks"></i>
            </div>
            <span class="number">0</span>
            <div class="label">Habit Hari Ini</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-mini animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
            <div class="icon text-warning">
                <i class="fas fa-book-quran"></i>
            </div>
            <span class="number">0</span>
            <div class="label">Surah Dibaca</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-mini animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
            <div class="icon text-info">
                <i class="fas fa-chart-line"></i>
            </div>
            <span class="number">0%</span>
            <div class="label">Progress</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-tasks mr-2"></i>Habit Tracker</h3>
                <div class="card-tools">
                    <a href="<?= base_url('/habit') ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body">
                <p class="text-muted">Pantau amalan harian Anda dan tingkatkan konsistensi beribadah.</p>
                <a href="<?= base_url('/habit') ?>" class="btn btn-outline-primary btn-block">
                    <i class="fas fa-plus-circle mr-2"></i>Mulai Tracking Hari Ini
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-graduation-cap mr-2"></i>Quiz Terakhir</h3>
                <div class="card-tools">
                    <a href="<?= base_url('/quiz') ?>" class="btn btn-sm btn-success">Mulai Quiz</a>
                </div>
            </div>
            <div class="card-body">
                <p class="text-muted">Belum ada quiz yang diselesaikan. Mulai quiz pertama Anda sekarang!</p>
                <a href="<?= base_url('/quiz/start') ?>" class="btn btn-outline-success btn-block">
                    <i class="fas fa-play-circle mr-2"></i>Mulai Quiz Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

<?php else: ?>
<!-- Call to Action for Guest -->
<div class="row mb-5">
    <div class="col-12">
        <div class="card cta-card">
            <div class="card-body text-center py-5 text-white position-relative">
                <h2 class="mb-3"><i class="fas fa-user-plus mr-2"></i>Bergabung Sekarang!</h2>
                <p class="lead mb-4">Daftar untuk mengakses fitur lengkap: Quiz, Habit Tracker, dan tracking progress pembelajaran Anda.</p>
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <a href="<?= base_url('/auth/register') ?>" class="btn btn-light btn-lg mr-3 mb-2">
                        <i class="fas fa-user-plus mr-2"></i>Daftar Gratis
                    </a>
                    <a href="<?= base_url('/auth/login') ?>" class="btn btn-outline-light btn-lg mb-2">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="section-title">Akses Cepat</h2>
    </div>
</div>

<div class="row mb-5">
    <div class="col-6 col-md-3 mb-3">
        <a href="<?= base_url('/quran') ?>" class="text-decoration-none">
            <div class="quick-action animate__animated animate__fadeInUp">
                <div class="quick-action-icon">
                    <i class="fas fa-book-quran"></i>
                </div>
                <h4>Baca Quran</h4>
            </div>
        </a>
    </div>

    <div class="col-6 col-md-3 mb-3">
        <a href="<?= base_url('/shalat') ?>" class="text-decoration-none">
            <div class="quick-action animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                <div class="quick-action-icon">
                    <i class="fas fa-mosque"></i>
                </div>
                <h4>Waktu Shalat</h4>
            </div>
        </a>
    </div>

    <div class="col-6 col-md-3 mb-3">
        <a href="<?= base_url('/doa') ?>" class="text-decoration-none">
            <div class="quick-action animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                <div class="quick-action-icon">
                    <i class="fas fa-hands-praying"></i>
                </div>
                <h4>Doa Harian</h4>
            </div>
        </a>
    </div>

    <div class="col-6 col-md-3 mb-3">
        <a href="<?= base_url('/quiz') ?>" class="text-decoration-none">
            <div class="quick-action animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                <div class="quick-action-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h4>Quiz</h4>
            </div>
        </a>
    </div>
</div>

<?= $this->endSection() ?>
