<?php
class Treinamento {
	

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('treinamento',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('treinamento')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("treinamento")->where("id",$id);
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
		
		$aValores = $sqlGl->from("treinamento")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function lista($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$aValores = $sqlGl->from("treinamento")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}

	function publicar($id, $status) {
		global $sqlGl;
		$result = $sqlGl->update('treinamento')->set('status',$status)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("treinamento")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("treinamento")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGl;
		$result = $sqlGl->update('treinamento')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}

	function listarTreinamentos($atributos=array(),$orderBy=null) {

		//chamada ao objeto da classe de abstração de banco de dados

		global $sqlGl;		

			$sql = 'SELECT
						tl.*
                	FROM treinamento tl

                	WHERE 

                    tl.status = 1

                    and tl.data_treinamento >= CURRENT_DATE() and (
                    
                    tl.data_inicio_exibicao <= now() and
                    
                    (tl.data_expiracao > now() or tl.data_expiracao = 0 or tl.data_expiracao is null ))

                ORDER BY tl.ordem ASC';		

		$aValores = array();		

		$stmte = $sqlGl->pdo->prepare($sql); 

		if($stmte->execute()) {

		    $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
                    $aValores['num'] = $stmte->rowCount();
		    return $aValores;

		}

	}

	function listarDestaque($atributos=array(),$orderBy=null) {

		//chamada ao objeto da classe de abstração de banco de dados

		global $sqlGl;		

			$sql = 'SELECT
						tl.*
                	FROM treinamento tl

                	WHERE 

                    tl.destaque = 1

					and tl.status = 1

                    and tl.data_treinamento >= CURRENT_DATE() and (
                    
                    tl.data_inicio_exibicao <= now() and
                    
                    (tl.data_expiracao > now() or tl.data_expiracao = 0 or tl.data_expiracao is null ))

                ORDER BY tl.ordem ASC';		

		$aValores = array();		

		$stmte = $sqlGl->pdo->prepare($sql); 

		if($stmte->execute()) {

		    $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
                    $aValores['num'] = $stmte->rowCount();
		    return $aValores;

		}

	}

}
?>