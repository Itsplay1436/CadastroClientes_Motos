<?php
include "config.php";
include DBAPI;
include HEADER_TEMPLATE;
try {
    $db = open_database();
    $erro = "";
} catch (Exception $e) {
    $erro = $e->getMessage();
}
?>

<h1>Dashboard</h1>
<hr>

<?php if ($erro == ""): ?>

    <div class="row">
        <div class="col-xs-6 col-sm-3 col-md-2">
            <a href="customers/add.php" class="btn btn-secondary">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <i class="fa fa-user-plus fa-5x"></i>
                    </div>
                    <div class="col-xs-12 text-center">
                        <p>Novo Cliente</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xs-6 col-sm-3 col-md-2">
            <a href="customers" class="btn btn-light">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-12 text-center">
                        <p>Clientes</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-xs-6 col-sm-3 col-md-2">
            <a href="motos/add.php" class="btn btn-secondary">
                <div class="row"><div class="col-xs-12 text-center"><i class="fa-solid fa-plus fa-5x"></i></div><div class="col-xs-12 text-center"><p>Nova Moto</p></div></div>
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-2">
            <a href="motos" class="btn btn-light">
                <div class="row"><div class="col-xs-12 text-center"><i class="fa-solid fa-motorcycle fa-5x"></i></div><div class="col-xs-12 text-center"><p>Motos</p></div></div>
            </a>
        </div>
    </div>

<?php else: ?>
    <div class="alert alert-danger" role="alert">
        <p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!<br>
            <?= $erro ?>
        </p>
    </div>

<?php endif; ?>

<?php include FOOTER_TEMPLATE; ?>