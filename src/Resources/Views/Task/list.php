<?php $this->layout("_theme", ['title' => $title]) ?>

<div class="task-list">

    <a href="<?= route('dashboard/tarefas/nova') ?>" class="new-task">
        +
    </a>
    <a href="<?= route('auth/logout') ?>" class="logout">
        Sair
    </a>

    <h1>Minha lista de tarefas</h1>
    <form method="get" action="<?= route('dashboard/tarefas') ?>" class="card search-form">
        <div class="search-content">
            <span>Filtrar tarefas:</span>
            <div>
                Tipo:
                <select name="type" id="type">
                    <?php foreach ($types as $type) : ?>
                        <option value="<?= $type->value ?>"><?= $type->value ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                Status:
                <select name="status" id="status">
                    <?php foreach ($status as $item) : ?>
                        <option value="<?= $item->value ?>"><?= $item->value ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn">filtrar</button>
            <a href="<?= route('dashboard/tarefas') ?>">limpar</a>
        </div>
    </form>

    <?php if (count($tasks) == 0) : ?>
        <div class="card">
            Não há tarefas para mostrar !
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
                        <a href="<?= route("dashboard/tarefas/edit/{$task->id}") ?>" class="btn">
                            editar
                        </a>
                        <a href="<?= route("dashboard/tarefas/delete/{$task->id}") ?>" class="btn delete">
                            apagar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>