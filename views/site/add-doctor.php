<div class="add-doctor">
    <h2 class="add-doctor-title">Добавить врача</h2>
    <form class="add-doctor-form" method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div class="add-doctor-info">
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
        <div class="add-doctor-info">
            <div>
                <label>Дата рождения <input class="form-input" type="date" name="birth_date"></label>
                <p><?= $errors['birth_date'][0] ?? '' ?></p>
            </div>
            <div>
                <label>Должность
                    <select class="form-input" name="position_id">
                        <option value="">Не выбрано</option>
                        <?php foreach ($positions as $position): ?>
                            <option value="<?= $position->id ?>"><?= $position->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <p><?= $errors['position_id'][0] ?? '' ?></p>
            </div>
        </div>
        <div>
            <label>Специализация
                <select class="form-input" name="specialization_id">
                    <option value="">Не выбрано</option>
                    <?php foreach ($specializations as $specialization): ?>
                        <option value="<?= $specialization->id ?>"><?= $specialization->name ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <p><?= $errors['specialization_id'][0] ?? '' ?></p>
        </div>
        <button class="button-add">Добавить врача</button>
        <h3><?= $message ?? ''; ?></h3>
    </form>
</div>