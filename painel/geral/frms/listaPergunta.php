<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'PERGUNTA',
    2 => 'DT CADASTRO',
    3 => 'DT. INÍCIO EXIBIÇÃO',
    4 => 'DT. FIM EXIBIÇÃO',
);



for($i=0;$i<$perguntas["num"];$i++){
    $data = $objUteis->dataHora($perguntas[$i]->dhcadastro);
    $hora_cadastro = explode(':',$data['hora']);
    if($perguntas[$i]->dhcadastro){
        $perguntas[$i]->dhcadastro = $data['data'].' - '.$hora_cadastro[0].':'.$hora_cadastro[1];
    }
    $data_exibicao = $objUteis->dataHora($perguntas[$i]->data_inicio_exibicao);
    $hora_exibicao = explode(':',$data_exibicao['hora']);
    if($perguntas[$i]->data_inicio_exibicao){
        $perguntas[$i]->data_inicio_exibicao = $data_exibicao['data'].' - '.$hora_exibicao[0].':'.$hora_exibicao[1];
    }
    
    $data_expiracao = $objUteis->dataHora($perguntas[$i]->data_expiracao);
    $hora_expiracao = explode(':',$data_expiracao['hora']);
    if($perguntas[$i]->data_expiracao != '0000-00-00 00:00:00' && $perguntas[$i]->data_expiracao != null){
        $perguntas[$i]->data_expiracao = $data_expiracao['data'].' - '.$hora_expiracao[0].':'.$hora_expiracao[1];
    }else{
        $perguntas[$i]->data_expiracao = '';
    }       
}

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'pergunta',
    2 => 'dhcadastro',
    3 => 'data_inicio_exibicao',
    4 => 'data_expiracao',

);

$publicar = 0;
$alterar = 0;
$excluir = 0;

if($permissao->publicar=="1"){
    $publicar = 0;
}
if($permissao->alterar=="1"){
    $alterar = 1;
}
if($permissao->excluir=="1"){
    $excluir = 1;
}

//Inicia a listagem do formulário
$objForm->sk_formListar('Perguntas Frequentes',$dadosDaTabela,$perguntas,$campos,'pergunta',$publicar,$alterar,$excluir);

?>
<div>
    <a href="index.php?acao=frmCad&ctrl=pergunta" title="" class="button greenB" style="margin: 40px 5px 5px 0px; float: right;"><span>Cadastrar novo</span></a>
</div>
 