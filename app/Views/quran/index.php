<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book-quran"></i> Daftar Surah Al-Quran</h3>
                <div class="card-tools">
                    <span class="badge badge-primary">114 Surah</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($surahs)): ?>
                        <?php foreach ($surahs as $surah): ?>
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="card h-100 shadow-sm hover-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="badge badge-primary mr-2" style="font-size: 1rem;">
                                                        <?= esc($surah['nomor']) ?>
                                                    </div>
                                                    <h5 class="mb-0 font-weight-bold">
                                                        <?= esc($surah['nama_latin']) ?>
                                                    </h5>
                                                </div>
                                                <small class="text-muted">
                                                    <i class="fas fa-language"></i> <?= esc($surah['arti']) ?>
                                                </small>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fas fa-list-ol"></i> <?= esc($surah['jumlah_ayat']) ?> Ayat
                                                </small>
                                            </div>
                                            <div class="text-right">
                                                <div class="verse-text" style="font-size: 2rem; line-height: 1;">
                                                    <?= esc($surah['nama']) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?= base_url('/quran/surah/' . $surah['nomor']) ?>" class="btn btn-primary btn-sm btn-block">
                                            <i class="fas fa-book-open"></i> Baca Surah
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> Tidak dapat memuat data surah. Silakan coba lagi nanti.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->section('styles') ?>
<style>
    .hover-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        border-color: #667eea;
    }
</style>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
