<?

//inclui a classe do objeto
include_once "classes/class.Avaliacoes.php";
$objAvaliacoes = new Avaliacoes();

//inclui a classe do objeto
include_once "classes/class.Equipe_Medica.php";
$objEquipeMedica = new EquipeMedica();

include_once "classes/class.Crop_Imagem.php";

$permissao = $objSecao->permissaoSecaoFixaUsuario("63",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($objPost->param['acao']) {
case "frmCad":

	$equipeMedica = $objEquipeMedica->listar(array('status' => 1));
	$objUteis->encode($equipeMedica);

	// inclui o arquivo
	$abrePag = "../frms/frmCadAvaliacoes.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form['nome'] = $objPost->param['nome'];
	$form['texto'] = $objPost->param['texto'];
	$form['id_medico'] = $objPost->param['id_medico'];
	$form['nota_avaliacao'] = $objPost->param['nota_avaliacao'];
	$form['ordem'] = $objPost->param['ordem'];
	$form['status'] = $objPost->param['status'];
	$form['dhavaliacao'] = $objUteis->converteData($objPost->param['dhavaliacao']);
	$form['dhcadastro'] = date('Y-m-d H:i:s');
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
	$form['data_expiracao'] = ($objPost->param['data_expiracao'] ? $objUteis->converteDataHora($objPost->param['data_expiracao']) : '0000-00-00 00:00:00');            
	    
	$form['idoperador_cadastro'] = $objSession2->get('tlAdmLoginId');
	
	//se tiver selecionado uma imagem destaque
	if($objPost->param["imagem"]["name"] !=""){
		$formatoImgDestaque = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
		if($formatoImgDestaque == ".jpg" || $formatoImgDestaque == ".JPG" || $formatoImgDestaque == ".jpeg" || $formatoImgDestaque == ".JPEG" || $formatoImgDestaque == ".png" || $formatoImgDestaque == ".PNG" || $formatoImgDestaque == ".gif" || $formatoImgDestaque == ".GIF") {

		}else{
				$objUteis->showResult("","Formato de arquivo inválido. Apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=frmCad&ctrl=noticias');
				exit();
		}

		//Retorna formato da imagem
		$formatoImgDestaque = $objUteis->formatoFile($objPost->param["imagem"]["name"]);
		//Definir nome para imagem
		$dir = "arq_avaliacao/";
		if(!file_exists("arq_avaliacao")) {
				$objUteis->criaDir("arq_avaliacao");
		}
		$nomeImg = "avaliacao".time().".".$formatoImgDestaque;
		$temp = $dir.$nomeImg;
		//deleta a imagem antiga
		$objUteis->delFile($objPost->param['imgAntiga']);
		//Fazendo o upload da imagem
				$imagem = $objPost->param["imagem"];
				// armazena dimensões da imagem
				$imagesize = getimagesize($imagem['tmp_name']);				
				if($imagesize !== false){
					// move a imagem para o servidor
					if($objUteis->uploadArq($objPost->param["imagem"]["tmp_name"],$temp)){
						$oImg = new Crop_Imagem($temp );
						// valida via m2brimagem
						if($oImg->valida() == 'OK'){					
							// redimensiona (caso seja menor que o tamanho )
							$oImg->redimensiona('95', '', '');
							// grava nova imagem
							$oImg->grava($temp);                            
							$oImg->posicaoCrop( $_POST['x'], $_POST['y'] );
							$oImg->redimensiona( $_POST['w'], $_POST['h'], 'crop' );
							$oImg->redimensiona('95', '', '');
							$oImg->grava( $temp );
						}
					}
				}
				$imgDestaque = $dir.$nomeImg;
				$form['imagem'] = $imgDestaque;
		}else{
		$form['imagem'] = $objPost->param['imgAntiga'];
		}

	//Cadastra os dados
	$objUteis->decode($form);
	$result = $objAvaliacoes->cadastrar($form);

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Avaliacoes"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=avaliacoes');
	exit();
	break;
case "listar":
	// lista todos os dados do banco de dados

	if($objPost->param["idMedico"]){
		$idMedico = $objPost->param["idMedico"];	
	
		$condicao = array(
			'medico' => $idMedico
		);
	}else{
		$condicao = array();
	}		

	// $avaliacoes = $objAvaliacoes->listar($condicao);
	// $objUteis->encode($avaliacoes);
	$avaliacoes = $objAvaliacoes->listarPersonalizado($condicao);
	$objUteis->encode($avaliacoes);

	$medicos = $objEquipeMedica->listar(array('status' => 1));
	$objUteis->encode($medicos);

	// inclui o formulario
	$abrePag = "../frms/listaAvaliacoes.php";
	break;
case "frmAlterar":
	
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$avaliacoesForm = $objAvaliacoes->lista($condicao);
	$objUteis->encode($avaliacoesForm);

	$equipeMedica = $objEquipeMedica->listar(array('status' => 1));
	$objUteis->encode($equipeMedica);
	// inclui o formulario
	$abrePag = "../frms/frmAltAvaliacoes.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['nome'] = $objPost->param['nome'];
	$form['texto'] = $objPost->param['texto'];
	$form['id_medico'] = $objPost->param['id_medico'];
	$form['nota_avaliacao'] = $objPost->param['nota_avaliacao'];
	$form['ordem'] = $objPost->param['ordem'];
	$form['status'] = $objPost->param['status'];
	$form['dhavaliacao'] = $objUteis->converteData($objPost->param['dhavaliacao']);
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));   
	$form['data_expiracao'] = ($objPost->param['data_expiracao'] ? $objUteis->converteDataHora($objPost->param['data_expiracao']) : "0000-00-00 00:00:00"); 
	
	//se tiver selecionado uma imagem destaque
	if($objPost->param["imagem"]["name"] !=""){
		$formatoImgDestaque = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
		if($formatoImgDestaque == ".jpg" || $formatoImgDestaque == ".JPG" || $formatoImgDestaque == ".jpeg" || $formatoImgDestaque == ".JPEG" || $formatoImgDestaque == ".png" || $formatoImgDestaque == ".PNG" || $formatoImgDestaque == ".gif" || $formatoImgDestaque == ".GIF") {

		}else{
				$objUteis->showResult("","Formato de arquivo inválido. Apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=frmCad&ctrl=noticias');
				exit();
		}

		//Retorna formato da imagem
		$formatoImgDestaque = $objUteis->formatoFile($objPost->param["imagem"]["name"]);
		//Definir nome para imagem
		$dir = "arq_avaliacao/";
		if(!file_exists("arq_avaliacao")) {
				$objUteis->criaDir("arq_avaliacao");
		}
		$nomeImg = "avaliacao".time().".".$formatoImgDestaque;
		$temp = $dir.$nomeImg;
		//deleta a imagem antiga
		$objUteis->delFile($objPost->param['imgAntiga']);
		//Fazendo o upload da imagem
				$imagem = $objPost->param["imagem"];
				// armazena dimensões da imagem
				$imagesize = getimagesize($imagem['tmp_name']);				
				if($imagesize !== false){
					// move a imagem para o servidor
					if($objUteis->uploadArq($objPost->param["imagem"]["tmp_name"],$temp)){
						$oImg = new Crop_Imagem($temp );
						// valida via m2brimagem
						if($oImg->valida() == 'OK'){					
							// redimensiona (caso seja menor que o tamanho )
							$oImg->redimensiona('95', '', '');
							// grava nova imagem
							$oImg->grava($temp);                            
							$oImg->posicaoCrop( $_POST['x'], $_POST['y'] );
							$oImg->redimensiona( $_POST['w'], $_POST['h'], 'crop' );
							$oImg->redimensiona('95', '', '');
							$oImg->grava( $temp );
						}
					}
				}
				$imgDestaque = $dir.$nomeImg;
				$form['imagem'] = $imgDestaque;
		}else{
		$form['imagem'] = $objPost->param['imgAntiga'];
		}

	//altera o registro no banco
	$objUteis->decode($form);
	$result = $objAvaliacoes->alterar($form);
	
	//verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Avaliacoes"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=frmAlterar&ctrl=avaliacoes&id='.$objPost->param['id']);
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objAvaliacoes->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Avaliacoes"),
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
	$result = $objAvaliacoes->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Avaliacoes"),
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