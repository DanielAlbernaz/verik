<?

//inclui a classe do objeto
include_once "classes/class.Banner.php";
$objBanner = new Banner();

$permissao = $objSecao->permissaoSecaoFixaUsuario("4",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($objPost->param['acao']) {
case "frmCad":
	// inclui o arquivo
	$abrePag = "../frms/frmCadBanner.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form['titulo'] = $objPost->param['titulo'];
	$form['abrir_mesma_aba'] = $objPost->param['abrir_mesma_aba'];
	$form['ordem'] = $objPost->param['ordem'];
	$form['url'] = $objPost->param['url'];
	$form['status'] = $objPost->param['status'];
	$form['dhcadastro'] = $objPost->param['dhcadastro'] ? $objUteis->converteDataHora($objPost->param['dhcadastro']) : date('Y-m-d H:i:s');
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
    if($objPost->param['data_expiracao']){
		$form['data_expiracao'] = $objUteis->converteDataHora($objPost->param['data_expiracao']);
	}
	$form['idoperador_cadastro'] = $objSession2->get('tlAdmLoginId');	
	$form['imagem'] = $objUteis->imagePrimary($objPost->param['imagem'], '1920', $_POST, '', 'arq_banner', 'banner', true);
	
	//Cadastra os dados
	//$objUteis->decode($form);
	$result = $objBanner->cadastrar($form);

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Banner"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=banner');
	exit();
	break;
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$banners = $objBanner->listar();
	//$objUteis->encode($banners);
	// inclui o formulario
	$abrePag = "../frms/listaBanner.php";
	break;
case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$bannerForm = $objBanner->lista($condicao);
	//$objUteis->encode($bannerForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltBanner.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['titulo'] = $objPost->param['titulo'];
	$form['ordem'] = $objPost->param['ordem'];
	$form['status'] = $objPost->param['status'];
	$form['abrir_mesma_aba'] = $objPost->param['abrir_mesma_aba'];
	$form['url'] = $objPost->param['url'];
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
    if($objPost->param['data_expiracao']){
		$form['data_expiracao'] = $objUteis->converteDataHora($objPost->param['data_expiracao']);
	}else{
		$form['data_expiracao'] = null;
	}
	$form['idoperador_alteracao'] = $objSession2->get('tlAdmLoginId');	
	$form['imagem'] = $objUteis->imagePrimary($objPost->param['imagem'], '1920', $_POST, $objPost->param['imgAntiga'], 'blog', 'blog', true); 

	//altera o registro no banco
	//$objUteis->decode($form);
	$result = $objBanner->alterar($form);
	
	// verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Banner"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=banner');
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objBanner->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Banner"),
						$objSession2->get('tlAdmLoginId'), "Deletou",
						$_SERVER['REMOTE_ADDR']);
	}
	//mostra o resultado para o usuário via json
	$resposta = array();
	if (!$result) {
		$resposta['situacao'] = "error";
		$resposta['msg'] = "Erro ao deletar.";

	} else {
		$resposta['situacao'] = "sucess";
		$resposta['msg'] = "Deletado com sucesso.";
	}

	echo json_encode($resposta);

	exit();
	break;

case "publicar":
	//publica o objeto
	$result = $objBanner->publicar($objPost->param['id'], $objPost->param['status']);
	//verifica o resultado
	$staturs = '';
	if ($result) {
		//verifica o status
		if ($objPost->param['status'] == "1") {
			$act = "ativou";
			$staturs = "Publicado";
		} else {
			$act = "desativou";
			$staturs = "Despublicado";
		}
	}
	// verifica se foi publicado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Banner"),
						$objSession2->get('tlAdmLoginId'), "Publicou",
						$_SERVER['REMOTE_ADDR']);
	}
	//mostra o resultado para o usuario via json
	$resposta = array();
	if (!$result) {
		$resposta['situacao'] = "error";
		$resposta['msg'] = "Erro ao publicar.";

	} else {
		$resposta['situacao'] = "sucess";
		$resposta['msg'] = "$staturs com sucesso.";
	}

	echo json_encode($resposta);
	exit();
	break;

}
?>