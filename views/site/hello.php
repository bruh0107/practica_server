<div class="main-hello">
    <?php if (app()->auth::user()->isAdmin()): ?>
        <h2 class="main-hello__title">Здравствуйте, Админ</h2>
        <button class="button-add">Добавить сотрудника</button>
    <?php else: ?>
        <h2>Здравствуйте, сотрудник</h2>
    <?php endif; ?>
</div>
