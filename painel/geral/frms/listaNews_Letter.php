
<?php
//Dados da Tabela
$dadosDaTabela = array(
	0 => 'ID',
	1 => 'EMAIL'
);

//Campos para puxar na listagem
$campos = array(
	0 => 'id',
	1 => 'email'

);

$publicar = 0;
$alterar = 0;
$excluir = 0;

/**
 * Verifica a permissÃ£o do usuÃ¡rio
 */
if ($permissao->publicar == "1") {
	$publicar = 0;
}
if ($permissao->alterar == "1") {
	$alterar = 0;
}
if ($permissao->excluir == "1") {
	$excluir = 1;
}

//Inicia a listagem do formulário
$objForm->sk_formListar('News Letter', $dadosDaTabela, $newsLetter, $campos, 'news_letter', $publicar, $alterar, $excluir);

echo'
    <div style="clear: both;"></div>
    <div style="float: left; margin: 10px 45px;">
      <a style="padding: 8px;" href="index.php?acao=gerar_relatorio_csv&ctrl=news_letter" id="buttonTodos" class="button greyishB">Exportar Relatório</a>
    </div>';

?>
