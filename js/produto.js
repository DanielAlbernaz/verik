function adicionarQuantidade(qtdEstoque)
{
    var quantidadeProdutos = parseInt($('#quantidadeProdutos').val());    

    if(quantidadeProdutos < qtdEstoque){
        quantidadeProdutos+= 1;
        $('#quantidadeProdutos').val(quantidadeProdutos);
    }
}

function removerQuantidade()
{
    var quantidadeProdutos = parseInt($('#quantidadeProdutos').val());  

    if(quantidadeProdutos > 1){
        quantidadeProdutos-= 1;
        $('#quantidadeProdutos').val(quantidadeProdutos);
    }
}   


function linkPreCarrinho(produto)
{
    qtdProduto = parseInt($('#quantidadeProdutos').val());
    var link = 'precarrinho/' + 'p/' + produto + '/q/' + qtdProduto;

    window.location.href = pathSite + link;
}

function adicionarQuantidadeCarrinho(idProduto)
{
    $.ajax({											
        url: pathSite + 'adicionar-produto-carrinho',
        dataType: 'json', 
        data: {'id_produto': idProduto, 'qtd_produto': $('#quantidadeProdutos'+idProduto).val()},
        type: 'post',												
        success: function(obj){
            
            if(obj.status == true){

                editarTotalProdutos(obj.total);
                editarTotalPrecoItem(idProduto, obj.qtd, obj.preco_total);

            }else if(obj.status == false){
                console.log(response);
            }            
        },
        error : function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        },							
        beforeSend : function(requisicao){
        }
    });
}

function removerQuantidadeCarrinho(idProduto)
{
    $.ajax({											
        url: pathSite + 'remover-produto-carrinho',
        dataType: 'json', 
        data: {'id_produto': idProduto, 'qtd_produto': $('#quantidadeProdutos'+idProduto).val()},
        type: 'post',												
        success: function(obj){
            
            if(obj.status == true){
                editarTotalProdutos(obj.total);
                editarTotalPrecoItem(idProduto, obj.qtd, obj.preco_total);                
            }else if(obj.status == false){
                console.log(response);
            }            
        },
        error : function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        },							
        beforeSend : function(requisicao){
        }
    });
}

function excluirProdutoCarrinho(idProduto)
{
    $.ajax({											
        url: pathSite + 'excluir-produto-carrinho',
        dataType: 'json', 
        data: {'id_produto': idProduto},
        type: 'post',												
        success: function(obj){            
            if(obj.status == true){ 
                var htmlValorTotal = '';
                $('#divTotalProdutos').html('');

                if(obj.total){   
                    htmlValorTotal +='<td class="cart__summary--total__title text-left">Valor dos Produtos:</td>';
                    htmlValorTotal +='<td class="cart__summary--amount text-right" id="valorTotalProdutos">R$ ' + obj.total.toLocaleString('pt-br', {minimumFractionDigits: 2}) + '</td>';
                }else{
                    htmlValorTotal +='<td class="cart__summary--total__title text-left">Valor dos Produtos:</td>';
                    htmlValorTotal +='<td class="cart__summary--amount text-right" id="valorTotalProdutos">R$ </td>';
                }              

                $('#produtoCarrinho'+idProduto).remove();
                $('#divTotalProdutos').html(htmlValorTotal);
            }else if(obj.status == false){
                console.log(response);
            }            
        },
        error : function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        },							
        beforeSend : function(requisicao){
        }
    });
}

function editarTotalProdutos(valorTotal)
{
    var htmlValorTotal = '';
    $('#divTotalProdutos').html('');

    htmlValorTotal +='<td class="cart__summary--total__title text-left">Valor dos Produtos:</td>';
    htmlValorTotal +='<td class="cart__summary--amount text-right" id="valorTotalProdutos">R$ ' + valorTotal.toLocaleString('pt-br', {minimumFractionDigits: 2}) + '</td>';
    $('#divTotalProdutos').html(htmlValorTotal);
}

function editarTotalPrecoItem(idProduto, qtd, preco_total)
{
    var html = '';                
    $('#quantidadeProdutos'+idProduto).val(qtd);
    $('#precoTotalItem'+idProduto).html('');     
    
    html +='<span class="cart__price end">R$ ' + preco_total.toLocaleString('pt-br', {minimumFractionDigits: 2}) + ' </span>';
    $('#precoTotalItem'+idProduto).html(html);
}

function adicionarFavorito(idProduto)
{
    $.ajax({											
        url: pathSite + 'adicionar-produto-favorito',
        dataType: 'json', 
        data: {'id_produto': idProduto},
        type: 'post',												
        success: function(obj){            
            if(obj.status == true){ 

            }else if(obj.status == false){
                window.location.href = pathSite + 'login';
            }            
        },
        error : function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        },							
        beforeSend : function(requisicao){
        }
    });
}