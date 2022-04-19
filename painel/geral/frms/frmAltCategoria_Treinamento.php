    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Categoria';
$acaodoformulario = 'index.php?acao=alterar&ctrl=categoria';
$avisodoformulario = 'Esta página você altera as categorias cadastradas';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Categoria','nome_categoria','',true,'Aqui você um titulo para o categoria.',$categoriaForm->nome_categoria);

$objForm->sk_formTextPequeno('Ordem exibição','ordem','',true,'Ordem exibição EX: 0, 1, 2.',$categoriaForm->ordem);
//Status
$optionsStatus[] = '<option value="1"'. ($categoriaForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($categoriaForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $objUteis->converteDataHora($categoriaForm->dhcadastro));

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($categoriaForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($categoriaForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($categoriaForm->data_expiracao != 0 ? $objUteis->converteDataHora($categoriaForm->data_expiracao) : ''));



//Cria um input hidden
$objForm->sk_formHidden('id',$categoriaForm->id);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>