<?
//inclui a classe do objeto
include_once "classes/class.Devolucao.php";
$objDevolucao = new Devolucao();

$permissao = $objSecao->permissaoSecaoFixaUsuario("71",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($objPost->param['acao']) {

case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$devolucaoForm = $objDevolucao->lista($condicao);
	//$objUteis->encode($devolucaoForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltDevolucao.php";
break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['titulo'] = $objPost->param['titulo'];
	$form['texto'] = $objPost->param['texto'];	
	$form['status'] = 1;
	
	//altera o registro no banco
	//$objUteis->decode($form);
	$result = $objDevolucao->alterar($form);
	
	//verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Devolucao"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=frmAlterar&ctrl=devolucao&id='.$objPost->param['id']);
	exit();

break;

}
?>