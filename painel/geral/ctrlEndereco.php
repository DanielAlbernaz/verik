<?
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/class.Endereco.php";
$objEndereco = new Endereco();

include_once "classes/class.Crop_Imagem.php";

$permissao = $objSecao->permissaoSecaoFixaUsuario("10",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {

case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$enderecoForm = $objEndereco->lista($condicao);
	$objUteis->encode($enderecoForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltEndereco.php";
break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['nome'] = $objPost->param['nome'];
	$form['cnpj'] = $objPost->param['cnpj'];
	$form['titulo_imagem'] = $objPost->param['titulo_imagem'];
	$form['creci'] = $objPost->param['creci'];
	$form['telefone'] = $objPost->param['telefone'];
	$form['telefone_vendas'] = $objPost->param['telefone_vendas'];
	$form['telefone_aluguel'] = $objPost->param['telefone_aluguel'];
	$form['whatsapp'] = $objPost->param['whatsapp'];
	$form['email'] = $objPost->param['email'];
	$form['endereco'] = $objPost->param['endereco'];
	$form['complemento'] = $objPost->param['complemento'];
	$form['bairro'] = $objPost->param['bairro'];
	$form['cidade'] = $objPost->param['cidade'];
	$form['cep'] = $objPost->param['cep'];
	$form['latitude'] = $objPost->param['latitude'];
	$form['longitude'] = $objPost->param['longitude'];
	$form['titulo'] = $objPost->param['titulo'];
	$form['texto'] = $objPost->param['texto'];
	$form['status'] = 1;
		

	//altera o registro no banco
	$objUteis->decode($form);
	$result = $objEndereco->alterar($form);
	
	//verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Endereco"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=frmAlterar&ctrl=endereco&id='.$objPost->param['id']);
	exit();

break;

}
?>