<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-scroll"></i>
                    Hadits <?= esc(ucfirst($book_id)) ?> #<?= esc($hadith['number'] ?? '') ?>
                </h3>
                <div class="card-tools">
                    <a href="<?= base_url('/hadith?book=' . $book_id) ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h5>Teks Arab</h5>
                    <div class="verse-text p-3 bg-light rounded">
                        <?= esc($hadith['arab'] ?? '') ?>
                    </div>
                </div>

                <div class="mb-4">
                    <h5>Terjemahan Indonesia</h5>
                    <p class="p-3 bg-light rounded">
                        <?= esc($hadith['id'] ?? '') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
