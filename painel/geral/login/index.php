<?
    include '../inc/config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Painel Administrativo</title>
<link href="../sistema/css/main.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="../sistema/css/login/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../sistema/css/login/fontawesome-all.min.css">
<link rel="stylesheet" type="text/css" href="../sistema/css/login/iofrm-style.css">
<link rel="stylesheet" type="text/css" href="../sistema/css/login/iofrm-theme1.css">

<script type="text/javascript" src="../sistema/js/jquery.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/spinner/ui.spinner.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/spinner/jquery.mousewheel.js"></script>

<script type="text/javascript" src="../sistema/js/jqueryui.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/forms/uniform.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/chosen.jquery.min.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/wizard/jquery.form.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/wizard/jquery.validate.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/wizard/jquery.form.wizard.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/tables/datatable.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/tables/tablesort.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/tables/resizable.min.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.sourcerer.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/calendar.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/elfinder.min.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/redactor/redactor.js"></script>

<script type="text/javascript" src="../sistema/js/custom.js"></script>

<script src="../sistema/js/plugins/ckeditor/ckeditor.js"></script>

<!--login -->
<script src="../sistema/js/login/popper.min.js"></script>
<script src="../sistema/js/login/bootstrap.min.js"></script>
<script src="../sistema/js/login/main.js"></script>

</head>

<body class="nobg loginPage">

<?php $configuracao = Config::AtributosConfig(); ?>


<div class="form-body">
    <div class="website-logo">
        <a href="#">
            <div>
                <img src="../sistema/images/logo.png" alt="Verik">
            </div>
        </a>
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">

            </div>
        </div>
        <div class="form-holder" id='logarPainel'>
            <div class="form-content">
                <div class="form-items">
                    <h3>Bem-vindo!<br/> Faça login na sua conta.</h3>
                    <p>Para acessar a área administrativa, preencha os campos abaixo com usuário e senha válidos! :)</p>
                    <div class="page-links">
                        <a href="#" class="active">Login</a>
                    </div>
                    <form action="javascript:;" id="frmLogarPaginaInicial">
                        <input type="text" name="email" class="form-control validate[required,custom[email]]" id="email" placeholder="Seu e-mail">
                        <input type="password" name="senha" class="form-control validate[required]" id="pass"  placeholder="Sua senha">
                        <input type="hidden" value="<?=$_SERVER['REMOTE_ADDR'];?>" name="ip" />
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">Login</button> <a href="javascript:;" id="clicarEsqueciSenha">Esqueceu sua senha?</a>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>


        <div class="form-holder" style="display: none;" id="esqueciSenha">
            <div class="form-content">
                <div class="form-items">
                    <h3>Esqueceu sua senha de acesso?</h3>
                    <p>Identifique-se para receber um e-mail com as instruções com uma nova senha.</p>
                    <div class="page-links">
                        <a href="#" class="active">Recuperar senha</a>
                    </div>
                    <form action="javascript:;" id="frmEsquecerSenhaPaginaInicial">
                        <input type="text" name="email" class="form-control validate[required,custom[email]]" id="email" placeholder="Seu e-mail">
                        <input type="hidden" value="<?=$_SERVER['REMOTE_ADDR'];?>" name="ip" />
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">Recuperar Senha</button> <a href="javascript:;" id="clicarVoltarSenha">Fazer Login</a>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>



<script>
	$('#clicarEsqueciSenha').click(function(){
		$('#esqueciSenha').fadeIn();
		$('#logarPainel').css('display','none');
	});

	$('#clicarVoltarSenha').click(function(){
		$('#logarPainel').fadeIn();
		$('#esqueciSenha').css('display','none');
	});
</script>


</body>
</html>