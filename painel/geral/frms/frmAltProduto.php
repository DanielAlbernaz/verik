    
<?php
//Informações do Formalário
$nomedoformulario = 'Alterar cadastro de produto';
$acaodoformulario = 'index.php?acao=alterar&ctrl=produto';
$avisodoformulario = 'Esta página você altera o cadastro de produto.';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_inicioWizard('Informações produto');

//Cria um input text
$objForm->sk_formText('Nome produto','nome_produto','',true,'Aqui você o escreve o nome do produto.',$produtoForm->nome_produto);

$objForm->sk_formTextPequeno('Código produto','codigo_produto','',false,'Aqui você o escreve código do produto.',$produtoForm->codigo_produto);

$objForm->sk_formTextPequeno('Referência','referencia_produto','',false,'Aqui você escreve a referência do produto.',$produtoForm->referencia_produto);

$objForm->sk_formTextPequeno('Código de barras','codigo_barras','',false,'Aqui você escreve o código de barras do produto.',$produtoForm->codigo_barras);

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

$objForm->sk_formTextPequeno('Peso','peso','',false,'Aqui você escreve o peso do produto.',$produtoForm->peso);

$objForm->sk_formText('Fabricante','fabricante','',false,'Aqui você o escreve o nome do fabricante produto.',$produtoForm->fabricante);

$objForm->sk_formText('Marca','marca','',false,'Aqui você o escreve o nome da marca produto.',$produtoForm->marca);

for($i=0; $i < count($categoria); $i++){    
    if($categoria[$i]->id == $produtoForm->id_categoria_produto ){             
        $nome_categoria = $categoria[$i]->nome;
    }   
}

$optionsCategoria[] = '<option value="" ></option>';
$optionsCategoria[] = '<option value='.$produtoForm->id_categoria_produto.' selected="selected" >'.$nome_categoria.'</option>';
foreach($categoria as $key => $val){
    if($val->id <> NULL){
        if($val->id <> $produtoForm->id_categoria_produto){
            $optionsCategoria[] = '<option value='.$val->id.'>'.$val->nome.'</option>';
        }       
    }  
}

$objForm->sk_formSelect('Categoria', 'id_categoria_produto', $optionsCategoria, true, 'Selecione uma categoria');


$objForm->sk_fimWizard();

$objForm->sk_inicioWizard('Informações produto');

$objForm->sk_formTextHTML('Descrição','descricao',false,'Aqui você escreve a descrição do produto.',$produtoForm->descricao);

$objForm->sk_formTextarea('Informação adicional','informacao_adicional','1000',false,'Aqui você escreve a informação adicional do produto.',$produtoForm->informacao_adicional);

$objForm->sk_fimWizard();

$objForm->sk_inicioWizard('Informações produto');

$objForm->sk_formTextPequenoNumber('Quantidade estoque','quantidade_estoque','',true,'Aqui você o escreve a quantidade de estoque do produto.',$produtoForm->quantidade_estoque);

$objForm->sk_formPrecoPequeno('Preço custo','preco_custo','',false,'Aqui você o escreve o preço de custo do produto.',$objUteis->converterPrecoExebicao($produtoForm->preco_custo));

$objForm->sk_formPrecoPequeno('Preço venda','preco_venda','',true,'Aqui você o escreve o preço de venda do produto.',$objUteis->converterPrecoExebicao($produtoForm->preco_venda));

$objForm->sk_fimWizard();

$objForm->sk_inicioWizard('Informações produto');

$objForm->sk_formFileCrop("Imagem principal",'imagem_principal',false, 'Resolução sugerida - 580px X 630px',$produtoForm->imagem_principal);

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Galeria de fotos</h6></div>';
$objForm->sk_montaMultUploadGaleria($produtoForm->id,'index.php?acao=cadastraFoto&ctrl=produto',$formularioFotos->fotos,'index.php?acao=deletarFoto&ctrl=produto');

$objForm->sk_fimWizard();

$objForm->sk_inicioWizard('Informações produto');

//Status
$optionsStatus[] = '<option value="1"'. ($produtoForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($produtoForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $objUteis->converteDataHora($produtoForm->dhcadastro));

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($produtoForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($produtoForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($produtoForm->data_expiracao != 0 ? $objUteis->converteDataHora($produtoForm->data_expiracao) : ''));

//Cria um input hidden
$objForm->sk_formHidden('id',$produtoForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$produtoForm->imagem_principal);

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
                removeAllConfirmationMsg: 'Deseja Remover todos?',
                data: [
                    <? for($i=0;$i<$coresProduto["num"];$i++){?>
                        {
                            'sheepItForm_#index#_cores': '<?= $coresProduto[$i]->cor?>'
                        },
                    <?}?>
                    ]
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