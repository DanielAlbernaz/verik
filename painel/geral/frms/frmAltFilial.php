    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Filial';
$acaodoformulario = 'index.php?acao=alterar&ctrl=filial';
$avisodoformulario = 'Esta página você altera as filiais.';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Monta o array com as categorias cadastradas no banco
for($i=0; $i < count($filialApi); $i++){    
    if($filialApi[$i]->id == $filialForm->filial){             
        $nome_categoria = $filialApi[$i]->nome;
    }   
}

$optionsCategoria[] = '<option value="" ></option>';
$optionsCategoria[] = '<option value='.$filialForm->filial.' selected="selected" >'.$nome_categoria.'</option>';
foreach($filialApi as $key => $val){
    if($val->id <> NULL){
        if($val->id <> $filialForm->filial){
            $optionsCategoria[] = '<option value='.$val->id.'>'.$val->nome.'</option>';
        }       
    }  
}

$objForm->sk_formSelect('Filial', 'filial', $optionsCategoria, true, 'Selecione uma filial');

$objForm->sk_formTextCNPJ('CNPJ','cnpj','',false,'Aqui você altera o cnpj',$filialForm->cnpj);

$objForm->sk_formText('Cidade/UF','cidade','',false,'Aqui você altera a cidade.',$filialForm->cidade);

$objForm->sk_formFileCrop("Imagem",'imagem',false,'Tamanho da imagem do banner 1200px x 628px',$filialForm->imagem);

$camposBranco[] =  '

    <div class="formRow" style="border-bottom: none !important; padding-top:1px;  margin-top: -15px;">  

        <label id=\"sheepItForm_label\">
            Telefone
        </label>

        <div class="formRight">

            <div class="horas horaInicialFinal">

                <input type="text" name="telefone[]" placeholder="Telefone" style="width:100px; " id="sheepItForm_#index#_telefone" mask-input="fone" original-title="Informe o número do telefone">

            </div>

            <div align="left" style="margin-left: 50px;float: left;margin-top: 5px;">

                <a href=\'javascript:;\' id="sheepItForm_remove_current">

                    <img class="delete" src="images/icons/control/16/clear.png" width="16" height="16" border="0" title="Remover telefone">

                </a>

            </div>            

        </div>

    </div>  

    <br/>

<div class=\'clear\'></div>  

';

$objForm->sk_formClone($camposBranco,'sheepItForm');

$objForm->sk_formTextEmail('E-mail','email','',false,'Aqui você altera o e-mail.',$filialForm->email);

$objForm->sk_formText('Latitude','latitude','',true,'Aqui você altera a latitude do Google Maps',$filialForm->latitude);

$objForm->sk_formText('Longitude','longitude','',true,'Aqui você altera a longitude do Google Maps',$filialForm->longitude);

$objForm->sk_formTextPequeno('Ordem exibição','ordem','',true,'Ordem exibição EX: 0, 1, 2.', $filialForm->ordem);

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Galeria de fotos</h6></div>';
$objForm->sk_montaMultUploadGaleria($filialForm->id,'index.php?acao=cadastraFoto&ctrl=filial',$formularioFotos->fotos,'index.php?acao=deletarFoto&ctrl=filial');

//Status
$optionsStatus[] = '<option value="1"'. ($filialForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($filialForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $objUteis->converteDataHora($filialForm->dhcadastro));

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($filialForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($filialForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($filialForm->data_expiracao != 0 ? $objUteis->converteDataHora($filialForm->data_expiracao) : ''));


//Cria um input hidden
$objForm->sk_formHidden('id',$filialForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$filialForm->imagem);

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
                        $('#jcrop').attr('src', e.target.result).width(1290),
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
                    maxSize         : [ 1290, 658 ],
                    setSelect       : [ 0, 0, 1290, 658 ],                       
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 1290/658
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


<script>

    

$(function () { 



if($("#sheepItForm").html() != null){

    $('#sheepItForm').sheepIt({

           separator: '',

           allowRemoveLast: true,

           allowRemoveCurrent: true,

           allowRemoveAll: true,

           allowAdd: true,

           allowAddN: false,

           minFormsCount: 1,

           maxFormsCount: 50,

           iniFormsCount: 1,

           removeLastConfirmation: true,

   removeCurrentConfirmation: true,

   removeAllConfirmation: true,

   removeLastConfirmationMsg: 'Deseja Remover?',

   removeCurrentConfirmationMsg: 'Deseja Remover?',

   removeAllConfirmationMsg: 'Deseja Remover todos?',

    afterAdd: function() {

    

            $("input[mask-input=fone]").focusout(function(){

                var phone, element;

                element = $(this);

                element.unmask();

                phone = element.val().replace(/\D/g, '');

                if(phone.length > 10) {

                    element.mask("(99) 9 9999-999?9",{placeholder:""});

                } else {

                    element.mask("(99) 9999-9999?9",{placeholder:""});

                }

            }).trigger('focusout'); 

     

    },    

   data: [

       <?php for($i=0;$i<$telefones["num"];$i++){?>

           {

               'sheepItForm_#index#_telefone': '<?= $telefones[$i]->telefone?>',

           },

       <?php }?>

       ]

    });

    } 
});

</script>