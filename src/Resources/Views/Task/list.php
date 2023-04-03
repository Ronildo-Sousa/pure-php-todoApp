<?php $this->layout("_theme", ['title' => $title]) ?>

<div class="task-list">
    <h1>Minha lista de tarefas</h1>
    <form method="get" action="#" class="card search-form">
        <div class="search-content">
            <span>Filtrar tarefas:</span>
            <div>
                <select name="type" id="type">
                    <option value="">manutenção</option>
                </select>
            </div>
            <div>
                <select name="status" id="type">
                    <option value="">manutenção</option>
                </select>
            </div>
            <button type="submit" class="btn">filtrar</button>
        </div>
    </form>

    <?php if (count($tasks) == 0) : ?>
        <div class="card">
            Não há tarefas cadastradas.
        </div>
    <?php endif; ?>

    <?php foreach ($tasks as $task) : ?>
        <div class="card">
            <div class="task-content">
                <div class="task-header">
                    <h3><?= $task->title; ?></h3>
                    <div>
                        <span class="tag-span"><?= $task->type; ?></span>
                        <span class="tag-span"><?= $task->status; ?></span>
                    </div>
                </div>
                <div class="task-body">
                    <div class="task-decription">
                        <p><?= $task->description; ?></p>
                    </div>
                    <div>
                        <a href="#" class="btn delete">
                            apagar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>