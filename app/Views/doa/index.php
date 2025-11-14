<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-hands-praying"></i> Doa & Dzikir Harian</h3>
            </div>
            <div class="card-body">
                <!-- Search Box -->
                <form action="<?= base_url('/doa') ?>" method="get" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari doa..." value="<?= esc($keyword ?? '') ?>">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <?php if (!empty($doa_list)): ?>
                        <?php foreach ($doa_list as $doa): ?>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= esc($doa['doa'] ?? 'Doa') ?></h5>
                                        <a href="<?= base_url('/doa/' . ($doa['id'] ?? '')) ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-book-open"></i> Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> Tidak ada doa yang ditemukan.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
