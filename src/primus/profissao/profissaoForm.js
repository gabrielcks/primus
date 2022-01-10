$(document).ready(function() {  
    $("#btn-salvar").click(function() {
        validar();
    });
});

function validarProfissao()
{
    var profissao = document.getElementById("nome").value.trim();
    if (profissao === "") {
        return false
    }
}

function validar()
{
    try {

        if (validarProfissao() === false) {
            throw 'Campo profissao não pode estar em branco';
        }

        document.formulario.submit();
        
    } catch(erro) {
          alert(`Erro: `+erro);
    }
}