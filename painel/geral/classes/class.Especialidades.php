<?php
class Especialidades {
	

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('especialidades',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('especialidades')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de especialidades de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("especialidades")->where("id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	function deletarSubcategoria($id) {
		//chamada ao objeto da classe de abstração de especialidades de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("produto_subcategoria")->where("id",$id);
		$result = $result->execute();
	
		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	function listar($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de especialidades de dados
		global $sqlGl;
		
		$aValores = $sqlGl -> from("especialidades")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function lista($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de especialidades de dados
		global $sqlGl;

		$aValores = $sqlGl -> from("especialidades")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}

	function publicar($id, $status) {
		global $sqlGl;
		$result = $sqlGl->update('especialidades')->set('status',$status)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de especialidades de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("especialidades")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de especialidades de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("especialidades")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGl;
		$result = $sqlGl->update('especialidades')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}

	function listarPersonalizado($condicao) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;		

		$sql =  'SELECT ';
		$sql .= ' e.*, ';
		$sql .= ' ce.nome_categoria ';
		$sql .= 'FROM ';
		$sql .= 'especialidades e ';
		$sql .= 'INNER JOIN categoria_especialidade ce ON ce.id = e.categoria_especialidades ';		
		if($condicao['categoria_especialidades']){	
			$sql .= 'WHERE ';		
			$sql .= ' e.categoria_especialidades = ' . $condicao['categoria_especialidades'];
		}
		$sql .= ' ORDER BY e.ordem ASC ';
		
		$stmte = $sqlGl->pdo->prepare($sql);
		
		$stmte->execute();
		$aValores = $stmte->fetchAll(PDO::FETCH_OBJ); 
		$aValores['num'] = count($aValores);
		return $aValores;
	}

}
?>