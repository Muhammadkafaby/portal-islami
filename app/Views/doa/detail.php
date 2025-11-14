<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-hands-praying"></i> <?= esc($doa['doa'] ?? 'Detail Doa') ?></h3>
                <div class="card-tools">
                    <a href="<?= base_url('/doa') ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h5>Arab</h5>
                    <div class="verse-text p-3 bg-light rounded">
                        <?= esc($doa['ayat'] ?? '') ?>
                    </div>
                </div>

                <div class="mb-4">
                    <h5>Latin</h5>
                    <p class="p-3 bg-light rounded">
                        <em><?= esc($doa['latin'] ?? '') ?></em>
                    </p>
                </div>

                <div class="mb-4">
                    <h5>Artinya</h5>
                    <p class="p-3 bg-light rounded">
                        <?= esc($doa['artinya'] ?? '') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
