<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-scroll"></i> Koleksi Hadits</h3>
            </div>
            <div class="card-body">
                <!-- Book Selection -->
                <div class="mb-3">
                    <strong>Pilih Kitab:</strong>
                    <div class="btn-group" role="group">
                        <?php
                        $bookNames = [
                            'bukhari' => 'Bukhari',
                            'muslim' => 'Muslim',
                            'abu-dawud' => 'Abu Dawud',
                            'tirmidzi' => 'Tirmidzi',
                        ];
                        ?>
                        <?php foreach ($bookNames as $id => $name): ?>
                            <a href="<?= base_url('/hadith?book=' . $id) ?>"
                               class="btn btn-<?= ($current_book === $id) ? 'primary' : 'outline-primary' ?>">
                                <?= $name ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Hadith List -->
                <?php if (!empty($hadith_data['hadiths'])): ?>
                    <div class="row">
                        <?php foreach ($hadith_data['hadiths'] as $hadith): ?>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge badge-primary">
                                                <?= esc(ucfirst($hadith['name'] ?? $current_book)) ?> #<?= esc($hadith['number'] ?? '') ?>
                                            </span>
                                        </div>
                                        <p class="card-text">
                                            <?= esc(substr($hadith['arab'] ?? '', 0, 150)) ?>...
                                        </p>
                                        <a href="<?= base_url('/hadith/' . $current_book . '/' . ($hadith['number'] ?? '')) ?>"
                                           class="btn btn-primary btn-sm">
                                            <i class="fas fa-book-open"></i> Baca Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <?php if (isset($hadith_data['pagination'])): ?>
                        <div class="mt-3">
                            <nav>
                                <ul class="pagination">
                                    <?php if ($current_page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?= base_url('/hadith?book=' . $current_book . '&page=' . ($current_page - 1)) ?>">
                                                Previous
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (isset($hadith_data['pagination']['next'])): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?= base_url('/hadith?book=' . $current_book . '&page=' . ($current_page + 1)) ?>">
                                                Next
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Tidak dapat memuat hadits. Silakan coba lagi.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
