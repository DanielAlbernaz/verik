<?php
class EnderecoUsuario {
	

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('endereco_usuarios',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('endereco_usuarios')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("endereco_usuarios")->where("id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	function listar($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$aValores = $sqlGl -> from("endereco_usuarios")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function lista($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$aValores = $sqlGl -> from("endereco_usuarios")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}
	
	function mostraNome($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
	
		$aValores = $sqlGl -> from("endereco_usuarios")->where('id',$id);
		$aValores = $aValores->fetch();
		return $aValores->nome;
	}

	function publicar($id, $status) {
		global $sqlGl;
		$result = $sqlGl->update('endereco_usuarios')->set('status',$status)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("endereco_usuarios")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("endereco_usuarios")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGl;
		$result = $sqlGl->update('endereco_usuarios')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}

}
?>