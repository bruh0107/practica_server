<div class="add-patient">
    <h2 class="add-patient-title">Добавить пациента</h2>
    <form method="post" class="add-patient-form">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div class="add-patient-info">
            <div>
                <label>Фамилия <input class="form-input" type="text" name="surname"></label>
                <p><?= $errors['surname'][0] ?? '' ?></p>
            </div>
            <div>
                <label>Имя <input class="form-input" type="text" name="name"></label>
                <p><?= $errors['name'][0] ?? '' ?></p>
            </div>
            <label>Отчество <input class="form-input" type="text" name="patronym"></label>
        </div>
        <div>
            <label>Дата рождения <input class="form-input" type="date" name="birth_date"></label>
            <p><?= $errors['birth_date'][0] ?? '' ?></p>
        </div>
        <button class="button-add">Добавить пациента</button>
        <h3><?= $message ?? ''; ?></h3>
    </form>
</div>