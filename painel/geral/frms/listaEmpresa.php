
<?php
//Dados da Tabela
$dadosDaTabela = array(
	0 => 'ID',
	1 => 'TITULO',
	2 => 'TEXTO',
    3 => 'IMAGEM'
);





for($i=0;$i<$empresas["num"];$i++){
	$empresas[$i]->imagem = '<img height="50" src="'.$empresas[$i]->imagem.'"/>';        
}

//Campos para puxar na listagem
$campos = array(
	0 => 'id',
	1 => 'titulo',
	2 => 'texto',
    3 => 'imagem'

);

$publicar = 0;
$alterar = 0;
$excluir = 0;

/**
 * Verifica a permissÃ£o do usuÃ¡rio
 */
if ($permissao->publicar == "1") {
	$publicar = 1;
}
if ($permissao->alterar == "1") {
	$alterar = 1;
}
if ($permissao->excluir == "1") {
	$excluir = 1;
}

//Inicia a listagem do formulário
$objForm->sk_formListar('Empresa', $dadosDaTabela, $empresas, $campos, 'empresa', $publicar, $alterar, $excluir);

?>
