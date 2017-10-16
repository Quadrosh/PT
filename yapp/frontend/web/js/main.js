//$.cloudinary.responsive();
//var contentContainer = document.getElementById('contentBox');
//var masterBody = document.getElementById('masterBody');
//var containerHeight = contentContainer.outerHeight;

$(document).on('click', '.pjax_btn', function(e){
    e.preventDefault();
    var $this = $(this);
    var href = $this.attr('href');
    var pjax_id = "masterArticleText";

    $.pjax.reload('#' + pjax_id, {
        url:href,
        push:true,
        replace: true,
        pushRedirect: true,
        replaceRedirect: true
    });
    //$.pjax.reload({container:'#' + pjax_id, url:href, push:false});

    return false;
});




$(document).ready(function() {

    //Slick
    var popArticles = $('.popularArticles').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        easing:'easeInOutSine',
        prevArrow:'.popArtPrev',
        nextArrow:'.popArtNext',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ],
    });







    //$('.masterListItem').match_height().parent('.popularMasters').slick({
    //    vertical:true,
    //
    //});

    //var maxHeight = -1;
    //$('.masterListItem').each(function() {
    //    if ($(this).height() > maxHeight) {
    //        maxHeight = $(this).height();
    //    }
    //});
    //$('.masterListItem').each(function() {
    //    if ($(this).height() < maxHeight) {
    //        $(this).css('margin', Math.ceil((maxHeight-$(this).height())/2) + 'px 0');
    //    }
    //});


    //$('.popularMasters').slick({
    //    infinite: true,
    //    slidesToShow: 3,
    //    slidesToScroll: 1,
    //    easing:'easeInOutSine',
    //    prevArrow:'.popMasPrev',
    //    nextArrow:'.popMasNext',
    //    vertical: true,
    //    verticalSwiping: true,
    //    variableHeight: true,
    //});




});






//
//$(document).on('click', '.pjax_btn', function(e){
//    e.preventDefault();
//    var $this = $(this);
//    var href = $this.attr('href');
//    var pjax_id = "masterArticleText";
//
//
//
//
//    $.pjax.reload('#' + pjax_id, {
//        url:href,
//        push:false,
//        replace: false,
//        pushRedirect: false,
//        replaceRedirect: false
//        //scrollTo: 500
//    });
//    //$.pjax.reload({container:'#' + pjax_id, url:href, push:false});
//    return false;
//});