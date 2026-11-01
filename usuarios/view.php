<?php

require_once('functions.php');

if (isset($_GET['id'])) {
    view($_GET['id']);
} else {
    header('Location: index.php');
    exit;
}

include HEADER_TEMPLATE;

?>

<h2 class="mt-2">Usuário <?php echo $user['id']; ?></h2>

<hr>

<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="col-md-7">

                <h5 class="mb-3">Dados do Usuário</h5>

                <dl class="row">

                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9">
                        <?php echo $user['id']; ?>
                    </dd>

                    <dt class="col-sm-3">Nome:</dt>
                    <dd class="col-sm-9">
                        <?php echo $user['nome']; ?>
                    </dd>

                    <dt class="col-sm-3">Usuário:</dt>
                    <dd class="col-sm-9">
                        <?php echo $user['user']; ?>
                    </dd>

                    <dt class="col-sm-3">Senha:</dt>
                    <dd class="col-sm-9 text-break">
                        <?php echo $user['password']; ?>
                    </dd>

                </dl>

            </div>

            <div class="col-md-5">

                <h5 class="mb-3">Foto</h5>

                <?php if (
                    !empty($user['foto']) &&
                    file_exists("uploads/" . $user['foto'])
                ): ?>

                    <img src="uploads/<?php echo $user['foto']; ?>" alt="Foto do usuário"
                        style="width: 400px; height: 300px; object-fit: cover;">

                <?php else: ?>

                    <img src="fotos/sem-foto.jpg" alt="Sem foto" style="width: 400px; height: 300px; object-fit: cover;">

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<div class="row mt-3">

    <div class="col-md-12">

        <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-secondary">

            <i class="fa-solid fa-pen-to-square"></i>
            Editar

        </a>

        <a href="index.php" class="btn btn-light">

            <i class="fa-solid fa-arrow-rotate-left"></i>
            Voltar

        </a>

    </div>

</div>

<?php include FOOTER_TEMPLATE; ?>