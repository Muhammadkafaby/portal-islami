<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-graduation-cap"></i> Quiz Al-Quran</h3>
            </div>
            <div class="card-body">
                <h4>Uji Pengetahuan Al-Quran Anda</h4>
                <p>Quiz ini akan menguji pemahaman Anda tentang Al-Quran dengan pertanyaan-pertanyaan yang dihasilkan secara acak dari berbagai surah.</p>

                <div class="alert alert-info">
                    <h5><i class="fas fa-info-circle"></i> Jenis Pertanyaan:</h5>
                    <ul class="mb-0">
                        <li>Tebak nama surah dari ayat yang ditampilkan</li>
                        <li>Tebak terjemahan dari ayat Arab</li>
                    </ul>
                </div>

                <a href="<?= base_url('/quiz/start') ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-play"></i> Mulai Quiz Sekarang
                </a>
            </div>
        </div>
    </div>

    <?php if (session()->get('isLoggedIn')): ?>
    <div class="col-md-4">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar"></i> Statistik Anda</h3>
            </div>
            <div class="card-body">
                <?php if (!empty($stats)): ?>
                    <div class="text-center">
                        <h3 class="text-primary"><?= number_format($stats['average_score'], 1) ?></h3>
                        <p>Rata-rata Skor</p>
                    </div>
                    <hr>
                    <p><strong>Total Quiz:</strong> <?= $stats['total_quizzes'] ?></p>
                    <p><strong>Total Soal:</strong> <?= $stats['total_questions'] ?></p>
                    <p><strong>Jawaban Benar:</strong> <?= $stats['total_correct'] ?></p>
                <?php else: ?>
                    <p class="text-muted">Belum ada riwayat quiz</p>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($history)): ?>
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-history"></i> Riwayat</h3>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php foreach ($history as $item): ?>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <span>Skor: <?= number_format($item['score'], 0) ?></span>
                                <span class="badge badge-primary"><?= $item['correct_answers'] ?>/<?= $item['total_questions'] ?></span>
                            </div>
                            <small class="text-muted"><?= date('d M Y H:i', strtotime($item['created_at'])) ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
