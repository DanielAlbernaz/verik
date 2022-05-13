<?
//inclui a classe do objeto
include_once "classes/class.Incricao_Treinamento_Aovivo.php";
$objInscricaoTreinamentoAoVivo = new InscricaoTreinamentoAoVivo();

//inclui a classe do objeto
include_once "classes/class.Treinamento.php";
$objTreinamento = new Treinamento();

include_once "classes/class.csv.php";
$objCsv = new CSV();

$permissao = $objSecao->permissaoSecaoFixaUsuario("83",$objSession2->get('tlAdmLoginId'));

switch ($objPost->param['acao']) {

	case "listar":
		$idTreinamento =  $objPost->param['id_treinamento_aovivo'];

		$treinamento = $objTreinamento->listar(array('status' => 1));
		$objUteis->encode($treinamento);		

		$inscritos = $objInscricaoTreinamentoAoVivo->listarPersonalizado($idTreinamento);
		$objUteis->encode($inscritos);	
		// print_rpre($inscritos);exit;

		// inclui o formulario
		$abrePag = "../frms/listaLista_Inscritos_Aovivo.php";
	break;

	case 'inscricao_csv':   		
		$idTreinamento = $objPost->param['id_treinamento_aovivo'];		

		$newss = $objInscricaoTreinamentoAoVivo->listarPersonalizado($idTreinamento);
		$objUteis->encode($newss);
		
		$total = 0;
			
		// set headings
		$objCsv->setHeading('Nome', 'Email', 'Data Inscrição', 'Treinamento');
	
		for($i=0;$i<$newss["num"];$i++){
			// add a line of data
			$dataInscricao = $objUteis->converteDataHora($newss[$i]->data_inscricao);			
			$objCsv->addLine($newss[$i]->nome, $newss[$i]->email, $dataInscricao, $newss[$i]->titulo);
		}

		$objCsv->addLine('');
		$objCsv->addLine('Resultado: ');
		$objCsv->addLine('Quantidade Inscritos: ', count($total));

		$objCsv->output("D","inscritos-aovivo.csv");
		$objCsv->clear();
	
		exit();
	break;

	case 'enviar_email':   		
		$idTreinamento = $objPost->param['id_treinamento_aovivo'];		
		
		$inscritos = $objInscricaoTreinamentoAoVivo->listarPersonalizado($idTreinamento);
		$objUteis->encode($inscritos);

		$treinamentosLive = $objTreinamento->lista(array('status' => 1, 'id' => $idTreinamento));
		$objUteis->encode($treinamentosLive);

		for($i = 0; $i < $inscritos['num']; $i++){
			
			$msg[0]['tipo'] = 'Nome:';
			$msg[0]['msg'] = $inscritos[$i]->nome;

			$msg[1]['tipo'] = 'Vai começar o treinamento';
			$msg[1]['msg'] = 'Já está disponível o link para o acesso ao treinamento'; 
			
			$msg[2]['tipo'] = 'Link para o treinamento';
			$msg[2]['msg'] = $treinamentosLive->url; 
			
			$msg[3]['tipo'] = 'Treinamento:';
			$msg[3]['msg'] = $inscritos[$i]->titulo;	
			
			$emailsAEnviar[] = trim((string)$inscritos[$i]->email);			
			
			$result = $objUteis->enviaEmailContatoSite($emailsAEnviar,$msg,$conf["smtp"]['from'],'Formulário de contato - site.',null,'Formulário de contato - site.');
		}	
		header('Location: index.php?acao=listar&ctrl=lista_inscritos_aovivo&id_treinamento_aovivo='.$idTreinamento.'&id_status='.$result);
		exit();
	break;

}
?>