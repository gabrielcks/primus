<!-- <h1>Cadastro paciente</h1> -->
<br><br><br>
<div class="input-field col s12">
    <form action="index.php" method="post" name="formulario">
        <input type="hidden" value="salvar" name="acao">
        <label for="id"></label>
        <input type="hidden" name="id"value="<?= $paciente->id?>">
        <br>

        <label for="first_name">Nome do paciente :</label>
        <input type="text" name="nomePaciente" id="nomePaciente" class="validate" 
        placeholder="Jose" value="<?= $paciente->nomePaciente?>"> <br>

        <label for="first_name">CPF :</label>
        <input type="text" name="cpf" id="cpf" maxlength="11" value="<?= $paciente->cpf?>"> <br>

        <label for="email">Email</label>
        <br><input type="email" name="email" id="email" 
        placeholder="jose@localhost.com" value="<?= $paciente->email?>"> <br>

        <label>
            <input type="radio" name="sexo" value="M" <?php if ($paciente->sexo ==='M') {echo "checked";};?> >
            <span>M</span>
        </label>
        
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>
            <input type="radio" name="sexo" value="F" <?php if ($paciente->sexo ==='F') {echo "checked";}; ?>> 
            <span>F</span>
        </label>
        <br>
        <label for="data_nascimento">Data de nascimento :</label>
        <input  type="date" name="data" id="data" placeholder="01/01/1999" value="<?= $paciente->data?>"><br>

        <label for="data_nascimento">Estado Civil :</label>
        <select id="estadoCivil" name="estadoCivil" class="browser-default">
            <option  value="selecione" <?php if ($paciente->estadoCivil === "selecione") { echo "selecione";}; ?>
            >Selecione(a)</option>
            <option  value="solteiro" <?php if ($paciente->estadoCivil === "solteiro") { echo "selected";}; ?>
            >Solteiro(a)</option>
            <option  value="casado" <?php if ($paciente->estadoCivil === "casado") { echo "selected";}; ?>
            >Casado(a)</option>
            <option  value="divorciado" <?php if ($paciente->estadoCivil === "divorciado") { echo "selected";}; ?>
            >Divorciado(a)</option>
            <option value="viuvo"<?php if ($paciente->estadoCivil === "viuvo") { echo "selected";}; ?>
            >Viúvo(a)</option>
            <option  value="separado" <?php if ($paciente->estadoCivil === "separado") { echo "selected"; }; ?>
            >Separado(a)</option>
        </select>

        <label>Profissão :</label>
        <select id="profissao" name="profissao" class="browser-default">
            <option  value="selecione"?>Selecione</option>
            <?php foreach ($profissao as $profissao) {?> 
                <option  value="<?php echo $profissao->id ?>" 
                <?php if ($paciente->id_profissao_fk === $profissao->id){ echo "selected"; };?> > 
                <?php echo $profissao->nome ?></option>
            <?php }?>
        </select>

        <br> 
        <button  class="waves-effect waves-light btn-small" type="button" value="salvar" id="btn-salvar">
        salvar</button>
        <a type="button" id="btn-cancelar" class="waves-effect waves-light btn-small"  href ="./index.php">
        cancelar</a>
    
    </form>
</div>
<script type="text/javascript" src="form.js"></script>
