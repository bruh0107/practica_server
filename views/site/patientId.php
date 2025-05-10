<div class="patient-id">
    <h2>Пациент №<?= $patient->id ?></h2>
    <div class="patient-id-info">
        <p>Фамилия: <?= $patient->surname ?></p>
        <p>Имя: <?= $patient->name ?></p>
        <?php if (!empty($patient->patronym)): ?>
            <p>Отчество: <?= $patient->patronym ?></p>
        <?php endif; ?>
    </div>
    <div class="patient-info">
        <div class="list-inner">
            <h2>Записи пациента</h2>
            <div class="patient-info-list">
                <?php foreach ($patient->entries as $entry): ?>
                    <div class="entries-card">
                        <div class="entries-card-info">
                            <p>Запись №<?= $entry->id ?></p>
                            <p>Статус: <?= $entry->entryStatus->name ?? 'Не указан' ?></p>
                            <?php if (app()->auth::user()->isEmployee()): ?>
                                <button class="button">Отменить запись</button>
                            <?php endif; ?>
                        </div>
                        <div class="entries-card-info">
                            <p>Пациент: <?= $entry->entryPatient->surname ?? '' ?> <?= $entry->entryPatient->name ?? '' ?> <?= $entry->entryPatient->patronym ?? '' ?></p>
                            <p>Врач: <?= $entry->entryDoctor->surname ?? '' ?> <?= $entry->entryDoctor->name ?? '' ?> <?= $entry->entryDoctor->patronym ?? '' ?></p>
                            <p>Время: <?= date('H:i', strtotime($entry->time)) ?></p>
                            <p>Дата: <?= date('d.m.Y', strtotime($entry->time)) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="list-inner">
            <h2>Врачи, к которым записан пациент</h2>
            <div class="patient-info-list">
                <?php foreach ($patient->doctors as $doctor): ?>
                <a class="doctors-card" href="<?= app()->route->getUrl("/doctors/" . "$doctor->id") ?>">
                    <p>Врач №<?= $doctor->id ?></p>
                    <div class="doctors-info">
                        <p>Фамилия: <?= $doctor->surname ?></p>
                        <p>Имя: <?= $doctor->name ?></p>
                        <?php if (!empty($doctor->patronym)): ?>
                            <p>Отчество: <?= $doctor->patronym ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="doctors-info">
                        <?php if ($doctor->position->isNotEmpty()): ?>
                            <p>Должность: <?= $doctor->position->first()->name ?></p>
                        <?php endif; ?>
                        <?php if ($doctor->specializations->isNotEmpty()): ?>
                            <p>Специализация:
                                <?= implode(', ', $doctor->specializations->pluck('name')->toArray()) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>