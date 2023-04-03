<?php $this->layout("_theme", ['title' => $title]) ?>

<div class="container">
    <a href="<?= route('dashboard/tarefas') ?>" class="back-btn">
        voltar
    </a>
    <form method="post" action="<?= route("dashboard/task/store") ?>" class="card">
        <div>
            <label for="title">Titulo</label>
            <input type="text" name="title" id="title" required value="Teste">
        </div>
        <div>
            <label for="description">Descrição</label>
            <textarea name="description" id="description" cols="30" rows="10" required></textarea>
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
        <button type="submit" class="btn">Enviar</button>
    </form>
</div>