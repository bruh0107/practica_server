<div class="entries">
    <h2 class="entries-title">Записи</h2>
    <div class="entries-list">
        <?php foreach ($entries as $entry): ?>
            <div class="entries-card">
                <div class="entries-card-info">
                    <p>Запись №<?= $entry->id ?></p>
                    <p>Статус: <?= $entry->entryStatus->name ?? 'Не указан' ?></p>
                    <?php if (app()->auth::user()->isEmployee() && $entry->status_id === 2): ?>
                        <a href="<?= app()->route->getUrl("/entries/" . "$entry->id" . "/cancel") ?>" class="button">Отменить запись</a>
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