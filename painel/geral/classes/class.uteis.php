<?
include_once "class.Crop_Imagem.php";
class Uteis {

    public function gerarCodigo($nome){
        
        $words = array();
        $codigo = "";
        
        if(strlen($nome)>1){

            $nome = $this->nameArq($nome);
            
            $words = explode("_", $nome);
            $qtdeWords = count($words);
            
            for($i=0;$i<$qtdeWords;$i++){
                if(strlen($words[$i])>7){
                    $codigo .= "_" . substr($words[$i],0,7);
                }
            }

            $codigo = substr($codigo,1);
            
            
        } else $codigo = $nome;
        
        return strtoupper($codigo);
        
    }

    public function urlVideoYoutube($url){

        $url = explode('v=', $url);	
        $linkReal = 'https://www.youtube.com/embed/' . $url[1];

        return $linkReal;
    }


    public function formatarTelexebicao($tel){  

        if(strlen($tel) == 10){
            $ddd = substr($tel, 0, 2);
            $ddd = '(' . $ddd . ') ';

            $primeirosDigitos = substr($tel, 2, 4);
            $segundosDigitos = substr($tel, 6, 6);

            $tel = $ddd . $primeirosDigitos . '-' . $segundosDigitos;
        }elseif(strlen($tel) == 11){
            $ddd = substr($tel, 0, 2);
            $ddd = '(' . $ddd . ') ';

            $primeirosDigitos = substr($tel, 2, 5);
            $segundosDigitos = substr($tel, 7, 7);

            $tel = $ddd . $primeirosDigitos . '-' . $segundosDigitos;
        }         

        return $tel;
    }

    

    public function enviaEmailImobiliaria($emails=null, $msg=null, $replyTo=null, $assunto=null, $anexos=null){
        $configuracao = Config::AtributosConfig();
        include_once(dirname(__FILE__)."/../inc/smtp/class.phpmailer.php");
        // monta Msg
        $messg  = "";
    
        $aMsg = count($msg);
        for($i=0;$i<$aMsg;$i++){
            $messg .= "<b>".$msg[$i]['tipo']." </b> <span>".$msg[$i]['msg']."</span><br/><br/>";
        }
    
        $content = file_get_contents(dirname(__FILE__).'/../inc/email/imobiliaria.php');
        $content = str_replace('{LINKSITE}', $configuracao['siteCliente'], $content);
        $content = str_replace('{URLLOGO}', $configuracao['urllogo'], $content);
    
    
    
        $mail             = new PHPMailer();
    
        $mail->IsSMTP(); // Define que a mensagem ser?? SMTP
        // $mail->SMTPDebug  = 2;
        $mail->Host = $configuracao['smtp']['host']; // Endere??o do servidor SMTP
        $mail->CharSet   = 'UTF-8';                  // enable SMTP authentication
        $mail->SMTPAuth = $configuracao['smtp']['user'] && $configuracao['smtp']['senha'] ? true : false;
        if($configuracao['smtp']['user'] && $configuracao['smtp']['senha'] && $configuracao['smtp']['port']){
            $mail->Username = $configuracao['smtp']['user']; // Usu??rio do servidor SMTP
            $mail->Password = $configuracao['smtp']['senha']; // Senha do servidor SMTP
            $mail->Port = $configuracao['smtp']['port'];
        }
    
        $mail->From = $configuracao['smtp']['from']; // Seu e-mail
        $mail->FromName = $configuracao['smtp']['fromName']; // Seu nome
        $mail->AddReplyTo($replyTo ? $replyTo : $configuracao['smtp']['from'], $configuracao['smtp']['fromName']);
    
        if($anexos){
            $qtdeAnexo = count($anexos);
            for($i=0;$i<$qtdeAnexo;$i++){
                $mail->AddAttachment($anexos[$i]['url'],$anexos[$i]['name']);
            }
        }
    
        $mail->Subject    = $assunto;
        $mail->MsgHTML($content);
        $qtdeEmail = count($emails);
        for($i=0;$i<$qtdeEmail;$i++){
            $mail->AddAddress($emails[$i]);
        }
        $mail->IsHTML(true); // send as HTML
        $result = false;
        if ($mail->send()) {
            $result = true;
        }
    
        return $result;
    }

    public function enviaEmailReclamacao($emails=null, $replyTo=null, $assunto=null, $tipo=null, $anexos=null){
        $configuracao = Config::AtributosConfig();
        include_once(dirname(__FILE__)."/../inc/smtp/class.phpmailer.php");
        // monta Msg
        $messg  = "";
    
        $content = file_get_contents(dirname(__FILE__).'/../inc/email/reclamacao.php');
    
        switch ($tipo) {
            case 'Sugest??o':
                $content = str_replace('{MENSAGEM}',        'Ol??! Agradecemos a mensagem. <br/>Sua sugest??o ?? muito importante e bem-vinda.', $content);
                break;
            case 'Reclama????o':
                $content = str_replace('{MENSAGEM}',        'Ol??! Agradecemos o contato. <br/> Sua opini??o ?? muito importante para n??s. <br/>Vamos analisar e tomar as medidas necess??rias referentes aos seus coment??rios.', $content);
                break;
            case 'D??vida':
                $content = str_replace('{MENSAGEM}',        'Ol??! <br/> Agradecemos o contato. <br/>Obrigado!', $content);
                break;
            default:
                # code...
                break;
        }
    
        $mail             = new PHPMailer();
    
        $mail->IsSMTP(); // Define que a mensagem ser?? SMTP
        // $mail->SMTPDebug  = 2;
        $mail->Host = $configuracao['smtp']['host']; // Endere??o do servidor SMTP
        $mail->CharSet   = 'UTF-8';                  // enable SMTP authentication
        $mail->SMTPAuth = $configuracao['smtp']['user'] && $configuracao['smtp']['senha'] ? true : false;
        if($configuracao['smtp']['user'] && $configuracao['smtp']['senha'] && $configuracao['smtp']['port']){
            $mail->Username = $configuracao['smtp']['user']; // Usu??rio do servidor SMTP
            $mail->Password = $configuracao['smtp']['senha']; // Senha do servidor SMTP
            $mail->Port = $configuracao['smtp']['port'];
        }
    
        $mail->From = $configuracao['smtp']['from']; // Seu e-mail
        $mail->FromName = $configuracao['smtp']['fromName']; // Seu nome
        $mail->AddReplyTo($replyTo ? $replyTo : $configuracao['smtp']['from'], $configuracao['smtp']['fromName']);
    
        if($anexos){
            $qtdeAnexo = count($anexos);
            for($i=0;$i<$qtdeAnexo;$i++){
                $mail->AddAttachment($anexos[$i]['url'],$anexos[$i]['name']);
            }
        }
    
        $mail->Subject    = $assunto;
        $mail->MsgHTML($content);
        $qtdeEmail = count($emails);
        for($i=0;$i<$qtdeEmail;$i++){
            $mail->AddAddress($emails[$i]);
        }
        $mail->IsHTML(true); // send as HTML
        $result = false;
        if ($mail->send()) {
            $result = true;
        }
    
        return $result;
    }

    /*
 * FORMUL??RIO DE S??NDICO
 */

public function enviaEmailCadastroDepoimento($emails=null, $replyTo=null, $assunto=null, $anexos=null){
    $configuracao = Config::AtributosConfig();
    include_once(dirname(__FILE__)."/../inc/smtp/class.phpmailer.php");
    // monta Msg
    $messg  = "";

    $content = file_get_contents(dirname(__FILE__).'/../inc/email/procedimentoResposta.php'); // alterar

    $mail             = new PHPMailer();

    $mail->IsSMTP(); // Define que a mensagem ser?? SMTP
    // $mail->SMTPDebug  = 2;
    $mail->Host = $configuracao['smtp']['host']; // Endere??o do servidor SMTP
    $mail->CharSet   = 'UTF-8';                  // enable SMTP authentication
    $mail->SMTPAuth = $configuracao['smtp']['user'] && $configuracao['smtp']['senha'] ? true : false;
    if($configuracao['smtp']['user'] && $configuracao['smtp']['senha'] && $configuracao['smtp']['port']){
        $mail->Username = $configuracao['smtp']['user']; // Usu??rio do servidor SMTP
        $mail->Password = $configuracao['smtp']['senha']; // Senha do servidor SMTP
        $mail->Port = $configuracao['smtp']['port'];
    }

    $mail->From = $configuracao['smtp']['from']; // Seu e-mail
    $mail->FromName = $configuracao['smtp']['fromName']; // Seu nome
    $mail->AddReplyTo($replyTo ? $replyTo : $configuracao['smtp']['from'], $configuracao['smtp']['fromName']);

    if($anexos){
        $qtdeAnexo = count($anexos);
        for($i=0;$i<$qtdeAnexo;$i++){
            $mail->AddAttachment($anexos[$i]['url'],$anexos[$i]['name']);
        }
    }

    $mail->Subject    = $assunto;
    $mail->MsgHTML($content);
    $qtdeEmail = count($emails);
    for($i=0;$i<$qtdeEmail;$i++){
        $mail->AddAddress($emails[$i]);
    }
    $mail->IsHTML(true); // send as HTML
    $result = false;
    if ($mail->send()) {
        $result = true;
    }

    return $result;
}

public function listaTreinamentosInscritos($lista){    
    $listaReturn = array();

    for($i = 0; $i < $lista['num']; $i++){
        $listaReturn[$i] = $lista[$i]->id_treinamento;
    }

    return $listaReturn;
}

public function enviaEmailSugestao($emails=null, $replyTo=null, $assunto=null, $tipo=null, $anexos=null){
    $configuracao = Config::AtributosConfig();
    include_once(dirname(__FILE__)."/../inc/smtp/class.phpmailer.php");
    // monta Msg
    $messg  = "";

    $content = file_get_contents(dirname(__FILE__).'/../inc/email/sugestao.php');

    switch ($tipo) {
        case 'Sugest??o':
            $content = str_replace('{MENSAGEM}',        'Ol??! Agradecemos a mensagem. <br/>Sua sugest??o ?? muito importante e bem-vinda.', $content);
            break;
        case 'Reclama????o':
            $content = str_replace('{MENSAGEM}',        'Ol??! Agradecemos o contato. <br/> Sua opini??o ?? muito importante para n??s. <br/>Vamos analisar e tomar as medidas necess??rias referentes aos seus coment??rios.', $content);
            break;
        case 'D??vida':
            $content = str_replace('{MENSAGEM}',        'Ol??! <br/> Agradecemos o contato. <br/>Obrigado!', $content);
            break;
        default:
            # code...
            break;
    }

    $mail             = new PHPMailer();

    $mail->IsSMTP(); // Define que a mensagem ser?? SMTP
    // $mail->SMTPDebug  = 2;
    $mail->Host = $configuracao['smtp']['host']; // Endere??o do servidor SMTP
    $mail->CharSet   = 'UTF-8';                  // enable SMTP authentication
    $mail->SMTPAuth = $configuracao['smtp']['user'] && $configuracao['smtp']['senha'] ? true : false;
    if($configuracao['smtp']['user'] && $configuracao['smtp']['senha'] && $configuracao['smtp']['port']){
        $mail->Username = $configuracao['smtp']['user']; // Usu??rio do servidor SMTP
        $mail->Password = $configuracao['smtp']['senha']; // Senha do servidor SMTP
        $mail->Port = $configuracao['smtp']['port'];
    }

    $mail->From = $configuracao['smtp']['from']; // Seu e-mail
    $mail->FromName = $configuracao['smtp']['fromName']; // Seu nome
    $mail->AddReplyTo($replyTo ? $replyTo : $configuracao['smtp']['from'], $configuracao['smtp']['fromName']);

    if($anexos){
        $qtdeAnexo = count($anexos);
        for($i=0;$i<$qtdeAnexo;$i++){
            $mail->AddAttachment($anexos[$i]['url'],$anexos[$i]['name']);
        }
    }

    $mail->Subject    = $assunto;
    $mail->MsgHTML($content);
    $qtdeEmail = count($emails);
    for($i=0;$i<$qtdeEmail;$i++){
        $mail->AddAddress($emails[$i]);
    }
    $mail->IsHTML(true); // send as HTML
    $result = false;
    if ($mail->send()) {
        $result = true;
    }

    return $result;
}


