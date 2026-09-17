<?php
include "functions.php";
index();
include HEADER_TEMPLATE;
?>

<header class="mt-2">
    <div class="row">
        <div class="col-sm-6"><h2>Motos</h2></div>
        <div class="col-sm-6 text-end h2">
            <a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-motorcycle"></i> Nova Moto</a>
            <a class="btn btn-light" href="index.php"><i class="fa-solid fa-refresh"></i> Atualizar</a>
        </div>
    </div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
    <?php unset($_SESSION['message']); unset($_SESSION['type']); ?>
<?php endif; ?>

<hr>
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Motor</th>
            <th>Data de Cadastro</th>
            <th>Placa</th>
            <th>Foto</th>
            <th class="text-center">Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($motos): ?>
            <?php foreach ($motos as $moto): ?>
                <tr>
                    <td><?php echo $moto['id']; ?></td>
                    <td><?php echo $moto['modelo']; ?></td>
                    <td><?php echo $moto['marca']; ?></td>
                    <td><?php echo $moto['motor']; ?></td>
                    <td><?php echo formatadata($moto['datacad'], 'd/m/Y - H:i:s'); ?></td>
                    <td><?php echo strtoupper($moto['placa']); ?></td>
                    <td>
                        <?php if (!empty($moto['foto']) && file_exists("uploads/" . $moto['foto'])): ?>
                            <img src="uploads/<?php echo $moto['foto']; ?>"
                                alt="Foto da moto"
                                style="width: 80px; height: 60px; object-fit: cover;">
                        <?php else: ?>
                            <img src="img/sem-foto.jpg"
                                alt="Sem foto"
                                style="width: 80px; height: 60px; object-fit: cover;">
                        <?php endif; ?>
                    </td>
                    <td class="actions text-end">
                        <a href="view.php?id=<?php echo $moto['id']; ?>" class="btn btn-sm btn-light"><i class="fa-solid fa-eye"></i> Visualizar</a>
                        <a href="edit.php?id=<?php echo $moto['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                        <a href="#"class="btn btn-sm btn-dark"data-bs-toggle="modal"data-bs-target="#delete-modal"
                            data-id="<?php echo $moto['id']; ?>">
                            <i class="fa-solid fa-trash-can"></i> Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="8">Nenhum registro encontrado.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include('modal.php'); ?>
<?php include FOOTER_TEMPLATE; ?>
