<?

//inclui a classe do objeto
include_once "classes/class.Video_Home.php";
$objVideoHome = new VideoHome();

$permissao = $objSecao->permissaoSecaoFixaUsuario("89",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {

case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$termoForm = $objVideoHome->lista($condicao);
	$objUteis->encode($termoForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltVideo_Home.php";
break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['link'] = $objPost->param['link'];	
	$form['status'] = $objPost->param['status'];
	
	
	//se tiver selecionado uma imagem
	

	//altera o registro no banco
	$objUteis->decode($form);
	$result = $objVideoHome->alterar($form);
	
	//verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Vídeo Home"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=frmAlterar&ctrl=video_home&id='.$objPost->param['id']);
	exit();

break;

}
?>