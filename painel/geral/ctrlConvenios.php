<?

//inclui a classe do objeto
include_once "classes/class.Convenios.php";
$objConvenios = new Convenios();

include_once "classes/class.Crop_Imagem.php";

$permissao = $objSecao->permissaoSecaoFixaUsuario("32",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($objPost->param['acao']) {
case "frmCad":

	// inclui o arquivo
	$abrePag = "../frms/frmCadConvenios.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form['titulo'] = $objPost->param['titulo'];
	$form['ordem'] = $objPost->param['ordem'];
	$form['status'] = $objPost->param['status'];
	$form['dhcadastro'] = date('Y-m-d H:i:s');
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
	if($form['data_expiracao']){
		$form['data_expiracao'] = $objUteis->converteDataHora($objPost->param['data_expiracao']);
	}
    
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
		$dir = "arq_convenios/";
		if(!file_exists("arq_convenios")) {
				$objUteis->criaDir("arq_convenios");
		}
		$nomeImg = "convenios".time().".".$formatoImgDestaque;
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
						$oImg->redimensiona('150', '', '');
						// grava nova imagem
						$oImg->grava($temp);                            
						$oImg->posicaoCrop( $_POST['x'], $_POST['y'] );
						$oImg->redimensiona( $_POST['w'], $_POST['h'], 'crop' );
						$oImg->redimensiona('150', '', '');
						$oImg->grava( $temp );
					}
				}
			}
			$imgDestaque = $dir.$nomeImg;
		}

		$form['imagem'] =  $imgDestaque;

	//Cadastra os dados
	$objUteis->decode($form);
	$result = $objConvenios->cadastrar($form);

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Convenios"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=convenios');
	exit();
	break;
case "listar":
	// lista todos os dados do banco de dados

	$convenios = $objConvenios->listar($condicao);
	$objUteis->encode($convenios);
	// inclui o formulario
	$abrePag = "../frms/listaConvenios.php";
	break;
case "frmAlterar":
	
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$conveniosForm = $objConvenios->lista($condicao);
	$objUteis->encode($conveniosForm);

	// inclui o formulario
	$abrePag = "../frms/frmAltConvenios.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['titulo'] = $objPost->param['titulo'];
	$form['ordem'] = $objPost->param['ordem'];
	$form['status'] = $objPost->param['status'];
	$form['idoperador_alteracao'] = $objSession2->get('tlAdmLoginId');
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
	$form['dhalteracao'] = ($objPost->param['dhalteracao'] ? $objUteis->converteDataHora($objPost->param['dhalteracao']) : date('Y-m-d H:i:s'));            
	$form['data_expiracao'] = ($objPost->param['data_expiracao'] ? $objUteis->converteDataHora($objPost->param['data_expiracao']) : '0000-00-00 00:00:00');

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
		$dir = "arq_convenios/";
		if(!file_exists("arq_convenios")) {
				$objUteis->criaDir("arq_convenios");
		}
		$nomeImg = "convenios".time().".".$formatoImgDestaque;
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
							$oImg->redimensiona('150', '', '');
							// grava nova imagem
							$oImg->grava($temp);                            
							$oImg->posicaoCrop( $_POST['x'], $_POST['y'] );
							$oImg->redimensiona( $_POST['w'], $_POST['h'], 'crop' );
							$oImg->redimensiona('150', '', '');
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
	$result = $objConvenios->alterar($form);
	
	//verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Convenios"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}
	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=convenios');
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objConvenios->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Convenios"),
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
	$result = $objConvenios->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Convenios"),
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