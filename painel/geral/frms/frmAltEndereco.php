    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Informações da empresa';
$acaodoformulario = 'index.php?acao=alterar&ctrl=endereco';
$avisodoformulario = 'Esta página você altera as Informações da empresa';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_formText('Nome da empresa','nome','',false,'Aqui você altera o nome da empresa.',$enderecoForm->nome);

$objForm->sk_formTextCNPJ('CNPJ','cnpj','',false,'Aqui você altera o cnpj da empresa.',$enderecoForm->cnpj);

$objForm->sk_formTextTelefone('Telefone','telefone','',false,'Aqui você altera o telefone.',$enderecoForm->telefone);

$objForm->sk_formTextTelefone('Whatsapp','whatsapp','',false,'Aqui você altera o Whatsapp.',$enderecoForm->whatsapp);

$objForm->sk_formTextEmail('E-mail','email','',false,'Aqui você altera o e-mail.',$enderecoForm->email);

$objForm->sk_formText('Endereço','endereco','',false,'Aqui você altera o endereço. Ex: Rua, Qd., Lt, Nº',$enderecoForm->endereco);

$objForm->sk_formText('Complemento','complemento','',false,'Aqui você altera o complemento. Ex: Ed.',$enderecoForm->complemento);

$objForm->sk_formText('Bairro','bairro','',false,'Aqui você altera o bairro.',$enderecoForm->bairro);

$objForm->sk_formText('Cidade/UF','cidade','',false,'Aqui você altera a cidade.',$enderecoForm->cidade);

$objForm->sk_formTextCep('CEP','cep','',false,'Aqui você altera o CEP.',$enderecoForm->cep);

$objForm->sk_formText('Latitude','latitude','',false,'Aqui você altera a latitude do Google Maps',$enderecoForm->latitude);

$objForm->sk_formText('Longitude','longitude','',false,'Aqui você altera a longitude do Google Maps',$enderecoForm->longitude);

$objForm->sk_formText('Títutlo','titulo','',false,'Aqui você altera o título.',$enderecoForm->titulo);

$objForm->sk_formTextHTML('Texto','texto',false,'Aqui você escreve o texto.', $enderecoForm->texto);


//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Cria um input hidden
$objForm->sk_formHidden('id',$enderecoForm->id);


//Final do Formulário
$objForm->sk_fimDoFormulario();

?>




<!-- Script para recorte da imagem. É necessário colocar esse script em todos os formulários que forem utilizar recorte para que seja informado o tamanho da imagem   -->
<script>

        $( "#imagem_categoria" ).click(function() {
                $("#jcrop").remove();
                $(".jcrop-holder").remove();
                $(".imgPreview .formLeft").append("<img id='jcrop'/>");
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
                    maxSize         : [ 1920/2, 250/2 ],
                    setSelect       : [ 0, 0, 1920/2, 250/2 ],                        
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 1920/250
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



            $( "#imagem_fabricantes" ).click(function() {
                $("#jcrop2").remove();
                $(".jcrop-holder").remove();
                $(".imgPreview2 .formRight").append("<img id='jcrop2'/>");
            });

            function preview2(input2){
                if (input2.files && input2.files[0]){
                    var reader2 = new FileReader(); 
                    reader2.onload = function(e){
                        $('#jcrop2').attr('src', e.target.result).width(1920/2),
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
                    maxSize         : [ 1920/2, 250/2 ],
                    setSelect       : [ 0, 0, 1920/2, 250/2 ],                        
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 1920/250
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

            

</script> 