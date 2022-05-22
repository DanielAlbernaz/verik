<?php

//Informações do Formalário
$nomedoformulario = 'Cadastrar produto';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=produto';
$avisodoformulario = 'Esta página você cadastra os produtos.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_inicioWizard('Informações produto');

//Cria um input text
$objForm->sk_formText('Nome produto','nome_produto','',true,'Aqui você o escreve o nome do produto.');

$objForm->sk_formTextPequeno('Código produto','codigo_produto','',false,'Aqui você o escreve código do produto.');

$objForm->sk_formTextPequeno('Referência','referencia_produto','',false,'Aqui você escreve a referência do produto.');

$objForm->sk_formTextPequeno('Código de barras','codigo_barras','',false,'Aqui você escreve o código de barras do produto.');

$objForm->sk_fimWizard();


$objForm->sk_inicioWizard('Informações produto');

$camposBranco[] =  "<div class='formRow' style='padding:5px 14px;'>
                        <label>Cor produto 
                            <span id=\"sheepItForm_label\"></span>
                        </label>
                        
                        <div class='formRight'>
                            <input style='margin-left: -58%;' class='validate[required]' id=\"sheepItForm_#index#_cores\" type='color' name='cores[]'/><br/>
                            <div align='right' style='width:80%;'>
                                <a href='javascript:;' id=\"sheepItForm_remove_current\">
                                    <img class=\"delete\" src=\"images/icons/control/16/clear.png\" width=\"16\" height=\"16\" border=\"0\">
                                </a>
                            </div>
                        </div>
                    <div class='clear'>
                    </div></div>";

$objForm->sk_formClone($camposBranco);

// $objForm->sk_formText('Nome produto','nome_produto','',false,'Aqui você o escreve o nome do produto.');

$objForm->sk_formTextPequeno('Peso','peso','',false,'Aqui você escreve o peso do produto.');

$objForm->sk_formText('Fabricante','fabricante','',false,'Aqui você o escreve o nome do fabricante produto.');

$objForm->sk_formText('Marca','marca','',false,'Aqui você o escreve o nome da marca produto.');

//Monta o array com as categorias cadastradas no banco
$optionsCategoria[] = '<option value="" selected="selected"></option>';
for($i=0; $i < count($categoria) -1; $i++){
    $optionsCategoria[] = '<option value='.$categoria[$i]->id.'>'.$categoria[$i]->nome.'</option>';
}

$objForm->sk_formSelect('Categoria', 'id_categoria_produto', $optionsCategoria, true, 'Selecione uma categoria');

$objForm->sk_fimWizard();

$objForm->sk_inicioWizard('Informações produto');

$objForm->sk_formTextHTML('Descrição','descricao',false,'Aqui você escreve a descrição do produto.');

$objForm->sk_formTextarea('Informação adicional','informacao_adicional','1000',false,'Aqui você escreve a informação adicional do produto.');

$objForm->sk_fimWizard();

$objForm->sk_inicioWizard('Informações produto');

$objForm->sk_formTextPequenoNumber('Quantidade estoque','quantidade_estoque','',true,'Aqui você o escreve a quantidade de estoque do produto.');

$objForm->sk_formPrecoPequeno('Preço custo','preco_custo','',false,'Aqui você o escreve o preço de custo do produto.');

$objForm->sk_formPrecoPequeno('Preço venda','preco_venda','',true,'Aqui você o escreve o preço de venda do produto.');

$objForm->sk_fimWizard();

$objForm->sk_inicioWizard('Informações produto');

$objForm->sk_formFileCrop("Imagem principal",'imagem_principal',true, 'Resolução sugerida - 580px X 630px');

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Galeria de fotos</h6></div>';
$objForm->sk_montaMultUploadGaleria('','index.php?acao=cadastraFoto&ctrl=produto','','');

$objForm->sk_fimWizard();

$objForm->sk_inicioWizard('Informações produto');

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
$objForm->sk_fimWizard();
$objForm->sk_fimDoFormulario();
?>



<!-- Script para recorte da imagem. É necessário colocar esse script em todos os formulários que forem utilizar recorte para que seja informado o tamanho da imagem -->
<script>
    $(function () { 

        if($("#sheepItForm").html() != null){
            $('#sheepItForm').sheepIt({
                separator: '',
                allowRemoveLast: true,
                allowRemoveCurrent: true,
                allowRemoveAll: true,
                allowAdd: true,
                allowAddN: true,
                minFormsCount: 0,
                iniFormsCount: 1,
                removeLastConfirmation: true,
                removeCurrentConfirmation: true,
                removeAllConfirmation: true,
                removeLastConfirmationMsg: 'Deseja Remover?',
                removeCurrentConfirmationMsg: 'Deseja Remover?',
                removeAllConfirmationMsg: 'Deseja Remover todos?'
            });
        }

    });


            $( "#img" ).click(function() {
                $("#jcrop").remove();
                $(".jcrop-holder").remove();
                $(".imgPreview .formRight").append("<img id='jcrop'/>");
            });

            function preview(input){
                if (input.files && input.files[0]){
                    var reader = new FileReader(); 
                    reader.onload = function(e){
                        $('#jcrop').attr('src', e.target.result).width(580),
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
                    maxSize         : [ 580, 630 ],
                    setSelect       : [ 0, 0, 580, 630 ],                       
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 580/630
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