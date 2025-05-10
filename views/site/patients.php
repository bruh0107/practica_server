<div class="patients">
    <h2 class="patients-title">Пациенты</h2>
    <div class="patients-list">
        <?php foreach ($patients as $patient): ?>
            <a href="<?= app()->route->getUrl("/patients/" . "$patient->id") ?>" class="patients-card">
                <p class="patients-card-title">Пациент №<?= $patient->id ?></p>
                <div class="patients-card-info">
                    <p>Фамилия: <?= $patient->surname ?></p>
                    <p>Имя: <?= $patient->name ?></p>
                    <?php if (!empty($patient->patronym)): ?>
                        <p>Отчество: <?= $patient->patronym ?></p>
                    <?php endif; ?>
                    <p>Дата рождения: <?= date('d.m.Y', strtotime($patient->birth_date)) ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>