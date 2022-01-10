<!-- <h1>Cadastro paciente</h1> -->
<br><br><br>
<div>
<table>
    <a class="waves-effect waves-light btn-small" href="index.php?acao=carregarFormulario">Novo</a> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="waves-effect waves-light btn-small" href="index.php?acao=FormularioProfissao">Cadastro de profissão</a> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="waves-effect waves-light btn-small" href="./index.php">Listar todos</a>
    <br>
    <thead> <form action="index.php" method="get">
    <input type="hidden" value="buscar" name="acao">
    Pesquisar:
    <br>
    exempo de busca (Pela Data: dd/mm/aaaa || Pelo Nome : joao)
    <input type="text" placeholder="Ex.:dd/mm/aaaa || joao" data-mask="0000-00-00" name="dadosPaciente"> 
                </form>
            </td>
        <tr>
            <th>Nome</th>
            <th>Data</th>
            <th>E-mail</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pacienteController->viewData->listaDePacientes as $paciente) { ?>
        <tr>
            <td>
            <a href="index.php?acao=carregarFormularioPreenchido&nomeDoArquivo=<?= $paciente->id?>" >
                <?php echo $paciente->nomePaciente?>
            </a>
            </td>

            <td>
                <?php echo  date('d/m/Y',strtotime($paciente->data));?>
            </td>

            <td>
                <?php echo $paciente->email ;?>
            </td>

            <td>
                <i value="deletar" class="material-icons">
                <a idPaciente="<?= $paciente->id ?>" id="delete" href ="#">delete</a></i>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>
</div>
<script type="text/javascript" src="lista.js"></script>