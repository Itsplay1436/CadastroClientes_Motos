<?php

require_once('functions.php');
edit();

include HEADER_TEMPLATE;

?>

<h2 class="mt-2">Atualizar Usuário</h2>

<?php if (!empty($_SESSION['message'])): ?>

    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show">

        <?php echo $_SESSION['message']; ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar">
        </button>

    </div>

    <?php
    unset($_SESSION['message']);
    unset($_SESSION['type']);
    ?>

<?php endif; ?>

<form action="edit.php?id=<?php echo $user['id']; ?>" method="post" enctype="multipart/form-data">

    <hr>

    <div class="row">

        <div class="form-group col-md-5">

            <label for="nome">Nome</label>

            <input type="text" class="form-control" id="nome" name="usuario[nome]" maxlength="100"
                placeholder="João da Silva" value="<?php echo $user['nome']; ?>" required>

        </div>

        <div class="form-group col-md-3">

            <label for="usuario">Usuário</label>

            <input type="text" class="form-control" id="usuario" name="usuario[user]" maxlength="50"
                placeholder="joao.silva" autocomplete="username" value="<?php echo $user['user']; ?>" <?php if ($user['user'] == 'admin')
                       echo 'readonly'; ?> required>

            <?php if ($user['user'] == 'admin'): ?>

                <small class="form-text text-muted">
                    O nome de usuário do administrador não pode ser alterado.
                </small>

            <?php endif; ?>

        </div>

    </div>

    <div class="row mt-2">

        <div class="form-group col-md-4">

            <label for="senhaUsuario">Nova Senha</label>

            <input type="password" class="form-control" id="senhaUsuario" name="usuario[password]" minlength="6"
                placeholder="Deixe vazio para manter a senha" autocomplete="new-password">

        </div>

        <div class="form-group col-md-4">

            <label for="confirmarSenhaUsuario">
                Confirmar Nova Senha
            </label>

            <input type="password" class="form-control" id="confirmarSenhaUsuario" name="usuario[confirm_password]"
                minlength="6" placeholder="Digite novamente a nova senha" autocomplete="new-password">

        </div>

    </div>

    <div class="row mt-2">

        <div class="form-group col-md-5">

            <label for="fotoUsuario">Nova Foto</label>

            <input type="file" class="form-control" id="fotoUsuario" name="foto" accept=".jpg,.jpeg,.png">

            <small class="form-text text-muted">
                Deixe vazio para manter a foto atual.
            </small>

        </div>

    </div>

    <div class="mt-3">

        <p>Foto atual:</p>

        <?php if (
            !empty($user['foto']) &&
            file_exists("uploads/" . $user['foto'])
        ): ?>

            <img id="previewUsuario" src="uploads/<?php echo $user['foto']; ?>" alt="Foto do usuário"
                style="width: 400px; height: 300px; object-fit: cover;">

        <?php else: ?>

            <img id="previewUsuario" src="fotos/sem-foto.jpg" alt="Sem foto"
                style="width: 400px; height: 300px; object-fit: cover;">

        <?php endif; ?>

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