$(document).ready(function() {  
    $("#delete").click(function() {
        if (confirm(`Voce confirma a exclusão do paciente ?`)) {
            validarDelete($(this)[0].getAttribute('idPaciente'));
        }
    });
}); 

function validarDelete(atributo)
{      
    var link = document.getElementById("delete");
    link.setAttribute("href", `index.php?acao=deletar&idProfissao=`+atributo);
}
