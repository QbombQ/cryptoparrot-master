var currentPrice = {};
var socket = io.connect('https://streamer.cryptocompare.com/');
var subscription = ['0~Coinbase~BTC~USD'];
socket.emit('SubAdd', { subs: subscription });  
socket.on("m", function(message) {
	var messageType = message.substring(0, message.indexOf("~"));
	if (messageType == 0) {
		dataUnpack(message);
	}
}); 

var dataUnpack = function(message) {
	var data = CCC.CURRENT.unpack(message);

	var from = data['FROMSYMBOL'];
	var to = data['TOSYMBOL'];
	var fsym = CCC.STATIC.CURRENCY.getSymbol(from);
	var tsym = CCC.STATIC.CURRENCY.getSymbol(to);
	var pair = from + to;

	if (!currentPrice.hasOwnProperty(pair)) {
		currentPrice[pair] = {};
	}

	for (var key in data) {
		currentPrice[pair][key] = data[key];
	}

	var lastPrice = currentPrice[pair]['LASTUPDATE'];
	var priceDirection = currentPrice[pair]['FLAGS'];

	calculateDaysToSave(lastPrice);
	

	$('#result').data('btc-price',lastPrice.toFixed(2));
	
	$('.price-now').html('$'+lastPrice.toFixed(2));
	$('.price-now').removeClass('up down');
	if (priceDirection & 1) {
		$('.price-now').addClass("up");
	}
	else if (priceDirection & 2) {
		$('.price-now').addClass("down");
	}


};


function calculateResult(){

	avgPrice = $('#result').data('avg-price');
	price = $('#result').data('btc-price');
	packPerDay = $('#packs-per-day').val();
	days = price / (avgPrice * packPerDay);
	years = days / 365; 

	if(avgPrice != 0){

		$('#result').html(yearsToYearsMonthsDays(years.toFixed(2)));
		$('#result-holder').removeClass('d-none');

		$('#tweet-result').attr('data-text','1 Bitcoin in the next '+yearsToYearsMonthsDays(years.toFixed(2)).replace(/<(?:.|\n)*?>/gm, '')+'! Calculate how much Bitcoin you would acquire if you quit at #quitsmokingforbtc')
		SocialShareKit.init();


	} 

} 
 

function calculateDaysToSave(price){

	$('.country').each(function(i,element){

		avgPrice = $(element).data('avg-price');
		days = price / avgPrice;
		years = days / 365;
		$(element).find('.days-to-save').html(yearsToYearsMonthsDays(years.toFixed(2)));

	});

}

function yearsToYearsMonthsDays(value){

    var totalDays = value * 365;
    var years = Math.floor(totalDays/365);
    var months = Math.floor((totalDays-(years *365))/30);
    var days = Math.floor(totalDays - (years*365) - (months * 30));

    var result = "";

    if(years == 1) result = result + years + ' <small class="font-weight-bold">year</small>';
    else if(years > 1) result = result + years + ' <small class="font-weight-bold">years</small>';

    if(years && months || years && days) result = result + ", ";

    if(months == 1) result = result + months + ' <small class="font-weight-bold">month,</small> ';
    else if(months > 1) result = result + months + ' <small class="font-weight-bold">months,</small> ';

    if(parseInt(days) == 1) result = result + days + ' <small class="font-weight-bold">day</small> ';
    else if(parseInt(days) > 1) result = result + days + ' <small class="font-weight-bold">days</small> ';
 
    return result;  
}

function getByValue(arr, value) {
  var o;

  for (var i=0, iLen=arr.length; i<iLen; i++) {
    o = arr[i];

    for (var p in o) {
      if (o.hasOwnProperty(p) && o[p] == value) {
        return o;
      }
    }
  }
}
$(document).ready(function(){

	$('.ssk').on('click', function (e) {
        e.preventDefault();
    });

	Papa.parse('data.csv', {
	    download: true,
	    header: true,
	    delimiter: ",",
	    complete: function complete(csv) {

	        data = csv.data;
	        exploreData(data);

	        $('#calculate').on('click',function(){

	        	var country = $('#country').val();
	        	var target = getByValue(data,country);

	        	$('#result').data('avg-price',target.avg_price);

	        	calculateResult();

	        });

	    }
	});

	$('#country').select2({
		width:'100%'
	});

	$(document).on('click', '.number-spinner button', function () {   

		var btn = $(this),
		  oldValue = btn.closest('.number-spinner').find('input').val().trim(),
		  newVal = 0;

		if (btn.attr('data-dir') == 'up') {
		  newVal = parseFloat(oldValue) + 0.5;
		} else {
		  if (oldValue > 0.5) {
		    newVal = parseFloat(oldValue) - 0.5;
		  } else {
		    newVal = 0.5;
		  } 
		}
		btn.closest('.number-spinner').find('input').val(newVal);

	});

});

function exploreData(data){

	$.each(data,function(i,v){

		i++;

		el = '<tr class="country" data-avg-price="'+v.avg_price+'">'+
              '<th scope="row">'+i+'</th>'+
              '<td>'+v.country+'</td>'+
              '<td>$'+v.avg_price+'</td>'+
              '<td class="days-to-save">-</td>'+
        	'</tr>';

        $('#results').append(el);

	});

	new ScrollHint('.js-scrollable');

}