<?

include_once "../inc/protege.php";

//classe de post
include_once "../classes/session/post.class.php";
$objPost = new gp();


	//classe de session
	include_once "../classes/session/class.eyesecuresession.inc.php";
	$objSession2 = new EyeSecureSession('session123');

	
	$permissao = null;
	$abrePag = null;
	
    //classe de conex�o
    include_once "../../classes/class.conexao.php";

    //classe que possui algumas funções utéis(Ex.: Conversão de datas, moedas, etc.)
    include_once "../classes/class.uteis.php";
    $objUteis = new Uteis();

    //classe de se��o
    include_once "../classes/class.secao.php";
    $objSecao = new Secao();
    
    //inclui a classe de formularios
    include_once "../classes/class.form.php";
    $objForm = new Form();
    
    //inclui a classe dos correios
    include_once "../classes/class.Correios.php";
    $objCorreios = new Correios();  
    

    if(!isset($objPost->param["ctrl"])){
       include '../ctrlLogs.php';
    }
	
    if(isset($objPost->param["ctrl"])){
	    if($objPost->param["ctrl"] == "configuracoes"){
	
	       include '../ctrlConfiguracao.php';
	    }
    }
    
    if(isset($objPost->param["ctrl"])){
    	if($objPost->param["ctrl"] == "cpanel"){
    
    		include '../ctrlCpanel.php';
    	}
    }
    
    if(isset($objPost->param["ctrl"])){
	    if($objPost->param["ctrl"] == "modulo"){
	       include '../ctrlModulo.php';
	    }
    }
    
    if(isset($objPost->param["ctrl"])){
    	if($objPost->param["ctrl"] == "usuarios"){
    		include '../usuarios/ctrlUsuarios.php';
    	}
    }
    
    $secoes_fixas = $objSecao->listar_fixas();
    //$objUteis->encode($secoes_fixas);

    for($i=0;$i<$secoes_fixas["num"];$i++){
    $sem_acento = $objUteis->nameArq(utf8_decode($secoes_fixas[$i]->titulo));
	    if(isset($objPost->param["ctrl"])){
	        if($objPost->param["ctrl"] == $sem_acento){
	           include "{$secoes_fixas[$i]->ctrl}";
	        }
	    }
    }

    if($objSession2->get('tlAdmLoginId')){

    ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
    <title>Painel Administrativo</title>
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="fontawesome-pro/css/all.css">
    <link href="css/multiUpload.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" src="js/jquery.js"></script>

    <script type="text/javascript" src="js/plugins/spinner/ui.spinner.js"></script>
    <script type="text/javascript" src="js/plugins/spinner/jquery.mousewheel.js"></script>

    <script type="text/javascript" src="js/jqueryui.js"></script>

    <script type="text/javascript" src="js/plugins/charts/excanvas.min.js"></script>
    <script type="text/javascript" src="js/plugins/charts/jquery.flot.js"></script>
    <script type="text/javascript" src="js/plugins/charts/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="js/plugins/charts/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="js/plugins/charts/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="js/plugins/charts/jquery.sparkline.min.js"></script>

    <script type="text/javascript" src="js/plugins/forms/uniform.js"></script>
    <script type="text/javascript" src="js/plugins/forms/jquery.cleditor.js"></script>
    <script type="text/javascript" src="js/plugins/forms/jquery.validationEngine-en.js"></script>
    <script type="text/javascript" src="js/plugins/forms/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="js/plugins/forms/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="js/plugins/forms/autogrowtextarea.js"></script>
    <script type="text/javascript" src="js/plugins/forms/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="js/plugins/forms/jquery.dualListBox.js"></script>
    <script type="text/javascript" src="js/plugins/forms/jquery.inputlimiter.min.js"></script>
    <script type="text/javascript" src="js/plugins/forms/chosen.jquery.min.js"></script>

    <script type="text/javascript" src="js/plugins/wizard/jquery.form.js"></script>
    <script type="text/javascript" src="js/plugins/wizard/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/wizard/jquery.form.wizard.js"></script>

    <script type="text/javascript" src="js/plugins/uploader/plupload.js"></script>
    <script type="text/javascript" src="js/plugins/uploader/plupload.html5.js"></script>
    <script type="text/javascript" src="js/plugins/uploader/plupload.html4.js"></script>
    <script type="text/javascript" src="js/plugins/uploader/jquery.plupload.queue.js"></script>

    <script type="text/javascript" src="js/plugins/tables/datatable.js"></script>
    <script type="text/javascript" src="js/plugins/tables/tablesort.min.js"></script>
    <script type="text/javascript" src="js/plugins/tables/resizable.min.js"></script>

    <script type="text/javascript" src="js/plugins/ui/jquery.tipsy.js"></script>
    <script type="text/javascript" src="js/plugins/ui/jquery.collapsible.min.js"></script>
    <script type="text/javascript" src="js/plugins/ui/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="js/plugins/ui/jquery.progress.js"></script>
    <script type="text/javascript" src="js/plugins/ui/jquery.timeentry.min.js"></script>
    <script type="text/javascript" src="js/plugins/ui/jquery.colorpicker.js"></script>
    <script type="text/javascript" src="js/plugins/ui/jquery.jgrowl.js"></script>
    <script type="text/javascript" src="js/plugins/ui/jquery.breadcrumbs.js"></script>
    <script type="text/javascript" src="js/plugins/ui/jquery.sourcerer.js"></script>

    <script type="text/javascript" src="js/plugins/calendar.min.js"></script>
    <script type="text/javascript" src="js/plugins/elfinder.min.js"></script>

    <script type="text/javascript" src="js/plugins/redactor/redactor.js"></script>
    <script type="text/javascript" src="js/plugins/forms/upload.min.js"></script>
    <script type="text/javascript" src="js/plugins/forms/myupload.js"></script>
    <script type="text/javascript" src="js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="js/jquery.price_format.1.8.min.js"></script>
    <script type="text/javascript" src="js/loginForm.js"></script>

    <script type="text/javascript" src="js/jcrop/js/jquery.Jcrop.js"></script>
    <script src="fontawesome-pro/js/all.js"></script>
    <link rel="stylesheet" href="js/jcrop/css/jquery.Jcrop.css" type="text/css" />

    <script type="text/javascript" src="js/custom.js"></script>

    <script src="js/plugins/ckeditor/ckeditor.js"></script>
    <!-- <script src="js/bootstrap.min.js"></script> -->

    <script src="js/gmap3.min.js"></script>
    <script src="js/jquery.formToWizard.js"></script>
    <!--- importação para confirmação personalizada js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

</head>

<body>
    <?php  $configuracao = Config::AtributosConfig(); ?>
    <div class="row">
        <div class="col-12 col-lg-2 col-md-2 box-menu-lateral-painel">
            <!--  menu lateral -->
            <div class="menu-lateral-painel">
                <!-- logo -->
                <div class="logo"><a href="<?=$configuracao["siteDesenvolvedor"]?>" target="_blank">
                        <img src="<?php echo $configuracao['urllogo']; ?>" alt="Verik" width='120' /></a>
                </div>
                <!--/fim logo -->
                <!-- menu -->
                <ul id="menu" class="nav">
                    <li class="dash"><a href="index.php" title=""><span>Início</span></a></li>
                    <?
                    if($objSession2->get('tlAdmLoginNivel') == 1){
                    ?>
                    <?
                    if($objSession2->get('tlAdmLoginNivel') == 1 && $configuracao["whm"]['dominio'] && $configuracao["whm"]['user'] && $configuracao["whm"]['pass'] && $configuracao["whm"]['userCpanelCliente']){
                     ?>
                    <li>
                        <a href="#" title="" class="exp"><span style="background-image:url('images/icons/light/create.png')">Hospedagem do Site</span></a>
                        <ul class="sub">
                            <li><a href="index.php?acao=listar&ctrl=cpanel" title="">Detalhes</a></li>
                            <?php if($configuracao['permissao']['emailCpanel']): ?>
                            <li><a href="index.php?acao=criar-email&ctrl=cpanel" title="">-- Criar Email</a></li>
                            <li><a href="index.php?acao=listar-emails&ctrl=cpanel" title="">-- Listar Emails</a></li>
                            <?php endif;?>
                            <?php if($configuracao['permissao']['ftpCpanel']): ?>
                            <li><a href="index.php?acao=criar-ftp&ctrl=cpanel" title="">-- Criar Ftp</a></li>
                            <li><a href="index.php?acao=listar-ftp&ctrl=cpanel" title="">-- Listar Ftp</a></li>
                            <?php endif;?>

                        </ul>
                    </li>
                    <?}?>
                    <?php if($configuracao['permissao']['formulario']): ?>
                    <li>
                        <a href="#" title="" class="exp"><span style="background-image:url('images/icons/light/create.png')">Formulários</span></a>
                        <ul class="sub">
                            <?
                                if($objSession2->get('tlAdmLoginNivel') == 1){
                             ?>
                            <?php if($configuracao['permissao']['formularioCriar']): ?>
                            <li><a href="index.php?acao=frmCad&ctrl=configuracoes" title="">Cadastrar email de
                                    recebimento</a></li>
                            <?php endif;?>
                            <?}?>
                            <?php if($configuracao['permissao']['formularioListar']): ?>
                            <li><a href="index.php?acao=listar&ctrl=configuracoes" title="">Listar emails de
                                    recebimento</a></li>
                            <?php endif;?>
                        </ul>
                    </li>
                    <?php endif;?>
                    <?php if($configuracao['permissao']['modulo']): ?>
                    <li><a href="#" title="" class="exp"><span
                                style="background-image:url('images/icons/light/cog3.png')">Módulos</span></a>
                        <ul class="sub">
                            <?
                        if($objSession2->get('tlAdmLoginNivel') == 1){
                             ?>
                            <?php if($configuracao['permissao']['moduloCriar']): ?>
                            <li><a href="index.php?acao=frmCad&ctrl=modulo" title="">Cadastrar módulo</a></li>
                            <?php endif;?>
                            <?}?>
                            <?php if($configuracao['permissao']['moduloListar']): ?>
                            <li><a href="index.php?acao=listar&ctrl=modulo" title="">Listar módulos</a></li>
                            <?php endif;?>
                        </ul>
                    </li>
                    <?php endif;?>
                    <?}?>
                    <?
        
        for($i=0;$i<$secoes_fixas["num"];$i++){
            $sem_acento = $objUteis->nameArq(utf8_decode($secoes_fixas[$i]->titulo));
            $permissao2 = $objSecao->permissaoSecaoFixaUsuario($secoes_fixas[$i]->id,$objSession2->get('tlAdmLoginId'));
            $menus = $objSecao->listar_menu_by_secao_fixa($secoes_fixas[$i]->id);
            //$objUteis->encode($menus);
            ?>
                    <?if(count($menus) &&  isset($permissao2->id) &&  $permissao2->id){?>
                    <li><a href="#" title="" class="exp"><span
                                style="background-image:url('<?=$secoes_fixas[$i]->img?>')"><?=$secoes_fixas[$i]->menu?></span></a>
                        <ul class="sub">
                            <?for($j=0;$j<$menus["num"];$j++){?>
                            <li><a href="<?=$menus[$j]->url?>" title=""><?=$menus[$j]->titulo?></a></li>
                            <?}?>
                        </ul>
                    </li>
                    <?}?>
                    <?}?>
                </ul>
                <!--/fim menu -->
            </div>
            <!--/fim  menu lateral -->


        </div>
        <!-- conteudo do painel -->
        <div class="col-12 col-lg-10 col-md-10" style="padding:0px 0px;">
            <div class="topNav">
                <div class="wrapper">
                    <div class="welcome"><a href="../gt.php?img=sistema/<?=$objSession2->get('tlAdmLoginImg')?>&h=250" title="<?=$objSession2->get('tlAdmLoginNome')?>" rel="lightbox"><img src="../gt.php?img=sistema/<?=$objSession2->get('tlAdmLoginImg')?>&h=16" alt="" /></a><span>Bem vindo, <?=$objSession2->get('tlAdmLoginNome')?>!</span></div>
                    <div class="userNav">
                        <ul>
                            <li><a href="index.php?acao=listaUsuarios&ctrl=usuarios" title="Listar Usuários"><i class="far fa-user"></i></a></li>
                            <?
                                if($objSession2->get('tlAdmLoginNivel') == 1){
                            ?>
                            <li><a href="index.php?acao=listar&ctrl=modulo" title="Módulo"><i class="far fa-cog"></i></a></li>
                            <?}?>
                            <li><a href="index.php?acao=sair&ctrl=usuarios" title="Sair do painel."><i class="far fa-times-circle"></i></a></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

            <!-- Responsive header -->
            <div class="resp" style="background:#000">
                <div class="respHead" style="background:#000">
                    <a href="<?=$configuracao["siteDesenvolvedor"]?>" target="_blank"><img src="<?php echo $configuracao['urllogo']; ?>" alt="Verik" width='120' /></a>
                </div>

               

                
                <div class="smalldd">
                    <span class="goTo"><img src="images/icons/light/frames.png" alt="" />Menu</span>
                    <ul class="smallDropdown">

                        <li><a href="index.php" title=""><img src="images/icons/light/home.png" alt="" />Início</a></li>
                        <?
                if($objSession2->get('tlAdmLoginNivel') == 1){
                     ?>
                        <?
               if($objSession2->get('tlAdmLoginNivel') == 1 && $configuracao["whm"]['dominio'] && $configuracao["whm"]['user'] && $configuracao["whm"]['pass'] && $configuracao["whm"]['userCpanelCliente']){
                     ?>
                        <li><a href="#" title="" class="exp"><img src="images/icons/light/create.png"
                                    alt="" />Hospedagem do Site</a>
                            <ul class="sub">

                                <li><a href="index.php?acao=listar&ctrl=cpanel" title="">Detalhes</a></li>
                                <?php if($configuracao['permissao']['emailCpanel']): ?>
                                <li><a href="index.php?acao=criar-email&ctrl=cpanel" title="">-- Criar Email</a></li>
                                <li><a href="index.php?acao=listar-emails&ctrl=cpanel" title="">-- Listar Emails</a>
                                </li>
                                <?php endif;?>
                                <?php if($configuracao['permissao']['ftpCpanel']): ?>
                                <li><a href="index.php?acao=criar-ftp&ctrl=cpanel" title="">-- Criar Ftp</a></li>
                                <li><a href="index.php?acao=listar-ftp&ctrl=cpanel" title="">-- Listar Ftp</a></li>
                                <?php endif;?>

                            </ul>
                        </li>
                        <?}?>
                        <?php if($configuracao['permissao']['formulario']): ?>
                        <li><a href="#" title="" class="exp"><img src="images/icons/light/create.png"
                                    alt="" />Formulários</a>
                            <ul class="sub">
                                <?
                        if($objSession2->get('tlAdmLoginNivel') == 1){
                             ?>
                                <?php if($configuracao['permissao']['formularioCriar']): ?>
                                <li><a href="index.php?acao=frmCad&ctrl=configuracoes" title="">Cadastrar email de
                                        recebimento</a></li>
                                <?php endif;?>
                                <?}?>
                                <?php if($configuracao['permissao']['formularioListar']): ?>
                                <li><a href="index.php?acao=listar&ctrl=configuracoes" title="">Listar emails de
                                        recebimento</a></li>
                                <?php endif;?>
                            </ul>
                        </li>
                        <?php endif;?>
                        <?php if($configuracao['permissao']['modulo']): ?>
                        <li><a href="#" title="" class="exp"><img src="images/icons/light/cog3.png" alt="" />Módulos</a>
                            <ul class="sub">
                                <?
                        if($objSession2->get('tlAdmLoginNivel') == 1){
                             ?>
                                <?php if($configuracao['permissao']['moduloCriar']): ?>
                                <li><a href="index.php?acao=frmCad&ctrl=modulo" title="">Cadastrar módulo</a></li>
                                <?php endif;?>
                                <?}?>
                                <?php if($configuracao['permissao']['moduloListar']): ?>
                                <li><a href="index.php?acao=listar&ctrl=modulo" title="">Listar módulos</a></li>
                                <?php endif;?>
                            </ul>
                        </li>
                        <?php endif;?>
                        <?php }?>
                        <?for($i=0;$i<$secoes_fixas["num"];$i++){
                    $sem_acento = $objUteis->nameArq(utf8_decode($secoes_fixas[$i]->titulo));
                    $permissao2 = $objSecao->permissaoSecaoFixaUsuario($secoes_fixas[$i]->id,$objSession2->get('tlAdmLoginId'));
                    $menus = $objSecao->listar_menu_by_secao_fixa($secoes_fixas[$i]->id);
                    //$objUteis->encode($menus);
                    ?>
                        <?if(count($menus) &&  isset($permissao2->id) &&  $permissao2->id){?>
                        <li><a href="<?=$menus[$j]->url?>" title="" class="exp"><img src="<?=$secoes_fixas[$i]->img?>"
                                    alt="" /><?=$secoes_fixas[$i]->menu?></a>
                            <ul class="sub">
                                <?for($j=0;$j<$menus["num"];$j++){?>
                                <li><a href="<?=$menus[$j]->url?>" title=""><?=$menus[$j]->titulo?></a></li>
                                <?}?>
                            </ul>
                        </li>
                        <?}?>
                        <?}?>
                    </ul>
                </div>
                <div class="cLine"></div>
            </div>

            <!-- Title area -->
            <div class="titleArea">
                <div class="wrapper">
                    <div class="pageTitle">
                        <h5>Olá, <strong>Verik!</strong> Que bom te ver por aqui.</h5>
                        <span>Gerencie toda sua loja aqui em caso de dificuldade acesse nossa base de conhecimento clique aqui.</span>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

            

            <!-- Main content wrapper -->
            <div class="wrapper">

                <?php
                if($abrePag){
            	    include("$abrePag");
                    }
                 ?>

            </div>
        </div>
    </div>





    <!-- Right side -->




</body>

</html>

<?}else{?>
    <script type='text/javascript'>
        window.location = '../../index.php';
    </script>
<?}?>