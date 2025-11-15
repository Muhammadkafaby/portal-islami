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
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 shadow-sm hover-card">
                                    <div class="card-body d-flex flex-column">
                                        <div class="mb-3">
                                            <span class="badge badge-primary mb-2">
                                                <i class="fas fa-scroll mr-1"></i>
                                                <?= esc(ucfirst($hadith['name'] ?? $current_book)) ?> #<?= esc($hadith['number'] ?? '') ?>
                                            </span>
                                        </div>
                                        <div class="verse-text mb-3" style="font-size: 1.3rem; line-height: 2; direction: rtl;">
                                            <?= esc(substr($hadith['arab'] ?? '', 0, 150)) ?><?= (mb_strlen($hadith['arab'] ?? '') > 150) ? '...' : '' ?>
                                        </div>
                                        <?php if (!empty($hadith['id'])): ?>
                                            <div class="text-muted mb-3" style="font-size: 0.9rem;">
                                                <?= esc(substr($hadith['id'] ?? '', 0, 100)) ?><?= (mb_strlen($hadith['id'] ?? '') > 100) ? '...' : '' ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="mt-auto">
                                            <a href="<?= base_url('/hadith/' . $current_book . '/' . ($hadith['number'] ?? '')) ?>"
                                               class="btn btn-primary btn-sm btn-block">
                                                <i class="fas fa-book-open"></i> Baca Selengkapnya
                                            </a>
                                        </div>
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
                    <div class="alert alert-info">
                        <i class="fas fa-exclamation-triangle"></i> Tidak dapat memuat hadits. Silakan coba lagi.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
