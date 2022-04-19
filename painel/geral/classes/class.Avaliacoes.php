<?php
class Avaliacoes {
	

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('avaliacoes',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('avaliacoes')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de especialidades de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("avaliacoes")->where("id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	function deletarSubcategoria($id) {
		//chamada ao objeto da classe de abstração de avaliacoes de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("produto_subcategoria")->where("id",$id);
		$result = $result->execute();
	
		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	function listar($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de avaliacoes de dados
		global $sqlGl;
		
		$aValores = $sqlGl -> from("avaliacoes")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function lista($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de avaliacoes de dados
		global $sqlGl;

		$aValores = $sqlGl -> from("avaliacoes")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}

	function publicar($id, $status) {
		global $sqlGl;
		$result = $sqlGl->update('avaliacoes')->set('status',$status)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de avaliacoes de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("avaliacoes")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de avaliacoes de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("avaliacoes")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGl;
		$result = $sqlGl->update('avaliacoes')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}

	function listarPersonalizado($condicao) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;		

		$sql =  'SELECT ';
		$sql .= ' e.*, ';
		$sql .= ' em.nome as medico ';
		$sql .= 'FROM ';
		$sql .= 'avaliacoes e ';
		$sql .= 'INNER JOIN equipe_medica em ON em.id = e.id_medico ';		
		if($condicao['medico']){	
			$sql .= 'WHERE ';		
			$sql .= ' e.id_medico = ' . $condicao['medico'];
		}
		$sql .= ' ORDER BY e.ordem DESC ';
		
		$stmte = $sqlGl->pdo->prepare($sql); 
		
		$stmte->execute();
		$aValores = $stmte->fetchAll(PDO::FETCH_OBJ); 
		$aValores['num'] = count($aValores);
		return $aValores;
	}

}
?>