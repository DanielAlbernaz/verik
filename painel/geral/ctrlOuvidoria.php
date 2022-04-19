<?

//inclui a classe do objeto
include_once "classes/class.Ouvidoria.php";
$objOuvidoria = new Ouvidoria();

include_once "classes/class.csv.php";
$objCsv = new CSV();

$permissao = $objSecao->permissaoSecaoFixaUsuario("62",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {

case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	if($objPost->param["nomeFormulario"]){
		$formularioSelecionado = $objPost->param["nomeFormulario"];
		
		$formulario = $objUteis->decode($objPost->param["nomeFormulario"]);
		$condicao = array('form' => $formulario);
	}	
	
	$forms = $objOuvidoria->listar($condicao);
	$objUteis->encode($forms);
	
	// inclui o formulario
	$abrePag = "../frms/listaOuvidoria.php";
	break;
case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$ouvidoriaForm = $objOuvidoria->lista($condicao);
	$objUteis->encode($ouvidoriaForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltOuvidoria.php";
	break;

case "deletar":
	//deleta o registro no banco
	$result = $objOuvidoria->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Ouvidoria"),
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
	$result = $objOuvidoria->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Ouvidoria"),
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

	case "visualizar":
		//publica o objeto
		
		if($objPost->param['visualizado'] == 1){
			$visualizado = 0;
		}else{
			$visualizado = 1;
		}

		$form['id'] = $objPost->param['id'];
		$form['visualizado'] = $visualizado;
		$form['idoperador_alteracao']   = $objSession2->get('tlAdmLoginId');
		$form['data_alteracao'] = date('Y-m-d H:i:s');

		$result = $objOuvidoria->alterar($form);
		//verifica o resultado
	
	
		// verifica se foi publicado
		if ($result) {
			//grava log de ação no sistema
			$objUteis->gravaLog($objSession2->get('tlAdmLoginNome'),
							utf8_decode("Ouvidoria"),
							$objSession2->get('tlAdmLoginId'), "Publicou",
							$_SERVER['REMOTE_ADDR']);
		}
		
			
		$resposta = array();
		if (!$result) {
			$resposta['situacao'] = "error";
			$resposta['msg'] = "Erro ao publicar.";
	
		} else {
			$resposta['situacao'] = "sucess";
			$resposta['msg'] = "Alterado com sucesso.";
		}       
	
		echo json_encode($resposta);
		exit();
		break;


		case 'exportar':
			
			if($objPost->param['check']){
				$idFormulario = $objPost->param['check'];

				for($i = 0; $i < count($idFormulario); $i++){
					$newss = $objOuvidoria->listar(array( 'id' => $idFormulario[$i]));
					$objUteis->encode($newss);
	
					$formularios[$i] = $newss;					
				}
			
				// set headings
				$objCsv->setHeading(
								'Nome', 
								'Email', 
								'Telefone', 
								'Data Agendamento', 
								'Horário', 
								'Médico', 
								'Especialidade'
							);
			
				for($i=0;$i<count($formularios);$i++){
					// add a line of data
					$dataInscricao = $objUteis->converteDataHora($formularios[$i][0]->data_envio);			
					$objCsv->addLine(
									$formularios[$i][0]->nome, 
									$formularios[$i][0]->email, 
									$formularios[$i][0]->telefone,
									$formularios[$i][0]->data_agendamento, 
									$formularios[$i][0]->horario, 
									$formularios[$i][0]->medico, 
									$formularios[$i][0]->especialidade
								 );
				}
				$objCsv->output("D","ouvidoria.csv");
				$objCsv->clear();
				exit();
			}elseif($objPost->param['deletar'] == 'true' ){			
				
				$newss = $objOuvidoria->listar();
				$objUteis->encode($newss);					
							
				// set headings
				$objCsv->setHeading(
								'Nome', 
								'Email', 
								'Telefone', 
								'Data Agendamento', 
								'Horário', 
								'Médico', 
								'Especialidade'
							);
			
				for($i=0;$i< $newss['num'];$i++){
					// add a line of data
					$dataInscricao = $objUteis->converteDataHora($newss[$i]->data_envio);			
					$objCsv->addLine(
									$newss[$i]->nome, 
									$newss[$i]->email, 
									$newss[$i]->telefone,
									$newss[$i]->data_agendamento, 
									$newss[$i]->horario, 
									$newss[$i]->medico, 
									$newss[$i]->especialidade
								 );
				}
				$objCsv->output("D","ouvidoria.csv");
				$objCsv->clear();

				exit;
			}else{

			}

			
		break;

}
?>