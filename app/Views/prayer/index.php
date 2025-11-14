<?= $this->extend('layouts/adminlte') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-mosque"></i> Jadwal Shalat</h3>
            </div>
            <div class="card-body">
                <?php if (!empty($prayer_data)): ?>
                    <div class="alert alert-info">
                        <strong><i class="fas fa-map-marker-alt"></i> Lokasi:</strong> <?= esc($city) ?>, <?= esc($country) ?><br>
                        <strong><i class="fas fa-calendar"></i> Tanggal:</strong>
                        <?= isset($prayer_data['date']['readable']) ? esc($prayer_data['date']['readable']) : date('d F Y') ?>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="50%">Waktu Shalat</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $timings = $prayer_data['timings'] ?? [];
                                $prayers = [
                                    'Fajr' => 'Subuh',
                                    'Dhuhr' => 'Dzuhur',
                                    'Asr' => 'Ashar',
                                    'Maghrib' => 'Maghrib',
                                    'Isha' => 'Isya',
                                ];
                                ?>
                                <?php foreach ($prayers as $key => $name): ?>
                                    <tr>
                                        <td><i class="fas fa-pray"></i> <strong><?= $name ?></strong></td>
                                        <td><?= isset($timings[$key]) ? esc(substr($timings[$key], 0, 5)) : '-' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Tidak dapat memuat jadwal shalat. Silakan coba lagi.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-calendar-alt"></i> Kalender Hijriyah</h3>
            </div>
            <div class="card-body text-center">
                <?php if (!empty($hijri_date)): ?>
                    <h3 class="text-primary">
                        <?= isset($hijri_date['day']) ? esc($hijri_date['day']) : '' ?>
                    </h3>
                    <h5>
                        <?= isset($hijri_date['month']['en']) ? esc($hijri_date['month']['en']) : '' ?>
                        <?= isset($hijri_date['year']) ? esc($hijri_date['year']) : '' ?>
                    </h5>
                    <p class="text-muted">
                        <?= isset($hijri_date['designation']['abbreviated']) ? esc($hijri_date['designation']['abbreviated']) : '' ?>
                    </p>
                <?php else: ?>
                    <p class="text-muted">Tidak dapat memuat tanggal Hijriyah</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="card islamic-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-location-arrow"></i> Ubah Lokasi</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('/shalat') ?>" method="get">
                    <div class="form-group">
                        <label>Kota</label>
                        <input type="text" name="city" class="form-control" value="<?= esc($city) ?>" placeholder="Jakarta">
                    </div>
                    <div class="form-group">
                        <label>Negara</label>
                        <input type="text" name="country" class="form-control" value="<?= esc($country) ?>" placeholder="Indonesia">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
