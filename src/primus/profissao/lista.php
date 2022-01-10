<!-- <h1>Cadastro Profissão</h1> -->
<br><br><br>
<div>
<table>
    <a class="waves-effect waves-light btn-small" href="index.php?acao=FormularioProfissao">Cadastro de profissão</a> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="waves-effect waves-light btn-small" href="./index.php">Listar todos</a>
    <br>
    <thead> <form action="index.php" method="get">
    <input type="hidden" value="buscar" name="acao">
    Pesquisar:
    <br>
    <input type="text" placeholder="Ex.:Programador" data-mask="0000-00-00" name="dadosProfissao"> 
                </form>
            </td>
        <tr>
            <th>Nome</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($profissaoController->viewData->listaDeProfissao as $profissao) { ?>
        <tr>
            <td>
            <a href="index.php?acao=carregarFormularioPreenchido&nomeDoArquivo=<?=$profissao->id?>" >
                <?php echo $profissao->nome?>
            </a>
            </td>

            <td>
                <i value="deletar" class="material-icons">
                <a idProfissao="<?= $profissao->id ?>" id="delete" href ="#">delete</a></i>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>
</div>
<script type="text/javascript" src="lista.js"></script>