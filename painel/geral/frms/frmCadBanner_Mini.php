<?php

//Informações do Formalário
$nomedoformulario = 'Cadastrar Empreendimento';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=empreendimento';
$avisodoformulario = 'Esta página você cadastra os Artigos para o Empreendimento.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);


/**
 * Inicia o Wizard
 */
$objForm->sk_inicioWizard('Página de cadastro de empreendimento');

//Cria um input text
$objForm->sk_formText('Título','titulo','',true,'Aqui você coloca um titulo.');

$objForm->sk_formText('Subtítulo','subtitulo','',true,'Aqui você coloca um subtitulo.');

//Cria o Texto de descrição
$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você escreve o texto.');

$objForm->sk_formFileCrop("Banner empreendimento",'imagem',true, 'Resolução sugerida - 800px X 445px');

/**
 * Final do Wizard
 */
$objForm->sk_fimWizard();

/**
 * Inicia o Wizard
 */
$objForm->sk_inicioWizard('Página de cadastro de empreendimento');

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Selecione habilidades da formação do curso</h6></div>';  
for($i=0; $i < $caracteristica['num']; $i++){
    $objForm->sk_formCheckbox($caracteristica[$i]->titulo, 'caracteristica[]', '', false, 'Escolha as habilidades da formação', $caracteristica[$i]->id);
 }


 $objForm->sk_formFileCrop3('Imagem ícone','img_icone',false,'Resolução sugerida - 80px X 80px');
 /**
 * Final do Wizard
 */
$objForm->sk_fimWizard();

 /**
 * Inicia o Wizard
 */
$objForm->sk_inicioWizard('Página de cadastro de empreendimento');

$objForm->sk_formFileCrop2('Imagem destaque','img_destaque',true,'Resolução sugerida - 1903px X 250px');

$objForm->sk_formText('Link vídeo','url','',false,'Link do vídeo.');

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Galeria de fotos</h6></div>';
$objForm->sk_montaMultUploadGaleria('','index.php?acao=cadastraFoto&ctrl=empreendimento','','');

//Cria status
$optionsAba[] = '<option value=""></option>';
$optionsAba[] = '<option value="1" selected="selected">Ativo</option>';
$optionsAba[] = '<option value="0">Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsAba, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.');

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.');

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.');


//Verfica se o usuário e Administrador
if($permissao->cadastrar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

/**
 * Final do Wizard
 */
$objForm->sk_fimWizard();



?>



<!-- Script para recorte da imagem. É necessário colocar esse script em todos os formulários que forem utilizar recorte para que seja informado o tamanho da imagem -->
<script>

$( "#img" ).click(function() {
                $("#jcrop").remove();
                $(".jcrop-holder").remove();
                $(".imgPreview .formLeft").append("<img id='jcrop'/>");
            });

            function preview(input){
                if (input.files && input.files[0]){
                    var reader = new FileReader(); 
                    reader.onload = function(e){
                        $('#jcrop').attr('src', e.target.result).width(1000),
                        cropImg()
                    };
                    reader.readAsDataURL(input.files[0]);                    
                    $(".imgPreview").show();
                }
            }; 

            function cropImg(){        
                $('#jcrop').Jcrop({
                    onChange: exibePreview,
                    onSelect: exibePreview,
                    bgColor         : 'white',
                    minSize         : [ 100, 100 ],
                    maxSize         : [ 1903, 250 ],
                    setSelect       : [ 0, 0, 1903, 250 ],                        
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 1903/250
                });        
            };

            function exibePreview(c){            
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#x2').val(c.x2);
                $('#y2').val(c.y2);
                $('#w').val(c.w);
                $('#h').val(c.h);
            };    



            $( "#img_destaque" ).click(function() {
                $("#jcrop2").remove();
                $(".jcrop-holder").remove();
                $(".imgPreview2 .formLeft").append("<img id='jcrop2'/>");
            });

            function preview2(input){
                if (input.files && input.files[0]){
                    var reader = new FileReader(); 
                    reader.onload = function(e){
                        $('#jcrop2').attr('src', e.target.result).width(403),
                        cropImg2()
                    };
                    reader.readAsDataURL(input.files[0]);                    
                    $(".imgPreview2").show();
                }
            }; 

            function cropImg2(){        
                $('#jcrop2').Jcrop({
                    onChange: exibePreview2,
                    onSelect: exibePreview2,
                    bgColor         : 'white',
                    minSize         : [ 100, 100 ],
                    maxSize         : [ 403, 473 ],
                    setSelect       : [ 0, 0, 403, 473 ],                        
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 403/473
                });        
            };

            function exibePreview2(c){            
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#x2').val(c.x2);
                $('#y2').val(c.y2);
                $('#w').val(c.w);
                $('#h').val(c.h);
            };  
            
            $( "#img_icone" ).click(function() {
                $("#jcrop3").remove();
                $(".jcrop-holder").remove();
                $(".imgPreview3 .formLeft").append("<img id='jcrop3'/>");
            });

            function preview3(input){
                if (input.files && input.files[0]){
                    var reader = new FileReader(); 
                    reader.onload = function(e){
                        $('#jcrop3').attr('src', e.target.result).width(100),
                        cropImg3()
                    };
                    reader.readAsDataURL(input.files[0]);                    
                    $(".imgPreview3").show();
                }
            }; 

            function cropImg3(){        
                $('#jcrop3').Jcrop({
                    onChange: exibePreview3,
                    onSelect: exibePreview3,
                    bgColor         : 'white',
                    minSize         : [ 100, 100 ],
                    maxSize         : [ 80, 80 ],
                    setSelect       : [ 0, 0, 80, 80 ],                        
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 80/80
                });        
            };

            function exibePreview3(c){            
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#x2').val(c.x2);
                $('#y2').val(c.y2);
                $('#w').val(c.w);
                $('#h').val(c.h);
            }; 

</script> 