<?php

include "../config.php";
include DBAPI;

$users = null;
$user = null;

/**
 * Listagem de Usuários
 */
function index()
{
    global $users;
    $users = find_all("usuarios");
}

/**
 * Visualização de um Usuário
 */
function view($id = null)
{
    global $user;
    $user = find("usuarios", $id);
}

/**
 * Verifica se o nome de usuário já existe
 */
function usuario_existe($login, $id = null)
{
    $database = open_database();

    if ($id) {

        $stmt = $database->prepare(
            "SELECT id FROM usuarios
             WHERE user = ? AND id <> ?
             LIMIT 1"
        );

        $stmt->bind_param("si", $login, $id);

    } else {

        $stmt = $database->prepare(
            "SELECT id FROM usuarios
             WHERE user = ?
             LIMIT 1"
        );

        $stmt->bind_param("s", $login);
    }

    $stmt->execute();

    $result = $stmt->get_result();
    $existe = $result->num_rows > 0;

    $stmt->close();
    close_database($database);

    return $existe;
}

/**
 * Cadastro de Usuário
 */
function add()
{
    if (!empty($_POST['usuario'])) {

        $usuario = $_POST['usuario'];

        $usuario['nome'] = trim($usuario['nome']);
        $usuario['user'] = trim($usuario['user']);

        $senha = $usuario['password'];
        $confirmacao = $usuario['confirm_password'];

        // Campo usado apenas para comparação.
        // Não existe na tabela do banco.
        unset($usuario['confirm_password']);

        if (empty($usuario['nome']) || empty($usuario['user']) || empty($senha)) {

            $_SESSION['message'] = 'Preencha todos os campos obrigatórios.';
            $_SESSION['type'] = 'danger';
            return;
        }

        if (strlen($senha) < 6) {

            $_SESSION['message'] = 'A senha deve possuir pelo menos 6 caracteres.';
            $_SESSION['type'] = 'danger';
            return;
        }

        if ($senha != $confirmacao) {

            $_SESSION['message'] = 'As senhas não coincidem.';
            $_SESSION['type'] = 'danger';
            return;
        }

        if (usuario_existe($usuario['user'])) {

            $_SESSION['message'] = 'Este nome de usuário já está cadastrado.';
            $_SESSION['type'] = 'danger';
            return;
        }

        $usuario['password'] = password_hash(
            $senha,
            PASSWORD_BCRYPT,
            ['cost' => 10]
        );

        // Foto opcional
        if (!empty($_FILES['foto']['name'])) {

            $nomeOriginal = $_FILES['foto']['name'];
            $arquivoTemporario = $_FILES['foto']['tmp_name'];

            $extensao = strtolower(
                pathinfo($nomeOriginal, PATHINFO_EXTENSION)
            );

            if (!in_array($extensao, ['jpg', 'jpeg', 'png'])) {

                $_SESSION['message'] = 'A foto deve estar no formato JPG, JPEG ou PNG.';
                $_SESSION['type'] = 'danger';
                return;
            }

            $nomeFoto = time() . "_" . basename($nomeOriginal);

            $destino = __DIR__ . "/uploads/" . $nomeFoto;

            if (move_uploaded_file($arquivoTemporario, $destino)) {

                $usuario['foto'] = $nomeFoto;

            } else {

                $_SESSION['message'] = 'Não foi possível salvar a foto.';
                $_SESSION['type'] = 'danger';
                return;
            }
        }

        save('usuarios', $usuario);

        header('Location: index.php');
        exit;
    }
}

/**
 * Edição de Usuário
 */
