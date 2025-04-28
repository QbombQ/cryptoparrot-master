/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/ladda/js/ladda.js":
/*!****************************************!*\
  !*** ./node_modules/ladda/js/ladda.js ***!
  \****************************************/
/*! exports provided: create, bind, stopAll */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "create", function() { return create; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "bind", function() { return bind; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "stopAll", function() { return stopAll; });
/* harmony import */ var spin_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! spin.js */ "./node_modules/spin.js/spin.js");
/*!
 * Ladda
 * http://lab.hakim.se/ladda
 * MIT licensed
 *
 * Copyright (C) 2018 Hakim El Hattab, http://hakim.se
 */

 

// All currently instantiated instances of Ladda
var ALL_INSTANCES = [];

/**
 * Creates a new instance of Ladda which wraps the
 * target button element.
 *
 * @return An API object that can be used to control
 * the loading animation state.
 */
function create( button ) {

	if( typeof button === 'undefined' ) {
		console.warn( "Ladda button target must be defined." );
		return;
	}

	// The button must have the class "ladda-button"
	if ( !button.classList.contains('ladda-button') ) {
		button.classList.add( 'ladda-button' );
	}

	// Style is required, default to "expand-right"
	if( !button.hasAttribute( 'data-style' ) ) {
		button.setAttribute( 'data-style', 'expand-right' );
	}

	// The text contents must be wrapped in a ladda-label
	// element, create one if it doesn't already exist
	if( !button.querySelector( '.ladda-label' ) ) {
		var laddaLabel = document.createElement( 'span' );
		laddaLabel.className = 'ladda-label';
		wrapContent( button, laddaLabel );
	}

	// The spinner component
	var spinner,
		spinnerWrapper = button.querySelector( '.ladda-spinner' );

	// Wrapper element for the spinner
	if( !spinnerWrapper ) {
		spinnerWrapper = document.createElement( 'span' );
		spinnerWrapper.className = 'ladda-spinner';
	}

	button.appendChild( spinnerWrapper );

	// Timer used to delay starting/stopping
	var timer;

	var instance = {

		/**
		 * Enter the loading state.
		 */
		start: function() {

			// Create the spinner if it doesn't already exist
			if( !spinner ) {
				spinner = createSpinner( button );
			}

			button.disabled = true;
			button.setAttribute( 'data-loading', '' );

			clearTimeout( timer );
			spinner.spin( spinnerWrapper );

			this.setProgress( 0 );

			return this; // chain

		},

		/**
		 * Enter the loading state, after a delay.
		 */
		startAfter: function( delay ) {

			clearTimeout( timer );
			timer = setTimeout( function() { instance.start(); }, delay );

			return this; // chain

		},

		/**
		 * Exit the loading state.
		 */
		stop: function() {

			if (instance.isLoading()) {
				button.disabled = false;
				button.removeAttribute( 'data-loading' );	
			}

			// Kill the animation after a delay to make sure it
			// runs for the duration of the button transition
			clearTimeout( timer );

			if( spinner ) {
				timer = setTimeout( function() { spinner.stop(); }, 1000 );
			}

			return this; // chain

		},

		/**
		 * Toggle the loading state on/off.
		 */
		toggle: function() {
			return this.isLoading() ? this.stop() : this.start();
		},

		/**
		 * Sets the width of the visual progress bar inside of
		 * this Ladda button
		 *
		 * @param {Number} progress in the range of 0-1
		 */
		setProgress: function( progress ) {

			// Cap it
			progress = Math.max( Math.min( progress, 1 ), 0 );

			var progressElement = button.querySelector( '.ladda-progress' );

			// Remove the progress bar if we're at 0 progress
			if( progress === 0 && progressElement && progressElement.parentNode ) {
				progressElement.parentNode.removeChild( progressElement );
			}
			else {
				if( !progressElement ) {
					progressElement = document.createElement( 'div' );
					progressElement.className = 'ladda-progress';
					button.appendChild( progressElement );
				}

				progressElement.style.width = ( ( progress || 0 ) * button.offsetWidth ) + 'px';
			}

		},

		isLoading: function() {

			return button.hasAttribute( 'data-loading' );

		},

		remove: function() {

			clearTimeout( timer );

			button.disabled = false;
			button.removeAttribute( 'data-loading' );

			if( spinner ) {
				spinner.stop();
				spinner = null;
			}

			ALL_INSTANCES.splice( ALL_INSTANCES.indexOf(instance), 1 );

		}

	};

	ALL_INSTANCES.push( instance );

	return instance;

}

/**
 * Binds the target buttons to automatically enter the
 * loading state when clicked.
 *
 * @param target Either an HTML element or a CSS selector.
 * @param options
 *          - timeout Number of milliseconds to wait before
 *            automatically cancelling the animation.
 *          - callback A function to be called with the Ladda
 *            instance when a target button is clicked.
 */
