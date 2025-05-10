<div class="doctors">
    <h2 class="doctors-title">Врачи</h2>

    <!-- Добавляем форму поиска -->
    <form class="doctors-search" method="get" action="<?= app()->route->getUrl('/doctors') ?>">
        <input type="text" name="search" placeholder="Поиск по фамилии" value="<?= htmlspecialchars($search ?? '') ?>">
        <button type="submit">Найти</button>
    </form>

    <div class="doctors-list">
        <?php if ($doctors->isEmpty()): ?>
            <p>Врачи не найдены</p>
        <?php else: ?>
            <?php foreach ($doctors as $doctor): ?>
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
        <?php endif; ?>
    </div>
</div>