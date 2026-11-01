<?php

include "functions.php";
index();

include HEADER_TEMPLATE;

?>

<header class="mt-2">
    <div class="row">

        <div class="col-sm-6">
            <h2>Usuários</h2>
        </div>

        <div class="col-sm-6 text-end h2">

            <a class="btn btn-secondary" href="add.php">
                <i class="fa-solid fa-user-plus"></i> Novo Usuário
            </a>

            <a class="btn btn-light" href="index.php">
                <i class="fa-solid fa-refresh"></i> Atualizar
            </a>

        </div>

    </div>
</header>

<?php if (!empty($_SESSION['message'])): ?>

    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">

        <?php echo $_SESSION['message']; ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar">
        </button>

    </div>

    <?php
    unset($_SESSION['message']);
    unset($_SESSION['type']);
    ?>

<?php endif; ?>

<hr>

<table class="table table-hover">

    <thead>

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Usuário</th>
            <th>Foto</th>
            <th class="text-center">Opções</th>
        </tr>

    </thead>

    <tbody>

        <?php if ($users): ?>

            <?php foreach ($users as $user): ?>

                <tr>

                    <td>
                        <?php echo $user['id']; ?>
                    </td>

                    <td>
                        <?php echo $user['nome']; ?>
                    </td>

                    <td>
                        <?php echo $user['user']; ?>
                    </td>

                    <td>

                        <?php if (
                            !empty($user['foto']) &&
                            file_exists("uploads/" . $user['foto'])
                        ): ?>

                            <img src="uploads/<?php echo $user['foto']; ?>" alt="Foto do usuário"
                                style="width: 80px; height: 60px; object-fit: cover;">

                        <?php else: ?>

                            <img src="fotos/sem-foto.jpg" alt="Sem foto" style="width: 80px; height: 60px; object-fit: cover;">

                        <?php endif; ?>

                    </td>

                    <td class="actions text-end">

                        <a href="view.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-light">

                            <i class="fa-solid fa-eye"></i>
                            Visualizar

                        </a>

                        <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-secondary">

                            <i class="fa-solid fa-pen-to-square"></i>
                            Editar

                        </a>
                        <?php if ($user['user'] != 'admin'): ?>

                            <a href="#" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete-modal"
                                data-id="<?php echo $user['id']; ?>" data-tipo="usuario"
                                data-nome="<?php echo htmlspecialchars($user['nome'], ENT_QUOTES, 'UTF-8'); ?>">

                                <i class="fa-solid fa-trash-can"></i>
                                Excluir

                            </a>

                        <?php endif; ?>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="5">
                    Nenhum usuário encontrado.
                </td>
            </tr>

        <?php endif; ?>

    </tbody>

</table>

<?php include('modal.php'); ?>
<?php include FOOTER_TEMPLATE; ?>