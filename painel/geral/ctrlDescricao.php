<?

//inclui a classe do objeto
include_once "classes/class.Descricao.php";
$objDescricao = new Descricao();

include_once "classes/class.Produto.php";
$objProduto = new Produto();

$permissao = $objSecao->permissaoSecaoFixaUsuario("87",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {
case "frmCad":
	// inclui o arquivo
	$abrePag = "../frms/frmCadDescricao.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form['codigo_produto'] = $objPost->param['codigo_produto'];
	$form['descricao'] = $objPost->param['descricao'];
	$form['dhcadastro'] = date('Y-m-d H:i:s');
	$form['idoperador_cadastro'] = $objSession2->get('tlAdmLoginId');


	$buscaProduto = $objDescricao->lista(array('codigo_produto' =>  $objPost->param['codigo_produto']));
	$objUteis->encode($buscaProduto);

	if($buscaProduto->codigo_produto == $objPost->param['codigo_produto']){
		$objUteis
			->showResult("Cadastrado com sucesso.",
					"Já existe descrição para o produto.", 0,
					"mostraMensagem",
					'index.php?acao=frmCad&ctrl=descricao');
	exit();
	}else{
		//Cadastra os dados
		$objUteis->decode($form);
		$result = $objDescricao->cadastrar($form);
	}
	

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Descricao"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=descricao');
	exit();
	break;
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$destaques = $objDescricao->listar();
	$objUteis->encode($destaques);
	// inclui o formulario
	$abrePag = "../frms/listaDescricao.php";
	break;
case "frmAlterar":
	
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$destaqueForm = $objDescricao->lista($condicao);
	$objUteis->encode($destaqueForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltDescricao.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['codigo_produto'] = $objPost->param['codigo_produto'];
	$form['descricao'] = $objPost->param['descricao'];
	$form['dhalteracao'] = date('Y-m-d H:i:s');


	$buscaProduto = $objDescricao->lista(array('codigo_produto' =>  $objPost->param['codigo_produto']));
	$objUteis->encode($buscaProduto);

	if($buscaProduto->id && $buscaProduto->id == $objPost->param['id']){
		$objUteis->decode($form);
		$result = $objDescricao->alterar($form);
	}
	if(!$buscaProduto->id){
		$objUteis->decode($form);
		$result = $objDescricao->alterar($form);
	}else{
		$objUteis
			->showResult("Alterado com sucesso",
					"O produto já esta vinculado a outro cadastro.", 0,
					"mostraMensagem",
					'index.php?acao=frmAlterar&ctrl=descricao&id=' . $objPost->param['id']);
		exit();
	}

	
	
	//verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Descrição"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=descricao');
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objDescricao->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Descrição"),
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
	$result = $objDescricao->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Descrição"),
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

	case "pesquisaProduto":


		$objPost->param['codigo'];

		$produto = $objProduto->lista(array('ativo' => 1, 'id' => $objPost->param['codigo']));
		$objUteis->encode($produto);
		
		if($produto->nome){
			$resposta['situacao'] = "sucess";
			$resposta['codigo'] = $produto->nome;
			echo json_encode($resposta);
			exit;
		}else{
			$resposta['situacao'] = "error";
			echo json_encode($resposta);
			exit;
		}
		

			
	break;

}
?>