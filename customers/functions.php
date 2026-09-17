<?php
include "../config.php";
include DBAPI;

$customers = null;
$customer = null;

/**
 *  Função para formatar as datas
 */
function formatadata($data, $formato)
{
    $dt = new DateTime($data, new DateTimeZone("-0300"));
    return $dt->format($formato);
}

/**
 *  Função para formatar os telefones
 */
function telefone($tel)
{
    return "(" . substr($tel, 0, 2) . ")" . substr($tel, 2, 5)
        . "-" . substr($tel, 7, 4);
}

/**
 *  Listagem de Clientes
 */
function index()
{
    global $customers;
    $customers = find_all("customers");
}

/**
 *  Cadastro de Clientes
 */
function add()
{
    if (!empty($_POST['customer'])) {
        $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));

        $customer = $_POST['customer'];

        $customer["'cpf_cnpj'"] = preg_replace('/[^0-9]/', '', $customer["'cpf_cnpj'"]);
        $customer["'zip_code'"] = preg_replace('/[^0-9]/', '', $customer["'zip_code'"]);
        $customer["'phone'"] = preg_replace('/[^0-9]/', '', $customer["'phone'"]);
        $customer["'mobile'"] = preg_replace('/[^0-9]/', '', $customer["'mobile'"]);
        $customer["'ie'"] = preg_replace('/[^0-9]/', '', $customer["'ie'"]);

        $customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");

        save('customers', $customer);
        header('location: index.php');
    }
}

/**
 *  Atualizacao/Edicao de Cliente
 */
function edit()
{
    $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_POST['customer'])) {
            $customer = $_POST['customer'];

            $customer["'cpf_cnpj'"] = preg_replace('/[^0-9]/', '', $customer["'cpf_cnpj'"]);
            $customer["'zip_code'"] = preg_replace('/[^0-9]/', '', $customer["'zip_code'"]);
            $customer["'phone'"] = preg_replace('/[^0-9]/', '', $customer["'phone'"]);
            $customer["'mobile'"] = preg_replace('/[^0-9]/', '', $customer["'mobile'"]);
            $customer["'ie'"] = preg_replace('/[^0-9]/', '', $customer["'ie'"]);

            $customer['modified'] = $now->format("Y-m-d H:i:s");

            update('customers', $id, $customer);
            header('location: index.php');
        } else {
            global $customer;
            $customer = find('customers', $id);
        }
    } else {
        header('location: index.php');
    }
}

/**
 *  Visualização de um Cliente
 */
function view($id = null)
{
    global $customer;
    $customer = find("customers", $id);
}

/**
 *  Exclusão de um Cliente
 */
function delete($id = null)
{
    global $customer;
    $customer = remove('customers', $id);

    header('location: index.php');
}
?>
