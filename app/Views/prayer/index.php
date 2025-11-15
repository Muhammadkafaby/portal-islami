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
                    <div class="alert alert-info mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt fa-lg mr-2"></i>
                            <strong class="mr-2">Lokasi:</strong>
                            <span><?= esc($city) ?>, <?= esc($country) ?></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-calendar fa-lg mr-2"></i>
                            <strong class="mr-2">Tanggal:</strong>
                            <span><?= isset($prayer_data['date']['readable']) ? esc($prayer_data['date']['readable']) : date('d F Y') ?></span>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover modern-table">
                            <thead class="thead-light">
                                <tr>
                                    <th width="50%" class="border-0"><i class="fas fa-mosque mr-2"></i>Waktu Shalat</th>
                                    <th class="border-0"><i class="fas fa-clock mr-2"></i>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $timings = $prayer_data['timings'] ?? [];
                                $prayers = [
                                    'Fajr' => ['Subuh', 'fa-cloud-sun'],
                                    'Dhuhr' => ['Dzuhur', 'fa-sun'],
                                    'Asr' => ['Ashar', 'fa-cloud-sun'],
                                    'Maghrib' => ['Maghrib', 'fa-sunset'],
                                    'Isha' => ['Isya', 'fa-moon'],
                                ];
                                ?>
                                <?php foreach ($prayers as $key => $data): ?>
                                    <tr class="prayer-row">
                                        <td>
                                            <i class="fas <?= $data[1] ?> text-primary mr-2"></i>
                                            <strong><?= $data[0] ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary px-3 py-2">
                                                <?= isset($timings[$key]) ? esc(substr($timings[$key], 0, 5)) : '-' ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
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
