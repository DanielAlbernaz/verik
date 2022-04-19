    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar o link do vídeo home';
$acaodoformulario = 'index.php?acao=alterar&ctrl=video_home';
$avisodoformulario = 'Esta página você altera o link do vídeo da home';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text

$objForm->sk_formTextUrl('Link do vídeo','link','',false,'Link para o vídeo a ser exibido na home.' ,$termoForm->link);


//Status
$optionsStatus[] = '<option value="1"'. ($termoForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($termoForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

//Cria um input hidden
$objForm->sk_formHidden('id',$termoForm->id);


//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>