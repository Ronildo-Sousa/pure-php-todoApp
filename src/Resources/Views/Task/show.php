<?php $this->layout("_theme", ['title' => $title]) ?>

<div class="container">
    <a href="<?= route('dashboard/tarefas') ?>" class="back-btn">
        voltar
    </a>
    <div class="card">
        <a href="<?= route("dashboard/tarefas/edit/{$task->id}") ?>" class="btn">edit</a>
        <div class="show-content">
            <h3><?= $task->title; ?></h3>
            <p><?= $task->description; ?></p>
            <p><?= $task->type; ?></p>
            <p><?= $task->status; ?></p>
        </div>
    </div>
</div>