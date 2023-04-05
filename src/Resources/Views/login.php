<?php $this->layout("_theme", ['title' => $title]) ?>

<div class="container">
    <div class="logo">
        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg" />
    </div>

    <h1>Faça login em sua conta</h1>
    <?php if (isset($_SESSION['errors'])) : ?>
        <span class="form-error"><?= $_SESSION['errors']; ?></span>
    <?php endif; ?>
    <form method="post" action="<?= route("auth/login") ?>" class="form card">
        <div class="form-item">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required class="form-input" placeholder="seu email...">
        </div>
        <div class="form-item">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" class="form-input" required placeholder="sua senha...">
        </div>
        <div class="form-action">
            <button type="submit" class="btn">Enviar</button>
            <a href="<?= route('auth/cadastro') ?>">Registre-se</a>
        </div>
    </form>
</div>