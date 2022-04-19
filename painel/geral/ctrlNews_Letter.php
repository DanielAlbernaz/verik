<?
//inclui a classe do objeto
include_once "classes/class.News_Letter.php";
$objNewsLetter = new NewsLetter();


include_once "classes/class.csv.php";
$objCsv = new CSV();

$permissao = $objSecao->permissaoSecaoFixaUsuario("68",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$newsLetter = $objNewsLetter->listar();
	$objUteis->encode($newsLetter);
	// inclui o formulario
	$abrePag = "../frms/listaNews_Letter.php";
	break;
case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$socialForm = $objNewsLetter->lista($condicao);
	$objUteis->encode($socialForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltNews_Letter.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['titulo'] = $objPost->param['titulo'];
	$form['url'] = $objPost->param['url'];
	$form['icone'] = $objPost->param['icone'];
	$form['status'] = 1;

	//altera o registro no banco
	$objUteis->decode($form);
	$result = $objNewsLetter->alterar($form);

	// verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("News_Letter"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=news_letter');
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objNewsLetter->deletar($objPost->param['id']);

	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("News_Letter"),
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
	$result = $objNewsLetter->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("News_Letter"),
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

	case "gerar_relatorio_csv":
		$newss = $objNewsLetter->listar();
		$objUteis->encode($newss);
		
		// set headings
		$objCsv->setHeading('Id', 'Email');	

		for($i=0;$i<$newss["num"];$i++){
			$objCsv->addLine($newss[$i]->id, $newss[$i]->email);
		}

		$objCsv->addLine('');
		$objCsv->addLine('Resultado: ');
		$objCsv->addLine('Total Emails: ', $newss['num']);

		$objCsv->output("D", "News Letter.csv");
		$objCsv->clear();
		exit();
			
	break;

}
?>