    /**
     * (PHP 4, PHP 5)<br/>
     * Retorna o dia da semana
     * @param int $dia <p>
     * O dia da semana, representando por
     * <ul>
     *     <li>0 - Domingo</li>
     *     <li>1 - Segunda-feira</li>
     *     <li>2 - Ter??a-feira</li>
     *     <li>3 - Quarta-feira</li>
     *     <li>4 - Quinta-feira</li>
     *     <li>5 - Sexta-feira</li>
     *     <li>6 - S??bado</li>
     * </ul>
     * </p>
     * @return string (dia da semana), sen??o um valor nulo (null)
     */
    public function retornaDiaSemana($dia) {

        $strDia = null;

        switch ($dia) {

            case 0:
                $strDia = "Dom.";
                break;
            case 1:
                $strDia = "Seg.";
                break;
            case 2:
                $strDia = "Ter.";
                break;
            case 3:
                $strDia = "Qua.";
                break;
            case 4:
                $strDia = "Qui.";
                break;
            case 5:
                $strDia = "Sex.";
                break;
            case 6:
                $strDia = "S??b.";
                break;
            default:
                $strDia = null;
                break;
        }

        return $strDia;
    }

    public function cadUsuarioNewsletterGeral($form) {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://www.pixelgo.com.br/ctrl.php?acao=emailNaLista");
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);


        foreach ($form as $param => $value) {
            $parametros .= "&$param=$value";
        }

        $parametros = substr($parametros, 1);

        if ($form->ip != "") {
            $parametros . "&remoteAddr=" . $form->ip;
        }

