<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'TITULO'
);

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'titulo'
);

$publicar = 0;
$alterar = 0;
$excluir = 0;

if($permissao->publicar=="1"){
    $publicar = 1;
}
if($permissao->alterar=="1"){
    $alterar = 1;
}
if($permissao->excluir=="1"){
    $excluir = 1;
}

//Inicia a listagem do formulário
$objForm->sk_formListar('Caracteristica',$dadosDaTabela,$caracteristica,$campos,'caracteristica',$publicar,$alterar,$excluir);

?>
 