<?php $this->layout("_theme", ['title' => $title]) ?>

<div class="container">
    <a href="<?= route('dashboard/tarefas') ?>" class="back-btn">
        voltar
    </a>
    <h1>Atualizar tarefa</h1>
    <form method="post" action="<?= route("dashboard/task/update/{$task->id}") ?>" class="card form">
        <input type="hidden" name="task_id" value="<?= $task->id; ?>">
        <div class="form-item">
            <label for="title">Titulo</label>
            <input type="text" name="title" id="title" class="form-input" required value="<?= $task->title; ?>">
        </div>
        <div class="select-group">
            <div class="select-item">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <?php foreach ($status as $item) : ?>
                        <option value="<?= $item->value; ?>" <?php if ($item->value == $task->status) echo 'selected' ?>><?= $item->value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="select-item">
                <label for="type">Tipo</label>
                <select name="type" id="type">
                    <?php foreach ($types as $item) : ?>
                        <option value="<?= $item->value ?>" <?php if ($item->value == $task->type) echo 'selected' ?>><?= $item->value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-item">
            <label for="description">Descrição</label>
            <textarea name="description" id="description" style="resize: vertical;" class="form-input" cols="30" rows="10" required>
            <?= $task->description; ?>
            </textarea>
        </div>


        <button type="submit" class="btn">Enviar</button>
    </form>
</div>