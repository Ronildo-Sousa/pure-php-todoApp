<?php $this->layout("_theme", ['title' => $title]) ?>

<div>
    <h1>Minha lista de tarefas</h1>
    <?php foreach ($tasks as $task) : ?>
        <div>
            <div>
                <h3><?= $task->title; ?></h3>
                <p><?= $task->id; ?></p>
                <p><?= $task->description; ?></p>
                <p><?= $task->type; ?></p>
                <p><?= $task->status; ?></p>
            </div>
        </div>
        <br>
    <?php endforeach; ?>
</div>