<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-book-quran"></i>
                    Surah <?= esc($surah['nama_latin']) ?> - <?= esc($surah['arti']) ?>
                </h3>
                <div class="card-tools">
                    <a href="<?= base_url('/quran') ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="verse-text" style="font-size: 1.5rem;"><?= esc($surah['nama']) ?></strong><br>
                            <small>
                                Tempat Turun: <?= esc($surah['tempat_turun'] ?? 'Mekah') ?> |
                                Jumlah Ayat: <?= esc($surah['jumlah_ayat']) ?>
                            </small>
                        </div>
                        <div>
                            <span class="badge badge-primary" style="font-size: 1rem;">
                                Surah ke-<?= esc($surah['nomor']) ?>
                            </span>
                        </div>
                    </div>
                </div>

                <?php if (!empty($surah['ayat'])): ?>
                    <?php foreach ($surah['ayat'] as $ayat): ?>
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <div class="mb-3">
                                    <span class="badge badge-primary" style="font-size: 0.9rem;">
                                        Ayat <?= esc($ayat['nomor']) ?>
                                    </span>
                                </div>
                                <div class="verse-text mb-3" style="font-size: 1.8rem; line-height: 2.5; text-align: right; direction: rtl;">
                                    <?= esc($ayat['ar']) ?>
                                </div>
                                <?php if (!empty($ayat['tr'])): ?>
                                    <div class="transliteration-text mb-2">
                                        <p class="text-info mb-1" style="font-style: italic; font-size: 1rem;">
                                            <?= esc($ayat['tr']) ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($ayat['idn'])): ?>
                                    <div class="translation-text">
                                        <p class="text-muted mb-0">
                                            <strong>Terjemah:</strong> <?= esc($ayat['idn']) ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Ayat tidak dapat dimuat. Data akan tersedia ketika API online atau dapat diakses.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->section('styles') ?>
<style>
    .verse-text {
        font-family: 'Amiri', 'Arial', serif;
    }

    .card.shadow-sm:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        transition: box-shadow 0.3s ease;
    }
</style>
<?= $this->endSection() ?>

<?= $this->endSection() ?>
