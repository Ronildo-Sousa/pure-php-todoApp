<?php $this->layout("_theme", ['title' => $title]) ?>

<form method="post" action="<?= route("auth/register") ?>">
    <div>
        <label for="name">Nome</label>
        <input type="text" name="name" id="name" required value="Ronildo">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required value="email@email.com">
    </div>
    <div>
        <label for="password">Senha</label>
        <input type="password" name="password" id="password" required value="password">
    </div>
    <button type="submit">Enviar</button>
</form>