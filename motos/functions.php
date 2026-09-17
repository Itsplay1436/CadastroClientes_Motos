<?php
include "../config.php";
include DBAPI;

$motos = null;
$moto = null;

function formatadata($data, $formato)
{
    $dt = new DateTime($data, new DateTimeZone("-0300"));
    return $dt->format($formato);
}

function index()
{
    global $motos;
    $motos = find_all("motos");
}

function view($id = null)
{
    global $moto;
    $moto = find("motos", $id);
}

function add()
{
    if (!empty($_POST['moto'])) {
        $moto = $_POST['moto'];
        $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));

        $moto['placa'] = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $moto['placa']));
        $moto['datacad'] = $today->format("Y-m-d H:i:s");

        if (!empty($_FILES['foto']['name'])) {
            $extensao = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

            if ($extensao == 'jpg' || $extensao == 'jpeg' || $extensao == 'png') {
                $nomeFoto = time() . "_" . $_FILES['foto']['name'];
                $destino = __DIR__ . "/uploads/" . $nomeFoto;

                if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                    $moto['foto'] = $nomeFoto;
                }
            } else {
                $_SESSION['message'] = 'A foto deve estar no formato JPG, JPEG ou PNG.';
                $_SESSION['type'] = 'danger';
                return;
            }
        }

        save('motos', $moto);
        header('location: index.php');
    }
}

function edit()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_POST['moto'])) {
            $moto = $_POST['moto'];
            $moto['placa'] = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $moto['placa']));

            if (!empty($_FILES['foto']['name'])) {
                $extensao = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

                if ($extensao == 'jpg' || $extensao == 'jpeg' || $extensao == 'png') {
                    $nomeFoto = time() . "_" . $_FILES['foto']['name'];
                    $destino = __DIR__ . "/uploads/" . $nomeFoto;

                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                        $moto['foto'] = $nomeFoto;
                    }
                } else {
                    $_SESSION['message'] = 'A foto deve estar no formato JPG, JPEG ou PNG.';
                    $_SESSION['type'] = 'danger';
                    return;
                }
            }

            update('motos', $id, $moto);
            header('location: index.php');
        } else {
            global $moto;
            $moto = find('motos', $id);
        }
    } else {
        header('location: index.php');
    }
}

function delete($id = null)
{
    global $moto;
    $moto = find('motos', $id);

    if ($moto && !empty($moto['foto'])) {
        $arquivo = __DIR__ . '/uploads/' . $moto['foto'];
        if (file_exists($arquivo)) {
            unlink($arquivo);
        }
    }

    remove('motos', $id);
    header('location: index.php');
}
?>
