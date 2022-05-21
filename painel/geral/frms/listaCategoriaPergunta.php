<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'CATEGORIA',
    2 => 'DATA CADASTRO'
);

for($i=0;$i<$categorias["num"];$i++){
    $data = $objUteis->dataHora($categorias[$i]->dhcadastro);
    $hora_cadastro = explode(':',$data['hora']);
    if($categorias[$i]->dhcadastro){
        $categorias[$i]->dhcadastro = $data['data'].' - '.$hora_cadastro[0].':'.$hora_cadastro[1];
    }   
}

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'nome',
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
$objForm->sk_formListar('Categorias',$dadosDaTabela,$categorias,$campos,'categoriapergunta',$publicar,$alterar,$excluir);

?>
<div>
    <a href="index.php?acao=frmCad&ctrl=categoriapergunta" title="" class="button greenB" style="margin: 40px 5px 5px 0px; float: right;"><span>Cadastrar novo</span></a>
</div>
 