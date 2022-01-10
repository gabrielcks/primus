$(document).ready(function() {  
    $("#btn-salvar").click(function() {
        validar();
    });
    $('select').formSelect();
  });

function validarNome() 
{
    var nome = document.getElementById("nomePaciente").value.trim();
    if (nome.length < 4 || nome.length > 100) {
        return false;
    }
}

function validarEmail()
{
    if (document.getElementById("email").value === "") {
        return false;
    }

    var email = document.getElementById("email").value.trim();
    var exp = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+?$/;

    if (exp.test(email) === false) {
        return false;
    }
        
}

function validaData() 
{
   
    var data = document.getElementById("data").value;
    if (document.getElementById("data").value.length !==10) {
        return false;
    }

    data = data.replace(/\//g, "-"); 
    var dataArray = data.split("-");
    data = dataArray[2]+"-"+dataArray[1]+"-"+dataArray[0]; 
    var hoje = new Date();
    var nasc  = new Date(data+"T00:00");

    if (hoje < nasc) {
        return false;
    }
}

function validaSexo() 
{
    if (document.getElementsByName("sexo")[0].checked === false 
    && document.getElementsByName("sexo")[1].checked === false) {
        return false;
    }
}

function cpf() 
{
    var cpf = document.getElementById("cpf").value;
    var Soma = 0;
    var Resto;
    var strCPF = String(cpf).replace(/[^\d]/g, '');

    if (strCPF.length !== 11) {
        return false;
    }

    if ([
        '00000000000',
        '11111111111',
        '22222222222',
        '33333333333',
        '44444444444',
        '55555555555',
        '66666666666',
        '77777777777',
        '88888888888',
        '99999999999',
        ].indexOf(strCPF) !== -1) {
        return false;
    }

    for (i=1; i<=9; i++) {
        Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i)
    }

    Resto = (Soma * 10) % 11
    if ((Resto == 10) || (Resto == 11)) 
    Resto = 0;

    if (Resto != parseInt(strCPF.substring(9, 10)) )
    return false;

    Soma = 0;

    for (i = 1; i <= 10; i++) {
        Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    }

    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) { 
        Resto = 0;
    }

    if (Resto != parseInt(strCPF.substring(10, 11) )) {
        return false;
    }
    return true;
}

function validarEstadoCivil() 
{
    var estadoCivil = document.getElementById("estadoCivil").value;
    switch (estadoCivil) {
    case 'solteiro' :
        return true;
    case 'casado' :
        return true;
    case 'divorciado':
        return true;
    case 'viuvo':
        return true;
    case 'separado':
        return true;
    default:
        return false;
    }
}

function validar()
{
    try {
        if (validarNome() === false) {
            throw 'Campo nome precisa ter mais que 4 caracteres e menos que 100 e não pode estar em branco';
        }

        if (validarEmail() === false) {
            throw 'E-mail Invalido';
        }

        if (validaData() === false) {
            throw 'data invalida';
        }

        if (validaSexo() === false) {
            throw "Preencha o campo sexo";
        }
        if (cpf() === false) {
            throw 'Cpf invalido';
        }
        if (validarEstadoCivil() === false) {
            throw 'Preencha o campo Estado Civil';
        }

        document.formulario.submit();
        
    } catch(erro) {
          alert(`Erro: `+erro);
    }
}
