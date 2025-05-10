<div class="create-entry">
    <h2 class="create-entry-title">Создать запись</h2>
    <form action="" class="create-entry-form" method="post">
        <label class="form-label">Пациент
            <select class="form-input" name="patient_id">
                <?php foreach ($patients as $patient):?>
                    <option value="<?= $patient->id ?>"><?= $patient->surname ?> <?= $patient->name ?> <?= $patient->patronym ?></option>
                <?php endforeach;?>
            </select>
        </label>
        <label class="form-label">Врач
            <select class="form-input" name="doctor_id">
                <?php foreach ($doctors as $doctor):?>
                    <option value="<?= $doctor->id ?>"><?= $doctor->surname ?> <?= $doctor->name ?> <?= $doctor->patronym ?></option>
                <?php endforeach;?>
            </select>
        </label>
        <label>Время <input class="form-input" type="datetime-local" name="time"></label>
        <button class="button-add">Создать запись</button>
        <h3><?= $message ?? ''; ?></h3>
    </form>
</div>