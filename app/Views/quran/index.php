<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book-quran"></i> Daftar Surah Al-Quran</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($surahs)): ?>
                        <?php foreach ($surahs as $surah): ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="mb-1">
                                                    <?= esc($surah['id']) ?>. <?= esc($surah['name_simple']) ?>
                                                </h5>
                                                <small class="text-muted">
                                                    <?= esc($surah['translated_name']['name'] ?? '') ?>
                                                    | <?= esc($surah['verses_count']) ?> Ayat
                                                </small>
                                            </div>
                                            <div class="text-right">
                                                <div class="verse-text" style="font-size: 1.5rem;">
                                                    <?= esc($surah['name_arabic']) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?= base_url('/quran/surah/' . $surah['id']) ?>" class="btn btn-primary btn-sm btn-block mt-2">
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
<?= $this->endSection() ?>
