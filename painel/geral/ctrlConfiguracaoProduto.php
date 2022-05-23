<?
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/class.ConfiguracaoProduto.php";
$objConfiguracaoProduto = new ConfiguracaoProduto();


$permissao = $objSecao->permissaoSecaoFixaUsuario("11",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($objPost->param['acao']) {

case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$configuracaoprodutoForm = $objConfiguracaoProduto->lista($condicao);
	// //$objUteis->encode($configuracaoprodutoForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltConfiguracaoProduto.php";
break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['exibir_valor_logado'] = $objPost->param['exibir_valor_logado'];	
	$form['idoperador_alteracao'] = $objSession2->get('tlAdmLoginId');	

	//altera o registro no banco
	// //$objUteis->decode($form);
	$result = $objConfiguracaoProduto->alterar($form);
	
	//verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("configuracaoproduto"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=frmAlterar&ctrl=configuracaoproduto&id='.$objPost->param['id']);
	exit();

break;

}
?>