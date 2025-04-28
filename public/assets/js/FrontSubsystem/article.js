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
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/FrontSubsystem/article.js":
/*!*******************************************************!*\
  !*** ./resources/assets/js/FrontSubsystem/article.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$ = jQuery;
var likingArticle = false;
$(document).ready(function () {
  wdtEmojiBundle.init('textarea');
  $('.comment-text').each(function () {
    var text = $(this).html();
    var output = wdtEmojiBundle.render(text);
    $(this).html(output);
  });
  voteForComments();
  postComment();
  replyComment();
  loadMoreComments();
  showAllReplies();
});

function loadMoreComments() {
  $('body').on('click', '.load-more-comments', function () {
    var button = $(this);
    var page = parseInt(button.attr('data-page'));
    var articleId = button.attr('data-article-id');
    button.attr('data-page', page + 1);
    axios({
      method: 'get',
      url: '/load-more/article-comments/' + articleId + '/page/' + page,
      responseType: 'json'
    }).then(function (response) {
      if (response.data.success) {
        $('#comments-' + articleId + '-wrapper').append(response.data.html);

        if (!response.data.hasMore) {
          $('.load-more-comments[data-article-id="' + articleId + '"]').hide();
        }

        wdtEmojiBundle.init('textarea');

        if (mentionData === null) {
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
        } else {
          $('textarea').mentionsInput({
            onDataRequest: function onDataRequest(mode, query, callback) {
              data = _.filter(mentionData, function (item) {
                return item.name ? item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 : false;
              });
              callback.call(this, data);
            }
          });
        }

        $('.comment-text').each(function () {
          var text = $(this).html();
          var output = wdtEmojiBundle.render(text);
          $(this).html(output);
        });
      } else {
        button.hide();
        $(button).removeClass('d-block');
      }
    });
  });
}

function showAllReplies() {
  $('body').on('click', '.load-all-replies', function () {
    var button = $(this);
    $(button).hide();
    $(button).removeClass('d-block');
    var commentId = button.attr('data-comment-id');
    axios({
      method: 'get',
      url: '/load-more/article-comment-replies/' + commentId,
      responseType: 'json'
    }).then(function (response) {
      if (response.data.success) {
        $('#replies-' + commentId + '-wrapper').html(response.data.html);
        $('.comment-text').each(function () {
          var text = $(this).html();
          var output = wdtEmojiBundle.render(text);
          $(this).html(output);
        });
      }

      button.hide();
      $(button).removeClass('d-block');
    });
  });
}

function showCommentsOnClick() {
  $('body').on('click', '.show-comments-button', function (e) {
    e.preventDefault();
    var articleId = $(this).attr('data-id');
    $('#comments-' + articleId).show();
    $('.articleCommentForm[data-article-id=' + articleId + ']').show();
    $('.articleCommentForm[data-article-id=' + articleId + '] textarea').focus();
  });
}

function voteForComments() {
  $('body').on('click', '.voteUpComment', function () {
    if (likingArticle == true) return;
    likingArticle = true;
    var userId = $(this).attr('data-user-id');
    var commentId = $(this).attr('data-comment-id');
    var currentVotes = $(this).attr('data-current-votes');
    currentVotes++;
    $('.votes-comments-' + commentId).html(currentVotes);
    $(this).attr('data-current-votes', currentVotes);
    $(this).addClass('voteDownComment').removeClass('voteUpComment');
    $(this).find('i').removeClass('far').addClass('fas');
    axios({
      method: 'get',
      url: '/app/vote-up/article-comment/' + userId + '/' + commentId,
      responseType: 'json'
    }).then(function (response) {
      likingArticle = false;
    })["catch"](function (error) {
      likingArticle = false;
    });
  });
  $('body').on('click', '.voteDownComment', function () {
    if (likingArticle == true) return;
    likingArticle = true;
    var userId = $(this).attr('data-user-id');
    var commentId = $(this).attr('data-comment-id');
    var currentVotes = $(this).attr('data-current-votes');
    currentVotes--;
    $('.votes-comments-' + commentId).html(currentVotes);
    $(this).attr('data-current-votes', currentVotes);
    $(this).addClass('voteUpComment').removeClass('voteDownComment');
    $(this).find('i').removeClass('fas').addClass('far');
    axios({
      method: 'get',
      url: '/app/vote-down/article-comment/' + userId + '/' + commentId,
      responseType: 'json'
    }).then(function (response) {
      likingArticle = false;
    })["catch"](function (error) {
      likingArticle = false;
    });
  });
}

function replyComment() {
  $('body').on('click', '.comment-reply', function (e) {
    e.preventDefault();

    if (myAvatar === null) {
      $('html, body').animate({
        scrollTop: $('#login-to-comment').offset().top - 20
      }, 'slow');
      return;
    }

    var targetId = $(this).attr('data-id');
    $('form[data-reply-id="' + targetId + '"]').show();
    $('form[data-reply-id="' + targetId + '"] textarea').focus();
  });
}

var sendingComment = false;

function postComment() {
  $('body').on('keyup', '.articleCommentForm textarea', function (e) {
    if (e.which == 13) {
      $(this).parents('form').submit();
      return false; //<---- Add this line
    }
  });
  $('body').on('submit', '.articleCommentForm', function (e) {
    e.preventDefault();
    if (sendingComment) return;
    sendingComment = true;
    $('#comment-post-error').html('');
    var type = $(this)[0].hasAttribute('data-reply-id') ? 'reply' : 'article';
    var id = type === 'reply' ? $(this).attr('data-reply-id') : $(this).attr('data-article-id');
    var query = type === 'reply' ? 'replies-' + id + '-wrapper' : 'comments-' + id;
    var comment = $(this).find('textarea[name="comment"]').val();

    if (type == 'reply') {
      $('#' + query).append('<div class="comment newly-added-comment"><div class="mb-3"><div class="comment-container comment-container-parent"><div class="comment-avatar d-none d-sm-block"><img style="width: 30px;" class="user-avatar rounded-circle mr-2 mb-2" src="' + myAvatar + '" alt="User Avatar"></div><div class="comment-box p-3 mb-1"><a href="/' + myHandle + '"><img class="d-inline-block d-sm-none user-avatar-sm rounded-circle mr-1" src="' + myAvatar + '" alt="User Avatar"> <strong>' + myUsername + '</strong></a>  <span class="comment-text">' + comment + '</span><div class="comment-meta text-muted mt-2"><span>0</span><span class="px-2">1 second ago</span></div></div></div></div></div>');
    } else {
      $('#' + query).prepend('<div class="comment newly-added-comment"><div class="mb-3"><div class="comment-container comment-container-parent"><div class="comment-avatar d-none d-sm-block"><img style="width: 30px;" class="user-avatar rounded-circle mr-2 mb-2" src="' + myAvatar + '" alt="User Avatar"></div><div class="comment-box p-3 mb-1"><a href="/' + myHandle + '"><img class="d-inline-block d-sm-none user-avatar-sm rounded-circle mr-1" src="' + myAvatar + '" alt="User Avatar"> <strong>' + myUsername + '</strong></a>  <span class="comment-text">' + comment + '</span><div class="comment-meta text-muted mt-2"><span>0</span><span class="px-2">1 second ago</span></div></div></div></div></div>');
    }

    $('#' + query).show();
    axios({
      method: $(this).attr('method'),
      url: $(this).attr('action'),
      responseType: 'json',
      data: $(this).serialize()
    }).then(function (response) {
      if (response.data.success === true) {
        $('.newly-added-comment').addClass('action-success');
        $('textarea').val('');
        wdtEmojiBundle.init('textarea');
        $('.comment-text').each(function () {
          var text = $(this).html();
          var output = wdtEmojiBundle.render(text);
          $(this).html(output);
        });
        voteForComments();
      } else {
        $('.newly-added-comment').addClass('action-failed');
        $('#comment-post-error').html(response.data.message);
      }

      sendingComment = false;
    })["catch"](function (error) {
      sendingComment = false;
    });
  });
}

/***/ }),

/***/ 8:
/*!*************************************************************!*\
  !*** multi ./resources/assets/js/FrontSubsystem/article.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/forge/dev.cryptoparrot.com/resources/assets/js/FrontSubsystem/article.js */"./resources/assets/js/FrontSubsystem/article.js");


/***/ })

/******/ });