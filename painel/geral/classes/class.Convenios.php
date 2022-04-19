<?php
class Convenios {
	

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('convenios',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('convenios')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de convenios de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("convenios")->where("id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	function deletarSubcategoria($id) {
		//chamada ao objeto da classe de abstração de convenios de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("produto_subcategoria")->where("id",$id);
		$result = $result->execute();
	
		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	function listar($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de convenios de dados
		global $sqlGl;
		
		$aValores = $sqlGl -> from("convenios")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function listarConveniosMedicos($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de convenios de dados
		global $sqlGl;
		
		$aValores = $sqlGl -> from("convenios_medico")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function lista($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de convenios de dados
		global $sqlGl;

		$aValores = $sqlGl -> from("convenios")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}

	function publicar($id, $status) {
		global $sqlGl;
		$result = $sqlGl->update('convenios')->set('status',$status)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de convenios de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("convenios")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de convenios de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("convenios")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGl;
		$result = $sqlGl->update('convenios')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}

	function listarPersonalizado($condicao) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;		

		$sql =  'SELECT ';
		$sql .= ' b.* , ';
		$sql .= ' lp.titulo titulo_panding ';
		$sql .= 'FROM ';
		$sql .= 'convenios b ';
		$sql .= 'INNER JOIN landing_page lp ON lp.id = b.pagina_redirecionar ';
		$sql .= 'WHERE ';
		$sql .= ' b.status = 1  ';
		if($condicao['id']){			
			$sql .= ' and b.pagina_redirecionar = ' . $condicao['id'];
		}
		$sql .= ' ORDER BY b.ordem ASC ';
		
		$stmte = $sqlGl->pdo->prepare($sql);
		
		$stmte->execute();
		$aValores = $stmte->fetchAll(PDO::FETCH_OBJ); 
		$aValores['num'] = count($aValores);
		return $aValores;
	}

}
?>