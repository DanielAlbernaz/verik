<?
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/class.PoliticaCookies.php";
$objPoliticaCookies = new PoliticaCookies();

include_once "classes/class.Crop_Imagem.php";

$permissao = $objSecao->permissaoSecaoFixaUsuario("18",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($objPost->param['acao']) {

case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$politicacookiesForm = $objPoliticaCookies->lista($condicao);
	// $objUteis->encode($politicacookiesForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltPoliticaCookies.php";
break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['titulo'] = $objPost->param['titulo'];
	$form['texto'] = $objPost->param['texto'];	

	
	//se tiver selecionado uma imagem destaque
	if($objPost->param["imagem"]["name"] !=""){
		$formatoImgDestaque = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
		if($formatoImgDestaque == ".jpg" || $formatoImgDestaque == ".JPG" || $formatoImgDestaque == ".jpeg" || $formatoImgDestaque == ".JPEG" || $formatoImgDestaque == ".png" || $formatoImgDestaque == ".PNG" || $formatoImgDestaque == ".gif" || $formatoImgDestaque == ".GIF") {

		}else{
				$objUteis->showResult("","Formato de arquivo inválido. Apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=alterar&ctrl=noticias');
				exit();
		}

		//Retorna formato da imagem
		$formatoImgDestaque = $objUteis->formatoFile($objPost->param["imagem"]["name"]);
		//Definir nome para imagem
		$dir = "arq_politicacookies/";
		if(!file_exists("arq_politicacookies")) {
				$objUteis->criaDir("arq_politicacookies");
		}
		$nomeImg = "politicacookies".time().".".$formatoImgDestaque;
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
								$oImg->redimensiona('1920', '', '');
								// grava nova imagem
								$oImg->grava($temp);                            
								$oImg->posicaoCrop( $_POST['x']*2, $_POST['y']*2 );
								$oImg->redimensiona( $_POST['w']*2, $_POST['h']*2, 'crop' );
								$oImg->redimensiona('1920', '', '');
								$oImg->grava( $temp );
							}
						}
					}
					$imgDestaque = $dir.$nomeImg;
					$form['imagem'] = $imgDestaque;
			}else{
			$form['imagem'] = $objPost->param['imgAntiga'];
			}
				
	
	
	//se tiver selecionado uma imagem
	

	//altera o registro no banco
	// $objUteis->decode($form);
	$result = $objPoliticaCookies->alterar($form);
	
	//verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("politicacookies"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=frmAlterar&ctrl=politicacookies&id='.$objPost->param['id']);
	exit();

break;

}
?>