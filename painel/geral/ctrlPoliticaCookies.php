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

$permissao = $objSecao->permissaoSecaoFixaUsuario("13",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($objPost->param['acao']) {

case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$politicacookiesForm = $objPoliticaCookies->lista($condicao);
	// //$objUteis->encode($politicacookiesForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltPoliticaCookies.php";
break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['titulo'] = $objPost->param['titulo'];
	$form['texto'] = $objPost->param['texto'];		
	$form['imagem'] = $objUteis->imagePrimary($objPost->param['imagem'], '1920', $_POST, $objPost->param['imgAntiga'], 'politica_cookies', 'politicaCookie', true);

	//altera o registro no banco
	// //$objUteis->decode($form);
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