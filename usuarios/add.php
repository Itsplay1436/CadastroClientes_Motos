<?php

require_once('functions.php');
add();

include HEADER_TEMPLATE;

?>

<h2 class="mt-2">Novo Usuário</h2>

<?php if (!empty($_SESSION['message'])): ?>

    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show">

        <?php echo $_SESSION['message']; ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Fechar">
        </button>

    </div>

    <?php
        unset($_SESSION['message']);
        unset($_SESSION['type']);
    ?>

<?php endif; ?>

<form action="add.php" method="post" enctype="multipart/form-data">

    <hr>

    <div class="row">

        <div class="form-group col-md-5">

            <label for="nome">Nome</label>

            <input
                type="text"
                class="form-control"
                id="nome"
                name="usuario[nome]"
                maxlength="100"
                placeholder="Jamelão Bundão"
                required>

        </div>

        <div class="form-group col-md-3">

            <label for="usuario">Usuário</label>

            <input
                type="text"
                class="form-control"
                id="usuario"
                name="usuario[user]"
                maxlength="50"
                placeholder="JãoBão Mestre dos Magos"
                autocomplete="username"
                required>

        </div>

    </div>

    <div class="row mt-2">

        <div class="form-group col-md-4">

            <label for="senhaUsuario">Senha</label>

            <input
                type="password"
                class="form-control"
                id="senhaUsuario"
                name="usuario[password]"
                minlength="6"
                placeholder="Mínimo de 6 caracteres"
                autocomplete="new-password"
                required>

        </div>

        <div class="form-group col-md-4">

            <label for="confirmarSenhaUsuario">Confirmar Senha</label>

            <input
                type="password"
                class="form-control"
                id="confirmarSenhaUsuario"
                name="usuario[confirm_password]"
                minlength="6"
                placeholder="Digite a senha novamente"
                autocomplete="new-password"
                required>

        </div>

    </div>

    <div class="row mt-2">

        <div class="form-group col-md-5">

            <label for="fotoUsuario">Foto</label>

            <input
                type="file"
                class="form-control"
                id="fotoUsuario"
                name="foto"
                accept=".jpg,.jpeg,.png">

            <small class="form-text text-muted">
                Formatos permitidos: JPG, JPEG e PNG.
            </small>

            <div class="mt-3">

                <p>Pré-visualização:</p>

                <img
                    id="previewUsuario"
                    src="fotos/sem-foto.jpg"
                    alt="Pré-visualização da foto do usuário"
                    style="width: 400px; height: 300px; object-fit: cover;">

            </div>

        </div>

    </div>

    <div id="actions" class="row mt-3">

        <div class="col-md-12">

            <button type="submit" class="btn btn-secondary">

                <i class="fa-solid fa-floppy-disk"></i>
                Salvar

            </button>

            <a href="index.php" class="btn btn-light">

                <i class="fa-regular fa-circle-xmark"></i>
                Cancelar

            </a>

        </div>

    </div>

</form>

<?php include FOOTER_TEMPLATE; ?>