<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pop it MVC</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    a {
        text-decoration: none;
        color: inherit;
    }
    body {
        font-family: 'Arial', sans-serif;
    }
    .header {
        background: #D9D9D9;
    }
    .container{
        max-width: 1660px;
        margin: 0 auto;
    }
    .nav {
        display: flex;
        justify-content: space-between;
        padding: 28px 0;
    }
    .logo {
        font-size: 24px;
    }
    .nav-list__item {
        font-size: 20px;
    }
    .form-input {
        padding: 4px 2px;
        font-size: 18px;
    }
    .form {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        max-width: 300px;
    }
    .form-label {
        display: flex;
        flex-direction: column;
        font-size: 20px;
    }
    .login {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        padding: 100px 0;
    }
    .login-title {
        font-size: 36px;
    }
    .login-subtitle {
        font-size: 36px;
    }
    .button {
        padding: 8px 40px;
        display: flex;
        cursor: pointer;
    }
    .button-add {
        padding: 16px 68px;
        border: none;
        font-size: 16px;
        cursor: pointer;
        background: #D9D9D9;
        display: flex;
        justify-content: center;
    }
    .main-hello {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-top: 80px;
        gap: 30px;
    }
    .main-hello__title {
        font-size: 36px;
    }
    .form-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: #D9D9D9;
        max-width: fit-content;
        margin: 160px auto 0;
    }
    .form-employee {
        padding: 58px 110px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }
    .form-employee-title, .create-entry-title {
        padding: 22px 96px;
        background: #EBEBEB;
    }
    .employee-func-list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    .add-doctor, .add-patient {
        background: #C8C8C8;
        width: fit-content;
        margin: 140px auto 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .add-doctor-title, .add-patient-title {
        font-size: 36px;
        padding: 21px 146px;
        background: #EBEBEB;
        width: fit-content;
    }
    .add-doctor-form, .add-patient-form {
        padding: 50px 82px;
        font-size: 20px;
        display: flex;
        flex-direction: column;
        gap: 60px;
        align-items: center;
    }
    .add-doctor-info, .add-patient-info {
        display: flex;
        gap: 30px;
    }
    .create-entry {
        width: fit-content;
        margin: 140px auto 0;
    }
    .create-entry-form {
        background: #C8C8C8;
        padding: 50px 136px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }
    .create-entry-title {
        text-align: center;
    }
    .entries-list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
    }
    .entries, .patients, .doctors, .doctor-id {
        margin-top: 60px;
        display: flex;
        flex-direction: column;
        gap: 40px;
    }
    .entries-title, .patients-title, .doctors-title {
        font-size: 40px;
    }
    .entries-card {
        padding: 15px;
        background: #D9D9D9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: row-reverse;
    }
    .entries-card-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .doctors-list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
    }
    .patients-card, .doctors-card {
        padding: 15px;
        background: #D9D9D9;
        display: flex;
        flex-direction: column;
        gap: 15px;
        font-size: 18px;
    }
    .patient-info, .doctors-info {
        display: flex;
        gap: 25px;
    }
    .patients-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
    }
    .patients-card-title {
        font-size: 22px;
    }
    .doctor-id-info {
        display: flex;
        flex-direction: column;
        gap: 10px;
        font-size: 20px;
    }
</style>
<body>

<header class="header">
    <div class="container">
        <nav class="nav">
            <a href="<?= app()->route->getUrl('/') ?>" class="logo">ПОЛИКЛИННИКА.СИСТЕМА</a>
            <div class="nav-list">
                <?php
                if (!app()->auth::check()):
                    ?>
                    <a href="<?= app()->route->getUrl('/login') ?>" class="nav-list__item">ВХОД</a>
                <?php
                else:
                    ?>
                    <a href="<?= app()->route->getUrl('/logout') ?>" class="nav-list__item">ВЫЙТИ ИЗ АККАУНТА</a>
                <?php
                endif;
                ?>
            </div>
        </nav>
    </div>
</header>
<main>
    <div class="container">
        <?= $content ?? '' ?>
    </div>
</main>


</body>
</html>
