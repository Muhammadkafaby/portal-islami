<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-trophy"></i> Hasil Quiz</h3>
            </div>
            <div class="card-body text-center">
                <div class="mb-4">
                    <?php
                    $scoreClass = 'success';
                    if ($score < 60) $scoreClass = 'danger';
                    elseif ($score < 80) $scoreClass = 'warning';
                    ?>
                    <h1 class="display-1 text-<?= $scoreClass ?>">
                        <?= number_format($score, 0) ?>
                    </h1>
                    <h4>Skor Anda</h4>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="fas fa-question"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Soal</span>
                                <span class="info-box-number"><?= $total_questions ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="fas fa-check"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Benar</span>
                                <span class="info-box-number"><?= $correct_answers ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-danger">
                            <span class="info-box-icon"><i class="fas fa-times"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Salah</span>
                                <span class="info-box-number"><?= $total_questions - $correct_answers ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="<?= base_url('/quiz/start') ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-redo"></i> Quiz Lagi
                    </a>
                    <a href="<?= base_url('/quiz') ?>" class="btn btn-secondary btn-lg">
                        <i class="fas fa-home"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Review Answers -->
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list"></i> Review Jawaban</h3>
            </div>
            <div class="card-body">
                <?php foreach ($questions as $index => $question): ?>
                    <?php
                    $userAnswer = $answers[$index] ?? null;
                    $isCorrect = $userAnswer === $question['correct_answer'];
                    ?>
                    <div class="card mb-3 border-<?= $isCorrect ? 'success' : 'danger' ?>">
                        <div class="card-header bg-<?= $isCorrect ? 'success' : 'danger' ?> text-white">
                            <strong>Pertanyaan <?= $index + 1 ?></strong>
                            <?= $isCorrect ? '<i class="fas fa-check float-right"></i>' : '<i class="fas fa-times float-right"></i>' ?>
                        </div>
                        <div class="card-body">
                            <p><strong><?= esc($question['question']) ?></strong></p>
                            <?php if (!empty($question['verse_text'])): ?>
                                <div class="verse-text mb-2 p-2 bg-light rounded">
                                    <?= esc($question['verse_text']) ?>
                                </div>
                            <?php endif; ?>
                            <p><strong>Jawaban Anda:</strong> <span class="text-<?= $isCorrect ? 'success' : 'danger' ?>"><?= esc($userAnswer) ?></span></p>
                            <?php if (!$isCorrect): ?>
                                <p><strong>Jawaban Benar:</strong> <span class="text-success"><?= esc($question['correct_answer']) ?></span></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