        curl_setopt($curl, CURLOPT_POSTFIELDS, $parametros);
        //echo $form->ip;
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);

        $retorno = curl_exec($curl);

        curl_close($curl);
        if ($retorno == "sucess")
            return true;
        else if ($retorno == "error" || $retorno == "")
            return false;
    }

    public function utf8Array($array, $codifica) {

        $keys = array_keys($array);

        for ($i = 0; $i < count($keys); $i++) {

            //se n??o for um array

            if (!is_array($array[$keys[$i]])) {

                if ($codifica == "encode") {

                    $array[$keys[$i]] = utf8_encode($array[$keys[$i]]);
                } else {

                    $array[$keys[$i]] = utf8_decode($array[$keys[$i]]);
                }
            } else {

                $array[$keys[$i]] = $this->utf8Array($array[$keys[$i]], $codifica);
            }
        }



        return $array;
    }
    
    function removerAcentos($string){
        $min = array('??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','O','??','??','??','Y','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??','??');
        $minSem = array('A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','O','U','U','U','Y','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y');
        
        $string = str_replace($min, $minSem, $string);
        
        return $string;
    }  

    ##################################################################################################
    ## Mensagem de TRUE, mensagem de FALSE, resultado da opera????o TRUE ou FALSE, pagina para exibir ##
    ##################################################################################################

    public function showResult($true, $false, $result, $tipo, $frm="", $notificacao=true) {

        //verifica o resultado

        if ($result) {
            $msg = $true;
            $tipo = "success";
        } else {

            $msg = $false;
            $tipo = "error";
        }



        //abre a tag script

        echo "<script type='text/javascript'>";

        

        if($frm != ""){
          if($notificacao == true){
          echo "parent.showNotification({
                    message: \"$msg\",
                    autoClose: true,
                    duration: 2,
                    type: \"$tipo\"
                });";
              echo "setTimeout(function(){parent.window.location.href='".$frm."'}, 800); ";

          }
        }

        echo "</script>";
    }

    #######################
    ## CRIA UM DIRET??RIO ##
    #######################

    public function criaDir($dir) {

        //se o diretorio n??o existir

        if (!file_exists($dir)) {

            $result = mkdir($dir, 0777);

            chmod($dir, 0777);
        } else {

            $result = true;
        }



        return $result;
    }

    ##################
    ## DELETA PASTA ##
    ##################

    public function delDir($diretorio) {

        @chmod($diretorio, 0777);

        $dh = opendir(($dir = $diretorio));

        while (false !== ($filename = readdir($dh))) {

            if (is_file("$dir$filename") && !($filename == '.' || $filename == '..')) {

                @chmod($filename, 0777);

                unlink("$dir$filename");
            }
        }

        if (!@rmdir("$diretorio")) {

            print "FALHA AO DELETAR!";
        }
    }

    #######################
    ## DELETA UM ARQUIVO ##
    #######################

    public function delFile($file) {

        if (file_exists($file)) {

            $result = unlink($file);
        } else {

            $result = true;
        }

        return $result;
    }

    ###################
    ## CONVERTE DATA ##
    ###################

    public function converteData($data) {

        if (strstr($data, "/")) {

            $A = explode("/", $data);

            $V_data = $A[2] . "-" . $A[1] . "-" . $A[0];
        } else {

            $A = explode("-", $data);

            $V_data = $A[2] . "/" . $A[1] . "/" . $A[0];
        }

        return $V_data;
    }
    public function converteDataHora($data) {

        if (strstr($data, "/")) {
            $H = explode(' ',$data);
            
            $A = explode("/", $H[0]);

            $V_data = $A[2] . "-" . $A[1] . "-" . $A[0] . ' '. $H[1];
        } else {
            $H = explode(' ',$data);
            
            $A = explode("-", $H[0]);

            $V_data = $A[2] . "/" . $A[1] . "/" . $A[0] . ' '. $H[1];
        }

        return $V_data;
    }

    public function dataHora($dataHora) {

        list($data, $hora) = explode(" ", $dataHora);



        $A = explode("-", $data);

        $V_data = $A[2] . "/" . $A[1] . "/" . $A[0];



        $dt["data"] = $V_data;

        $dt["hora"] = $hora;



        return $dt;
    }

    #######################
    ## LIMITA CARACTERES ##
    #######################

    public function limitaCarac($string, $maximo) {

        if (strlen($string) > $maximo) {

            $texto = utf8_encode(substr(utf8_decode($string), 0, $maximo)) . "...";
        } else {

            $texto = $string;
        }

        return $texto;
    }

    ############################
    ## RETORNA A URL DO V??DEO ##
    ############################

    public function urlVideo($string) {

        //se tiver cadastrando o <object

        if (substr($string, 0, 7) == "<object") {

            $arrayString = explode('"', $string);

            return substr($arrayString[7], 0, -1);
        } elseif (stristr($string, 'watch?v=')) {

            $arrayString = explode("watch?v=", $string);

            return $string = "http://www.youtube.com/v/" . $arrayString[count($arrayString) - 1] . "&hl=en";
        } else {

            return $string;
        }
    }

    public function montaVideoYoutube($string,$largura,$altura) {

        //se tiver cadastrando o <object

        if (substr($string, 0, 7) == "<object") {

            $arrayString = explode('"', $string);

            return substr($arrayString[7], 0, -1);
        } elseif (stristr($string, 'watch?v=')) {

            $arrayString = explode("watch?v=", $string);

            $video = null;

            $video = '<object width="'.$largura.'" height="'.$altura.'">';
            $video .= '<param name="movie" value="http://www.youtube.com/v/'. $arrayString[count($arrayString) - 1] .'" />';
            $video .= '<param name="wmode" value="transparent" />';
            $video .= '<embed src="http://www.youtube.com/v/'. $arrayString[count($arrayString) - 1] .'" type="application/x-shockwave-flash" wmode="transparent" width="'.$largura.'" height="'.$altura.'" />';
            $video .= '</object>';

            //return $string = "http://www.youtube.com/v/" . $arrayString[count($arrayString) - 1] . "&hl=en";
            return $string = $video;
        } else {

            return $string;
        }
    }

    //retorna a url certa do video do youtube

    public function urlYouTube($string) {

        //se tiver cadastrando o <object

        if (substr($string, 0, 7) == "<object") {

            $arrayString = explode('"', $string);

            return substr($arrayString[7], 0, -1);
        } elseif (stristr($string, 'watch?v=')) {

            $arrayString = explode("watch?v=", $string);

            return $string = "http://www.youtube.com/v/" . $arrayString[count($arrayString) - 1] . "&hl=en";
        } else {

            return $string;
        }
    }

    ######################################
    ## RETORNA A URL DA IMAGEM DO VIDEO ##
    ######################################
    //http://www.youtube.com/v/qYAqtth4cNE&hl=en
    //http://i.ytimg.com/vi/qYAqtth4cNE/default.jpg

    public function urlImgVideo($string) {

        //se tiver cadastrando o <object

        if (substr($string, 0, 7) == "<object") {

            $arrayString = explode('"', $string);

            $string = substr($arrayString[7], 0, -1);
        } elseif (stristr($string, 'watch?v=')) {

            $arrayString = explode("watch?v=", $string);

            $string = "http://www.youtube.com/v/" . $arrayString[count($arrayString) - 1] . "&hl=en";
        }



        $aux = explode("/", $string);

        $aux2 = $aux[count($aux) - 1];

        $aux3 = explode("&", $aux2);



        $string = "http://i.ytimg.com/vi/" . $aux3[0] . "/default.jpg";

        return $string;
    }

    ################################
    ## FAZ O UPLOAD DE UM ARQUIVO ##
    ################################

    public function uploadArq($img_tmp, $img_name) {

        if (move_uploaded_file($img_tmp, $img_name)) {

            return true;
        } else {

            return false;
        }
    }

    ###############################
    ## FORMATA O NOME DO ARQUIVO ##
    ###############################

    public function nameArq($name, $slug = false) {

        $string = strtolower($name);

		// C??digo ASCII das vogais
		$ascii['a'] = range(224, 230);
		$ascii['e'] = range(232, 235);
		$ascii['i'] = range(236, 239);
		$ascii['o'] = array_merge(range(242, 246), array(240, 248));
		$ascii['u'] = range(249, 252);
	
		// C??digo ASCII dos outros caracteres
		$ascii['b'] = array(223);
		$ascii['c'] = array(231);
		$ascii['d'] = array(208);
		$ascii['n'] = array(241);
		$ascii['y'] = array(253, 255);
	
		foreach ($ascii as $key=>$item) {
			$acentos = '';
			foreach ($item AS $codigo) $acentos .= chr($codigo);
			$troca[$key] = '/['.$acentos.']/i';
		}
	
		$string = preg_replace(array_values($troca), array_keys($troca), $string);
	
		// Slug?
		if ($slug) {
			// Troca tudo que n??o for letra ou n??mero por um caractere ($slug)
			$string = preg_replace('/[^a-z0-9]/i', $slug, $string);
			// Tira os caracteres ($slug) repetidos
			$string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
			$string = trim($string, $slug);
		}
	
		return $string;
    }

    ####################
    ## REMOVE ACENTOS ##
    ####################

    function urlName($str) {

        $str = strtolower(utf8_decode($str)); $i=1;
	    $str = strtr($str, utf8_decode('??????????????????????????????????????????????????????????'), 'aaaaaaaceeeeiiiinoooooouuuyyy');
	    $str = preg_replace("/([^a-z0-9])/",'-',utf8_encode($str));
	    while($i>0) $str = str_replace('--','-',$str,$i);
	    if (substr($str, -1) == '-') $str = substr($str, 0, -1);
	    return $str;
    }

    ###########################################################
    ## RETIRA TODOS OS CARCTERES QUE D??O PROBLEMA NO OVERLIB ##
    ###########################################################

    function adequaOverlib($string) {

        $string = htmlspecialchars($string);



        $string = str_replace("\/", "", $string);



        //$string = str_replace("\n","",$string);



        $string = nl2br($string);



        return $string;
    }

    ##################################
    ## FORMATA UM NUMERO PARA MOEDA ##
    ##################################

    function moeda($valor) {

        if (($valor == 0) or ($valor == "")) {

            return "";
        } else {

            $valor = number_format($valor, "2", ",", ".");

            return "R$ " . $valor;
        }
    }

    ##################################
    ## RETORNA O FORMATO DO ARQUIVO ##
    ##################################

    function formatoFile($file) {

        //list($lixo,$formato) = explode(".",$file);
        $lista = explode(".", $file);
        $formato = $lista[count($lista) - 1];


        return strtolower($formato);
    }

    ##################################
    ## RETORNA O FORMATO DO ARQUIVO ##
    ##################################

    function nameFile($file) {

        list($lixo, $formato) = explode(".", $file);



        return $lixo;
    }

    ## GRAVA O LOG DE UM ALTERA????O ##

    function gravaLog($usuario, $area, $id_area, $acao, $ip="") {
		
        global $sqlGl;
        
        $aDados = array(
	        		array(
	        				'usuario' => $usuario,
	        				'area' => $area,
	        				'id_area' => $id_area,
	        				'acao' => $acao,
	        				'datahora' => date("Y-m-d H:i:s"),
	        				'ip' => $ip,
	        		)
        );
        
        $result = $sqlGl->insertInto('logs',$aDados);
        $lastInsert = $result->execute();
        
        return $lastInsert;
    }

    ## DELETA OS LOGS COM MAIS DE 7 DIAS ##
    function limpaLog() {
    	global $sqlGl;

        //numero de dias que o log fica no banco
        $numDias = 7;

        //calcula a data limite que o arquivo pode ficar no banco

        $dataLimite = date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d") - $numDias, date("Y")));

        
        
        $result = $sqlGl->deleteFrom("logs")->where('datahora <= :datahora',array(':datahora' => $dataLimite));
        $result = $result->execute();
        
        return $result;
    }

    ## verifica se o email ?? valido ##

    function validaEmail($email) {

        if (eregi("^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,3}$", $email)) {

            return true;
        } else {

            return false;
        }
    }

    ###################
    ## GERA UM THUMB ##
    ###################

    function geraThumb($origem, $destino, $largura, $altura, $pre='', $formato='JPEG', $prioridade='') {

        switch (strtoupper($formato)) {

            case 'JPEG':

                $tn_formato = 'jpg';

                break;

            case 'JPG':

                $tn_formato = 'jpg';

                break;

            case 'PNG':

                $tn_formato = 'png';

                break;

            case 'GIF':

                $tn_formato = 'gif';

                break;
        }

        $ext = split("[/\\.]", strtolower($origem));

        $n = count($ext) - 1;

        $ext = $ext[$n];



        $arr = split("[/\\]", $origem);

        $n = count($arr) - 1;

        $arra = explode('.', $arr[$n]);

        $n2 = count($arra) - 1;

        $tn_name = str_replace('.' . $arra[$n2], '', $arr[$n]);

        $destino = $destino . $pre . $tn_name . '.' . $tn_formato;



        if ($ext == 'jpg' || $ext == 'jpeg') {

            $im = imagecreatefromjpeg($origem);
        } elseif ($ext == 'png') {

            $im = imagecreatefrompng($origem);
        } elseif ($ext == 'gif') {

            $im = imagecreatefromgif($origem);
        }



        ## INI C??LCULO DO TAMANHO DA IMAGEM ##

        $w = imagesx($im);

        $h = imagesy($im);

        if ($prioridade == '') {

            if ($w > $h) {

                $nw = $largura;

                $nh = ($h * $largura) / $w;
            } else {

                $nh = $altura;

                $nw = ($w * $altura) / $h;
            }
        } elseif ($prioridade == 'vert') {

            $nh = $altura;

            $nw = ($w * $altura) / $h;
        } elseif ($prioridade == 'hori') {

            $nw = $largura;

            $nh = ($h * $largura) / $w;
        }

        ## FIM C??LCULO DO TAMANHO DA IMAGEM ##



        if (function_exists('imagecopyresampled')) {

            if (function_exists('imageCreateTrueColor')) {

                $ni = imageCreateTrueColor($nw, $nh);
            } else {

                $ni = imagecreate($nw, $nh);
            }

            if ($tn_formato == 'png') {

                imagealphablending($ni, false);

                $colorTransparent = imagecolorallocatealpha($ni, 0, 0, 0, 127);

                imagefill($ni, 0, 0, $colorTransparent);

                imagesavealpha($ni, true);

                imagepng($ni, $destino);
            }

            if (!@imagecopyresampled($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h)) {

                imagecopyresized($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
            }
        } else {

            $ni = imagecreate($nw, $nh);

            imagecopyresized($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
        }

        if ($tn_formato == 'jpg') {

            imagejpeg($ni, $destino, 100);
        } elseif ($tn_formato == 'png') {

            imagepng($ni, $destino);
        } elseif ($tn_formato == 'gif') {

            imagegif($ni, $destino);
        }
    }

    ###################
    ## GERA UM THUMB ##
    ###################

    function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale, $formato='') {

        $newImageWidth = ceil($width * $scale);

        $newImageHeight = ceil($height * $scale);

        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);

        switch (strtolower($formato)) {

            case "jpeg":

                $source = imagecreatefromjpeg($image);

                imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);

                imagejpeg($newImage, $thumb_image_name, 90);

                break;

            case "jpg":

                $source = imagecreatefromjpeg($image);

                imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);

                imagejpeg($newImage, $thumb_image_name, 90);

                break;

            case "gif":

                $source = imagecreatefromgif($image);

                imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);

                imagegif($newImage, $thumb_image_name);

                break;

            case "png":

                $source = imagecreatefrompng($image);

                imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);

                imagepng($newImage, $thumb_image_name);

                break;

            default:

                $source = imagecreatefromjpeg($image);

                imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);

                imagejpeg($newImage, $thumb_image_name, 90);

                break;
        }

        //chmod($thumb_image_name, 0777);
        //return $thumb_image_name;
    }

    ######################################
    ##		CALCULA REGRA DE TRES		##
    ######################################

    function regraDeTres($num, $total) {

        $resposta = ($num * 100) / $total;
        return number_format($resposta, 1);
    }

    #######################################################
    ##	VERIFICA SE O DOMINIO DO EMAIL INFORMADO EXISTE	 ##
    #######################################################

    function validaDns($email) {

        if (checkdnsrr(array_pop(explode("@", $email)), "MX")) {

            return true;
        } else {

            return false;
        }
    }

    ###########################################
    ##	RETORNA OS EMAILS DE UM ARQUIVO CSV	 ##
    ###########################################

    function importadorCSV($arquivo, $origem) {

        //array para armazenar os emails

        $emails = array();

        //cria o ponteiro para o arquivo

        $fp = fopen($arquivo, "r");

        //le os dados do arquivo

        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {

            //verifica se a origem eh do orkut(0) ou do gmail(1)

            if ($origem == "0") {//orkut
                if (strstr($data[2], "@")) {

                    $emails[] = $data[2];
                }
            } elseif ($origem == "1") {//gmail
                if (strstr($data[1], "@")) {

                    $emails[] = strip_tags($data[1]);
                }
            }
        }

        //fecha o arquivo

        fclose($fp);



        //retorna os emails

        return $emails;
    }

    ###########################################
    ##	RETORNA OS EMAILS DE UM ARQUIVO XML	 ##
    ###########################################

    function importadorXML($arquivo) {

        //array para armazenar os emails

        $emails = array();

        //le o arquivo xml

        $data = implode("", file($arquivo));

        $p = xml_parser_create();

        xml_parse_into_struct($p, $data, $vals, $index);

        xml_parser_free($p);

        // do array

        $num = count($vals);

        //faz o la??o pegando todos os emails

        for ($i = 0; $i < $num; $i++) {

            //se o tipo for completo pega o valor do campo

            if ($vals[$i]["type"] == "complete") {

                $emails[] = $vals[$i]["value"];
            }
        }



        //retorna os emails

        return $emails;
    }

    ###########################################
    ##	RETORNA OS EMAILS DE UM ARQUIVO XLS	 ##
    ###########################################

    function importadorXLS($arquivo, $posicao=1) {

        //inclui arquivo para ler o arquivo excel

        require_once '../inc/Excel/reader.php';

        //estancia o objeto

        $data = new Spreadsheet_Excel_Reader();

        // Seta a codificacao de saida

        $data->setOutputEncoding('CP1251');

        //le o arquivo xls

        $data->read($arquivo);



        //armazena os dados do xls

        $dados = "";

        //le todo o arquivo xls

        for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {

            for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {

                //$dados .= "\"".$data->sheets[0]['cells'][$i][$j]."\",";

                $dados .= $data->sheets[0]['cells'][$i][$j] . ",";
            }

            $dados .= "\n";
        }

        //pega as linhas

        $linhas = explode(",\n", $dados);

        //percorre as linhas separando os campos

        for ($i = 0; $i < count($linhas); $i++) {

            $pessoas[$i] = explode(",", $linhas[$i]);
        }



        $emails = array();

        //armazena os emails

        for ($i = 0; $i < count($pessoas); $i++) {

            if (strstr($pessoas[$i][$posicao], "@")) {

                $emails[] = $pessoas[$i][$posicao];
            }
        }



        //retorna os emails

        return $emails;
    }

    function rmEmailByCsvOut($arquivo) {

        //array para armazenar os emails

        $emails = array();

        //cria o ponteiro para o arquivo

        $fp = fopen($arquivo, "r");

        //le os dados do arquivo

        $i = 0;

        while (($data = fgetcsv($fp, 9999, ",")) !== FALSE) {

            $dados[$i]["assunto"] = $data[0];

            $dados[$i]["corpo"] = $data[1];

            $dados[$i]["remet_nome"] = $data[2];

            $i++;
        }

        //fecha o arquivo

        fclose($fp);



        //retorna os emails

        return $dados;
    }

    public function retornaMesExtenso($date){

        //	$mes = substr($date, 5,2);
        
            switch ($date){
        
                case '01';
        
                    $mesRetorno = "Janeiro";
        
                break;
        
                case '02';
        
                    $mesRetorno = "Fevereiro";
        
                break;
        
                case '03';
        
                    $mesRetorno = "Mar??o";
        
                break;
        
                case '04';
        
                    $mesRetorno = "Abril";
        
                break;
        
                case '05';
        
                    $mesRetorno = "Maio";
        
                break;
        
                case '06';
        
                    $mesRetorno = "Junho";
        
                break;
        
                case '07';
        
                    $mesRetorno = "Julho";
        
                break;
        
                case '08';
        
                    $mesRetorno = "Agosto";
        
                break;
        
                case '09';
        
                    $mesRetorno = "Setembro";
        
                break;
        
                case '10';
        
                    $mesRetorno = "Outubro";
        
                break;
        
                case '11';
        
                    $mesRetorno = "Novembro";
        
                break;
        
                case '12';
        
                    $mesRetorno = "Dezembro";
        
                break;
        
            }
        
        
        
            return $mesRetorno;
        
        }

    function enc($string) {

        if ((isset($string)) && (is_string($string))) {

            $enc_string = base64_encode($string);

            $enc_string = str_replace("=", "", $enc_string);

            $enc_string = strrev($enc_string);

            $md5 = md5($string);

            $enc_string = substr($md5, 0, 3) . $enc_string . substr($md5, -3);
        }

        return $enc_string;
    }

    function des($string) {

        if ((isset($string)) && (is_string($string))) {

            $ini = substr($string, 0, 3);

            $end = substr($string, -3);

            $des_string = substr($string, 0, -3);

            $des_string = substr($des_string, 3);

            $des_string = strrev($des_string);

            $des_string = base64_decode($des_string);

            $md5 = md5($des_string);

            $ver = substr($md5, 0, 3) . substr($md5, -3);



            if ($ver != $ini . $end) {

                $des_string = "Erro na desencripta????o!";
            }
        }

        return $des_string;
    }

    #########################################################################################
    #	FUN????O QUE TRANSFORMA OS CARACTERES ESPECIAIS EM FORMATO ACEITO PELO JAVASCRIPT		#
    #########################################################################################

    function jschars($str) {

        $str = str_replace("'", "", $str);

        $str = str_replace("\"", "", $str);

        $str = mb_ereg_replace("\\\\", "\\\\", $str);

        $str = mb_ereg_replace("\"", "\\\"", $str);

        $str = mb_ereg_replace("'", "\\'", $str);

        $str = mb_ereg_replace("\r\n", "\\n", $str);

        $str = mb_ereg_replace("\r", "\\n", $str);

        $str = mb_ereg_replace("\n", "\\n", $str);

        $str = mb_ereg_replace("\t", "\\t", $str);

        $str = mb_ereg_replace("<", "\\x3C", $str); // for inclusion in HTML

        $str = mb_ereg_replace(">", "\\x3E", $str);

        return $str;
    }

    function encodeObj(&$obj) {
        foreach ($obj as &$attr) {
            if (is_object($attr)) {
                $this->encodeObj($attr);
            } elseif (is_array($attr)) {
                $this->encodeArray($attr);
            } else {
                $attr = utf8_encode($attr);
            }
        }
        return $obj;
    }

    function encodeArray(&$array) {

        foreach ($array as &$elem) {
            if (is_array($elem)) {
                $this->encodeArray($elem);
            } elseif (is_object($elem)) {
                $this->encodeObj($elem);
            } else {
                $elem = utf8_encode($elem);
            }
        }
        return $array;
    }

    function encode(&$var) {
        if (is_array($var)) {
            $this->encodeArray($var);
        } else if (is_object($var)) {
            $this->encodeObj($var);
        } else {
            $var = utf8_encode($var);
        }
        return $var;
    }

    //Decode

    function decodeObj(&$obj) {
        foreach ($obj as &$attr) {
            if (is_object($attr)) {
                $this->decodeObj($attr);
            } elseif (is_array($attr)) {
                $this->decodeArray($attr);
            } else {
                $attr = utf8_decode($attr);
            }
        }
        return $obj;
    }

    function decodeArray(&$array) {

        foreach ($array as &$elem) {
            if (is_array($elem)) {
                $this->decodeArray($elem);
            } elseif (is_object($elem)) {
                $this->decodeObj($elem);
            } else {
                $elem = utf8_decode($elem);
            }
        }
        return $array;
    }

    function decode(&$var) {
        if (is_array($var)) {
            $this->decodeArray($var);
        } else if (is_object($var)) {
            $this->decodeObj($var);
        } else {
            $var = utf8_decode($var);
        }
        return $var;
    }

    function numeros($strCampo) {
        $strCampo = str_replace(".", "", $strCampo);
        $strCampo = str_replace("-", "", $strCampo);
        $strCampo = str_replace("/", "", $strCampo);
        $strCampo = str_replace("(", "", $strCampo);
        $strCampo = str_replace(")", "", $strCampo);
        $strCampo = str_replace("[", "", $strCampo);
        $strCampo = str_replace("]", "", $strCampo);
        $strCampo = str_replace("{", "", $strCampo);
        $strCampo = str_replace("}", "", $strCampo);
        $strCampo = str_replace(" ", "", $strCampo);
        return $strCampo;
    }

    function formatarCPF($campo, $formatado = true) {
        //retira formato
        $codigoLimpo = ereg_replace("[' '-./ t]", '', $campo);
        // pega o tamanho da string menos os digitos verificadores
        $tamanho = (strlen($codigoLimpo) - 2);
        //verifica se o tamanho do c??digo informado ?? v??lido
        if ($tamanho != 9 && $tamanho != 12) {
            return false;
        }

        if ($formatado) {
            // seleciona a m??scara para cpf ou cnpj
            $mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##';

            $indice = -1;
            for ($i = 0; $i < strlen($mascara); $i++) {
                if ($mascara[$i] == '#')
                    $mascara[$i] = $codigoLimpo[++$indice];
            }
            //retorna o campo formatado
            $retorno = $mascara;
        }else {
            //se n??o quer formatado, retorna o campo limpo
            $retorno = $codigoLimpo;
        }

        return $retorno;
    }

    function mascara($mascara, $palavra) {
        $pont_palavra = 0;
        $resultado = "";
        if (strlen(trim($palavra)) > 0)
            for ($i = 0; $i < strlen($mascara); $i++) {
                $mascara_char = substr($mascara, $i, 1);
                if ($mascara_char == '#') {
                    $resultado .= substr($palavra, $pont_palavra, 1);
                    $pont_palavra++;
                } else {
                    $resultado .= $mascara_char;
                }
            }
        return $resultado;
    }

    function arredonda($numero,$numCasasDecimais=2) {
        return (round($numero*pow(10,$numCasasDecimais)))/pow(10,$numCasasDecimais);
    }
    
    function mes_nome($data){
    $data = explode("-",$data);
    $texto = $data[1];
    $_texto_para_mes = array(
        '01' => "jan",
        '02' => "fev",
        '03' => "mar",
        '04' => "abr",
        '05' => "mai",
        '06' => "jun",
        '07' => "jul",
        '08' => "ago",
        '09' => "set",
        '10' => "out",
        '11' => "nov",
        '12' => "dez"
    );
    $texto = strtolower(substr($texto, 0, 3));
    return $_texto_para_mes[$texto];
    }
    
    function data_dia($data){
    $data = explode("-",$data);
    return $data[2];
    }
    
    
    //
