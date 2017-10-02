$.cloudinary.responsive();
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

//$(document).on('pjax:complete', function() {
//    var newWindowHeight = window.outerHeight;
//    var newContainerHeight = contentContainer.outerHeight;
//    var newHeight2load = newWindowHeight - containerHeight + newContainerHeight;
//    document.body.style.height = newHeight2load;
//    //var width = window.outerWidth;
//
//    //masterBody.resizeTo(width,newHeight2load);
//    //alert(newHeight2load);
//});






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