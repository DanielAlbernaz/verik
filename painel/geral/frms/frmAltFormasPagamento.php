    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Informações da forma de pagamento';
$acaodoformulario = 'index.php?acao=alterar&ctrl=formaspagamento';
$avisodoformulario = 'Esta página você altera as Informações da forma de pagamento';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Título','titulo','',true,'Aqui digita um título.', $formasPagamentoForm->titulo);

$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você escreve o texto.', $formasPagamentoForm->texto);

$objForm->sk_formFileCrop("Imagem",'imagem',false,'Tamanho da imagem formas pagamento 1920px x 400px',$formasPagamentoForm->imagem);

//Cria um input hidden
$objForm->sk_formHidden('id',$formasPagamentoForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$formasPagamentoForm->imagem);

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