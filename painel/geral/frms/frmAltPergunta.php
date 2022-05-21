    
<?php

//Informações do Formalário
$nomedoformulario = 'Alterar Pergunta';
$acaodoformulario = 'index.php?acao=alterar&ctrl=pergunta';
$avisodoformulario = 'Esta página você altera as perguntas cadastradas';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Pergunta','pergunta','',true,'Aqui você um titulo para o pergunta.',$perguntaForm->pergunta);

for($i=0; $i < $categoria['num']; $i++){    
    if($categoria[$i]->id == $perguntaForm->id_categoria_pergunta ){             
        $nome_categoria = $categoria[$i]->nome;
    }   
}

$optionsCategoria[] = '<option value="" ></option>';
$optionsCategoria[] = '<option value='.$perguntaForm->id_categoria_pergunta.' selected="selected" >'.$nome_categoria.'</option>';
foreach($categoria as $key => $val){
    if($val->id <> NULL){
        if($val->id <> $perguntaForm->id_categoria_pergunta){
            $optionsCategoria[] = '<option value='.$val->id.'>'.$val->nome.'</option>';
        }       
    }  
}

$objForm->sk_formSelect('Categoria', 'id_categoria_pergunta', $optionsCategoria, true, 'Selecione uma categoria');


$objForm->sk_formTextHTML('Resposta','resposta',true,'Aqui você escreve uma resposta para a pergunta.',$perguntaForm->resposta);

//Status
$optionsStatus[] = '<option value="1"'. ($perguntaForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($perguntaForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $objUteis->converteDataHora($perguntaForm->dhcadastro));

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($perguntaForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($perguntaForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($perguntaForm->data_expiracao != 0 ? $objUteis->converteDataHora($perguntaForm->data_expiracao) : ''));


//Cria um input hidden
$objForm->sk_formHidden('id',$perguntaForm->id);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>