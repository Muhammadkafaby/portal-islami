<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book-open"></i> <?= esc($story['title']) ?></h3>
                <div class="card-tools">
                    <a href="<?= base_url('/kisah') ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <span class="badge badge-info"><?= esc($story['category']) ?></span>
                </div>

                <div class="story-content" style="line-height: 1.8; text-align: justify;">
                    <?= nl2br(esc($story['content'])) ?>
                </div>

                <?php if (!empty($story['lessons'])): ?>
                    <div class="mt-4">
                        <h5><i class="fas fa-lightbulb"></i> Hikmah & Pelajaran:</h5>
                        <ul class="list-group">
                            <?php foreach ($story['lessons'] as $lesson): ?>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success"></i> <?= esc($lesson) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
