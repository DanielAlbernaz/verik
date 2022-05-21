<?
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/class.Pergunta.php";
$objPergunta = new Pergunta();


include_once "classes/class.CategoriaPergunta.php";
$objCategoriaPergunta = new CategoriaPergunta();

$permissao = $objSecao->permissaoSecaoFixaUsuario("15",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($objPost->param['acao']) {
case "frmCad":
	$categoria = $objCategoriaPergunta->listar();

	// inclui o arquivo
	$abrePag = "../frms/frmCadPergunta.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form['id_categoria_pergunta'] = $objPost->param['id_categoria_pergunta'];
	$form['pergunta'] = $objPost->param['pergunta'];
	$form['resposta'] = $objPost->param['resposta'];
	$form['status'] = $objPost->param['status'];
	$form['dhcadastro'] = $objPost->param['dhcadastro'] ? $objUteis->converteDataHora($objPost->param['dhcadastro']) : date('Y-m-d H:i:s');
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
    if($objPost->param['data_expiracao']){
		$form['data_expiracao'] = $objUteis->converteDataHora($objPost->param['data_expiracao']);
	}
	$form['idoperador_cadastro'] = $objSession2->get('tlAdmLoginId');	

	// print_rpre($form);exit;
	
	//Cadastra os dados
	//$objUteis->decode($form);
	$result = $objPergunta->cadastrar($form);

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Pergunta"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=pergunta');
	exit();
	break;
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$perguntas = $objPergunta->listar();
	//$objUteis->encode($perguntas);
	// inclui o formulario
	$abrePag = "../frms/listaPergunta.php";
	break;
case "frmAlterar":
	
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$perguntaForm = $objPergunta->lista($condicao);
	//$objUteis->encode($perguntaForm);

	$categoria = $objCategoriaPergunta->listar();
	//$objUteis->encode($categoria); 

	// inclui o formulario
	$abrePag = "../frms/frmAltPergunta.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['id_categoria_pergunta'] = $objPost->param['id_categoria_pergunta'];
	$form['pergunta'] = $objPost->param['pergunta'];
	$form['resposta'] = $objPost->param['resposta'];
	$form['status'] = $objPost->param['status'];
	$form['dhcadastro'] = $objPost->param['dhcadastro'] ? $objUteis->converteDataHora($objPost->param['dhcadastro']) : date('Y-m-d H:i:s');
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
    if($objPost->param['data_expiracao']){
		$form['data_expiracao'] = $objUteis->converteDataHora($objPost->param['data_expiracao']);
	}else{
		$form['data_expiracao'] = null;
	}
	$form['idoperador_alteracao'] = $objSession2->get('tlAdmLoginId');	

	//altera o registro no banco
	//$objUteis->decode($form);
	$result = $objPergunta->alterar($form);
	
	//verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Pergunta"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=pergunta');
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objPergunta->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Pergunta"),
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
	$result = $objPergunta->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Pergunta"),
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