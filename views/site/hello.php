<div class="main-hello">
    <?php if (app()->auth::user()->isAdmin()): ?>
        <h2 class="main-hello__title">Здравствуйте, Админ</h2>
        <a href="<?= app()->route->getUrl('/add-employee') ?>" class="button-add">Добавить сотрудника</a>
        <div class="employee-func-list">
            <a href="" class="button-add">Записи</a>
            <a href="" class="button-add">Пациенты</a>
            <a href="" class="button-add">Врачи</a>
        </div>
    <?php else: ?>
        <h2>Здравствуйте, сотрудник</h2>
        <div class="employee-func-list">
            <a href="<?= app()->route->getUrl('/add-doctor') ?>" class="button-add">Добавить врача</a>
            <a href="<?= app()->route->getUrl('/add-patient') ?>" class="button-add">Добавить пациента</a>
            <a href="<?= app()->route->getUrl('/create-entry') ?>" class="button-add">Создать запись</a>
            <a href="<?= app()->route->getUrl('/entries') ?>" class="button-add">Записи</a>
            <a href="" class="button-add">Пациенты</a>
            <a href="" class="button-add">Врачи</a>
        </div>
    <?php endif; ?>
</div>
