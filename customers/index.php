<?php
include "functions.php";
index();
include HEADER_TEMPLATE;
?>

<header class="mt-2">
    <div class="row">
        <div class="col-sm-6">
            <h2>Clientes</h2>
        </div>
        <div class="col-sm-6 text-end h2">
            <a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a>
            <a class="btn btn-light" href="index.php"><i class="fa-solid fa-refresh"></i> Atualizar</a>
        </div>
    </div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['message']); ?>
    <?php unset($_SESSION['type']); ?>
<?php endif; ?>

<hr>

<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th width="30%">Nome</th>
            <th>CPF/CNPJ</th>
            <th>Telefone</th>
            <th>Atualizado em</th>
            <th class="text-center">Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($customers): ?>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?php echo $customer['id']; ?></td>
                    <td><?php echo $customer['name']; ?></td>
                    <td><?php echo $customer['cpf_cnpj']; ?></td>
                    <td><?php echo $customer['phone']; ?></td>
                    <td>
                        <?php echo formatadata($customer['modified'], "d/m/Y - H:i:s"); ?>
                    </td>
                    <td class="actions text-end">
                        <a href="view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-light">
                            <i class="fa-solid fa-eye"></i> Visualizar
                        </a>
                        <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-secondary">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                        <a href="#" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete-modal"
                            data-customer="<?php echo $customer['id']; ?>">
                            <i class="fa-solid fa-trash-can"></i> Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Nenhum registro encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include('modal.php'); ?>
<?php include FOOTER_TEMPLATE; ?>
