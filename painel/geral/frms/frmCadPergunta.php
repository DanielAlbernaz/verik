<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar Pergunta';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=pergunta';
$avisodoformulario = 'Esta página você cadastra as pergunta.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Pergunta','pergunta','',true,'Aqui você escreve uma pergunta.');

//Monta o array com as categorias cadastradas no banco
$optionsCategoria[] = '<option value="" selected="selected"></option>';
for($i=0; $i < count($categoria) -1; $i++){
    $optionsCategoria[] = '<option value='.$categoria[$i]->id.'>'.$categoria[$i]->nome.'</option>';
}
$objForm->sk_formSelect('Categoria', 'id_categoria_pergunta', $optionsCategoria, true, 'Selecione uma categoria');


$objForm->sk_formTextHTML('Resposta','resposta',true,'Aqui você escreve uma resposta para a pergunta.');

//Cria status
$optionsStatus[] = '<option value=""></option>';
$optionsStatus[] = '<option value="1" selected="selected">Ativo</option>';
$optionsStatus[] = '<option value="0">Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');


$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.');

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.');

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.');


//Verfica se o usuário e Administrador
if($permissao->cadastrar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>