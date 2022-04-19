<?php
class Destaque {
	

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('destaque',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('destaque')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("destaque")->where("id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	function deletarSubcategoria($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("produto_subcategoria")->where("id",$id);
		$result = $result->execute();
	
		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	function listar($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$aValores = $sqlGl -> from("destaque")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function lista($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$aValores = $sqlGl -> from("destaque")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}

	function publicar($id, $status) {
		global $sqlGl;
		$result = $sqlGl->update('destaque')->set('status',$status)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("destaque")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("destaque")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGl;
		$result = $sqlGl->update('destaque')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}

	function listarDestaquesSite($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$sql = 'SELECT
					*
				FROM
					destaque
				WHERE
					data_inicio_exibicao <= now() and
					(data_expiracao >= now() or data_expiracao is null or data_expiracao = "0000-00-00 00:00:00")  and
					status = :status
					order by ordem ASC
					';

		$aValores = array();		

		$stmte = $sqlGl->pdo->prepare($sql);
		$stmte->bindParam('status',$atributos['status'], PDO::PARAM_INT);
                
		if($stmte->execute()) {
		    $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
                    $aValores['num'] = count($aValores);
			return $aValores;
		}
	}

	function verificaExpiracao() {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;               

	    $sql = 'update ';
		$sql .= '   destaque ';
		$sql .= 'set ';
		$sql .= '   status = 0, ';
		$sql .= '   dhalteracao = NOW() ';
		$sql .= 'where ';
		$sql .= '   data_expiracao != 0 ';
		$sql .= '   and data_expiracao < NOW() ';
		$sql .= '   and status = 1';	    

	    $stmte = $sqlGl->pdo->prepare($sql);
	    if($stmte->execute()) {
	        return $stmte;
	    }   
	}

}
?>