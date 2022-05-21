<?
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/class.Blog.php";
$objBlog = new Blog();

include_once "classes/class.Categoria.php";
$objCategoria = new Categoria();

include_once "classes/class.Crop_Imagem.php";

$permissao = $objSecao->permissaoSecaoFixaUsuario("16",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($objPost->param['acao']) {
case "frmCad":

	$categoria = $objCategoria->listar();
	//$objUteis->encode($categoria);

	// inclui o arquivo
	$abrePag = "../frms/frmCadBlog.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form['titulo'] = $objPost->param['titulo'];
	$form['id_categoria'] = $objPost->param['id_categoria'];
	$form['texto'] = $objPost->param['texto'];
	$form['status'] = $objPost->param['status'];
	$form['dhcadastro'] = $objPost->param['dhcadastro'] ? $objUteis->converteDataHora($objPost->param['dhcadastro']) : date('Y-m-d H:i:s');
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
    if($form['data_expiracao']){
		$form['data_expiracao'] = $objUteis->converteDataHora($objPost->param['data_expiracao']);
	}
	$form['idoperador_cadastro'] = $objSession2->get('tlAdmLoginId');	
	$form['imagem'] = $objUteis->imagePrimary($objPost->param['imagem'], '1280', $_POST, '', 'blog', 'blog', true);
	
	//Cadastra os dados
	//$objUteis->decode($form);
	$result = $objBlog->cadastrar($form);

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Blog"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=blog');
	exit();
	break;

case "cadastraFoto" :
            
	if($objPost->param['id']){
                $proximo_id = $objPost->param['id'];                    
	}else{
                $proximo_id = $objBlog->proximo_id();
	}
            
	$formatoImg = "." . $objUteis->formatoFile($objPost->param["file"]["name"]);
	// Definir nome para img
	$dir = "arq_blog/".$proximo_id."/";
	if (! file_exists("arq_blog/".$proximo_id)) {
		$objUteis->criaDir("arq_blog/".$proximo_id);
	}
	$nomeImg = $objPost->param["file"]["name"];
	$temp = $dir . md5($objPost->param["file"]["name"]) . $formatoImg;
	// Fazendo o upload da img
	$result = $objUteis->uploadArq($objPost->param["file"]["tmp_name"], $temp );
	
	// gera thumb
	$img = $dir . md5($objPost->param["file"] ["name"]).$formatoImg;
	
	if ($proximo_id){
		$form['id_blog'] = $proximo_id;	
		$form['nome'] = $objPost->param["file"]["name"];
		$form['img'] = $img;			
		// inseri o registro no banco de fotos
		//$objUteis->decode($form);
		$result = $objBlog->cadastrarFoto($form);
	}
	exit ();
break; 
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$blogs = $objBlog->listar();
	
	//$objUteis->encode($blogs);
	// inclui o formulario
	$abrePag = "../frms/listaBlog.php";
	break;
case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);

	$blogForm = $objBlog->lista($condicao);
	//$objUteis->encode($blogForm);

	$formularioFotos->fotos = $objBlog->listar_fotos(array('id' => $objPost->param["id"]));  
	print_r($formularioFotos)  ;
	//$objUteis->encode($formularioFotos); 

	$formularioFotos->fotos = $objBlog->listar_fotos(array('id' => $objPost->param["id"]));    
	//$objUteis->encode($formularioFotos); 
	
	$categoria = $objCategoria->listar();
	//$objUteis->encode($categoria); 
	
	// inclui o formulario
	$abrePag = "../frms/frmAltBlog.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['titulo'] = $objPost->param['titulo'];
	$form['id_categoria'] = $objPost->param['id_categoria'];
	$form['texto'] = $objPost->param['texto'];
	$form['status'] = $objPost->param['status'];
	$form['dhcadastro'] = $objPost->param['dhcadastro'] ? $objUteis->converteDataHora($objPost->param['dhcadastro']) : date('Y-m-d H:i:s');
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
    if($objPost->param['data_expiracao']){
		$form['data_expiracao'] = $objUteis->converteDataHora($objPost->param['data_expiracao']);
	}else{
		$form['data_expiracao'] = null;
	}
	$form['idoperador_alteracao'] = $objSession2->get('tlAdmLoginId');	
	$form['imagem'] = $objUteis->imagePrimary($objPost->param['imagem'], '1280', $_POST, $objPost->param['imgAntiga'], 'blog', 'blog', true);

	//altera o registro no banco
	//$objUteis->decode($form);
	$result = $objBlog->alterar($form);
	
	// verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Blog"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=blog');
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objBlog->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Blog"),
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
	$result = $objBlog->deletarFoto($_REQUEST['id']);

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
	$result = $objBlog->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Blog"),
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