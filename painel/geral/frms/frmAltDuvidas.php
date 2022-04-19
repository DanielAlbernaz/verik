    
<?php
//Informações do Formalário
$nomedoformulario = 'Alterar Informações';
$acaodoformulario = 'index.php?acao=alterar&ctrl=duvidas';
$avisodoformulario = 'Esta página você altera as Informações';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_formText('Título','titulo','',true,'Aqui digita um título.', $duvidasForm->titulo);

$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você escreve o texto.', $duvidasForm->texto);

//Status
$optionsStatus[] = '<option value="1"'. ($duvidasForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($duvidasForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $objUteis->converteDataHora($duvidasForm->dhcadastro));

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($duvidasForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($duvidasForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($duvidasForm->data_expiracao != 0 ? $objUteis->converteDataHora($duvidasForm->data_expiracao) : ''));

//Cria um input hidden
$objForm->sk_formHidden('id',$duvidasForm->id);


//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>