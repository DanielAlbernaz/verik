<?

//inclui a classe do objeto
include_once "classes/class.Equipamentos.php";
$objEquipamentos = new Equipamentos();

include_once "classes/class.Crop_Imagem.php";

$permissao = $objSecao->permissaoSecaoFixaUsuario("64",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {
case "frmCad":
	// inclui o arquivo
	$abrePag = "../frms/frmCadEquipamentos.php";
	break;
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$bancos = $objEquipamentos->listar();
	$objUteis->encode($bancos);
	// inclui o formulario
	$abrePag = "../frms/listaEquipamentos.php";
	break;
case "frmAlterar":
	
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$equipamentosForm = $objEquipamentos->lista($condicao);
	$objUteis->encode($equipamentosForm);

	$formularioFotos->fotos = $objEquipamentos->listar_fotos(array('id' => $objPost->param["id"]));    
	$objUteis->encode($formularioFotos); 
	// inclui o formulario
	$abrePag = "../frms/frmAltEquipamentos.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['status'] = $objPost->param['status'];
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
	$form['data_expiracao'] = ($objPost->param['data_expiracao'] ? $objUteis->converteDataHora($objPost->param['data_expiracao']) : '0000-00-00 00:00:00');            


	//altera o registro no banco
	$objUteis->decode($form);
	$result = $objEquipamentos->alterar($form);
	
	//verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Sobre"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=frmAlterar&ctrl=equipamentos&id='.$objPost->param['id']);
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objEquipamentos->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Sobre"),
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
	$result = $objEquipamentos->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Sobre"),
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

	case "cadastraFoto" :
            
		if($objPost->param['id']){
			$proximo_id = $objPost->param['id'];                    
		}else{
			$proximo_id = $objEquipamentos->proximo_id();
		}
				
		$formatoImg = "." . $objUteis->formatoFile($objPost->param["file"]["name"]);
		// Definir nome para img
		$dir = "arq_equipamentos/".$proximo_id."/";
		if (! file_exists("arq_equipamentos/".$proximo_id)) {
			$objUteis->criaDir("arq_equipamentos/".$proximo_id);
		}
		$nomeImg = $objPost->param["file"]["name"];
		$temp = $dir . md5($objPost->param["file"]["name"]) . $formatoImg;
		// Fazendo o upload da img
		$result = $objUteis->uploadArq($objPost->param["file"]["tmp_name"], $temp );
		
		// gera thumb
		$img = $dir . md5($objPost->param["file"] ["name"]).$formatoImg;
		
		if ($proximo_id){
				$form['id_equipamentos'] = $proximo_id;	
				$form['nome'] = $objPost->param["file"]["name"];
				$form['img'] = $img;			
				// inseri o registro no banco de fotos
				$objUteis->decode($form);
				$result = $objEquipamentos->cadastrarFoto($form);
		}
		exit ();
	break; 

	case "deletarFoto":

		//deleta a foto
		$result = $objEquipamentos->deletarFoto($_REQUEST['id']);
	
		if($result){
			//deleta o arquivo
			$objUteis->delFile($_REQUEST['img']);
		}
	
		$objUteis->gravaLog($objSession2->get('tlAdmLoginNome'),"Equipamentos",$_REQUEST['id'],"deletou fotos",$_SERVER['REMOTE_ADDR']);
	
		if (!$result) {
			$resposta->situacao = "error";
			$resposta->msg = "Erro ao deletar esta foto.";
	
		} else {
			$resposta->situacao = "sucess";
			$resposta->msg = "Foto deletada com sucesso.";
		}
	
		echo json_encode($resposta);
	
		exit();
	break; 

}
?>