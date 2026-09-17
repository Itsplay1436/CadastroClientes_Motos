<?php
require_once('functions.php');
edit();
?>
<?php include(HEADER_TEMPLATE); ?>

<h2 class="mt-2">Atualizar Moto</h2>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
    <?php unset($_SESSION['message']); unset($_SESSION['type']); ?>
<?php endif; ?>

<form action="edit.php?id=<?php echo $moto['id']; ?>" method="post" enctype="multipart/form-data">
    <hr>
    <div class="row">
        <div class="form-group col-md-5">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="moto[modelo]" maxlength="50" required value="<?php echo $moto['modelo']; ?>">
        </div>

        <div class="form-group col-md-3">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" id="marca" name="moto[marca]" maxlength="30" required value="<?php echo $moto['marca']; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="motor">Motor</label>
            <input type="text" class="form-control" id="motor" name="moto[motor]" maxlength="20" required value="<?php echo $moto['motor']; ?>">
        </div>

        <div class="form-group col-md-2">
            <label for="placa">Placa</label>
            <input type="text" class="form-control" id="placa" name="moto[placa]" minlength="7" maxlength="7"
                pattern="[A-Za-z]{3}[A-Za-z0-9]{4}" title="Digite os 7 caracteres da placa, sem espaço ou hífen." value="<?php echo $moto['placa']; ?>" required>
        </div>
    </div>

    <div class="row mt-2">
        <div class="form-group col-md-5">
            <label for="foto">Nova Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" accept=".jpg,.jpeg,.png">
            <small class="form-text text-muted">Deixe vazio para manter a foto atual.</small>
        </div>

        <div class="form-group col-md-3">
            <label for="datacad">Data de Cadastro</label>
            <input type="text" class="form-control" id="datacad" disabled value="<?php echo formatadata($moto['datacad'], 'd/m/Y - H:i:s'); ?>">
        </div>
    </div>

    <div class="mt-3">
      <p>Foto atual:</p>

      <?php if (!empty($moto['foto']) && file_exists("uploads/" . $moto['foto'])): ?>
          <img id="previewFoto"
              src="uploads/<?php echo $moto['foto']; ?>"
              alt="Foto da moto"
              style="width: 400px; height: 300px; object-fit: cover;">
      <?php else: ?>
          <img id="previewFoto"
              src="img/sem-foto.jpg"
              alt="Sem foto"
              style="width: 400px; height: 300px; object-fit: cover;">
      <?php endif; ?>
  </div>

    <div id="actions" class="row mt-3">
        <div class="col-md-12">
            <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
            <a href="index.php" class="btn btn-light"><i class="fa-regular fa-circle-xmark"></i> Cancelar</a>
        </div>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
