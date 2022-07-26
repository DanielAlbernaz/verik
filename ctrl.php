<?php

//defini os paths para as classes do sistema e as classes gerais

$path["conexao"] = "painel/classes/";

include_once $path["conexao"] . "class.conexao.php";
include_once $path["conexao"] . "class.conexao_verik.php";

//classe úteis
include_once $path["classes"] . "class.uteis.php";
$objUteis = new Uteis();

//classe úteis
include_once $path["classes"] . "class.UsuarioSite.php";
$objUsuarioSite = new UsuarioSite();

//classe úteis
include_once $path["classes"] . "class.EnderecoUsuario.php";
$objEnderecoUsuario = new EnderecoUsuario();

//classe de post
include_once $path["classes"]."session/post.class.php";
$objPost = new gp();

//inclui a classe de configuracao
include_once $path["classes"] ."class.Configuracao.php";
$objConfiguracao = new Configuracao();

//inclui a classe de termo de uso
include_once $path["classes"] ."class.Termo.php";
$objTermo = new Termo();

//inclui a classe de politica cookies
include_once $path["classes"] ."class.PoliticaCookies.php";
$objPoliticaCookies = new PoliticaCookies();

//inclui a classe de trocas e devoluções
include_once $path["classes"] ."class.TrocasDevolucoes.php";
$objTrocasDevolucoes = new TrocasDevolucoes();

//inclui a classe de politica privacidade
include_once $path["classes"] ."class.Privacidade.php";
$objPrivacidade = new Privacidade();

//inclui a classe de sobre nós
include_once $path["classes"] ."class.SobreNos.php";
$objSobreNos = new SobreNos();

//inclui a classe de visão e missão 
include_once $path["classes"] ."class.Missao.php";
$objMissao = new Missao();

//inclui a classe de detalhes blog 
include_once $path["classes"] ."class.Blog.php";
$objBlog = new Blog();

include_once $path["classes"] ."class.Produto.php";
$objProduto = new Produto();

//classe de session
include_once $path["classes"]."session/class.eyesecuresession.inc.php";
$objSession2 = new EyeSecureSession('site');

//classe de session
include_once $path["classes"]."session/class.Produto.inc.php";
$objSession2Produto = new ProdutoCarrinho('site');

$conf = Config::AtributosConfig();

// //$objUteis->encode($conf);

require_once $path["classes"] ."htmlpurifier/library/HTMLPurifier.auto.php";

$configs = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($configs);

//Verifica se o usuário selecionou manter logado
$objUteis->verificarManterLogado($_COOKIE['tokenLogin']);


// $meta->og['image'] = "http://" . $_SERVER['SERVER_NAME'] . "/imagem/100x100/img/".base64_encode('facebooklogo/logo.png');

// $meta->og['title'] = "";

// $meta->og['description'] = "";

$titPag = "";
// print_r($objPost);
$objSession2->get('session');

