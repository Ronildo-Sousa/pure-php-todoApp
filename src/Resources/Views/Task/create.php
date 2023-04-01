<?php $this->layout("_theme", ['title' => $title]) ?>

<form method="post" action="<?= route("dashboard/task/store") ?>">
    <div>
        <label for="title">Titulo</label>
        <input type="text" name="title" id="title" required value="Teste">
    </div>
    <div>
        <label for="description">Descrição</label>
        <input type="text" name="description" id="description" required value="lorem ipsum teste teste">
    </div>
    <div>
        <label for="status">Status</label>
        <select name="status" id="status">
            <?php foreach ($status as $item) : ?>
                <option value="<?= $item->value; ?>"><?= $item->value; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="type">Tipo</label>
        <select name="type" id="type">
            <?php foreach ($types as $item) : ?>
                <option value="<?= $item->value ?>"><?= $item->value; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit">Enviar</button>
</form>