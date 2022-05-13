<?
//inclui a classe do objeto
include_once "classes/class.Duvidas.php";
$objDuvidas = new Duvidas();

$permissao = $objSecao->permissaoSecaoFixaUsuario("72",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($objPost->param['acao']) {
	case "frmCad":
	
		// inclui o arquivo
		$abrePag = "../frms/frmCadDuvidas.php";
		break;
	case "cadastrar":
	//monta o array dos post
	$form['titulo'] = $objPost->param['titulo'];
	$form['texto'] = $objPost->param['texto'];
	$form['status'] = $objPost->param['status'];
	$form['dhcadastro'] = date('Y-m-d H:i:s');
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
	$form['data_expiracao'] = ($objPost->param['data_expiracao'] ? $objUteis->converteDataHora($objPost->param['data_expiracao']) : '0000-00-00 00:00:00');
	$form['idoperador_cadastro'] = $objSession2->get('tlAdmLoginId');
	
	//Cadastra os dados
	$objUteis->decode($form);
	$result = $objDuvidas->cadastrar($form);

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Duvidas"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=duvidas');
	exit();
	break;

case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();

	$duvidas = $objDuvidas->listar();
	$objUteis->encode($duvidas);

	// inclui o formulario
	$abrePag = "../frms/listaDuvidas.php";
	break;

case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$duvidasForm = $objDuvidas->lista($condicao);
	$objUteis->encode($duvidasForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltDuvidas.php";
break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['titulo'] = $objPost->param['titulo'];
	$form['texto'] = $objPost->param['texto'];
	$form['status'] = $objPost->param['status'];
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
	$form['data_expiracao'] = ($objPost->param['data_expiracao'] ? $objUteis->converteDataHora($objPost->param['data_expiracao']) : '0000-00-00 00:00:00');
	
	//altera o registro no banco
	$objUteis->decode($form);
	$result = $objDuvidas->alterar($form);
	
	//verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Duvidas"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=duvidas');
	exit();

break;

}
?>