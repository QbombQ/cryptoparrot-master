$(document).ready(function(){

    initProfileSticky();
    reloadPageOnModalClose();

});

function reloadPageOnModalClose()
{
    $('#tradeModal').on('hidden.bs.modal', function () {
        window.location.href = '/'+profileSlug;
    });
}

function initProfileSticky(){

    if($(".sticky-stats").length > 0){

    var sidebar = new StickySidebar('.sticky-stats', {
        topSpacing: 60, 
        bottomSpacing: 30, 
        minWidth: 1199,
        containerSelector: '.main-content-container',
        innerWrapperSelector: '.stats__inner'
    });  

    }

    if($(".sticky-profile-sidebar").length > 0){

    var sidebar = new StickySidebar('.sticky-profile-sidebar', {
        topSpacing: 60, 
        bottomSpacing: 30, 
        minWidth: 1199,
        containerSelector: '.main-content-container',
        innerWrapperSelector: '.profile-sidebar__inner'
    });  

    }

}

