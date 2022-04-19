<?php

//defini os paths para as classes do sistema e as classes gerais

$path["conexao"] = "painel/classes/";

include_once $path["conexao"] . "class.conexao.php";

//classe úteis
// include_once $path["classes"] . "class.uteis.php";
// $objUteis = new Uteis();

//inclui a classe de configuracao
include_once $path["classes"] ."class.Configuracao.php";
$objConfiguracao = new Configuracao();

//classe de session
include_once $path["classes"]."session/class.eyesecuresession.inc.php";
$objSession2 = new EyeSecureSession('site');

$conf = Config::AtributosConfig();

// $objUteis->encode($conf);

require_once $path["classes"] ."htmlpurifier/library/HTMLPurifier.auto.php";

$configs = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($configs);


// $meta->og['image'] = "http://" . $_SERVER['SERVER_NAME'] . "/imagem/100x100/img/".base64_encode('facebooklogo/logo.png');

// $meta->og['title'] = "";

// $meta->og['description'] = "";

$titPag = "";

$objSession2->get('session');

if (!isset($objPost->param["acao"]) && empty($objPost->param["acao"])) {

    // $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);  

    $titPag .= "Excelência Distribuidora de sistemas de segurança eletrônica";

    $abrePag = "internas/principal.php";

} else {    

    switch ($objPost->param["acao"]) {

        default:  
            // $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);            
            $meta->tags = "metas tags separadas por virgula";
            $meta->descricao = "descrição maximo 160 caracteres";
            $titPag .= "Página não encontrada"; 
            print_r('aqui')           ;
            $abrePag = "internas/404.php";
        break;

    }
    

}




?>