if (!isset($objPost->param["acao"]) && empty($objPost->param["acao"])) {
    $atributos = $objUteis->gerarUrl($objPost->param['atributos']);  
    $titPag .= "Verik - Ditec agora é Verik";
    $abrePag = "internas/principal.php";
} else {    
    

    switch ($objPost->param["acao"]) {
        default:  
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);            
            $meta->tags = "metas tags separadas por virgula";
            $meta->descricao = "descrição maximo 160 caracteres";
            $titPag .= "Página não encontrada"; 
            // print_r('aqui')           ;
            $abrePag = "internas/404.php";
        break;

        // Sobre nós 
        case 'sobre-nos':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);

            $sobreNos = $objSobreNos->lista(); 

            $missao = $objMissao->lista(); 
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Sobre nós - Verik";
            $abrePag = "internas/sobreNos.php";            
        break; // ------------------------------------------------------------ //

        // Dicas e novidades = Blog
        case 'dicas-novidades':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);

            $blogs = $objBlog->listar(['status' => 1]);           
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Dicas e novidades - Blog - Verik";
            $abrePag = "internas/blog.php";            
        break; // ------------------------------------------------------------ //

        // Saiba mais - Dicas e novidades = Blog
        case 'detalhes-blog':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);

            $blog = $objBlog->lista();
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Saiba mais - Blog - Verik";
            $abrePag = "internas/blogSaibaMais.php";            
        break; // ------------------------------------------------------------ //

        // Fale Conosco
        case 'fale-conosco':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Fale conosco - Verik";
            $abrePag = "internas/faleConosco.php";            
        break; // ------------------------------------------------------------ //

        // Dúvidas frequentes
        case 'duvidas-frequentes':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Dúvidas frequentes - Verik";
            $abrePag = "internas/duvidasFrequentes.php";            
        break; // ------------------------------------------------------------ //

        // Formas de pagamento
        case 'formas-pagamento':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Formas de pagamento - Verik";
            $abrePag = "internas/formasPagamento.php";            
        break; // ------------------------------------------------------------ //

         // Trocas e devoluções
         case 'trocas-devolucoes':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);

            $trocas_devolucoes = $objTrocasDevolucoes->lista(); 
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Trocas e devoluções - Verik";
            $abrePag = "internas/trocasDevolucoes.php";            
        break; // ------------------------------------------------------------ //
        
        // Política de Privacidade
        case 'politica-privacidade':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);

            $politica_privacidade = $objPrivacidade->lista();
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Política de Privacidade - Verik";
            $abrePag = "internas/politicaPrivacidade.php";            
        break; // ------------------------------------------------------------ //

        // Política de Cookies
        case 'politica-cookies':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);

            $politica_cookie = $objPoliticaCookies->lista();
        
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Política de Cookies - Verik";
            $abrePag = "internas/politicaCookies.php";            
        break; // ------------------------------------------------------------ //

        // Termo de uso
        case 'termo-uso':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);

            $termo = $objTermo->lista();   

            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Termo de uso - Verik";
            $abrePag = "internas/politicaUso.php";            
        break; // ------------------------------------------------------------ //

        // PRODUTOS

         // Todos os produtos
         case 'busca':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);

            $produtos = $objProduto->listarPaginacao($atributos);
            // print_rpre($produtos);exit;

            $categorias = $objProduto->listaCategoriaProdutos();

            $marcas = $objProduto->listaMarcaProdutos(); 

            // print_rpre($produtos);exit;
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Busca - Verik";
            $abrePag = "internas/busca.php";            
        break; // ------------------------------------------------------------ //

        // Produtos
        case 'produto':
            $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);
            
            $produto = $objProduto->lista($atributos['p']);
            
            $produtosRelacionados = $objProduto->listaRelacionadosCategoria($produto->grupo_produtos_id, $produto->nome_fabricante);

            $fotos = $objProduto->listaFotosProduto($produto->produto_id);
            // print_rpre($produto[0]->foto);exit;
            // print_rpre($produto);exit;
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Php do nome do produto - Verik";
            $abrePag = "internas/produto.php";            
        break; // ------------------------------------------------------------ //
        


        // ÁREA RESTRITA

        // Login
        case 'login':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "login - Verik";
            $abrePag = "internas/uLogin.php";            
        break; // ------------------------------------------------------------ //

        // Cadastro
        case 'cadastro':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Cadastro - Verik";
            $abrePag = "internas/uCadastro.php";            
        break; // ------------------------------------------------------------ //

        // Esqueceu a senha
        case 'esqueceu-senha':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Esqueceu a senha - Verik";
            $abrePag = "internas/uEsqueceuSenha.php";            
        break; // ------------------------------------------------------------ //

        // Minha Conta
        case 'minha-conta':
            $atributos = $objUteis->gerarUrl($objPost->param['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Minha conta - Verik";
            $abrePag = "internas/uMinhaConta.php";            
        break; // ------------------------------------------------------------ //

        // CARRINHO

        // Pré Carrinho
        case 'precarrinho':
            $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);              

            $produto = $objProduto->lista($atributos['p']); 
            $valorTotalProduto = $atributos['q'] * $produto->preco_venda;
            
            $fotos = $objProduto->listaFotosProduto($produto->produto_id); 
            $produto->qtd = $atributos['q'];
            $produto->foto = $fotos[0]->foto;
            $produto->precoTotal = $valorTotalProduto; 
            
            $carrinho = $objSession2Produto->adicionar($produto);            

            $objUteis->adicionarTotalCarrinho();   
            
            $titPag .= "Pré Carrinho - Verik";
            $abrePag = "internas/cPreCarrinho.php";            
        break; // ------------------------------------------------------------ //

        // Carrinho
        case 'carrinho':
            $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);

            $totalProdutos = $objSession2Produto->getTotalProdutos()['total_produtos'];
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Carrinho - Verik";
            $abrePag = "internas/cCarrinho.php";            
        break; // ------------------------------------------------------------ //

        // Pagamento
        case 'pagamento':
            $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Forma do pagamento - Verik";
            $abrePag = "internas/cPagamento.php";            
        break; // ------------------------------------------------------------ //

        // Confirmação
        case 'confirmacao':
            $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Confirmação do pedido - Verik";
            $abrePag = "internas/cConfirmacao.php";            
        break; // ------------------------------------------------------------ //

        // Conclusão
        case 'concluir':
            $atributos = $objUteis->gerarUrl($_REQUEST['atributos']);
            
            // $meta->tags = "tags";
            // $meta->descricao = "descricao.";
            $titPag .= "Conclusão do pedido - Verik";
            $abrePag = "internas/cConclusao.php";            
        break; // ------------------------------------------------------------ //

        // Cadastrar usuário
        case 'cadastrar-usuario':
            //1 fisica 
            //2 juridica 
            $formUsuario = [];
            $formEndereco = [];
            $resposta = [];

            $formUsuario['senha'] = password_hash($_POST['senha'], PASSWORD_BCRYPT);
            $formUsuario['email'] = $_POST['email'];
            $formUsuario['status'] = 1;
            $formUsuario['tipo_pessoa'] = $_POST['tipo_pessoa'];
            if($_POST['tipo_pessoa'] == 1){
                $formUsuario['cpf'] = $_POST['cpfCnpj'];
            }else{
                $formUsuario['cnpj'] = $_POST['cpfCnpj'];
            }   
            
            //$objUteis->decode($formUsuario);
            $idUsuario = $objUsuarioSite->cadastrar($formUsuario);

            $formEndereco['usuario_id'] = $idUsuario;
            $formEndereco['cep'] = $_POST['cep'];

            $enderecoUsuario = $objEnderecoUsuario->cadastrar($formEndereco);

            if($idUsuario && $enderecoUsuario){
                $resposta['situacao'] = "sucess";
            }else{
                $resposta['situacao'] = "error";                
            }

            echo json_encode($resposta);            
        exit;
    break; // ------------------------------------------------------------ //

    // Logar usuario no site
    case 'logar-usuario':
        
        $resposta = [];

        //busca email
        $emailUsuario = $objUsuarioSite->lista(['email' => $_POST['email']]);

        //valida email
        if($emailUsuario){
            //valida senha 
            if(password_verify($_POST['senha'], $emailUsuario->senha)){

                if($_POST['manter_conectado']){
                    $buscaTokenUsuario = $objUsuarioSite->listaTokenSession(array('usuario_id' => $usuario->id));                      

                    //Cria token no banco e cria o cookie                            
                    if($buscaTokenUsuario){
                        $formToken = array();
                        $formToken['id'] = $buscaTokenUsuario->id;
                        $formToken['token'] = password_hash( time() ,PASSWORD_DEFAULT);
                        $formToken['usuario_id'] = $emailUsuario->id;
                        $formToken['data_login'] = date('Y-m-d H:i:s');

                        $token = $objUsuarioSite->alterarTokenSession($formToken);

                        setcookie("tokenLogin", $formToken['token'], time()+(60*60*24*365));
                    }else{                                
                        $formToken = array();
                        $formToken['token'] = password_hash( time() ,PASSWORD_DEFAULT);
                        $formToken['usuario_id'] = $emailUsuario->id;
                        $formToken['data_login'] = date('Y-m-d H:i:s');
                        
                        $token = $objUsuarioSite->cadastrarTokenSession($formToken);

                        setcookie("tokenLogin", $formToken['token'], time()+(60*60*24*365));
                    }
                }
                //Logar
                $objSession2->set('id', $emailUsuario->id);
                $objSession2->set('nome', $emailUsuario->nome);
                $objSession2->set('email', $emailUsuario->email);    
                $resposta['situacao'] = "sucess";             
            }else{
                $resposta['situacao'] = "error";   
                $resposta['msg'] = "Senha incorreta favor tentar novamente!";
            }  

        }else{
            $resposta['situacao'] = "error";   
            $resposta['msg'] = "Email não cadastrado, favor verificar se foi digitado corretamente!";   
        }

        echo json_encode($resposta);            
        exit;
    break; // ------------------------------------------------------------ //

    // Verificar se Email já existe
    case 'valida-email-existe':
        
        $resposta = [];

        //busca email
        $emailUsuario = $objUsuarioSite->lista(['email' => $_POST['email']]);

        //valida email
        if($emailUsuario){
            
            $resposta['situacao'] = "error";   
            $resposta['msg'] = "Email já cadastrado!";  

        }           

        echo json_encode($resposta);            
        exit;
    break; // ------------------------------------------------------------ //

    // Verificar se o CPF já existe
    case 'valida-cpf-existe':   
        $resposta = [];

        //busca CPF
        
        if($_POST['tipo_pessoa'] == 1){
            $cpfUsuario = $objUsuarioSite->lista(['cpf' => $_POST['cpf']]);
        }else{
            $cnpjUsuario = $objUsuarioSite->lista(['cnpj' => $_POST['cpf']]);
        }
        
        //valida CPF
        if($cpfUsuario){
            
            $resposta['situacao'] = "error";   
            $resposta['msg'] = "CPF já cadastrado!";  

        }elseif($cnpjUsuario){
            $resposta['situacao'] = "error";   
            $resposta['msg'] = "CNPJ já cadastrado!"; 
        }          

        echo json_encode($resposta);            
        exit;
    break; // ------------------------------------------------------------ //
   
    case 'usuario-sair':   
        if(isset($_COOKIE['tokenLogin'])){
            setcookie("tokenLogin", "", time() - 3600);
            unset($_COOKIE['tokenLogin']);
        }
        
        unset($objSession2);    
        session_destroy();    
        session_unset(); 

        header('Location: '.$path['site']);
        exit;
    break; // ------------------------------------------------------------ //

    case 'adicionar-produto-carrinho':
        $idProduto = $_POST['id_produto'];
        $qtdProdutoCarrinho = $_POST['qtd_produto'];
        $resposta = [];

        $produtoCarrinho = $objSession2Produto->getProdutoItem($idProduto);  

        $produto = $objProduto->lista($idProduto);

        if($qtdProdutoCarrinho < $produto->estoque){
            $qtdProdutoCarrinho++;

            $valorAlterado = $qtdProdutoCarrinho * $produto->preco_venda;
            $produto->precoTotal = $valorAlterado;
            $produto->qtd = $qtdProdutoCarrinho;

            $objSession2Produto->remover($idProduto); 
            $objSession2Produto->adicionar($produto);

            $objUteis->adicionarTotalCarrinho();

            $total = $objSession2Produto->getTotalProdutos()['total_produtos'];

            $produtoAlteradoCarrinho = $objSession2Produto->getProdutoItem($idProduto);
            
            $resposta['total'] = $total;
            $resposta['qtd'] = $produtoAlteradoCarrinho['qtd'];
            $resposta['preco_total'] = $produtoAlteradoCarrinho['preco_total'];
            $resposta['status'] = true;
            echo json_encode($resposta);
            exit;
        }else{
            $resposta['status'] = false;
            echo json_encode($resposta);
            exit;
        }

        $produtoAlteradoCarrinho = $objSession2Produto->getProdutoItem($idProduto);
        exit;
    break; // ------------------------------------------------------------ //

    case 'remover-produto-carrinho':
        $idProduto = $_POST['id_produto'];
        $qtdProdutoCarrinho = $_POST['qtd_produto'];
        $resposta = [];

        $produtoCarrinho = $objSession2Produto->getProdutoItem($idProduto);  

        $produto = $objProduto->lista($idProduto);

        if($qtdProdutoCarrinho > 1){
            $qtdProdutoCarrinho--;

            $valorAlterado = $qtdProdutoCarrinho * $produto->preco_venda;
            $produto->precoTotal = $valorAlterado;
            $produto->qtd = $qtdProdutoCarrinho;

            $objSession2Produto->remover($idProduto); 
            $objSession2Produto->adicionar($produto);

            $objUteis->adicionarTotalCarrinho();

            $total = $objSession2Produto->getTotalProdutos()['total_produtos'];

            $produtoAlteradoCarrinho = $objSession2Produto->getProdutoItem($idProduto);
            
            $resposta['total'] = $total;
            $resposta['qtd'] = $produtoAlteradoCarrinho['qtd'];
            $resposta['preco_total'] = $produtoAlteradoCarrinho['preco_total'];
            $resposta['status'] = true;
            echo json_encode($resposta);
            exit;
        }else{
            $resposta['status'] = false;
            echo json_encode($resposta);
            exit;
        }

        $produtoAlteradoCarrinho = $objSession2Produto->getProdutoItem($idProduto);


        // print_rpre($_SESSION['PRODUTO_CARRINHO']['ID'][$idProduto]);
        exit;
    break; // ------------------------------------------------------------ //

    case 'excluir-produto-carrinho':
        $idProduto = $_POST['id_produto'];

        $objSession2Produto->remover($idProduto);

        $objUteis->adicionarTotalCarrinho();

        $total = $objSession2Produto->getTotalProdutos()['total_produtos'];

        $resposta['total'] = $total;
        $resposta['status'] = true;
        echo json_encode($resposta);
        exit;
    break; // ------------------------------------------------------------ //

    case 'adicionar-produto-favorito':
        $idProduto = $_POST['id_produto'];

        if($objSession2->get('id')){
            $resposta['total'] = $total;
            $resposta['status'] = true;
            echo json_encode($resposta);
        }else{
            $resposta['status'] = false;
            echo json_encode($resposta); 
        }

        
        exit;
    break; // ------------------------------------------------------------ //

        

    }
    

}




?>