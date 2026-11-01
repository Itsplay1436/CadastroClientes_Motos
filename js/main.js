/**
 * Passa os dados do registro para o Modal de exclusão
 */
$('#delete-modal').on('show.bs.modal', function (event) {

    var button = event.relatedTarget;
    var modal = $(this);

    var id = button.getAttribute('data-id');
    var tipo = button.getAttribute('data-tipo');
    var nome = button.getAttribute('data-nome');

    if (tipo == 'cliente') {

        modal.find('.modal-title').text('Excluir Cliente');

        modal.find('.modal-body').text(
            'Deseja realmente excluir o cliente ' + nome + '?'
        );

    } else if (tipo == 'moto') {

        modal.find('.modal-title').text('Excluir Moto');

        modal.find('.modal-body').text(
            'Deseja realmente excluir a moto ' + nome + '?'
        );

    } else if (tipo == 'usuario') {

        modal.find('.modal-title').text('Excluir Usuário');

        modal.find('.modal-body').text(
            'Deseja realmente excluir o usuário ' + nome + '?'
        );

    }

    modal.find('#confirm').attr(
        'href',
        'delete.php?id=' + id
    );

});

/**
 * Alterna entre o modo claro e escuro
 */
var botaoTema = document.getElementById('toggleTema');
var iconeTema = document.getElementById('iconeTema');
var textoTema = document.getElementById('textoTema');

function atualizarBotaoTema() {
    var tema = document.documentElement.getAttribute('data-bs-theme');

    if (tema == 'dark') {
        iconeTema.className = 'fa-solid fa-sun';
        textoTema.innerText = 'Modo claro';
    } else {
        iconeTema.className = 'fa-solid fa-moon';
        textoTema.innerText = 'Modo escuro';
    }
}

if (botaoTema) {
    atualizarBotaoTema();

    botaoTema.addEventListener('click', function () {
        var tema = document.documentElement.getAttribute('data-bs-theme');
        var novoTema = tema == 'dark' ? 'light' : 'dark';

        document.documentElement.setAttribute('data-bs-theme', novoTema);
        localStorage.setItem('tema', novoTema);
        atualizarBotaoTema();
    });
}

/**
 * Mascaras dos campos do formulario
 */
function somenteNumeros(valor) {
    return valor.replace(/\D/g, '');
}

function mascaraCpfCnpj(campo) {
    var valor = somenteNumeros(campo.value).substring(0, 14);

    if (valor.length <= 11) {
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    } else {
        valor = valor.replace(/(\d{2})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1/$2');
        valor = valor.replace(/(\d{4})(\d{1,2})$/, '$1-$2');
    }

    campo.value = valor;
}

function mascaraCep(campo) {
    var valor = somenteNumeros(campo.value).substring(0, 8);
    valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
    campo.value = valor;
}

function mascaraTelefone(campo) {
    var valor = somenteNumeros(campo.value).substring(0, 10);
    valor = valor.replace(/(\d{2})(\d)/, '($1) $2');
    valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
    campo.value = valor;
}

function mascaraCelular(campo) {
    var valor = somenteNumeros(campo.value).substring(0, 11);
    valor = valor.replace(/(\d{2})(\d)/, '($1) $2');
    valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
    campo.value = valor;
}

function mascaraIe(campo) {
    var valor = somenteNumeros(campo.value).substring(0, 12);

    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');

    campo.value = valor;
}

var cpfCnpj = document.getElementById('cpf_cnpj');
var cep = document.getElementById('zip_code');
var telefone = document.getElementById('phone');
var celular = document.getElementById('mobile');
var ie = document.getElementById('ie');

if (cpfCnpj) {
    mascaraCpfCnpj(cpfCnpj);
    cpfCnpj.addEventListener('input', function () {
        mascaraCpfCnpj(this);
    });
}

if (cep) {
    mascaraCep(cep);
    cep.addEventListener('input', function () {
        mascaraCep(this);
    });
}

if (telefone) {
    mascaraTelefone(telefone);
    telefone.addEventListener('input', function () {
        mascaraTelefone(this);
    });
}

if (celular) {
    mascaraCelular(celular);
    celular.addEventListener('input', function () {
        mascaraCelular(this);
    });
}

if (ie) {
    mascaraIe(ie);
    ie.addEventListener('input', function () {
        mascaraIe(this);
    });
}

/**
 * Mascara da placa da moto
 */
function mascaraPlaca(campo) {
    var valor = campo.value.replace(/[^A-Za-z0-9]/g, '').substring(0, 7);
    campo.value = valor.toUpperCase();
}

var placa = document.getElementById('placa');

if (placa) {
    mascaraPlaca(placa);
    placa.addEventListener('input', function () {
        mascaraPlaca(this);
    });
}

/**
 * Preview da foto da moto
 */
var foto = document.getElementById('foto');
var previewFoto = document.getElementById('previewFoto');

if (foto && previewFoto) {
    foto.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            previewFoto.src = URL.createObjectURL(this.files[0]);
        }
    });
}

/**
 * Preview da foto do usuário
 */
var fotoUsuario = document.getElementById('fotoUsuario');
var previewUsuario = document.getElementById('previewUsuario');

if (fotoUsuario && previewUsuario) {

    fotoUsuario.addEventListener('change', function () {

        if (this.files && this.files[0]) {
            previewUsuario.src = URL.createObjectURL(this.files[0]);
        }

    });
}


/**
 * Confirmação da senha do usuário
 */
var senhaUsuario = document.getElementById('senhaUsuario');
var confirmarSenhaUsuario = document.getElementById('confirmarSenhaUsuario');

function validarSenhasUsuario()
{
    if (senhaUsuario && confirmarSenhaUsuario) {

        if (
            confirmarSenhaUsuario.value != '' &&
            senhaUsuario.value != confirmarSenhaUsuario.value
        ) {

            confirmarSenhaUsuario.setCustomValidity(
                'As senhas não coincidem.'
            );

        } else {

            confirmarSenhaUsuario.setCustomValidity('');

        }
    }
}

if (senhaUsuario && confirmarSenhaUsuario) {

    senhaUsuario.addEventListener('input', validarSenhasUsuario);

    confirmarSenhaUsuario.addEventListener(
        'input',
        validarSenhasUsuario
    );
}