function edit()
{
    global $user;

    if (!isset($_GET['id'])) {
        header('Location: index.php');
        exit;
    }

    $id = $_GET['id'];

    // Carrega sempre o usuário atual.
    // Assim a página continua funcionando mesmo se ocorrer erro de validação.
    $user = find('usuarios', $id);

    if (!$user) {
        $_SESSION['message'] = 'Usuário não encontrado.';
        $_SESSION['type'] = 'danger';

        header('Location: index.php');
        exit;
    }

    if (isset($_POST['usuario'])) {

        $usuario = $_POST['usuario'];

        $usuario['nome'] = trim($usuario['nome']);
        $usuario['user'] = trim($usuario['user']);

        $senha = $usuario['password'];
        $confirmacao = $usuario['confirm_password'];

        unset($usuario['confirm_password']);

        /*
         * O login "admin" identifica o administrador.
         * Portanto, ele nunca pode ser renomeado.
         */
        if ($user['user'] == 'admin') {
            $usuario['user'] = 'admin';
        }

        /*
         * Mantém na tela os valores digitados
         * caso alguma validação falhe.
         */
        $user['nome'] = $usuario['nome'];
        $user['user'] = $usuario['user'];

        if (empty($usuario['nome']) || empty($usuario['user'])) {

            $_SESSION['message'] = 'Preencha todos os campos obrigatórios.';
            $_SESSION['type'] = 'danger';
            return;
        }

        if (usuario_existe($usuario['user'], $id)) {

            $_SESSION['message'] = 'Este nome de usuário já está cadastrado.';
            $_SESSION['type'] = 'danger';
            return;
        }

        /*
         * Nova senha é opcional.
         */
        if (!empty($senha)) {

            if (strlen($senha) < 6) {

                $_SESSION['message'] = 'A senha deve possuir pelo menos 6 caracteres.';
                $_SESSION['type'] = 'danger';
                return;
            }

            if ($senha != $confirmacao) {

                $_SESSION['message'] = 'As senhas não coincidem.';
                $_SESSION['type'] = 'danger';
                return;
            }

            $usuario['password'] = password_hash(
                $senha,
                PASSWORD_BCRYPT,
                ['cost' => 10]
            );

        } else {

            // Senha vazia = mantém a senha atual.
            unset($usuario['password']);
        }

        /*
         * Nova foto opcional.
         */
        if (!empty($_FILES['foto']['name'])) {

            $nomeOriginal = $_FILES['foto']['name'];
            $arquivoTemporario = $_FILES['foto']['tmp_name'];

            $extensao = strtolower(
                pathinfo($nomeOriginal, PATHINFO_EXTENSION)
            );

            if (!in_array($extensao, ['jpg', 'jpeg', 'png'])) {

                $_SESSION['message'] = 'A foto deve estar no formato JPG, JPEG ou PNG.';
                $_SESSION['type'] = 'danger';
                return;
            }

            $nomeFoto = time() . "_" . basename($nomeOriginal);

            $destino = __DIR__ . "/uploads/" . $nomeFoto;

            if (move_uploaded_file($arquivoTemporario, $destino)) {

                /*
                 * Remove a foto anterior caso exista.
                 */
                if (!empty($user['foto'])) {

                    $fotoAnterior = __DIR__ . "/uploads/" . $user['foto'];

                    if (file_exists($fotoAnterior)) {
                        unlink($fotoAnterior);
                    }
                }

                $usuario['foto'] = $nomeFoto;

            } else {

                $_SESSION['message'] = 'Não foi possível salvar a foto.';
                $_SESSION['type'] = 'danger';
                return;
            }
        }

        update('usuarios', $id, $usuario);

        header('Location: index.php');
        exit;
    }
}

/**
 * Exclusão de Usuário
 */
function delete($id = null)
{
    global $user;

    $user = find('usuarios', $id);

    if (!$user) {
        $_SESSION['message'] = 'Usuário não encontrado.';
        $_SESSION['type'] = 'danger';

        header('location: index.php');
        exit;
    }

    /*
     * O usuário "admin" é o administrador do sistema.
     * Ele não pode ser excluído.
     */
    if ($user['user'] == 'admin') {
        $_SESSION['message'] = 'O usuário administrador não pode ser excluído.';
        $_SESSION['type'] = 'warning';

        header('location: index.php');
        exit;
    }

    /*
     * Remove a foto do usuário, caso exista.
     */
    if (!empty($user['foto'])) {

        $arquivo = __DIR__ . '/uploads/' . $user['foto'];

        if (file_exists($arquivo)) {
            unlink($arquivo);
        }
    }

    remove('usuarios', $id);

    header('location: index.php');
    exit;
}
?>