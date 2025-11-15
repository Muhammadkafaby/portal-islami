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
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="card h-100 shadow-sm hover-card">
                                    <div class="card-body d-flex flex-column">
                                        <div class="mb-3">
                                            <span class="badge badge-primary mb-2">
                                                <i class="fas fa-hands-praying"></i> Doa
                                            </span>
                                            <h5 class="card-title font-weight-bold mb-0">
                                                <?= esc($doa['doa'] ?? 'Doa') ?>
                                            </h5>
                                        </div>
                                        <div class="mt-auto">
                                            <a href="<?= base_url('/doa/' . ($doa['id'] ?? '')) ?>" class="btn btn-primary btn-sm btn-block">
                                                <i class="fas fa-book-open"></i> Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-info">
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
