/**
 * Passa os dados do cliente para o Modal, e atualiza o link para exclusão
 */
$('#delete-modal').on('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var modal = $(this);

    var id = button.getAttribute('data-id');
    var customer = button.getAttribute('data-customer');

    //Os cadastros de motos não estavam funcionando...
    //console.log('MAIN.JS NOVO CARREGADO');
    //console.log('Botão:', button);
    //console.log('ID:', id);
    //console.log('Cliente:', customer);

    if (id) {
        modal.find('.modal-title').text('Excluir Moto #' + id);
        modal.find('.modal-body').text('Deseja realmente excluir esta moto?');
        modal.find('#confirm').attr('href', 'delete.php?id=' + id);
    }

    if (customer) {
        modal.find('.modal-title').text('Excluir Cliente #' + customer);
        modal.find('.modal-body').text('Deseja realmente excluir este cliente?');
        modal.find('#confirm').attr('href', 'delete.php?id=' + customer);
    }
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