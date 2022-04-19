<?

//inclui a classe do objeto
include_once "classes/class.Filial.php";
$objFilial = new Filial();

include_once "classes/class.Filial_Api.php";
$objFilialApi = new FilialApi();

include_once "classes/class.Telefones.php";
$objTelefones = new Telefones();


include_once "classes/class.Crop_Imagem.php";

$permissao = $objSecao->permissaoSecaoFixaUsuario("84",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {
case "frmCad":

	$filialApi = $objFilialApi->listar();
	$objUteis->encode($filialApi);

	$telefones = $objTelefones->listar();
	$objUteis->encode($telefones);

	// inclui o arquivo
	$abrePag = "../frms/frmCadFilial.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form['filial'] = $objPost->param['filial'];
	$form['email'] = $objPost->param['email'];
	$form['ordem'] = $objPost->param['ordem'];
	$form['cidade'] = $objPost->param['cidade'];
	$form['cnpj'] = $objPost->param['cnpj'];
	$form['latitude'] = $objPost->param['latitude'];
	$form['longitude'] = $objPost->param['longitude'];
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
		$dir = "arq_filial/";
		if(!file_exists("arq_filial")) {
				$objUteis->criaDir("arq_filial");
		}
		$nomeImg = "filial".time().".".$formatoImgDestaque;
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
						$oImg->redimensiona('1290', '', '');
						// grava nova imagem
						$oImg->grava($temp);                            
						$oImg->posicaoCrop( $_POST['x'], $_POST['y'] );
						$oImg->redimensiona( $_POST['w'], $_POST['h'], 'crop' );
						$oImg->redimensiona('1290', '', '');
						$oImg->grava( $temp );
					}
				}
			}
			$imgDestaque = $dir.$nomeImg;
		}

		$form['imagem'] =  $imgDestaque;


	//Cadastra os dados
	$objUteis->decode($form);
	$result = $objFilial->cadastrar($form);


	//verifica se foi alterado
	if ($result) {
		$formTelefones = array();         
		for($i = 0; $i < count($objPost->param["telefone"]); $i++){               
			$formTelefones['telefone'] = $objPost->param['telefone'][$i];
			$formTelefones['id_filial'] = $result;
			$objUteis->decode($formTelefones);
			$result2 = $objTelefones->cadastrar($formTelefones);
		}        
	                
	//grava log de ação no sistema
	$objUteis->gravaLog($objSession2->get('tlAdmLoginNome'),utf8_decode("Filial"),$objSession2->get('tlAdmLoginId'), "Alterou",$_SERVER['REMOTE_ADDR']);
}



	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Filial"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=filial');
	exit();
	break;

case "cadastraFoto" :
            
	if($objPost->param['id']){
                $proximo_id = $objPost->param['id'];                    
	}else{
                $proximo_id = $objFilial->proximo_id();
	}
            
	$formatoImg = "." . $objUteis->formatoFile($objPost->param["file"]["name"]);
	// Definir nome para img
	$dir = "arq_filial/".$proximo_id."/";
	if (! file_exists("arq_filial/".$proximo_id)) {
		$objUteis->criaDir("arq_filial/".$proximo_id);
	}
	$nomeImg = $objPost->param["file"]["name"];
	$temp = $dir . md5($objPost->param["file"]["name"]) . $formatoImg;
	// Fazendo o upload da img
	$result = $objUteis->uploadArq($objPost->param["file"]["tmp_name"], $temp );
	
	// gera thumb
	$img = $dir . md5($objPost->param["file"] ["name"]).$formatoImg;
	
	if ($proximo_id){
                $form['id_filial'] = $proximo_id;	
                $form['nome'] = $objPost->param["file"]["name"];
                $form['img'] = $img;			
                // inseri o registro no banco de fotos
                $objUteis->decode($form);
                $result = $objFilial->cadastrarFoto($form);
	}
	exit ();
break; 
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$filiais = $objFilial->listar();
	$objUteis->encode($filiais);

	$filialApi = $objFilialApi->listar();
	$objUteis->encode($filialApi);

	// inclui o formulario
	$abrePag = "../frms/listaFilial.php";
	break;
case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);

	$filialForm = $objFilial->lista($condicao);
	$objUteis->encode($filialForm);

	$formularioFotos->fotos = $objFilial->listar_fotos(array('id' => $objPost->param["id"]));    
	$objUteis->encode($formularioFotos); 

	$filialApi = $objFilialApi->listar();
	$objUteis->encode($filialApi);	

	$telefones = $objTelefones->listar(array('id_filial' => $objPost->param["id"]));
	$objUteis->encode($telefones);
		
	// inclui o formulario
	$abrePag = "../frms/frmAltFilial.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['filial'] = $objPost->param['filial'];
	$form['email'] = $objPost->param['email'];
	$form['cnpj'] = $objPost->param['cnpj'];
	$form['ordem'] = $objPost->param['ordem'];
	$form['cidade'] = $objPost->param['cidade'];
	$form['latitude'] = $objPost->param['latitude'];
	$form['longitude'] = $objPost->param['longitude'];
	$form['status'] = $objPost->param['status'];
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
    if($form['data_expiracao']){
		$form['data_expiracao'] = $objUteis->converteDataHora($objPost->param['data_expiracao']);
	}
	
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
		$dir = "arq_filial/";
		if(!file_exists("arq_filial")) {
				$objUteis->criaDir("arq_filial");
		}
		$nomeImg = "filial".time().".".$formatoImgDestaque;
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
							$oImg->redimensiona('1290', '', '');
							// grava nova imagem
							$oImg->grava($temp);                            
							$oImg->posicaoCrop( $_POST['x'], $_POST['y'] );
							$oImg->redimensiona( $_POST['w'], $_POST['h'], 'crop' );
							$oImg->redimensiona('1290', '', '');
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
	$result = $objFilial->alterar($form);


	//verifica se foi alterado
	if ($result) {
		$objTelefones->deletar($objPost->param['id']);
		$formTelefones = array();         
		for($i = 0; $i < count($objPost->param["telefone"]); $i++){               
			$formTelefones['telefone'] = $objPost->param['telefone'][$i];
			$formTelefones['id_filial'] = $objPost->param['id'];

			$objUteis->decode($formTelefones);
			$result2 = $objTelefones->cadastrar($formTelefones);
		}        

	}

	
	// verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Filial"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=filial');
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objFilial->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Filial"),
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
	$result = $objFilial->deletarFoto($_REQUEST['id']);

	if($result){
		//deleta o arquivo
		$objUteis->delFile($_REQUEST['img']);
	}

	$objUteis->gravaLog($objSession2->get('tlAdmLoginNome'),"Blog",$_REQUEST['id'],"deletou fotos",$_SERVER['REMOTE_ADDR']);

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
	$result = $objFilial->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Filial"),
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