<?php
$optionsmedicos[] = '<option value="" >Todos</option>';
for($i = 0 ; $i < $medicos['num']; $i++){
    $optionsmedicos[] = '<option value="'.$medicos[$i]->id.'" '.($medicos[$i]->id == $idMedico ? 'selected="selected"' : '').' >'.$medicos[$i]->nome.'</option>';
}
$objForm->sk_formSelect('Médico', 'id_medico" onchange="searchMedico(); ', $optionsmedicos, false, 'Selecione uma opção');


//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'NOME',
    2 => 'MÉDICO',
    3 => 'ORDEM EXIBIÇÃO'
);

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'nome',
    2 => 'medico',
    3 => 'ordem'

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
$objForm->sk_formListar('Avaliações',$dadosDaTabela,$avaliacoes,$campos,'avaliacoes',$publicar,$alterar,$excluir);

?>
  <div>

<a href="index.php?acao=frmCad&ctrl=avaliacoes" title="" class="button greenB" style="margin: 40px 5px 5px 0px; float: right;"><span>Cadastrar novo</span></a>

</div>