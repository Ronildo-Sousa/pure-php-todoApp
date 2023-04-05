<?php $this->layout("_theme", ['title' => $title]) ?>

<div class="container">
    <a href="<?= route('dashboard/tarefas') ?>" class="back-btn">
        voltar
    </a>
    <form method="post" action="<?= route("dashboard/task/update/{$task->id}") ?>" class="card">
        <input type="hidden" name="task_id" value="<?= $task->id; ?>">
        <div>
            <label for="title">Titulo</label>
            <input type="text" name="title" id="title" required value="<?= $task->title; ?>">
        </div>
        <div>
            <label for="description">Descrição</label>
            <textarea name="description" id="description" cols="30" rows="10" required>
            <?= $task->description; ?>
            </textarea>
        </div>
        <div>
            <label for="status">Status</label>
            <select name="status" id="status">
                <?php foreach ($status as $item) : ?>
                    <option value="<?= $item->value; ?>" <?php if ($item->value == $task->status) echo 'selected' ?>><?= $item->value; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="type">Tipo</label>
            <select name="type" id="type">
                <?php foreach ($types as $item) : ?>
                    <option value="<?= $item->value ?>" <?php if ($item->value == $task->type) echo 'selected' ?>><?= $item->value; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn">Enviar</button>
    </form>
</div>