function bind( target, options ) {

	var targets;

	if( typeof target === 'string' ) {
		targets = document.querySelectorAll( target );
	}
	else if( typeof target === 'object' ) {
		targets = [ target ];
	} else {
		throw new Error('target must be string or object');
	}

	options = options || {};

	for( var i = 0; i < targets.length; i++ ) {
		bindElement(targets[i], options);
	}

}

/**
 * Stops ALL current loading animations.
 */
function stopAll() {

	for( var i = 0, len = ALL_INSTANCES.length; i < len; i++ ) {
		ALL_INSTANCES[i].stop();
	}

}

/**
* Get the first ancestor node from an element, having a
* certain type.
*
* @param elem An HTML element
* @param type an HTML tag type (uppercased)
*
* @return An HTML element
*/
function getAncestorOfTagType( elem, type ) {

	while ( elem.parentNode && elem.tagName !== type ) {
		elem = elem.parentNode;
	}

	return ( type === elem.tagName ) ? elem : undefined;

}

function createSpinner( button ) {

	var height = button.offsetHeight,
		spinnerColor,
		spinnerLines;

	if( height === 0 ) {
		// We may have an element that is not visible so
		// we attempt to get the height in a different way
		height = parseFloat( window.getComputedStyle( button ).height );
	}

	// If the button is tall we can afford some padding
	if( height > 32 ) {
		height *= 0.8;
	}

	// Prefer an explicit height if one is defined
	if( button.hasAttribute( 'data-spinner-size' ) ) {
		height = parseInt( button.getAttribute( 'data-spinner-size' ), 10 );
	}

	// Allow buttons to specify the color of the spinner element
	if( button.hasAttribute( 'data-spinner-color' ) ) {
		spinnerColor = button.getAttribute( 'data-spinner-color' );
	}

	// Allow buttons to specify the number of lines of the spinner
	if( button.hasAttribute( 'data-spinner-lines' ) ) {
		spinnerLines = parseInt( button.getAttribute( 'data-spinner-lines' ), 10 );
	}

	var radius = height * 0.2,
		length = radius * 0.6,
		width = radius < 7 ? 2 : 3;

	return new spin_js__WEBPACK_IMPORTED_MODULE_0__["Spinner"]( {
		color: spinnerColor || '#fff',
		lines: spinnerLines || 12,
		radius: radius,
		length: length,
		width: width,
		animation: 'ladda-spinner-line-fade',
		zIndex: 'auto',
		top: 'auto',
		left: 'auto',
		className: ''
	} );

}

function wrapContent( node, wrapper ) {

	var r = document.createRange();
	r.selectNodeContents( node );
	r.surroundContents( wrapper );
	node.appendChild( wrapper );

}

function bindElement( element, options ) {
	if( typeof element.addEventListener !== 'function' ) {
		return;
	}

	var instance = create( element );
	var timeout = -1;

	element.addEventListener( 'click', function() {

		// If the button belongs to a form, make sure all the
		// fields in that form are filled out
		var valid = true;
		var form = getAncestorOfTagType( element, 'FORM' );

		if( typeof form !== 'undefined' && !form.hasAttribute('novalidate') ) {
			// Modern form validation
			if( typeof form.checkValidity === 'function' ) {
				valid = form.checkValidity();
			}
		}

		if( valid ) {
			// This is asynchronous to avoid an issue where disabling
			// the button prevents forms from submitting
			instance.startAfter( 1 );

			// Set a loading timeout if one is specified
			if( typeof options.timeout === 'number' ) {
				clearTimeout( timeout );
				timeout = setTimeout( instance.stop, options.timeout );
			}

			// Invoke callbacks
			if( typeof options.callback === 'function' ) {
				options.callback.apply( null, [ instance ] );
			}
		}

	}, false );

}


/***/ }),

/***/ "./node_modules/spin.js/spin.js":
/*!**************************************!*\
  !*** ./node_modules/spin.js/spin.js ***!
  \**************************************/
