<?php

//defini os paths para as classes do sistema e as classes gerais

$path["conexao"] = "painel/classes/";

include_once $path["conexao"] . "class.conexao.php";

//classe úteis
include_once $path["classes"] . "class.uteis.php";
$objUteis = new Uteis();

//classe de post
include_once $path["classes"]."session/post.class.php";
$objPost = new gp();

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
// print_r($objPost);
$objSession2->get('session');

if (!isset($_REQUEST["acao"]) && empty($_REQUEST["acao"])) {
    $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);  
    $titPag .= "Verik - Ditec agora é Verik";
    $abrePag = "internas/principal.php";
} else {    
    

    switch ($_REQUEST["acao"]) {
        default:  
            $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);            
            $meta->tags = "metas tags separadas por virgula";
            $meta->descricao = "descrição maximo 160 caracteres";
            $titPag .= "Página não encontrada"; 
            // print_r('aqui')           ;
            $abrePag = "internas/404.php";
        break;

        // Sobre nós 
        case 'sobre-nos':
            $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Sobre nós - Verik";
            $abrePag = "internas/sobreNos.php";            
        break; // ------------------------------------------------------------ //

        // Dicas e novidades = Blog
        case 'dicas-novidades':
            $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Dicas e novidades - Blog - Verik";
            $abrePag = "internas/blog.php";            
        break; // ------------------------------------------------------------ //

        // Saiba mais - Dicas e novidades = Blog
        case 'detalhes-blog':
            $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Saiba mais - Blog - Verik";
            $abrePag = "internas/blogSaibaMais.php";            
        break; // ------------------------------------------------------------ //
        
        // Política de Privacidade
        case 'politica-privacidade':
            $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Política de Privacidade - Verik";
            $abrePag = "internas/politicaPrivacidade.php";            
        break; // ------------------------------------------------------------ //

        // Política de Cookies
        case 'politica-cookies':
            $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Política de Cookies - Verik";
            $abrePag = "internas/politicaCookies.php";            
        break; // ------------------------------------------------------------ //

        // Termo de uso
        case 'termo-uso':
            $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Termo de uso - Verik";
            $abrePag = "internas/politicaUso.php";            
        break; // ------------------------------------------------------------ //


        

    }
    

}




?>