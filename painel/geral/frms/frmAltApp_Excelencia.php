    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Informações';
$acaodoformulario = 'index.php?acao=alterar&ctrl=app_excelencia';
$avisodoformulario = 'Esta página você altera as Informações';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_formFileCrop("Banner",'imagem',false,'Tamanho da imagem do banner 1180px x 293px',$AppExcelenciaForm->imagem);    

echo'<div class="title"><h6>Vídeos</h6></div>';

$objForm->sk_formText('Título','titulo_video','',true,'Aqui digita um título.', $AppExcelenciaForm->titulo_video);

$objForm->sk_formText('Subtitulo','sub_titulo_video','',true,'Aqui digita um título.', $AppExcelenciaForm->sub_titulo_video);

echo'<div class="title"><h6>Vantagens</h6></div>';

$objForm->sk_formText('Título','titulo_vantagens','',true,'Aqui digita um título.', $AppExcelenciaForm->titulo_vantagens);

$objForm->sk_formText('Subtitulo','sub_titulo_vantagens','',true,'Aqui digita um título.', $AppExcelenciaForm->sub_titulo_vantagens);

echo'<div class="title"><h6>Links APP\'s</h6></div>';

$objForm->sk_formText('Título','titulo_link','',true,'Aqui digita um título.', $AppExcelenciaForm->titulo_link);

$objForm->sk_formText('Subtitulo','sub_titulo_link','',true,'Aqui digita um título.', $AppExcelenciaForm->sub_titulo_link);

//Cria um input hidden
$objForm->sk_formHidden('id',$AppExcelenciaForm->id);

$objForm->sk_formHidden('imgAntiga',$AppExcelenciaForm->imagem);
//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>


<!-- Script para recorte da imagem. É necessário colocar esse script em todos os formulários que forem utilizar recorte para que seja informado o tamanho da imagem -->
<script>

            $( "#img" ).click(function() {
                $("#jcrop").remove();
                $(".jcrop-holder").remove();
                $(".imgPreview .formRight").append("<img id='jcrop'/>");
            });

            function preview(input){
                if (input.files && input.files[0]){
                    var reader = new FileReader(); 
                    reader.onload = function(e){
                        $('#jcrop').attr('src', e.target.result).width(1180),
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
                    maxSize         : [ 1180, 293 ],
                    setSelect       : [ 0, 0, 1180, 293 ],                       
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 1180/293
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

</script>