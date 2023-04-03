<?php $this->layout("_theme", ['title' => $title]) ?>

<div class="task-list">
    <h1>Minha lista de tarefas</h1>

    <?php if (count($tasks) == 0) : ?>
        <div class="card">
            Não há tarefas cadastradas.
        </div>
    <?php endif; ?>

    <?php foreach ($tasks as $task) : ?>
        <div class="card">
            <div class="card-header">
                <h3><?= $task->title; ?></h3>
                <div>
                    <span class="tag-span"><?= $task->type; ?></span>
                    <span class="tag-span"><?= $task->status; ?></span>
                </div>
            </div>
            <div class="card-content">
                <div class="task-decription">
                    <p><?= $task->description; ?></p>
                </div>
                <div>
                    <a href="#" class="action edit">
                        editar
                    </a>
                    <a href="#" class="action delete">
                        apagar
                    </a>
                </div>

            </div>
        </div>
    <?php endforeach; ?>
</div>