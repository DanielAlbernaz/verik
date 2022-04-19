<?php
$optionsCategoriaEspecialidades[] = '<option value="" >Todos</option>';
for($i = 0 ; $i < $categoriaEspecialidades['num']; $i++){
    $optionsCategoriaEspecialidades[] = '<option value="'.$categoriaEspecialidades[$i]->id.'" '.($categoriaEspecialidades[$i]->id == $idCategoriaEspecialista ? 'selected="selected"' : '').' >'.$categoriaEspecialidades[$i]->nome_categoria.'</option>';
}
$objForm->sk_formSelect('Listar por Landing page', 'categoria_especialidade" onchange="searchEspecialidades(); ', $optionsCategoriaEspecialidades, false, 'Selecione uma opção');


//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'TITULO',
    2 => 'CATEGORIA',
    3 => 'ORDEM EXIBIÇÃO'
);

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'titulo',
    2 => 'nome_categoria',
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
$objForm->sk_formListar('Especialidades',$dadosDaTabela,$especialidades,$campos,'especialidades',$publicar,$alterar,$excluir);

?>
  <div>

<a href="index.php?acao=frmCad&ctrl=especialidades" title="" class="button greenB" style="margin: 40px 5px 5px 0px; float: right;"><span>Cadastrar novo</span></a>

</div>