<?php
require_once('functions.php');
edit();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2 class="mt-2">Atualizar Cliente</h2>

<form action="edit.php?id=<?php echo $customer['id']; ?>" method="post">
    <hr>
    <div class="row">
        <div class="form-group col-md-7">
            <label for="name">Nome / Razão Social</label>
            <input type="text" class="form-control" id="name" name="customer['name']" maxlength="255" required value="<?php echo $customer['name']; ?>" placeholder="Jamelão Bundão">
        </div>

        <div class="form-group col-md-3">
            <label for="cpf_cnpj">CNPJ / CPF</label>
            <input type="text" class="form-control" id="cpf_cnpj" name="customer['cpf_cnpj']" minlength="14" maxlength="18" inputmode="numeric" pattern="([0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}|[0-9]{2}\.[0-9]{3}\.[0-9]{3}/[0-9]{4}-[0-9]{2})" title="Digite um CPF com 11 números ou um CNPJ com 14 números." required value="<?php echo $customer['cpf_cnpj']; ?>" required placeholder="123.456.789-00">
        </div>

        <div class="form-group col-md-2">
            <label for="birthdate">Data de Nascimento</label>
            <input type="date" class="form-control" id="birthdate" name="customer['birthdate']" required value="<?php echo formatadata($customer['birthdate'], 'Y-m-d'); ?>">
        </div>
    </div>

    <div class="row mt-2">
        <div class="form-group col-md-5">
            <label for="address">Endereço</label>
            <input type="text" class="form-control" id="address" name="customer['address']" maxlength="255" required value="<?php echo $customer['address']; ?>" placeholder="Rua do Limbo para Lugar Nenhum, 123">
        </div>

        <div class="form-group col-md-3">
            <label for="hood">Bairro</label>
            <input type="text" class="form-control" id="hood" name="customer['hood']" maxlength="100" required value="<?php echo $customer['hood']; ?>" placeholder="Morro do Piolho">
        </div>

        <div class="form-group col-md-2">
            <label for="zip_code">CEP</label>
            <input type="text" class="form-control" id="zip_code" name="customer['zip_code']" minlength="9" maxlength="9" inputmode="numeric" pattern="[0-9]{5}-[0-9]{3}" title="Digite os 8 números do CEP." required value="<?php echo $customer['zip_code']; ?>" placeholder="12345-678">
        </div>

        <div class="form-group col-md-2">
            <label for="created">Data de Cadastro</label>
            <input type="text" class="form-control" id="created" disabled value="<?php echo formatadata($customer['created'], 'd/m/Y - H:i:s'); ?>">
        </div>
    </div>

    <div class="row mt-2">
        <div class="form-group col-md-5">
            <label for="city">Município</label>
            <input type="text" class="form-control" id="city" name="customer['city']" maxlength="100" required value="<?php echo $customer['city']; ?>" placeholder="Osasco">
        </div>

        <div class="form-group col-md-2">
            <label for="phone">Telefone</label>
            <input type="text" class="form-control" id="phone" name="customer['phone']" minlength="14" maxlength="14" inputmode="numeric" pattern="\([0-9]{2}\) [0-9]{4}-[0-9]{4}" title="Digite DDD + 8 números do telefone." required value="<?php echo $customer['phone']; ?>" placeholder="(11) 1234-5678">
        </div>

        <div class="form-group col-md-2">
            <label for="mobile">Celular</label>
            <input type="text" class="form-control" id="mobile" name="customer['mobile']" minlength="15" maxlength="15" inputmode="numeric" pattern="\([0-9]{2}\) [0-9]{5}-[0-9]{4}" title="Digite DDD + 9 números do celular." required value="<?php echo $customer['mobile']; ?>" placeholder="(11) 91234-5678">
        </div>

        <div class="form-group col-md-3">
            <label for="ie">Inscrição Estadual</label>
            <input type="text" class="form-control" id="ie" name="customer['ie']" minlength="15" maxlength="15" inputmode="numeric" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}\.[0-9]{3}" title="Digite os 12 números da Inscrição Estadual." placeholder="123.456.789.321" required value="<?php echo $customer['ie']; ?>" placeholder="123.456.789.067">
        </div>

        <input type="hidden" name="customer['state']" value="<?php echo $customer['state']; ?>">
    </div>

    <div id="actions" class="row mt-3">
        <div class="col-md-12">
            <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
            <a href="index.php" class="btn btn-light"><i class="fa-regular fa-circle-xmark"></i> Cancelar</a>
        </div>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