/*! exports provided: Spinner */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Spinner", function() { return Spinner; });
var __assign = (undefined && undefined.__assign) || Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
        s = arguments[i];
        for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
            t[p] = s[p];
    }
    return t;
};
var defaults = {
    lines: 12,
    length: 7,
    width: 5,
    radius: 10,
    scale: 1.0,
    corners: 1,
    color: '#000',
    fadeColor: 'transparent',
    animation: 'spinner-line-fade-default',
    rotate: 0,
    direction: 1,
    speed: 1,
    zIndex: 2e9,
    className: 'spinner',
    top: '50%',
    left: '50%',
    shadow: '0 0 1px transparent',
    position: 'absolute',
};
var Spinner = /** @class */ (function () {
    function Spinner(opts) {
        if (opts === void 0) { opts = {}; }
        this.opts = __assign({}, defaults, opts);
    }
    /**
     * Adds the spinner to the given target element. If this instance is already
     * spinning, it is automatically removed from its previous target by calling
     * stop() internally.
     */
    Spinner.prototype.spin = function (target) {
        this.stop();
        this.el = document.createElement('div');
        this.el.className = this.opts.className;
        this.el.setAttribute('role', 'progressbar');
        css(this.el, {
            position: this.opts.position,
            width: 0,
            zIndex: this.opts.zIndex,
            left: this.opts.left,
            top: this.opts.top,
            transform: "scale(" + this.opts.scale + ")",
        });
        if (target) {
            target.insertBefore(this.el, target.firstChild || null);
        }
        drawLines(this.el, this.opts);
        return this;
    };
    /**
     * Stops and removes the Spinner.
     * Stopped spinners may be reused by calling spin() again.
     */
    Spinner.prototype.stop = function () {
        if (this.el) {
            if (typeof requestAnimationFrame !== 'undefined') {
                cancelAnimationFrame(this.animateId);
            }
            else {
                clearTimeout(this.animateId);
            }
            if (this.el.parentNode) {
                this.el.parentNode.removeChild(this.el);
            }
            this.el = undefined;
        }
        return this;
    };
    return Spinner;
}());

/**
 * Sets multiple style properties at once.
 */
function css(el, props) {
    for (var prop in props) {
        el.style[prop] = props[prop];
    }
    return el;
}
/**
 * Returns the line color from the given string or array.
 */
function getColor(color, idx) {
    return typeof color == 'string' ? color : color[idx % color.length];
}
/**
 * Internal method that draws the individual lines.
 */
function drawLines(el, opts) {
    var borderRadius = (Math.round(opts.corners * opts.width * 500) / 1000) + 'px';
    var shadow = 'none';
    if (opts.shadow === true) {
        shadow = '0 2px 4px #000'; // default shadow
    }
    else if (typeof opts.shadow === 'string') {
        shadow = opts.shadow;
    }
    var shadows = parseBoxShadow(shadow);
    for (var i = 0; i < opts.lines; i++) {
        var degrees = ~~(360 / opts.lines * i + opts.rotate);
        var backgroundLine = css(document.createElement('div'), {
            position: 'absolute',
            top: -opts.width / 2 + "px",
            width: (opts.length + opts.width) + 'px',
            height: opts.width + 'px',
            background: getColor(opts.fadeColor, i),
            borderRadius: borderRadius,
            transformOrigin: 'left',
            transform: "rotate(" + degrees + "deg) translateX(" + opts.radius + "px)",
        });
        var delay = i * opts.direction / opts.lines / opts.speed;
        delay -= 1 / opts.speed; // so initial animation state will include trail
        var line = css(document.createElement('div'), {
            width: '100%',
            height: '100%',
            background: getColor(opts.color, i),
            borderRadius: borderRadius,
            boxShadow: normalizeShadow(shadows, degrees),
            animation: 1 / opts.speed + "s linear " + delay + "s infinite " + opts.animation,
        });
        backgroundLine.appendChild(line);
        el.appendChild(backgroundLine);
    }
}
function parseBoxShadow(boxShadow) {
    var regex = /^\s*([a-zA-Z]+\s+)?(-?\d+(\.\d+)?)([a-zA-Z]*)\s+(-?\d+(\.\d+)?)([a-zA-Z]*)(.*)$/;
    var shadows = [];
    for (var _i = 0, _a = boxShadow.split(','); _i < _a.length; _i++) {
        var shadow = _a[_i];
        var matches = shadow.match(regex);
        if (matches === null) {
            continue; // invalid syntax
        }
        var x = +matches[2];
        var y = +matches[5];
        var xUnits = matches[4];
        var yUnits = matches[7];
        if (x === 0 && !xUnits) {
            xUnits = yUnits;
        }
        if (y === 0 && !yUnits) {
            yUnits = xUnits;
        }
        if (xUnits !== yUnits) {
            continue; // units must match to use as coordinates
        }
        shadows.push({
            prefix: matches[1] || '',
            x: x,
            y: y,
            xUnits: xUnits,
            yUnits: yUnits,
            end: matches[8],
        });
    }
    return shadows;
}
/**
 * Modify box-shadow x/y offsets to counteract rotation
 */
function normalizeShadow(shadows, degrees) {
    var normalized = [];
    for (var _i = 0, shadows_1 = shadows; _i < shadows_1.length; _i++) {
        var shadow = shadows_1[_i];
        var xy = convertOffset(shadow.x, shadow.y, degrees);
        normalized.push(shadow.prefix + xy[0] + shadow.xUnits + ' ' + xy[1] + shadow.yUnits + shadow.end);
    }
    return normalized.join(', ');
}
function convertOffset(x, y, degrees) {
    var radians = degrees * Math.PI / 180;
    var sin = Math.sin(radians);
    var cos = Math.cos(radians);
    return [
        Math.round((x * cos + y * sin) * 1000) / 1000,
        Math.round((-x * sin + y * cos) * 1000) / 1000,
    ];
}


/***/ }),

