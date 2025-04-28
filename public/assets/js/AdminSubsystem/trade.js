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
/******/ 	return __webpack_require__(__webpack_require__.s = 12);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/AdminSubsystem/trade.js":
/*!*****************************************************!*\
  !*** ./resources/assets/js/AdminSubsystem/trade.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$ = jQuery;
$(document).ready(function () {
  console.log("X");
  showImageAfterSelect();
  openFileSelectOnUploadImageIconClick();
  initSourceMetadataOnFocusOut();
});

function openFileSelectOnUploadImageIconClick() {
  $('#upload-image-analysis-button').click(function () {
    $('#analysis-field').focus().trigger('click');
  });
}

function showImageAfterSelect() {
  $("#analysis-field").change(function () {
    readURL(this);
  });
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('.link-meta-info').html('<img src="' + e.target.result + '"/>');
      $('.link-meta-info').show();
      $('#analysis-field-wrapper').show();

      if ($('input[name="source_type"]').length > 0) {
        $('input[name="source_type"]').val('image');
      } else {
        $('textarea[name="description"]').after('<input name="source_type" value="image">');
      }
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function fetchMetadata() {
  $('.link-meta-info').show();
  var field = $('textarea[name="description"]');
  axios({
    method: 'post',
    url: '/source-metadata/',
    data: {
      description: $(field).val()
    },
    responseType: 'json'
  }).then(function (response) {
    console.log(response);

    if (response.data.success) {
      $('#analysis-field-wrapper').removeClass('active').hide();

      if (response.data.type == 'link') {
        if ($('input[name="source_type"]').length > 0) {
          $('input[name="source_type"]').val('link');
        } else {
          $('textarea[name="description"]').after('<input name="source_type" value="link">');
        }

        if (response.data.meta_title !== null) {
          var desc = response.data.meta_description;
          var html = '<a href="' + response.data.link + '" target="_blank" rel="nofollow" class="link-thumbnail"><img src="' + response.data.og_image + '" class="" alt=""/></a><h6 class="mb-1">' + response.data.meta_title + '</h6><small>' + desc + '</small>';
        } else {
          var desc = '';
          var html = '';
        }
      } else if (response.data.type == 'video') {
        var html = response.data.iframe;

        if ($('input[name="source_type"]').length > 0) {
          $('input[name="source_type"]').val('video');
        } else {
          $('textarea[name="description"]').after('<input name="source_type" value="video">');
        }
      } else {
        var html = response.data.html;

        if ($('input[name="source_type"]').length > 0) {
          $('input[name="source_type"]').val('trading_view');
        } else {
          $('textarea[name="description"]').after('<input name="source_type" value="trading_view">');
        }
      }

      $('.link-meta-info').removeClass('failed empty').addClass('loaded').html(html); //initTradingView();
    } else {
      $('.link-meta-info').html('');
      $('input[name="link"]').val("");
      $('input[name="source_type"]').val("");

      if (!sourceLink) {
        $('.link-meta-info').addClass('empty').removeClass('failed loaded').html('');
      } else {
        $('.link-meta-info').removeClass('empty loaded').addClass('failed').html('<i class="fal fa-exclamation-triangle text-danger"></i> Failed to read this link:<small>' + sourceLink + '</small>');
      }
    }

    var value = $(field).val();
    $(field).focus().val("").val(value);
  })["catch"](function (error) {
    console.log(error);
    $('.link-meta-info').addClass('empty').removeClass('failed loaded').html('');
  });
}

function findUrls(text) {
  var source = (text || '').toString();
  var urlArray = [];
  var url;
  var matchArray; // Regular expression to find FTP, HTTP(S) and email URLs.

  var regexToken = /(((ftp|https?):\/\/)[\-\w@:%_\+.~#?,&\/\/=]+)|((mailto:)?[_.\w-]+@([\w][\w\-]+\.)+[a-zA-Z]{2,3})/g; // Iterate through any URLs in the text.

  while ((matchArray = regexToken.exec(source)) !== null) {
    var token = matchArray[0];
    urlArray.push(token);
  }

  return urlArray;
}

function initSourceMetadataOnFocusOut() {
  $('#delete-analysis-image').click(function () {
    $('#analysis-field').val('');
    $('.link-meta-info').addClass('empty').removeClass('failed loaded').html('');
    $('#analysis-field-wrapper').removeClass('active').hide();
    fetchMetadata();
  });
  var firstUrl = null;
  $('textarea[name="description"]').on('keyup', function (e) {
    if ($('#analysis-field').val().length == 0) {
      if (e.keyCode == 32 || e.keyCode == 8) {
        var value = $('textarea[name="description"]').val();
        var urls = findUrls(value);

        if (urls.length > 0) {
          if (firstUrl === null || firstUrl !== urls[0]) {
            firstUrl = urls[0];
            setTimeout(fetchMetadata, 1000);
          }
        } else {
          if (firstUrl !== null) {
            setTimeout(fetchMetadata, 1000);
          }
        }
      }
    }
  });
  $('textarea[name="description"]').bind('paste', function (e) {
    if ($('#analysis-field').val().length == 0) {
      var value = $('textarea[name="description"]').val();
      value += e.originalEvent.clipboardData.getData('Text');
      var urls = findUrls(value);

      if (urls.length > 0) {
        if (firstUrl === null || firstUrl !== urls[0]) {
          firstUrl = urls[0];
          setTimeout(fetchMetadata, 1000);
        }
      }
    }
  });
}

/***/ }),

/***/ 12:
/*!***********************************************************!*\
  !*** multi ./resources/assets/js/AdminSubsystem/trade.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/forge/dev.cryptoparrot.com/resources/assets/js/AdminSubsystem/trade.js */"./resources/assets/js/AdminSubsystem/trade.js");


/***/ })

/******/ });