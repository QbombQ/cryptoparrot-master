import ScrollBooster from 'scrollbooster'

var sidebar;
var ticker;

var viewport = document.querySelector('.market-scroll');
if(viewport) var content = document.querySelector('.market-scroll-content');
  
if(viewport){

var sb = new ScrollBooster({
  viewport,
  content,
  mode: 'x',
  onUpdate: (data)=> {
    viewport.scrollLeft = data.position.x
  }
})

}  

$(document).ready(function(){

    $('#sort-quick-trades').select2({
        minimumResultsForSearch: -1,
        closeOnSelect: true,
        placeholder: "Performace",
    });  
 
    $('#sort-quick-trades').on('change',function(){
       
        var option = $(this).val();
        console.log(option);

        $('.col-card').sort(function (a, b) {

          var contentA =parseFloat( $(a).data('change'));
          var contentB =parseFloat( $(b).data('change'));

          if(option == 'best'){

            return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;

          }else{

            return (contentB > contentA) ? -1 : (contentB < contentA) ? 1 : 0;

          }     

        }).appendTo('#quick-pairs');; 
 
    }); 

	initFeedSticky(); 

}); 



function initFeedSticky(){

    if($(".sticky-sidebar").length > 0){

        sidebar = new StickySidebar('.sticky-sidebar', {
            topSpacing: 210, 
            bottomSpacing: 30, 
            minWidth: 1199,
            containerSelector: '.main-feed',
            innerWrapperSelector: '.sidebar__inner'
        }); 

    }

}