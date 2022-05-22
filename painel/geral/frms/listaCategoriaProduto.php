<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'CATEGORIA',
    2 => 'DATA CADASTRO'
);

for($i=0;$i<$categoriasProduto["num"];$i++){
    $data = $objUteis->dataHora($categoriasProduto[$i]->dhcadastro);
    $hora_cadastro = explode(':',$data['hora']);
    if($categoriasProduto[$i]->dhcadastro){
        $categoriasProduto[$i]->dhcadastro = $data['data'].' - '.$hora_cadastro[0].':'.$hora_cadastro[1];
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
$objForm->sk_formListar('Categorias Produto',$dadosDaTabela,$categoriasProduto,$campos,'categoriaproduto',$publicar,$alterar,$excluir);

?>
<div>
    <a href="index.php?acao=frmCad&ctrl=categoriaproduto" title="" class="button greenB" style="margin: 40px 5px 5px 0px; float: right;"><span>Cadastrar novo</span></a>
</div>
 