<div class="login">
    <h2 class="login-title">Система для регистратуры поликлинники</h2>
    <h3 class="login-subtitle">Чтобы получить доступ к фукнционалу, войдите в аккаунт</h3>
    <h3><?= $message ?? ''; ?></h3>

    <h3><?= app()->auth->user()->name ?? ''; ?></h3>
    <?php
        if (!app()->auth::check()):
            ?>
            <form method="post" class="form">
                <label class="form-label">Логин <input class="form-input" type="text" name="login"></label>
                <label class="form-label">Пароль <input class="form-input" type="password" name="password"></label>
                <button class="button">Войти</button>
            </form>
        <?php endif;
    ?>
</div>