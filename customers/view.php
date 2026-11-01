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

<h2 class="mt-2">Cliente <?php echo $customer['id']; ?></h2>

<hr>

<div class="card">
    <div class="card-body">

        <!-- DADOS PESSOAIS -->
        <h5 class="mb-3">Dados Pessoais</h5>

        <dl class="row">

            <dt class="col-sm-3">ID:</dt>
            <dd class="col-sm-9">
                <?php echo $customer['id']; ?>
            </dd>

            <dt class="col-sm-3">Nome:</dt>
            <dd class="col-sm-9">
                <?php echo $customer['name']; ?>
            </dd>

            <dt class="col-sm-3">CPF / CNPJ:</dt>
            <dd class="col-sm-9">
                <?php echo formatacpfcnpj($customer['cpf_cnpj']); ?>
            </dd>

            <dt class="col-sm-3">Inscrição Estadual:</dt>
            <dd class="col-sm-9">
                <?php echo formataie($customer['ie']); ?>
            </dd>

            <dt class="col-sm-3">Data de Nascimento:</dt>
            <dd class="col-sm-9">
                <?php echo formatadata($customer['birthdate'], 'd/m/Y'); ?>
            </dd>

        </dl>

        <hr>

        <!-- ENDEREÇO -->
        <h5 class="mb-3">Endereço</h5>

        <dl class="row">

            <dt class="col-sm-3">Endereço:</dt>
            <dd class="col-sm-9">
                <?php echo $customer['address']; ?>
            </dd>

            <dt class="col-sm-3">Bairro:</dt>
            <dd class="col-sm-9">
                <?php echo $customer['hood']; ?>
            </dd>

            <dt class="col-sm-3">CEP:</dt>
            <dd class="col-sm-9">
                <?php echo formatacep($customer['zip_code']); ?>
            </dd>

            <dt class="col-sm-3">Município:</dt>
            <dd class="col-sm-9">
                <?php echo $customer['city']; ?>
            </dd>

        </dl>

        <hr>

        <!-- CONTATO -->
        <h5 class="mb-3">Contato</h5>

        <dl class="row">

            <dt class="col-sm-3">Telefone:</dt>
            <dd class="col-sm-9">
                <?php echo formatatelefone($customer['phone']); ?>
            </dd>

            <dt class="col-sm-3">Celular:</dt>
            <dd class="col-sm-9">
                <?php echo formatatelefone($customer['mobile']); ?>
            </dd>

        </dl>

        <hr>

        <!-- INFORMAÇÕES DO CADASTRO -->
        <h5 class="mb-3">Informações do Cadastro</h5>

        <dl class="row mb-0">

            <dt class="col-sm-3">Data de Cadastro:</dt>
            <dd class="col-sm-9">
                <?php echo formatadata($customer['created'], 'd/m/Y - H:i:s'); ?>
            </dd>

            <dt class="col-sm-3">Última Atualização:</dt>
            <dd class="col-sm-9">

                <?php
                if (!empty($customer['modified'])) {
                    echo formatadata($customer['modified'], 'd/m/Y - H:i:s');
                } else {
                    echo 'Não atualizado';
                }
                ?>

            </dd>

        </dl>

    </div>
</div>

<div id="actions" class="row mt-3">

    <div class="col-md-12">

        <a
            href="edit.php?id=<?php echo $customer['id']; ?>"
            class="btn btn-secondary">

            <i class="fa-solid fa-pen-to-square"></i>
            Editar

        </a>

        <a
            href="index.php"
            class="btn btn-light">

            <i class="fa-solid fa-arrow-rotate-left"></i>
            Voltar

        </a>

    </div>

</div>

<?php include FOOTER_TEMPLATE; ?>