<?php
include "functions.php";
view($_GET['id']);
include HEADER_TEMPLATE;
?>

<h2 class="mt-2">Moto <?php echo $moto['id']; ?></h2>
<hr>
<div class="card">
    <div class="card-body">
        <dl class="row mb-3">
            <dt class="col-sm-3">Modelo:</dt><dd class="col-sm-9"><?php echo $moto['modelo']; ?></dd>
            <dt class="col-sm-3">Marca:</dt><dd class="col-sm-9"><?php echo $moto['marca']; ?></dd>
            <dt class="col-sm-3">Motor:</dt><dd class="col-sm-9"><?php echo $moto['motor']; ?></dd>
            <dt class="col-sm-3">Placa:</dt><dd class="col-sm-9"><?php echo strtoupper($moto['placa']); ?></dd>
            <dt class="col-sm-3">Data de Cadastro:</dt><dd class="col-sm-9"><?php echo formatadata($moto['datacad'], 'd/m/Y - H:i:s'); ?></dd>
            <dt class="col-sm-3">Foto:</dt>
            <dd class="col-sm-9">
                <?php if (!empty($moto['foto']) && file_exists("uploads/" . $moto['foto'])): ?>
                    <img src="uploads/<?php echo $moto['foto']; ?>"
                        alt="Foto da moto"
                        style="width: 400px; height: 300px; object-fit: cover;">
                <?php else: ?>
                    <img src="img/sem-foto.jpg"
                        alt="Sem foto"
                        style="width: 400px; height: 300px; object-fit: cover;">
                <?php endif; ?>
            </dd>
        </dl>
    </div>
</div>
<div id="actions" class="row mt-3">
    <div class="col-md-12">
        <a href="edit.php?id=<?php echo $moto['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
        <a href="index.php" class="btn btn-light"><i class="fa-solid fa-arrow-rotate-left"></i> Voltar</a>
    </div>
</div>
<?php include FOOTER_TEMPLATE; ?>
