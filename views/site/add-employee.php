<div class="form-wrapper">
    <h2 class="form-employee-title">Добавить сотрудника</h2>
    <form method="post" class="form-employee">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label class="form-label">Логин <input type="text" class="form-input" name="login"></label>
        <p><?= $errors['login'][0] ?? '' ?></p>
        <label class="form-label">Пароль <input type="password" class="form-input" name="password"></label>
        <p><?= $errors['password'][0] ?? '' ?></p>
        <button class="button">Добавить</button>
    </form>
    <h3><?= $message ?? ''; ?></h3>
</div>