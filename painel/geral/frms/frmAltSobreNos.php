    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Informações de Sobre nós';
$acaodoformulario = 'index.php?acao=alterar&ctrl=sobrenos';
$avisodoformulario = 'Esta página você altera as Informações de Sobre nós';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text

$objForm->sk_formText('Título','titulo','',true,'Aqui digita um título.', $sobrenosForm->titulo);

$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você escreve o texto.', $sobrenosForm->texto);

$objForm->sk_formFileCrop("Imagem",'imagem',false,'Tamanho da imagem do banner 290px x 450px',$sobrenosForm->imagem);

//Cria um input hidden
$objForm->sk_formHidden('id',$sobrenosForm->id);


//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$sobrenosForm->imagem);

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
                        $('#jcrop').attr('src', e.target.result).width(290),
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
                    maxSize         : [ 290, 450 ],
                    setSelect       : [ 0, 0, 290, 450 ],                       
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 290/450
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