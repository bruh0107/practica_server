<div class="main-hello">
    <?php if (app()->auth::user()->isAdmin()): ?>
        <h2 class="main-hello__title">Здравствуйте, Админ</h2>
        <a href="<?= app()->route->getUrl('/add-employee') ?>" class="button-add">Добавить сотрудника</a>
    <?php else: ?>
        <h2>Здравствуйте, сотрудник</h2>
    <?php endif; ?>
</div>
