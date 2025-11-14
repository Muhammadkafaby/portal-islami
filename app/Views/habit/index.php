<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-tasks"></i> Tracker Amalan Harian</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <strong>Tanggal Hari Ini:</strong> <?= date('d F Y', strtotime($today)) ?>
                </div>

                <?php if (!empty($habits)): ?>
                    <div class="row">
                        <?php foreach ($habits as $habit): ?>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="mb-1">
                                                    <?php if (!empty($habit['icon'])): ?>
                                                        <i class="fas fa-<?= esc($habit['icon']) ?>"></i>
                                                    <?php endif; ?>
                                                    <?= esc($habit['name']) ?>
                                                </h5>
                                                <?php if (!empty($habit['description'])): ?>
                                                    <small class="text-muted"><?= esc($habit['description']) ?></small>
                                                <?php endif; ?>

                                                <?php if (!empty($habit['stats'])): ?>
                                                    <div class="mt-2">
                                                        <small class="text-muted">
                                                            30 Hari Terakhir:
                                                            <?= $habit['stats']['completed_count'] ?? 0 ?> kali
                                                        </small>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <div class="custom-control custom-switch custom-switch-lg">
                                                    <input type="checkbox"
                                                           class="custom-control-input habit-toggle"
                                                           id="habit_<?= $habit['id'] ?>"
                                                           data-habit-id="<?= $habit['id'] ?>"
                                                           data-date="<?= $today ?>"
                                                           <?= $habit['status'] == 1 ? 'checked' : '' ?>>
                                                    <label class="custom-control-label" for="habit_<?= $habit['id'] ?>"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Belum ada habit yang tersedia.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $('.habit-toggle').on('change', function() {
        var habitId = $(this).data('habit-id');
        var date = $(this).data('date');
        var status = $(this).is(':checked') ? 1 : 0;
        var checkbox = $(this);

        $.ajax({
            url: '<?= base_url('/habit/log') ?>',
            method: 'POST',
            data: {
                habit_id: habitId,
                date: date,
                status: status,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Optional: Show success message
                    console.log('Habit updated successfully');
                } else {
                    // Revert checkbox on error
                    checkbox.prop('checked', !status);
                    alert('Gagal mengupdate habit: ' + response.message);
                }
            },
            error: function() {
                // Revert checkbox on error
                checkbox.prop('checked', !status);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
