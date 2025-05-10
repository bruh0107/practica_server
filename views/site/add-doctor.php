<div class="add-doctor">
    <h2 class="add-doctor-title">Добавить врача</h2>
    <form class="add-doctor-form" method="post">
        <div class="add-doctor-info">
            <label>Фамилия <input class="form-input" type="text" name="surname" required></label>
            <label>Имя <input class="form-input" type="text" name="name" required></label>
            <label>Отчество <input class="form-input" type="text" name="patronym"></label>
        </div>
        <div class="add-doctor-info">
            <label>Дата рождения <input class="form-input" type="date" name="birth_date" required></label>
            <label>Должность
                <select class="form-input" name="position_id">
                    <?php foreach ($positions as $position): ?>
                        <option value="<?= $position->id ?>"><?= $position->name ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
        <label>Специализация
            <select class="form-input" name="specialization_id">
                <?php foreach ($specializations as $specialization): ?>
                    <option value="<?= $specialization->id ?>"><?= $specialization->name ?></option>
                <?php endforeach; ?>
            </select>
            <input class="form-input" type="file" name="avatar">
        </label>
        <button class="button-add">Добавить врача</button>
        <h3><?= $message ?? ''; ?></h3>
    </form>
</div>