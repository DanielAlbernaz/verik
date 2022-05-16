<?
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/class.Empresa.php";
$objEmpresa = new Empresa();

$permissao = $objSecao->permissaoSecaoFixaUsuario("11",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($objPost->param['acao']) {
case "frmCad":
	// inclui o arquivo
	$abrePag = "../frms/frmCadEmpresa.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form['titulo'] = $objPost->param['titulo'];
	$form['texto'] = $objPost->param['texto'];
	$form['video'] = $objPost->param['video'];
	$form['status'] = 1;

	//se tiver selecionado uma imagem
	if($objPost->param["imagem"]["name"] !=""){
	    	
	    $formatoImg = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
	    if($formatoImg == ".jpg" || $formatoImg == ".JPG" || $formatoImg == ".jpeg" || $formatoImg == ".JPEG" || $formatoImg == ".png" || $formatoImg == ".PNG" || $formatoImg == ".gif" || $formatoImg == ".GIF") {
	        $verificaTamanho = $objUteis->TamanhodaImagem($objPost->param["imagem"]["tmp_name"]);
	        if($verificaTamanho["largura"] != "501" && $verificaTamanho["altura"] != "334"){
	
	            $objUteis->showResult("","A Largura e altura da imagem não confere. Largura: 501 - Altura: 334",false,"mostraMensagem",'index.php?acao=listar&ctrl=empresa');
	            exit();
	        }
	
	    }else{
	        $objUteis->showResult("","Formato de arquivo inválido. apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=listar&ctrl=empresa');
	        exit();
	
	    }
	    	
	    //Retorna formato da imagem
	    $formatoImg = $objUteis->formatoFile($objPost->param["imagem"]["name"]);
	    //Definir nome para imagem
	    $dir = "arq_empresa/";
	    if(!file_exists("arq_empresa")) {
	        $objUteis->criaDir("arq_empresa");
	    }
	    $nomeImg = "empresa_".time().".".$formatoImg;
	    $temp = $dir.$nomeImg;
	    //Fazendo o upload da imagem
	    $objUteis->uploadArq($objPost->param["imagem"]["tmp_name"],$temp);
	
	    //gera thumb
	    $img = $dir.$nomeImg;
	}
	
	$form['imagem'] = $img;	
	
	//Cadastra os dados
	$objUteis->decode($form);
	$result = $objEmpresa->cadastrar($form);

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Serviço"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=empresa');
	exit();
	break;
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$empresas = $objEmpresa->listar();
	$objUteis->encode($empresas);
	// inclui o formulario
	$abrePag = "../frms/listaEmpresa.php";
	break;
case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$empresaForm = $objEmpresa->lista($condicao);
	$objUteis->encode($empresaForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltEmpresa.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['titulo'] = $objPost->param['titulo'];
	$form['texto'] = $objPost->param['texto'];
	$form['video'] = $objPost->param['video'];
	$form['status'] = 1;

	//se tiver selecionado uma imagem
	if($objPost->param["imagem"]["name"]!=""){
	
	    $formatoImg = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
	    if($formatoImg == ".jpg" || $formatoImg == ".JPG" || $formatoImg == ".jpeg" || $formatoImg == ".JPEG" || $formatoImg == ".png" || $formatoImg == ".PNG" || $formatoImg == ".gif" || $formatoImg == ".GIF") {
	        $verificaTamanho = $objUteis->TamanhodaImagem($objPost->param["imagem"]["tmp_name"]);
	        if($verificaTamanho["largura"] != "501" && $verificaTamanho["altura"] != "334"){
	
	            $objUteis->showResult("","A Largura e altura da imagem não confere. Largura: 501 - Altura: 334",false,"mostraMensagem",'index.php?acao=listar&ctrl=empresa');
	            exit();
	        }
	    }else{
	        $objUteis->showResult("","Formato de arquivo inválido. apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=listar&ctrl=empresa');
	        exit();
	    }
	
	    //Retorna formato da imagem
	    $formatoImg = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
	    //Definir nome para imagem
	    $dir = "arq_empresa/";
	    if(!file_exists("arq_empresa")) {
	        $objUteis->criaDir("arq_empresa");
	    }
	    $nomeImg = "empresa_".time()."".$formatoImg;
	    $temp = $dir.$nomeImg;
	    //deleta a imagem antiga
	    $objUteis->delFile($objPost->param['imgAntiga']);
	    //Fazendo o upload da imagem
	    $objUteis->uploadArq($objPost->param["imagem"]["tmp_name"],$temp);
	    $form['imagem']			= $dir.$nomeImg;
	}else{
	    $form['imagem']			= $objPost->param['imgAntiga'];
	}	
	
	//altera o registro no banco
	$objUteis->decode($form);
	$result = $objEmpresa->alterar($form);

	// verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Serviço"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=empresa');
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objEmpresa->deletar($objPost->param['id']);

	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Serviço"),
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
	$result = $objEmpresa->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Serviço"),
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