// change Facebook status with curl
// Thanks to Alste (curl stuff inspired by nexdot.net/blog)
function setFacebookStatus($status, $login_email, $login_pass, $debug=false) {
    //CURL stuff
    //This executes the login procedure
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://login.facebook.com/login.php?m&amp;next=http%3A%2F%2Fm.facebook.com%2Fhome.php');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'email=' . urlencode($login_email) . '&pass=' . urlencode($login_pass) . '&login=' . urlencode("Log in"));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "my_cookies.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "my_cookies.txt");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //make sure you put a popular web browser here (signature for your web browser can be retrieved with 'echo $_SERVER['HTTP_USER_AGENT'];'
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.12) Gecko/2009070611 Firefox/3.0.12");
    curl_exec($ch);
 
    //This executes the status update
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_URL, 'http://m.facebook.com/home.php');
    $page = curl_exec($ch);
 
    //echo htmlspecialchars($page);
 
    curl_setopt($ch, CURLOPT_POST, 1);
    //this gets the post_form_id value
    preg_match("/input type=\"hidden\" name=\"post_form_id\" value=\"(.*?)\"/", $page, $form_id);
    preg_match("/input type=\"hidden\" name=\"fb_dtsg\" value=\"(.*?)\"/", $page, $fb_dtsg);
    preg_match("/input type=\"hidden\" name=\"charset_test\" value=\"(.*?)\"/", $page, $charset_test);
    preg_match("/input type=\"submit\" class=\"button\" name=\"update\" value=\"(.*?)\"/", $page, $update);
 
    //we'll also need the exact name of the form processor page
    //preg_match("/form action=\"(.*?)\"/", $page, $form_num);
    //sometimes doesn't work so we search the correct form action to use
    //since there could be more than one form in the page.
    preg_match_all("#<form([^>]*)>(.*)</form>#Ui", $page, $form_ar);
    for($i=0;$i<count($form_ar[0]);$i++)
        if(stristr($form_ar[0][$i],"post_form_id")) preg_match("/form action=\"(.*?)\"/", $page, $form_num);    
 
    $strpost = 'post_form_id=' . $form_id[1] . '&status=' . urlencode($status) . '&update=' . urlencode($update[1]) . '&charset_test=' . urlencode($charset_test[1]) . '&fb_dtsg=' . urlencode($fb_dtsg[1]);
    if($debug) {
        echo "Parameters sent: ".$strpost."<hr>";
    }
    curl_setopt($ch, CURLOPT_POSTFIELDS, $strpost );
 
    //set url to form processor page
    curl_setopt($ch, CURLOPT_URL, 'http://m.facebook.com' . $form_num[1]);
    curl_exec($ch);
 
    if ($debug) {
        //show information regarding the request
        print_r(curl_getinfo($ch));
        echo curl_errno($ch) . '-' . curl_error($ch);
        echo "<br><br>Your Facebook status seems to have been updated.";
    }
    //close the connection
    curl_close($ch);
}


