<?
//inclui a classe do objeto
include_once "classes/class.Banner_Mini.php";
$objBannerMini = new BannerMini();

include_once "classes/class.Crop_Imagem.php";

$permissao = $objSecao->permissaoSecaoFixaUsuario("66",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$empreendimento = $objBannerMini->listar();
	$objUteis->encode($empreendimento);

	// inclui o formulario
	$abrePag = "../frms/listaBanner_Mini.php";
	break;
case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);

	$bannerminiForm = $objBannerMini->lista($condicao);
	$objUteis->encode($bannerminiForm);

	$formularioFotos->fotos = $objBannerMini->listar_fotos(array('id' => $objPost->param["id"]));    
	$objUteis->encode($formularioFotos); 
	
	$categoria = $objBannerMini->listarCategorias(array('status' => 1));
	$objUteis->encode($categoria);

	$habilidades = $objBannerMini->listarHabilidades(array('id_empreendimento' =>  $objPost->param["id"]));
	$objUteis->encode($habilidades);
	
	// inclui o formulario
	$abrePag = "../frms/frmAltBanner_Mini.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['primeiro_link'] = $objPost->param['primeiro_link'];	
	$form['link_botao'] = $objPost->param['link_botao'];
	$form['segundo_link'] = $objPost->param['segundo_link'];
	$form['status'] = $objPost->param['status'];
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
	$form['data_expiracao'] = ($objPost->param['data_expiracao'] ? $objUteis->converteDataHora($objPost->param['data_expiracao']) : '0000-00-00 00:00:');            
   

	//se tiver selecionado uma imagem destaque
	if($objPost->param["primeira_imagem"]["name"] !=""){

		$formatoImgDestaque = ".".$objUteis->formatoFile($objPost->param["primeira_imagem"]["name"]);
		if($formatoImgDestaque == ".jpg" || $formatoImgDestaque == ".JPG" || $formatoImgDestaque == ".jpeg" || $formatoImgDestaque == ".JPEG" || $formatoImgDestaque == ".png" || $formatoImgDestaque == ".PNG" || $formatoImgDestaque == ".gif" || $formatoImgDestaque == ".GIF") {

		}else{      
			$objUteis->showResult("","Formato de arquivo inválido. Apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=frmCad&ctrl=noticias');
			exit();
		}

		//Retorna formato da imagem
		$formatoImgDestaque = $objUteis->formatoFile($objPost->param["primeira_imagem"]["name"]);
		//Definir nome para imagem
		$dir = "arq_primeira_imagem/";
		if(!file_exists("arq_primeira_imagem")) {
				$objUteis->criaDir("arq_primeira_imagem");
		}
		$nomeImg = "banner_mini".time().".".$formatoImgDestaque;
		$temp = $dir.$nomeImg;
		//deleta a imagem antiga
		$objUteis->delFile($objPost->param['primeira_imagem_antiga']);
		//Fazendo o upload da imagem
			$imagem = $objPost->param["primeira_imagem"];
			// armazena dimensões da imagem
			$imagesize = getimagesize($imagem['tmp_name']);				
			if($imagesize !== false){
				// move a imagem para o servidor
				if($objUteis->uploadArq($objPost->param["primeira_imagem"]["tmp_name"],$temp)){
					$oImg = new Crop_Imagem($temp );
					// valida via m2brimagem
					if($oImg->valida() == 'OK'){					
						// redimensiona (caso seja menor que o tamanho )
						$oImg->redimensiona('575', '', '');
						// grava nova imagem
						$oImg->grava($temp);                            
						$oImg->posicaoCrop( $_POST['x'], $_POST['y'] );
						$oImg->redimensiona( $_POST['w'], $_POST['h'], 'crop' );
						$oImg->redimensiona('575', '', '');
						$oImg->grava( $temp );
					}
				}
			}
			$imgDestaque = $dir.$nomeImg;
			$form['primeira_imagem'] =  $imgDestaque;
		}else{
			$form['primeira_imagem'] = $objPost->param['primeira_imagem_antiga'];
		}


// img sobre
if($objPost->param["segunda_imagem"]["name"]!=""){
                
	$extensoes_permitidas = array('.jpg', '.JPG', 'jpeg', '.JPEG', '.png', '.PNG', '.gif', '.GIF');
	$extensao = strrchr($objPost->param["segunda_imagem"]["name"], '.');
	if(in_array($extensao, $extensoes_permitidas) === false){
		$objUteis->showResult("","Formato de arquivo inválido. Apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=frmCad&ctrl=empresa');
		exit();
	}

	//Retorna formato da imagem
	$formatoImg = ".".$objUteis->formatoFile($objPost->param["segunda_imagem"]["name"]);
	//Definir nome para imagem
	$dir = "arq_segunda_imagem/";
	if(!file_exists("arq_segunda_imagem")) {
	$objUteis->criaDir("arq_segunda_imagem");
	}
	$nomeImg2 = "banner_mini".time()."".$formatoImg;
	$temp = $dir.$nomeImg2;
	//deleta a imagem antiga
	$objUteis->delFile($objPost->param['segunda_imagem_antiga']);
	//Fazendo o upload da imagem
		$imagem = $objPost->param["segunda_imagem"];
		// armazena dimensões da imagem
		$imagesize = getimagesize($imagem['tmp_name']);				
		if($imagesize !== false){
			// move a imagem para o servidor
			if($objUteis->uploadArq($objPost->param["segunda_imagem"]["tmp_name"],$temp)){
				$oImg = new Crop_Imagem($temp );
				// valida via m2brimagem
				if($oImg->valida() == 'OK'){					
					// redimensiona (caso seja menor que o tamanho )
					$oImg->redimensiona('575', '', '');
					// grava nova imagem
					$oImg->grava($temp);
					
					$oImg->posicaoCrop( $_POST['x'], $_POST['y'] );
					$oImg->redimensiona( $_POST['w'], $_POST['h'], 'crop' );
					$oImg->redimensiona('575', '', '');
					$oImg->grava( $temp );
				}
			}
			$form['segunda_imagem'] = $dir.$nomeImg2;
		}                
	}else{
		$form['segunda_imagem'] = $objPost->param['segunda_imagem_antiga'];
		}

	// banner 3
	// img sobre
if($objPost->param["terceira_imagem"]["name"]!=""){
                
	$extensoes_permitidas = array('.jpg', '.JPG', 'jpeg', '.JPEG', '.png', '.PNG', '.gif', '.GIF');
	$extensao = strrchr($objPost->param["terceira_imagem"]["name"], '.');
	if(in_array($extensao, $extensoes_permitidas) === false){
		$objUteis->showResult("","Formato de arquivo inválido. Apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=frmCad&ctrl=empresa');
		exit();
	}

	//Retorna formato da imagem
	$formatoImg = ".".$objUteis->formatoFile($objPost->param["terceira_imagem"]["name"]);
	//Definir nome para imagem
	$dir = "arq_terceira_imagem/";
	if(!file_exists("arq_terceira_imagem")) {
	$objUteis->criaDir("arq_terceira_imagem");
	}
	$nomeImg3 = "banner_mini".time()."".$formatoImg;
	$temp = $dir.$nomeImg3;
	//deleta a imagem antiga
	$objUteis->delFile($objPost->param['terceira_imagem_antiga']);
	//Fazendo o upload da imagem
		$imagem = $objPost->param["terceira_imagem"];
		// armazena dimensões da imagem
		$imagesize = getimagesize($imagem['tmp_name']);				
		if($imagesize !== false){
			// move a imagem para o servidor
			if($objUteis->uploadArq($objPost->param["terceira_imagem"]["tmp_name"],$temp)){
				$oImg = new Crop_Imagem($temp );
				// valida via m2brimagem
				if($oImg->valida() == 'OK'){					
					// redimensiona (caso seja menor que o tamanho )
					$oImg->redimensiona('575', '', '');
					// grava nova imagem
					$oImg->grava($temp);
					
					$oImg->posicaoCrop( $_POST['x'], $_POST['y'] );
					$oImg->redimensiona( $_POST['w'], $_POST['h'], 'crop' );
					$oImg->redimensiona('575', '', '');
					$oImg->grava( $temp );
				}
			}
			$form['terceira_imagem'] = $dir.$nomeImg3;
		}                
	}else{
		$form['terceira_imagem'] = $objPost->param['terceira_imagem_antiga'];
		}
	
	//altera o registro no banco
	$objUteis->decode($form);
	$result = $objBannerMini->alterar($form);
	
	// verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Banner_Mini"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=frmAlterar&ctrl=banner_mini&id='.$objPost->param['id']);

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objBannerMini->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Banner_Mini"),
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

case "deletarFoto":

	//deleta a foto
	$result = $objBannerMini->deletarFoto($_REQUEST['id']);

	if($result){
		//deleta o arquivo
		$objUteis->delFile($_REQUEST['img']);
	}

	$objUteis->gravaLog($objSession2->get('tlAdmLoginNome'),"Empreendimento",$_REQUEST['id'],"deletou fotos",$_SERVER['REMOTE_ADDR']);

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

case "publicar":
	//publica o objeto
	$result = $objBannerMini->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Banner_Mini"),
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