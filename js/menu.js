var menuCompleto = $('.navbar.navbar-inverse.navbar-fixed-top.menu-principal-nav');
var btnClose = $('.menu-btn.close-btn');
var btnMenu = $('.menu-btn.bars');
var menuItens = $('.nav.navbar-nav.menu-itens');

$(document).ready(function(){
    btnMenu.on("click", function(){
        menuCompleto.addClass('menu-mobile');
        menuItens.addClass('menu-mobile');
        btnClose.removeClass('click-off');
        btnMenu.addClass('click-off');
    });

    btnClose.on("click", function(){
        menuCompleto.removeClass('menu-mobile');
        menuItens.removeClass('menu-mobile');
        btnClose.addClass('click-off');
        btnMenu.removeClass('click-off');
    });

});