function addEmailALista($email,$username,$token,$lista,$urlXml){
    
    $xml = '
    <xmlrequest>
    <username>'.$username.'</username>
    <usertoken>'.$token.'</usertoken>
    <requesttype>subscribers</requesttype>
    <requestmethod>AddSubscriberToList</requestmethod>
    <details>
    <emailaddress>' . $email . '</emailaddress>
    <mailinglist>'.$lista.'</mailinglist>
    <format>html</format>
    <confirmed>yes</confirmed>
    </details>
    </xmlrequest>
    ';
    $ch = curl_init($urlXml);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    $result = @curl_exec($ch);

    if($result){
        return true;
    }
}

    ##################################
    ## FORMATA UMA MOEDA PARA FLOAT ##
    ##################################

    function moedaFloat($valor) {

        if (($valor == 0) or ($valor == "")) {

            return "";
        } else {

            $valor = str_replace(",", ".",str_replace(".", "",$valor));

            return "" . $valor;
        }
    }
    
public function TamanhodaImagem($imagem){

    // vamos obter as dimens??es da imagem
    list($largura, $altura) = @getimagesize($imagem);

    // houve erro?
    if(empty($largura)){
      echo "Houve algum erro ao obter as dimens??es da imagem";
    }
    
    $array["largura"] = $largura;
    $array["altura"] = $altura;
    
    return $array;
    
}   

public function soLetrasENumeros($value)
{
	$texto = $value;
	$limpo = preg_replace("/[^a-zA-Z0-9\s]/", "", $texto);
	return $limpo;
} 

/**
 * @package SYS
 */

/**
 * Converte data no formato unix timestamp para o formato intelegivel d/m/Y
 *
 * @param timestamp $date
 * @return string
 */
function datetostr($date = 'mktime') {
	if ($date == 'mktime') {	
		$date = time();
	}
	if (!$date)
		return '';
	if (!is_numeric($date)) {
		$msg = 'Erro na fun????o: ' . __FUNCTION__ . "\n";
		$msg .= 'O par??metro $date enviado(' . $date . ') n??o corresponde a um timestamp v??lido.';
		throw new Exception($msg);
	}
	return date('d/m/Y', $date);
}

function dateFormatBr($date){
	$aux = explode('-', $date);
	$data = $aux[2].'/'.$aux[1].'/'.$aux[0];
	return $data ;
}

function dateFormatEn($date){
	$aux = explode('/', $date);
	$data = $aux[2].'-'.$aux[1].'-'.$aux[0];
	return $data ;
}

/**
 * Fun????o que faz abrevia????o de nomes de pessoas
 * Ex:
 * <code>
 * echo KM_abreviarNome('jo??o pedro da silva dos santos');
 * //Resultado: "Jo??o P. S. Santos"
 * </code>
 *
 * @param string $sNome
 * @return string
 */
function KM_abreviarNome($sNome) {
	$aNome = explode(' ', $sNome);
	$j = count($aNome);
	for ($i = 1; $i < $j - 1; $i++) {
		if (strlen($aNome[$i]) <= 3) {
			unset($aNome[$i]);
		} else {
			$aNome[$i] = substr($aNome[$i], 0, 1) . '.';
		}
	}
	return ucwords(strtolower(join(' ', $aNome)));
}


/**
 * Escreve um numero por extenso
 *
 * @param integer $iNumero
 * @return strinc
 */
function KM_extensoNumero($iNumero) {
	$aUnidade = array(
					'', 
					'um', 
					'dois', 
					'tr??s', 
					'quatro', 
					'cinco', 
					'seis', 
					'sete', 
					'oito', 
					'nove', 
					'dez', 
					'onze', 
					'doze', 
					'treze', 
					'quatorze', 
					'quinze', 
					'dezesseis', 
					'dezessete', 
					'dezoito', 
					'dezenove');
	$aDezena = array('', '', 'vinte', 'trinta', 'quarenta', 'cinq??enta', 'sessenta', 'setenta', 'oitenta', 'noventa');
	
	$aCentena = array(
					'cem', 
					'cento', 
					'duzentos', 
					'trezentos', 
					'quatrocentos', 
					'quinhentos', 
					'seiscentos', 
					'setecentos', 
					'oitocentos', 
					'novecentos');
	$singular = array('', 'mil', 'milh??o', 'bilh??o', 'trilh??o', 'quatrilh??o');
	$plural = array('', 'mil', 'milh??es', 'bilh??es', 'trilh??es', 'quatrilh??es');
	
	$iMilhar = intval($iNumero / 1000);
	$iCentena = intval($iNumero % 1000 / 100);
	$iDezena = intval($iNumero % 1000 % 100 / 10);
	$iUnidade = $iNumero % 1000 % 100 % 10;
	$result = '';
	
	if ($iMilhar) {
		$aCentenaMilhar = array();
		
		/*pega o nome da fun????o atual para chamar recursivamente*/
		$func = __FUNCTION__;
		
		/*inverte a string. Ex: 1234 => 4321*/
		$iMilhar = strrev($iMilhar);
		
		/*separa a str em peda??os. Ex: array('432', '1')*/
		$aCentenaMilhar = str_split($iMilhar, 3);
		
		for ($i = count($aCentenaMilhar) - 1; $i >= 0; $i--) {
			$j = $i + 1;
			$valor = strrev($aCentenaMilhar[$i]) * 1;
			/*ignora valores como 000*/
			if ($valor) {
				$result .= ($result ? ' ' : '');
				$result .= $func($valor);
				$result .= ' ' . ($valor > 1 ? $plural[$j] : $singular[$j]);
			}
		}
	}
	
	if ($iCentena) {
		if ($iCentena == 1 && $iDezena == 0 && $iUnidade == 0) {
			if ($iMilhar)
				$result .= ' e ';
			$result .= 'cem';
		} else {
			if ($iMilhar)
				$result .= ' ';
			$result .= $aCentena[$iCentena];
		}
	}
	
	if ($iDezena) {
		if ($iCentena || $iMilhar)
			$result .= ' e ';
		if ($iDezena < 2) {
			$result .= $aUnidade[$iDezena * 10 + $iUnidade];
			return $result;
		} else
			$result .= $aDezena[$iDezena];
	}
	
	if ($iUnidade) {
		if ($iCentena || $iMilhar || $iDezena)
			$result .= ' e ';
		$result .= $aUnidade[$iUnidade];
	}
	return $result;
}

/**
 * Reescrito a fun????o de mostrar o valor em real por extenso
 * agora ela depende da fun????o {@link KM_extensoNumero}
 *
 * @param float $valor
 * @return string
 */
