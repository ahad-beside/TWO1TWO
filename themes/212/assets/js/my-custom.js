/**
 * custom.js
 * http://bdwebsolutions/
 * Author: S.M.Mehedi Hasan
 * Copyright 2013, bdwebsolutions.com
 * Licensed under the bdws.
 */

$(window).load(function () {
  
//<!------------------------------------Header CART  start--------------------------------->
    $(".cartresult").hide();
    $(".cart").show();

    $('.cart').hover(function () {
        $(".cartresult").slideToggle(100);
        $(this).toggleClass('opened');

    });


    $('.wrapper-green,.wrapper-red');
    /*$('a').click(function () {
        $('.panel').removeClass('go-green');
        $('.wrapper-orange,.wrapper-green,.wrapper-red').css('display', 'none');
        if ($(this).attr('class') == 'search-orange')
            $('.wrapper-orange').css('display', '');
        else if ($(this).attr('class') == 'search-green')
            $('.wrapper-green').css('display', '');
        else if ($(this).attr('class') == 'search-red')
            $('.wrapper-red').css('display', '');

        $('.panel').html('Search results here...').animate({'height': 100}, 500);
        return true;
    });*/
//<!---------------- PRODUCTS GRID -------------------> 


//<!---------------- SIGNIN Hover -------------------> 




});


// To set it up as a global function:
function formatMoney(number, places, symbol, thousand, decimal) {
    number = number || 0;
    places = !isNaN(places = Math.abs(places)) ? places : 2;
    symbol = symbol !== undefined ? symbol : "";
    thousand = thousand || ",";
    decimal = decimal || ".";
    var negative = number < 0 ? "-" : "",
            i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
    return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
}

function addLoading($this) {
    $($this).addClass('fdloading');
    $($this).addClass('duo');
}

function removeLoading($this) {
    $($this).removeClass('fdloading');
    $($this).removeClass('duo');
}

function scrollToTarget(aid) {
    var aTag = $(aid);
    $('html,body').animate({scrollTop: aTag.offset().top - 100}, 'slow');
}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
}
;






