<div class="add-doctor">
    <h2 class="add-doctor-title">Добавить врача</h2>
    <form class="add-doctor-form" method="post">
        <div class="add-doctor-info">
            <label>Фамилия <input class="form-input" type="text" name="surname" required></label>
            <label>Имя <input class="form-input" type="text" name="name" required></label>
            <label>Отчество <input class="form-input" type="text" name="patronym"></label>
        </div>
        <div class="add-doctor-info">
            <label>Дата рождения <input class="form-input" type="date" name="birthdate"></label>
            <label>Должность
                <select class="form-input" name="position">
                    <option value="">Старший врач</option>
                    <option value="">Медсестра</option>
                </select>
            </label>
        </div>
        <label>Специализация
            <select class="form-input" name="specialization">
                <option value="">Узист</option>
                <option value="">Офтальмолог</option>
            </select>
        </label>
        <button class="button-add">Добавить врача</button>
    </form>
</div>