function KM_extensoValor($valor = 0) {
	if (strpos($valor, '.')) {
		list($int, $dec) = explode('.', number_format($valor, 2, '.', ''));
	} else {
		$int = $valor;
		$dec = false;
	}
	$resultado = '';
	
	/*$oLocale = KM::getLocale();
	
	if ($int > 0) {
		$resultado .= KM_extensoNumero($int);
		$resultado .= ' ' . ($int > 1 ? $oLocale::monetarioExtensoInteiroPlural : $oLocale::monetarioExtensoInteiroSingular);
	}
	
	if ($dec > 0) {
		$resultado .= ($resultado ? ' e ' : '');
		$resultado .= KM_extensoNumero($dec);
		$resultado .= ' ' . ($dec > 1 ? $oLocale::monetarioExtensoDecimalPlural : $oLocale::monetarioExtensoDecimalSingular);
	}*/
	
	return $resultado;
}

/**
 * Fun????o que retorna se o dia ?? util ou n??o
 *
 * @param timestamp|ISO8859 $dtAtual enviar no formato unix
 * timestamp veja {@link time} ou o formato 'd/m/Y H:i' veja {@link date}
 * @return boolean
 */
function KM_dataEhDiaUtil($dtAtual) {
	if (!is_numeric($dtAtual)) {
		$dtAtual = strtodatetime($dtAtual);
	}
	$diaSemana = date('w', $dtAtual);
	return $diaSemana != 0/*Domingo*/ && $diaSemana != 6/*S??bado*/ && !KM_dataEhFeriado($dtAtual);
}


/**
 * Fun????o que formata um cpf/cnpj
 *
 * @param string $cpfcnpj
 * @param bool $addSep se ?? para adicionar separadores para os campos
 * @return string
 */
function KM_formatCpfCnpj($cpfcnpj = null, $addSep = true) {
	$cpfcnpj = preg_replace('/[^0-9]/', '', $cpfcnpj);
	if (!$cpfcnpj) {
		return '';
	}
	
	if (KM_checkCpf($cpfcnpj)) {
		/*se a string for um cpf*/
		$isCpf = true;
	} else if (KM_checkCnpj($cpfcnpj)) {
		/*se a string for um cpnj*/
		$isCpf = false;
	} else {
		$aux = substr($cpfcnpj, strlen($cpfcnpj) - 11);
		if (strlen($cpfcnpj) == 11 || KM_checkCpf($aux)) {
			/*se os ultimos 11 caracteres forem um cpf*/
			$isCpf = true;
			$cpfcnpj = $aux;
		} else {
			return $cpfcnpj;
		}
	}
	
	if (!$addSep) {
		/*retorna s?? os numeros caso n??o seja para adicionar os separadores*/
		return $cpfcnpj;
	}
	
	/*adiciona os separadores de acordo com o tipo*/
	if ($isCpf) {
		return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpfcnpj);
	} else {
		return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/', '$1.$2.$3/$4-$5', $cpfcnpj);
	}
}

/**
 * Coloca uma mascara no CEP
 * ex '74023045' => '74.023-045'
 *
 * @param string $cep
 * @return string
 */
function KM_formatCEP($cep) {
	$cep = preg_replace('/[^0-9]/', '', $cep);
	if ($cep)
		$cep = substr($cep, 0, 2) . '.' . substr($cep, 2, 3) . '-' . substr($cep, 5);
	return $cep;
}



/**
 * Remove acento dos caracteres acentuados e com cedilha na string
 * Recomenda????o: para renomear nome de arquivos dos uploads, etc.
 * Modo de Uso:
 * $sFileName = removerAcentos('negocia????o.xml'); // retorna: 'negociacao.xml'
 *
 * @author Walker Alencar <walkeralencar@gmail.com>
 * @param string $pString texto com caracteres acentuados.
 * @return string
 */
function KM_strToASCII($pString, $pIsUTF8 = false) {
	$aMatches = array(
					'A' => '/[??????????]/', 
					'a' => '/[??????????]/', 
					'E' => '/[????????]/', 
					'e' => '/[????????]/', 
					'I' => '/[????????]/', 
					'i' => '/[????????]/', 
					'O' => '/[??????????]/', 
					'o' => '/[??????????]/', 
					'U' => '/[????????]/', 
					'u' => '/[????????]/', 
					'C' => '/[??]/', 
					'c' => '/[??]/', 
					'N' => '/[??]/', 
					'n' => '/[??]/');
	if ($pIsUTF8) {
		$aMatches = array_map('utf8_decode', $aMatches);
	}
	return preg_replace(array_values($aMatches), array_keys($aMatches), (($pIsUTF8) ? utf8_decode($pString) : $pString));
}

public function gerarUrl($atributos){
	$a_parametros = explode("/", $atributos);
		
	$aResult = array();
	
	for ($i = 0;  $i <= count($a_parametros); $i = $i + 2) {
		if (($i % 2) == 0) {
			$aResult[$a_parametros[$i]] = $a_parametros[$i+1];
		}
	}
	
	array_pop($aResult);
	
	return $aResult;
}


/********************
*@file - path to file
*/
public function force_download($file)
{
    if ((isset($file))&&(file_exists($file))) {
       header("Content-length: ".filesize($file));
       header('Content-Type: application/octet-stream');
       header('Content-Disposition: attachment; filename="' . $file . '"');
       readfile("$file");
    } else {
       echo "No file selected";
    }
}


public function criarArraySession($valor,$nomeDaSessao){
	$_SESSION[$nomeDaSessao][] = $valor;
		
	$aElemento = array_unique($_SESSION[$nomeDaSessao]);
	sort($aElemento);
	return array_unique($aElemento);
}

function save_image_url($inPath,$outPath){
	//Download images from remote server
	$in=    fopen($inPath, "rb");
	$out=   fopen($outPath, "wb");
	$result = false;
	while ($chunk = fread($in,8192))
	{
		$result = fwrite($out, $chunk, 8192);
	}
	fclose($in);
	fclose($out);
	return $result;
}


public function lerRss(){
	// caminho do feed do meu blog
	$feed = 'http://g1.globo.com/dynamo/economia/rss2.xml';
	// leitura do feed
	$rss = simplexml_load_file($feed);
	// limite de itens
	$limit = 5;
	// contador
	$count = 0;

	// imprime os itens do feed
	if($rss)
	{
		foreach ( $rss->channel->item as $item )
		{
			// formata e imprime uma string
			printf('<li style="height: 50px;"><a class="NoticiasIndex" href="%s" target="_blank" title="%s" >%s</a><br /></li>', $item->link, $item->title, $item->title);
			// incrementamos a vari????vel $count
			$count++;
			// caso nosso contador seja igual ao limite paramos a itera????????o
			if($count == $limit) break;
		}
	}
	else
	{
		echo 'N??o foi possivel ler.';
	}

}


public function retornaMesExtensoArray(){
	$meses = array();
	$meses[] = "Janeiro";
	$meses[] = "Fevereiro";
	$meses[] = "Mar??o";
	$meses[] = "Abril";
	$meses[] = "Maio";
	$meses[] = "Junho";
	$meses[] = "Julho";
	$meses[] = "Agosto";
	$meses[] = "Setembro";
	$meses[] = "Outubro";
	$meses[] = "Novembro";
	$meses[] = "Dezembro";

	return $meses;
}
public function enviaEmailSenha($emails=null, $msg=null, $replyTo=null, $assunto=null, $anexos=null){
	$configuracao = Config::AtributosConfig();
	include_once(dirname(__FILE__)."/../inc/smtp/class.phpmailer.php");
	// monta Msg
	$messg  = "";

	$aMsg = count($msg);
	for($i=0;$i<$aMsg;$i++){
		$messg .= "<b>".$msg[$i]['tipo']." </b> <span>".$msg[$i]['msg']."</span><br/><br/>";
	}

	$content = file_get_contents(dirname(__FILE__).'/../inc/email/redefinicao.php');
	$content = str_replace('{TEXTO}', $messg, $content);
	$content = str_replace('{LINKSITE}', $configuracao['siteCliente'], $content);
	$content = str_replace('{URLLOGO}', $configuracao['urllogo'], $content);
	
	
	
	$mail             = new PHPMailer();
	
	$mail->IsSMTP(); // Define que a mensagem ser???? SMTP
	// $mail->SMTPDebug  = 2;
	$mail->Host = $configuracao['smtp']['host']; // Endere????o do servidor SMTP
	$mail->CharSet   = 'UTF-8';                  // enable SMTP authentication
	$mail->SMTPAuth = $configuracao['smtp']['user'] && $configuracao['smtp']['senha'] ? true : false;
	if($configuracao['smtp']['user'] && $configuracao['smtp']['senha'] && $configuracao['smtp']['port']){
		$mail->Username = $configuracao['smtp']['user']; // Usu????rio do servidor SMTP
		$mail->Password = $configuracao['smtp']['senha']; // Senha do servidor SMTP
		$mail->Port = $configuracao['smtp']['port'];
	}
	
	$mail->From = $configuracao['smtp']['from']; // Seu e-mail
	$mail->FromName = $configuracao['smtp']['fromName']; // Seu nome
	$mail->AddReplyTo($replyTo ? $replyTo : $configuracao['smtp']['from'], $configuracao['smtp']['fromName']);
	
	if($anexos){
		$qtdeAnexo = count($anexos);
		for($i=0;$i<$qtdeAnexo;$i++){
			$mail->AddAttachment($anexos[$i]['url'],$anexos[$i]['name']);
		}
	}
	
	$mail->Subject    = $assunto;
	$mail->MsgHTML($content);
	$qtdeEmail = count($emails);
	for($i=0;$i<$qtdeEmail;$i++){
		$mail->AddAddress($emails[$i]);
	}
	$mail->IsHTML(true); // send as HTML
	$result = false;
	if ($mail->send()) {
		$result = true;
	}
	
	return $result;
}

public function verificaImagem($arquivo){
	$formatoImg = $this->formatoFile($arquivo);
	switch ($formatoImg){
		case'PNG':
			return true;	
		break;
		case'png':
			return true;
		break;
		case'jpg':
			return true;
		break;
		case'JPG':
			return true;
		break;
		case'JPEG':
			return true;
		break;
		case'jpeg':
			return true;
		break;
		case'gif':
			return true;
		break;
		case'GIF':
			return true;
		break;
		default:
			return false;
		break;
	}
}