/***/ "./resources/assets/js/TradeSubsystem/trade.js":
/*!*****************************************************!*\
  !*** ./resources/assets/js/TradeSubsystem/trade.js ***!
  \*****************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var ladda__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ladda */ "./node_modules/ladda/js/ladda.js");
$ = jQuery;

$.extend($.expr[':'], {
  'containsi': function containsi(elem, i, match, array) {
    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});
var currentRate;
var currentBuyAcronym;
var currentSellAcronym;
var currentType;
var currentMarket;
var currentSellLimit;
var currentBuyLimit;
var currentSellLimitLeft;
var currentBuyLimitLeft;
var currentBuyLimitPercent;
var currentSellLimitPercent;
var currentSymbol;
var currentPairId;
var currentLimitSymbol;
var quickBalance;
var quickChange;
ladda__WEBPACK_IMPORTED_MODULE_0__["bind"]('button[type=submit]');
$(document).ready(function () {
  recalculateLimits();
  postTradeOnSubmit();
  calculateNumbers();
  updateTradeView();
  openFileSelectOnUploadImageIconClick();
  changeMarketOnSelect();
  openLeverageOnAdvancedCheck();
  calculateTotal();
  changeTradeType();
  changeSourceType();
  showImageAfterSelect();
  filterPairs();
  toggleMarketSelect();
  tradeModalControls();
  tradeModalResize();
  setMarketViaCard();
  $('.trade-modal').on('open', function () {
    updateTradeView();
  });
  $.getJSON("/data/mention.json", function (data) {
    mentionData = data;
    $('textarea').mentionsInput({
      onDataRequest: function onDataRequest(mode, query, callback) {
        data = _.filter(mentionData, function (item) {
          return item.name ? item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 : false;
        });
        callback.call(this, data);
      }
    });
  });
  $(".alert-dismissible").fadeTo(2000, 500).slideUp(500, function () {
    $(".alert-dismissible").alert('close');
  });
  $('#leverage-select').select2({
    minimumResultsForSearch: -1,
    closeOnSelect: true,
    width: '100%',
    containerCssClass: 'select-2-lg',
    placeholder: "None"
  });
});

function tradeModalControls() {
  $('.shade,.main-navbar-shade,#close-trade').on('click', function (e) {
    e.preventDefault();
    dismissNewTrade();
  });

  if (window.location.hash) {
    var hash = window.location.hash.substring(1);

    if (hash == 'trade') {
      $('.trade-modal').addClass('open');
      $('body').addClass('shade-active');
      if ("replaceState" in history) history.replaceState(null, null, ' ');
    }
  }
}

function dismissNewTrade() {
  $('.trade-modal').removeClass('open');
  $('body').removeClass('shade-active shade-active modal-open'); //$("html, body").animate({ scrollTop: 0 }, 0);

  var scrollY = document.body.style.top;
  document.body.style.position = '';
  document.body.style.top = '';
  document.body.style.bottom = '';
  document.body.style.right = '';
  document.body.style.left = '';
  window.scrollTo(0, parseInt(scrollY || '0') * -1);
}

function setMarketViaCard() {
  $('.card-widget').on('click', function (e) {
    e.preventDefault();
    $('input[data-trade-pair-id="' + $(this).data('pair-id') + '"]').attr('checked', true).trigger('change');
    $('.trade-modal').addClass('open');
    $('body').addClass('shade-active');
  });
}

function tradeModalResize() {
  new ResizeSensor($('.trade-modal'), function () {
    var windowHeight = $(window).outerHeight();
    var modalHeight = $('.trade-modal').outerHeight();
    if (modalHeight >= windowHeight || windowHeight - modalHeight < 2) $('.trade-modal').addClass('no-radius');else $('.trade-modal').removeClass('no-radius');
  });
}

function toggleMarketSelect() {
  $('.market-select').on('click', function (e) {
    e.preventDefault();

    if ($('#make-trade').hasClass('d-none')) {
      $('#make-trade').removeClass('d-none');
      $('#change-market').addClass('d-none');
    } else {
      $('#make-trade').addClass('d-none');
      $('#change-market').removeClass('d-none');
    }
  });
}

function filterPairs() {
  $('#filterPairs').keyup(function () {
    var query = $(this).val();
    $(".col-market").hide().filter(':containsi("' + query + '")').show();
  });
  $('#clearfilterPairs').on('click', function () {
    $('#filterPairs').val('').trigger('keyup');
  });
}

function recalculateLimits() {
  window.Echo.channel('price-updated').listen('CurrencyUpdated', function (e) {
    $('a[data-pair-id="' + e.pairId + '"]').each(function () {
      $(this).attr('data-rate', e.price.replace(',', ''));

      if ($('span.current-price .buy-acronym').text().trim().indexOf($(this).attr('data-buy-acronym')) > -1 && $('.sell-acronym').text().trim().indexOf($(this).attr('data-sell-acronym')) > -1) {
        $('.rate').html($(this).attr('data-rate'));
        updateTradeView();
      }
    });
  });
}

function updateTradeView() {
  $('#limit-amount-tooltip').attr('data-original-title', 'Amount of ' + currentBuyAcronym + ' to ' + currentType);
  if (parseFloat(quickChange) > 0) $('#quick-pct-change span').addClass('pct-up').removeClass('pct-down');else if (parseFloat(quickChange) < 0) $('#quick-pct-change span').addClass('pct-down').removeClass('pct-up');else $('#quick-pct-change span').removeClass('pct-up pct-down');
  $('#quick-pct-change span').html(parseFloat(quickChange).toFixed(2) + '%');

  if (currentType == 'buy') {
    $('.action-limit').html(currentBuyLimit);
    $('.left-limit').html(currentBuyLimitLeft);
    $('.current-limit-left-symbol').html(currentLimitSymbol);
    $('#limit-progress').attr('style', 'width: ' + currentBuyLimitPercent + '%');
    $('#limit-progress').attr('aria-valuenow', currentBuyLimitPercent);
    $('#market-tooltip').attr('data-original-title', 'Amount of ' + currentSellAcronym + '</span> to be spent to buy ' + currentBuyAcronym + ' at market price');
    $('#limit-price-tooltip').attr('data-original-title', 'Buy at fixed price per ' + currentBuyAcronym);
    $('.market-field-label').html('Total');
    $('#market-field-acronym').attr('src', '/assets/images/crypto-icons/color/' + currentSellAcronym.toLowerCase() + '.svg');
    $('.quick-view-acronym').attr('src', '/assets/images/crypto-icons/color/' + currentSellAcronym.toLowerCase() + '.svg');
    quickBalance = $('[data-balance="' + currentSellAcronym + '"]').data('amount');
    if (!quickBalance) quickBalance = '0.00';
    $('#quick-portfolio-view').html(quickBalance);
    quickChange = $('#quick-pairs .col-card-' + currentBuyAcronym + currentSellAcronym).data('change');
    $('#calculations .sell-acronym-img').attr('src', '/assets/images/crypto-icons/color/' + currentBuyAcronym.toLowerCase() + '.svg');
    $('.currentField').html('Total');
    $('#below_limit').html('SL');
    $('#above_limit').html('TP');
    $('#below_limit_tooltip').attr('data-original-title', 'Enter the ' + currentBuyAcronym + ' price in USD at which your order will close to prevent further losses. Please ensure that price is lower than the limit or market price.');
    $('#above_limit_tooltip').attr('data-original-title', 'Enter the ' + currentBuyAcronym + ' price in USD at which your order will close at to take profit. Please ensure that price is higher than the limit or market price.');
  } else {
    $('.action-limit').html(currentSellLimit);
    $('.left-limit').html(currentSellLimitLeft);
    $('.current-limit-left-symbol').html(currentLimitSymbol);
    $('#limit-progress').attr('style', 'width: ' + currentSellLimitPercent + '%');
    $('#limit-progress').attr('aria-valuenow', currentSellLimitPercent);
    $('#market-tooltip').attr('data-original-title', 'Amount of ' + currentBuyAcronym + '</span> to be sold at market price');
    $('#limit-price-tooltip').attr('data-original-title', 'Sell at fixed price per ' + currentBuyAcronym);
    $('.market-field-label').html('Amount:');
    $('#market-field-acronym').attr('src', '/assets/images/crypto-icons/color/' + currentBuyAcronym.toLowerCase() + '.svg');
    $('.quick-view-acronym').attr('src', '/assets/images/crypto-icons/color/' + currentBuyAcronym.toLowerCase() + '.svg');
    quickBalance = $('[data-balance="' + currentBuyAcronym + '"]').data('amount');
    if (!quickBalance) quickBalance = '0.00';
    $('#quick-portfolio-view').html(quickBalance);
    quickChange = $('#quick-pairs .col-card-' + currentBuyAcronym + currentSellAcronym).data('change');
    $('#calculations .sell-acronym-img').attr('src', '/assets/images/crypto-icons/color/' + currentSellAcronym.toLowerCase() + '.svg');
    ;
    $('.currentField').html('Total');
    $('#below_limit').html('TP');
    $('#above_limit').html('SL');
    $('#below_limit_tooltip').attr('data-original-title', 'Enter the ' + currentBuyAcronym + ' price in USD at which your order will close at to take profit. Please ensure that price is higher than the limit or market price.');
    $('#above_limit_tooltip').attr('data-original-title', 'Enter the ' + currentBuyAcronym + ' price in USD at which your order will close to prevent further losses. Please ensure that price is lower than the limit or market price.');
  }

  if (currentMarket == 'off') {
    $('.group-limit').removeClass('d-none');
    $('.group-market').addClass('d-none');
    $('#calculations .sell-acronym-img').attr('src', '/assets/images/crypto-icons/color/' + currentSellAcronym.toLowerCase() + '.svg');
    $('.currentField').html('Total');
  } else {
    $('.group-limit').addClass('d-none');
    $('.group-market').removeClass('d-none');

    if (currentType == 'buy') {
      $('#calculations .sell-acronym-img').attr('src', '/assets/images/crypto-icons/color/' + currentBuyAcronym.toLowerCase() + '.svg');
      ;
      $('.currentField').html('Amount');
    }
  }

  $('.trade-type').html(currentType);
  calculateTotal();
}

function calculateTotal() {
  var market = $('#post-trade-form input[name="market"]:checked').val();
  var amount = $('#post-trade-form input[name="amount"]').val();
  var price = $('#post-trade-form input[name="price"]').val();
  var total = $('#post-trade-form input[name="total"]').val();
  var market_rate = parseFloat($('#market-rate').html().replace(',', ''));

  if (market == 'off') {
    if (amount && price) var est_total = (amount * price).toFixed(2);else var est_total = 0;
    calculateFee(est_total, $('input[name="trade_pair_id"]').val());
  } else {
    if (currentType == 'buy') {
      var est_total = (total / market_rate).toFixed(4);
      calculateFee(total, $('input[name="trade_pair_id"]').val());
    } else {
      var est_total = (total * market_rate).toFixed(4);
      calculateFee(est_total, $('input[name="trade_pair_id"]').val());
    }
  }

  $('.estimated-total').val(est_total);
}

function calculateFee(amount, tradePairId) {
  var market = $('#post-trade-form input[name="market"]:checked').val();
  var leverage = $('#leverage-select').val();
  var market_rate = parseFloat($('#market-rate').html().replace(',', ''));
  var action = $('input[name="type"]:checked').val();
  var type = 'market';

  if (market == 'off') {
    type = 'limit';
  }

  axios({
    method: 'post',
    url: '/api/price-in-usd',
    responseType: 'json',
    data: {
      amount: amount,
      trade_pair_id: tradePairId,
      trade_type: type,
      market_rate: market_rate,
      leverage: leverage,
      action: action
    }
  }).then(function (response) {
    var fee = response.data.symbol + response.data.fee.toFixed(response.data.precision);
    $('#fee-calculated').html(fee); //var currentTotal = parseFloat($('.estimated-total').val());
    //currentTotal -= response.data.fee;
    //if(currentTotal < 0) currentTotal = 0;
    //$('.estimated-total').val(currentTotal.toFixed(response.data.precision));
  });
}

function calculateNumbers() {
  $('.numbers-input').keyup(function () {
    var val = $(this).val();

    if (isNaN(val)) {
      val = val.replace(/[^0-9\.]/g, '');
      if (val.split('.').length > 2) val = val.replace(/\.+$/, "");
    }

    $(this).val(val);
  }).on('paste', function (event) {
    $(this).keyup();
  });
  $("#customFile").change(function () {
    readURL(this);
  });
  currentBuyAcronym = $('#current-pair-span .buy-acronym').text();
  currentSellAcronym = $('#current-pair-span .sell-acronym').text();
  currentType = $('input[name="type"]:checked').val();
  currentMarket = $('input[name="market"]:checked').val();
  currentSellLimit = $('#select-market .portfolio-buttons label.active input').attr('data-sell-volume-limit');
  currentBuyLimit = $('#select-market .portfolio-buttons label.active input').attr('data-buy-volume-limit');
  currentSellLimitLeft = $('#select-market .portfolio-buttons label.active input').attr('data-sell-limit-left');
  currentBuyLimitLeft = $('#select-market .portfolio-buttons label.active input').attr('data-buy-limit-left');
  currentLimitSymbol = $('#select-market .portfolio-buttons label.active input').attr('data-limit-symbol');
  currentBuyLimitPercent = $('#select-market .portfolio-buttons label.active input').attr('data-buy-limit-percent');
  currentSellLimitPercent = $('#select-market .portfolio-buttons label.active input').attr('data-sell-limit-percent');
  currentSymbol = $('#select-market .portfolio-buttons label.active input').attr('data-symbol');
  $('input[name="amount"],input[name="price"],input[name="total"]').on('keyup', function () {
    calculateTotal();
    $('.limit-exceeded-warning').hide();
    var data = $('#tradeForm').serializeArray().reduce(function (obj, item) {
      obj[item.name] = item.value;
      return obj;
    }, {});
    limitExceeded();
  });
}

function limitExceeded() {
  var form = $('#post-trade-form')[0];
  var data = new FormData(form);
  $.ajax({
    url: '/app/trade/limit',
    dataType: 'text',
    type: 'post',
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    success: function success(data, textStatus, jQxhr) {
      var parsedData = JSON.parse(data);

      if (parsedData.success != true) {
        $('.limit-exceeded-warning').show();
      }
    }
  });
}

function postTradeOnSubmit() {
  $('#post-trade').on('click', function (e) {
    e.preventDefault();
    var fileRemoved = false;
    $('#messages-col-trade').html('');
    $('#post-trade-form').find("input[type='file']").each(function () {
      if ($(this).get(0).files.length === 0) {
        $(this).remove();
        fileRemoved = true;
      }
    });
    var form = $('#post-trade-form')[0];
    var data = new FormData(form);
    var laddaButton = ladda__WEBPACK_IMPORTED_MODULE_0__["create"]($(this)[0]);
    laddaButton.toggle();
    $.ajax({
      url: $(form).attr('action'),
      dataType: 'text',
      type: 'post',
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      success: function success(data, textStatus, jQxhr) {
        if (fileRemoved) {
          $('#analysis-field-wrapper').prepend('<input id="analysis-field" style="position: absolute; top: -999px;" type="file" name="analysis" class="form-control"/>');
        }

        laddaButton.stop();
        var parsedData = JSON.parse(data);

        if (parsedData.success == true) {
          $('#messages-col').html("\n                      \n                        <div class=\"toast-block\">\n                         \n                          <div class=\"toast success\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\">\n                          \n                            <div class=\"toast-body\"> \n                            \n                            <div class=\"text-white\">\n                                <i class=\"fa fa-check-circle mr-1\"></i> \n                                ".concat(parsedData.message, "\n                            </div>\n \n                            <button type=\"button\" class=\"ml-2 mb-1 close\" data-dismiss=\"toast\" aria-label=\"Close\">\n                                <span class=\"iconify\" data-icon=\"ant-design:close-circle-outlined\" data-inline=\"false\"></span>\n                              </button>\n\n                            </div>\n                          </div>\n                          \n                        </div>\n\n                    "));
          $('.toast.success').toast({
            'delay': 5000,
            'autohide': true
          });
          $('.toast.success').toast('show');
          dismissNewTrade(); //$('#post-trade-form')[0].reset();

          $('input[name="total"], textarea[name="description"], input[name="above_limit"], input[name="below_limit"], input[name="amount"]').val('');
          $('#leverage-select').val('0').trigger('change');
          $('.link-meta-info').html('').removeClass('image-preview video-preview tradingview-preview link-meta-preview');
          $('input[name="link"]').val("");
          $('input[name="source_type"]').val("");
          $('#analysis-field-wrapper').hide();
          $("html, body").animate({
            scrollTop: 0
          }, "slow");
          axios({
            method: 'get',
            url: '/app/current-portfolio-html',
            responseType: 'json'
          }).then(function (response) {
            //TBA
            $('#portfolio-card-wrapper').html(response.data.html);
          });
        } else {
          var errorHtml = '';
          $.each(parsedData.errors, function (key, value) {
            errorHtml += "<div class=\"text-danger\">\n                                <i class=\"fa fa-exclamation-circle mr-1\"></i> \n                                ".concat(value, "\n                            </div>\n                        ");
          });
          $('#messages-col-trade').html("\n\n                        <div style=\"position: fixed;bottom: 2rem;right: 2rem;z-index: 99999;\">\n                         \n                          <div class=\"toast\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\">\n                          \n                            <div class=\"toast-body\"> \n                            \n                             ".concat(errorHtml, "\n \n                            <button type=\"button\" class=\"ml-2 mb-1 close\" data-dismiss=\"toast\" aria-label=\"Close\">\n                                <span class=\"iconify\" data-icon=\"ant-design:close-circle-outlined\" data-inline=\"false\"></span>\n                              </button>\n\n                            </div>\n                          </div>\n                          \n                        </div>\n\n                    "));
          $('.toast').toast({
            'delay': 5000,
            'autohide': false
          });
          $('.toast').toast('show');
        }
      },
      error: function error(jqXhr, textStatus, errorThrown) {
        if (fileRemoved) {
          $('#analysis-field-wrapper').prepend('<input id="analysis-field" style="position: absolute; top: -999px;" type="file" name="analysis" class="form-control"/>');
        }

        console.log(errorThrown);
      }
    });
  });
}

function openFileSelectOnUploadImageIconClick() {
  $('body').on('click', '#upload-image-analysis-button', function (e) {
    e.preventDefault();
    $('#analysis-field').focus().trigger('click');
  });
}

function changeMarketOnSelect() {
  $('.portfolio-buttons input[name="market"]').on('change', function () {
    var optionSelected = $(this);
    axios({
      method: 'post',
      url: '/app/save-pair/' + optionSelected.attr('data-trade-pair-id'),
      responseType: 'json'
    }).then(function (response) {});
    currentRate = optionSelected.attr('data-rate');
    currentBuyAcronym = optionSelected.attr('data-buy-acronym');
    currentSellAcronym = optionSelected.attr('data-sell-acronym');
    currentSellLimit = optionSelected.attr('data-sell-volume-limit');
    currentBuyLimit = optionSelected.attr('data-buy-volume-limit');
    currentSellLimitLeft = optionSelected.attr('data-sell-limit-left');
    currentBuyLimitLeft = optionSelected.attr('data-buy-limit-left');
    currentLimitSymbol = optionSelected.attr('data-limit-symbol');
    currentSellLimitPercent = optionSelected.attr('data-sell-limit-percent');
    currentBuyLimitPercent = optionSelected.attr('data-buy-limit-percent');
    currentSymbol = optionSelected.attr('data-symbol');
    currentPairId = optionSelected.attr('data-trade-pair-id');
    $('.btn-market').removeClass('active');
    $(this).closest('.btn-market').addClass('active');
    $('#market-rate').removeClass().addClass('pair-price-' + currentBuyAcronym + currentSellAcronym).html(numberWithCommas(currentRate));
    $('#quick-pct-change span').removeClass().addClass('pair-pct-' + currentBuyAcronym + currentSellAcronym).html(numberWithCommas(currentRate));
    $('#market-rate-symbol').html(currentSymbol);
    $('.buy-acronym').html(currentBuyAcronym);
    $('.sell-acronym').html(currentSellAcronym);
    $('.buy-acronym-img').attr('src', '/assets/images/crypto-icons/color/' + currentBuyAcronym.toLowerCase() + '.svg');
    ;
    $('.sell-acronym-img').attr('src', '/assets/images/crypto-icons/color/' + currentSellAcronym.toLowerCase() + '.svg');
    ;
    $('.current-limit-left-symbol').html(currentLimitSymbol);
    $('.symbol').html(optionSelected.attr('data-symbol'));
    $('.rate').html(optionSelected.attr('data-rate'));
    $('input[name="price"]').val(optionSelected.attr('data-rate'));
    $('input[name="trade_pair_id"]').val(currentPairId);
    updateTradeView();
    $('#make-trade').trigger('marketSelected');
    $('#make-trade').removeClass('d-none');
    $('#change-market').addClass('d-none');
    calculateTotal();
  });
  $('input[name="market"]').on('change', function () {
    currentMarket = $(this).val();
    updateTradeView();
  });
}

function numberWithCommas(x) {
  var parts = x.toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return parts.join(".");
}

function openLeverageOnAdvancedCheck() {
  $("#advanceToggle:checkbox").bind('click dblclick', function (evt) {
    if ($(this).is(":checked")) {
      $('#advanced-options').show();
    } else {
      $('#advanced-options').hide();
    }
  });
}

function changeTradeType() {
  $('#stopType').on('click', function () {
    currentMarket = 'off';
    $('input[name="stop"]').val('on');
    updateTradeView();
  });
  $('#limitType').on('click', function () {
    currentMarket = 'off';
    $('input[name="stop"]').val('off');
    updateTradeView();
  });
  $('#marketType').on('click', function () {
    currentMarket = 'on';
    $('input[name="stop"]').val('off');
    updateTradeView();
  });
  $('input[name="type"]').on('change', function () {
    currentType = $(this).val();
    updateTradeView();
  });
}

function changeSourceType() {
  $('input[name="source_type"]').on('change', function () {
    switch ($(this).val()) {
      case 'link':
        $('#public-link').collapse('show');
        $('#public-tradingview').collapse('hide');
        $('#public-youtube').collapse('hide');
        $('#public-image').collapse('hide');
        break;

      case 'image':
        $('#public-link').collapse('hide');
        $('#public-tradingview').collapse('hide');
        $('#public-youtube').collapse('hide');
        $('#public-image').collapse('show');
        break;

      case 'trading_view':
        $('#public-link').collapse('hide');
        $('#public-image').collapse('hide');
        $('#public-youtube').collapse('hide');
        $('#public-tradingview').collapse('show');
        break;

      case 'video':
        $('#public-link').collapse('hide');
        $('#public-image').collapse('hide');
        $('#public-tradingview').collapse('hide');
        $('#public-youtube').collapse('show');
        break;

      default:
        break;
    }
  });
}

function showImageAfterSelect() {
  $("body").on("change", "#analysis-field", function () {
    readURL(this);
  });
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('.link-meta-info').removeClass('image-preview video-preview tradingview-preview link-meta-preview');
      $('.link-meta-info').html('<div class="trade-img-preview" style="background-image:url(' + e.target.result + ');"></div>');
      $('.link-meta-info').addClass('image-preview').show();
      $('#analysis-field-wrapper').show();

      if ($('input[name="source_type"]').length > 0) {
        $('input[name="source_type"]').val('image');
      } else {
        $('#post-trade-form input[name="_token"]').after('<input type="hidden" name="source_type" value="image">');
      }
    };

    reader.readAsDataURL(input.files[0]);
  }
}

/***/ }),

/***/ 1:
/*!***********************************************************!*\
  !*** multi ./resources/assets/js/TradeSubsystem/trade.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/forge/dev.cryptoparrot.com/resources/assets/js/TradeSubsystem/trade.js */"./resources/assets/js/TradeSubsystem/trade.js");


/***/ })

/******/ });