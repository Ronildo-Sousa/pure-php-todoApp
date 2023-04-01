<?php $this->layout("_theme", ['title' => $title]) ?>

<div>
    <div>
        <h3><?= $task->title; ?></h3>
        <p><?= $task->id; ?></p>
        <p><?= $task->description; ?></p>
        <p><?= $task->type; ?></p>
        <p><?= $task->status; ?></p>
    </div>
</div>