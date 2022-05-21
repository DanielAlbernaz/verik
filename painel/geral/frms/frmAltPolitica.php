    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Informações de politica de privacidade';
$acaodoformulario = 'index.php?acao=alterar&ctrl=politica';
$avisodoformulario = 'Esta página você altera as Informações de politica de privacidade';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text

$objForm->sk_formText('Título','titulo','',true,'Aqui digita um título.', $politicaForm->titulo);

$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você escreve o texto.', $politicaForm->texto);

$objForm->sk_formFileCrop("Imagem",'imagem',false,'Tamanho da imagem do da polílitica de privacidade 1920px x 400px',$politicaForm->imagem);

//Cria um input hidden
$objForm->sk_formHidden('id',$politicaForm->id);
$objForm->sk_formHidden('imgAntiga',$termoForm->imagem);


//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>

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
                        $('#jcrop').attr('src', e.target.result).width(1920/2),
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
                    maxSize         : [ 1920/2, 400/2 ],
                    setSelect       : [ 0, 0, 1920/2, 400/2 ],                       
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 1920/400
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