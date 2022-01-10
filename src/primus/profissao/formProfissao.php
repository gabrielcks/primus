<!-- <h1>Cadastro Profissão</h1> -->
<br> <br> <br>
<div class="input-field col s12">
    <form action="index.php" method="post" name="formulario">
        <input type="hidden" value="salvar" name="acao"value="<?= $profissao->id?>">
        <input type="text" name="nome" id="nome" value="<?= $profissao->nome?>">
        <input type="hidden" name="id"value="<?= $profissao->id?>">

        <select name="status" id="status" class="browser-default">
            <option name="ativo" id="ativo" <?php if ($profissao->status === "ativo") { echo "selected";}; ?>
            >ativo</option>
            <option name="inativo" id="inativo" <?php if ($profissao->status === "inativo") { echo "selected";}; ?>
            >inativo</option>
        </select>

        <br>
        <button  class="waves-effect waves-light btn-small" type="button" value="salvar" id="btn-salvar">
        salvar</button>
        <a type="button" id="btn-cancelar" class="waves-effect waves-light btn-small"  href ="index.php">
        cancelar</a>
    
    </form>
</div>
<script type="text/javascript" src="profissaoForm.js"></script>