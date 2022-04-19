<?
//inclui a classe do objeto
include_once "classes/class.App_Excelencia.php";
$objAppExcelencia = new AppExcelencia();

include_once "classes/class.Crop_Imagem.php";

$permissao = $objSecao->permissaoSecaoFixaUsuario("72",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {

case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$AppExcelenciaForm = $objAppExcelencia->lista($condicao);
	$objUteis->encode($AppExcelenciaForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltApp_Excelencia.php";
break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['titulo_video'] = $objPost->param['titulo_video'];
	$form['sub_titulo_video'] = $objPost->param['sub_titulo_video'];	
	$form['titulo_vantagens'] = $objPost->param['titulo_vantagens'];	
	$form['sub_titulo_vantagens'] = $objPost->param['sub_titulo_vantagens'];	
	$form['titulo_link'] = $objPost->param['titulo_link'];	
	$form['sub_titulo_link'] = $objPost->param['sub_titulo_link'];	
	$form['status'] = 1;

	//se tiver selecionado uma imagem destaque
	if($objPost->param["imagem"]["name"] !=""){

		$formatoImgDestaque = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
		if($formatoImgDestaque == ".jpg" || $formatoImgDestaque == ".JPG" || $formatoImgDestaque == ".jpeg" || $formatoImgDestaque == ".JPEG" || $formatoImgDestaque == ".png" || $formatoImgDestaque == ".PNG" || $formatoImgDestaque == ".gif" || $formatoImgDestaque == ".GIF" || $formatoImgDestaque == ".webp" || $formatoImgDestaque == ".WEBP")  {

		}else{      
			$objUteis->showResult("","Formato de arquivo inválido. Apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=frmCad&ctrl=banner');
			exit();
		}

		//Retorna formato da imagem
		$formatoImgDestaque = $objUteis->formatoFile($objPost->param["imagem"]["name"]);
		//Definir nome para imagem
		$dir = "arq_app/";
		if(!file_exists("arq_app")) {
				$objUteis->criaDir("arq_app");
		}
		$nomeImg = "app".time().".".$formatoImgDestaque;
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
						$oImg->redimensiona('1180', '', '');
						// grava nova imagem
						$oImg->grava($temp);                            
						$oImg->posicaoCrop( $_POST['x'], $_POST['y'] );
						$oImg->redimensiona( $_POST['w'], $_POST['h'], 'crop' );
						$oImg->redimensiona('1180', '', '');
						$oImg->grava( $temp );
					}
				}
			}
			$imgDestaque = $dir.$nomeImg;
		}

		$form['imagem'] =  $imgDestaque;
	
	//altera o registro no banco
	$objUteis->decode($form);
	$result = $objAppExcelencia->alterar($form);
	
	//verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("App Excelencia"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=frmAlterar&ctrl=app_excelencia&id='.$objPost->param['id']);
	exit();

break;

}
?>