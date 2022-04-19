<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'TÍTULO',
    2 => 'TIPO TREINAMENTO',
    3 => 'DATA TREINAMENTO',
    4 => 'HORA TREINAMENTO',
    5 => 'ORDEM'
);

for($i=0;$i<$treinamentos["num"];$i++){	
    $data_exibicao = $objUteis->converteData($treinamentos[$i]->data_treinamento);
    
    if($treinamentos[$i]->data_treinamento){
        $treinamentos[$i]->data_treinamento = $data_exibicao;
    }   
}

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'titulo',
    2 => 'tipo_treinamento',
    3 => 'data_treinamento',
    4 => 'horario_treinamento',
    5 => 'ordem'
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
$objForm->sk_formListar('Treinamento Ao Vivo',$dadosDaTabela,$treinamentos,$campos,'treinamento',$publicar,$alterar,$excluir);

?>
<div>
    <a href="index.php?acao=frmCad&ctrl=treinamento" title="" class="button greenB" style="margin: 40px 5px 5px 0px; float: right;"><span>Cadastrar novo</span></a>
</div>