public function enviaEmail($emails=null, $msg=null, $replyTo=null, $assunto=null, $anexos=null){
	$configuracao = Config::AtributosConfig();
	include_once(dirname(__FILE__)."/../inc/smtp/class.phpmailer.php");
	// monta Msg
	$messg  = "";

	$aMsg = count($msg);
	for($i=0;$i<$aMsg;$i++){
		$messg .= "<b>".$msg[$i]['tipo']." </b> <span>".$msg[$i]['msg']."</span><br/><br/>";
	}

	$content = file_get_contents(dirname(__FILE__).'/../inc/email/padrao.php');
	$content = str_replace('{TEXTO}', $messg, $content);
	$content = str_replace('{LINKSITE}', $configuracao['siteCliente'], $content);
	$content = str_replace('{URLLOGO}', $configuracao['urllogo'], $content);
	
	
	
	$mail             = new PHPMailer();
	
	$mail->IsSMTP(); // Define que a mensagem ser???? SMTP
	// $mail->SMTPDebug  = 2;
	$mail->Host = $configuracao['smtp']['host']; // Endere????o do servidor SMTP
	$mail->CharSet   = 'UTF-8';                  // enable SMTP authentication
	$mail->SMTPAuth = $configuracao['smtp']['user'] && $configuracao['smtp']['senha'] ? true : false;
	if($configuracao['smtp']['user'] && $configuracao['smtp']['senha'] && $configuracao['smtp']['port']){
		$mail->Username = $configuracao['smtp']['user']; // Usu????rio do servidor SMTP
		$mail->Password = $configuracao['smtp']['senha']; // Senha do servidor SMTP
		$mail->Port = $configuracao['smtp']['port'];
	}
	
	$mail->From = $configuracao['smtp']['from']; // Seu e-mail
	$mail->FromName = $configuracao['smtp']['fromName']; // Seu nome
	$mail->AddReplyTo($replyTo ? $replyTo : $configuracao['smtp']['from'], $configuracao['smtp']['fromName']);
	
	if($anexos){
		$qtdeAnexo = count($anexos);
		for($i=0;$i<$qtdeAnexo;$i++){
			$mail->AddAttachment($anexos[$i]['url'],$anexos[$i]['name']);
		}
	}
	
	$mail->Subject    = $assunto;
	$mail->MsgHTML($content);
	$qtdeEmail = count($emails);
	for($i=0;$i<$qtdeEmail;$i++){
		$mail->AddAddress($emails[$i]);
	}
	$mail->IsHTML(true); // send as HTML
	$result = false;
	if ($mail->send()) {
		$result = true;
	}
	
	return $result;
}


function xml2array ( $xmlObject, $out = array () )
{
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}



function byte_format($bytes, $precision = 2)
{
    $bytes = $bytes * 1000000;
    // human readable format -- powers of 1000
    //
    $unit = array('B','KB','MB','GB','TB','PB','EB');

    return @round(
            $bytes / pow(1000, ($i = floor(log($bytes, 1000)))), $precision
    ).' '.$unit[$i];
}


function imageEncodeDecode64($imagem, $tipo='encode'){
   if($tipo == 'encode'){
       return base64_encode($imagem);
   }else if($tipo == 'decode'){
       return base64_decode($imagem);
   }else{
       return $imagem;
   }
}

function acrescentaElementArray($value){
    $aValores = $_SESSION['CACHE_IMOVEL'];
    $iQtdArray = count($_SESSION['CACHE_IMOVEL']);
    $iReg = ($iQtdArray < 2 ? $iQtdArray : 2);
    for ($i=$iReg;$i>0;$i--){
        $_SESSION['CACHE_IMOVEL'][$i] = $_SESSION['CACHE_IMOVEL'][$i-1];
    }
    $_SESSION['CACHE_IMOVEL'][0] = $value;
}

/**
 * Metodo responsavel por enviar email sem a necessidade de pegar as informa????es do formul??rio
 *
 **/
public function enviaEmailContato($emails=null, $replyTo=null, $assunto=null, $anexos=null){
    $configuracao = Config::AtributosConfig();
    include_once(dirname(__FILE__)."/../inc/smtp/class.phpmailer.php");
    // monta Msg
    $messg  = "";

    $content = file_get_contents(dirname(__FILE__).'/../inc/email/resposta.php');
    $content = str_replace('{LINKSITE}', $configuracao['siteCliente'], $content);
    
    $mail             = new PHPMailer();

    $mail->IsSMTP(); // Define que a mensagem ser?? SMTP
    // $mail->SMTPDebug  = 2;
    $mail->Host = $configuracao['smtp']['host']; // Endere??o do servidor SMTP
    $mail->CharSet   = 'UTF-8';                  // enable SMTP authentication
    $mail->SMTPAuth = $configuracao['smtp']['user'] && $configuracao['smtp']['senha'] ? true : false;
    if($configuracao['smtp']['user'] && $configuracao['smtp']['senha'] && $configuracao['smtp']['port']){
        $mail->Username = $configuracao['smtp']['user']; // Usu??rio do servidor SMTP
        $mail->Password = $configuracao['smtp']['senha']; // Senha do servidor SMTP
        $mail->Port = $configuracao['smtp']['port'];
    }

    $mail->From = $configuracao['smtp']['from']; // Seu e-mail
    $mail->FromName = $configuracao['smtp']['fromName']; // Seu nome
    $mail->AddReplyTo($replyTo ? $replyTo : $configuracao['smtp']['from'], $configuracao['smtp']['fromName']);

    if($anexos){
        $qtdeAnexo = count($anexos);
        for($i=0;$i<$qtdeAnexo;$i++){
            $mail->AddAttachment($anexos[$i]['url'],$anexos[$i]['name']);
        }
    }

    $mail->Subject    = $assunto;
    $mail->MsgHTML($content);
    $qtdeEmail = count($emails);
    for($i=0;$i<$qtdeEmail;$i++){
        $mail->AddAddress($emails[$i]);
    }
    $mail->IsHTML(true); // send as HTML
    $result = false;
    if ($mail->send()) {
        $result = true;
    }

    return $result;
}

