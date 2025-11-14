<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book-open"></i> Kisah Islami</h3>
            </div>
            <div class="card-body">
                <!-- Category Filter -->
                <div class="mb-3">
                    <strong>Kategori:</strong>
                    <div class="btn-group" role="group">
                        <a href="<?= base_url('/kisah') ?>"
                           class="btn btn-<?= empty($current_category) ? 'primary' : 'outline-primary' ?>">
                            Semua
                        </a>
                        <a href="<?= base_url('/kisah?category=Nabi') ?>"
                           class="btn btn-<?= ($current_category === 'Nabi') ? 'primary' : 'outline-primary' ?>">
                            Nabi
                        </a>
                        <a href="<?= base_url('/kisah?category=Sahabat') ?>"
                           class="btn btn-<?= ($current_category === 'Sahabat') ? 'primary' : 'outline-primary' ?>">
                            Sahabat
                        </a>
                    </div>
                </div>

                <div class="row">
                    <?php if (!empty($stories)): ?>
                        <?php foreach ($stories as $story): ?>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <span class="badge badge-info mb-2"><?= esc($story['category']) ?></span>
                                        <h5 class="card-title"><?= esc($story['title']) ?></h5>
                                        <p class="card-text text-muted"><?= esc($story['excerpt']) ?></p>
                                        <a href="<?= base_url('/kisah/' . $story['id']) ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-book-open"></i> Baca Kisah
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> Tidak ada kisah yang ditemukan.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
