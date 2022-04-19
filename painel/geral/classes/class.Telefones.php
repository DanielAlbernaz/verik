<?php



class Telefones {

	function cadastrar($form) {

            //chamada ao objeto da classe de abstração de banco de dados

            global $sqlGl;

            $result = $sqlGl->insertInto('telefones',$form);

            $lastInsert = $result->execute();

            //retorna o resultado da query para a câmada de controle

            return $lastInsert;

	}

       

        

	function alterar($form) {

            //chamada ao objeto da classe de abstração de banco de dados

            global $sqlGl;

            $result = $sqlGl->update('telefones')->set($form)->where('id', $form['id']);

            $result = $result->execute(true);



            //retorna o resultado da query para a câmada de controle

            return $result;

	}      





	function deletar($id) {

            //chamada ao objeto da classe de abstração de banco de dados

            global $sqlGl;

            $result = $sqlGl->deleteFrom("telefones")->where("id_filial",$id);

            $result = $result->execute();



            //retorna o resultado da query para a câmada de controle

            return $result;

	}        	





	function deletarTodos() {

            //chamada ao objeto da classe de abstração de banco de dados

            global $sqlGl;

            $result = $sqlGl->deleteFrom("telefones");

            $result = $result->execute();



            //retorna o resultado da query para a câmada de controle

            return $result;

	}        	

	

	function deletarFoto($id) {



	    //chamada ao objeto da classe de abstração de banco de dados

	    global $sqlGl;

	    $result = $sqlGl->deleteFrom("telefones_fotos")->where("id",$id);

	    $result = $result->execute();

	    

	    //retorna o resultado da query para a câmada de controle

	    return $result;

	}

	

	function deletarGaleriaFoto($id) {



	    //chamada ao objeto da classe de abstração de banco de dados

	    global $sqlGl;

	    $result = $sqlGl->deleteFrom("telefones_fotos")->where("id_telefones",$id);

	    $result = $result->execute();

	    

	    //retorna o resultado da query para a câmada de controle

	    return $result;

	}

        

	function listarTelefonesHome($atributos=array(),$orderBy=null) {

            //chamada ao objeto da classe de abstração de banco de dados

            global $sqlGl;

            $sql = 'SELECT ';

            $sql .= '   * ';

            $sql .= 'FROM ';

            $sql .= '   telefones ';

            $sql .= 'WHERE ';

            $sql .= '   data_inicio_exibicao <= now() and ';

            $sql .= '   (data_expiracao > now() or data_expiracao = 0 or data_expiracao is null) and ';

            $sql .= '   status = :status ';

            $sql .= 'ORDER BY ';

            $sql .= '   id desc ';



            $aValores = array();		



            $stmte = $sqlGl->pdo->prepare($sql);

            $stmte->bindParam('status',$atributos['status'], PDO::PARAM_INT);

            if($stmte->execute()) {

                $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);

                $aValores['num'] = count($aValores);

                    return $aValores;

            }

	} 



	function listar($atributos=array(),$orderBy=null) {



            //chamada ao objeto da classe de abstração de banco de dados



            global $sqlGl;		



            $aValores = $sqlGl -> from("telefones")->where($atributos)->orderBy($orderBy);



            $aValores = $aValores->fetchAll();



            $aValores['num'] = count($aValores);	



            return $aValores;



	}

        

	function deletarFotoPrincipal($form) {

            

            //chamada ao objeto da classe de abstração de banco de dados

            global $sqlGl;

            $result = $sqlGl->update('telefones')->set($form)->where('id', $form['id']);

            $result = $result->execute(true);



            //retorna o resultado da query para a câmada de controle

            return $result;

	}  



	function listarTelefones($atributos=array(),$orderBy=null) {

            //chamada ao objeto da classe de abstração de banco de dados

            global $sqlGl;

            $sql = 'SELECT ';

            $sql .= '   * ';

            $sql .= 'FROM ';

            $sql .= '   telefones ';

            $sql .= 'WHERE ';

            $sql .= '   data_inicio_exibicao <= now() and ';

            $sql .= '   (data_expiracao > now() or data_expiracao = 0 or data_expiracao is null) and ';

            $sql .= '   status = :status ';

            $sql .= 'ORDER BY ';

            $sql .= '   id desc ';

            $sql .= 'LIMIT 1 ';



            $aValores = array();		



            $stmte = $sqlGl->pdo->prepare($sql);

            $stmte->bindParam('status',$atributos['status'], PDO::PARAM_INT);

            if($stmte->execute()) {

                $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);

                $aValores['num'] = count($aValores);

                    return $aValores;

            }

	} 





	function lista($atributos=array(),$orderBy=null) {

            //chamada ao objeto da classe de abstração de banco de dados

            global $sqlGl;

            $aValores = $sqlGl -> from("telefones")->where($atributos)->orderBy($orderBy);

            $aValores = $aValores->fetch();

            return $aValores;

	}

        

	function verificaExpiracao() {

            //chamada ao objeto da classe de abstração de banco de dados

            global $sqlGl;               

	    $sql = 'update ';

            $sql .= '   telefones ';

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



        function verificaTelefonesExpirou($atributos=array(),$orderBy=null,$limit=null){

            global $sqlGl;

            $sql  = 'SELECT ';

            $sql .= ' * ';

            $sql .= 'FROM ';

            $sql .= '   telefones ';

            $sql .= 'WHERE ';

            $sql .= '   data_expiracao < now() and data_expiracao != 0 and ';

            $sql .= '   id = :ID';

            if($orderBy){

                $sql .= ' order by '.$orderBy;

            }

            if($limit){

                $sql .= ' limit '.$limit;

            }

            $aValores = array();		



            $stmte = $sqlGl->pdo->prepare($sql);

            $stmte->bindParam('ID', $atributos['id'], PDO::PARAM_INT);



            if($stmte->execute()) {

                $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);

                $aValores['num'] = count($aValores);

                    return $aValores;

            }

        }



	function publicar($id, $status) {

            global $sqlGl;

            $result = $sqlGl->update('telefones')->set('status',$status)->where('id', $id);

            $result = $result->execute(true);		



            //retorna o resultado da query para a câmada de controle

            return $result;

	}



        

	function proximo_id() {

	    //chamada ao objeto da classe de abstraÃ§Ã£o de banco de dados

	    global $sqlGl;

	

	    $pdo = $sqlGl->getPdo();

	

	    $stmt = $pdo->query("SHOW TABLE STATUS LIKE 'telefones'");

	    $res = $stmt->fetch(PDO::FETCH_ASSOC);

	

	    return $res['auto_increment'];

	}

}



?>