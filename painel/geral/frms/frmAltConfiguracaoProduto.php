    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Informações de configurações dos produtos';
$acaodoformulario = 'index.php?acao=alterar&ctrl=configuracaoproduto';
$avisodoformulario = 'Esta página você altera as configurações dos produtos';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$optionsAbaPrecoExibir[] = '<option value="1"'. ($configuracaoprodutoForm->exibir_valor_logado == 1 ? 'selected="selected"' : '' ).'>Sim</option>';
$optionsAbaPrecoExibir[] = '<option value="0"'. ($configuracaoprodutoForm->exibir_valor_logado == 0 ? 'selected="selected"' : '' ).'>Não</option>';

$objForm->sk_formSelect('Exibir preço somente para usuários logados ?', 'exibir_valor_logado', $optionsAbaPrecoExibir, true, 'Selecione uma opção');

//Cria um input hidden
$objForm->sk_formHidden('id',$configuracaoprodutoForm->id);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){   
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>


