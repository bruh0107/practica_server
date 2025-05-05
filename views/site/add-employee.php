<div class="form-wrapper">
    <h2 class="form-employee-title">Добавить сотрудника</h2>
    <form method="post" class="form-employee">
        <label class="form-label">Логин <input type="text" class="form-input" name="login" required></label>
        <label class="form-label">Пароль <input type="password" class="form-input" name="password" required></label>
        <button class="button">Добавить</button>
    </form>
    <h3><?= $message ?? ''; ?></h3>
</div>