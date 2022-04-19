<?php

//Informações do Formalário
$nomedoformulario = 'Banner 1';
$acaodoformulario = 'index.php?acao=alterar&ctrl=banner_mini';
$avisodoformulario = 'Esta página você edita o banner mini.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_formFileCrop2('Imagem primeiro banner','primeira_imagem',false,'Resolução sugerida - 575px X 250px',$bannerminiForm->primeira_imagem);

$objForm->sk_formTextUrl('Link de redirecionamento','primeiro_link','',false,'Link de redirecionamento página.',$bannerminiForm->primeiro_link);

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Banner 2</h6></div>';

//Segundo
// $objForm->sk_formText('Título','titulo','',false,'Aqui você coloca um titulo.',$bannerminiForm->titulo);

// $objForm->sk_formText('Subtítulo','subtitulo','',false,'Aqui você coloca um subtitulo.',$bannerminiForm->subtitulo);

// $objForm->sk_formText('Texto botão','texto_botao','',false,'Aqui você coloca um titulo.',$bannerminiForm->texto_botao);

$objForm->sk_formFileCrop3('Imagem segundo banner','terceira_imagem',false,'Resolução sugerida - 575px X 250px',$bannerminiForm->terceira_imagem);

$objForm->sk_formTextUrl('Link de redirecionamento','link_botao','',false,'Link de redirecionamento página.',$bannerminiForm->link_botao);

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Banner 3</h6></div>';

$objForm->sk_formFileCrop("Imagem terceiro banner",'segunda_imagem',false, 'Resolução sugerida - 575px X 250px' ,$bannerminiForm->segunda_imagem);

$objForm->sk_formTextUrl('Link de redirecionamento','segundo_link','',false,'Link de redirecionamento página.',$bannerminiForm->segundo_link);
//Cria status
$optionsAba[] = '<option value=""></option>';
$optionsAba[] = '<option value="1" selected="selected">Ativo</option>';
$optionsAba[] = '<option value="0">Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsAba, false, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $objUteis->converteDataHora($bannerminiForm->dhcadastro));

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($bannerminiForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($bannerminiForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($bannerminiForm->data_expiracao != 0 ? $objUteis->converteDataHora($bannerminiForm->data_expiracao) : ''));


$objForm->sk_formHidden('id',$bannerminiForm->id);
$objForm->sk_formHidden('primeira_imagem_antiga',$bannerminiForm->primeira_imagem);
$objForm->sk_formHidden('segunda_imagem_antiga',$bannerminiForm->segunda_imagem);
$objForm->sk_formHidden('terceira_imagem_antiga',$bannerminiForm->terceira_imagem);

//Verfica se o usuário e Administrador
if($permissao->cadastrar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();



?>



<!-- Script para recorte da imagem. É necessário colocar esse script em todos os formulários que forem utilizar recorte para que seja informado o tamanho da imagem   -->
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
                        $('#jcrop').attr('src', e.target.result).width(575),
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
                    maxSize         : [ 575, 250 ],
                    setSelect       : [ 0, 0, 575, 250 ],                        
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 575/250
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



            $( "#img" ).click(function() {
                $("#jcrop2").remove();
                $(".jcrop-holder").remove();
                $(".imgPreview2 .formRight").append("<img id='jcrop2'/>");
            });

            function preview2(input2){
                if (input2.files && input2.files[0]){
                    var reader2 = new FileReader(); 
                    reader2.onload = function(e){
                        $('#jcrop2').attr('src', e.target.result).width(575),
                        cropImg2()
                    };
                    reader2.readAsDataURL(input2.files[0]);                    
                    $(".imgPreview2").show();
                }
            }; 

            function cropImg2(){        
                $('#jcrop2').Jcrop({
                    onChange: exibePreview2,
                    onSelect: exibePreview2,
                    bgColor         : 'white',
                    minSize         : [ 100, 100 ],
                    maxSize         : [ 575, 250 ],
                    setSelect       : [ 0, 0, 575, 250 ],                        
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 575/250
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

             $( "#img_destaque" ).click(function() {
                $("#jcrop2").remove();
                $(".jcrop-holder").remove();
                $(".imgPreview2 .formLeft").append("<img id='jcrop2'/>");
            });

            function preview2(input){
                if (input.files && input.files[0]){
                    var reader = new FileReader(); 
                    reader.onload = function(e){
                        $('#jcrop2').attr('src', e.target.result).width(575),
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
                    maxSize         : [ 575, 250 ],
                    setSelect       : [ 0, 0, 575, 250 ],                        
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 575/250
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

            //

            


            $( "#img_icone" ).click(function() {
                $("#jcrop3").remove();
                $(".jcrop-holder").remove();
                $(".imgPreview3 .formLeft").append("<img id='jcrop3'/>");
            });

            function preview3(input){
                if (input.files && input.files[0]){
                    var reader = new FileReader(); 
                    reader.onload = function(e){
                        $('#jcrop3').attr('src', e.target.result).width(575),
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
                    maxSize         : [ 575, 250 ],
                    setSelect       : [ 0, 0, 575, 250 ],                        
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 575/250
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


            $( "#img_nova" ).click(function() {
                $("#jcrop4").remove();
                $(".jcrop-holder").remove();
                $(".imgPreview4 .formLeft").append("<img id='jcrop4'/>");
            });

            function preview4(input){
                if (input.files && input.files[0]){
                    var reader = new FileReader(); 
                    reader.onload = function(e){
                        $('#jcrop4').attr('src', e.target.result).width(575),
                        cropImg4()
                    };
                    reader.readAsDataURL(input.files[0]);                    
                    $(".imgPreview4").show();
                }
            }; 

            function cropImg4(){        
                $('#jcrop4').Jcrop({
                    onChange: exibePreview4,
                    onSelect: exibePreview4,
                    bgColor         : 'white',
                    minSize         : [ 100, 100 ],
                    maxSize         : [ 575, 250 ],
                    setSelect       : [ 0, 0, 575, 250 ],                        
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 575/250
                });        
            };

            function exibePreview4(c){            
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#x2').val(c.x2);
                $('#y2').val(c.y2);
                $('#w').val(c.w);
                $('#h').val(c.h);
            };

</script> 