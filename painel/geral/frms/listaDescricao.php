<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'CÓDIGO PRODUTO',
    2 => 'DATA CADASTRO'
);

for($i=0;$i<$destaques["num"];$i++){
	$destaques[$i]->imagem = '<img height="50" src="'.$destaques[$i]->imagem.'"/>';
    $data = $objUteis->dataHora($destaques[$i]->dhcadastro);
    $hora_cadastro = explode(':',$data['hora']);
    if($destaques[$i]->dhcadastro){
        $destaques[$i]->dhcadastro = $data['data'].' - '.$hora_cadastro[0].':'.$hora_cadastro[1];
    }
    $data_exibicao = $objUteis->dataHora($destaques[$i]->data_inicio_exibicao);
    $hora_exibicao = explode(':',$data_exibicao['hora']);
    if($destaques[$i]->data_inicio_exibicao){
        $destaques[$i]->data_inicio_exibicao = $data_exibicao['data'].' - '.$hora_exibicao[0].':'.$hora_exibicao[1];
    }
    $data_expiracao = $objUteis->dataHora($destaques[$i]->data_expiracao);
    $hora_expiracao = explode(':',$data_expiracao['hora']);
    if($destaques[$i]->data_expiracao != '0000-00-00 00:00:00'){
        $destaques[$i]->data_expiracao = $data_expiracao['data'].' - '.$hora_expiracao[0].':'.$hora_expiracao[1];
    }else{
        $destaques[$i]->data_expiracao = '';
    }       
}

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'codigo_produto',
    2 => 'dhcadastro'
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
$objForm->sk_formListar('Especificação do produto',$dadosDaTabela,$destaques,$campos,'descricao',$publicar,$alterar,$excluir);

?>
<div>
    <a href="index.php?acao=frmCad&ctrl=destaque" title="" class="button greenB" style="margin: 40px 5px 5px 0px; float: right;"><span>Cadastrar novo</span></a>
</div>
 