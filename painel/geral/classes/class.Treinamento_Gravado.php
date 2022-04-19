<?php
class TreinamentoGravado {
	

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('treinamento_gravado',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('treinamento_gravado')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("treinamento_gravado")->where("id",$id);
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
		
		$aValores = $sqlGl->from("treinamento_gravado")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function lista($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$aValores = $sqlGl->from("treinamento_gravado")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}

	function publicar($id, $status) {
		global $sqlGl;
		$result = $sqlGl->update('treinamento_gravado')->set('status',$status)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("treinamento_gravado")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("treinamento_gravado")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGl;
		$result = $sqlGl->update('treinamento_gravado')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}

	function listarPaginacao($atributos=array()) {

	    //chamada ao objeto da classe de abstração de banco de dados	
	    global $sqlGl;
		 
		$atributos['status'] = 1;

	    $sql = 'SELECT ';
            $sql .= '   COUNT(est.id) AS qtd ';
            $sql .= 'FROM ';
            $sql .= '   treinamento_gravado est ';
            $sql .= 'WHERE ';
            $sql .= '   (data_inicio_exibicao <= NOW()) and ';
            $sql .= '   (data_expiracao >= NOW() or data_expiracao is null or data_expiracao = "0000-00-00 00:00:00" ) and ';
			$sql .= '   est.status = 1 ';
			if($atributos['id']){
				$sql .= '   and est.categoria = '. '' . $atributos['id'] . ' ' ;
			}			
	    
            ($atributos['pagina'] ? $atributos['pagina'] = $atributos['pagina'] : $atributos['pagina'] = 1);
            
	    $aValores = array();
	    $stmte = $sqlGl->pdo->prepare($sql);

	    if($stmte->execute()) {
	        $qtd = $stmte->fetch(PDO::FETCH_OBJ);
	    }
	    // controla a paginação
	    if ($atributos['pagina'] == 1) {
	        $atributos['pagina'] = $qtd_pagina = 0;
	    } else {
	        $atributos['pagina'] = $qtd_pagina = ($atributos['pagina'] - 1) * 9;
		}


	    $sql = 'SELECT ';
            $sql .= '   est.* ';
            $sql .= 'FROM  ';
            $sql .= '   treinamento_gravado est ';
            $sql .= 'WHERE ';
            $sql .= '   (data_inicio_exibicao <= NOW()) and ';
            $sql .= '   (data_expiracao >= NOW() or data_expiracao is null or data_expiracao = "0000-00-00 00:00:00" ) and ';
			$sql .= '   est.status = 1 ';
			if($atributos['id']){
				$sql .= '   and est.categoria = '. '' . $atributos['id'] . ' ' ;
			}
			
			
            $sql .= 'ORDER BY ';
            $sql .= '   est.ordem asc ';
            $sql .= 'LIMIT '.$qtd_pagina.',9  ';

	    $stmte = $sqlGl->pdo->prepare($sql);
        
	    if($stmte->execute()){
	        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
			$aValores['num'] = $stmte->rowCount();
	        $aValores['resultados'] = $qtd->qtd;

	        return $aValores;
	    }
	}

	function cadastrarMarcar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('treinamento_concluido',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterarMarcar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('treinamento_concluido')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function listaMarcar($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$aValores = $sqlGl->from("treinamento_concluido")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}

	function cadastrarEstrela($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('avaliacao_treinamento',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterarEstrela($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('avaliacao_treinamento')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function listaEstrela($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$aValores = $sqlGl->from("avaliacao_treinamento")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}

	function listarTreinamentoCategoria($atributos = array()) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$sql =  'SELECT ';
		$sql .= ' tg.* ';
		$sql .= 'FROM ';
		$sql .= 'treinamento_gravado tg ';
		$sql .= 'INNER JOIN categoria_treinamento ct ON tg.categoria = ct.id ';
		if($atributos['id']){
			$sql .= ' WHERE ';
			$sql .= 'tg.categoria = ' . $atributos['id'];
		}			

		$stmte = $sqlGl->pdo->prepare($sql); 
		$stmte->execute();

		$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
		$aValores['num'] = count($aValores);
		return $aValores;	   
		
	}	

	function listarMarcado($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$aValores = $sqlGl->from("treinamento_concluido")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function listarDestaque($atributos=array(),$orderBy=null) {

		//chamada ao objeto da classe de abstração de banco de dados

		global $sqlGl;		

			$sql = 'SELECT
						tl.*
                	FROM treinamento_gravado tl

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