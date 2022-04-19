    
<?php


//Informações do Formalário
$nomedoformulario = 'Visualizar informações preenchidas no formulário';
$acaodoformulario = 'index.php?acao=alterar&ctrl=ouvidoria';
//$avisodoformulario = 'Esta página você altera o banner cadastrado.';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
if($ouvidoriaForm->razao_social){
    $objForm->sk_formText('Razão Social','razao_social','',true,'',$ouvidoriaForm->razao_social, 'readonly');
}

if($ouvidoriaForm->nome){
    $objForm->sk_formText('Nome','nome','',true,'',$ouvidoriaForm->nome, 'readonly');
}

$objForm->sk_formText('Telefone','telefone','',true,'',$ouvidoriaForm->telefone, 'readonly');

$objForm->sk_formText('Email','email','',true,'',$ouvidoriaForm->email, 'readonly');

$objForm->sk_formData('Data do agendamento','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $objUteis->converteDataHora($ouvidoriaForm->data_envio), 'readonly');

$objForm->sk_formTextPequeno('Horário','horario','',true,'',$ouvidoriaForm->horario, 'readonly');

$objForm->sk_formText('Médico','medico','',true,'',$ouvidoriaForm->medico, 'readonly');

$objForm->sk_formText('Especialidade','especialidade','',true,'',$ouvidoriaForm->especialidade, 'readonly');

//Cria um input hidden
$objForm->sk_formHidden('id',$ouvidoriaForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$ouvidoriaForm->imagem);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>

