<div class="doctor-id">
    <h2>Врач №<?= $doctor->id ?></h2>
    <div class="doctor-id-info">
        <p>Фамилия: <?= $doctor->surname ?></p>
        <p>Имя: <?= $doctor->name ?></p>
        <p>Отчество: <?= $doctor->patronym ?></p>
    </div>
    <h2>Пациенты врача</h2>
    <div class="patients-list">
        <?php if ($doctor->patients->isEmpty()): ?>
            <p class="no-patients-message">У этого врача нет пациентов</p>
        <?php else: ?>
            <?php foreach ($doctor->patients as $patient): ?>
                <div class="patients-card">
                    <p class="patients-card-title">Пациент №<?= $patient->id ?></p>
                    <div class="patients-card-info">
                        <p>Фамилия: <?= $patient->surname ?></p>
                        <p>Имя: <?= $patient->name ?></p>
                        <?php if (!empty($patient->patronym)): ?>
                            <p>Отчество: <?= $patient->patronym ?></p>
                        <?php endif; ?>
                        <p>Дата рождения: <?= date('d.m.Y', strtotime($patient->birth_date)) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>