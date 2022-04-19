    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Blog';
$acaodoformulario = 'index.php?acao=alterar&ctrl=blog';
$avisodoformulario = 'Esta página você altera o blog cadastrado.';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Titulo','titulo','',true,'Aqui você altera o titulo do banner.',$blogForm->titulo);

//Monta o array com as categorias cadastradas no banco

for($i=0; $i < count($categoria); $i++){    
    if($categoria[$i]->id == $blogForm->categoria ){             
        $nome_categoria = $categoria[$i]->nome_categoria;
    }   
}

$optionsCategoria[] = '<option value="" ></option>';
$optionsCategoria[] = '<option value='.$blogForm->categoria.' selected="selected" >'.$nome_categoria.'</option>';
foreach($categoria as $key => $val){
    if($val->id <> NULL){
        if($val->id <> $blogForm->categoria){
            $optionsCategoria[] = '<option value='.$val->id.'>'.$val->nome_categoria.'</option>';
        }       
    }  
}

$objForm->sk_formSelect('Categoria', 'categoria', $optionsCategoria, true, 'Selecione uma categoria');

//Cria o Texto de descrição
$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você escreve o texto.', $blogForm->texto);

$objForm->sk_formFileCrop("Imagem",'imagem',false,'Tamanho da imagem do banner 1200px x 628px',$blogForm->imagem);

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Galeria de fotos</h6></div>';
$objForm->sk_montaMultUploadGaleria($blogForm->id,'index.php?acao=cadastraFoto&ctrl=blog',$formularioFotos->fotos,'index.php?acao=deletarFoto&ctrl=blog');

//Status
$optionsStatus[] = '<option value="1"'. ($blogForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($blogForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $objUteis->converteDataHora($blogForm->dhcadastro));

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($blogForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($blogForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($blogForm->data_expiracao != 0 ? $objUteis->converteDataHora($blogForm->data_expiracao) : ''));


//Cria um input hidden
$objForm->sk_formHidden('id',$blogForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$blogForm->imagem);

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
                        $('#jcrop').attr('src', e.target.result).width(1200),
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
                    maxSize         : [ 1200, 628 ],
                    setSelect       : [ 0, 0, 1200, 628 ],                       
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 1200/628
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