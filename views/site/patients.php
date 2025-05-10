<div class="patients">
    <h2 class="patients-title">Пациенты</h2>
    <div class="patients-list">
        <?php foreach ($patients as $patient): ?>
            <div class="patients-card">
                <p class="patients-card-title">Пациент №<?= $patient->id ?></p>
                <div class="patient-info">
                    <p>Фамилия: <?= $patient->surname ?></p>
                    <p>Имя: <?= $patient->name ?></p>
                    <?php if (!empty($patient->patronym)): ?>
                        <p>Отчество: <?= $patient->patronym ?></p>
                    <?php endif; ?>
                    <p>Дата рождения: <?= date('d.m.Y', strtotime($patient->birth_date)) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>