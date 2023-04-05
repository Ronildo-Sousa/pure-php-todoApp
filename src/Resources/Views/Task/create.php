<?php $this->layout("_theme", ['title' => $title]) ?>

<div class="container">
    <a href="<?= route('dashboard/tarefas') ?>" class="back-btn">
        voltar
    </a>
    <h1>Criar nova tarefa</h1>
    <form method="post" action="<?= route("dashboard/task/store") ?>" class="card form">
        <div class="form-item">
            <label for="title">Titulo</label>
            <input type="text" name="title" id="title" required class="form-input" placeholder="titulo da tarefa...">
        </div>
        <div class="select-group">
            <div class="select-item">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <?php foreach ($status as $item) : ?>
                        <option value="<?= $item->value; ?>"><?= $item->value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="select-item">
                <label for="type">Tipo</label>
                <select name="type" id="type">
                    <?php foreach ($types as $item) : ?>
                        <option value="<?= $item->value ?>"><?= $item->value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-item">
            <label for="description">Descrição</label>
            <textarea name="description" id="description" style="resize: vertical;" cols="30" rows="10" class="form-input" required placeholder="conteúdo da tarefa..."></textarea>
        </div>


        <button type="submit" class="btn">Enviar</button>
    </form>
</div>