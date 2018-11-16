// JavaScript Document
jQuery.noConflict();

$(document).ready(function () {
    $(".username").focus(function () {
        $(".user-icon").css("left", "-48px");
    });
    $(".username").blur(function () {
        $(".user-icon").css("left", "0px");
    });

    $(".password").focus(function () {
        $(".pass-icon").css("left", "-48px");
    });
    $(".password").blur(function () {
        $(".pass-icon").css("left", "0px");
    });
});


//função para email válido
function valida() {
    if (document.form.email.value.indexOf('@', 0) == -1 || document.form.email.value.indexOf('.', 0) == -1) {
        alert("E-mail invalido!");
        document.form.email.focus();
        return false;
    }
}
//termina função


//função para limite de senha
function validaform() {
    var senha = document.form.csenha.value;
    if (senha.length < 8) {
        alert("A senha deve conter pelo menos 8 caracteres");
        document.form.csenha.style.borderColor = '#CC3300';
        document.form.rsenha.style.borderColor = '#CC3300';
        document.form.csenha.focus();
        return false;
    } else
    {
        var senha = document.form.csenha.value;
        var csenha = document.form.rsenha.value;
        if (senha != csenha) {
            alert("As senhas não coicidem!");
        } else
        {
            document.form.submit();
        }
    }
}
//termina função


//funçã confirmação de senha
function verificaSenha() {
    var senha = document.form.csenha.value;
    var csenha = document.form.rsenha.value;
    if (senha == csenha) {
        document.getElementById('aviso').value = '*As senhas coincidem!';
        document.form.aviso.style = "border:none; color:green; background:none; font-family: 'Bree Serif', serif; width:180px; color:#009900; visibility:visible;"
        document.form.rsenha.style.borderColor = '#009900';
        document.form.csenha.style.borderColor = '#009900';
    } else {
        document.getElementById('aviso').value = '*As senhas não coincidem!';
        document.form.aviso.style = "border:none; color:red; background:none; font-family: 'Bree Serif', serif; width:180px; color:#CC3300; visibility:visible;"
        document.form.rsenha.style.borderColor = '#CC3300';
        document.form.csenha.style.borderColor = '#CC3300';
    }
}


