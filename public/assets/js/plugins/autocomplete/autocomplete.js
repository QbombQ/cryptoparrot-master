var scroll; 
var mentionData = null;
$.widget( "custom.catcomplete", $.ui.autocomplete, {
    _create: function() {
        this._super();
        this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
    },
    _renderMenu: function( ul, items ) {
        var that = this,
            currentCategory = "";
        $.each( items, function( index, item ) {
            var li;
            if ( item.category != currentCategory ) {
                ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
                currentCategory = item.category;
            }
            li = that._renderItemData( ul, item );
            if(item.image) {
                li.html('<a class="btn btn-xs d-inline btn-pill btn-primary ml-2">View</a><a href="'+item.href+'"><img src="'+item.image+'" class="small-avatar user-avatar rounded-circle mr-2" />'+item.label+' <strong class="autocomplete-portfolio ' + item.totalBalanceClass + '">' + item.totalBalance + '</strong></a>');
            }else{
                li.html('<span>'+item.label+'</span>');
                li.attr('data-pair-id', item.id);
                li.addClass('autocomplete-pair', item.id);
                li.on('click', selectTag);
            }
            if ( item.category ) {
                li.attr( "aria-label", item.label );
            }
        });
    },
});

function scrollEvents()
{
    scroll.unbind('append.infiniteScroll');
    scroll.unbind('request.infiniteScroll');
    scroll.unbind('last.infiniteScroll');
    scroll.on( 'append.infiniteScroll', function( event, response ) {
        $('#replacable-main-content .shimmer-infinite').remove();
        wdtEmojiBundle.defaults.type = 'twitter';
        wdtEmojiBundle.init('textarea'); 
        if(mentionData === null) {
            /*$.getJSON( "/data/mention.json", function( data ) {
                mentionData = data;
                $('textarea').mentionsInput({
                    onDataRequest:function (mode, query, callback) {
                        data = _.filter(mentionData, function(item) { return item.name ? item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 : false});
                      callback.call(this, data);
                    }
                  });              
            });*/              
        }else{
            $('textarea').mentionsInput({
                onDataRequest:function (mode, query, callback) {
                    data = _.filter(mentionData, function(item) { return item.name ? item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 : false});
                    callback.call(this, data);
                }
            });            
        }            
        $('.trade-description').each(function() {
            var text = $(this).html();
            var output = wdtEmojiBundle.render(text);
            $(this).html(output);
        });
        $('.comment-text').each(function() {
            var text = $(this).html();
            var output = wdtEmojiBundle.render(text);
            $(this).html(output);
        });        
        initTradingView();   
    });   
    scroll.on( 'request.infiniteScroll', function( event ) {
        $('#replacable-main-content').append('<div class="shimmer-infinite"><div class="card card-small mb-3"><div class="card-body"><div class="feed-header"><div class="feed-avatar"><div class="avatar-mockup"></div></div><div class="line-mockup mt-2"></div><div class="line-mockup line-mockup-truncated"></div></div><div class="block-mockup"></div></div></div></div>');
      }); 
      scroll.on( 'last.infiniteScroll', function( event, response, path ) {
        $('#replacable-main-content').append('<div class="text-center p-5"><p class="lead mb-2">There are no more trades to view.</p><a href="/app/trade" class="btn btn-primary btn-lg"><i class="far fa-exchange-alt mr-2 "></i> Post a trade</a></div>'); 
      });      
}

$(document).ready(function() {   
    
    /* axios({
        method: 'get',
        url: '/app/mention-data',
        responseType: 'json'
    }).then(function (response) {
        mentionData = response.data;
        $('textarea').mentionsInput({
            onDataRequest:function (mode, query, callback) {
                data = _.filter(mentionData, function(item) { return item.name ? item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 : false});
                callback.call(this, data);
            }
        });
    }); */  

    $( "#search" ).catcomplete({
        appendTo: ".main-navbar__search",
        delay: 0,
        source: function( request, response ) {
            $.ajax( {
              url: "/app/users/search",
              dataType: "json",
              data: {
                term: request.term
              },
              success: function( data ) {
                console.log(data);
                response( data );
              },
              error : function(request, status, error) {
                var val = request.responseText;
                console.log(val);
              }
            });
        },
        minLength: 3,
        messages: {
            noResults: '',
            results: function() {}
        },
        open: function( event, ui ) {
            $('body').addClass('autocompleteopen');
        },
        close: function( event, ui ) {
            $('body').removeClass('autocompleteopen');
        },
        select: function (event, ui) {
            var category = ui.item.category;
            if(category == 'Pairs') {
                //$(".trade-pair-filter").val(ui.item.id).trigger('change.select2');   
                $('.trade-pair-filter, .trade-pair-filter + span').css('display','flex');
                $('#search').hide();
            }else{
                window.location.href = ui.item.href;
            }
        },
        focus: function (event, ui) {
            $(ui).addClass('active');
        }                            
    }).focus(function () {
        if($(this).val() != '') $(this).catcomplete('search', $(this).val())
        else $(this).catcomplete('search', '/')
    });
    
    $("#search").on("change paste keyup", function() {
        var val = $(this).val();
        var sanitizedVal = escapeHtml(val);
        $(this).val(sanitizedVal);
     });

});

function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 }