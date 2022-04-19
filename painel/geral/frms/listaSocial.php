
<?php
//Dados da Tabela
$dadosDaTabela = array(
	0 => 'ID',
	1 => 'TITULO',
	2 => 'URL',
	3 => 'ICONE'
);

//Campos para puxar na listagem
$campos = array(
	0 => 'id',
	1 => 'titulo',
	2 => 'url',
	3 => 'icone'

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
	$excluir = 0;
}

//Inicia a listagem do formulário
$objForm->sk_formListar('Redes Sociais', $dadosDaTabela, $socials, $campos, 'social', $publicar, $alterar, $excluir);

?>