//funcão para mudar a cor do input caso vazio
function validanome() {
    var nome = document.getElementById('nome').value;
    if (nome > 0) {
        document.form.nome.style.borderColor = '#009900';
    } else {
        alert('O campo nome precisa ser preenchido!');
        document.form.nome.style.borderColor = '#CC3300';
        document.form.nome.focus();
        return false;
    }
}
//funcao mudar a cor do campo dica
function validadica() {
    var dica = document.getElementById('dica').value;
    if (dica > 0) {
        document.form.dica.style.borderColor = '#009900';
    } else {
        alert('O campo dica precisa ser preenchido!');
        document.form.dica.style.borderColor = '#CC3300';
        document.form.dica.focus();
        return false;
    }
}
//termina função
//FUNÇÃO PARA DIMINUIR O INDEX DE ACORDO COM A RESOLUÇÃO
function diminuir() {
    if (screen.width < 1600) {
        document.body.style = 'transform: scale(0.89); overflow: hidden;';
        document.getElementById('wrapper').style = 'left: 40%;';
        document.getElementById('cadastro').style = 'width: 24%; left: 35%;';
        document.getElementById('recuperar').style = 'width: 24%; left: 35%;';
    }
    if (screen.width < 1300) {
        document.body.style = 'transform: scale(0.89); overflow: hidden;';
        document.getElementById('wrapper').style = 'left: 40%;';
        document.getElementById('cadastro').style = 'width: 25.5%; left: 35%; top: 25%;';
        document.getElementById('recuperar').style = 'width: 25.5%; left: 35%; top: 25%';
    }
    if (screen.width < 1200) {
        document.body.style = 'transform: scale(0.87); overflow: hidden;';
        document.getElementById('wrapper').style = 'left: 40%;';
        document.getElementById('cadastro').style = 'width: 31.5%; left: 35%; top: 25%';
        document.getElementById('recuperar').style = 'width: 31.5%; left: 35%; top: 25%';
    }
}
//FUNÇÃO PARA DEIXAR ALGUNS MODAIS RESPONSIVOS
function diminuimodal() {
    if (screen.width < 1600) {
        document.getElementById('ed').style.width = '24%';
    }
    if (screen.width < 1300) {
        document.getElementById('ed').style = 'width: 25.5%; left: 37%';
    }
    if (screen.width < 1200) {
        document.getElementById('ed').style = 'width: 31.5%; left: 32%;';
    }
}
//FUNÇÃO PARA EXIBIR O CALENDÁRIO NO INPUT DE PESQUISA
$(function () {
    $("#datepicker").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });
});
//FUNÇÃO PARA ATUALIZAR IFRAME NA PÁGINA DESPESAS
function atualizaIframepag() {
    window.parent.document.getElementById("pframe").src = 'despesas.php';
}
//FUNÇÃO PARA ATUALIZAR IFRAME NA PÁGINA RECEITAS
function atualizaIframerec() {
    window.parent.document.getElementById("pframe").src = 'receitas.php';
}
//FUNÇÃO PARA ATUALIZAR IFRAME NA PÁGINA PAGAS
function atualizaIframep() {
    window.parent.document.getElementById("pframe").src = 'pagas.php';
}
//FUNÇÃO PARA ATUALIZAR IFRAME NA PÁGINA VENCIDAS
function atualizaIframev() {
    window.parent.document.getElementById("pframe").src = 'vencidas.php';
}
//FUNÇÃO PARA ATUALIZAR IFRAME NA PÁGINA RECEBIDAS
function atualizaIfrarecb() {
    window.parent.document.getElementById("pframe").src = 'recebidas.php';
}
//FUNÇÃO PARA DEIXAR MODAIS RESPONSIVOS
function diminuitamanho() {
    if (screen.width > 1360) {
        document.getElementById('mmodal').style = 'height: 13%';
        document.getElementById('mmodal2').style = 'height: 13%';
    }
}
//FUNÇÃO PARA EXIBIR O CALENDÁRIO NO INPUT DE REGISTRO
$(function () {
    $("#datavenc").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });
});
//FUNÇÃO PARA MODIFICAR OS MODAIS, TORNÁLOS RESPONSIVO
function modificamodal() {
    var modal = document.getElementById('ModalEdit');
    var btnsalva = document.getElementById('atualizacad');
    var btncanc = document.getElementById('fechaat');
    var btnok = document.getElementById('okat');
    var tab = document.getElementById('tab');
    modal.style.height = '210%';
    tab.style.visibility = 'visible';
    btnsalva.style.visibility = 'visible';
    btncanc.style.visibility = 'visible';
    btncanc.style.height = '13%';
    btnsalva.style.height = '13%';
    btnok.style.height = '13%';
    btnsalva.style.visibility = 'visible';
    btncanc.style.top = '83%';
    btnsalva.style.top = '83%';
    btnok.style.top = '83%';
    if (screen.width < 1600) {
        modal.style.height = '260%';
    }
}
//FUNÇÃO PARA CONFERIR SE OS CAMPOS DO FORMULARIO DE REGISTRO ESTÃO PREENCHIDOS
function confere() {
    document.getElementById('gnome').value = document.getElementById('nome').value;
    document.getElementById('validaemail').value = document.getElementById('email').value;
    document.getElementById('valida').submit();
}
//FUNÇÃO PARA DIMINUIR O MODAL NA PÁGINA INÍCIO
function diminuimodaldata() {
    if (screen.width < 1600) {
        document.getElementById('mmodal').style = "width: 30%; height: 25%";
    }
}