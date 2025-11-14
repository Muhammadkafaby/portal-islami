<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-graduation-cap"></i> Quiz Al-Quran</h3>
            </div>
            <form action="<?= base_url('/quiz/submit') ?>" method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <?php if (!empty($questions)): ?>
                        <?php foreach ($questions as $index => $question): ?>
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Pertanyaan <?= $index + 1 ?></h5>
                                </div>
                                <div class="card-body">
                                    <p><strong><?= esc($question['question']) ?></strong></p>

                                    <?php if (!empty($question['verse_text'])): ?>
                                        <div class="verse-text mb-3 p-3 bg-light rounded">
                                            <?= esc($question['verse_text']) ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <?php foreach ($question['options'] as $optIndex => $option): ?>
                                            <div class="custom-control custom-radio mb-2">
                                                <input type="radio"
                                                       id="q<?= $index ?>_opt<?= $optIndex ?>"
                                                       name="answers[<?= $index ?>]"
                                                       value="<?= esc($option) ?>"
                                                       class="custom-control-input"
                                                       required>
                                                <label class="custom-control-label" for="q<?= $index ?>_opt<?= $optIndex ?>">
                                                    <?= esc($option) ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Tidak dapat memuat pertanyaan quiz. Silakan coba lagi.
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-check"></i> Submit Jawaban
                    </button>
                    <a href="<?= base_url('/quiz') ?>" class="btn btn-secondary btn-lg">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