public function enviaEmailContatoSite($emails=null, $msg=null, $replyTo=null, $assunto=null, $anexos=null, $tituloCorpoEmail = null){
    $configuracao = Config::AtributosConfig();
    include_once(dirname(__FILE__)."/../inc/smtp/class.phpmailer.php");
    // monta Msg
    $messg  = "";

    $aMsg = count($msg);
    for($i=0;$i<$aMsg;$i++){
        $messg .= "<b>".$msg[$i]['tipo']." </b> <span>".$msg[$i]['msg']."</span><br/>";
    }

    $content = file_get_contents(dirname(__FILE__).'/../inc/email/padrao.php');
    $content = str_replace('{TEXTO}', $messg, $content);
    $content = str_replace('{LINKSITE}', $configuracao['siteCliente'], $content);
    $content = str_replace('{URLLOGO}', $configuracao['urllogo'], $content);
    $content = str_replace('{TITULOCORPOEMAIL}', $tituloCorpoEmail, $content);



    $mail             = new PHPMailer();

    $mail->IsSMTP(); // Define que a mensagem ser?? SMTP
    // $mail->SMTPDebug  = 2;
    $mail->Host = $configuracao['smtp']['host']; // Endere??o do servidor SMTP
    $mail->CharSet   = 'UTF-8';                  // enable SMTP authentication
    $mail->SMTPAuth = $configuracao['smtp']['user'] && $configuracao['smtp']['senha'] ? true : false;
    if($configuracao['smtp']['user'] && $configuracao['smtp']['senha'] && $configuracao['smtp']['port']){
        $mail->Username = $configuracao['smtp']['user']; // Usu??rio do servidor SMTP
        $mail->Password = $configuracao['smtp']['senha']; // Senha do servidor SMTP
        $mail->Port = $configuracao['smtp']['port'];
    }

    $mail->From = $configuracao['smtp']['from']; // Seu e-mail
    $mail->FromName = $configuracao['smtp']['fromName']; // Seu nome
    $mail->AddReplyTo($replyTo ? $replyTo : $configuracao['smtp']['from'], $configuracao['smtp']['fromName']);

    if($anexos){
        $qtdeAnexo = count($anexos);
        for($i=0;$i<$qtdeAnexo;$i++){
            $mail->AddAttachment($anexos[$i]['url'],$anexos[$i]['name']);
        }
    }

    $mail->Subject    = $assunto;
    $mail->MsgHTML($content);
    $qtdeEmail = count($emails);
    for($i=0;$i<$qtdeEmail;$i++){
        $mail->AddAddress($emails[$i]);
    }
    $mail->IsHTML(true); // send as HTML
    $result = false;
    if ($mail->send()) {
        $result = true;
    }

    return $result;
}

    function retornarEstado($sigla){

        switch($sigla){
            case'AC';
                return 'Acre';
                exit;
            break;
            case'AL';
                return 'Alagoas';
                exit;
            break;
            case'AP';
                return 'Amap??';
                exit;
            break;
            case'AM';
                return 'Amazonas';
                exit;
            break;
            case'BA';
                return 'Bahia';
                exit;
            break;
            case'CE';
                return 'Cear??';
                exit;
            break;
            case'DF';
                return 'Distrito Federal';
                exit;
            break;
            case'ES';
                return 'Esp??rito Santo';
                exit;
            break;
            case'GO';
                return 'Goi??s';
                exit;
            break;
            case'MA';
                return 'Maranh??o';
                exit;
            break;
            case'MT';
                return 'Mato Grosso';
                exit;
            break;
            case'MS';
                return 'Mato Grosso do Sul';
                exit;
            break;
            case'MG';
                return 'Minas Gerais';
                exit;
            break;
            case'PA';
                return 'Par??';
                exit;
            break;
            case'PB';
                return 'Para??ba';
                exit;
            break;
            case'PR';
                return 'Paran??';
                exit;
            break;
            case'PE';
                return 'Pernambuco';
                exit;
            break;
            case'PI';
                return 'Piau??';
                exit;
            break;
            case'RJ';
                return 'Rio de Janeiro';
                exit;
            break;
            case'RN';
                return 'Rio Grande do Norte';
                exit;
            break;
            case'RS';
                return 'Rio Grande do Sul';
                exit;
            break;
            case'RO';
                return 'Rond??nia';
                exit;
            break;
            case'RR';
                return 'Roraima';
                exit;
            break;
            case'SC';
                return 'Santa Catarina';
                exit;
            break;
            case'SP';
                return 'S??o Paulo';
                exit;
            break;
            case'SE';
                return 'Sergipe';
                exit;
            break;
            case'TO';
                return 'Tocantins';
                exit;
            break; 
        }
    }

    function verificarTempo($dataCadastro){

        $data = explode(' ', $dataCadastro);
        $dataHoje = new DateTime();
        $dataCadastro = new DateTime($data[0]);
        $intervalo = $dataHoje->diff($dataCadastro);

        $ano = $intervalo->y;
        $mes = $intervalo->m;
        $dia = $intervalo->d;

        if($ano <> 0 && $mes <> 0 && $dia <> 0){
            return $ano . ' ano, ' . $mes . ' meses, ' . $dia . ' dias';
        }if($ano == 0 && $mes <> 0 && $dia <> 0){
            return $mes . ' meses, ' . $dia . ' dias';
        }if($ano == 0 && $mes == 0 && $dia <> 0){
            if($dia == 1){
                return $dia . ' dia';
            }  
            return $dia . ' dias';          
        }if($ano == 0 && $mes <> 0 && $dia == 0){
            if($mes == 1){
                return $mes . ' m??s';
            }
            return $mes . ' meses';
        }
        if($ano == 0 && $mes == 0 && $dia == 0){
            return 'Cadastrado hoje';
        }if($ano <> 0 && $mes == 0 && $dia == 0){
            if($ano <> 1){
                return $ano . ' anos';
            }
            return $ano . ' ano';
        }if($ano <> 0 && $mes <> 0 && $dia == 0){
            return $ano . ' ano,' . $mes . ' meses';
        }if($ano <> 0 && $mes == 0 && $dia <> 0){
            return $ano . ' ano,' . $dia . ' dias';
        }
    }

    public function calculaTempoPublicacao($data_cadastro, $data_atual) {
    
        $date_time  = new DateTime($data_cadastro);
        $diff       = $date_time->diff( new DateTime($data_atual));
        
        if($diff->format('%m') < 1){
            if($diff->format('%d') == 1){
                return $diff->format('Publicado %d dia atr??s');
            }elseif($diff->format('%d') > 1){
                return $diff->format('Publicado %d dias atr??s');
            }elseif($diff->format('%H') == 1){
                return $diff->format('Publicado %H hora atr??s');
            }elseif($diff->format('%H') > 1){
                return $diff->format('Publicado %H horas atr??s');
            }elseif($diff->format('%H') < 1){
                return $diff->format('Publicado %i minutos atr??s');
            }
        }else{
            return 'Publicado em '.date('d/m/Y',strtotime($data_cadastro));
        }
    }

    function imagePrimary(array $idImage, string $width, array $post, ?string $imgOld, string $nameDir, string $namePhoto, $imageBig = false)
	{
        if($idImage["name"] !=""){
            
            $formatoImgDestaque = ".".$this->formatoFile($idImage["name"]);
            if($formatoImgDestaque == ".jpg" || $formatoImgDestaque == ".JPG" || $formatoImgDestaque == ".jpeg" || $formatoImgDestaque == ".JPEG" || $formatoImgDestaque == ".png" || $formatoImgDestaque == ".PNG" || $formatoImgDestaque == ".gif" || $formatoImgDestaque == ".GIF") {
            }else{
                $this->showResult("","Formato de arquivo inv??lido. Apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=alterar&ctrl=noticias');
                exit();
            }

            //Retorna formato da imagem
            $formatoImgDestaque = $this->formatoFile($idImage["name"]);
            //Definir nome para imagem
            $dir = $nameDir."/";
            if(!file_exists($nameDir)) {
                $this->criaDir($nameDir);
            }
            
            $nomeImg = $namePhoto.time().".".$formatoImgDestaque;
            $temp = $dir.$nomeImg;
            //deleta a imagem antiga
            $this->delFile($imgOld);
            //Fazendo o upload da imagem
                    $imagem = $idImage;
                    // armazena dimens??es da imagem
                    $imagesize = getimagesize($imagem['tmp_name']);				
                    if($imagesize !== false){
                        // move a imagem para o servidor
                        if($this->uploadArq($idImage["tmp_name"],$temp)){
                            $oImg = new Crop_Imagem($temp);
                            // valida via m2brimagem
                            if($oImg->valida() == 'OK'){					
                                // redimensiona (caso seja menor que o tamanho )
                                $oImg->redimensiona($width, '', '');
                                // grava nova imagem                                
                                if($imageBig == true){                                    
                                    $oImg->grava($temp);                            
                                    $oImg->posicaoCrop( $post['x']*2, $post['y']*2 );
                                    $oImg->redimensiona( $post['w']*2, $post['h']*2, 'crop' );
                                    $oImg->redimensiona($width, '', '');
                                    $oImg->grava($temp);
                                }else{
                                    $oImg->grava($temp);                            
                                    $oImg->posicaoCrop( $post['x'], $post['y'] );
                                    $oImg->redimensiona( $post['w'], $post['h'], 'crop' );
                                    $oImg->redimensiona($width, '', '');
                                    $oImg->grava($temp);
                                }                               
                            }
                        }
                    }
            $imgDestaque = $dir.$nomeImg;
            return $imgDestaque;
        }else{
            return $imgOld;
        }
	}

    function imageSecondary(array $idImage, string $width, array $post, ?string $imgOld, string $nameDir, string $namePhoto, $imageBig = false)
	{
        // return $post;
        if($idImage["name"] !=""){

            $formatoImgDestaque = ".".$this->formatoFile($idImage["name"]);
            if($formatoImgDestaque == ".jpg" || $formatoImgDestaque == ".JPG" || $formatoImgDestaque == ".jpeg" || $formatoImgDestaque == ".JPEG" || $formatoImgDestaque == ".png" || $formatoImgDestaque == ".PNG" || $formatoImgDestaque == ".gif" || $formatoImgDestaque == ".GIF") {
            }else{
                $this->showResult("","Formato de arquivo inv??lido. Apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=alterar&ctrl=noticias');
                exit();
            }

            //Retorna formato da imagem
            $formatoImgDestaque = $this->formatoFile($idImage["name"]);
            //Definir nome para imagem
            $dir = $nameDir."/";
            if(!file_exists($nameDir)) {
                $this->criaDir($nameDir);
            }
            $nomeImg = $namePhoto.time().".".$formatoImgDestaque;
            $temp = $dir.$nomeImg;
            //deleta a imagem antiga
            $this->delFile($imgOld);
            //Fazendo o upload da imagem
                    $imagem = $idImage;
                    // armazena dimens??es da imagem
                    $imagesize = getimagesize($imagem['tmp_name']);				
                    if($imagesize !== false){
                        // move a imagem para o servidor
                        if($this->uploadArq($idImage["tmp_name"],$temp)){
                            $oImg = new Crop_Imagem($temp);
                            // valida via m2brimagem
                            if($oImg->valida() == 'OK'){					
                                // redimensiona (caso seja menor que o tamanho )
                                $oImg->redimensiona($width, '', '');
                                // grava nova imagem
                                if($imageBig == true){
                                    $oImg->grava($temp);                            
                                    $oImg->posicaoCrop( $post['x2']*2, $post['y2']*2 );
                                    $oImg->redimensiona( $post['w2']*2, $post['h2']*2, 'crop' );
                                    $oImg->redimensiona($width, '', '');
                                    $oImg->grava($temp);
                                }else{
                                    $oImg->grava($temp);                            
                                    $oImg->posicaoCrop( $post['x2'], $post['y2'] );
                                    $oImg->redimensiona( $post['w2'], $post['h2'], 'crop' );
                                    $oImg->redimensiona($width, '', '');
                                    $oImg->grava($temp);
                                }
                            }
                        }
                    }
            $imgDestaque = $dir.$nomeImg;
            return $imgDestaque;
        }else{
            return $imgOld;
        }
	}

    function converterPreco(string $preco)
    {
        $preco = str_replace('R$', '', $preco);
        $preco = str_replace('.', '', $preco);
        $preco = str_replace(',', '.', $preco);

        return $preco;
    }

    function converteDataExtenso($data)
    {
        //2022-05-21


       
        //$hora2 = explode('-', $hora[0]);
        //$dia = $hora2[2];

        $originalDate = "2022-05-21";
        //original date is in format YYYY-mm-dd
        $data = explode(' ', $data);  
        $DateTime = DateTime::createFromFormat('Y-m-d', $data[0]);
        $newDate = $DateTime->format('d-m-Y');
        
        $newDate = explode('-', $newDate);
        
        

        return $newDate['0'] . ' ' . $this->retornaMesExtenso($newDate['1']) . ' ' . $newDate['2'];

    }

    function converterPrecoExebicao(string $preco)
    {
        if($preco != null){
            return number_format($preco, 2, ',', '.');
        }else{
            return null;
        }
    }


}
 function print_rpre($aDados, $return = false) {

	$sResult = '<p><pre>' . print_r($aDados, true) . '</pre></p>';

	

	/*escreve ou retorna o resultado*/

	if ($return) {

		return $sResult;

	} else {

		echo $sResult;

	}

}

function shortURL($url) {

    $normalize = array(
        '&'=>'-e-', '??'=>'c', '??'=>'c', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A',
        '??'=>'A', '??'=>'C', '??'=>'E', '??'=>'E', '??'=>'E', '??'=>'E', '??'=>'I', '??'=>'I', '??'=>'I',
        '??'=>'I', '??'=>'N', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'U', '??'=>'U',
        '??'=>'U', '??'=>'U', '??'=>'Y', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a',
        '??'=>'a', '??'=>'c', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'i', '??'=>'i', '??'=>'i',
        '??'=>'i', '??'=>'n', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'u',
        '??'=>'u', '??'=>'u', '??'=>'y', '??'=>'y', '??'=>'y'
    );

    $url = strip_tags($url,'<(.*?)>');
    $url = strtr($url,$normalize);
    $url = strtolower($url);
    $url = preg_replace('/[^a-zA-Z0-9 -]/','',$url);
    $url = trim($url);
    $url = strtr($url,' ','-');
    for ($i=0;$i<strlen($url);$i++) :
    $url = str_replace('--','-',$url);
    endfor;
    $url = trim($url,'-');

    return $url;

}

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }



?>