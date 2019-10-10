//Pagina de Listagem
var editeBtn = $('.edite-btn');
var ativaDesativaBtn = $('.desative-btn, .ative-btn');

console.log(editeBtn.data('value'));

function ativaDispositivo(element){
    return $.ajax({
        url:"autoload/ativaDesativa.php",
        data:{pk: element.data('value')},
        type: "POST",
        dataType: "text",
        success:function(response){
            console.log('ok');
            console.log(response);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}

$(document).ready(function(){
    ativaDesativaBtn.on("click", function(){
        ativaDispositivo($(this));
        setTimeout(function(){
            location.reload();
        }, 100);
    });
});