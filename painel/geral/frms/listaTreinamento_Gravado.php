<?php
$optionsSeguimento[] = '<option value="" >Todos</option>';
for($i = 0 ; $i < $categoria['num']; $i++){
    $optionsSeguimento[] = '<option value="'.$categoria[$i]->id.'" '.($categoria[$i]->id == $idCategoria ? 'selected="selected"' : '').' >'.$categoria[$i]->nome_categoria.'</option>';
}
$objForm->sk_formSelect('Listar por seguimento', 'categoria" onchange="searchTreinamento(); ', $optionsSeguimento, false, 'Selecione uma opção');


//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'TÍTULO',
    2 => 'DATA TREINAMENTO',
    3 => 'HORA TREINAMENTO',
    4 => 'ORDEM'
);

for($i=0;$i<$treinamentosGravado["num"];$i++){	
    $data_exibicao = $objUteis->converteData($treinamentosGravado[$i]->data_treinamento);
    
    if($treinamentosGravado[$i]->data_treinamento){
        $treinamentosGravado[$i]->data_treinamento = $data_exibicao;
    }   
}

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'titulo',
    2 => 'data_treinamento',
    3 => 'horario_treinamento',
    4 => 'ordem'
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
$objForm->sk_formListar('Treinamento Gravado',$dadosDaTabela,$treinamentosGravado,$campos,'treinamento_gravado',$publicar,$alterar,$excluir);

?>
<div>
    <a href="index.php?acao=frmCad&ctrl=treinamento_gravado" title="" class="button greenB" style="margin: 40px 5px 5px 0px; float: right;"><span>Cadastrar novo</span></a>
</div>