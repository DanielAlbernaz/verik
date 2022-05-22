<?
//inclui a classe do objeto
include_once "classes/class.Produto.php";
$objProduto = new Produto();

include_once "classes/class.CategoriaProduto.php";
$objCategoriaProduto = new CategoriaProduto();

include_once "classes/class.Cor.php";
$objCor = new Cor();

$permissao = $objSecao->permissaoSecaoFixaUsuario("20",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($objPost->param['acao']) {
case "frmCad":

	$categoria = $objCategoriaProduto->listar();
	$objUteis->encode($categoria);

	// inclui o arquivo
	$abrePag = "../frms/frmCadProduto.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form['nome_produto'] = $objPost->param['nome_produto'];
	$form['codigo_produto'] = $objPost->param['codigo_produto'];
	$form['referencia_produto'] = $objPost->param['referencia_produto'];
	$form['codigo_barras'] = $objPost->param['codigo_barras'];
	$form['peso'] = $objPost->param['peso'];
	$form['fabricante'] = $objPost->param['fabricante'];
	$form['marca'] = $objPost->param['marca'];
	$form['id_categoria_produto'] = $objPost->param['id_categoria_produto'];
	$form['descricao'] = $objPost->param['descricao'];
	$form['informacao_adicional'] = $objPost->param['informacao_adicional'];
	$form['quantidade_estoque'] = $objPost->param['quantidade_estoque'];
	$form['preco_custo'] = $objUteis->converterPreco($objPost->param['preco_custo']);
	$form['preco_venda'] = $objUteis->converterPreco($objPost->param['preco_venda']);
	$form['status'] = $objPost->param['status'];	
	$form['dhcadastro'] = $objPost->param['dhcadastro'] ? $objUteis->converteDataHora($objPost->param['dhcadastro']) : date('Y-m-d H:i:s');
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
    if($form['data_expiracao']){
		$form['data_expiracao'] = $objUteis->converteDataHora($objPost->param['data_expiracao']);
	}
	$form['idoperador_cadastro'] = $objSession2->get('tlAdmLoginId');	
	$form['imagem_principal'] = $objUteis->imagePrimary($objPost->param['imagem_principal'], '580', $_POST, '', 'produto', 'produto', false);
		
	//Cadastra os dados
	//$objUteis->decode($form);
	$result = $objProduto->cadastrar($form);

	cadastrarCoresProdutos($result, $objPost->param['cores']);

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Produto"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=produto');
	exit();
	break;

case "cadastraFoto" :
            
	if($objPost->param['id']){
		$proximo_id = $objPost->param['id'];                    
	}else{
		$proximo_id = $objProduto->proximo_id();
	}
            
	$formatoImg = "." . $objUteis->formatoFile($objPost->param["file"]["name"]);
	// Definir nome para img
	$dir = "arq_produto/".$proximo_id."/";
	if (! file_exists("arq_produto/".$proximo_id)) {
		$objUteis->criaDir("arq_produto/".$proximo_id);
	}
	$nomeImg = $objPost->param["file"]["name"];
	$temp = $dir . md5($objPost->param["file"]["name"]) . $formatoImg;
	// Fazendo o upload da img
	$result = $objUteis->uploadArq($objPost->param["file"]["tmp_name"], $temp );
	
	// gera thumb
	$img = $dir . md5($objPost->param["file"] ["name"]).$formatoImg;
	
	if ($proximo_id){
		$form['id_produto'] = $proximo_id;	
		$form['nome'] = $objPost->param["file"]["name"];
		$form['img'] = $img;			
		// inseri o registro no banco de fotos
		//$objUteis->decode($form);
		$result = $objProduto->cadastrarFoto($form);
	}
	exit ();
break; 
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$produtos = $objProduto->listar();
	
	//$objUteis->encode($produtos);
	// inclui o formulario
	$abrePag = "../frms/listaProduto.php";
	break;
case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);

	$produtoForm = $objProduto->lista($condicao);
	//$objUteis->encode($produtoForm);

	$formularioFotos->fotos = $objProduto->listar_fotos(array('id' => $objPost->param["id"])); 
	//$objUteis->encode($formularioFotos); 
	
	$categoria = $objCategoriaProduto->listar();
	//$objUteis->encode($categoria); 

	$coresProduto = $objCor->listar(['id_produto' => $produtoForm->id]);
	//$objUteis->encode($coresProduto); 
	
	// inclui o formulario
	$abrePag = "../frms/frmAltProduto.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['nome_produto'] = $objPost->param['nome_produto'];
	$form['codigo_produto'] = $objPost->param['codigo_produto'];
	$form['referencia_produto'] = $objPost->param['referencia_produto'];
	$form['codigo_barras'] = $objPost->param['codigo_barras'];
	$form['peso'] = $objPost->param['peso'];
	$form['fabricante'] = $objPost->param['fabricante'];
	$form['marca'] = $objPost->param['marca'];
	$form['id_categoria_produto'] = $objPost->param['id_categoria_produto'];
	$form['descricao'] = $objPost->param['descricao'];
	$form['informacao_adicional'] = $objPost->param['informacao_adicional'];
	$form['quantidade_estoque'] = $objPost->param['quantidade_estoque'];
	$form['preco_custo'] = $objUteis->converterPreco($objPost->param['preco_custo']);
	$form['preco_venda'] = $objUteis->converterPreco($objPost->param['preco_venda']);
	$form['status'] = $objPost->param['status'];
	$form['dhcadastro'] = $objPost->param['dhcadastro'] ? $objUteis->converteDataHora($objPost->param['dhcadastro']) : date('Y-m-d H:i:s');
	$form['data_inicio_exibicao'] = ($objPost->param['data_inicio_exibicao'] ? $objUteis->converteDataHora($objPost->param['data_inicio_exibicao']) : date('Y-m-d H:i:s'));            
    if($objPost->param['data_expiracao']){
		$form['data_expiracao'] = $objUteis->converteDataHora($objPost->param['data_expiracao']);
	}else{
		$form['data_expiracao'] = null;
	}
	$form['idoperador_alteracao'] = $objSession2->get('tlAdmLoginId');	
	$form['imagem_principal'] = $objUteis->imagePrimary($objPost->param['imagem_principal'], '580', $_POST, $objPost->param['imgAntiga'], 'produto', 'produto', false);

	cadastrarCoresProdutos($objPost->param['id'], $objPost->param['cores'], true);

	//altera o registro no banco
	//$objUteis->decode($form);
	$result = $objProduto->alterar($form);
	
	
	// verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Produto"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=produto');
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objProduto->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Produto"),
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
	$result = $objProduto->deletarFoto($_REQUEST['id']);

	if($result){
		//deleta o arquivo
		$objUteis->delFile($_REQUEST['img']);
	}

	$objUteis->gravaLog($objSession2->get('tlAdmLoginNome'),"Produto",$_REQUEST['id'],"deletou fotos",$_SERVER['REMOTE_ADDR']);

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
	$result = $objProduto->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Produto"),
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

	function cadastrarCoresProdutos(int $idProduto, array $cores, $deletar = false)
	{
		$objCor = new Cor();
		$form = [];

		if($deletar == true){
			$objCor->deletarIdProduto($idProduto);
		}

		foreach($cores as $cor){
			$form['id_produto'] = $idProduto;
			$form['cor'] = $cor;
			$objCor->cadastrar($form);
		}		
	}
?>