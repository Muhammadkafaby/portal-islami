<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-book-quran"></i>
                    Surah <?= esc($surah['name_simple']) ?> - <?= esc($surah['translated_name']['name'] ?? '') ?>
                </h3>
                <div class="card-tools">
                    <a href="<?= base_url('/quran') ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <strong><?= esc($surah['name_arabic']) ?></strong><br>
                    <small>
                        <?= esc($surah['revelation_place']) ?> |
                        <?= esc($surah['verses_count']) ?> Ayat
                    </small>
                </div>

                <?php if (!empty($verses)): ?>
                    <?php foreach ($verses as $verse): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-2">
                                    <span class="badge badge-primary"><?= esc($verse['verse_key']) ?></span>
                                </div>
                                <div class="verse-text mb-3">
                                    <?= esc($verse['text_uthmani'] ?? $verse['text_indopak'] ?? '') ?>
                                </div>
                                <?php if (!empty($verse['translations'])): ?>
                                    <div class="translation-text">
                                        <p class="text-muted mb-0">
                                            <em><?= esc($verse['translations'][0]['text']) ?></em>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Ayat tidak dapat dimuat.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
