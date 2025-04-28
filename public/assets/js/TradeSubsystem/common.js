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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@emotion/cache/dist/cache.browser.esm.js":
/*!***************************************************************!*\
  !*** ./node_modules/@emotion/cache/dist/cache.browser.esm.js ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _emotion_sheet__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @emotion/sheet */ "./node_modules/@emotion/sheet/dist/sheet.browser.esm.js");
/* harmony import */ var _emotion_stylis__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @emotion/stylis */ "./node_modules/@emotion/stylis/dist/stylis.browser.esm.js");
/* harmony import */ var _emotion_weak_memoize__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @emotion/weak-memoize */ "./node_modules/@emotion/weak-memoize/dist/weak-memoize.browser.esm.js");




// https://github.com/thysultan/stylis.js/tree/master/plugins/rule-sheet
// inlined to avoid umd wrapper and peerDep warnings/installing stylis
// since we use stylis after closure compiler
var delimiter = '/*|*/';
var needle = delimiter + '}';

function toSheet(block) {
  if (block) {
    Sheet.current.insert(block + '}');
  }
}

var Sheet = {
  current: null
};
var ruleSheet = function ruleSheet(context, content, selectors, parents, line, column, length, ns, depth, at) {
  switch (context) {
    // property
    case 1:
      {
        switch (content.charCodeAt(0)) {
          case 64:
            {
              // @import
              Sheet.current.insert(content + ';');
              return '';
            }
          // charcode for l

          case 108:
            {
              // charcode for b
              // this ignores label
              if (content.charCodeAt(2) === 98) {
                return '';
              }
            }
        }

        break;
      }
    // selector

    case 2:
      {
        if (ns === 0) return content + delimiter;
        break;
      }
    // at-rule

    case 3:
      {
        switch (ns) {
          // @font-face, @page
          case 102:
          case 112:
            {
              Sheet.current.insert(selectors[0] + content);
              return '';
            }

          default:
            {
              return content + (at === 0 ? delimiter : '');
            }
        }
      }

    case -2:
      {
        content.split(needle).forEach(toSheet);
      }
  }
};

var createCache = function createCache(options) {
  if (options === undefined) options = {};
  var key = options.key || 'css';
  var stylisOptions;

  if (options.prefix !== undefined) {
    stylisOptions = {
      prefix: options.prefix
    };
  }

  var stylis = new _emotion_stylis__WEBPACK_IMPORTED_MODULE_1__["default"](stylisOptions);

  if (true) {
    // $FlowFixMe
    if (/[^a-z-]/.test(key)) {
      throw new Error("Emotion key must only contain lower case alphabetical characters and - but \"" + key + "\" was passed");
    }
  }

  var inserted = {}; // $FlowFixMe

  var container;

  {
    container = options.container || document.head;
    var nodes = document.querySelectorAll("style[data-emotion-" + key + "]");
    Array.prototype.forEach.call(nodes, function (node) {
      var attrib = node.getAttribute("data-emotion-" + key); // $FlowFixMe

      attrib.split(' ').forEach(function (id) {
        inserted[id] = true;
      });

      if (node.parentNode !== container) {
        container.appendChild(node);
      }
    });
  }

  var _insert;

  {
    stylis.use(options.stylisPlugins)(ruleSheet);

    _insert = function insert(selector, serialized, sheet, shouldCache) {
      var name = serialized.name;
      Sheet.current = sheet;

      if ( true && serialized.map !== undefined) {
        var map = serialized.map;
        Sheet.current = {
          insert: function insert(rule) {
            sheet.insert(rule + map);
          }
        };
      }

      stylis(selector, serialized.styles);

      if (shouldCache) {
        cache.inserted[name] = true;
      }
    };
  }

  if (true) {
    // https://esbench.com/bench/5bf7371a4cd7e6009ef61d0a
    var commentStart = /\/\*/g;
    var commentEnd = /\*\//g;
    stylis.use(function (context, content) {
      switch (context) {
        case -1:
          {
            while (commentStart.test(content)) {
              commentEnd.lastIndex = commentStart.lastIndex;

              if (commentEnd.test(content)) {
                commentStart.lastIndex = commentEnd.lastIndex;
                continue;
              }

              throw new Error('Your styles have an unterminated comment ("/*" without corresponding "*/").');
            }

            commentStart.lastIndex = 0;
            break;
          }
      }
    });
    stylis.use(function (context, content, selectors) {
      switch (context) {
        case -1:
          {
            var flag = 'emotion-disable-server-rendering-unsafe-selector-warning-please-do-not-use-this-the-warning-exists-for-a-reason';
            var unsafePseudoClasses = content.match(/(:first|:nth|:nth-last)-child/g);

            if (unsafePseudoClasses && cache.compat !== true) {
              unsafePseudoClasses.forEach(function (unsafePseudoClass) {
                var ignoreRegExp = new RegExp(unsafePseudoClass + ".*\\/\\* " + flag + " \\*\\/");
                var ignore = ignoreRegExp.test(content);

                if (unsafePseudoClass && !ignore) {
                  console.error("The pseudo class \"" + unsafePseudoClass + "\" is potentially unsafe when doing server-side rendering. Try changing it to \"" + unsafePseudoClass.split('-child')[0] + "-of-type\".");
                }
              });
            }

            break;
          }
      }
    });
  }

  var cache = {
    key: key,
    sheet: new _emotion_sheet__WEBPACK_IMPORTED_MODULE_0__["StyleSheet"]({
      key: key,
      container: container,
      nonce: options.nonce,
      speedy: options.speedy
    }),
    nonce: options.nonce,
    inserted: inserted,
    registered: {},
    insert: _insert
  };
  return cache;
};

/* harmony default export */ __webpack_exports__["default"] = (createCache);


/***/ }),

/***/ "./node_modules/@emotion/hash/dist/hash.browser.esm.js":
/*!*************************************************************!*\
  !*** ./node_modules/@emotion/hash/dist/hash.browser.esm.js ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* eslint-disable */
// Inspired by https://github.com/garycourt/murmurhash-js
// Ported from https://github.com/aappleby/smhasher/blob/61a0530f28277f2e850bfc39600ce61d02b518de/src/MurmurHash2.cpp#L37-L86
function murmur2(str) {
  // 'm' and 'r' are mixing constants generated offline.
  // They're not really 'magic', they just happen to work well.
  // const m = 0x5bd1e995;
  // const r = 24;
  // Initialize the hash
  var h = 0; // Mix 4 bytes at a time into the hash

  var k,
      i = 0,
      len = str.length;

  for (; len >= 4; ++i, len -= 4) {
    k = str.charCodeAt(i) & 0xff | (str.charCodeAt(++i) & 0xff) << 8 | (str.charCodeAt(++i) & 0xff) << 16 | (str.charCodeAt(++i) & 0xff) << 24;
    k =
    /* Math.imul(k, m): */
    (k & 0xffff) * 0x5bd1e995 + ((k >>> 16) * 0xe995 << 16);
    k ^=
    /* k >>> r: */
    k >>> 24;
    h =
    /* Math.imul(k, m): */
    (k & 0xffff) * 0x5bd1e995 + ((k >>> 16) * 0xe995 << 16) ^
    /* Math.imul(h, m): */
    (h & 0xffff) * 0x5bd1e995 + ((h >>> 16) * 0xe995 << 16);
  } // Handle the last few bytes of the input array


  switch (len) {
    case 3:
      h ^= (str.charCodeAt(i + 2) & 0xff) << 16;

    case 2:
      h ^= (str.charCodeAt(i + 1) & 0xff) << 8;

    case 1:
      h ^= str.charCodeAt(i) & 0xff;
      h =
      /* Math.imul(h, m): */
      (h & 0xffff) * 0x5bd1e995 + ((h >>> 16) * 0xe995 << 16);
  } // Do a few final mixes of the hash to ensure the last few
  // bytes are well-incorporated.


  h ^= h >>> 13;
  h =
  /* Math.imul(h, m): */
  (h & 0xffff) * 0x5bd1e995 + ((h >>> 16) * 0xe995 << 16);
  return ((h ^ h >>> 15) >>> 0).toString(36);
}

/* harmony default export */ __webpack_exports__["default"] = (murmur2);


/***/ }),

/***/ "./node_modules/@emotion/memoize/dist/memoize.browser.esm.js":
/*!*******************************************************************!*\
  !*** ./node_modules/@emotion/memoize/dist/memoize.browser.esm.js ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
function memoize(fn) {
  var cache = {};
  return function (arg) {
    if (cache[arg] === undefined) cache[arg] = fn(arg);
    return cache[arg];
  };
}

/* harmony default export */ __webpack_exports__["default"] = (memoize);


/***/ }),

/***/ "./node_modules/@emotion/serialize/dist/serialize.browser.esm.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@emotion/serialize/dist/serialize.browser.esm.js ***!
  \***********************************************************************/
/*! exports provided: serializeStyles */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "serializeStyles", function() { return serializeStyles; });
/* harmony import */ var _emotion_hash__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @emotion/hash */ "./node_modules/@emotion/hash/dist/hash.browser.esm.js");
/* harmony import */ var _emotion_unitless__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @emotion/unitless */ "./node_modules/@emotion/unitless/dist/unitless.browser.esm.js");
/* harmony import */ var _emotion_memoize__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @emotion/memoize */ "./node_modules/@emotion/memoize/dist/memoize.browser.esm.js");




var ILLEGAL_ESCAPE_SEQUENCE_ERROR = "You have illegal escape sequence in your template literal, most likely inside content's property value.\nBecause you write your CSS inside a JavaScript string you actually have to do double escaping, so for example \"content: '\\00d7';\" should become \"content: '\\\\00d7';\".\nYou can read more about this here:\nhttps://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Template_literals#ES2018_revision_of_illegal_escape_sequences";
var UNDEFINED_AS_OBJECT_KEY_ERROR = "You have passed in falsy value as style object's key (can happen when in example you pass unexported component as computed key).";
var hyphenateRegex = /[A-Z]|^ms/g;
var animationRegex = /_EMO_([^_]+?)_([^]*?)_EMO_/g;

var isCustomProperty = function isCustomProperty(property) {
  return property.charCodeAt(1) === 45;
};

var isProcessableValue = function isProcessableValue(value) {
  return value != null && typeof value !== 'boolean';
};

var processStyleName = Object(_emotion_memoize__WEBPACK_IMPORTED_MODULE_2__["default"])(function (styleName) {
  return isCustomProperty(styleName) ? styleName : styleName.replace(hyphenateRegex, '-$&').toLowerCase();
});

var processStyleValue = function processStyleValue(key, value) {
  switch (key) {
    case 'animation':
    case 'animationName':
      {
        if (typeof value === 'string') {
          return value.replace(animationRegex, function (match, p1, p2) {
            cursor = {
              name: p1,
              styles: p2,
              next: cursor
            };
            return p1;
          });
        }
      }
  }

  if (_emotion_unitless__WEBPACK_IMPORTED_MODULE_1__["default"][key] !== 1 && !isCustomProperty(key) && typeof value === 'number' && value !== 0) {
    return value + 'px';
  }

  return value;
};

if (true) {
  var contentValuePattern = /(attr|calc|counters?|url)\(/;
  var contentValues = ['normal', 'none', 'counter', 'open-quote', 'close-quote', 'no-open-quote', 'no-close-quote', 'initial', 'inherit', 'unset'];
  var oldProcessStyleValue = processStyleValue;
  var msPattern = /^-ms-/;
  var hyphenPattern = /-(.)/g;
  var hyphenatedCache = {};

  processStyleValue = function processStyleValue(key, value) {
    if (key === 'content') {
      if (typeof value !== 'string' || contentValues.indexOf(value) === -1 && !contentValuePattern.test(value) && (value.charAt(0) !== value.charAt(value.length - 1) || value.charAt(0) !== '"' && value.charAt(0) !== "'")) {
        console.error("You seem to be using a value for 'content' without quotes, try replacing it with `content: '\"" + value + "\"'`");
      }
    }

    var processed = oldProcessStyleValue(key, value);

    if (processed !== '' && !isCustomProperty(key) && key.indexOf('-') !== -1 && hyphenatedCache[key] === undefined) {
      hyphenatedCache[key] = true;
      console.error("Using kebab-case for css properties in objects is not supported. Did you mean " + key.replace(msPattern, 'ms-').replace(hyphenPattern, function (str, _char) {
        return _char.toUpperCase();
      }) + "?");
    }

    return processed;
  };
}

var shouldWarnAboutInterpolatingClassNameFromCss = true;

function handleInterpolation(mergedProps, registered, interpolation, couldBeSelectorInterpolation) {
  if (interpolation == null) {
    return '';
  }

  if (interpolation.__emotion_styles !== undefined) {
    if ( true && interpolation.toString() === 'NO_COMPONENT_SELECTOR') {
      throw new Error('Component selectors can only be used in conjunction with babel-plugin-emotion.');
    }

    return interpolation;
  }

  switch (typeof interpolation) {
    case 'boolean':
      {
        return '';
      }

    case 'object':
      {
        if (interpolation.anim === 1) {
          cursor = {
            name: interpolation.name,
            styles: interpolation.styles,
            next: cursor
          };
          return interpolation.name;
        }

        if (interpolation.styles !== undefined) {
          var next = interpolation.next;

          if (next !== undefined) {
            // not the most efficient thing ever but this is a pretty rare case
            // and there will be very few iterations of this generally
            while (next !== undefined) {
              cursor = {
                name: next.name,
                styles: next.styles,
                next: cursor
              };
              next = next.next;
            }
          }

          var styles = interpolation.styles + ";";

          if ( true && interpolation.map !== undefined) {
            styles += interpolation.map;
          }

          return styles;
        }

        return createStringFromObject(mergedProps, registered, interpolation);
      }

    case 'function':
      {
        if (mergedProps !== undefined) {
          var previousCursor = cursor;
          var result = interpolation(mergedProps);
          cursor = previousCursor;
          return handleInterpolation(mergedProps, registered, result, couldBeSelectorInterpolation);
        } else if (true) {
          console.error('Functions that are interpolated in css calls will be stringified.\n' + 'If you want to have a css call based on props, create a function that returns a css call like this\n' + 'let dynamicStyle = (props) => css`color: ${props.color}`\n' + 'It can be called directly with props or interpolated in a styled call like this\n' + "let SomeComponent = styled('div')`${dynamicStyle}`");
        }

        break;
      }

    case 'string':
      if (true) {
        var matched = [];
        var replaced = interpolation.replace(animationRegex, function (match, p1, p2) {
          var fakeVarName = "animation" + matched.length;
          matched.push("const " + fakeVarName + " = keyframes`" + p2.replace(/^@keyframes animation-\w+/, '') + "`");
          return "${" + fakeVarName + "}";
        });

        if (matched.length) {
          console.error('`keyframes` output got interpolated into plain string, please wrap it with `css`.\n\n' + 'Instead of doing this:\n\n' + [].concat(matched, ["`" + replaced + "`"]).join('\n') + '\n\nYou should wrap it with `css` like this:\n\n' + ("css`" + replaced + "`"));
        }
      }

      break;
  } // finalize string values (regular strings and functions interpolated into css calls)


  if (registered == null) {
    return interpolation;
  }

  var cached = registered[interpolation];

  if ( true && couldBeSelectorInterpolation && shouldWarnAboutInterpolatingClassNameFromCss && cached !== undefined) {
    console.error('Interpolating a className from css`` is not recommended and will cause problems with composition.\n' + 'Interpolating a className from css`` will be completely unsupported in a future major version of Emotion');
    shouldWarnAboutInterpolatingClassNameFromCss = false;
  }

  return cached !== undefined && !couldBeSelectorInterpolation ? cached : interpolation;
}

function createStringFromObject(mergedProps, registered, obj) {
  var string = '';

  if (Array.isArray(obj)) {
    for (var i = 0; i < obj.length; i++) {
      string += handleInterpolation(mergedProps, registered, obj[i], false);
    }
  } else {
    for (var _key in obj) {
      var value = obj[_key];

      if (typeof value !== 'object') {
        if (registered != null && registered[value] !== undefined) {
          string += _key + "{" + registered[value] + "}";
        } else if (isProcessableValue(value)) {
          string += processStyleName(_key) + ":" + processStyleValue(_key, value) + ";";
        }
      } else {
        if (_key === 'NO_COMPONENT_SELECTOR' && "development" !== 'production') {
          throw new Error('Component selectors can only be used in conjunction with babel-plugin-emotion.');
        }

        if (Array.isArray(value) && typeof value[0] === 'string' && (registered == null || registered[value[0]] === undefined)) {
          for (var _i = 0; _i < value.length; _i++) {
            if (isProcessableValue(value[_i])) {
              string += processStyleName(_key) + ":" + processStyleValue(_key, value[_i]) + ";";
            }
          }
        } else {
          var interpolated = handleInterpolation(mergedProps, registered, value, false);

          switch (_key) {
            case 'animation':
            case 'animationName':
              {
                string += processStyleName(_key) + ":" + interpolated + ";";
                break;
              }

            default:
              {
                if ( true && _key === 'undefined') {
                  console.error(UNDEFINED_AS_OBJECT_KEY_ERROR);
                }

                string += _key + "{" + interpolated + "}";
              }
          }
        }
      }
    }
  }

  return string;
}

var labelPattern = /label:\s*([^\s;\n{]+)\s*;/g;
var sourceMapPattern;

if (true) {
  sourceMapPattern = /\/\*#\ssourceMappingURL=data:application\/json;\S+\s+\*\//;
} // this is the cursor for keyframes
// keyframes are stored on the SerializedStyles object as a linked list


var cursor;
var serializeStyles = function serializeStyles(args, registered, mergedProps) {
  if (args.length === 1 && typeof args[0] === 'object' && args[0] !== null && args[0].styles !== undefined) {
    return args[0];
  }

  var stringMode = true;
  var styles = '';
  cursor = undefined;
  var strings = args[0];

  if (strings == null || strings.raw === undefined) {
    stringMode = false;
    styles += handleInterpolation(mergedProps, registered, strings, false);
  } else {
    if ( true && strings[0] === undefined) {
      console.error(ILLEGAL_ESCAPE_SEQUENCE_ERROR);
    }

    styles += strings[0];
  } // we start at 1 since we've already handled the first arg


  for (var i = 1; i < args.length; i++) {
    styles += handleInterpolation(mergedProps, registered, args[i], styles.charCodeAt(styles.length - 1) === 46);

    if (stringMode) {
      if ( true && strings[i] === undefined) {
        console.error(ILLEGAL_ESCAPE_SEQUENCE_ERROR);
      }

      styles += strings[i];
    }
  }

  var sourceMap;

  if (true) {
    styles = styles.replace(sourceMapPattern, function (match) {
      sourceMap = match;
      return '';
    });
  } // using a global regex with .exec is stateful so lastIndex has to be reset each time


  labelPattern.lastIndex = 0;
  var identifierName = '';
  var match; // https://esbench.com/bench/5b809c2cf2949800a0f61fb5

  while ((match = labelPattern.exec(styles)) !== null) {
    identifierName += '-' + // $FlowFixMe we know it's not null
    match[1];
  }

  var name = Object(_emotion_hash__WEBPACK_IMPORTED_MODULE_0__["default"])(styles) + identifierName;

  if (true) {
    // $FlowFixMe SerializedStyles type doesn't have toString property (and we don't want to add it)
    return {
      name: name,
      styles: styles,
      map: sourceMap,
      next: cursor,
      toString: function toString() {
        return "You have tried to stringify object returned from `css` function. It isn't supposed to be used directly (e.g. as value of the `className` prop), but rather handed to emotion so it can handle it (e.g. as value of `css` prop).";
      }
    };
  }

  return {
    name: name,
    styles: styles,
    next: cursor
  };
};




/***/ }),

/***/ "./node_modules/@emotion/sheet/dist/sheet.browser.esm.js":
/*!***************************************************************!*\
  !*** ./node_modules/@emotion/sheet/dist/sheet.browser.esm.js ***!
  \***************************************************************/
/*! exports provided: StyleSheet */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "StyleSheet", function() { return StyleSheet; });
/*

Based off glamor's StyleSheet, thanks Sunil ❤️

high performance StyleSheet for css-in-js systems

- uses multiple style tags behind the scenes for millions of rules
- uses `insertRule` for appending in production for *much* faster performance

// usage

import { StyleSheet } from '@emotion/sheet'

let styleSheet = new StyleSheet({ key: '', container: document.head })

styleSheet.insert('#box { border: 1px solid red; }')
- appends a css rule into the stylesheet

styleSheet.flush()
- empties the stylesheet of all its contents

*/
// $FlowFixMe
function sheetForTag(tag) {
  if (tag.sheet) {
    // $FlowFixMe
    return tag.sheet;
  } // this weirdness brought to you by firefox

  /* istanbul ignore next */


  for (var i = 0; i < document.styleSheets.length; i++) {
    if (document.styleSheets[i].ownerNode === tag) {
      // $FlowFixMe
      return document.styleSheets[i];
    }
  }
}

function createStyleElement(options) {
  var tag = document.createElement('style');
  tag.setAttribute('data-emotion', options.key);

  if (options.nonce !== undefined) {
    tag.setAttribute('nonce', options.nonce);
  }

  tag.appendChild(document.createTextNode(''));
  return tag;
}

var StyleSheet =
/*#__PURE__*/
function () {
  function StyleSheet(options) {
    this.isSpeedy = options.speedy === undefined ? "development" === 'production' : options.speedy;
    this.tags = [];
    this.ctr = 0;
    this.nonce = options.nonce; // key is the value of the data-emotion attribute, it's used to identify different sheets

    this.key = options.key;
    this.container = options.container;
    this.before = null;
  }

  var _proto = StyleSheet.prototype;

  _proto.insert = function insert(rule) {
    // the max length is how many rules we have per style tag, it's 65000 in speedy mode
    // it's 1 in dev because we insert source maps that map a single rule to a location
    // and you can only have one source map per style tag
    if (this.ctr % (this.isSpeedy ? 65000 : 1) === 0) {
      var _tag = createStyleElement(this);

      var before;

      if (this.tags.length === 0) {
        before = this.before;
      } else {
        before = this.tags[this.tags.length - 1].nextSibling;
      }

      this.container.insertBefore(_tag, before);
      this.tags.push(_tag);
    }

    var tag = this.tags[this.tags.length - 1];

    if (this.isSpeedy) {
      var sheet = sheetForTag(tag);

      try {
        // this is a really hot path
        // we check the second character first because having "i"
        // as the second character will happen less often than
        // having "@" as the first character
        var isImportRule = rule.charCodeAt(1) === 105 && rule.charCodeAt(0) === 64; // this is the ultrafast version, works across browsers
        // the big drawback is that the css won't be editable in devtools

        sheet.insertRule(rule, // we need to insert @import rules before anything else
        // otherwise there will be an error
        // technically this means that the @import rules will
        // _usually_(not always since there could be multiple style tags)
        // be the first ones in prod and generally later in dev
        // this shouldn't really matter in the real world though
        // @import is generally only used for font faces from google fonts and etc.
        // so while this could be technically correct then it would be slower and larger
        // for a tiny bit of correctness that won't matter in the real world
        isImportRule ? 0 : sheet.cssRules.length);
      } catch (e) {
        if (true) {
          console.warn("There was a problem inserting the following rule: \"" + rule + "\"", e);
        }
      }
    } else {
      tag.appendChild(document.createTextNode(rule));
    }

    this.ctr++;
  };

  _proto.flush = function flush() {
    // $FlowFixMe
    this.tags.forEach(function (tag) {
      return tag.parentNode.removeChild(tag);
    });
    this.tags = [];
    this.ctr = 0;
  };

  return StyleSheet;
}();




/***/ }),

/***/ "./node_modules/@emotion/stylis/dist/stylis.browser.esm.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@emotion/stylis/dist/stylis.browser.esm.js ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
function stylis_min (W) {
  function M(d, c, e, h, a) {
    for (var m = 0, b = 0, v = 0, n = 0, q, g, x = 0, K = 0, k, u = k = q = 0, l = 0, r = 0, I = 0, t = 0, B = e.length, J = B - 1, y, f = '', p = '', F = '', G = '', C; l < B;) {
      g = e.charCodeAt(l);
      l === J && 0 !== b + n + v + m && (0 !== b && (g = 47 === b ? 10 : 47), n = v = m = 0, B++, J++);

      if (0 === b + n + v + m) {
        if (l === J && (0 < r && (f = f.replace(N, '')), 0 < f.trim().length)) {
          switch (g) {
            case 32:
            case 9:
            case 59:
            case 13:
            case 10:
              break;

            default:
              f += e.charAt(l);
          }

          g = 59;
        }

        switch (g) {
          case 123:
            f = f.trim();
            q = f.charCodeAt(0);
            k = 1;

            for (t = ++l; l < B;) {
              switch (g = e.charCodeAt(l)) {
                case 123:
                  k++;
                  break;

                case 125:
                  k--;
                  break;

                case 47:
                  switch (g = e.charCodeAt(l + 1)) {
                    case 42:
                    case 47:
                      a: {
                        for (u = l + 1; u < J; ++u) {
                          switch (e.charCodeAt(u)) {
                            case 47:
                              if (42 === g && 42 === e.charCodeAt(u - 1) && l + 2 !== u) {
                                l = u + 1;
                                break a;
                              }

                              break;

                            case 10:
                              if (47 === g) {
                                l = u + 1;
                                break a;
                              }

                          }
                        }

                        l = u;
                      }

                  }

                  break;

                case 91:
                  g++;

                case 40:
                  g++;

                case 34:
                case 39:
                  for (; l++ < J && e.charCodeAt(l) !== g;) {
                  }

              }

              if (0 === k) break;
              l++;
            }

            k = e.substring(t, l);
            0 === q && (q = (f = f.replace(ca, '').trim()).charCodeAt(0));

            switch (q) {
              case 64:
                0 < r && (f = f.replace(N, ''));
                g = f.charCodeAt(1);

                switch (g) {
                  case 100:
                  case 109:
                  case 115:
                  case 45:
                    r = c;
                    break;

                  default:
                    r = O;
                }

                k = M(c, r, k, g, a + 1);
                t = k.length;
                0 < A && (r = X(O, f, I), C = H(3, k, r, c, D, z, t, g, a, h), f = r.join(''), void 0 !== C && 0 === (t = (k = C.trim()).length) && (g = 0, k = ''));
                if (0 < t) switch (g) {
                  case 115:
                    f = f.replace(da, ea);

                  case 100:
                  case 109:
                  case 45:
                    k = f + '{' + k + '}';
                    break;

                  case 107:
                    f = f.replace(fa, '$1 $2');
                    k = f + '{' + k + '}';
                    k = 1 === w || 2 === w && L('@' + k, 3) ? '@-webkit-' + k + '@' + k : '@' + k;
                    break;

                  default:
                    k = f + k, 112 === h && (k = (p += k, ''));
                } else k = '';
                break;

              default:
                k = M(c, X(c, f, I), k, h, a + 1);
            }

            F += k;
            k = I = r = u = q = 0;
            f = '';
            g = e.charCodeAt(++l);
            break;

          case 125:
          case 59:
            f = (0 < r ? f.replace(N, '') : f).trim();
            if (1 < (t = f.length)) switch (0 === u && (q = f.charCodeAt(0), 45 === q || 96 < q && 123 > q) && (t = (f = f.replace(' ', ':')).length), 0 < A && void 0 !== (C = H(1, f, c, d, D, z, p.length, h, a, h)) && 0 === (t = (f = C.trim()).length) && (f = '\x00\x00'), q = f.charCodeAt(0), g = f.charCodeAt(1), q) {
              case 0:
                break;

              case 64:
                if (105 === g || 99 === g) {
                  G += f + e.charAt(l);
                  break;
                }

              default:
                58 !== f.charCodeAt(t - 1) && (p += P(f, q, g, f.charCodeAt(2)));
            }
            I = r = u = q = 0;
            f = '';
            g = e.charCodeAt(++l);
        }
      }

      switch (g) {
        case 13:
        case 10:
          47 === b ? b = 0 : 0 === 1 + q && 107 !== h && 0 < f.length && (r = 1, f += '\x00');
          0 < A * Y && H(0, f, c, d, D, z, p.length, h, a, h);
          z = 1;
          D++;
          break;

        case 59:
        case 125:
          if (0 === b + n + v + m) {
            z++;
            break;
          }

        default:
          z++;
          y = e.charAt(l);

          switch (g) {
            case 9:
            case 32:
              if (0 === n + m + b) switch (x) {
                case 44:
                case 58:
                case 9:
                case 32:
                  y = '';
                  break;

                default:
                  32 !== g && (y = ' ');
              }
              break;

            case 0:
              y = '\\0';
              break;

            case 12:
              y = '\\f';
              break;

            case 11:
              y = '\\v';
              break;

            case 38:
              0 === n + b + m && (r = I = 1, y = '\f' + y);
              break;

            case 108:
              if (0 === n + b + m + E && 0 < u) switch (l - u) {
                case 2:
                  112 === x && 58 === e.charCodeAt(l - 3) && (E = x);

                case 8:
                  111 === K && (E = K);
              }
              break;

            case 58:
              0 === n + b + m && (u = l);
              break;

            case 44:
              0 === b + v + n + m && (r = 1, y += '\r');
              break;

            case 34:
            case 39:
              0 === b && (n = n === g ? 0 : 0 === n ? g : n);
              break;

            case 91:
              0 === n + b + v && m++;
              break;

            case 93:
              0 === n + b + v && m--;
              break;

            case 41:
              0 === n + b + m && v--;
              break;

            case 40:
              if (0 === n + b + m) {
                if (0 === q) switch (2 * x + 3 * K) {
                  case 533:
                    break;

                  default:
                    q = 1;
                }
                v++;
              }

              break;

            case 64:
              0 === b + v + n + m + u + k && (k = 1);
              break;

            case 42:
            case 47:
              if (!(0 < n + m + v)) switch (b) {
                case 0:
                  switch (2 * g + 3 * e.charCodeAt(l + 1)) {
                    case 235:
                      b = 47;
                      break;

                    case 220:
                      t = l, b = 42;
                  }

                  break;

                case 42:
                  47 === g && 42 === x && t + 2 !== l && (33 === e.charCodeAt(t + 2) && (p += e.substring(t, l + 1)), y = '', b = 0);
              }
          }

          0 === b && (f += y);
      }

      K = x;
      x = g;
      l++;
    }

    t = p.length;

    if (0 < t) {
      r = c;
      if (0 < A && (C = H(2, p, r, d, D, z, t, h, a, h), void 0 !== C && 0 === (p = C).length)) return G + p + F;
      p = r.join(',') + '{' + p + '}';

      if (0 !== w * E) {
        2 !== w || L(p, 2) || (E = 0);

        switch (E) {
          case 111:
            p = p.replace(ha, ':-moz-$1') + p;
            break;

          case 112:
            p = p.replace(Q, '::-webkit-input-$1') + p.replace(Q, '::-moz-$1') + p.replace(Q, ':-ms-input-$1') + p;
        }

        E = 0;
      }
    }

    return G + p + F;
  }

  function X(d, c, e) {
    var h = c.trim().split(ia);
    c = h;
    var a = h.length,
        m = d.length;

    switch (m) {
      case 0:
      case 1:
        var b = 0;

        for (d = 0 === m ? '' : d[0] + ' '; b < a; ++b) {
          c[b] = Z(d, c[b], e).trim();
        }

        break;

      default:
        var v = b = 0;

        for (c = []; b < a; ++b) {
          for (var n = 0; n < m; ++n) {
            c[v++] = Z(d[n] + ' ', h[b], e).trim();
          }
        }

    }

    return c;
  }

  function Z(d, c, e) {
    var h = c.charCodeAt(0);
    33 > h && (h = (c = c.trim()).charCodeAt(0));

    switch (h) {
      case 38:
        return c.replace(F, '$1' + d.trim());

      case 58:
        return d.trim() + c.replace(F, '$1' + d.trim());

      default:
        if (0 < 1 * e && 0 < c.indexOf('\f')) return c.replace(F, (58 === d.charCodeAt(0) ? '' : '$1') + d.trim());
    }

    return d + c;
  }

  function P(d, c, e, h) {
    var a = d + ';',
        m = 2 * c + 3 * e + 4 * h;

    if (944 === m) {
      d = a.indexOf(':', 9) + 1;
      var b = a.substring(d, a.length - 1).trim();
      b = a.substring(0, d).trim() + b + ';';
      return 1 === w || 2 === w && L(b, 1) ? '-webkit-' + b + b : b;
    }

    if (0 === w || 2 === w && !L(a, 1)) return a;

    switch (m) {
      case 1015:
        return 97 === a.charCodeAt(10) ? '-webkit-' + a + a : a;

      case 951:
        return 116 === a.charCodeAt(3) ? '-webkit-' + a + a : a;

      case 963:
        return 110 === a.charCodeAt(5) ? '-webkit-' + a + a : a;

      case 1009:
        if (100 !== a.charCodeAt(4)) break;

      case 969:
      case 942:
        return '-webkit-' + a + a;

      case 978:
        return '-webkit-' + a + '-moz-' + a + a;

      case 1019:
      case 983:
        return '-webkit-' + a + '-moz-' + a + '-ms-' + a + a;

      case 883:
        if (45 === a.charCodeAt(8)) return '-webkit-' + a + a;
        if (0 < a.indexOf('image-set(', 11)) return a.replace(ja, '$1-webkit-$2') + a;
        break;

      case 932:
        if (45 === a.charCodeAt(4)) switch (a.charCodeAt(5)) {
          case 103:
            return '-webkit-box-' + a.replace('-grow', '') + '-webkit-' + a + '-ms-' + a.replace('grow', 'positive') + a;

          case 115:
            return '-webkit-' + a + '-ms-' + a.replace('shrink', 'negative') + a;

          case 98:
            return '-webkit-' + a + '-ms-' + a.replace('basis', 'preferred-size') + a;
        }
        return '-webkit-' + a + '-ms-' + a + a;

      case 964:
        return '-webkit-' + a + '-ms-flex-' + a + a;

      case 1023:
        if (99 !== a.charCodeAt(8)) break;
        b = a.substring(a.indexOf(':', 15)).replace('flex-', '').replace('space-between', 'justify');
        return '-webkit-box-pack' + b + '-webkit-' + a + '-ms-flex-pack' + b + a;

      case 1005:
        return ka.test(a) ? a.replace(aa, ':-webkit-') + a.replace(aa, ':-moz-') + a : a;

      case 1e3:
        b = a.substring(13).trim();
        c = b.indexOf('-') + 1;

        switch (b.charCodeAt(0) + b.charCodeAt(c)) {
          case 226:
            b = a.replace(G, 'tb');
            break;

          case 232:
            b = a.replace(G, 'tb-rl');
            break;

          case 220:
            b = a.replace(G, 'lr');
            break;

          default:
            return a;
        }

        return '-webkit-' + a + '-ms-' + b + a;

      case 1017:
        if (-1 === a.indexOf('sticky', 9)) break;

      case 975:
        c = (a = d).length - 10;
        b = (33 === a.charCodeAt(c) ? a.substring(0, c) : a).substring(d.indexOf(':', 7) + 1).trim();

        switch (m = b.charCodeAt(0) + (b.charCodeAt(7) | 0)) {
          case 203:
            if (111 > b.charCodeAt(8)) break;

          case 115:
            a = a.replace(b, '-webkit-' + b) + ';' + a;
            break;

          case 207:
          case 102:
            a = a.replace(b, '-webkit-' + (102 < m ? 'inline-' : '') + 'box') + ';' + a.replace(b, '-webkit-' + b) + ';' + a.replace(b, '-ms-' + b + 'box') + ';' + a;
        }

        return a + ';';

      case 938:
        if (45 === a.charCodeAt(5)) switch (a.charCodeAt(6)) {
          case 105:
            return b = a.replace('-items', ''), '-webkit-' + a + '-webkit-box-' + b + '-ms-flex-' + b + a;

          case 115:
            return '-webkit-' + a + '-ms-flex-item-' + a.replace(ba, '') + a;

          default:
            return '-webkit-' + a + '-ms-flex-line-pack' + a.replace('align-content', '').replace(ba, '') + a;
        }
        break;

      case 973:
      case 989:
        if (45 !== a.charCodeAt(3) || 122 === a.charCodeAt(4)) break;

      case 931:
      case 953:
        if (!0 === la.test(d)) return 115 === (b = d.substring(d.indexOf(':') + 1)).charCodeAt(0) ? P(d.replace('stretch', 'fill-available'), c, e, h).replace(':fill-available', ':stretch') : a.replace(b, '-webkit-' + b) + a.replace(b, '-moz-' + b.replace('fill-', '')) + a;
        break;

      case 962:
        if (a = '-webkit-' + a + (102 === a.charCodeAt(5) ? '-ms-' + a : '') + a, 211 === e + h && 105 === a.charCodeAt(13) && 0 < a.indexOf('transform', 10)) return a.substring(0, a.indexOf(';', 27) + 1).replace(ma, '$1-webkit-$2') + a;
    }

    return a;
  }

  function L(d, c) {
    var e = d.indexOf(1 === c ? ':' : '{'),
        h = d.substring(0, 3 !== c ? e : 10);
    e = d.substring(e + 1, d.length - 1);
    return R(2 !== c ? h : h.replace(na, '$1'), e, c);
  }

  function ea(d, c) {
    var e = P(c, c.charCodeAt(0), c.charCodeAt(1), c.charCodeAt(2));
    return e !== c + ';' ? e.replace(oa, ' or ($1)').substring(4) : '(' + c + ')';
  }

  function H(d, c, e, h, a, m, b, v, n, q) {
    for (var g = 0, x = c, w; g < A; ++g) {
      switch (w = S[g].call(B, d, x, e, h, a, m, b, v, n, q)) {
        case void 0:
        case !1:
        case !0:
        case null:
          break;

        default:
          x = w;
      }
    }

    if (x !== c) return x;
  }

  function T(d) {
    switch (d) {
      case void 0:
      case null:
        A = S.length = 0;
        break;

      default:
        if ('function' === typeof d) S[A++] = d;else if ('object' === typeof d) for (var c = 0, e = d.length; c < e; ++c) {
          T(d[c]);
        } else Y = !!d | 0;
    }

    return T;
  }

  function U(d) {
    d = d.prefix;
    void 0 !== d && (R = null, d ? 'function' !== typeof d ? w = 1 : (w = 2, R = d) : w = 0);
    return U;
  }

  function B(d, c) {
    var e = d;
    33 > e.charCodeAt(0) && (e = e.trim());
    V = e;
    e = [V];

    if (0 < A) {
      var h = H(-1, c, e, e, D, z, 0, 0, 0, 0);
      void 0 !== h && 'string' === typeof h && (c = h);
    }

    var a = M(O, e, c, 0, 0);
    0 < A && (h = H(-2, a, e, e, D, z, a.length, 0, 0, 0), void 0 !== h && (a = h));
    V = '';
    E = 0;
    z = D = 1;
    return a;
  }

  var ca = /^\0+/g,
      N = /[\0\r\f]/g,
      aa = /: */g,
      ka = /zoo|gra/,
      ma = /([,: ])(transform)/g,
      ia = /,\r+?/g,
      F = /([\t\r\n ])*\f?&/g,
      fa = /@(k\w+)\s*(\S*)\s*/,
      Q = /::(place)/g,
      ha = /:(read-only)/g,
      G = /[svh]\w+-[tblr]{2}/,
      da = /\(\s*(.*)\s*\)/g,
      oa = /([\s\S]*?);/g,
      ba = /-self|flex-/g,
      na = /[^]*?(:[rp][el]a[\w-]+)[^]*/,
      la = /stretch|:\s*\w+\-(?:conte|avail)/,
      ja = /([^-])(image-set\()/,
      z = 1,
      D = 1,
      E = 0,
      w = 1,
      O = [],
      S = [],
      A = 0,
      R = null,
      Y = 0,
      V = '';
  B.use = T;
  B.set = U;
  void 0 !== W && U(W);
  return B;
}

/* harmony default export */ __webpack_exports__["default"] = (stylis_min);


/***/ }),

/***/ "./node_modules/@emotion/unitless/dist/unitless.browser.esm.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@emotion/unitless/dist/unitless.browser.esm.js ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var unitlessKeys = {
  animationIterationCount: 1,
  borderImageOutset: 1,
  borderImageSlice: 1,
  borderImageWidth: 1,
  boxFlex: 1,
  boxFlexGroup: 1,
  boxOrdinalGroup: 1,
  columnCount: 1,
  columns: 1,
  flex: 1,
  flexGrow: 1,
  flexPositive: 1,
  flexShrink: 1,
  flexNegative: 1,
  flexOrder: 1,
  gridRow: 1,
  gridRowEnd: 1,
  gridRowSpan: 1,
  gridRowStart: 1,
  gridColumn: 1,
  gridColumnEnd: 1,
  gridColumnSpan: 1,
  gridColumnStart: 1,
  msGridRow: 1,
  msGridRowSpan: 1,
  msGridColumn: 1,
  msGridColumnSpan: 1,
  fontWeight: 1,
  lineHeight: 1,
  opacity: 1,
  order: 1,
  orphans: 1,
  tabSize: 1,
  widows: 1,
  zIndex: 1,
  zoom: 1,
  WebkitLineClamp: 1,
  // SVG-related properties
  fillOpacity: 1,
  floodOpacity: 1,
  stopOpacity: 1,
  strokeDasharray: 1,
  strokeDashoffset: 1,
  strokeMiterlimit: 1,
  strokeOpacity: 1,
  strokeWidth: 1
};

/* harmony default export */ __webpack_exports__["default"] = (unitlessKeys);


/***/ }),

/***/ "./node_modules/@emotion/utils/dist/utils.browser.esm.js":
/*!***************************************************************!*\
  !*** ./node_modules/@emotion/utils/dist/utils.browser.esm.js ***!
  \***************************************************************/
/*! exports provided: getRegisteredStyles, insertStyles */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getRegisteredStyles", function() { return getRegisteredStyles; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "insertStyles", function() { return insertStyles; });
var isBrowser = "object" !== 'undefined';
function getRegisteredStyles(registered, registeredStyles, classNames) {
  var rawClassName = '';
  classNames.split(' ').forEach(function (className) {
    if (registered[className] !== undefined) {
      registeredStyles.push(registered[className]);
    } else {
      rawClassName += className + " ";
    }
  });
  return rawClassName;
}
var insertStyles = function insertStyles(cache, serialized, isStringTag) {
  var className = cache.key + "-" + serialized.name;

  if ( // we only need to add the styles to the registered cache if the
  // class name could be used further down
  // the tree but if it's a string tag, we know it won't
  // so we don't have to add it to registered cache.
  // this improves memory usage since we can avoid storing the whole style string
  (isStringTag === false || // we need to always store it if we're in compat mode and
  // in node since emotion-server relies on whether a style is in
  // the registered cache to know whether a style is global or not
  // also, note that this check will be dead code eliminated in the browser
  isBrowser === false && cache.compat !== undefined) && cache.registered[className] === undefined) {
    cache.registered[className] = serialized.styles;
  }

  if (cache.inserted[serialized.name] === undefined) {
    var current = serialized;

    do {
      var maybeStyles = cache.insert("." + className, current, cache.sheet, true);

      current = current.next;
    } while (current !== undefined);
  }
};




/***/ }),

/***/ "./node_modules/@emotion/weak-memoize/dist/weak-memoize.browser.esm.js":
/*!*****************************************************************************!*\
  !*** ./node_modules/@emotion/weak-memoize/dist/weak-memoize.browser.esm.js ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var weakMemoize = function weakMemoize(func) {
  // $FlowFixMe flow doesn't include all non-primitive types as allowed for weakmaps
  var cache = new WeakMap();
  return function (arg) {
    if (cache.has(arg)) {
      // $FlowFixMe
      return cache.get(arg);
    }

    var ret = func(arg);
    cache.set(arg, ret);
    return ret;
  };
};

/* harmony default export */ __webpack_exports__["default"] = (weakMemoize);


/***/ }),

/***/ "./node_modules/@giphy/js-analytics/dist/index.js":
/*!********************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/dist/index.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    Object.defineProperty(o, k2, { enumerable: true, get: function() { return m[k]; } });
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __exportStar = (this && this.__exportStar) || function(m, exports) {
    for (var p in m) if (p !== "default" && !Object.prototype.hasOwnProperty.call(exports, p)) __createBinding(exports, m, p);
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.addLastSearchResponseId = exports.pingback = exports.mergeAttribute = void 0;
var merge_attribute_1 = __webpack_require__(/*! ./merge-attribute */ "./node_modules/@giphy/js-analytics/dist/merge-attribute.js");
Object.defineProperty(exports, "mergeAttribute", { enumerable: true, get: function () { return __importDefault(merge_attribute_1).default; } });
var pingback_1 = __webpack_require__(/*! ./pingback */ "./node_modules/@giphy/js-analytics/dist/pingback.js");
Object.defineProperty(exports, "pingback", { enumerable: true, get: function () { return __importDefault(pingback_1).default; } });
var session_1 = __webpack_require__(/*! ./session */ "./node_modules/@giphy/js-analytics/dist/session.js");
Object.defineProperty(exports, "addLastSearchResponseId", { enumerable: true, get: function () { return session_1.addLastSearchResponseId; } });
__exportStar(__webpack_require__(/*! ./types */ "./node_modules/@giphy/js-analytics/dist/types.js"), exports);
//# sourceMappingURL=index.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/dist/merge-attribute.js":
/*!******************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/dist/merge-attribute.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
var mergeAttribute = function (attributes, key) {
    // attributes we need to merge
    var toMerge = [];
    // remove the attributes that match the key
    var result = attributes.filter(function (val) {
        if (val.key === key) {
            toMerge.push(val);
            return false;
        }
        return true;
    });
    // if we have any, merge'em
    if (toMerge.length > 0) {
        var value = toMerge.map(function (val) { return val.value; }).join(', ');
        result.push({ key: key, value: value });
    }
    return result;
};
exports.default = mergeAttribute;
//# sourceMappingURL=merge-attribute.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/dist/pingback.js":
/*!***********************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/dist/pingback.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
var throttle_debounce_1 = __webpack_require__(/*! throttle-debounce */ "./node_modules/throttle-debounce/index.umd.js");
var session_1 = __webpack_require__(/*! ./session */ "./node_modules/@giphy/js-analytics/dist/session.js");
var util_1 = __webpack_require__(/*! ./util */ "./node_modules/@giphy/js-analytics/dist/util.js");
var js_util_1 = __webpack_require__(/*! @giphy/js-util */ "./node_modules/@giphy/js-util/dist/index.js");
var send_pingback_1 = __webpack_require__(/*! ./send-pingback */ "./node_modules/@giphy/js-analytics/dist/send-pingback.js");
var queuedPingbacks = {};
var loggedInUserId = '';
function fetchPingbackRequest() {
    js_util_1.forEach(queuedPingbacks, function (actionMap, pingbackType) {
        if (actionMap) {
            js_util_1.forEach(actionMap, function (action, responseId) {
                // if there are no actions lined up inside this pingbackType do nothing
                if (action.length) {
                    var session = session_1.createSession(pingbackType, action, responseId, loggedInUserId);
                    send_pingback_1.sendPingback(session);
                    // empty this specific batch
                    actionMap[responseId] = [];
                }
            });
        }
    });
}
var debouncedPingbackEvent = throttle_debounce_1.debounce(1000, fetchPingbackRequest);
var pingback = function (_a) {
    var gif = _a.gif, user = _a.user, responseId = _a.responseId, pingbackType = _a.type, actionType = _a.actionType, position = _a.position, attributes = _a.attributes;
    // not all endpoints provide a response_id
    if (!responseId) {
        js_util_1.Logger.debug("Pingback aborted for " + gif.id + ", no responseId");
        return;
    }
    var id = gif.id, _b = gif.bottle_data, bottle_data = _b === void 0 ? {} : _b;
    var tid = bottle_data.tid;
    // save the user id for whenever create session is invoked
    loggedInUserId = user && user.id ? String(user.id) : loggedInUserId;
    // the queue doesn't exist for this pingbackType yet so create it
    if (!queuedPingbacks[pingbackType])
        queuedPingbacks[pingbackType] = {};
    // a map of actions based on pingback type
    var actionMap = queuedPingbacks[pingbackType]; // we just created it so ! is ok
    // create the searchRepsonseId queue
    if (!actionMap[responseId])
        actionMap[responseId] = [];
    // add the action
    actionMap[responseId].push(util_1.getAction(actionType, String(id), tid, position, attributes));
    // if there's a tid, skip the queue
    tid ? fetchPingbackRequest() : debouncedPingbackEvent();
};
exports.default = pingback;
//# sourceMappingURL=pingback.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/dist/send-pingback.js":
/*!****************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/dist/send-pingback.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
exports.sendPingback = void 0;
var js_util_1 = __webpack_require__(/*! @giphy/js-util */ "./node_modules/@giphy/js-util/dist/index.js");
// TODO remove api key
var pingBackUrl = 'https://pingback.giphy.com/pingback?apikey=l0HlIwPWyBBUDAUgM';
exports.sendPingback = function (session) {
    var headers = js_util_1.getGiphySDKRequestHeaders();
    headers === null || headers === void 0 ? void 0 : headers.set('Content-Type', 'application/json');
    js_util_1.Logger.debug("Pingback session", session);
    return fetch(pingBackUrl, {
        method: 'POST',
        body: JSON.stringify({ sessions: [session] }),
        headers: headers,
    });
};
//# sourceMappingURL=send-pingback.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/dist/session.js":
/*!**********************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/dist/session.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(global) {
var __spreadArrays = (this && this.__spreadArrays) || function () {
    for (var s = 0, i = 0, il = arguments.length; i < il; i++) s += arguments[i].length;
    for (var r = Array(s), k = 0, i = 0; i < il; i++)
        for (var a = arguments[i], j = 0, jl = a.length; j < jl; j++, k++)
            r[k] = a[j];
    return r;
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.createSession = exports.addLastSearchResponseId = exports.SESSION_STORAGE_KEY = void 0;
var cookie_1 = __importDefault(__webpack_require__(/*! cookie */ "./node_modules/@giphy/js-analytics/node_modules/cookie/index.js"));
var uuid_1 = __webpack_require__(/*! uuid */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/index.js"); // v1 only for pingback verfication
exports.SESSION_STORAGE_KEY = 'responseIds';
function getLastResponseId() {
    try {
        var sessionIds = sessionStorage.getItem(exports.SESSION_STORAGE_KEY);
        if (sessionIds) {
            var responseIds = JSON.parse(sessionIds) || [];
            return responseIds[responseIds.length - 2] || '';
        }
    }
    catch (_) { }
    return '';
}
function addLastSearchResponseId(responseId) {
    try {
        var existing = sessionStorage.getItem(exports.SESSION_STORAGE_KEY);
        if (existing) {
            var searchResponseIds = JSON.parse(existing);
            if (searchResponseIds[searchResponseIds.length - 1] !== responseId) {
                sessionStorage.setItem(exports.SESSION_STORAGE_KEY, JSON.stringify(__spreadArrays(searchResponseIds, [responseId])));
            }
        }
        else {
            sessionStorage.setItem(exports.SESSION_STORAGE_KEY, JSON.stringify([responseId]));
        }
    }
    catch (_) { }
}
exports.addLastSearchResponseId = addLastSearchResponseId;
var gl = ((typeof window !== 'undefined' ? window : global) || {});
gl.giphyRandomId = '';
var getRandomId = function () {
    // it exists in memory
    if (!gl.giphyRandomId) {
        try {
            // it exists in storage
            gl.giphyRandomId = localStorage.getItem('giphyRandomId');
        }
        catch (_) { }
        if (!gl.giphyRandomId) {
            // we need to create it
            gl.giphyRandomId = uuid_1.v1();
            try {
                // save in storage
                localStorage.setItem('giphyRandomId', gl.giphyRandomId);
            }
            catch (_) { }
        }
    }
    return gl.giphyRandomId;
};
// the session is the request payload of a pingback request
exports.createSession = function (event_type, actions, responseId, loggedInUserId) {
    if (responseId === void 0) { responseId = ''; }
    if (loggedInUserId === void 0) { loggedInUserId = ''; }
    return ({
        user: {
            user_id: cookie_1.default.parse(document ? document.cookie : {}).giphy_pbid,
            logged_in_user_id: loggedInUserId || '',
            random_id: getRandomId(),
        },
        events: [
            {
                event_type: event_type,
                referrer: document ? document.referrer : '',
                actions: actions,
                response_id: responseId,
                prior_response_id: getLastResponseId(),
            },
        ],
    });
};
//# sourceMappingURL=session.js.map
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/dist/types.js":
/*!********************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/dist/types.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
//# sourceMappingURL=types.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/dist/util.js":
/*!*******************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/dist/util.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
exports.getAction = void 0;
function getAction(action_type, gif_id, tid, position, attributes) {
    if (attributes === void 0) { attributes = []; }
    if (position &&
        // apppend position only if it's not passed as a custom attribute
        !attributes.some(function (attributes) { return attributes.key === 'position'; })) {
        attributes.push({
            key: "position",
            value: JSON.stringify(position),
        });
    }
    return {
        action_type: action_type,
        ts: Date.now(),
        gif_id: gif_id,
        tid: tid,
        attributes: attributes,
    };
}
exports.getAction = getAction;
//# sourceMappingURL=util.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/cookie/index.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/cookie/index.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/*!
 * cookie
 * Copyright(c) 2012-2014 Roman Shtylman
 * Copyright(c) 2015 Douglas Christopher Wilson
 * MIT Licensed
 */



/**
 * Module exports.
 * @public
 */

exports.parse = parse;
exports.serialize = serialize;

/**
 * Module variables.
 * @private
 */

var decode = decodeURIComponent;
var encode = encodeURIComponent;
var pairSplitRegExp = /; */;

/**
 * RegExp to match field-content in RFC 7230 sec 3.2
 *
 * field-content = field-vchar [ 1*( SP / HTAB ) field-vchar ]
 * field-vchar   = VCHAR / obs-text
 * obs-text      = %x80-FF
 */

var fieldContentRegExp = /^[\u0009\u0020-\u007e\u0080-\u00ff]+$/;

/**
 * Parse a cookie header.
 *
 * Parse the given cookie header string into an object
 * The object has the various cookies as keys(names) => values
 *
 * @param {string} str
 * @param {object} [options]
 * @return {object}
 * @public
 */

function parse(str, options) {
  if (typeof str !== 'string') {
    throw new TypeError('argument str must be a string');
  }

  var obj = {}
  var opt = options || {};
  var pairs = str.split(pairSplitRegExp);
  var dec = opt.decode || decode;

  for (var i = 0; i < pairs.length; i++) {
    var pair = pairs[i];
    var eq_idx = pair.indexOf('=');

    // skip things that don't look like key=value
    if (eq_idx < 0) {
      continue;
    }

    var key = pair.substr(0, eq_idx).trim()
    var val = pair.substr(++eq_idx, pair.length).trim();

    // quoted values
    if ('"' == val[0]) {
      val = val.slice(1, -1);
    }

    // only assign once
    if (undefined == obj[key]) {
      obj[key] = tryDecode(val, dec);
    }
  }

  return obj;
}

/**
 * Serialize data into a cookie header.
 *
 * Serialize the a name value pair into a cookie string suitable for
 * http headers. An optional options object specified cookie parameters.
 *
 * serialize('foo', 'bar', { httpOnly: true })
 *   => "foo=bar; httpOnly"
 *
 * @param {string} name
 * @param {string} val
 * @param {object} [options]
 * @return {string}
 * @public
 */

function serialize(name, val, options) {
  var opt = options || {};
  var enc = opt.encode || encode;

  if (typeof enc !== 'function') {
    throw new TypeError('option encode is invalid');
  }

  if (!fieldContentRegExp.test(name)) {
    throw new TypeError('argument name is invalid');
  }

  var value = enc(val);

  if (value && !fieldContentRegExp.test(value)) {
    throw new TypeError('argument val is invalid');
  }

  var str = name + '=' + value;

  if (null != opt.maxAge) {
    var maxAge = opt.maxAge - 0;

    if (isNaN(maxAge) || !isFinite(maxAge)) {
      throw new TypeError('option maxAge is invalid')
    }

    str += '; Max-Age=' + Math.floor(maxAge);
  }

  if (opt.domain) {
    if (!fieldContentRegExp.test(opt.domain)) {
      throw new TypeError('option domain is invalid');
    }

    str += '; Domain=' + opt.domain;
  }

  if (opt.path) {
    if (!fieldContentRegExp.test(opt.path)) {
      throw new TypeError('option path is invalid');
    }

    str += '; Path=' + opt.path;
  }

  if (opt.expires) {
    if (typeof opt.expires.toUTCString !== 'function') {
      throw new TypeError('option expires is invalid');
    }

    str += '; Expires=' + opt.expires.toUTCString();
  }

  if (opt.httpOnly) {
    str += '; HttpOnly';
  }

  if (opt.secure) {
    str += '; Secure';
  }

  if (opt.sameSite) {
    var sameSite = typeof opt.sameSite === 'string'
      ? opt.sameSite.toLowerCase() : opt.sameSite;

    switch (sameSite) {
      case true:
        str += '; SameSite=Strict';
        break;
      case 'lax':
        str += '; SameSite=Lax';
        break;
      case 'strict':
        str += '; SameSite=Strict';
        break;
      case 'none':
        str += '; SameSite=None';
        break;
      default:
        throw new TypeError('option sameSite is invalid');
    }
  }

  return str;
}

/**
 * Try decoding a string using a decoding function.
 *
 * @param {string} str
 * @param {function} decode
 * @private
 */

function tryDecode(str, decode) {
  try {
    return decode(str);
  } catch (e) {
    return str;
  }
}


/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/index.js":
/*!**************************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/index.js ***!
  \**************************************************************************************/
/*! exports provided: v1, v3, v4, v5, NIL, version, validate, stringify, parse */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _v1_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./v1.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v1.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "v1", function() { return _v1_js__WEBPACK_IMPORTED_MODULE_0__["default"]; });

/* harmony import */ var _v3_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./v3.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v3.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "v3", function() { return _v3_js__WEBPACK_IMPORTED_MODULE_1__["default"]; });

/* harmony import */ var _v4_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./v4.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v4.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "v4", function() { return _v4_js__WEBPACK_IMPORTED_MODULE_2__["default"]; });

/* harmony import */ var _v5_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./v5.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v5.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "v5", function() { return _v5_js__WEBPACK_IMPORTED_MODULE_3__["default"]; });

/* harmony import */ var _nil_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./nil.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/nil.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "NIL", function() { return _nil_js__WEBPACK_IMPORTED_MODULE_4__["default"]; });

/* harmony import */ var _version_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./version.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/version.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "version", function() { return _version_js__WEBPACK_IMPORTED_MODULE_5__["default"]; });

/* harmony import */ var _validate_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./validate.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/validate.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "validate", function() { return _validate_js__WEBPACK_IMPORTED_MODULE_6__["default"]; });

/* harmony import */ var _stringify_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./stringify.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/stringify.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "stringify", function() { return _stringify_js__WEBPACK_IMPORTED_MODULE_7__["default"]; });

/* harmony import */ var _parse_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./parse.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/parse.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "parse", function() { return _parse_js__WEBPACK_IMPORTED_MODULE_8__["default"]; });











/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/md5.js":
/*!************************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/md5.js ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/*
 * Browser-compatible JavaScript MD5
 *
 * Modification of JavaScript MD5
 * https://github.com/blueimp/JavaScript-MD5
 *
 * Copyright 2011, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 *
 * Based on
 * A JavaScript implementation of the RSA Data Security, Inc. MD5 Message
 * Digest Algorithm, as defined in RFC 1321.
 * Version 2.2 Copyright (C) Paul Johnston 1999 - 2009
 * Other contributors: Greg Holt, Andrew Kepert, Ydnar, Lostinet
 * Distributed under the BSD License
 * See http://pajhome.org.uk/crypt/md5 for more info.
 */
function md5(bytes) {
  if (typeof bytes === 'string') {
    var msg = unescape(encodeURIComponent(bytes)); // UTF8 escape

    bytes = new Uint8Array(msg.length);

    for (var i = 0; i < msg.length; ++i) {
      bytes[i] = msg.charCodeAt(i);
    }
  }

  return md5ToHexEncodedArray(wordsToMd5(bytesToWords(bytes), bytes.length * 8));
}
/*
 * Convert an array of little-endian words to an array of bytes
 */


function md5ToHexEncodedArray(input) {
  var output = [];
  var length32 = input.length * 32;
  var hexTab = '0123456789abcdef';

  for (var i = 0; i < length32; i += 8) {
    var x = input[i >> 5] >>> i % 32 & 0xff;
    var hex = parseInt(hexTab.charAt(x >>> 4 & 0x0f) + hexTab.charAt(x & 0x0f), 16);
    output.push(hex);
  }

  return output;
}
/**
 * Calculate output length with padding and bit length
 */


function getOutputLength(inputLength8) {
  return (inputLength8 + 64 >>> 9 << 4) + 14 + 1;
}
/*
 * Calculate the MD5 of an array of little-endian words, and a bit length.
 */


function wordsToMd5(x, len) {
  /* append padding */
  x[len >> 5] |= 0x80 << len % 32;
  x[getOutputLength(len) - 1] = len;
  var a = 1732584193;
  var b = -271733879;
  var c = -1732584194;
  var d = 271733878;

  for (var i = 0; i < x.length; i += 16) {
    var olda = a;
    var oldb = b;
    var oldc = c;
    var oldd = d;
    a = md5ff(a, b, c, d, x[i], 7, -680876936);
    d = md5ff(d, a, b, c, x[i + 1], 12, -389564586);
    c = md5ff(c, d, a, b, x[i + 2], 17, 606105819);
    b = md5ff(b, c, d, a, x[i + 3], 22, -1044525330);
    a = md5ff(a, b, c, d, x[i + 4], 7, -176418897);
    d = md5ff(d, a, b, c, x[i + 5], 12, 1200080426);
    c = md5ff(c, d, a, b, x[i + 6], 17, -1473231341);
    b = md5ff(b, c, d, a, x[i + 7], 22, -45705983);
    a = md5ff(a, b, c, d, x[i + 8], 7, 1770035416);
    d = md5ff(d, a, b, c, x[i + 9], 12, -1958414417);
    c = md5ff(c, d, a, b, x[i + 10], 17, -42063);
    b = md5ff(b, c, d, a, x[i + 11], 22, -1990404162);
    a = md5ff(a, b, c, d, x[i + 12], 7, 1804603682);
    d = md5ff(d, a, b, c, x[i + 13], 12, -40341101);
    c = md5ff(c, d, a, b, x[i + 14], 17, -1502002290);
    b = md5ff(b, c, d, a, x[i + 15], 22, 1236535329);
    a = md5gg(a, b, c, d, x[i + 1], 5, -165796510);
    d = md5gg(d, a, b, c, x[i + 6], 9, -1069501632);
    c = md5gg(c, d, a, b, x[i + 11], 14, 643717713);
    b = md5gg(b, c, d, a, x[i], 20, -373897302);
    a = md5gg(a, b, c, d, x[i + 5], 5, -701558691);
    d = md5gg(d, a, b, c, x[i + 10], 9, 38016083);
    c = md5gg(c, d, a, b, x[i + 15], 14, -660478335);
    b = md5gg(b, c, d, a, x[i + 4], 20, -405537848);
    a = md5gg(a, b, c, d, x[i + 9], 5, 568446438);
    d = md5gg(d, a, b, c, x[i + 14], 9, -1019803690);
    c = md5gg(c, d, a, b, x[i + 3], 14, -187363961);
    b = md5gg(b, c, d, a, x[i + 8], 20, 1163531501);
    a = md5gg(a, b, c, d, x[i + 13], 5, -1444681467);
    d = md5gg(d, a, b, c, x[i + 2], 9, -51403784);
    c = md5gg(c, d, a, b, x[i + 7], 14, 1735328473);
    b = md5gg(b, c, d, a, x[i + 12], 20, -1926607734);
    a = md5hh(a, b, c, d, x[i + 5], 4, -378558);
    d = md5hh(d, a, b, c, x[i + 8], 11, -2022574463);
    c = md5hh(c, d, a, b, x[i + 11], 16, 1839030562);
    b = md5hh(b, c, d, a, x[i + 14], 23, -35309556);
    a = md5hh(a, b, c, d, x[i + 1], 4, -1530992060);
    d = md5hh(d, a, b, c, x[i + 4], 11, 1272893353);
    c = md5hh(c, d, a, b, x[i + 7], 16, -155497632);
    b = md5hh(b, c, d, a, x[i + 10], 23, -1094730640);
    a = md5hh(a, b, c, d, x[i + 13], 4, 681279174);
    d = md5hh(d, a, b, c, x[i], 11, -358537222);
    c = md5hh(c, d, a, b, x[i + 3], 16, -722521979);
    b = md5hh(b, c, d, a, x[i + 6], 23, 76029189);
    a = md5hh(a, b, c, d, x[i + 9], 4, -640364487);
    d = md5hh(d, a, b, c, x[i + 12], 11, -421815835);
    c = md5hh(c, d, a, b, x[i + 15], 16, 530742520);
    b = md5hh(b, c, d, a, x[i + 2], 23, -995338651);
    a = md5ii(a, b, c, d, x[i], 6, -198630844);
    d = md5ii(d, a, b, c, x[i + 7], 10, 1126891415);
    c = md5ii(c, d, a, b, x[i + 14], 15, -1416354905);
    b = md5ii(b, c, d, a, x[i + 5], 21, -57434055);
    a = md5ii(a, b, c, d, x[i + 12], 6, 1700485571);
    d = md5ii(d, a, b, c, x[i + 3], 10, -1894986606);
    c = md5ii(c, d, a, b, x[i + 10], 15, -1051523);
    b = md5ii(b, c, d, a, x[i + 1], 21, -2054922799);
    a = md5ii(a, b, c, d, x[i + 8], 6, 1873313359);
    d = md5ii(d, a, b, c, x[i + 15], 10, -30611744);
    c = md5ii(c, d, a, b, x[i + 6], 15, -1560198380);
    b = md5ii(b, c, d, a, x[i + 13], 21, 1309151649);
    a = md5ii(a, b, c, d, x[i + 4], 6, -145523070);
    d = md5ii(d, a, b, c, x[i + 11], 10, -1120210379);
    c = md5ii(c, d, a, b, x[i + 2], 15, 718787259);
    b = md5ii(b, c, d, a, x[i + 9], 21, -343485551);
    a = safeAdd(a, olda);
    b = safeAdd(b, oldb);
    c = safeAdd(c, oldc);
    d = safeAdd(d, oldd);
  }

  return [a, b, c, d];
}
/*
 * Convert an array bytes to an array of little-endian words
 * Characters >255 have their high-byte silently ignored.
 */


function bytesToWords(input) {
  if (input.length === 0) {
    return [];
  }

  var length8 = input.length * 8;
  var output = new Uint32Array(getOutputLength(length8));

  for (var i = 0; i < length8; i += 8) {
    output[i >> 5] |= (input[i / 8] & 0xff) << i % 32;
  }

  return output;
}
/*
 * Add integers, wrapping at 2^32. This uses 16-bit operations internally
 * to work around bugs in some JS interpreters.
 */


function safeAdd(x, y) {
  var lsw = (x & 0xffff) + (y & 0xffff);
  var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
  return msw << 16 | lsw & 0xffff;
}
/*
 * Bitwise rotate a 32-bit number to the left.
 */


function bitRotateLeft(num, cnt) {
  return num << cnt | num >>> 32 - cnt;
}
/*
 * These functions implement the four basic operations the algorithm uses.
 */


function md5cmn(q, a, b, x, s, t) {
  return safeAdd(bitRotateLeft(safeAdd(safeAdd(a, q), safeAdd(x, t)), s), b);
}

function md5ff(a, b, c, d, x, s, t) {
  return md5cmn(b & c | ~b & d, a, b, x, s, t);
}

function md5gg(a, b, c, d, x, s, t) {
  return md5cmn(b & d | c & ~d, a, b, x, s, t);
}

function md5hh(a, b, c, d, x, s, t) {
  return md5cmn(b ^ c ^ d, a, b, x, s, t);
}

function md5ii(a, b, c, d, x, s, t) {
  return md5cmn(c ^ (b | ~d), a, b, x, s, t);
}

/* harmony default export */ __webpack_exports__["default"] = (md5);

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/nil.js":
/*!************************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/nil.js ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ('00000000-0000-0000-0000-000000000000');

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/parse.js":
/*!**************************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/parse.js ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _validate_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./validate.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/validate.js");


function parse(uuid) {
  if (!Object(_validate_js__WEBPACK_IMPORTED_MODULE_0__["default"])(uuid)) {
    throw TypeError('Invalid UUID');
  }

  var v;
  var arr = new Uint8Array(16); // Parse ########-....-....-....-............

  arr[0] = (v = parseInt(uuid.slice(0, 8), 16)) >>> 24;
  arr[1] = v >>> 16 & 0xff;
  arr[2] = v >>> 8 & 0xff;
  arr[3] = v & 0xff; // Parse ........-####-....-....-............

  arr[4] = (v = parseInt(uuid.slice(9, 13), 16)) >>> 8;
  arr[5] = v & 0xff; // Parse ........-....-####-....-............

  arr[6] = (v = parseInt(uuid.slice(14, 18), 16)) >>> 8;
  arr[7] = v & 0xff; // Parse ........-....-....-####-............

  arr[8] = (v = parseInt(uuid.slice(19, 23), 16)) >>> 8;
  arr[9] = v & 0xff; // Parse ........-....-....-....-############
  // (Use "/" to avoid 32-bit truncation when bit-shifting high-order bytes)

  arr[10] = (v = parseInt(uuid.slice(24, 36), 16)) / 0x10000000000 & 0xff;
  arr[11] = v / 0x100000000 & 0xff;
  arr[12] = v >>> 24 & 0xff;
  arr[13] = v >>> 16 & 0xff;
  arr[14] = v >>> 8 & 0xff;
  arr[15] = v & 0xff;
  return arr;
}

/* harmony default export */ __webpack_exports__["default"] = (parse);

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/regex.js":
/*!**************************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/regex.js ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = (/^(?:[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}|00000000-0000-0000-0000-000000000000)$/i);

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/rng.js":
/*!************************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/rng.js ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return rng; });
// Unique ID creation requires a high quality random # generator. In the browser we therefore
// require the crypto API and do not support built-in fallback to lower quality random number
// generators (like Math.random()).
// getRandomValues needs to be invoked in a context where "this" is a Crypto implementation. Also,
// find the complete implementation of crypto (msCrypto) on IE11.
var getRandomValues = typeof crypto !== 'undefined' && crypto.getRandomValues && crypto.getRandomValues.bind(crypto) || typeof msCrypto !== 'undefined' && typeof msCrypto.getRandomValues === 'function' && msCrypto.getRandomValues.bind(msCrypto);
var rnds8 = new Uint8Array(16);
function rng() {
  if (!getRandomValues) {
    throw new Error('crypto.getRandomValues() not supported. See https://github.com/uuidjs/uuid#getrandomvalues-not-supported');
  }

  return getRandomValues(rnds8);
}

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/sha1.js":
/*!*************************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/sha1.js ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// Adapted from Chris Veness' SHA1 code at
// http://www.movable-type.co.uk/scripts/sha1.html
function f(s, x, y, z) {
  switch (s) {
    case 0:
      return x & y ^ ~x & z;

    case 1:
      return x ^ y ^ z;

    case 2:
      return x & y ^ x & z ^ y & z;

    case 3:
      return x ^ y ^ z;
  }
}

function ROTL(x, n) {
  return x << n | x >>> 32 - n;
}

function sha1(bytes) {
  var K = [0x5a827999, 0x6ed9eba1, 0x8f1bbcdc, 0xca62c1d6];
  var H = [0x67452301, 0xefcdab89, 0x98badcfe, 0x10325476, 0xc3d2e1f0];

  if (typeof bytes === 'string') {
    var msg = unescape(encodeURIComponent(bytes)); // UTF8 escape

    bytes = [];

    for (var i = 0; i < msg.length; ++i) {
      bytes.push(msg.charCodeAt(i));
    }
  } else if (!Array.isArray(bytes)) {
    // Convert Array-like to Array
    bytes = Array.prototype.slice.call(bytes);
  }

  bytes.push(0x80);
  var l = bytes.length / 4 + 2;
  var N = Math.ceil(l / 16);
  var M = new Array(N);

  for (var _i = 0; _i < N; ++_i) {
    var arr = new Uint32Array(16);

    for (var j = 0; j < 16; ++j) {
      arr[j] = bytes[_i * 64 + j * 4] << 24 | bytes[_i * 64 + j * 4 + 1] << 16 | bytes[_i * 64 + j * 4 + 2] << 8 | bytes[_i * 64 + j * 4 + 3];
    }

    M[_i] = arr;
  }

  M[N - 1][14] = (bytes.length - 1) * 8 / Math.pow(2, 32);
  M[N - 1][14] = Math.floor(M[N - 1][14]);
  M[N - 1][15] = (bytes.length - 1) * 8 & 0xffffffff;

  for (var _i2 = 0; _i2 < N; ++_i2) {
    var W = new Uint32Array(80);

    for (var t = 0; t < 16; ++t) {
      W[t] = M[_i2][t];
    }

    for (var _t = 16; _t < 80; ++_t) {
      W[_t] = ROTL(W[_t - 3] ^ W[_t - 8] ^ W[_t - 14] ^ W[_t - 16], 1);
    }

    var a = H[0];
    var b = H[1];
    var c = H[2];
    var d = H[3];
    var e = H[4];

    for (var _t2 = 0; _t2 < 80; ++_t2) {
      var s = Math.floor(_t2 / 20);
      var T = ROTL(a, 5) + f(s, b, c, d) + e + K[s] + W[_t2] >>> 0;
      e = d;
      d = c;
      c = ROTL(b, 30) >>> 0;
      b = a;
      a = T;
    }

    H[0] = H[0] + a >>> 0;
    H[1] = H[1] + b >>> 0;
    H[2] = H[2] + c >>> 0;
    H[3] = H[3] + d >>> 0;
    H[4] = H[4] + e >>> 0;
  }

  return [H[0] >> 24 & 0xff, H[0] >> 16 & 0xff, H[0] >> 8 & 0xff, H[0] & 0xff, H[1] >> 24 & 0xff, H[1] >> 16 & 0xff, H[1] >> 8 & 0xff, H[1] & 0xff, H[2] >> 24 & 0xff, H[2] >> 16 & 0xff, H[2] >> 8 & 0xff, H[2] & 0xff, H[3] >> 24 & 0xff, H[3] >> 16 & 0xff, H[3] >> 8 & 0xff, H[3] & 0xff, H[4] >> 24 & 0xff, H[4] >> 16 & 0xff, H[4] >> 8 & 0xff, H[4] & 0xff];
}

/* harmony default export */ __webpack_exports__["default"] = (sha1);

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/stringify.js":
/*!******************************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/stringify.js ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _validate_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./validate.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/validate.js");

/**
 * Convert array of 16 byte values to UUID string format of the form:
 * XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
 */

var byteToHex = [];

for (var i = 0; i < 256; ++i) {
  byteToHex.push((i + 0x100).toString(16).substr(1));
}

function stringify(arr) {
  var offset = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
  // Note: Be careful editing this code!  It's been tuned for performance
  // and works in ways you may not expect. See https://github.com/uuidjs/uuid/pull/434
  var uuid = (byteToHex[arr[offset + 0]] + byteToHex[arr[offset + 1]] + byteToHex[arr[offset + 2]] + byteToHex[arr[offset + 3]] + '-' + byteToHex[arr[offset + 4]] + byteToHex[arr[offset + 5]] + '-' + byteToHex[arr[offset + 6]] + byteToHex[arr[offset + 7]] + '-' + byteToHex[arr[offset + 8]] + byteToHex[arr[offset + 9]] + '-' + byteToHex[arr[offset + 10]] + byteToHex[arr[offset + 11]] + byteToHex[arr[offset + 12]] + byteToHex[arr[offset + 13]] + byteToHex[arr[offset + 14]] + byteToHex[arr[offset + 15]]).toLowerCase(); // Consistency check for valid UUID.  If this throws, it's likely due to one
  // of the following:
  // - One or more input array values don't map to a hex octet (leading to
  // "undefined" in the uuid)
  // - Invalid input values for the RFC `version` or `variant` fields

  if (!Object(_validate_js__WEBPACK_IMPORTED_MODULE_0__["default"])(uuid)) {
    throw TypeError('Stringified UUID is invalid');
  }

  return uuid;
}

/* harmony default export */ __webpack_exports__["default"] = (stringify);

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v1.js":
/*!***********************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v1.js ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _rng_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./rng.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/rng.js");
/* harmony import */ var _stringify_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./stringify.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/stringify.js");

 // **`v1()` - Generate time-based UUID**
//
// Inspired by https://github.com/LiosK/UUID.js
// and http://docs.python.org/library/uuid.html

var _nodeId;

var _clockseq; // Previous uuid creation time


var _lastMSecs = 0;
var _lastNSecs = 0; // See https://github.com/uuidjs/uuid for API details

function v1(options, buf, offset) {
  var i = buf && offset || 0;
  var b = buf || new Array(16);
  options = options || {};
  var node = options.node || _nodeId;
  var clockseq = options.clockseq !== undefined ? options.clockseq : _clockseq; // node and clockseq need to be initialized to random values if they're not
  // specified.  We do this lazily to minimize issues related to insufficient
  // system entropy.  See #189

  if (node == null || clockseq == null) {
    var seedBytes = options.random || (options.rng || _rng_js__WEBPACK_IMPORTED_MODULE_0__["default"])();

    if (node == null) {
      // Per 4.5, create and 48-bit node id, (47 random bits + multicast bit = 1)
      node = _nodeId = [seedBytes[0] | 0x01, seedBytes[1], seedBytes[2], seedBytes[3], seedBytes[4], seedBytes[5]];
    }

    if (clockseq == null) {
      // Per 4.2.2, randomize (14 bit) clockseq
      clockseq = _clockseq = (seedBytes[6] << 8 | seedBytes[7]) & 0x3fff;
    }
  } // UUID timestamps are 100 nano-second units since the Gregorian epoch,
  // (1582-10-15 00:00).  JSNumbers aren't precise enough for this, so
  // time is handled internally as 'msecs' (integer milliseconds) and 'nsecs'
  // (100-nanoseconds offset from msecs) since unix epoch, 1970-01-01 00:00.


  var msecs = options.msecs !== undefined ? options.msecs : Date.now(); // Per 4.2.1.2, use count of uuid's generated during the current clock
  // cycle to simulate higher resolution clock

  var nsecs = options.nsecs !== undefined ? options.nsecs : _lastNSecs + 1; // Time since last uuid creation (in msecs)

  var dt = msecs - _lastMSecs + (nsecs - _lastNSecs) / 10000; // Per 4.2.1.2, Bump clockseq on clock regression

  if (dt < 0 && options.clockseq === undefined) {
    clockseq = clockseq + 1 & 0x3fff;
  } // Reset nsecs if clock regresses (new clockseq) or we've moved onto a new
  // time interval


  if ((dt < 0 || msecs > _lastMSecs) && options.nsecs === undefined) {
    nsecs = 0;
  } // Per 4.2.1.2 Throw error if too many uuids are requested


  if (nsecs >= 10000) {
    throw new Error("uuid.v1(): Can't create more than 10M uuids/sec");
  }

  _lastMSecs = msecs;
  _lastNSecs = nsecs;
  _clockseq = clockseq; // Per 4.1.4 - Convert from unix epoch to Gregorian epoch

  msecs += 12219292800000; // `time_low`

  var tl = ((msecs & 0xfffffff) * 10000 + nsecs) % 0x100000000;
  b[i++] = tl >>> 24 & 0xff;
  b[i++] = tl >>> 16 & 0xff;
  b[i++] = tl >>> 8 & 0xff;
  b[i++] = tl & 0xff; // `time_mid`

  var tmh = msecs / 0x100000000 * 10000 & 0xfffffff;
  b[i++] = tmh >>> 8 & 0xff;
  b[i++] = tmh & 0xff; // `time_high_and_version`

  b[i++] = tmh >>> 24 & 0xf | 0x10; // include version

  b[i++] = tmh >>> 16 & 0xff; // `clock_seq_hi_and_reserved` (Per 4.2.2 - include variant)

  b[i++] = clockseq >>> 8 | 0x80; // `clock_seq_low`

  b[i++] = clockseq & 0xff; // `node`

  for (var n = 0; n < 6; ++n) {
    b[i + n] = node[n];
  }

  return buf || Object(_stringify_js__WEBPACK_IMPORTED_MODULE_1__["default"])(b);
}

/* harmony default export */ __webpack_exports__["default"] = (v1);

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v3.js":
/*!***********************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v3.js ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _v35_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./v35.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v35.js");
/* harmony import */ var _md5_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./md5.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/md5.js");


var v3 = Object(_v35_js__WEBPACK_IMPORTED_MODULE_0__["default"])('v3', 0x30, _md5_js__WEBPACK_IMPORTED_MODULE_1__["default"]);
/* harmony default export */ __webpack_exports__["default"] = (v3);

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v35.js":
/*!************************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v35.js ***!
  \************************************************************************************/
/*! exports provided: DNS, URL, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "DNS", function() { return DNS; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "URL", function() { return URL; });
/* harmony import */ var _stringify_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./stringify.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/stringify.js");
/* harmony import */ var _parse_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./parse.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/parse.js");



function stringToBytes(str) {
  str = unescape(encodeURIComponent(str)); // UTF8 escape

  var bytes = [];

  for (var i = 0; i < str.length; ++i) {
    bytes.push(str.charCodeAt(i));
  }

  return bytes;
}

var DNS = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';
var URL = '6ba7b811-9dad-11d1-80b4-00c04fd430c8';
/* harmony default export */ __webpack_exports__["default"] = (function (name, version, hashfunc) {
  function generateUUID(value, namespace, buf, offset) {
    if (typeof value === 'string') {
      value = stringToBytes(value);
    }

    if (typeof namespace === 'string') {
      namespace = Object(_parse_js__WEBPACK_IMPORTED_MODULE_1__["default"])(namespace);
    }

    if (namespace.length !== 16) {
      throw TypeError('Namespace must be array-like (16 iterable integer values, 0-255)');
    } // Compute hash of namespace and value, Per 4.3
    // Future: Use spread syntax when supported on all platforms, e.g. `bytes =
    // hashfunc([...namespace, ... value])`


    var bytes = new Uint8Array(16 + value.length);
    bytes.set(namespace);
    bytes.set(value, namespace.length);
    bytes = hashfunc(bytes);
    bytes[6] = bytes[6] & 0x0f | version;
    bytes[8] = bytes[8] & 0x3f | 0x80;

    if (buf) {
      offset = offset || 0;

      for (var i = 0; i < 16; ++i) {
        buf[offset + i] = bytes[i];
      }

      return buf;
    }

    return Object(_stringify_js__WEBPACK_IMPORTED_MODULE_0__["default"])(bytes);
  } // Function#name is not settable on some platforms (#270)


  try {
    generateUUID.name = name; // eslint-disable-next-line no-empty
  } catch (err) {} // For CommonJS default export support


  generateUUID.DNS = DNS;
  generateUUID.URL = URL;
  return generateUUID;
});

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v4.js":
/*!***********************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v4.js ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _rng_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./rng.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/rng.js");
/* harmony import */ var _stringify_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./stringify.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/stringify.js");



function v4(options, buf, offset) {
  options = options || {};
  var rnds = options.random || (options.rng || _rng_js__WEBPACK_IMPORTED_MODULE_0__["default"])(); // Per 4.4, set bits for version and `clock_seq_hi_and_reserved`

  rnds[6] = rnds[6] & 0x0f | 0x40;
  rnds[8] = rnds[8] & 0x3f | 0x80; // Copy bytes to buffer, if provided

  if (buf) {
    offset = offset || 0;

    for (var i = 0; i < 16; ++i) {
      buf[offset + i] = rnds[i];
    }

    return buf;
  }

  return Object(_stringify_js__WEBPACK_IMPORTED_MODULE_1__["default"])(rnds);
}

/* harmony default export */ __webpack_exports__["default"] = (v4);

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v5.js":
/*!***********************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v5.js ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _v35_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./v35.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/v35.js");
/* harmony import */ var _sha1_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./sha1.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/sha1.js");


var v5 = Object(_v35_js__WEBPACK_IMPORTED_MODULE_0__["default"])('v5', 0x50, _sha1_js__WEBPACK_IMPORTED_MODULE_1__["default"]);
/* harmony default export */ __webpack_exports__["default"] = (v5);

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/validate.js":
/*!*****************************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/validate.js ***!
  \*****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _regex_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./regex.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/regex.js");


function validate(uuid) {
  return typeof uuid === 'string' && _regex_js__WEBPACK_IMPORTED_MODULE_0__["default"].test(uuid);
}

/* harmony default export */ __webpack_exports__["default"] = (validate);

/***/ }),

/***/ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/version.js":
/*!****************************************************************************************!*\
  !*** ./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/version.js ***!
  \****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _validate_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./validate.js */ "./node_modules/@giphy/js-analytics/node_modules/uuid/dist/esm-browser/validate.js");


function version(uuid) {
  if (!Object(_validate_js__WEBPACK_IMPORTED_MODULE_0__["default"])(uuid)) {
    throw TypeError('Invalid UUID');
  }

  return parseInt(uuid.substr(14, 1), 16);
}

/* harmony default export */ __webpack_exports__["default"] = (version);

/***/ }),

/***/ "./node_modules/@giphy/js-brand/dist/colors.js":
/*!*****************************************************!*\
  !*** ./node_modules/@giphy/js-brand/dist/colors.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
exports.gifOverlayColor = exports.dimColor = exports.secondaryCTA = exports.primaryCTADisabled = exports.primaryCTA = exports.deleteColor = exports.errorColor = exports.smsColor = exports.redditColor = exports.instagramColor = exports.tumblrColor = exports.pinterestColor = exports.twitterColor = exports.facebookColor = exports.giphyPink = exports.giphyIndigo = exports.giphyLightBlue = exports.giphyAqua = exports.giphyYellow = exports.giphyRed = exports.giphyPurple = exports.giphyGreen = exports.giphyBlue = exports.giphyWhite = exports.giphyWhiteSmoke = exports.giphyLightestGrey = exports.giphyLightGrey = exports.giphyLightCharcoal = exports.giphyCharcoal = exports.giphyDarkCharcoal = exports.giphyDarkGrey = exports.giphyDarkestGrey = exports.giphyBlack = void 0;
/* greys */
exports.giphyBlack = '#121212';
exports.giphyDarkestGrey = '#212121';
exports.giphyDarkGrey = '#2e2e2e';
exports.giphyDarkCharcoal = '#3e3e3e';
exports.giphyCharcoal = '#4a4a4a';
exports.giphyLightCharcoal = '#5c5c5c';
exports.giphyLightGrey = '#a6a6a6';
exports.giphyLightestGrey = '#d8d8d8';
exports.giphyWhiteSmoke = '#ececec';
exports.giphyWhite = '#ffffff';
/* primary */
exports.giphyBlue = '#00ccff';
exports.giphyGreen = '#00ff99';
exports.giphyPurple = '#9933ff';
exports.giphyRed = '#ff6666';
exports.giphyYellow = '#fff35c';
/* secondary */
exports.giphyAqua = '#00e6cc';
exports.giphyLightBlue = '#3191ff';
exports.giphyIndigo = '#6157ff';
exports.giphyPink = '#e646b6';
/* social */
exports.facebookColor = '#3894fc';
exports.twitterColor = '#00ccff';
exports.pinterestColor = '#e54cb5';
exports.tumblrColor = '#529ecc';
exports.instagramColor = '#c23c8d';
exports.redditColor = '#fc6669';
exports.smsColor = '#00ff99';
/* functional */
exports.errorColor = exports.giphyRed;
exports.deleteColor = exports.giphyRed;
exports.primaryCTA = exports.giphyIndigo;
exports.primaryCTADisabled = '#241F74';
exports.secondaryCTA = exports.giphyCharcoal;
exports.dimColor = "rgba(0, 0, 0, 0.8)";
exports.gifOverlayColor = "rgba(0, 0, 0, 0.4)";
//# sourceMappingURL=colors.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-brand/dist/index.js":
/*!****************************************************!*\
  !*** ./node_modules/@giphy/js-brand/dist/index.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    Object.defineProperty(o, k2, { enumerable: true, get: function() { return m[k]; } });
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __exportStar = (this && this.__exportStar) || function(m, exports) {
    for (var p in m) if (p !== "default" && !exports.hasOwnProperty(p)) __createBinding(exports, m, p);
};
Object.defineProperty(exports, "__esModule", { value: true });
__exportStar(__webpack_require__(/*! ./colors */ "./node_modules/@giphy/js-brand/dist/colors.js"), exports);
var loader_1 = __webpack_require__(/*! ./loader */ "./node_modules/@giphy/js-brand/dist/loader.js");
Object.defineProperty(exports, "loader", { enumerable: true, get: function () { return loader_1.default; } });
__exportStar(__webpack_require__(/*! ./typography */ "./node_modules/@giphy/js-brand/dist/typography.js"), exports);
//# sourceMappingURL=index.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-brand/dist/loader.js":
/*!*****************************************************!*\
  !*** ./node_modules/@giphy/js-brand/dist/loader.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __makeTemplateObject = (this && this.__makeTemplateObject) || function (cooked, raw) {
    if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
    return cooked;
};
Object.defineProperty(exports, "__esModule", { value: true });
var emotion_1 = __webpack_require__(/*! emotion */ "./node_modules/emotion/dist/emotion.esm.js");
var colors_1 = __webpack_require__(/*! ./colors */ "./node_modules/@giphy/js-brand/dist/colors.js");
var bouncer = emotion_1.keyframes(templateObject_1 || (templateObject_1 = __makeTemplateObject(["\n     to {\n    transform: scale(1.75) translateY(-20px);\n  }\n"], ["\n     to {\n    transform: scale(1.75) translateY(-20px);\n  }\n"])));
var loaderHeight = 37;
var loader = emotion_1.css(templateObject_2 || (templateObject_2 = __makeTemplateObject(["\n    display: flex;\n    align-items: center;\n    height: ", "px;\n    padding-top: 15px;\n    margin: 0 auto;\n    text-align: center;\n    justify-content: center;\n    animation: pulse 0.8s ease-in-out 0s infinite alternate backwards;\n    div {\n        display: inline-block;\n        height: 10px;\n        width: 10px;\n        margin: ", "px 10px 10px 10px;\n        position: relative;\n        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);\n        animation: ", " cubic-bezier(0.455, 0.03, 0.515, 0.955) 0.75s infinite alternate;\n        &:nth-child(5n + 1) {\n            background: ", ";\n            animation-delay: 0;\n        }\n        &:nth-child(5n + 2) {\n            background: ", ";\n            animation-delay: calc(0s + (0.1s * 1));\n        }\n        &:nth-child(5n + 3) {\n            background: ", ";\n            animation-delay: calc(0s + (0.1s * 2));\n        }\n        &:nth-child(5n + 4) {\n            background: ", ";\n            animation-delay: calc(0s + (0.1s * 3));\n        }\n        &:nth-child(5n + 5) {\n            background: ", ";\n            animation-delay: calc(0s + (0.1s * 4));\n        }\n    }\n"], ["\n    display: flex;\n    align-items: center;\n    height: ", "px;\n    padding-top: 15px;\n    margin: 0 auto;\n    text-align: center;\n    justify-content: center;\n    animation: pulse 0.8s ease-in-out 0s infinite alternate backwards;\n    div {\n        display: inline-block;\n        height: 10px;\n        width: 10px;\n        margin: ", "px 10px 10px 10px;\n        position: relative;\n        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);\n        animation: ", " cubic-bezier(0.455, 0.03, 0.515, 0.955) 0.75s infinite alternate;\n        &:nth-child(5n + 1) {\n            background: ", ";\n            animation-delay: 0;\n        }\n        &:nth-child(5n + 2) {\n            background: ", ";\n            animation-delay: calc(0s + (0.1s * 1));\n        }\n        &:nth-child(5n + 3) {\n            background: ", ";\n            animation-delay: calc(0s + (0.1s * 2));\n        }\n        &:nth-child(5n + 4) {\n            background: ", ";\n            animation-delay: calc(0s + (0.1s * 3));\n        }\n        &:nth-child(5n + 5) {\n            background: ", ";\n            animation-delay: calc(0s + (0.1s * 4));\n        }\n    }\n"])), loaderHeight, loaderHeight, bouncer, colors_1.giphyGreen, colors_1.giphyBlue, colors_1.giphyPurple, colors_1.giphyRed, colors_1.giphyYellow);
exports.default = loader;
var templateObject_1, templateObject_2;
//# sourceMappingURL=loader.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-brand/dist/typography.js":
/*!*********************************************************!*\
  !*** ./node_modules/@giphy/js-brand/dist/typography.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __makeTemplateObject = (this && this.__makeTemplateObject) || function (cooked, raw) {
    if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
    return cooked;
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.css = exports.fontSize = exports.fontFamily = void 0;
var emotion_1 = __webpack_require__(/*! emotion */ "./node_modules/emotion/dist/emotion.esm.js");
// eslint-disable-next-line
emotion_1.injectGlobal(templateObject_1 || (templateObject_1 = __makeTemplateObject(["\n@font-face {\n    font-family: 'interface';\n    font-style: normal;\n    font-weight: normal;\n    src: url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/InterFace_W_Rg.woff2') format('woff2'),\n        url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/InterFace_W_Rg.woff') format('woff');\n}\n\n@font-face {\n    font-family: 'interface';\n    font-style: normal;\n    font-weight: bold;\n    src: url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/InterFace_W_Bd.woff2') format('woff2'),\n        url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/InterFace_W_Bd.woff') format('woff');\n}\n@font-face {\n    font-family: 'interface';\n    font-style: normal;\n    font-weight: 900;\n    src: url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/InterFace_W_XBd.woff') format('woff');\n}\n@font-face {\n    font-family: 'nexablack'; \n    font-style: normal;\n    font-weight: normal;\n    src: url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/nexa_black-webfont.woff2') format('woff2'),\n        url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/nexa_black-webfont.woff') format('woff');\n}\n@font-face {\n    font-family: 'SSStandard'; \n    font-style: normal;\n    font-weight: normal;\n    src:  url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/ss-standard.woff') format('woff');\n}\n@font-face {\n    font-family: 'SSSocial'; \n    font-style: normal;\n    font-weight: normal;\n    src:  url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/ss-social.woff') format('woff');\n}\n"], ["\n@font-face {\n    font-family: 'interface';\n    font-style: normal;\n    font-weight: normal;\n    src: url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/InterFace_W_Rg.woff2') format('woff2'),\n        url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/InterFace_W_Rg.woff') format('woff');\n}\n\n@font-face {\n    font-family: 'interface';\n    font-style: normal;\n    font-weight: bold;\n    src: url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/InterFace_W_Bd.woff2') format('woff2'),\n        url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/InterFace_W_Bd.woff') format('woff');\n}\n@font-face {\n    font-family: 'interface';\n    font-style: normal;\n    font-weight: 900;\n    src: url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/InterFace_W_XBd.woff') format('woff');\n}\n@font-face {\n    font-family: 'nexablack'; \n    font-style: normal;\n    font-weight: normal;\n    src: url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/nexa_black-webfont.woff2') format('woff2'),\n        url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/nexa_black-webfont.woff') format('woff');\n}\n@font-face {\n    font-family: 'SSStandard'; \n    font-style: normal;\n    font-weight: normal;\n    src:  url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/ss-standard.woff') format('woff');\n}\n@font-face {\n    font-family: 'SSSocial'; \n    font-style: normal;\n    font-weight: normal;\n    src:  url('https://s3.amazonaws.com/giphyscripts/react-giphy-brand/fonts/ss-social.woff') format('woff');\n}\n"])));
exports.fontFamily = {
    title: "'nexablack', sans-serif",
    body: 'interface, Helvetica Neue, helvetica, sans-serif;',
};
exports.fontSize = {
    titleSmall: '20px',
    title: '26px',
    titleLarge: '36px',
    subheader: '16px',
    subheaderSmall: '12px',
};
var sharedTitle = emotion_1.css(templateObject_2 || (templateObject_2 = __makeTemplateObject(["\n    font-family: ", ";\n    -webkit-font-smoothing: antialiased;\n"], ["\n    font-family: ", ";\n    -webkit-font-smoothing: antialiased;\n"])), exports.fontFamily.title);
var title = emotion_1.cx(emotion_1.css(templateObject_3 || (templateObject_3 = __makeTemplateObject(["\n        font-size: ", ";\n    "], ["\n        font-size: ", ";\n    "])), exports.fontSize.title), sharedTitle);
var titleLarge = emotion_1.cx(emotion_1.css(templateObject_4 || (templateObject_4 = __makeTemplateObject(["\n        font-size: ", ";\n    "], ["\n        font-size: ", ";\n    "])), exports.fontSize.titleLarge), sharedTitle);
var titleSmall = emotion_1.cx(emotion_1.css(templateObject_5 || (templateObject_5 = __makeTemplateObject(["\n        font-size: ", ";\n    "], ["\n        font-size: ", ";\n    "])), exports.fontSize.titleSmall), sharedTitle);
var sharedSubheader = emotion_1.css(templateObject_6 || (templateObject_6 = __makeTemplateObject(["\n    font-family: ", ";\n    font-weight: bold;\n    -webkit-font-smoothing: antialiased;\n"], ["\n    font-family: ", ";\n    font-weight: bold;\n    -webkit-font-smoothing: antialiased;\n"])), exports.fontFamily.body);
var subheader = emotion_1.cx(emotion_1.css(templateObject_7 || (templateObject_7 = __makeTemplateObject(["\n        font-size: ", ";\n    "], ["\n        font-size: ", ";\n    "])), exports.fontSize.subheader), sharedSubheader);
var subheaderSmall = emotion_1.cx(emotion_1.css(templateObject_8 || (templateObject_8 = __makeTemplateObject(["\n        font-size: ", ";\n    "], ["\n        font-size: ", ";\n    "])), exports.fontSize.subheaderSmall), sharedSubheader);
var sectionHeader = emotion_1.css(templateObject_9 || (templateObject_9 = __makeTemplateObject(["\n    font-family: ", ";\n    font-size: 14px;\n    font-weight: bold;\n    text-transform: uppercase;\n    -webkit-font-smoothing: antialiased;\n"], ["\n    font-family: ", ";\n    font-size: 14px;\n    font-weight: bold;\n    text-transform: uppercase;\n    -webkit-font-smoothing: antialiased;\n"])), exports.fontFamily.body);
var classNames = {
    sectionHeader: sectionHeader,
    subheaderSmall: subheaderSmall,
    subheader: subheader,
    titleLarge: titleLarge,
    titleSmall: titleSmall,
    title: title,
};
exports.css = classNames;
var templateObject_1, templateObject_2, templateObject_3, templateObject_4, templateObject_5, templateObject_6, templateObject_7, templateObject_8, templateObject_9;
//# sourceMappingURL=typography.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/dist/components/attribution/avatar.js":
/*!*********************************************************************************!*\
  !*** ./node_modules/@giphy/js-components/dist/components/attribution/avatar.js ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __makeTemplateObject = (this && this.__makeTemplateObject) || function (cooked, raw) {
    if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
    return cooked;
};
Object.defineProperty(exports, "__esModule", { value: true });
var emotion_1 = __webpack_require__(/*! emotion */ "./node_modules/emotion/dist/emotion.esm.js");
var preact_1 = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
var hooks_1 = __webpack_require__(/*! preact/hooks */ "./node_modules/preact/hooks/dist/hooks.module.js");
var getSmallAvatar = function (avatar) {
    var _a, _b;
    if (!avatar)
        return '';
    var ext = (_b = (_a = avatar === null || avatar === void 0 ? void 0 : avatar.split('.')) === null || _a === void 0 ? void 0 : _a.pop()) === null || _b === void 0 ? void 0 : _b.toLowerCase();
    return avatar.replace("." + ext, "/80h." + ext);
};
var avatarCss = emotion_1.css(templateObject_1 || (templateObject_1 = __makeTemplateObject(["\n    object-fit: cover;\n    width: 32px;\n    height: 32px;\n    margin-right: 8px;\n"], ["\n    object-fit: cover;\n    width: 32px;\n    height: 32px;\n    margin-right: 8px;\n"])));
var Avatar = function (_a) {
    var user = _a.user, _b = _a.className, className = _b === void 0 ? '' : _b;
    var defaultAvatarId = hooks_1.useRef(Math.floor(Math.random() * 5) + 1);
    var url = user.avatar_url
        ? getSmallAvatar(user.avatar_url)
        : "https://media.giphy.com/avatars/default" + defaultAvatarId.current + ".gif";
    return preact_1.h("img", { src: url, className: emotion_1.cx(avatarCss, className) });
};
exports.default = Avatar;
var templateObject_1;
//# sourceMappingURL=avatar.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/dist/components/attribution/index.js":
/*!********************************************************************************!*\
  !*** ./node_modules/@giphy/js-components/dist/components/attribution/index.js ***!
  \********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __makeTemplateObject = (this && this.__makeTemplateObject) || function (cooked, raw) {
    if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
    return cooked;
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
var emotion_1 = __webpack_require__(/*! emotion */ "./node_modules/emotion/dist/emotion.esm.js");
var preact_1 = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
var avatar_1 = __importDefault(__webpack_require__(/*! ./avatar */ "./node_modules/@giphy/js-components/dist/components/attribution/avatar.js"));
var verified_badge_1 = __importDefault(__webpack_require__(/*! ./verified-badge */ "./node_modules/@giphy/js-components/dist/components/attribution/verified-badge.js"));
var containerCss = emotion_1.css(templateObject_1 || (templateObject_1 = __makeTemplateObject(["\n    display: flex;\n    align-items: center;\n    font-family: interface, helvetica, arial;\n"], ["\n    display: flex;\n    align-items: center;\n    font-family: interface, helvetica, arial;\n"])));
var avatarCss = emotion_1.css(templateObject_2 || (templateObject_2 = __makeTemplateObject(["\n    flex-shrink: 0;\n"], ["\n    flex-shrink: 0;\n"])));
var userName = emotion_1.css(templateObject_3 || (templateObject_3 = __makeTemplateObject(["\n    color: white;\n    font-size: 17px;\n    font-weight: bold;\n    overflow: hidden;\n    text-overflow: ellipsis;\n    white-space: nowrap;\n    -webkit-font-smoothing: antialiased;\n"], ["\n    color: white;\n    font-size: 17px;\n    font-weight: bold;\n    overflow: hidden;\n    text-overflow: ellipsis;\n    white-space: nowrap;\n    -webkit-font-smoothing: antialiased;\n"])));
var verifiedBadge = emotion_1.css(templateObject_4 || (templateObject_4 = __makeTemplateObject(["\n    margin: 0 4px;\n    flex-shrink: 0;\n"], ["\n    margin: 0 4px;\n    flex-shrink: 0;\n"])));
var Attribution = function (_a) {
    var gif = _a.gif, className = _a.className, onClick = _a.onClick;
    var user = gif.user;
    if (!(user === null || user === void 0 ? void 0 : user.username) && !(user === null || user === void 0 ? void 0 : user.display_name)) {
        return null;
    }
    var display_name = user.display_name, username = user.username;
    return (preact_1.h("div", { className: emotion_1.cx(containerCss, Attribution.className, className), onClick: function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (onClick) {
                onClick(gif);
            }
            else {
                var url = user.profile_url;
                if (url)
                    window.open(url, '_blank');
            }
        } },
        preact_1.h(avatar_1.default, { user: user, className: avatarCss }),
        preact_1.h("div", { className: userName }, display_name || "@" + username),
        user.is_verified ? preact_1.h(verified_badge_1.default, { size: 14, className: verifiedBadge }) : null));
};
Attribution.className = 'giphy-attribution';
exports.default = Attribution;
var templateObject_1, templateObject_2, templateObject_3, templateObject_4;
//# sourceMappingURL=index.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/dist/components/attribution/overlay.js":
/*!**********************************************************************************!*\
  !*** ./node_modules/@giphy/js-components/dist/components/attribution/overlay.js ***!
  \**********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __makeTemplateObject = (this && this.__makeTemplateObject) || function (cooked, raw) {
    if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
    return cooked;
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
var emotion_1 = __webpack_require__(/*! emotion */ "./node_modules/emotion/dist/emotion.esm.js");
var preact_1 = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
var hooks_1 = __webpack_require__(/*! preact/hooks */ "./node_modules/preact/hooks/dist/hooks.module.js");
var _1 = __importDefault(__webpack_require__(/*! . */ "./node_modules/@giphy/js-components/dist/components/attribution/index.js"));
var backgroundCss = emotion_1.css(templateObject_1 || (templateObject_1 = __makeTemplateObject(["\n    background: linear-gradient(rgba(0, 0, 0, 0), rgba(18, 18, 18, 0.6));\n    cursor: default;\n    position: absolute;\n    bottom: 0;\n    left: 0;\n    right: 0;\n    height: 75px;\n    pointer-events: none;\n"], ["\n    background: linear-gradient(rgba(0, 0, 0, 0), rgba(18, 18, 18, 0.6));\n    cursor: default;\n    position: absolute;\n    bottom: 0;\n    left: 0;\n    right: 0;\n    height: 75px;\n    pointer-events: none;\n"])));
var attributionCss = emotion_1.css(templateObject_2 || (templateObject_2 = __makeTemplateObject(["\n    position: absolute;\n    bottom: 10px;\n    left: 10px;\n    right: 10px;\n"], ["\n    position: absolute;\n    bottom: 10px;\n    left: 10px;\n    right: 10px;\n"])));
var containerCss = emotion_1.css(templateObject_3 || (templateObject_3 = __makeTemplateObject(["\n    transition: opacity 150ms ease-in;\n"], ["\n    transition: opacity 150ms ease-in;\n"])));
var AttributionOverlay = function (_a) {
    var gif = _a.gif, isHovered = _a.isHovered, onClick = _a.onClick;
    var hasHovered = hooks_1.useRef(isHovered);
    if (isHovered) {
        // not rendering to avoid loading the avatar until hover
        hasHovered.current = true;
    }
    return gif.user && hasHovered.current ? (preact_1.h("div", { className: containerCss, style: { opacity: isHovered ? 1 : 0 } },
        preact_1.h("div", { className: backgroundCss }),
        preact_1.h(_1.default, { gif: gif, className: attributionCss, onClick: onClick }))) : null;
};
exports.default = AttributionOverlay;
var templateObject_1, templateObject_2, templateObject_3;
//# sourceMappingURL=overlay.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/dist/components/attribution/verified-badge.js":
/*!*****************************************************************************************!*\
  !*** ./node_modules/@giphy/js-components/dist/components/attribution/verified-badge.js ***!
  \*****************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
var emotion_1 = __webpack_require__(/*! emotion */ "./node_modules/emotion/dist/emotion.esm.js");
var preact_1 = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
var VerifiedBadge = function (_a) {
    var _b = _a.className, className = _b === void 0 ? '' : _b, _c = _a.size, size = _c === void 0 ? 17 : _c, _d = _a.fill, fill = _d === void 0 ? '#15CDFF' : _d;
    return (preact_1.h("svg", { className: emotion_1.cx(VerifiedBadge.className, className), height: size, width: "19px", viewBox: "0 0 19 17" },
        preact_1.h("g", { transform: "translate(-532.000000, -466.000000)", fill: fill },
            preact_1.h("g", { transform: "translate(141.000000, 235.000000)" },
                preact_1.h("g", { transform: "translate(264.000000, 0.000000)" },
                    preact_1.h("g", { transform: "translate(10.000000, 224.000000)" },
                        preact_1.h("g", { transform: "translate(114.000000, 2.500000)" },
                            preact_1.h("path", { d: "M15.112432,4.80769231 L16.8814194,6.87556817 L19.4157673,7.90116318 L19.6184416,10.6028916 L21.0594951,12.9065042 L19.6184416,15.2101168 L19.4157673,17.9118452 L16.8814194,18.9374402 L15.112432,21.0053161 L12.4528245,20.3611511 L9.79321699,21.0053161 L8.02422954,18.9374402 L5.48988167,17.9118452 L5.28720734,15.2101168 L3.84615385,12.9065042 L5.28720734,10.6028916 L5.48988167,7.90116318 L8.02422954,6.87556817 L9.79321699,4.80769231 L12.4528245,5.4518573 L15.112432,4.80769231 Z M17.8163503,10.8991009 L15.9282384,9.01098901 L11.5681538,13.3696923 L9.68115218,11.4818515 L7.81302031,13.3499833 L9.7011322,15.2380952 L11.5892441,17.1262071 L17.8163503,10.8991009 Z" }))))))));
};
VerifiedBadge.className = 'giphy-verified-badge';
exports.default = VerifiedBadge;
//# sourceMappingURL=verified-badge.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/dist/components/carousel.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@giphy/js-components/dist/components/carousel.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __makeTemplateObject = (this && this.__makeTemplateObject) || function (cooked, raw) {
    if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
    return cooked;
};
var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
var js_fetch_api_1 = __webpack_require__(/*! @giphy/js-fetch-api */ "./node_modules/@giphy/js-fetch-api/dist/index.js");
var js_util_1 = __webpack_require__(/*! @giphy/js-util */ "./node_modules/@giphy/js-util/dist/index.js");
var emotion_1 = __webpack_require__(/*! emotion */ "./node_modules/emotion/dist/emotion.esm.js");
var preact_1 = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
var throttle_debounce_1 = __webpack_require__(/*! throttle-debounce */ "./node_modules/throttle-debounce/index.umd.js");
var observer_1 = __importDefault(__webpack_require__(/*! ../util/observer */ "./node_modules/@giphy/js-components/dist/util/observer.js"));
var gif_1 = __importDefault(__webpack_require__(/*! ./gif */ "./node_modules/@giphy/js-components/dist/components/gif.js"));
var pingback_context_manager_1 = __importDefault(__webpack_require__(/*! ./pingback-context-manager */ "./node_modules/@giphy/js-components/dist/components/pingback-context-manager.js"));
var carouselCss = emotion_1.css(templateObject_1 || (templateObject_1 = __makeTemplateObject(["\n    -webkit-overflow-scrolling: touch;\n    overflow-x: auto;\n    overflow-y: hidden;\n    white-space: nowrap;\n    position: relative;\n"], ["\n    -webkit-overflow-scrolling: touch;\n    overflow-x: auto;\n    overflow-y: hidden;\n    white-space: nowrap;\n    position: relative;\n"])));
var carouselItemCss = emotion_1.css(templateObject_2 || (templateObject_2 = __makeTemplateObject(["\n    display: inline-block;\n    list-style: none;\n    /* make sure gifs are fully visible with a scrollbar */\n    margin-bottom: 1px;\n    &:first-of-type {\n        margin-left: 0;\n    }\n"], ["\n    display: inline-block;\n    list-style: none;\n    /* make sure gifs are fully visible with a scrollbar */\n    margin-bottom: 1px;\n    &:first-of-type {\n        margin-left: 0;\n    }\n"])));
var loaderContainerCss = emotion_1.css(templateObject_3 || (templateObject_3 = __makeTemplateObject(["\n    display: inline-block;\n"], ["\n    display: inline-block;\n"])));
var loaderCss = emotion_1.css(templateObject_4 || (templateObject_4 = __makeTemplateObject(["\n    width: 30px;\n    display: inline-block;\n"], ["\n    width: 30px;\n    display: inline-block;\n"])));
var defaultProps = Object.freeze({ gutter: 6, user: {} });
var initialState = Object.freeze({
    isFetching: false,
    numberOfGifs: 0,
    gifs: [],
    isLoaderVisible: true,
    isDoneFetching: false,
});
var Carousel = /** @class */ (function (_super) {
    __extends(Carousel, _super);
    function Carousel() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.state = initialState;
        _this.paginator = js_fetch_api_1.gifPaginator(_this.props.fetchGifs);
        _this.onLoaderVisible = function (isVisible) {
            _this.setState({ isLoaderVisible: isVisible }, _this.onFetch);
        };
        _this.onFetch = throttle_debounce_1.debounce(100, function () { return __awaiter(_this, void 0, void 0, function () {
            var _a, isFetching, isLoaderVisible, existingGifs, gifs, error_1, onGifsFetched;
            return __generator(this, function (_b) {
                switch (_b.label) {
                    case 0:
                        _a = this.state, isFetching = _a.isFetching, isLoaderVisible = _a.isLoaderVisible, existingGifs = _a.gifs;
                        if (!(!isFetching && isLoaderVisible)) return [3 /*break*/, 5];
                        this.setState({ isFetching: true });
                        gifs = void 0;
                        _b.label = 1;
                    case 1:
                        _b.trys.push([1, 3, , 4]);
                        return [4 /*yield*/, this.paginator()];
                    case 2:
                        gifs = _b.sent();
                        return [3 /*break*/, 4];
                    case 3:
                        error_1 = _b.sent();
                        this.setState({ isFetching: false });
                        return [3 /*break*/, 4];
                    case 4:
                        if (gifs) {
                            if (existingGifs.length === gifs.length) {
                                this.setState({ isDoneFetching: true });
                            }
                            else {
                                this.setState({ gifs: gifs, isFetching: false });
                                onGifsFetched = this.props.onGifsFetched;
                                if (onGifsFetched)
                                    onGifsFetched(gifs);
                                this.onFetch();
                            }
                        }
                        _b.label = 5;
                    case 5: return [2 /*return*/];
                }
            });
        }); });
        return _this;
    }
    Carousel.prototype.componentDidMount = function () {
        this.onFetch();
    };
    Carousel.prototype.render = function (_a, _b) {
        var fetchGifs = _a.fetchGifs, onGifVisible = _a.onGifVisible, onGifRightClick = _a.onGifRightClick, gifHeight = _a.gifHeight, gutter = _a.gutter, _c = _a.className, className = _c === void 0 ? Carousel.className : _c, onGifClick = _a.onGifClick, onGifHover = _a.onGifHover, onGifSeen = _a.onGifSeen, user = _a.user, noResultsMessage = _a.noResultsMessage, hideAttribution = _a.hideAttribution, noLink = _a.noLink;
        var gifs = _b.gifs;
        var showLoader = fetchGifs && gifs.length > 0;
        var marginCss = emotion_1.css(templateObject_5 || (templateObject_5 = __makeTemplateObject(["\n            margin-left: ", "px;\n        "], ["\n            margin-left: ", "px;\n        "])), gutter);
        var gifHeightCss = emotion_1.css(templateObject_6 || (templateObject_6 = __makeTemplateObject(["\n            height: ", "px;\n        "], ["\n            height: ", "px;\n        "])), gifHeight);
        var containerCss = emotion_1.cx(className, carouselCss);
        var gifCss = emotion_1.cx(carouselItemCss, marginCss);
        return (preact_1.h(pingback_context_manager_1.default, { attributes: [
                {
                    key: 'layout_type',
                    value: 'CAROUSEL',
                },
            ] },
            preact_1.h("div", { class: containerCss },
                gifs.map(function (gif) {
                    var gifWidth = js_util_1.getGifWidth(gif, gifHeight);
                    return (preact_1.h(gif_1.default, { className: gifCss, gif: gif, key: gif.id, width: gifWidth, onGifClick: onGifClick, onGifHover: onGifHover, onGifSeen: onGifSeen, onGifVisible: onGifVisible, onGifRightClick: onGifRightClick, user: user, hideAttribution: hideAttribution, noLink: noLink }));
                }),
                !showLoader && gifs.length === 0 && noResultsMessage,
                showLoader && (preact_1.h(observer_1.default, { className: loaderContainerCss, onVisibleChange: this.onLoaderVisible },
                    preact_1.h("div", { className: emotion_1.cx(loaderCss, gifHeightCss) }))))));
    };
    Carousel.className = 'giphy-carousel';
    Carousel.defaultProps = defaultProps;
    return Carousel;
}(preact_1.Component));
exports.default = Carousel;
var templateObject_1, templateObject_2, templateObject_3, templateObject_4, templateObject_5, templateObject_6;
//# sourceMappingURL=carousel.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/dist/components/fetch-error.js":
/*!**************************************************************************!*\
  !*** ./node_modules/@giphy/js-components/dist/components/fetch-error.js ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __makeTemplateObject = (this && this.__makeTemplateObject) || function (cooked, raw) {
    if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
    return cooked;
};
Object.defineProperty(exports, "__esModule", { value: true });
var js_brand_1 = __webpack_require__(/*! @giphy/js-brand */ "./node_modules/@giphy/js-brand/dist/index.js");
var emotion_1 = __webpack_require__(/*! emotion */ "./node_modules/emotion/dist/emotion.esm.js");
var preact_1 = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
var fetchError = emotion_1.css(templateObject_1 || (templateObject_1 = __makeTemplateObject(["\n    color: ", ";\n    display: flex;\n    justify-content: center;\n    margin: 30px 0;\n    font-family: ", ";\n    font-size: 16px;\n    font-weight: 600;\n    a {\n        color: ", ";\n        cursor: pointer;\n        &:hover {\n            color: white;\n        }\n    }\n"], ["\n    color: ", ";\n    display: flex;\n    justify-content: center;\n    margin: 30px 0;\n    font-family: ", ";\n    font-size: 16px;\n    font-weight: 600;\n    a {\n        color: ", ";\n        cursor: pointer;\n        &:hover {\n            color: white;\n        }\n    }\n"])), js_brand_1.giphyLightGrey, js_brand_1.fontFamily.body, js_brand_1.giphyBlue);
var FetchError = function (_a) {
    var onClick = _a.onClick;
    return (preact_1.h("div", { className: fetchError },
        "Error loading GIFs.\u00A0",
        preact_1.h("a", { onClick: onClick }, "Try again?")));
};
exports.default = FetchError;
var templateObject_1;
//# sourceMappingURL=fetch-error.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/dist/components/gif.js":
/*!******************************************************************!*\
  !*** ./node_modules/@giphy/js-components/dist/components/gif.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __makeTemplateObject = (this && this.__makeTemplateObject) || function (cooked, raw) {
    if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
    return cooked;
};
var __assign = (this && this.__assign) || function () {
    __assign = Object.assign || function(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
                t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};
var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    Object.defineProperty(o, k2, { enumerable: true, get: function() { return m[k]; } });
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __setModuleDefault = (this && this.__setModuleDefault) || (Object.create ? (function(o, v) {
    Object.defineProperty(o, "default", { enumerable: true, value: v });
}) : function(o, v) {
    o["default"] = v;
});
var __importStar = (this && this.__importStar) || function (mod) {
    if (mod && mod.__esModule) return mod;
    var result = {};
    if (mod != null) for (var k in mod) if (k !== "default" && Object.prototype.hasOwnProperty.call(mod, k)) __createBinding(result, mod, k);
    __setModuleDefault(result, mod);
    return result;
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.getColor = exports.GRID_COLORS = void 0;
var js_brand_1 = __webpack_require__(/*! @giphy/js-brand */ "./node_modules/@giphy/js-brand/dist/index.js");
var js_util_1 = __webpack_require__(/*! @giphy/js-util */ "./node_modules/@giphy/js-util/dist/index.js");
var emotion_1 = __webpack_require__(/*! emotion */ "./node_modules/emotion/dist/emotion.esm.js");
var preact_1 = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
var hooks_1 = __webpack_require__(/*! preact/hooks */ "./node_modules/preact/hooks/dist/hooks.module.js");
var pingback = __importStar(__webpack_require__(/*! ../util/pingback */ "./node_modules/@giphy/js-components/dist/util/pingback.js"));
var overlay_1 = __importDefault(__webpack_require__(/*! ./attribution/overlay */ "./node_modules/@giphy/js-components/dist/components/attribution/overlay.js"));
var verified_badge_1 = __importDefault(__webpack_require__(/*! ./attribution/verified-badge */ "./node_modules/@giphy/js-components/dist/components/attribution/verified-badge.js"));
var pingback_context_manager_1 = __webpack_require__(/*! ./pingback-context-manager */ "./node_modules/@giphy/js-components/dist/components/pingback-context-manager.js");
var gifCss = emotion_1.css(templateObject_1 || (templateObject_1 = __makeTemplateObject(["\n    display: block;\n    img {\n        display: block;\n    }\n    .", " {\n        g {\n            fill: white;\n        }\n    }\n"], ["\n    display: block;\n    img {\n        display: block;\n    }\n    .", " {\n        g {\n            fill: white;\n        }\n    }\n"])), verified_badge_1.default.className);
exports.GRID_COLORS = [js_brand_1.giphyBlue, js_brand_1.giphyGreen, js_brand_1.giphyPurple, js_brand_1.giphyRed, js_brand_1.giphyYellow];
exports.getColor = function () { return exports.GRID_COLORS[Math.round(Math.random() * (exports.GRID_COLORS.length - 1))]; };
var hoverTimeoutDelay = 200;
var Container = function (props) { return (props.href ? preact_1.h("a", __assign({ href: props.href }, props)) : preact_1.h("div", __assign({}, props))); };
function useMutableRef(initialValue) {
    var ref = hooks_1.useState({ current: initialValue })[0];
    return ref;
}
var placeholder = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
var noop = function () { };
var Gif = function (_a) {
    var gif = _a.gif, width = _a.width, forcedHeight = _a.height, _b = _a.onGifRightClick, onGifRightClick = _b === void 0 ? noop : _b, className = _a.className, _c = _a.onGifClick, onGifClick = _c === void 0 ? noop : _c, _d = _a.onGifSeen, onGifSeen = _d === void 0 ? noop : _d, _e = _a.onGifVisible, onGifVisible = _e === void 0 ? noop : _e, _f = _a.user, user = _f === void 0 ? {} : _f, backgroundColor = _a.backgroundColor, _g = _a.hideAttribution, hideAttribution = _g === void 0 ? false : _g, _h = _a.noLink, noLink = _h === void 0 ? false : _h;
    // only fire seen once per gif id
    var _j = hooks_1.useState(false), hasFiredSeen = _j[0], setHasFiredSeen = _j[1];
    // hovered is for the gif overlay
    var _k = hooks_1.useState(false), isHovered = _k[0], setHovered = _k[1];
    // only show the gif if it's on the screen
    var _l = hooks_1.useState(false), showGif = _l[0], setShowGif = _l[1];
    // the background color shouldn't change unless it comes from a prop or we have a sticker
    var defaultBgColor = hooks_1.useRef(exports.getColor());
    // the a tag the media is rendered into
    var container = hooks_1.useRef(null);
    // intersection observer with no threshold
    var showGifObserver = useMutableRef();
    // intersection observer with a threshold of 1 (full element is on screen)
    var fullGifObserver = useMutableRef();
    // fire hover pingback after this timeout
    var hoverTimeout = useMutableRef();
    // fire onseen ref (changes per gif, so need a ref)
    var sendOnSeen = hooks_1.useRef(noop);
    // custom pingback
    var attributes = hooks_1.useContext(pingback_context_manager_1.PingbackContext).attributes;
    var onMouseOver = function (e) {
        clearTimeout(hoverTimeout.current);
        setHovered(true);
        hoverTimeout.current = window.setTimeout(function () {
            pingback.onGifHover(gif, user, e.target, attributes);
        }, hoverTimeoutDelay);
    };
    var onMouseLeave = function () {
        clearTimeout(hoverTimeout.current);
        setHovered(false);
    };
    var onClick = function (e) {
        // fire pingback
        pingback.onGifClick(gif, user, e.target, attributes);
        onGifClick(gif, e);
    };
    // using a ref in case `gif` changes
    sendOnSeen.current = function (entry) {
        // flag so we don't observe any more
        setHasFiredSeen(true);
        js_util_1.Logger.debug("GIF " + gif.id + " seen. " + gif.title);
        // third party here
        if (gif.bottle_data && gif.bottle_data.tags) {
            js_util_1.injectTrackingPixel(gif.bottle_data.tags);
        }
        // fire pingback
        pingback.onGifSeen(gif, user, entry.boundingClientRect, attributes);
        // fire custom onGifSeen
        onGifSeen === null || onGifSeen === void 0 ? void 0 : onGifSeen(gif, entry.boundingClientRect);
        // disconnect
        if (fullGifObserver.current) {
            fullGifObserver.current.disconnect();
        }
    };
    var onImageLoad = function (e) {
        if (!fullGifObserver.current) {
            fullGifObserver.current = new IntersectionObserver(function (_a) {
                var entry = _a[0];
                if (entry.isIntersecting) {
                    sendOnSeen.current(entry);
                }
            }, { threshold: [0.99] });
        }
        if (!hasFiredSeen && container.current && fullGifObserver.current) {
            // observe img for full gif view
            fullGifObserver.current.observe(container.current);
        }
        onGifVisible(gif, e); // gif is visible, perhaps just partially
    };
    hooks_1.useEffect(function () {
        if (fullGifObserver.current) {
            fullGifObserver.current.disconnect();
        }
        setHasFiredSeen(false);
    }, [gif.id]);
    hooks_1.useEffect(function () {
        showGifObserver.current = new IntersectionObserver(function (_a) {
            var entry = _a[0];
            var isIntersecting = entry.isIntersecting;
            // show the gif if the container is on the screen
            setShowGif(isIntersecting);
            // remove the fullGifObserver if we go off the screen
            // we may have already disconnected if the hasFiredSeen happened
            if (!isIntersecting && fullGifObserver.current) {
                fullGifObserver.current.disconnect();
            }
        });
        showGifObserver.current.observe(container.current);
        return function () {
            if (showGifObserver.current)
                showGifObserver.current.disconnect();
            if (fullGifObserver.current)
                fullGifObserver.current.disconnect();
            if (hoverTimeout.current)
                clearTimeout(hoverTimeout.current);
        };
    }, []);
    var height = forcedHeight || js_util_1.getGifHeight(gif, width);
    var bestRendition = js_util_1.getBestRendition(gif.images, width, height);
    var rendition = gif.images[bestRendition.renditionName];
    var background = backgroundColor || // <- specified background prop
        // sticker has black if no backgroundColor is specified
        (gif.is_sticker
            ? "url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADgAAAA4AQMAAACSSKldAAAABlBMVEUhIiIWFhYoSqvJAAAAGElEQVQY02MAAv7///8PWxqIPwDZw5UGABtgwz2xhFKxAAAAAElFTkSuQmCC') 0 0"
            : defaultBgColor.current);
    return (preact_1.h(Container, { href: noLink ? undefined : gif.url, style: {
            width: width,
            height: height,
        }, className: emotion_1.cx(Gif.className, gifCss, className), onMouseOver: onMouseOver, onMouseLeave: onMouseLeave, onClick: onClick, onContextMenu: function (e) { return onGifRightClick(gif, e); } },
        preact_1.h("div", { style: { width: width, height: height, position: 'relative' }, ref: container },
            preact_1.h("picture", null,
                preact_1.h("source", { type: "image/webp", srcSet: rendition.webp }),
                preact_1.h("img", { className: Gif.imgClassName, src: showGif ? rendition.url : placeholder, style: { background: background }, width: width, height: height, alt: js_util_1.getAltText(gif), onLoad: showGif ? onImageLoad : function () { } })),
            showGif ? (preact_1.h("div", null, !hideAttribution && preact_1.h(overlay_1.default, { gif: gif, isHovered: isHovered }))) : null)));
};
Gif.className = 'giphy-gif';
Gif.imgClassName = 'giphy-gif-img';
exports.default = Gif;
var templateObject_1;
//# sourceMappingURL=gif.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/dist/components/grid.js":
/*!*******************************************************************!*\
  !*** ./node_modules/@giphy/js-components/dist/components/grid.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __makeTemplateObject = (this && this.__makeTemplateObject) || function (cooked, raw) {
    if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
    return cooked;
};
var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
var js_fetch_api_1 = __webpack_require__(/*! @giphy/js-fetch-api */ "./node_modules/@giphy/js-fetch-api/dist/index.js");
var bricks_js_1 = __importDefault(__webpack_require__(/*! bricks.js */ "./node_modules/bricks.js/dist/bricks.module.js"));
var emotion_1 = __webpack_require__(/*! emotion */ "./node_modules/emotion/dist/emotion.esm.js");
var preact_1 = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
var throttle_debounce_1 = __webpack_require__(/*! throttle-debounce */ "./node_modules/throttle-debounce/index.umd.js");
var observer_1 = __importDefault(__webpack_require__(/*! ../util/observer */ "./node_modules/@giphy/js-components/dist/util/observer.js"));
var fetch_error_1 = __importDefault(__webpack_require__(/*! ./fetch-error */ "./node_modules/@giphy/js-components/dist/components/fetch-error.js"));
var gif_1 = __importDefault(__webpack_require__(/*! ./gif */ "./node_modules/@giphy/js-components/dist/components/gif.js"));
var loader_1 = __importDefault(__webpack_require__(/*! ./loader */ "./node_modules/@giphy/js-components/dist/components/loader.js"));
var pingback_context_manager_1 = __importDefault(__webpack_require__(/*! ./pingback-context-manager */ "./node_modules/@giphy/js-components/dist/components/pingback-context-manager.js"));
var loaderHiddenCss = emotion_1.css(templateObject_1 || (templateObject_1 = __makeTemplateObject(["\n    opacity: 0;\n"], ["\n    opacity: 0;\n"])));
var defaultProps = Object.freeze({ gutter: 6, user: {} });
var initialState = Object.freeze({
    isFetching: false,
    isError: false,
    numberOfGifs: 0,
    gifWidth: 0,
    gifs: [],
    isLoaderVisible: true,
    isDoneFetching: false,
});
var Grid = /** @class */ (function (_super) {
    __extends(Grid, _super);
    function Grid() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.state = initialState;
        _this.el = null;
        _this.paginator = js_fetch_api_1.gifPaginator(_this.props.fetchGifs);
        _this.onLoaderVisible = function (isVisible) {
            _this.setState({ isLoaderVisible: isVisible }, _this.onFetch);
        };
        _this.onFetch = throttle_debounce_1.debounce(Grid.fetchDebounce, function () { return __awaiter(_this, void 0, void 0, function () {
            var _a, isFetching, isLoaderVisible, existingGifs, gifs, error_1, onGifsFetchError, onGifsFetched;
            return __generator(this, function (_b) {
                switch (_b.label) {
                    case 0:
                        _a = this.state, isFetching = _a.isFetching, isLoaderVisible = _a.isLoaderVisible, existingGifs = _a.gifs;
                        if (!(!isFetching && isLoaderVisible)) return [3 /*break*/, 5];
                        this.setState({ isFetching: true, isError: false });
                        gifs = void 0;
                        _b.label = 1;
                    case 1:
                        _b.trys.push([1, 3, , 4]);
                        return [4 /*yield*/, this.paginator()];
                    case 2:
                        gifs = _b.sent();
                        return [3 /*break*/, 4];
                    case 3:
                        error_1 = _b.sent();
                        this.setState({ isFetching: false, isError: true });
                        onGifsFetchError = this.props.onGifsFetchError;
                        if (onGifsFetchError)
                            onGifsFetchError(error_1);
                        return [3 /*break*/, 4];
                    case 4:
                        if (gifs) {
                            if (existingGifs.length === gifs.length) {
                                this.setState({ isDoneFetching: true });
                            }
                            else {
                                this.setState({ gifs: gifs, isFetching: false });
                                onGifsFetched = this.props.onGifsFetched;
                                if (onGifsFetched)
                                    onGifsFetched(gifs);
                                this.onFetch();
                            }
                        }
                        _b.label = 5;
                    case 5: return [2 /*return*/];
                }
            });
        }); });
        return _this;
    }
    Grid.getDerivedStateFromProps = function (_a, prevState) {
        var columns = _a.columns, gutter = _a.gutter, width = _a.width;
        var gutterOffset = gutter * (columns - 1);
        var gifWidth = Math.floor((width - gutterOffset) / columns);
        if (prevState.gifWidth !== gifWidth) {
            return { gifWidth: gifWidth };
        }
        return {};
    };
    Grid.prototype.setBricks = function () {
        var _a = this.props, columns = _a.columns, gutter = _a.gutter;
        // bricks
        this.bricks = bricks_js_1.default({
            container: this.el,
            packed: "data-packed-" + columns,
            sizes: [{ columns: columns, gutter: gutter }],
        });
    };
    Grid.prototype.componentDidMount = function () {
        this.setBricks();
        this.onFetch();
    };
    Grid.prototype.componentDidUpdate = function (prevProps, prevState) {
        var gifs = this.state.gifs;
        var gifWidth = this.state.gifWidth;
        var numberOfOldGifs = prevState.gifs.length;
        var numberOfNewGifs = gifs.length;
        if (prevState.gifWidth !== gifWidth && numberOfOldGifs > 0) {
            var columns = this.props.columns;
            if (columns !== prevProps.columns) {
                this.setBricks();
            }
            this.bricks.pack();
        }
        if (prevState.gifs !== gifs) {
            if (numberOfNewGifs > numberOfOldGifs && numberOfOldGifs > 0) {
                // we just added new gifs
                this.bricks.update();
            }
            else {
                // we changed existing gifs or removed a gif
                this.bricks.pack();
            }
        }
    };
    Grid.prototype.render = function (_a, _b) {
        var _this = this;
        var fetchGifs = _a.fetchGifs, onGifVisible = _a.onGifVisible, onGifRightClick = _a.onGifRightClick, _c = _a.className, className = _c === void 0 ? Grid.className : _c, onGifClick = _a.onGifClick, onGifHover = _a.onGifHover, onGifSeen = _a.onGifSeen, user = _a.user, noResultsMessage = _a.noResultsMessage, hideAttribution = _a.hideAttribution, noLink = _a.noLink;
        var gifWidth = _b.gifWidth, gifs = _b.gifs, isError = _b.isError, isDoneFetching = _b.isDoneFetching;
        var showLoader = fetchGifs && !isDoneFetching;
        var isFirstLoad = gifs.length === 0;
        return (preact_1.h(pingback_context_manager_1.default, { attributes: [
                {
                    key: 'layout_type',
                    value: 'GRID',
                },
            ] },
            preact_1.h("div", { class: className },
                preact_1.h("div", { ref: function (c) { return (_this.el = c); } },
                    gifs.map(function (gif) { return (preact_1.h(gif_1.default, { gif: gif, key: gif.id, width: gifWidth, onGifClick: onGifClick, onGifHover: onGifHover, onGifSeen: onGifSeen, onGifVisible: onGifVisible, onGifRightClick: onGifRightClick, user: user, hideAttribution: hideAttribution, noLink: noLink })); }),
                    !showLoader && gifs.length === 0 && noResultsMessage),
                isError ? (preact_1.h(fetch_error_1.default, { onClick: this.onFetch })) : (showLoader && (preact_1.h(observer_1.default, { onVisibleChange: this.onLoaderVisible },
                    preact_1.h(loader_1.default, { className: emotion_1.cx(Grid.loaderClassName, isFirstLoad ? loaderHiddenCss : '') })))))));
    };
    Grid.className = 'giphy-grid';
    Grid.loaderClassName = 'giphy-loader';
    Grid.defaultProps = defaultProps;
    Grid.fetchDebounce = 250;
    return Grid;
}(preact_1.Component));
exports.default = Grid;
var templateObject_1;
//# sourceMappingURL=grid.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/dist/components/loader.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@giphy/js-components/dist/components/loader.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
var js_brand_1 = __webpack_require__(/*! @giphy/js-brand */ "./node_modules/@giphy/js-brand/dist/index.js");
var emotion_1 = __webpack_require__(/*! emotion */ "./node_modules/emotion/dist/emotion.esm.js");
var preact_1 = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
// trying to share css from brand, but this has an element structure
// so it's ugly. will probably move the css in here
exports.default = (function (_a) {
    var _b = _a.className, className = _b === void 0 ? '' : _b;
    return (preact_1.h("div", { className: emotion_1.cx(js_brand_1.loader, className) },
        preact_1.h("div", null),
        preact_1.h("div", null),
        preact_1.h("div", null),
        preact_1.h("div", null),
        preact_1.h("div", null)));
});
//# sourceMappingURL=loader.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/dist/components/pingback-context-manager.js":
/*!***************************************************************************************!*\
  !*** ./node_modules/@giphy/js-components/dist/components/pingback-context-manager.js ***!
  \***************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __spreadArrays = (this && this.__spreadArrays) || function () {
    for (var s = 0, i = 0, il = arguments.length; i < il; i++) s += arguments[i].length;
    for (var r = Array(s), k = 0, i = 0; i < il; i++)
        for (var a = arguments[i], j = 0, jl = a.length; j < jl; j++, k++)
            r[k] = a[j];
    return r;
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.PingbackContext = void 0;
var js_analytics_1 = __webpack_require__(/*! @giphy/js-analytics */ "./node_modules/@giphy/js-analytics/dist/index.js");
var preact_1 = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
var hooks_1 = __webpack_require__(/*! preact/hooks */ "./node_modules/preact/hooks/dist/hooks.module.js");
exports.PingbackContext = preact_1.createContext({});
var PingbackContextManager = function (_a) {
    var attributes = _a.attributes, children = _a.children;
    var _b = hooks_1.useContext(exports.PingbackContext).attributes, parentAttributes = _b === void 0 ? [] : _b;
    return (preact_1.h(exports.PingbackContext.Provider, { value: { attributes: js_analytics_1.mergeAttribute(__spreadArrays(parentAttributes, attributes), 'layout_type') } }, children));
};
exports.default = PingbackContextManager;
//# sourceMappingURL=pingback-context-manager.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/dist/index.js":
/*!*********************************************************!*\
  !*** ./node_modules/@giphy/js-components/dist/index.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __assign = (this && this.__assign) || function () {
    __assign = Object.assign || function(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
                t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.renderGif = exports.renderCarousel = exports.renderGrid = exports.Grid = exports.Gif = exports.Carousel = void 0;
__webpack_require__(/*! intersection-observer */ "./node_modules/intersection-observer/intersection-observer.js");
var preact_1 = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
var carousel_1 = __importDefault(__webpack_require__(/*! ./components/carousel */ "./node_modules/@giphy/js-components/dist/components/carousel.js"));
var grid_1 = __importDefault(__webpack_require__(/*! ./components/grid */ "./node_modules/@giphy/js-components/dist/components/grid.js"));
var gif_1 = __importDefault(__webpack_require__(/*! ./components/gif */ "./node_modules/@giphy/js-components/dist/components/gif.js"));
var js_util_1 = __webpack_require__(/*! @giphy/js-util */ "./node_modules/@giphy/js-util/dist/index.js");
var carousel_2 = __webpack_require__(/*! ./components/carousel */ "./node_modules/@giphy/js-components/dist/components/carousel.js");
Object.defineProperty(exports, "Carousel", { enumerable: true, get: function () { return __importDefault(carousel_2).default; } });
var gif_2 = __webpack_require__(/*! ./components/gif */ "./node_modules/@giphy/js-components/dist/components/gif.js");
Object.defineProperty(exports, "Gif", { enumerable: true, get: function () { return __importDefault(gif_2).default; } });
var grid_2 = __webpack_require__(/*! ./components/grid */ "./node_modules/@giphy/js-components/dist/components/grid.js");
Object.defineProperty(exports, "Grid", { enumerable: true, get: function () { return __importDefault(grid_2).default; } });
// @ts-ignore
var version = __webpack_require__(/*! ../package.json */ "./node_modules/@giphy/js-components/package.json").version;
// send headers with library type and version
js_util_1.appendGiphySDKRequestHeader("X-GIPHY-SDK-NAME", 'JavascriptSDK');
js_util_1.appendGiphySDKRequestHeader("X-GIPHY-SDK-VERSION", version);
/**
 * render a grid
 *
 * @param gridProps grid props
 * @param target the node to render into it
 */
exports.renderGrid = function (gridProps, target) {
    preact_1.render(preact_1.h(grid_1.default, __assign({}, gridProps)), target);
    return function () { return preact_1.render(null, target); };
};
/**
 * render a carousel
 *
 * @param carouselProps Carousel props
 * @param target the node to render into it
 */
exports.renderCarousel = function (carouselProps, target) {
    preact_1.render(preact_1.h(carousel_1.default, __assign({}, carouselProps)), target);
    return function () { return preact_1.render(null, target); };
};
/**
 * render a grid
 *
 * @param gif Gif props
 * @param target the node to render into it
 */
exports.renderGif = function (gifProps, target) {
    preact_1.render(preact_1.h(gif_1.default, __assign({}, gifProps)), target);
    return function () { return preact_1.render(null, target); };
};
//# sourceMappingURL=index.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/dist/util/observer.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@giphy/js-components/dist/util/observer.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", { value: true });
var preact_1 = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
var Observer = /** @class */ (function (_super) {
    __extends(Observer, _super);
    function Observer() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.container = null;
        return _this;
    }
    Observer.prototype.componentDidMount = function () {
        var _this = this;
        this.io = new IntersectionObserver(function (_a) {
            var entry = _a[0];
            _this.setState({ isVisible: entry.isIntersecting });
            var onVisibleChange = _this.props.onVisibleChange;
            if (onVisibleChange)
                onVisibleChange(entry.isIntersecting);
        });
        this.io.observe(this.container);
    };
    Observer.prototype.componentWillUnmount = function () {
        if (this.io) {
            this.io.disconnect();
        }
    };
    Observer.prototype.render = function (_a, _b) {
        var _this = this;
        var children = _a.children, className = _a.className;
        var isVisible = _b.isVisible;
        var kids = Array.isArray(children) ? children : [children];
        return (preact_1.h("div", { ref: function (div) { return (_this.container = div); }, className: className }, kids.map(function (child) { return (child ? preact_1.cloneElement(child, { isVisible: isVisible }) : null); })));
    };
    return Observer;
}(preact_1.Component));
exports.default = Observer;
//# sourceMappingURL=observer.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/dist/util/pingback.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@giphy/js-components/dist/util/pingback.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
exports.onGifHover = exports.onGifSeen = exports.onGifClick = void 0;
var js_analytics_1 = __webpack_require__(/*! @giphy/js-analytics */ "./node_modules/@giphy/js-analytics/dist/index.js");
var js_util_1 = __webpack_require__(/*! @giphy/js-util */ "./node_modules/@giphy/js-util/dist/index.js");
var firePingback = function (actionType) { return function (gif, user, target, attributes) {
    if (attributes === void 0) { attributes = []; }
    return js_analytics_1.pingback({
        gif: gif,
        user: user,
        responseId: gif.response_id,
        type: gif.pingback_event_type,
        actionType: actionType,
        position: js_util_1.getClientRect(target),
        attributes: attributes,
    });
}; };
exports.onGifClick = firePingback('CLICK');
exports.onGifSeen = function (gif, user, position, attributes) {
    if (attributes === void 0) { attributes = []; }
    js_analytics_1.pingback({
        gif: gif,
        user: user,
        responseId: gif.response_id,
        type: gif.pingback_event_type,
        actionType: 'SEEN',
        position: position,
        attributes: attributes,
    });
};
exports.onGifHover = firePingback('HOVER');
//# sourceMappingURL=pingback.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-components/package.json":
/*!********************************************************!*\
  !*** ./node_modules/@giphy/js-components/package.json ***!
  \********************************************************/
/*! exports provided: _from, _id, _inBundle, _integrity, _location, _phantomChildren, _requested, _requiredBy, _resolved, _shasum, _spec, _where, author, bundleDependencies, dependencies, deprecated, description, devDependencies, files, gitHead, license, main, name, publishConfig, scripts, types, version, default */
/***/ (function(module) {

module.exports = JSON.parse("{\"_from\":\"@giphy/js-components\",\"_id\":\"@giphy/js-components@3.6.1\",\"_inBundle\":false,\"_integrity\":\"sha512-609uA5EpYO2g+VS/t9pcya2WWLtIhuzhplT6Mszu28APmzM0MZ9O/zWkxsyYpZP7kaLtxpTOehbTxWfpLHGFbA==\",\"_location\":\"/@giphy/js-components\",\"_phantomChildren\":{},\"_requested\":{\"type\":\"tag\",\"registry\":true,\"raw\":\"@giphy/js-components\",\"name\":\"@giphy/js-components\",\"escapedName\":\"@giphy%2fjs-components\",\"scope\":\"@giphy\",\"rawSpec\":\"\",\"saveSpec\":null,\"fetchSpec\":\"latest\"},\"_requiredBy\":[\"#USER\",\"/\"],\"_resolved\":\"https://registry.npmjs.org/@giphy/js-components/-/js-components-3.6.1.tgz\",\"_shasum\":\"f90c3978a3c019fb0ddeb68d90b65cc7d15f8b24\",\"_spec\":\"@giphy/js-components\",\"_where\":\"/home/forge/dev.cryptoparrot.com\",\"author\":{\"name\":\"giannif\"},\"bundleDependencies\":false,\"dependencies\":{\"@giphy/js-analytics\":\"^1.8.0\",\"@giphy/js-brand\":\"^2.0.1\",\"@giphy/js-fetch-api\":\"^1.7.0\",\"@giphy/js-types\":\"^2.1.0\",\"@giphy/js-util\":\"^1.9.2\",\"bricks.js\":\"^1.8.0\",\"emotion\":\"10.0.27\",\"intersection-observer\":\"^0.11.0\",\"preact\":\"10.4.8\",\"throttle-debounce\":\"^2.3.0\"},\"deprecated\":false,\"description\":\"A lightweight set of components, focused on easy-of-use and performance.\",\"devDependencies\":{\"@types/bricks.js\":\"^1.8.1\",\"@types/throttle-debounce\":\"^2.1.0\",\"parcel-bundler\":\"^1.12.4\",\"typescript\":\"^4.0.2\"},\"files\":[\"dist/**/*\",\"src/**/*\"],\"gitHead\":\"2c35d620227bbdd4ae576fcff80f852b05cbc201\",\"license\":\"MIT\",\"main\":\"dist/index.js\",\"name\":\"@giphy/js-components\",\"publishConfig\":{\"access\":\"public\"},\"scripts\":{\"build\":\"tsc\",\"clean\":\"rm -rf ./dist\",\"dev\":\"parcel public/test.html\",\"prepublish\":\"npm run clean && tsc\",\"types\":\"tsc ./src/index.tsx -d --emitDeclarationOnly -declarationDir ./dist\"},\"types\":\"dist/index.d.ts\",\"version\":\"3.6.1\"}");

/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/dist/api.js":
/*!******************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/dist/api.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __assign = (this && this.__assign) || function () {
    __assign = Object.assign || function(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
                t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.GiphyFetch = void 0;
/* eslint-disable no-dupe-class-members */
var cookie_1 = __importDefault(__webpack_require__(/*! cookie */ "./node_modules/@giphy/js-fetch-api/node_modules/cookie/index.js"));
var qs_1 = __importDefault(__webpack_require__(/*! qs */ "./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/index.js"));
var gif_1 = __webpack_require__(/*! ./normalize/gif */ "./node_modules/@giphy/js-fetch-api/dist/normalize/gif.js");
var request_1 = __importDefault(__webpack_require__(/*! ./request */ "./node_modules/@giphy/js-fetch-api/dist/request.js"));
var getType = function (options) { return (options && options.type ? options.type : 'gifs'); };
/**
 * @class GiphyFetch
 * @param {string} apiKey
 */
var GiphyFetch = /** @class */ (function () {
    function GiphyFetch(apiKey) {
        var _this = this;
        /**
         * @hidden
         */
        this.getQS = function (options) {
            if (options === void 0) { options = {}; }
            var pingback_id = (typeof document !== 'undefined' ? cookie_1.default.parse(document.cookie) : {}).giphy_pbid;
            return qs_1.default.stringify(__assign(__assign({}, options), { api_key: _this.apiKey, pingback_id: pingback_id }));
        };
        this.apiKey = apiKey;
    }
    /**
     * A list of categories
     *
     * @param {CategoriesOptions} [options]
     * @returns {Promise<CategoriesResult>}
     */
    GiphyFetch.prototype.categories = function (options) {
        return request_1.default("gifs/categories?" + this.getQS(options));
    };
    /**
     * Get a single gif by a id
     * @param {string} id
     * @returns {Promise<GifsResult>}
     **/
    GiphyFetch.prototype.gif = function (id) {
        return request_1.default("gifs/" + id + "?" + this.getQS(), gif_1.normalizeGif);
    };
    GiphyFetch.prototype.gifs = function (arg1, arg2) {
        if (Array.isArray(arg1)) {
            return request_1.default("gifs?" + this.getQS({ ids: arg1.join(',') }), gif_1.normalizeGifs);
        }
        return request_1.default("gifs/categories/" + arg1 + "/" + arg2 + "?" + this.getQS(), gif_1.normalizeGifs);
    };
    GiphyFetch.prototype.emoji = function (options) {
        return request_1.default("emoji?" + this.getQS(options), gif_1.normalizeGifs, 'EMOJI');
    };
    /**
     * @param term: string The term you're searching for
     * @param options: SearchOptions
     * @returns {Promise<GifsResult>}
     **/
    GiphyFetch.prototype.search = function (term, options) {
        if (options === void 0) { options = {}; }
        var q = options.channel ? "@" + options.channel + " " + term : term;
        var qsParams = this.getQS(__assign(__assign({}, options), { q: q }));
        var pingbackType = options.type === 'text' ? 'TEXT_SEARCH' : options.explore ? 'GIF_EXPLORE' : 'GIF_SEARCH';
        return request_1.default(getType(options) + "/search?" + qsParams, gif_1.normalizeGifs, pingbackType);
    };
    /**
     * Get a list of subcategories
     * @param {string} category
     * @param {SubcategoriesOptions} options
     * @returns {Promise<CategoriesResult>}
     */
    GiphyFetch.prototype.subcategories = function (category, options) {
        return request_1.default("gifs/categories/" + category + "?" + this.getQS(options));
    };
    /**
     * Get trending gifs
     *
     * @param {TrendingOptions} options
     * @returns {Promise<GifsResult>}
     */
    GiphyFetch.prototype.trending = function (options) {
        if (options === void 0) { options = {}; }
        var pingbackType = options.type === 'text' ? 'TEXT_TRENDING' : 'GIF_TRENDING';
        return request_1.default(getType(options) + "/trending?" + this.getQS(options), gif_1.normalizeGifs, pingbackType);
    };
    /**
     * Get a random gif
     * @param {RandomOptions}
     * @returns {Promise<GifResult>}
     **/
    GiphyFetch.prototype.random = function (options) {
        return request_1.default(getType(options) + "/random?" + this.getQS(options), gif_1.normalizeGif, undefined, true);
    };
    /**
     * Get related gifs by a id
     * @param {string} id
     * @param {SubcategoriesOptions} options
     * @returns {Promise<GifsResult>}
     **/
    GiphyFetch.prototype.related = function (id, options) {
        return request_1.default("gifs/related?" + this.getQS(__assign({ gif_id: id }, options)), gif_1.normalizeGifs, 'GIF_RELATED');
    };
    return GiphyFetch;
}());
exports.GiphyFetch = GiphyFetch;
exports.default = GiphyFetch;
//# sourceMappingURL=api.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/dist/fetch-error.js":
/*!**************************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/dist/fetch-error.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
Object.defineProperty(exports, "__esModule", { value: true });
var FetchError = /** @class */ (function (_super) {
    __extends(FetchError, _super);
    function FetchError(message, status, statusText) {
        if (status === void 0) { status = 0; }
        if (statusText === void 0) { statusText = ''; }
        var _this = _super.call(this, message) || this;
        _this.status = status;
        _this.statusText = statusText;
        return _this;
    }
    return FetchError;
}(Error));
exports.default = FetchError;
//# sourceMappingURL=fetch-error.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/dist/index.js":
/*!********************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/dist/index.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    Object.defineProperty(o, k2, { enumerable: true, get: function() { return m[k]; } });
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __exportStar = (this && this.__exportStar) || function(m, exports) {
    for (var p in m) if (p !== "default" && !Object.prototype.hasOwnProperty.call(exports, p)) __createBinding(exports, m, p);
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
var _a;
Object.defineProperty(exports, "__esModule", { value: true });
exports.gifPaginator = exports.GiphyFetch = void 0;
var js_util_1 = __webpack_require__(/*! @giphy/js-util */ "./node_modules/@giphy/js-util/dist/index.js");
var api_1 = __webpack_require__(/*! ./api */ "./node_modules/@giphy/js-fetch-api/dist/api.js");
Object.defineProperty(exports, "GiphyFetch", { enumerable: true, get: function () { return __importDefault(api_1).default; } });
__exportStar(__webpack_require__(/*! ./option-types */ "./node_modules/@giphy/js-fetch-api/dist/option-types.js"), exports);
__exportStar(__webpack_require__(/*! ./result-types */ "./node_modules/@giphy/js-fetch-api/dist/result-types.js"), exports);
var paginator_1 = __webpack_require__(/*! ./paginator */ "./node_modules/@giphy/js-fetch-api/dist/paginator.js");
Object.defineProperty(exports, "gifPaginator", { enumerable: true, get: function () { return paginator_1.gifPaginator; } });
var version = __webpack_require__(/*! ../package.json */ "./node_modules/@giphy/js-fetch-api/package.json").version;
// since we have multiple SDKs, we're defining a hieracrchy
// Fetch API is lowest
if (!((_a = js_util_1.getGiphySDKRequestHeaders()) === null || _a === void 0 ? void 0 : _a.get("X-GIPHY-SDK-NAME"))) {
    // send headers with library type and version
    js_util_1.appendGiphySDKRequestHeader("X-GIPHY-SDK-NAME", 'FetchAPI');
    js_util_1.appendGiphySDKRequestHeader("X-GIPHY-SDK-VERSION", version);
}
//# sourceMappingURL=index.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/dist/normalize/gif.js":
/*!****************************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/dist/normalize/gif.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __assign = (this && this.__assign) || function () {
    __assign = Object.assign || function(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
                t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.normalizeGifs = exports.normalizeGif = exports.USER_BOOL_PROPS = exports.BOOL_PROPS = void 0;
/**
 * @hidden
 */
exports.BOOL_PROPS = [
    'is_anonymous',
    'is_community',
    'is_featured',
    'is_hidden',
    'is_indexable',
    'is_preserve_size',
    'is_realtime',
    'is_removed',
    'is_sticker',
];
/**
 * @hidden
 */
exports.USER_BOOL_PROPS = ['suppress_chrome', 'is_public', 'is_verified'];
var makeBool = function (obj) { return function (prop) { return (obj[prop] = !!obj[prop]); }; };
// tags sometimes are objects that have a text prop, sometimes they're strings
var getTag = function (tag) { return (typeof tag === 'string' ? tag : tag.text); };
var normalize = function (gif, responseId, pingbackType) {
    if (responseId === void 0) { responseId = ''; }
    if (pingbackType === void 0) { pingbackType = ''; }
    var newGif = __assign({}, gif);
    newGif.id = String(newGif.id);
    newGif.tags = (newGif.tags || []).map(getTag);
    if (!newGif.bottle_data) {
        newGif.bottle_data = {};
    }
    newGif.response_id = responseId;
    newGif.pingback_event_type = pingbackType;
    exports.BOOL_PROPS.forEach(makeBool(newGif));
    var user = newGif.user;
    if (user) {
        var newUser = __assign({}, user);
        exports.USER_BOOL_PROPS.forEach(makeBool(newUser));
        newGif.user = newUser;
    }
    return newGif;
};
/**
 * @hidden
 */
exports.normalizeGif = function (result, pingbackType) {
    var response_id = result.meta.response_id;
    result.data = normalize(result.data, response_id, pingbackType);
    return result;
};
/**
 * @hidden
 */
exports.normalizeGifs = function (result, pingbackType) {
    var response_id = result.meta.response_id;
    result.data = result.data.map(function (gif) { return normalize(gif, response_id, pingbackType); });
    return result;
};
//# sourceMappingURL=gif.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/dist/option-types.js":
/*!***************************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/dist/option-types.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
//# sourceMappingURL=option-types.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/dist/paginator.js":
/*!************************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/dist/paginator.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
var __spreadArrays = (this && this.__spreadArrays) || function () {
    for (var s = 0, i = 0, il = arguments.length; i < il; i++) s += arguments[i].length;
    for (var r = Array(s), k = 0, i = 0; i < il; i++)
        for (var a = arguments[i], j = 0, jl = a.length; j < jl; j++, k++)
            r[k] = a[j];
    return r;
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.gifPaginator = void 0;
/**
 * @hidden
 */
exports.gifPaginator = function (fetchGifs, initialGifs) {
    if (initialGifs === void 0) { initialGifs = []; }
    var gifs = __spreadArrays(initialGifs);
    // for deduping
    var gifIds = initialGifs.map(function (g) { return g.id; });
    var offset = initialGifs.length;
    var isDoneFetching = false;
    return function () { return __awaiter(void 0, void 0, void 0, function () {
        var result, pagination, newGifs;
        return __generator(this, function (_a) {
            switch (_a.label) {
                case 0:
                    if (isDoneFetching) {
                        return [2 /*return*/, gifs];
                    }
                    return [4 /*yield*/, fetchGifs(offset)];
                case 1:
                    result = _a.sent();
                    pagination = result.pagination, newGifs = result.data;
                    offset = pagination.count + pagination.offset;
                    isDoneFetching = offset === pagination.total_count;
                    newGifs.forEach(function (gif) {
                        var id = gif.id;
                        if (!gifIds.includes(id)) {
                            // add gifs and gifIds
                            gifs.push(gif);
                            gifIds.push(id);
                        }
                    });
                    return [2 /*return*/, __spreadArrays(gifs)];
            }
        });
    }); };
};
//# sourceMappingURL=paginator.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/dist/request.js":
/*!**********************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/dist/request.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.DEFAULT_ERROR = exports.ERROR_PREFIX = void 0;
var fetch_error_1 = __importDefault(__webpack_require__(/*! ./fetch-error */ "./node_modules/@giphy/js-fetch-api/dist/fetch-error.js"));
exports.ERROR_PREFIX = "@giphy/js-fetch-api: ";
exports.DEFAULT_ERROR = 'Error fetching';
var serverUrl = 'https://api.giphy.com/v1/';
var identity = function (i) { return i; };
var requestMap = {};
var maxLife = 60000; // clear memory cache every minute
var purgeCache = function () {
    var now = Date.now();
    Object.keys(requestMap).forEach(function (key) {
        if (now - requestMap[key].ts >= maxLife) {
            delete requestMap[key];
        }
    });
};
function request(url, normalizer, pingbackType, noCache) {
    var _this = this;
    if (normalizer === void 0) { normalizer = identity; }
    if (noCache === void 0) { noCache = false; }
    purgeCache();
    if (!requestMap[url] || noCache) {
        var makeRequest = function () { return __awaiter(_this, void 0, void 0, function () {
            var fetchError, response, result, message, result, _1, unexpectedError_1;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        _a.trys.push([0, 9, , 10]);
                        return [4 /*yield*/, fetch("" + serverUrl + url, {
                                method: 'get',
                            })];
                    case 1:
                        response = _a.sent();
                        if (!response.ok) return [3 /*break*/, 3];
                        return [4 /*yield*/, response.json()];
                    case 2:
                        result = (_a.sent());
                        // if everything is successful, we return here, otherwise an error will be thrown
                        return [2 /*return*/, normalizer(result, pingbackType)];
                    case 3:
                        message = exports.DEFAULT_ERROR;
                        _a.label = 4;
                    case 4:
                        _a.trys.push([4, 6, , 7]);
                        return [4 /*yield*/, response.json()];
                    case 5:
                        result = (_a.sent());
                        if (result.message)
                            message = result.message;
                        return [3 /*break*/, 7];
                    case 6:
                        _1 = _a.sent();
                        return [3 /*break*/, 7];
                    case 7:
                        // we got an error response, throw with the message in the response body json
                        fetchError = new fetch_error_1.default("" + exports.ERROR_PREFIX + message, response.status, response.statusText);
                        _a.label = 8;
                    case 8: return [3 /*break*/, 10];
                    case 9:
                        unexpectedError_1 = _a.sent();
                        fetchError = new fetch_error_1.default(unexpectedError_1.message);
                        // if the request fails with an unspecfied error,
                        // the user can request again
                        // TODO: perhaps we can return a function to clear
                        // { clearCache: () => delete requestMap[url] }
                        delete requestMap[url];
                        return [3 /*break*/, 10];
                    case 10: throw fetchError;
                }
            });
        }); };
        requestMap[url] = { request: makeRequest(), ts: Date.now() };
    }
    return requestMap[url].request;
}
exports.default = request;
//# sourceMappingURL=request.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/dist/result-types.js":
/*!***************************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/dist/result-types.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
//# sourceMappingURL=result-types.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/node_modules/cookie/index.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/node_modules/cookie/index.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/*!
 * cookie
 * Copyright(c) 2012-2014 Roman Shtylman
 * Copyright(c) 2015 Douglas Christopher Wilson
 * MIT Licensed
 */



/**
 * Module exports.
 * @public
 */

exports.parse = parse;
exports.serialize = serialize;

/**
 * Module variables.
 * @private
 */

var decode = decodeURIComponent;
var encode = encodeURIComponent;
var pairSplitRegExp = /; */;

/**
 * RegExp to match field-content in RFC 7230 sec 3.2
 *
 * field-content = field-vchar [ 1*( SP / HTAB ) field-vchar ]
 * field-vchar   = VCHAR / obs-text
 * obs-text      = %x80-FF
 */

var fieldContentRegExp = /^[\u0009\u0020-\u007e\u0080-\u00ff]+$/;

/**
 * Parse a cookie header.
 *
 * Parse the given cookie header string into an object
 * The object has the various cookies as keys(names) => values
 *
 * @param {string} str
 * @param {object} [options]
 * @return {object}
 * @public
 */

function parse(str, options) {
  if (typeof str !== 'string') {
    throw new TypeError('argument str must be a string');
  }

  var obj = {}
  var opt = options || {};
  var pairs = str.split(pairSplitRegExp);
  var dec = opt.decode || decode;

  for (var i = 0; i < pairs.length; i++) {
    var pair = pairs[i];
    var eq_idx = pair.indexOf('=');

    // skip things that don't look like key=value
    if (eq_idx < 0) {
      continue;
    }

    var key = pair.substr(0, eq_idx).trim()
    var val = pair.substr(++eq_idx, pair.length).trim();

    // quoted values
    if ('"' == val[0]) {
      val = val.slice(1, -1);
    }

    // only assign once
    if (undefined == obj[key]) {
      obj[key] = tryDecode(val, dec);
    }
  }

  return obj;
}

/**
 * Serialize data into a cookie header.
 *
 * Serialize the a name value pair into a cookie string suitable for
 * http headers. An optional options object specified cookie parameters.
 *
 * serialize('foo', 'bar', { httpOnly: true })
 *   => "foo=bar; httpOnly"
 *
 * @param {string} name
 * @param {string} val
 * @param {object} [options]
 * @return {string}
 * @public
 */

function serialize(name, val, options) {
  var opt = options || {};
  var enc = opt.encode || encode;

  if (typeof enc !== 'function') {
    throw new TypeError('option encode is invalid');
  }

  if (!fieldContentRegExp.test(name)) {
    throw new TypeError('argument name is invalid');
  }

  var value = enc(val);

  if (value && !fieldContentRegExp.test(value)) {
    throw new TypeError('argument val is invalid');
  }

  var str = name + '=' + value;

  if (null != opt.maxAge) {
    var maxAge = opt.maxAge - 0;

    if (isNaN(maxAge) || !isFinite(maxAge)) {
      throw new TypeError('option maxAge is invalid')
    }

    str += '; Max-Age=' + Math.floor(maxAge);
  }

  if (opt.domain) {
    if (!fieldContentRegExp.test(opt.domain)) {
      throw new TypeError('option domain is invalid');
    }

    str += '; Domain=' + opt.domain;
  }

  if (opt.path) {
    if (!fieldContentRegExp.test(opt.path)) {
      throw new TypeError('option path is invalid');
    }

    str += '; Path=' + opt.path;
  }

  if (opt.expires) {
    if (typeof opt.expires.toUTCString !== 'function') {
      throw new TypeError('option expires is invalid');
    }

    str += '; Expires=' + opt.expires.toUTCString();
  }

  if (opt.httpOnly) {
    str += '; HttpOnly';
  }

  if (opt.secure) {
    str += '; Secure';
  }

  if (opt.sameSite) {
    var sameSite = typeof opt.sameSite === 'string'
      ? opt.sameSite.toLowerCase() : opt.sameSite;

    switch (sameSite) {
      case true:
        str += '; SameSite=Strict';
        break;
      case 'lax':
        str += '; SameSite=Lax';
        break;
      case 'strict':
        str += '; SameSite=Strict';
        break;
      case 'none':
        str += '; SameSite=None';
        break;
      default:
        throw new TypeError('option sameSite is invalid');
    }
  }

  return str;
}

/**
 * Try decoding a string using a decoding function.
 *
 * @param {string} str
 * @param {function} decode
 * @private
 */

function tryDecode(str, decode) {
  try {
    return decode(str);
  } catch (e) {
    return str;
  }
}


/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/formats.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/formats.js ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var replace = String.prototype.replace;
var percentTwenties = /%20/g;

var util = __webpack_require__(/*! ./utils */ "./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/utils.js");

var Format = {
    RFC1738: 'RFC1738',
    RFC3986: 'RFC3986'
};

module.exports = util.assign(
    {
        'default': Format.RFC3986,
        formatters: {
            RFC1738: function (value) {
                return replace.call(value, percentTwenties, '+');
            },
            RFC3986: function (value) {
                return String(value);
            }
        }
    },
    Format
);


/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/index.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/index.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var stringify = __webpack_require__(/*! ./stringify */ "./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/stringify.js");
var parse = __webpack_require__(/*! ./parse */ "./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/parse.js");
var formats = __webpack_require__(/*! ./formats */ "./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/formats.js");

module.exports = {
    formats: formats,
    parse: parse,
    stringify: stringify
};


/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/parse.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/parse.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var utils = __webpack_require__(/*! ./utils */ "./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/utils.js");

var has = Object.prototype.hasOwnProperty;
var isArray = Array.isArray;

var defaults = {
    allowDots: false,
    allowPrototypes: false,
    arrayLimit: 20,
    charset: 'utf-8',
    charsetSentinel: false,
    comma: false,
    decoder: utils.decode,
    delimiter: '&',
    depth: 5,
    ignoreQueryPrefix: false,
    interpretNumericEntities: false,
    parameterLimit: 1000,
    parseArrays: true,
    plainObjects: false,
    strictNullHandling: false
};

var interpretNumericEntities = function (str) {
    return str.replace(/&#(\d+);/g, function ($0, numberStr) {
        return String.fromCharCode(parseInt(numberStr, 10));
    });
};

var parseArrayValue = function (val, options) {
    if (val && typeof val === 'string' && options.comma && val.indexOf(',') > -1) {
        return val.split(',');
    }

    return val;
};

// This is what browsers will submit when the ✓ character occurs in an
// application/x-www-form-urlencoded body and the encoding of the page containing
// the form is iso-8859-1, or when the submitted form has an accept-charset
// attribute of iso-8859-1. Presumably also with other charsets that do not contain
// the ✓ character, such as us-ascii.
var isoSentinel = 'utf8=%26%2310003%3B'; // encodeURIComponent('&#10003;')

// These are the percent-encoded utf-8 octets representing a checkmark, indicating that the request actually is utf-8 encoded.
var charsetSentinel = 'utf8=%E2%9C%93'; // encodeURIComponent('✓')

var parseValues = function parseQueryStringValues(str, options) {
    var obj = {};
    var cleanStr = options.ignoreQueryPrefix ? str.replace(/^\?/, '') : str;
    var limit = options.parameterLimit === Infinity ? undefined : options.parameterLimit;
    var parts = cleanStr.split(options.delimiter, limit);
    var skipIndex = -1; // Keep track of where the utf8 sentinel was found
    var i;

    var charset = options.charset;
    if (options.charsetSentinel) {
        for (i = 0; i < parts.length; ++i) {
            if (parts[i].indexOf('utf8=') === 0) {
                if (parts[i] === charsetSentinel) {
                    charset = 'utf-8';
                } else if (parts[i] === isoSentinel) {
                    charset = 'iso-8859-1';
                }
                skipIndex = i;
                i = parts.length; // The eslint settings do not allow break;
            }
        }
    }

    for (i = 0; i < parts.length; ++i) {
        if (i === skipIndex) {
            continue;
        }
        var part = parts[i];

        var bracketEqualsPos = part.indexOf(']=');
        var pos = bracketEqualsPos === -1 ? part.indexOf('=') : bracketEqualsPos + 1;

        var key, val;
        if (pos === -1) {
            key = options.decoder(part, defaults.decoder, charset, 'key');
            val = options.strictNullHandling ? null : '';
        } else {
            key = options.decoder(part.slice(0, pos), defaults.decoder, charset, 'key');
            val = utils.maybeMap(
                parseArrayValue(part.slice(pos + 1), options),
                function (encodedVal) {
                    return options.decoder(encodedVal, defaults.decoder, charset, 'value');
                }
            );
        }

        if (val && options.interpretNumericEntities && charset === 'iso-8859-1') {
            val = interpretNumericEntities(val);
        }

        if (part.indexOf('[]=') > -1) {
            val = isArray(val) ? [val] : val;
        }

        if (has.call(obj, key)) {
            obj[key] = utils.combine(obj[key], val);
        } else {
            obj[key] = val;
        }
    }

    return obj;
};

var parseObject = function (chain, val, options, valuesParsed) {
    var leaf = valuesParsed ? val : parseArrayValue(val, options);

    for (var i = chain.length - 1; i >= 0; --i) {
        var obj;
        var root = chain[i];

        if (root === '[]' && options.parseArrays) {
            obj = [].concat(leaf);
        } else {
            obj = options.plainObjects ? Object.create(null) : {};
            var cleanRoot = root.charAt(0) === '[' && root.charAt(root.length - 1) === ']' ? root.slice(1, -1) : root;
            var index = parseInt(cleanRoot, 10);
            if (!options.parseArrays && cleanRoot === '') {
                obj = { 0: leaf };
            } else if (
                !isNaN(index)
                && root !== cleanRoot
                && String(index) === cleanRoot
                && index >= 0
                && (options.parseArrays && index <= options.arrayLimit)
            ) {
                obj = [];
                obj[index] = leaf;
            } else {
                obj[cleanRoot] = leaf;
            }
        }

        leaf = obj; // eslint-disable-line no-param-reassign
    }

    return leaf;
};

var parseKeys = function parseQueryStringKeys(givenKey, val, options, valuesParsed) {
    if (!givenKey) {
        return;
    }

    // Transform dot notation to bracket notation
    var key = options.allowDots ? givenKey.replace(/\.([^.[]+)/g, '[$1]') : givenKey;

    // The regex chunks

    var brackets = /(\[[^[\]]*])/;
    var child = /(\[[^[\]]*])/g;

    // Get the parent

    var segment = options.depth > 0 && brackets.exec(key);
    var parent = segment ? key.slice(0, segment.index) : key;

    // Stash the parent if it exists

    var keys = [];
    if (parent) {
        // If we aren't using plain objects, optionally prefix keys that would overwrite object prototype properties
        if (!options.plainObjects && has.call(Object.prototype, parent)) {
            if (!options.allowPrototypes) {
                return;
            }
        }

        keys.push(parent);
    }

    // Loop through children appending to the array until we hit depth

    var i = 0;
    while (options.depth > 0 && (segment = child.exec(key)) !== null && i < options.depth) {
        i += 1;
        if (!options.plainObjects && has.call(Object.prototype, segment[1].slice(1, -1))) {
            if (!options.allowPrototypes) {
                return;
            }
        }
        keys.push(segment[1]);
    }

    // If there's a remainder, just add whatever is left

    if (segment) {
        keys.push('[' + key.slice(segment.index) + ']');
    }

    return parseObject(keys, val, options, valuesParsed);
};

var normalizeParseOptions = function normalizeParseOptions(opts) {
    if (!opts) {
        return defaults;
    }

    if (opts.decoder !== null && opts.decoder !== undefined && typeof opts.decoder !== 'function') {
        throw new TypeError('Decoder has to be a function.');
    }

    if (typeof opts.charset !== 'undefined' && opts.charset !== 'utf-8' && opts.charset !== 'iso-8859-1') {
        throw new TypeError('The charset option must be either utf-8, iso-8859-1, or undefined');
    }
    var charset = typeof opts.charset === 'undefined' ? defaults.charset : opts.charset;

    return {
        allowDots: typeof opts.allowDots === 'undefined' ? defaults.allowDots : !!opts.allowDots,
        allowPrototypes: typeof opts.allowPrototypes === 'boolean' ? opts.allowPrototypes : defaults.allowPrototypes,
        arrayLimit: typeof opts.arrayLimit === 'number' ? opts.arrayLimit : defaults.arrayLimit,
        charset: charset,
        charsetSentinel: typeof opts.charsetSentinel === 'boolean' ? opts.charsetSentinel : defaults.charsetSentinel,
        comma: typeof opts.comma === 'boolean' ? opts.comma : defaults.comma,
        decoder: typeof opts.decoder === 'function' ? opts.decoder : defaults.decoder,
        delimiter: typeof opts.delimiter === 'string' || utils.isRegExp(opts.delimiter) ? opts.delimiter : defaults.delimiter,
        // eslint-disable-next-line no-implicit-coercion, no-extra-parens
        depth: (typeof opts.depth === 'number' || opts.depth === false) ? +opts.depth : defaults.depth,
        ignoreQueryPrefix: opts.ignoreQueryPrefix === true,
        interpretNumericEntities: typeof opts.interpretNumericEntities === 'boolean' ? opts.interpretNumericEntities : defaults.interpretNumericEntities,
        parameterLimit: typeof opts.parameterLimit === 'number' ? opts.parameterLimit : defaults.parameterLimit,
        parseArrays: opts.parseArrays !== false,
        plainObjects: typeof opts.plainObjects === 'boolean' ? opts.plainObjects : defaults.plainObjects,
        strictNullHandling: typeof opts.strictNullHandling === 'boolean' ? opts.strictNullHandling : defaults.strictNullHandling
    };
};

module.exports = function (str, opts) {
    var options = normalizeParseOptions(opts);

    if (str === '' || str === null || typeof str === 'undefined') {
        return options.plainObjects ? Object.create(null) : {};
    }

    var tempObj = typeof str === 'string' ? parseValues(str, options) : str;
    var obj = options.plainObjects ? Object.create(null) : {};

    // Iterate over the keys and setup the new object

    var keys = Object.keys(tempObj);
    for (var i = 0; i < keys.length; ++i) {
        var key = keys[i];
        var newObj = parseKeys(key, tempObj[key], options, typeof str === 'string');
        obj = utils.merge(obj, newObj, options);
    }

    return utils.compact(obj);
};


/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/stringify.js":
/*!***************************************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/stringify.js ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var utils = __webpack_require__(/*! ./utils */ "./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/utils.js");
var formats = __webpack_require__(/*! ./formats */ "./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/formats.js");
var has = Object.prototype.hasOwnProperty;

var arrayPrefixGenerators = {
    brackets: function brackets(prefix) {
        return prefix + '[]';
    },
    comma: 'comma',
    indices: function indices(prefix, key) {
        return prefix + '[' + key + ']';
    },
    repeat: function repeat(prefix) {
        return prefix;
    }
};

var isArray = Array.isArray;
var push = Array.prototype.push;
var pushToArray = function (arr, valueOrArray) {
    push.apply(arr, isArray(valueOrArray) ? valueOrArray : [valueOrArray]);
};

var toISO = Date.prototype.toISOString;

var defaultFormat = formats['default'];
var defaults = {
    addQueryPrefix: false,
    allowDots: false,
    charset: 'utf-8',
    charsetSentinel: false,
    delimiter: '&',
    encode: true,
    encoder: utils.encode,
    encodeValuesOnly: false,
    format: defaultFormat,
    formatter: formats.formatters[defaultFormat],
    // deprecated
    indices: false,
    serializeDate: function serializeDate(date) {
        return toISO.call(date);
    },
    skipNulls: false,
    strictNullHandling: false
};

var isNonNullishPrimitive = function isNonNullishPrimitive(v) {
    return typeof v === 'string'
        || typeof v === 'number'
        || typeof v === 'boolean'
        || typeof v === 'symbol'
        || typeof v === 'bigint';
};

var stringify = function stringify(
    object,
    prefix,
    generateArrayPrefix,
    strictNullHandling,
    skipNulls,
    encoder,
    filter,
    sort,
    allowDots,
    serializeDate,
    formatter,
    encodeValuesOnly,
    charset
) {
    var obj = object;
    if (typeof filter === 'function') {
        obj = filter(prefix, obj);
    } else if (obj instanceof Date) {
        obj = serializeDate(obj);
    } else if (generateArrayPrefix === 'comma' && isArray(obj)) {
        obj = utils.maybeMap(obj, function (value) {
            if (value instanceof Date) {
                return serializeDate(value);
            }
            return value;
        }).join(',');
    }

    if (obj === null) {
        if (strictNullHandling) {
            return encoder && !encodeValuesOnly ? encoder(prefix, defaults.encoder, charset, 'key') : prefix;
        }

        obj = '';
    }

    if (isNonNullishPrimitive(obj) || utils.isBuffer(obj)) {
        if (encoder) {
            var keyValue = encodeValuesOnly ? prefix : encoder(prefix, defaults.encoder, charset, 'key');
            return [formatter(keyValue) + '=' + formatter(encoder(obj, defaults.encoder, charset, 'value'))];
        }
        return [formatter(prefix) + '=' + formatter(String(obj))];
    }

    var values = [];

    if (typeof obj === 'undefined') {
        return values;
    }

    var objKeys;
    if (isArray(filter)) {
        objKeys = filter;
    } else {
        var keys = Object.keys(obj);
        objKeys = sort ? keys.sort(sort) : keys;
    }

    for (var i = 0; i < objKeys.length; ++i) {
        var key = objKeys[i];
        var value = obj[key];

        if (skipNulls && value === null) {
            continue;
        }

        var keyPrefix = isArray(obj)
            ? typeof generateArrayPrefix === 'function' ? generateArrayPrefix(prefix, key) : prefix
            : prefix + (allowDots ? '.' + key : '[' + key + ']');

        pushToArray(values, stringify(
            value,
            keyPrefix,
            generateArrayPrefix,
            strictNullHandling,
            skipNulls,
            encoder,
            filter,
            sort,
            allowDots,
            serializeDate,
            formatter,
            encodeValuesOnly,
            charset
        ));
    }

    return values;
};

var normalizeStringifyOptions = function normalizeStringifyOptions(opts) {
    if (!opts) {
        return defaults;
    }

    if (opts.encoder !== null && opts.encoder !== undefined && typeof opts.encoder !== 'function') {
        throw new TypeError('Encoder has to be a function.');
    }

    var charset = opts.charset || defaults.charset;
    if (typeof opts.charset !== 'undefined' && opts.charset !== 'utf-8' && opts.charset !== 'iso-8859-1') {
        throw new TypeError('The charset option must be either utf-8, iso-8859-1, or undefined');
    }

    var format = formats['default'];
    if (typeof opts.format !== 'undefined') {
        if (!has.call(formats.formatters, opts.format)) {
            throw new TypeError('Unknown format option provided.');
        }
        format = opts.format;
    }
    var formatter = formats.formatters[format];

    var filter = defaults.filter;
    if (typeof opts.filter === 'function' || isArray(opts.filter)) {
        filter = opts.filter;
    }

    return {
        addQueryPrefix: typeof opts.addQueryPrefix === 'boolean' ? opts.addQueryPrefix : defaults.addQueryPrefix,
        allowDots: typeof opts.allowDots === 'undefined' ? defaults.allowDots : !!opts.allowDots,
        charset: charset,
        charsetSentinel: typeof opts.charsetSentinel === 'boolean' ? opts.charsetSentinel : defaults.charsetSentinel,
        delimiter: typeof opts.delimiter === 'undefined' ? defaults.delimiter : opts.delimiter,
        encode: typeof opts.encode === 'boolean' ? opts.encode : defaults.encode,
        encoder: typeof opts.encoder === 'function' ? opts.encoder : defaults.encoder,
        encodeValuesOnly: typeof opts.encodeValuesOnly === 'boolean' ? opts.encodeValuesOnly : defaults.encodeValuesOnly,
        filter: filter,
        formatter: formatter,
        serializeDate: typeof opts.serializeDate === 'function' ? opts.serializeDate : defaults.serializeDate,
        skipNulls: typeof opts.skipNulls === 'boolean' ? opts.skipNulls : defaults.skipNulls,
        sort: typeof opts.sort === 'function' ? opts.sort : null,
        strictNullHandling: typeof opts.strictNullHandling === 'boolean' ? opts.strictNullHandling : defaults.strictNullHandling
    };
};

module.exports = function (object, opts) {
    var obj = object;
    var options = normalizeStringifyOptions(opts);

    var objKeys;
    var filter;

    if (typeof options.filter === 'function') {
        filter = options.filter;
        obj = filter('', obj);
    } else if (isArray(options.filter)) {
        filter = options.filter;
        objKeys = filter;
    }

    var keys = [];

    if (typeof obj !== 'object' || obj === null) {
        return '';
    }

    var arrayFormat;
    if (opts && opts.arrayFormat in arrayPrefixGenerators) {
        arrayFormat = opts.arrayFormat;
    } else if (opts && 'indices' in opts) {
        arrayFormat = opts.indices ? 'indices' : 'repeat';
    } else {
        arrayFormat = 'indices';
    }

    var generateArrayPrefix = arrayPrefixGenerators[arrayFormat];

    if (!objKeys) {
        objKeys = Object.keys(obj);
    }

    if (options.sort) {
        objKeys.sort(options.sort);
    }

    for (var i = 0; i < objKeys.length; ++i) {
        var key = objKeys[i];

        if (options.skipNulls && obj[key] === null) {
            continue;
        }
        pushToArray(keys, stringify(
            obj[key],
            key,
            generateArrayPrefix,
            options.strictNullHandling,
            options.skipNulls,
            options.encode ? options.encoder : null,
            options.filter,
            options.sort,
            options.allowDots,
            options.serializeDate,
            options.formatter,
            options.encodeValuesOnly,
            options.charset
        ));
    }

    var joined = keys.join(options.delimiter);
    var prefix = options.addQueryPrefix === true ? '?' : '';

    if (options.charsetSentinel) {
        if (options.charset === 'iso-8859-1') {
            // encodeURIComponent('&#10003;'), the "numeric entity" representation of a checkmark
            prefix += 'utf8=%26%2310003%3B&';
        } else {
            // encodeURIComponent('✓')
            prefix += 'utf8=%E2%9C%93&';
        }
    }

    return joined.length > 0 ? prefix + joined : '';
};


/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/utils.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/node_modules/qs/lib/utils.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var has = Object.prototype.hasOwnProperty;
var isArray = Array.isArray;

var hexTable = (function () {
    var array = [];
    for (var i = 0; i < 256; ++i) {
        array.push('%' + ((i < 16 ? '0' : '') + i.toString(16)).toUpperCase());
    }

    return array;
}());

var compactQueue = function compactQueue(queue) {
    while (queue.length > 1) {
        var item = queue.pop();
        var obj = item.obj[item.prop];

        if (isArray(obj)) {
            var compacted = [];

            for (var j = 0; j < obj.length; ++j) {
                if (typeof obj[j] !== 'undefined') {
                    compacted.push(obj[j]);
                }
            }

            item.obj[item.prop] = compacted;
        }
    }
};

var arrayToObject = function arrayToObject(source, options) {
    var obj = options && options.plainObjects ? Object.create(null) : {};
    for (var i = 0; i < source.length; ++i) {
        if (typeof source[i] !== 'undefined') {
            obj[i] = source[i];
        }
    }

    return obj;
};

var merge = function merge(target, source, options) {
    /* eslint no-param-reassign: 0 */
    if (!source) {
        return target;
    }

    if (typeof source !== 'object') {
        if (isArray(target)) {
            target.push(source);
        } else if (target && typeof target === 'object') {
            if ((options && (options.plainObjects || options.allowPrototypes)) || !has.call(Object.prototype, source)) {
                target[source] = true;
            }
        } else {
            return [target, source];
        }

        return target;
    }

    if (!target || typeof target !== 'object') {
        return [target].concat(source);
    }

    var mergeTarget = target;
    if (isArray(target) && !isArray(source)) {
        mergeTarget = arrayToObject(target, options);
    }

    if (isArray(target) && isArray(source)) {
        source.forEach(function (item, i) {
            if (has.call(target, i)) {
                var targetItem = target[i];
                if (targetItem && typeof targetItem === 'object' && item && typeof item === 'object') {
                    target[i] = merge(targetItem, item, options);
                } else {
                    target.push(item);
                }
            } else {
                target[i] = item;
            }
        });
        return target;
    }

    return Object.keys(source).reduce(function (acc, key) {
        var value = source[key];

        if (has.call(acc, key)) {
            acc[key] = merge(acc[key], value, options);
        } else {
            acc[key] = value;
        }
        return acc;
    }, mergeTarget);
};

var assign = function assignSingleSource(target, source) {
    return Object.keys(source).reduce(function (acc, key) {
        acc[key] = source[key];
        return acc;
    }, target);
};

var decode = function (str, decoder, charset) {
    var strWithoutPlus = str.replace(/\+/g, ' ');
    if (charset === 'iso-8859-1') {
        // unescape never throws, no try...catch needed:
        return strWithoutPlus.replace(/%[0-9a-f]{2}/gi, unescape);
    }
    // utf-8
    try {
        return decodeURIComponent(strWithoutPlus);
    } catch (e) {
        return strWithoutPlus;
    }
};

var encode = function encode(str, defaultEncoder, charset) {
    // This code was originally written by Brian White (mscdex) for the io.js core querystring library.
    // It has been adapted here for stricter adherence to RFC 3986
    if (str.length === 0) {
        return str;
    }

    var string = str;
    if (typeof str === 'symbol') {
        string = Symbol.prototype.toString.call(str);
    } else if (typeof str !== 'string') {
        string = String(str);
    }

    if (charset === 'iso-8859-1') {
        return escape(string).replace(/%u[0-9a-f]{4}/gi, function ($0) {
            return '%26%23' + parseInt($0.slice(2), 16) + '%3B';
        });
    }

    var out = '';
    for (var i = 0; i < string.length; ++i) {
        var c = string.charCodeAt(i);

        if (
            c === 0x2D // -
            || c === 0x2E // .
            || c === 0x5F // _
            || c === 0x7E // ~
            || (c >= 0x30 && c <= 0x39) // 0-9
            || (c >= 0x41 && c <= 0x5A) // a-z
            || (c >= 0x61 && c <= 0x7A) // A-Z
        ) {
            out += string.charAt(i);
            continue;
        }

        if (c < 0x80) {
            out = out + hexTable[c];
            continue;
        }

        if (c < 0x800) {
            out = out + (hexTable[0xC0 | (c >> 6)] + hexTable[0x80 | (c & 0x3F)]);
            continue;
        }

        if (c < 0xD800 || c >= 0xE000) {
            out = out + (hexTable[0xE0 | (c >> 12)] + hexTable[0x80 | ((c >> 6) & 0x3F)] + hexTable[0x80 | (c & 0x3F)]);
            continue;
        }

        i += 1;
        c = 0x10000 + (((c & 0x3FF) << 10) | (string.charCodeAt(i) & 0x3FF));
        out += hexTable[0xF0 | (c >> 18)]
            + hexTable[0x80 | ((c >> 12) & 0x3F)]
            + hexTable[0x80 | ((c >> 6) & 0x3F)]
            + hexTable[0x80 | (c & 0x3F)];
    }

    return out;
};

var compact = function compact(value) {
    var queue = [{ obj: { o: value }, prop: 'o' }];
    var refs = [];

    for (var i = 0; i < queue.length; ++i) {
        var item = queue[i];
        var obj = item.obj[item.prop];

        var keys = Object.keys(obj);
        for (var j = 0; j < keys.length; ++j) {
            var key = keys[j];
            var val = obj[key];
            if (typeof val === 'object' && val !== null && refs.indexOf(val) === -1) {
                queue.push({ obj: obj, prop: key });
                refs.push(val);
            }
        }
    }

    compactQueue(queue);

    return value;
};

var isRegExp = function isRegExp(obj) {
    return Object.prototype.toString.call(obj) === '[object RegExp]';
};

var isBuffer = function isBuffer(obj) {
    if (!obj || typeof obj !== 'object') {
        return false;
    }

    return !!(obj.constructor && obj.constructor.isBuffer && obj.constructor.isBuffer(obj));
};

var combine = function combine(a, b) {
    return [].concat(a, b);
};

var maybeMap = function maybeMap(val, fn) {
    if (isArray(val)) {
        var mapped = [];
        for (var i = 0; i < val.length; i += 1) {
            mapped.push(fn(val[i]));
        }
        return mapped;
    }
    return fn(val);
};

module.exports = {
    arrayToObject: arrayToObject,
    assign: assign,
    combine: combine,
    compact: compact,
    decode: decode,
    encode: encode,
    isBuffer: isBuffer,
    isRegExp: isRegExp,
    maybeMap: maybeMap,
    merge: merge
};


/***/ }),

/***/ "./node_modules/@giphy/js-fetch-api/package.json":
/*!*******************************************************!*\
  !*** ./node_modules/@giphy/js-fetch-api/package.json ***!
  \*******************************************************/
/*! exports provided: _from, _id, _inBundle, _integrity, _location, _phantomChildren, _requested, _requiredBy, _resolved, _shasum, _spec, _where, bundleDependencies, dependencies, deprecated, description, devDependencies, files, gitHead, license, main, name, publishConfig, scripts, types, version, default */
/***/ (function(module) {

module.exports = JSON.parse("{\"_from\":\"@giphy/js-fetch-api\",\"_id\":\"@giphy/js-fetch-api@1.7.0\",\"_inBundle\":false,\"_integrity\":\"sha512-9rDofAfGEcQCS9tP7O9Eipq4EdciTzxS5F6/dlpwhJbt0lxSEVLBWyTbuhEivwcMNIXtlZlspnnmuJM6/dfsvQ==\",\"_location\":\"/@giphy/js-fetch-api\",\"_phantomChildren\":{},\"_requested\":{\"type\":\"tag\",\"registry\":true,\"raw\":\"@giphy/js-fetch-api\",\"name\":\"@giphy/js-fetch-api\",\"escapedName\":\"@giphy%2fjs-fetch-api\",\"scope\":\"@giphy\",\"rawSpec\":\"\",\"saveSpec\":null,\"fetchSpec\":\"latest\"},\"_requiredBy\":[\"#USER\",\"/\"],\"_resolved\":\"https://registry.npmjs.org/@giphy/js-fetch-api/-/js-fetch-api-1.7.0.tgz\",\"_shasum\":\"ddbcac8d575f0039c12323fc2920450a21206357\",\"_spec\":\"@giphy/js-fetch-api\",\"_where\":\"/home/forge/dev.cryptoparrot.com\",\"bundleDependencies\":false,\"dependencies\":{\"@giphy/js-types\":\"^2.1.0\",\"@giphy/js-util\":\"^1.9.2\",\"cookie\":\"0.4.1\",\"qs\":\"^6.9.4\"},\"deprecated\":false,\"description\":\"Javascript API to fetch gifs and stickers from the GIPHY API.\",\"devDependencies\":{\"@types/cookie\":\"^0.4.0\",\"@types/qs\":\"^6.9.4\",\"jest-fetch-mock\":\"^3.0.3\",\"parcel-bundler\":\"^1.12.4\",\"typedoc\":\"^0.18.0\",\"typedoc-thunder-theme\":\"^0.0.2\",\"typescript\":\"^4.0.2\"},\"files\":[\"dist/**/*\",\"src/**/*\"],\"gitHead\":\"2c35d620227bbdd4ae576fcff80f852b05cbc201\",\"license\":\"MIT\",\"main\":\"dist/index.js\",\"name\":\"@giphy/js-fetch-api\",\"publishConfig\":{\"access\":\"public\"},\"scripts\":{\"build\":\"tsc\",\"clean\":\"rm -rf ./dist\",\"dev\":\"parcel public/test.html\",\"docs\":\"typedoc\",\"prepublish\":\"npm run clean && tsc\",\"test\":\"jest --config ./jestconfig.js\",\"test:watch\":\"jest --config ./jestconfig.js --watchAll\"},\"types\":\"dist/index.d.ts\",\"version\":\"1.7.0\"}");

/***/ }),

/***/ "./node_modules/@giphy/js-util/dist/bestfit.js":
/*!*****************************************************!*\
  !*** ./node_modules/@giphy/js-util/dist/bestfit.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
exports.setRenditionScaleUpMaxPixels = void 0;
var log_1 = __webpack_require__(/*! ./log */ "./node_modules/@giphy/js-util/dist/log.js");
var closestArea = function (width, height, renditions) {
    var currentBest = Infinity;
    var result;
    // sort the renditions so we can avoid scaling up low resolutions
    renditions.forEach(function (rendition) {
        var widthPercentage = rendition.width / width;
        var heightPercentage = rendition.height / height;
        // a width percentage of 1 is exact, 2 is double, .5 half etc
        var areaPercentage = widthPercentage * heightPercentage;
        // img could be bigger or smaller
        var testBest = Math.abs(1 - areaPercentage); // the closer to 0 the better
        if (testBest < currentBest) {
            currentBest = testBest;
            result = rendition;
        }
    });
    return result;
};
var SCALE_UP_MAX_PIXELS = 50;
exports.setRenditionScaleUpMaxPixels = function (pixels) {
    log_1.Logger.debug("@giphy/js-util set rendition selection scale up max pixels to " + pixels);
    SCALE_UP_MAX_PIXELS = pixels;
};
/**
 * Finds image rendition that best fits a given container preferring images
 * ##### Note: all renditions are assumed to have the same aspect ratio
 *
 * When we have a portrait target and landscape gif, we choose a higher rendition to match
 * the height of the portrait target, otherwise it's blurry (same applies for landscape to portrait)
 *
 * @name bestfit
 * @function
 * @param {Array.<Object>} renditions available image renditions each having a width and height property
 * @param {Number} width
 * @param {Number} height
 * @param {Number} scaleUpMaxPixels the maximum pixels an asset should be scaled up
 */
function bestfit(renditions, width, height, scaleUpMaxPixels) {
    if (scaleUpMaxPixels === void 0) { scaleUpMaxPixels = SCALE_UP_MAX_PIXELS; }
    var largestRendition = renditions[0];
    // filter out renditions that are smaller than the target width and height by scaleUpMaxPixels value
    var testRenditions = renditions.filter(function (rendition) {
        if (rendition.width * rendition.height > largestRendition.width * largestRendition.height) {
            largestRendition = rendition;
        }
        return width - rendition.width <= scaleUpMaxPixels && height - rendition.height <= scaleUpMaxPixels;
    });
    // if all are too small, use the largest we have
    if (testRenditions.length === 0) {
        return largestRendition;
    }
    // find the closest area of the filtered renditions
    return closestArea(width, height, testRenditions);
}
exports.default = bestfit;
//# sourceMappingURL=bestfit.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-util/dist/collections.js":
/*!*********************************************************!*\
  !*** ./node_modules/@giphy/js-util/dist/collections.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
exports.pick = exports.without = exports.take = exports.forEach = exports.mapValues = void 0;
function mapValues(object, mapFn) {
    if (Array.isArray(object)) {
        throw "This map is just for objects, just use array.map for arrays";
    }
    return Object.keys(object).reduce(function (result, key) {
        result[key] = mapFn(object[key], key);
        return result;
    }, {});
}
exports.mapValues = mapValues;
function forEach(object, mapFn) {
    if (Array.isArray(object)) {
        throw "This map is just for objects, just use array.forEach for arrays";
    }
    return Object.keys(object).forEach(function (key) {
        mapFn(object[key], key);
    });
}
exports.forEach = forEach;
function take(arr, count) {
    if (count === void 0) { count = 0; }
    return arr.slice(0, count);
}
exports.take = take;
function without(arr, values) {
    return arr.filter(function (val) { return values.indexOf(val) === -1; });
}
exports.without = without;
function pick(object, pick) {
    var res = {};
    pick.forEach(function (key) {
        if (object[key] !== undefined) {
            res[key] = object[key];
        }
    });
    return res;
}
exports.pick = pick;
//# sourceMappingURL=collections.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-util/dist/construct-moat-data.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@giphy/js-util/dist/construct-moat-data.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
exports.constructMoatData = void 0;
exports.constructMoatData = function (_a) {
    var _b;
    var tdata = _a.tdata;
    var moatTrackerData = (((_b = tdata === null || tdata === void 0 ? void 0 : tdata.web) === null || _b === void 0 ? void 0 : _b.filter(function (tracker) { return tracker.vendor === 'Moat'; })) || [])[0];
    if (moatTrackerData === null || moatTrackerData === void 0 ? void 0 : moatTrackerData.verificationParameters) {
        var _c = moatTrackerData.verificationParameters, _d = _c.moatClientLevel1, moatClientLevel1 = _d === void 0 ? '_ADVERTISER_' : _d, _e = _c.moatClientLevel2, moatClientLevel2 = _e === void 0 ? '_CAMPAIGN_' : _e, _f = _c.moatClientLevel3, moatClientLevel3 = _f === void 0 ? '_LINE_ITEM_' : _f, _g = _c.moatClientLevel4, moatClientLevel4 = _g === void 0 ? '_CREATIVE_' : _g, _h = _c.moatClientSlicer1, moatClientSlicer1 = _h === void 0 ? '_SITE_' : _h, _j = _c.moatClientSlicer2, moatClientSlicer2 = _j === void 0 ? '_PLACEMENT_' : _j, _k = _c.zMoatPosition, zMoatPosition = _k === void 0 ? '_POSITION_' : _k;
        return {
            moatClientLevel1: moatClientLevel1,
            moatClientLevel2: moatClientLevel2,
            moatClientLevel3: moatClientLevel3,
            moatClientLevel4: moatClientLevel4,
            moatClientSlicer1: moatClientSlicer1,
            moatClientSlicer2: moatClientSlicer2,
            zMoatPosition: zMoatPosition,
        };
    }
};
//# sourceMappingURL=construct-moat-data.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-util/dist/get-client-rect-from-el.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@giphy/js-util/dist/get-client-rect-from-el.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
/**
 * @param el HTMLElement
 * @returns calculated properties of ClientRect
 */
var getClientRect = function (el) {
    var left = 0;
    var top = 0;
    var width = el.offsetWidth;
    var height = el.offsetHeight;
    // no layout thrash
    do {
        left += el.offsetLeft;
        top += el.offsetTop;
        el = el.offsetParent;
    } while (el);
    // TODO check this
    return { left: left, top: top, width: width, height: height, right: left + width, bottom: top + height };
};
exports.default = getClientRect;
//# sourceMappingURL=get-client-rect-from-el.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-util/dist/gif-utils.js":
/*!*******************************************************!*\
  !*** ./node_modules/@giphy/js-util/dist/gif-utils.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __assign = (this && this.__assign) || function () {
    __assign = Object.assign || function(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
                t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.getAltText = exports.getGifWidth = exports.getGifHeight = exports.getBestRenditionUrl = exports.getBestRendition = exports.getSpecificRendition = void 0;
var collections_1 = __webpack_require__(/*! ./collections */ "./node_modules/@giphy/js-util/dist/collections.js");
var bestfit_1 = __importDefault(__webpack_require__(/*! ./bestfit */ "./node_modules/@giphy/js-util/dist/bestfit.js"));
var webp_check_1 = __webpack_require__(/*! ./webp-check */ "./node_modules/@giphy/js-util/dist/webp-check.js");
exports.getSpecificRendition = function (_a, renditionLabel, isStill, useVideo) {
    var images = _a.images, isSticker = _a.is_sticker;
    if (isStill === void 0) { isStill = false; }
    if (useVideo === void 0) { useVideo = false; }
    if (!images || !renditionLabel)
        return '';
    isStill = isStill && !useVideo;
    // @ts-ignore come back to this
    var rendition = images["" + renditionLabel + (isStill ? '_still' : '')];
    if (rendition) {
        if (isSticker || isStill) {
            return rendition.url;
        }
        var webP = webp_check_1.SUPPORTS_WEBP && rendition.webp;
        return useVideo ? rendition.mp4 : webP || rendition.url;
    }
    return '';
};
var getRenditions = function (type, images, video) {
    return type === 'video' && video && video.previews && !Object.keys(images).length ? video.previews : images;
};
exports.getBestRendition = function (images, gifWidth, gifHeight, scaleUpMaxPixels) {
    var checkRenditions = collections_1.pick(images, [
        'original',
        'fixed_width',
        'fixed_height',
        'fixed_width_small',
        'fixed_height_small',
    ]);
    var testImages = Object.entries(checkRenditions).map(function (_a) {
        var renditionName = _a[0], val = _a[1];
        return (__assign({ renditionName: renditionName }, val));
    });
    return bestfit_1.default(testImages, gifWidth, gifHeight, scaleUpMaxPixels);
};
exports.getBestRenditionUrl = function (_a, gifWidth, gifHeight, options) {
    var images = _a.images, video = _a.video, type = _a.type;
    if (options === void 0) { options = { isStill: false, useVideo: false }; }
    if (!gifWidth || !gifHeight || !images)
        return '';
    var useVideo = options.useVideo, isStill = options.isStill, scaleUpMaxPixels = options.scaleUpMaxPixels;
    var renditions = getRenditions(type, images, video);
    var renditionName = exports.getBestRendition(renditions, gifWidth, gifHeight, scaleUpMaxPixels).renditionName;
    // still, video, webp or gif
    var key = "" + renditionName + (isStill && !useVideo ? '_still' : '');
    var rendition = renditions[key];
    var match = useVideo ? rendition.mp4 : webp_check_1.SUPPORTS_WEBP && rendition.webp ? rendition.webp : rendition.url;
    return (match || '');
};
exports.getGifHeight = function (_a, gifWidth) {
    var images = _a.images;
    var fixed_width = images.fixed_width;
    if (fixed_width) {
        var width = fixed_width.width, height = fixed_width.height;
        var aspectRatio = width / height;
        return Math.round(gifWidth / aspectRatio);
    }
    return 0;
};
exports.getGifWidth = function (_a, gifHeight) {
    var images = _a.images;
    var fixed_width = images.fixed_width;
    if (fixed_width) {
        var width = fixed_width.width, height = fixed_width.height;
        var aspectRatio = width / height;
        return Math.round(gifHeight * aspectRatio);
    }
    return 0;
};
/**
 * GIF Text - Alt Text: Generates alt text for
 * GIF images based on username and tags.
 * @prop  {Gif}
 * @return {String} GIF alt text.
 */
exports.getAltText = function (_a) {
    var user = _a.user, _b = _a.tags, tags = _b === void 0 ? [] : _b, _c = _a.is_sticker, is_sticker = _c === void 0 ? false : _c, _d = _a.title, title = _d === void 0 ? '' : _d;
    if (title) {
        return title;
    }
    var username = (user && user.username) || '';
    var filteredTags = collections_1.take(collections_1.without(tags, ['transparent']), username ? 4 : 5);
    return "" + (username ? username + " " : "") + filteredTags.join(' ') + " " + (is_sticker ? 'Sticker' : 'GIF');
};
//# sourceMappingURL=gif-utils.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-util/dist/index.js":
/*!***************************************************!*\
  !*** ./node_modules/@giphy/js-util/dist/index.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    Object.defineProperty(o, k2, { enumerable: true, get: function() { return m[k]; } });
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __exportStar = (this && this.__exportStar) || function(m, exports) {
    for (var p in m) if (p !== "default" && !Object.prototype.hasOwnProperty.call(exports, p)) __createBinding(exports, m, p);
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.checkIfWebP = exports.injectTrackingPixel = exports.getSpecificRendition = exports.getGifWidth = exports.getGifHeight = exports.getBestRenditionUrl = exports.getBestRendition = exports.getAltText = exports.getClientRect = exports.setRenditionScaleUpMaxPixels = exports.bestfit = void 0;
var bestfit_1 = __webpack_require__(/*! ./bestfit */ "./node_modules/@giphy/js-util/dist/bestfit.js");
Object.defineProperty(exports, "bestfit", { enumerable: true, get: function () { return __importDefault(bestfit_1).default; } });
Object.defineProperty(exports, "setRenditionScaleUpMaxPixels", { enumerable: true, get: function () { return bestfit_1.setRenditionScaleUpMaxPixels; } });
__exportStar(__webpack_require__(/*! ./collections */ "./node_modules/@giphy/js-util/dist/collections.js"), exports);
__exportStar(__webpack_require__(/*! ./construct-moat-data */ "./node_modules/@giphy/js-util/dist/construct-moat-data.js"), exports);
var get_client_rect_from_el_1 = __webpack_require__(/*! ./get-client-rect-from-el */ "./node_modules/@giphy/js-util/dist/get-client-rect-from-el.js");
Object.defineProperty(exports, "getClientRect", { enumerable: true, get: function () { return __importDefault(get_client_rect_from_el_1).default; } });
var gif_utils_1 = __webpack_require__(/*! ./gif-utils */ "./node_modules/@giphy/js-util/dist/gif-utils.js");
Object.defineProperty(exports, "getAltText", { enumerable: true, get: function () { return gif_utils_1.getAltText; } });
Object.defineProperty(exports, "getBestRendition", { enumerable: true, get: function () { return gif_utils_1.getBestRendition; } });
Object.defineProperty(exports, "getBestRenditionUrl", { enumerable: true, get: function () { return gif_utils_1.getBestRenditionUrl; } });
Object.defineProperty(exports, "getGifHeight", { enumerable: true, get: function () { return gif_utils_1.getGifHeight; } });
Object.defineProperty(exports, "getGifWidth", { enumerable: true, get: function () { return gif_utils_1.getGifWidth; } });
Object.defineProperty(exports, "getSpecificRendition", { enumerable: true, get: function () { return gif_utils_1.getSpecificRendition; } });
__exportStar(__webpack_require__(/*! ./log */ "./node_modules/@giphy/js-util/dist/log.js"), exports);
__exportStar(__webpack_require__(/*! ./sdk-headers */ "./node_modules/@giphy/js-util/dist/sdk-headers.js"), exports);
var tracking_pixel_1 = __webpack_require__(/*! ./tracking-pixel */ "./node_modules/@giphy/js-util/dist/tracking-pixel.js");
Object.defineProperty(exports, "injectTrackingPixel", { enumerable: true, get: function () { return __importDefault(tracking_pixel_1).default; } });
var webp_check_1 = __webpack_require__(/*! ./webp-check */ "./node_modules/@giphy/js-util/dist/webp-check.js");
Object.defineProperty(exports, "checkIfWebP", { enumerable: true, get: function () { return webp_check_1.checkIfWebP; } });
//# sourceMappingURL=index.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-util/dist/log.js":
/*!*************************************************!*\
  !*** ./node_modules/@giphy/js-util/dist/log.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __spreadArrays = (this && this.__spreadArrays) || function () {
    for (var s = 0, i = 0, il = arguments.length; i < il; i++) s += arguments[i].length;
    for (var r = Array(s), k = 0, i = 0; i < il; i++)
        for (var a = arguments[i], j = 0, jl = a.length; j < jl; j++, k++)
            r[k] = a[j];
    return r;
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.Logger = exports.LogLevel = void 0;
/* istanbul ignore next */
var LogLevel;
(function (LogLevel) {
    LogLevel[LogLevel["DEBUG"] = 0] = "DEBUG";
    LogLevel[LogLevel["INFO"] = 1] = "INFO";
    LogLevel[LogLevel["WARN"] = 2] = "WARN";
    LogLevel[LogLevel["ERROR"] = 3] = "ERROR";
})(LogLevel = exports.LogLevel || (exports.LogLevel = {}));
/* istanbul ignore next */
exports.Logger = {
    ENABLED: typeof window !== 'undefined' && location && location.search.indexOf('giphy-debug') !== -1,
    LEVEL: 0,
    PREFIX: 'GiphyJS',
    debug: function () {
        var msg = [];
        for (var _i = 0; _i < arguments.length; _i++) {
            msg[_i] = arguments[_i];
        }
        if (exports.Logger.ENABLED && exports.Logger.LEVEL <= LogLevel.DEBUG) {
            console.debug.apply(console, __spreadArrays([exports.Logger.PREFIX], msg)); // eslint-disable-line no-console
        }
    },
    info: function () {
        var msg = [];
        for (var _i = 0; _i < arguments.length; _i++) {
            msg[_i] = arguments[_i];
        }
        if (exports.Logger.ENABLED && exports.Logger.LEVEL <= LogLevel.INFO) {
            console.info.apply(console, __spreadArrays([exports.Logger.PREFIX], msg)); // eslint-disable-line no-console
        }
    },
    warn: function () {
        var msg = [];
        for (var _i = 0; _i < arguments.length; _i++) {
            msg[_i] = arguments[_i];
        }
        if (exports.Logger.ENABLED && exports.Logger.LEVEL <= LogLevel.WARN) {
            console.warn.apply(console, __spreadArrays([exports.Logger.PREFIX], msg)); // eslint-disable-line no-console
        }
    },
    error: function () {
        var msg = [];
        for (var _i = 0; _i < arguments.length; _i++) {
            msg[_i] = arguments[_i];
        }
        if (exports.Logger.ENABLED && exports.Logger.LEVEL <= LogLevel.ERROR) {
            console.error.apply(console, __spreadArrays([exports.Logger.PREFIX], msg)); // eslint-disable-line no-console
        }
    },
};
//# sourceMappingURL=log.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-util/dist/sdk-headers.js":
/*!*********************************************************!*\
  !*** ./node_modules/@giphy/js-util/dist/sdk-headers.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(global) {
Object.defineProperty(exports, "__esModule", { value: true });
exports.appendGiphySDKRequestParam = exports.appendGiphySDKRequestHeader = exports.getGiphySDKRequestHeaders = void 0;
var gl = ((typeof window !== 'undefined' ? window : global) || {});
// define _GIPHY_SDK_HEADERS_ if they don't exist
gl._GIPHY_SDK_HEADERS_ =
    gl._GIPHY_SDK_HEADERS_ ||
        (gl.Headers
            ? new gl.Headers({
                'X-GIPHY-SDK-PLATFORM': 'web',
            })
            : undefined);
exports.getGiphySDKRequestHeaders = function () { return gl._GIPHY_SDK_HEADERS_; };
exports.appendGiphySDKRequestHeader = function (key, value) { var _a; return (_a = exports.getGiphySDKRequestHeaders()) === null || _a === void 0 ? void 0 : _a.set(key, value); };
exports.appendGiphySDKRequestParam = function (key, value) { var _a; return (_a = exports.getGiphySDKRequestHeaders()) === null || _a === void 0 ? void 0 : _a.set(key, value); };
//# sourceMappingURL=sdk-headers.js.map
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ "./node_modules/@giphy/js-util/dist/tracking-pixel.js":
/*!************************************************************!*\
  !*** ./node_modules/@giphy/js-util/dist/tracking-pixel.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
var dompurify_1 = __webpack_require__(/*! dompurify */ "./node_modules/dompurify/dist/purify.js");
var injectTrackingPixel = function (tags) {
    if (tags === void 0) { tags = []; }
    tags.forEach(function (tag) {
        var _a;
        var el = document.createElement('html');
        tag = tag.replace('%%CACHEBUSTER%%', Date.now().toString());
        el.innerHTML = dompurify_1.sanitize(tag);
        var pixel = el.querySelector('img');
        if (pixel) {
            (_a = document === null || document === void 0 ? void 0 : document.querySelector('head')) === null || _a === void 0 ? void 0 : _a.appendChild(pixel);
        }
    });
};
exports.default = injectTrackingPixel;
//# sourceMappingURL=tracking-pixel.js.map

/***/ }),

/***/ "./node_modules/@giphy/js-util/dist/webp-check.js":
/*!********************************************************!*\
  !*** ./node_modules/@giphy/js-util/dist/webp-check.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
exports.checkIfWebP = exports.SUPPORTS_WEBP = void 0;
exports.SUPPORTS_WEBP = null;
/* istanbul ignore next */
exports.checkIfWebP = new Promise(function (resolve) {
    if (typeof Image === 'undefined') {
        resolve(false);
    }
    var webp = new Image();
    webp.onload = function () {
        exports.SUPPORTS_WEBP = true;
        resolve(exports.SUPPORTS_WEBP);
    };
    webp.onerror = function () {
        exports.SUPPORTS_WEBP = false;
        resolve(exports.SUPPORTS_WEBP);
    };
    webp.src =
        'data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA';
});
//# sourceMappingURL=webp-check.js.map

/***/ }),

/***/ "./node_modules/bricks.js/dist/bricks.module.js":
/*!******************************************************!*\
  !*** ./node_modules/bricks.js/dist/bricks.module.js ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var _extends = Object.assign || function (target) {
  for (var i = 1; i < arguments.length; i++) {
    var source = arguments[i];

    for (var key in source) {
      if (Object.prototype.hasOwnProperty.call(source, key)) {
        target[key] = source[key];
      }
    }
  }

  return target;
};

var knot = function knot() {
  var extended = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

  var events = Object.create(null);

  function on(name, handler) {
    events[name] = events[name] || [];
    events[name].push(handler);
    return this;
  }

  function once(name, handler) {
    handler._once = true;
    on(name, handler);
    return this;
  }

  function off(name) {
    var handler = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

    handler ? events[name].splice(events[name].indexOf(handler), 1) : delete events[name];

    return this;
  }

  function emit(name) {
    var _this = this;

    for (var _len = arguments.length, args = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
      args[_key - 1] = arguments[_key];
    }

    // cache the events, to avoid consequences of mutation
    var cache = events[name] && events[name].slice();

    // only fire handlers if they exist
    cache && cache.forEach(function (handler) {
      // remove handlers added with 'once'
      handler._once && off(name, handler);

      // set 'this' context, pass args to handlers
      handler.apply(_this, args);
    });

    return this;
  }

  return _extends({}, extended, {

    on: on,
    once: once,
    off: off,
    emit: emit
  });
};

var bricks = function bricks() {
  var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

  // privates

  var persist = void 0; // packing new elements, or all elements?
  var ticking = void 0; // for debounced resize

  var sizeIndex = void 0;
  var sizeDetail = void 0;

  var columnTarget = void 0;
  var columnHeights = void 0;

  var nodeTop = void 0;
  var nodeLeft = void 0;
  var nodeWidth = void 0;
  var nodeHeight = void 0;

  var nodes = void 0;
  var nodesWidths = void 0;
  var nodesHeights = void 0;

  // resolve options

  var packed = options.packed.indexOf('data-') === 0 ? options.packed : 'data-' + options.packed;
  var sizes = options.sizes.slice().reverse();
  var position = options.position !== false;

  var container = options.container.nodeType ? options.container : document.querySelector(options.container);

  var selectors = {
    all: function all() {
      return toArray(container.children);
    },
    new: function _new() {
      return toArray(container.children).filter(function (node) {
        return !node.hasAttribute('' + packed);
      });
    }
  };

  // series

  var setup = [setSizeIndex, setSizeDetail, setColumns];

  var run = [setNodes, setNodesDimensions, setNodesStyles, setContainerStyles];

  // instance

  var instance = knot({
    pack: pack,
    update: update,
    resize: resize
  });

  return instance;

  // general helpers

  function runSeries(functions) {
    functions.forEach(function (func) {
      return func();
    });
  }

  // array helpers

  function toArray(input) {
    var scope = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document;

    return Array.prototype.slice.call(input);
  }

  function fillArray(length) {
    return Array.apply(null, Array(length)).map(function () {
      return 0;
    });
  }

  // size helpers

  function getSizeIndex() {
    // find index of widest matching media query
    return sizes.map(function (size) {
      return size.mq && window.matchMedia('(min-width: ' + size.mq + ')').matches;
    }).indexOf(true);
  }

  function setSizeIndex() {
    sizeIndex = getSizeIndex();
  }

  function setSizeDetail() {
    // if no media queries matched, use the base case
    sizeDetail = sizeIndex === -1 ? sizes[sizes.length - 1] : sizes[sizeIndex];
  }

  // column helpers

  function setColumns() {
    columnHeights = fillArray(sizeDetail.columns);
  }

  // node helpers

  function setNodes() {
    nodes = selectors[persist ? 'new' : 'all']();
  }

  function setNodesDimensions() {
    // exit if empty container
    if (nodes.length === 0) {
      return;
    }

    nodesWidths = nodes.map(function (element) {
      return element.clientWidth;
    });
    nodesHeights = nodes.map(function (element) {
      return element.clientHeight;
    });
  }

  function setNodesStyles() {
    nodes.forEach(function (element, index) {
      columnTarget = columnHeights.indexOf(Math.min.apply(Math, columnHeights));

      element.style.position = 'absolute';

      nodeTop = columnHeights[columnTarget] + 'px';
      nodeLeft = columnTarget * nodesWidths[index] + columnTarget * sizeDetail.gutter + 'px';

      // support positioned elements (default) or transformed elements
      if (position) {
        element.style.top = nodeTop;
        element.style.left = nodeLeft;
      } else {
        element.style.transform = 'translate3d(' + nodeLeft + ', ' + nodeTop + ', 0)';
      }

      element.setAttribute(packed, '');

      // ignore nodes with no width and/or height
      nodeWidth = nodesWidths[index];
      nodeHeight = nodesHeights[index];

      if (nodeWidth && nodeHeight) {
        columnHeights[columnTarget] += nodeHeight + sizeDetail.gutter;
      }
    });
  }

  // container helpers

  function setContainerStyles() {
    container.style.position = 'relative';
    container.style.width = sizeDetail.columns * nodeWidth + (sizeDetail.columns - 1) * sizeDetail.gutter + 'px';
    container.style.height = Math.max.apply(Math, columnHeights) - sizeDetail.gutter + 'px';
  }

  // resize helpers

  function resizeFrame() {
    if (!ticking) {
      window.requestAnimationFrame(resizeHandler);
      ticking = true;
    }
  }

  function resizeHandler() {
    if (sizeIndex !== getSizeIndex()) {
      pack();
      instance.emit('resize', sizeDetail);
    }

    ticking = false;
  }

  // API

  function pack() {
    persist = false;
    runSeries(setup.concat(run));

    return instance.emit('pack');
  }

  function update() {
    persist = true;
    runSeries(run);

    return instance.emit('update');
  }

  function resize() {
    var flag = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

    var action = flag ? 'addEventListener' : 'removeEventListener';

    window[action]('resize', resizeFrame);

    return instance;
  }
};

/* harmony default export */ __webpack_exports__["default"] = (bricks);


/***/ }),

/***/ "./node_modules/create-emotion/dist/create-emotion.browser.esm.js":
/*!************************************************************************!*\
  !*** ./node_modules/create-emotion/dist/create-emotion.browser.esm.js ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _emotion_cache__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @emotion/cache */ "./node_modules/@emotion/cache/dist/cache.browser.esm.js");
/* harmony import */ var _emotion_serialize__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @emotion/serialize */ "./node_modules/@emotion/serialize/dist/serialize.browser.esm.js");
/* harmony import */ var _emotion_utils__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @emotion/utils */ "./node_modules/@emotion/utils/dist/utils.browser.esm.js");




function insertWithoutScoping(cache, serialized) {
  if (cache.inserted[serialized.name] === undefined) {
    return cache.insert('', serialized, cache.sheet, true);
  }
}

function merge(registered, css, className) {
  var registeredStyles = [];
  var rawClassName = Object(_emotion_utils__WEBPACK_IMPORTED_MODULE_2__["getRegisteredStyles"])(registered, registeredStyles, className);

  if (registeredStyles.length < 2) {
    return className;
  }

  return rawClassName + css(registeredStyles);
}

var createEmotion = function createEmotion(options) {
  var cache = Object(_emotion_cache__WEBPACK_IMPORTED_MODULE_0__["default"])(options); // $FlowFixMe

  cache.sheet.speedy = function (value) {
    if ( true && this.ctr !== 0) {
      throw new Error('speedy must be changed before any rules are inserted');
    }

    this.isSpeedy = value;
  };

  cache.compat = true;

  var css = function css() {
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    var serialized = Object(_emotion_serialize__WEBPACK_IMPORTED_MODULE_1__["serializeStyles"])(args, cache.registered, undefined);
    Object(_emotion_utils__WEBPACK_IMPORTED_MODULE_2__["insertStyles"])(cache, serialized, false);
    return cache.key + "-" + serialized.name;
  };

  var keyframes = function keyframes() {
    for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
      args[_key2] = arguments[_key2];
    }

    var serialized = Object(_emotion_serialize__WEBPACK_IMPORTED_MODULE_1__["serializeStyles"])(args, cache.registered);
    var animation = "animation-" + serialized.name;
    insertWithoutScoping(cache, {
      name: serialized.name,
      styles: "@keyframes " + animation + "{" + serialized.styles + "}"
    });
    return animation;
  };

  var injectGlobal = function injectGlobal() {
    for (var _len3 = arguments.length, args = new Array(_len3), _key3 = 0; _key3 < _len3; _key3++) {
      args[_key3] = arguments[_key3];
    }

    var serialized = Object(_emotion_serialize__WEBPACK_IMPORTED_MODULE_1__["serializeStyles"])(args, cache.registered);
    insertWithoutScoping(cache, serialized);
  };

  var cx = function cx() {
    for (var _len4 = arguments.length, args = new Array(_len4), _key4 = 0; _key4 < _len4; _key4++) {
      args[_key4] = arguments[_key4];
    }

    return merge(cache.registered, css, classnames(args));
  };

  return {
    css: css,
    cx: cx,
    injectGlobal: injectGlobal,
    keyframes: keyframes,
    hydrate: function hydrate(ids) {
      ids.forEach(function (key) {
        cache.inserted[key] = true;
      });
    },
    flush: function flush() {
      cache.registered = {};
      cache.inserted = {};
      cache.sheet.flush();
    },
    // $FlowFixMe
    sheet: cache.sheet,
    cache: cache,
    getRegisteredStyles: _emotion_utils__WEBPACK_IMPORTED_MODULE_2__["getRegisteredStyles"].bind(null, cache.registered),
    merge: merge.bind(null, cache.registered, css)
  };
};

var classnames = function classnames(args) {
  var cls = '';

  for (var i = 0; i < args.length; i++) {
    var arg = args[i];
    if (arg == null) continue;
    var toAdd = void 0;

    switch (typeof arg) {
      case 'boolean':
        break;

      case 'object':
        {
          if (Array.isArray(arg)) {
            toAdd = classnames(arg);
          } else {
            toAdd = '';

            for (var k in arg) {
              if (arg[k] && k) {
                toAdd && (toAdd += ' ');
                toAdd += k;
              }
            }
          }

          break;
        }

      default:
        {
          toAdd = arg;
        }
    }

    if (toAdd) {
      cls && (cls += ' ');
      cls += toAdd;
    }
  }

  return cls;
};

/* harmony default export */ __webpack_exports__["default"] = (createEmotion);


/***/ }),

/***/ "./node_modules/dompurify/dist/purify.js":
/*!***********************************************!*\
  !*** ./node_modules/dompurify/dist/purify.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/*! @license DOMPurify | (c) Cure53 and other contributors | Released under the Apache license 2.0 and Mozilla Public License 2.0 | github.com/cure53/DOMPurify/blob/2.0.8/LICENSE */

(function (global, factory) {
   true ? module.exports = factory() :
  undefined;
}(this, function () { 'use strict';

  function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

  var hasOwnProperty = Object.hasOwnProperty,
      setPrototypeOf = Object.setPrototypeOf,
      isFrozen = Object.isFrozen;
  var freeze = Object.freeze,
      seal = Object.seal,
      create = Object.create; // eslint-disable-line import/no-mutable-exports

  var _ref = typeof Reflect !== 'undefined' && Reflect,
      apply = _ref.apply,
      construct = _ref.construct;

  if (!apply) {
    apply = function apply(fun, thisValue, args) {
      return fun.apply(thisValue, args);
    };
  }

  if (!freeze) {
    freeze = function freeze(x) {
      return x;
    };
  }

  if (!seal) {
    seal = function seal(x) {
      return x;
    };
  }

  if (!construct) {
    construct = function construct(Func, args) {
      return new (Function.prototype.bind.apply(Func, [null].concat(_toConsumableArray(args))))();
    };
  }

  var arrayForEach = unapply(Array.prototype.forEach);
  var arrayPop = unapply(Array.prototype.pop);
  var arrayPush = unapply(Array.prototype.push);

  var stringToLowerCase = unapply(String.prototype.toLowerCase);
  var stringMatch = unapply(String.prototype.match);
  var stringReplace = unapply(String.prototype.replace);
  var stringIndexOf = unapply(String.prototype.indexOf);
  var stringTrim = unapply(String.prototype.trim);

  var regExpTest = unapply(RegExp.prototype.test);

  var typeErrorCreate = unconstruct(TypeError);

  function unapply(func) {
    return function (thisArg) {
      for (var _len = arguments.length, args = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
        args[_key - 1] = arguments[_key];
      }

      return apply(func, thisArg, args);
    };
  }

  function unconstruct(func) {
    return function () {
      for (var _len2 = arguments.length, args = Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
        args[_key2] = arguments[_key2];
      }

      return construct(func, args);
    };
  }

  /* Add properties to a lookup table */
  function addToSet(set, array) {
    if (setPrototypeOf) {
      // Make 'in' and truthy checks like Boolean(set.constructor)
      // independent of any properties defined on Object.prototype.
      // Prevent prototype setters from intercepting set as a this value.
      setPrototypeOf(set, null);
    }

    var l = array.length;
    while (l--) {
      var element = array[l];
      if (typeof element === 'string') {
        var lcElement = stringToLowerCase(element);
        if (lcElement !== element) {
          // Config presets (e.g. tags.js, attrs.js) are immutable.
          if (!isFrozen(array)) {
            array[l] = lcElement;
          }

          element = lcElement;
        }
      }

      set[element] = true;
    }

    return set;
  }

  /* Shallow clone an object */
  function clone(object) {
    var newObject = create(null);

    var property = void 0;
    for (property in object) {
      if (apply(hasOwnProperty, object, [property])) {
        newObject[property] = object[property];
      }
    }

    return newObject;
  }

  var html = freeze(['a', 'abbr', 'acronym', 'address', 'area', 'article', 'aside', 'audio', 'b', 'bdi', 'bdo', 'big', 'blink', 'blockquote', 'body', 'br', 'button', 'canvas', 'caption', 'center', 'cite', 'code', 'col', 'colgroup', 'content', 'data', 'datalist', 'dd', 'decorator', 'del', 'details', 'dfn', 'dir', 'div', 'dl', 'dt', 'element', 'em', 'fieldset', 'figcaption', 'figure', 'font', 'footer', 'form', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'head', 'header', 'hgroup', 'hr', 'html', 'i', 'img', 'input', 'ins', 'kbd', 'label', 'legend', 'li', 'main', 'map', 'mark', 'marquee', 'menu', 'menuitem', 'meter', 'nav', 'nobr', 'ol', 'optgroup', 'option', 'output', 'p', 'picture', 'pre', 'progress', 'q', 'rp', 'rt', 'ruby', 's', 'samp', 'section', 'select', 'shadow', 'small', 'source', 'spacer', 'span', 'strike', 'strong', 'style', 'sub', 'summary', 'sup', 'table', 'tbody', 'td', 'template', 'textarea', 'tfoot', 'th', 'thead', 'time', 'tr', 'track', 'tt', 'u', 'ul', 'var', 'video', 'wbr']);

  // SVG
  var svg = freeze(['svg', 'a', 'altglyph', 'altglyphdef', 'altglyphitem', 'animatecolor', 'animatemotion', 'animatetransform', 'audio', 'canvas', 'circle', 'clippath', 'defs', 'desc', 'ellipse', 'filter', 'font', 'g', 'glyph', 'glyphref', 'hkern', 'image', 'line', 'lineargradient', 'marker', 'mask', 'metadata', 'mpath', 'path', 'pattern', 'polygon', 'polyline', 'radialgradient', 'rect', 'stop', 'style', 'switch', 'symbol', 'text', 'textpath', 'title', 'tref', 'tspan', 'video', 'view', 'vkern']);

  var svgFilters = freeze(['feBlend', 'feColorMatrix', 'feComponentTransfer', 'feComposite', 'feConvolveMatrix', 'feDiffuseLighting', 'feDisplacementMap', 'feDistantLight', 'feFlood', 'feFuncA', 'feFuncB', 'feFuncG', 'feFuncR', 'feGaussianBlur', 'feMerge', 'feMergeNode', 'feMorphology', 'feOffset', 'fePointLight', 'feSpecularLighting', 'feSpotLight', 'feTile', 'feTurbulence']);

  var mathMl = freeze(['math', 'menclose', 'merror', 'mfenced', 'mfrac', 'mglyph', 'mi', 'mlabeledtr', 'mmultiscripts', 'mn', 'mo', 'mover', 'mpadded', 'mphantom', 'mroot', 'mrow', 'ms', 'mspace', 'msqrt', 'mstyle', 'msub', 'msup', 'msubsup', 'mtable', 'mtd', 'mtext', 'mtr', 'munder', 'munderover']);

  var text = freeze(['#text']);

  var html$1 = freeze(['accept', 'action', 'align', 'alt', 'autocapitalize', 'autocomplete', 'autopictureinpicture', 'autoplay', 'background', 'bgcolor', 'border', 'capture', 'cellpadding', 'cellspacing', 'checked', 'cite', 'class', 'clear', 'color', 'cols', 'colspan', 'controls', 'controlslist', 'coords', 'crossorigin', 'datetime', 'decoding', 'default', 'dir', 'disabled', 'disablepictureinpicture', 'disableremoteplayback', 'download', 'draggable', 'enctype', 'enterkeyhint', 'face', 'for', 'headers', 'height', 'hidden', 'high', 'href', 'hreflang', 'id', 'inputmode', 'integrity', 'ismap', 'kind', 'label', 'lang', 'list', 'loading', 'loop', 'low', 'max', 'maxlength', 'media', 'method', 'min', 'minlength', 'multiple', 'muted', 'name', 'noshade', 'novalidate', 'nowrap', 'open', 'optimum', 'pattern', 'placeholder', 'playsinline', 'poster', 'preload', 'pubdate', 'radiogroup', 'readonly', 'rel', 'required', 'rev', 'reversed', 'role', 'rows', 'rowspan', 'spellcheck', 'scope', 'selected', 'shape', 'size', 'sizes', 'span', 'srclang', 'start', 'src', 'srcset', 'step', 'style', 'summary', 'tabindex', 'title', 'translate', 'type', 'usemap', 'valign', 'value', 'width', 'xmlns']);

  var svg$1 = freeze(['accent-height', 'accumulate', 'additive', 'alignment-baseline', 'ascent', 'attributename', 'attributetype', 'azimuth', 'basefrequency', 'baseline-shift', 'begin', 'bias', 'by', 'class', 'clip', 'clippathunits', 'clip-path', 'clip-rule', 'color', 'color-interpolation', 'color-interpolation-filters', 'color-profile', 'color-rendering', 'cx', 'cy', 'd', 'dx', 'dy', 'diffuseconstant', 'direction', 'display', 'divisor', 'dur', 'edgemode', 'elevation', 'end', 'fill', 'fill-opacity', 'fill-rule', 'filter', 'filterunits', 'flood-color', 'flood-opacity', 'font-family', 'font-size', 'font-size-adjust', 'font-stretch', 'font-style', 'font-variant', 'font-weight', 'fx', 'fy', 'g1', 'g2', 'glyph-name', 'glyphref', 'gradientunits', 'gradienttransform', 'height', 'href', 'id', 'image-rendering', 'in', 'in2', 'k', 'k1', 'k2', 'k3', 'k4', 'kerning', 'keypoints', 'keysplines', 'keytimes', 'lang', 'lengthadjust', 'letter-spacing', 'kernelmatrix', 'kernelunitlength', 'lighting-color', 'local', 'marker-end', 'marker-mid', 'marker-start', 'markerheight', 'markerunits', 'markerwidth', 'maskcontentunits', 'maskunits', 'max', 'mask', 'media', 'method', 'mode', 'min', 'name', 'numoctaves', 'offset', 'operator', 'opacity', 'order', 'orient', 'orientation', 'origin', 'overflow', 'paint-order', 'path', 'pathlength', 'patterncontentunits', 'patterntransform', 'patternunits', 'points', 'preservealpha', 'preserveaspectratio', 'primitiveunits', 'r', 'rx', 'ry', 'radius', 'refx', 'refy', 'repeatcount', 'repeatdur', 'restart', 'result', 'rotate', 'scale', 'seed', 'shape-rendering', 'specularconstant', 'specularexponent', 'spreadmethod', 'startoffset', 'stddeviation', 'stitchtiles', 'stop-color', 'stop-opacity', 'stroke-dasharray', 'stroke-dashoffset', 'stroke-linecap', 'stroke-linejoin', 'stroke-miterlimit', 'stroke-opacity', 'stroke', 'stroke-width', 'style', 'surfacescale', 'systemlanguage', 'tabindex', 'targetx', 'targety', 'transform', 'text-anchor', 'text-decoration', 'text-rendering', 'textlength', 'type', 'u1', 'u2', 'unicode', 'values', 'viewbox', 'visibility', 'version', 'vert-adv-y', 'vert-origin-x', 'vert-origin-y', 'width', 'word-spacing', 'wrap', 'writing-mode', 'xchannelselector', 'ychannelselector', 'x', 'x1', 'x2', 'xmlns', 'y', 'y1', 'y2', 'z', 'zoomandpan']);

  var mathMl$1 = freeze(['accent', 'accentunder', 'align', 'bevelled', 'close', 'columnsalign', 'columnlines', 'columnspan', 'denomalign', 'depth', 'dir', 'display', 'displaystyle', 'encoding', 'fence', 'frame', 'height', 'href', 'id', 'largeop', 'length', 'linethickness', 'lspace', 'lquote', 'mathbackground', 'mathcolor', 'mathsize', 'mathvariant', 'maxsize', 'minsize', 'movablelimits', 'notation', 'numalign', 'open', 'rowalign', 'rowlines', 'rowspacing', 'rowspan', 'rspace', 'rquote', 'scriptlevel', 'scriptminsize', 'scriptsizemultiplier', 'selection', 'separator', 'separators', 'stretchy', 'subscriptshift', 'supscriptshift', 'symmetric', 'voffset', 'width', 'xmlns']);

  var xml = freeze(['xlink:href', 'xml:id', 'xlink:title', 'xml:space', 'xmlns:xlink']);

  // eslint-disable-next-line unicorn/better-regex
  var MUSTACHE_EXPR = seal(/\{\{[\s\S]*|[\s\S]*\}\}/gm); // Specify template detection regex for SAFE_FOR_TEMPLATES mode
  var ERB_EXPR = seal(/<%[\s\S]*|[\s\S]*%>/gm);
  var DATA_ATTR = seal(/^data-[\-\w.\u00B7-\uFFFF]/); // eslint-disable-line no-useless-escape
  var ARIA_ATTR = seal(/^aria-[\-\w]+$/); // eslint-disable-line no-useless-escape
  var IS_ALLOWED_URI = seal(/^(?:(?:(?:f|ht)tps?|mailto|tel|callto|cid|xmpp):|[^a-z]|[a-z+.\-]+(?:[^a-z+.\-:]|$))/i // eslint-disable-line no-useless-escape
  );
  var IS_SCRIPT_OR_DATA = seal(/^(?:\w+script|data):/i);
  var ATTR_WHITESPACE = seal(/[\u0000-\u0020\u00A0\u1680\u180E\u2000-\u2029\u205F\u3000]/g // eslint-disable-line no-control-regex
  );

  var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

  function _toConsumableArray$1(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

  var getGlobal = function getGlobal() {
    return typeof window === 'undefined' ? null : window;
  };

  /**
   * Creates a no-op policy for internal use only.
   * Don't export this function outside this module!
   * @param {?TrustedTypePolicyFactory} trustedTypes The policy factory.
   * @param {Document} document The document object (to determine policy name suffix)
   * @return {?TrustedTypePolicy} The policy created (or null, if Trusted Types
   * are not supported).
   */
  var _createTrustedTypesPolicy = function _createTrustedTypesPolicy(trustedTypes, document) {
    if ((typeof trustedTypes === 'undefined' ? 'undefined' : _typeof(trustedTypes)) !== 'object' || typeof trustedTypes.createPolicy !== 'function') {
      return null;
    }

    // Allow the callers to control the unique policy name
    // by adding a data-tt-policy-suffix to the script element with the DOMPurify.
    // Policy creation with duplicate names throws in Trusted Types.
    var suffix = null;
    var ATTR_NAME = 'data-tt-policy-suffix';
    if (document.currentScript && document.currentScript.hasAttribute(ATTR_NAME)) {
      suffix = document.currentScript.getAttribute(ATTR_NAME);
    }

    var policyName = 'dompurify' + (suffix ? '#' + suffix : '');

    try {
      return trustedTypes.createPolicy(policyName, {
        createHTML: function createHTML(html$$1) {
          return html$$1;
        }
      });
    } catch (_) {
      // Policy creation failed (most likely another DOMPurify script has
      // already run). Skip creating the policy, as this will only cause errors
      // if TT are enforced.
      console.warn('TrustedTypes policy ' + policyName + ' could not be created.');
      return null;
    }
  };

  function createDOMPurify() {
    var window = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : getGlobal();

    var DOMPurify = function DOMPurify(root) {
      return createDOMPurify(root);
    };

    /**
     * Version label, exposed for easier checks
     * if DOMPurify is up to date or not
     */
    DOMPurify.version = '2.1.1';

    /**
     * Array of elements that DOMPurify removed during sanitation.
     * Empty if nothing was removed.
     */
    DOMPurify.removed = [];

    if (!window || !window.document || window.document.nodeType !== 9) {
      // Not running in a browser, provide a factory function
      // so that you can pass your own Window
      DOMPurify.isSupported = false;

      return DOMPurify;
    }

    var originalDocument = window.document;

    var document = window.document;
    var DocumentFragment = window.DocumentFragment,
        HTMLTemplateElement = window.HTMLTemplateElement,
        Node = window.Node,
        NodeFilter = window.NodeFilter,
        _window$NamedNodeMap = window.NamedNodeMap,
        NamedNodeMap = _window$NamedNodeMap === undefined ? window.NamedNodeMap || window.MozNamedAttrMap : _window$NamedNodeMap,
        Text = window.Text,
        Comment = window.Comment,
        DOMParser = window.DOMParser,
        trustedTypes = window.trustedTypes;

    // As per issue #47, the web-components registry is inherited by a
    // new document created via createHTMLDocument. As per the spec
    // (http://w3c.github.io/webcomponents/spec/custom/#creating-and-passing-registries)
    // a new empty registry is used when creating a template contents owner
    // document, so we use that as our parent document to ensure nothing
    // is inherited.

    if (typeof HTMLTemplateElement === 'function') {
      var template = document.createElement('template');
      if (template.content && template.content.ownerDocument) {
        document = template.content.ownerDocument;
      }
    }

    var trustedTypesPolicy = _createTrustedTypesPolicy(trustedTypes, originalDocument);
    var emptyHTML = trustedTypesPolicy && RETURN_TRUSTED_TYPE ? trustedTypesPolicy.createHTML('') : '';

    var _document = document,
        implementation = _document.implementation,
        createNodeIterator = _document.createNodeIterator,
        getElementsByTagName = _document.getElementsByTagName,
        createDocumentFragment = _document.createDocumentFragment;
    var importNode = originalDocument.importNode;


    var documentMode = {};
    try {
      documentMode = clone(document).documentMode ? document.documentMode : {};
    } catch (_) {}

    var hooks = {};

    /**
     * Expose whether this browser supports running the full DOMPurify.
     */
    DOMPurify.isSupported = implementation && typeof implementation.createHTMLDocument !== 'undefined' && documentMode !== 9;

    var MUSTACHE_EXPR$$1 = MUSTACHE_EXPR,
        ERB_EXPR$$1 = ERB_EXPR,
        DATA_ATTR$$1 = DATA_ATTR,
        ARIA_ATTR$$1 = ARIA_ATTR,
        IS_SCRIPT_OR_DATA$$1 = IS_SCRIPT_OR_DATA,
        ATTR_WHITESPACE$$1 = ATTR_WHITESPACE;
    var IS_ALLOWED_URI$$1 = IS_ALLOWED_URI;

    /**
     * We consider the elements and attributes below to be safe. Ideally
     * don't add any new ones but feel free to remove unwanted ones.
     */

    /* allowed element names */

    var ALLOWED_TAGS = null;
    var DEFAULT_ALLOWED_TAGS = addToSet({}, [].concat(_toConsumableArray$1(html), _toConsumableArray$1(svg), _toConsumableArray$1(svgFilters), _toConsumableArray$1(mathMl), _toConsumableArray$1(text)));

    /* Allowed attribute names */
    var ALLOWED_ATTR = null;
    var DEFAULT_ALLOWED_ATTR = addToSet({}, [].concat(_toConsumableArray$1(html$1), _toConsumableArray$1(svg$1), _toConsumableArray$1(mathMl$1), _toConsumableArray$1(xml)));

    /* Explicitly forbidden tags (overrides ALLOWED_TAGS/ADD_TAGS) */
    var FORBID_TAGS = null;

    /* Explicitly forbidden attributes (overrides ALLOWED_ATTR/ADD_ATTR) */
    var FORBID_ATTR = null;

    /* Decide if ARIA attributes are okay */
    var ALLOW_ARIA_ATTR = true;

    /* Decide if custom data attributes are okay */
    var ALLOW_DATA_ATTR = true;

    /* Decide if unknown protocols are okay */
    var ALLOW_UNKNOWN_PROTOCOLS = false;

    /* Output should be safe for common template engines.
     * This means, DOMPurify removes data attributes, mustaches and ERB
     */
    var SAFE_FOR_TEMPLATES = false;

    /* Decide if document with <html>... should be returned */
    var WHOLE_DOCUMENT = false;

    /* Track whether config is already set on this instance of DOMPurify. */
    var SET_CONFIG = false;

    /* Decide if all elements (e.g. style, script) must be children of
     * document.body. By default, browsers might move them to document.head */
    var FORCE_BODY = false;

    /* Decide if a DOM `HTMLBodyElement` should be returned, instead of a html
     * string (or a TrustedHTML object if Trusted Types are supported).
     * If `WHOLE_DOCUMENT` is enabled a `HTMLHtmlElement` will be returned instead
     */
    var RETURN_DOM = false;

    /* Decide if a DOM `DocumentFragment` should be returned, instead of a html
     * string  (or a TrustedHTML object if Trusted Types are supported) */
    var RETURN_DOM_FRAGMENT = false;

    /* If `RETURN_DOM` or `RETURN_DOM_FRAGMENT` is enabled, decide if the returned DOM
     * `Node` is imported into the current `Document`. If this flag is not enabled the
     * `Node` will belong (its ownerDocument) to a fresh `HTMLDocument`, created by
     * DOMPurify. */
    var RETURN_DOM_IMPORT = false;

    /* Try to return a Trusted Type object instead of a string, return a string in
     * case Trusted Types are not supported  */
    var RETURN_TRUSTED_TYPE = false;

    /* Output should be free from DOM clobbering attacks? */
    var SANITIZE_DOM = true;

    /* Keep element content when removing element? */
    var KEEP_CONTENT = true;

    /* If a `Node` is passed to sanitize(), then performs sanitization in-place instead
     * of importing it into a new Document and returning a sanitized copy */
    var IN_PLACE = false;

    /* Allow usage of profiles like html, svg and mathMl */
    var USE_PROFILES = {};

    /* Tags to ignore content of when KEEP_CONTENT is true */
    var FORBID_CONTENTS = addToSet({}, ['annotation-xml', 'audio', 'colgroup', 'desc', 'foreignobject', 'head', 'iframe', 'math', 'mi', 'mn', 'mo', 'ms', 'mtext', 'noembed', 'noframes', 'plaintext', 'script', 'style', 'svg', 'template', 'thead', 'title', 'video', 'xmp']);

    /* Tags that are safe for data: URIs */
    var DATA_URI_TAGS = null;
    var DEFAULT_DATA_URI_TAGS = addToSet({}, ['audio', 'video', 'img', 'source', 'image', 'track']);

    /* Attributes safe for values like "javascript:" */
    var URI_SAFE_ATTRIBUTES = null;
    var DEFAULT_URI_SAFE_ATTRIBUTES = addToSet({}, ['alt', 'class', 'for', 'id', 'label', 'name', 'pattern', 'placeholder', 'summary', 'title', 'value', 'style', 'xmlns']);

    /* Keep a reference to config to pass to hooks */
    var CONFIG = null;

    /* Ideally, do not touch anything below this line */
    /* ______________________________________________ */

    var formElement = document.createElement('form');

    /**
     * _parseConfig
     *
     * @param  {Object} cfg optional config literal
     */
    // eslint-disable-next-line complexity
    var _parseConfig = function _parseConfig(cfg) {
      if (CONFIG && CONFIG === cfg) {
        return;
      }

      /* Shield configuration object from tampering */
      if (!cfg || (typeof cfg === 'undefined' ? 'undefined' : _typeof(cfg)) !== 'object') {
        cfg = {};
      }

      /* Shield configuration object from prototype pollution */
      cfg = clone(cfg);

      /* Set configuration parameters */
      ALLOWED_TAGS = 'ALLOWED_TAGS' in cfg ? addToSet({}, cfg.ALLOWED_TAGS) : DEFAULT_ALLOWED_TAGS;
      ALLOWED_ATTR = 'ALLOWED_ATTR' in cfg ? addToSet({}, cfg.ALLOWED_ATTR) : DEFAULT_ALLOWED_ATTR;
      URI_SAFE_ATTRIBUTES = 'ADD_URI_SAFE_ATTR' in cfg ? addToSet(clone(DEFAULT_URI_SAFE_ATTRIBUTES), cfg.ADD_URI_SAFE_ATTR) : DEFAULT_URI_SAFE_ATTRIBUTES;
      DATA_URI_TAGS = 'ADD_DATA_URI_TAGS' in cfg ? addToSet(clone(DEFAULT_DATA_URI_TAGS), cfg.ADD_DATA_URI_TAGS) : DEFAULT_DATA_URI_TAGS;
      FORBID_TAGS = 'FORBID_TAGS' in cfg ? addToSet({}, cfg.FORBID_TAGS) : {};
      FORBID_ATTR = 'FORBID_ATTR' in cfg ? addToSet({}, cfg.FORBID_ATTR) : {};
      USE_PROFILES = 'USE_PROFILES' in cfg ? cfg.USE_PROFILES : false;
      ALLOW_ARIA_ATTR = cfg.ALLOW_ARIA_ATTR !== false; // Default true
      ALLOW_DATA_ATTR = cfg.ALLOW_DATA_ATTR !== false; // Default true
      ALLOW_UNKNOWN_PROTOCOLS = cfg.ALLOW_UNKNOWN_PROTOCOLS || false; // Default false
      SAFE_FOR_TEMPLATES = cfg.SAFE_FOR_TEMPLATES || false; // Default false
      WHOLE_DOCUMENT = cfg.WHOLE_DOCUMENT || false; // Default false
      RETURN_DOM = cfg.RETURN_DOM || false; // Default false
      RETURN_DOM_FRAGMENT = cfg.RETURN_DOM_FRAGMENT || false; // Default false
      RETURN_DOM_IMPORT = cfg.RETURN_DOM_IMPORT || false; // Default false
      RETURN_TRUSTED_TYPE = cfg.RETURN_TRUSTED_TYPE || false; // Default false
      FORCE_BODY = cfg.FORCE_BODY || false; // Default false
      SANITIZE_DOM = cfg.SANITIZE_DOM !== false; // Default true
      KEEP_CONTENT = cfg.KEEP_CONTENT !== false; // Default true
      IN_PLACE = cfg.IN_PLACE || false; // Default false
      IS_ALLOWED_URI$$1 = cfg.ALLOWED_URI_REGEXP || IS_ALLOWED_URI$$1;
      if (SAFE_FOR_TEMPLATES) {
        ALLOW_DATA_ATTR = false;
      }

      if (RETURN_DOM_FRAGMENT) {
        RETURN_DOM = true;
      }

      /* Parse profile info */
      if (USE_PROFILES) {
        ALLOWED_TAGS = addToSet({}, [].concat(_toConsumableArray$1(text)));
        ALLOWED_ATTR = [];
        if (USE_PROFILES.html === true) {
          addToSet(ALLOWED_TAGS, html);
          addToSet(ALLOWED_ATTR, html$1);
        }

        if (USE_PROFILES.svg === true) {
          addToSet(ALLOWED_TAGS, svg);
          addToSet(ALLOWED_ATTR, svg$1);
          addToSet(ALLOWED_ATTR, xml);
        }

        if (USE_PROFILES.svgFilters === true) {
          addToSet(ALLOWED_TAGS, svgFilters);
          addToSet(ALLOWED_ATTR, svg$1);
          addToSet(ALLOWED_ATTR, xml);
        }

        if (USE_PROFILES.mathMl === true) {
          addToSet(ALLOWED_TAGS, mathMl);
          addToSet(ALLOWED_ATTR, mathMl$1);
          addToSet(ALLOWED_ATTR, xml);
        }
      }

      /* Merge configuration parameters */
      if (cfg.ADD_TAGS) {
        if (ALLOWED_TAGS === DEFAULT_ALLOWED_TAGS) {
          ALLOWED_TAGS = clone(ALLOWED_TAGS);
        }

        addToSet(ALLOWED_TAGS, cfg.ADD_TAGS);
      }

      if (cfg.ADD_ATTR) {
        if (ALLOWED_ATTR === DEFAULT_ALLOWED_ATTR) {
          ALLOWED_ATTR = clone(ALLOWED_ATTR);
        }

        addToSet(ALLOWED_ATTR, cfg.ADD_ATTR);
      }

      if (cfg.ADD_URI_SAFE_ATTR) {
        addToSet(URI_SAFE_ATTRIBUTES, cfg.ADD_URI_SAFE_ATTR);
      }

      /* Add #text in case KEEP_CONTENT is set to true */
      if (KEEP_CONTENT) {
        ALLOWED_TAGS['#text'] = true;
      }

      /* Add html, head and body to ALLOWED_TAGS in case WHOLE_DOCUMENT is true */
      if (WHOLE_DOCUMENT) {
        addToSet(ALLOWED_TAGS, ['html', 'head', 'body']);
      }

      /* Add tbody to ALLOWED_TAGS in case tables are permitted, see #286, #365 */
      if (ALLOWED_TAGS.table) {
        addToSet(ALLOWED_TAGS, ['tbody']);
        delete FORBID_TAGS.tbody;
      }

      // Prevent further manipulation of configuration.
      // Not available in IE8, Safari 5, etc.
      if (freeze) {
        freeze(cfg);
      }

      CONFIG = cfg;
    };

    /**
     * _forceRemove
     *
     * @param  {Node} node a DOM node
     */
    var _forceRemove = function _forceRemove(node) {
      arrayPush(DOMPurify.removed, { element: node });
      try {
        node.parentNode.removeChild(node);
      } catch (_) {
        node.outerHTML = emptyHTML;
      }
    };

    /**
     * _removeAttribute
     *
     * @param  {String} name an Attribute name
     * @param  {Node} node a DOM node
     */
    var _removeAttribute = function _removeAttribute(name, node) {
      try {
        arrayPush(DOMPurify.removed, {
          attribute: node.getAttributeNode(name),
          from: node
        });
      } catch (_) {
        arrayPush(DOMPurify.removed, {
          attribute: null,
          from: node
        });
      }

      node.removeAttribute(name);
    };

    /**
     * _initDocument
     *
     * @param  {String} dirty a string of dirty markup
     * @return {Document} a DOM, filled with the dirty markup
     */
    var _initDocument = function _initDocument(dirty) {
      /* Create a HTML document */
      var doc = void 0;
      var leadingWhitespace = void 0;

      if (FORCE_BODY) {
        dirty = '<remove></remove>' + dirty;
      } else {
        /* If FORCE_BODY isn't used, leading whitespace needs to be preserved manually */
        var matches = stringMatch(dirty, /^[\r\n\t ]+/);
        leadingWhitespace = matches && matches[0];
      }

      var dirtyPayload = trustedTypesPolicy ? trustedTypesPolicy.createHTML(dirty) : dirty;
      /* Use the DOMParser API by default, fallback later if needs be */
      try {
        doc = new DOMParser().parseFromString(dirtyPayload, 'text/html');
      } catch (_) {}

      /* Use createHTMLDocument in case DOMParser is not available */
      if (!doc || !doc.documentElement) {
        doc = implementation.createHTMLDocument('');
        var _doc = doc,
            body = _doc.body;

        body.parentNode.removeChild(body.parentNode.firstElementChild);
        body.outerHTML = dirtyPayload;
      }

      if (dirty && leadingWhitespace) {
        doc.body.insertBefore(document.createTextNode(leadingWhitespace), doc.body.childNodes[0] || null);
      }

      /* Work on whole document or just its body */
      return getElementsByTagName.call(doc, WHOLE_DOCUMENT ? 'html' : 'body')[0];
    };

    /**
     * _createIterator
     *
     * @param  {Document} root document/fragment to create iterator for
     * @return {Iterator} iterator instance
     */
    var _createIterator = function _createIterator(root) {
      return createNodeIterator.call(root.ownerDocument || root, root, NodeFilter.SHOW_ELEMENT | NodeFilter.SHOW_COMMENT | NodeFilter.SHOW_TEXT, function () {
        return NodeFilter.FILTER_ACCEPT;
      }, false);
    };

    /**
     * _isClobbered
     *
     * @param  {Node} elm element to check for clobbering attacks
     * @return {Boolean} true if clobbered, false if safe
     */
    var _isClobbered = function _isClobbered(elm) {
      if (elm instanceof Text || elm instanceof Comment) {
        return false;
      }

      if (typeof elm.nodeName !== 'string' || typeof elm.textContent !== 'string' || typeof elm.removeChild !== 'function' || !(elm.attributes instanceof NamedNodeMap) || typeof elm.removeAttribute !== 'function' || typeof elm.setAttribute !== 'function' || typeof elm.namespaceURI !== 'string') {
        return true;
      }

      return false;
    };

    /**
     * _isNode
     *
     * @param  {Node} obj object to check whether it's a DOM node
     * @return {Boolean} true is object is a DOM node
     */
    var _isNode = function _isNode(object) {
      return (typeof Node === 'undefined' ? 'undefined' : _typeof(Node)) === 'object' ? object instanceof Node : object && (typeof object === 'undefined' ? 'undefined' : _typeof(object)) === 'object' && typeof object.nodeType === 'number' && typeof object.nodeName === 'string';
    };

    /**
     * _executeHook
     * Execute user configurable hooks
     *
     * @param  {String} entryPoint  Name of the hook's entry point
     * @param  {Node} currentNode node to work on with the hook
     * @param  {Object} data additional hook parameters
     */
    var _executeHook = function _executeHook(entryPoint, currentNode, data) {
      if (!hooks[entryPoint]) {
        return;
      }

      arrayForEach(hooks[entryPoint], function (hook) {
        hook.call(DOMPurify, currentNode, data, CONFIG);
      });
    };

    /**
     * _sanitizeElements
     *
     * @protect nodeName
     * @protect textContent
     * @protect removeChild
     *
     * @param   {Node} currentNode to check for permission to exist
     * @return  {Boolean} true if node was killed, false if left alive
     */
    var _sanitizeElements = function _sanitizeElements(currentNode) {
      var content = void 0;

      /* Execute a hook if present */
      _executeHook('beforeSanitizeElements', currentNode, null);

      /* Check if element is clobbered or can clobber */
      if (_isClobbered(currentNode)) {
        _forceRemove(currentNode);
        return true;
      }

      /* Check if tagname contains Unicode */
      if (stringMatch(currentNode.nodeName, /[\u0080-\uFFFF]/)) {
        _forceRemove(currentNode);
        return true;
      }

      /* Now let's check the element's type and name */
      var tagName = stringToLowerCase(currentNode.nodeName);

      /* Execute a hook if present */
      _executeHook('uponSanitizeElement', currentNode, {
        tagName: tagName,
        allowedTags: ALLOWED_TAGS
      });

      /* Take care of an mXSS pattern using p, br inside svg, math */
      if ((tagName === 'svg' || tagName === 'math') && currentNode.querySelectorAll('p, br').length !== 0) {
        _forceRemove(currentNode);
        return true;
      }

      /* Detect mXSS attempts abusing namespace confusion */
      if (!_isNode(currentNode.firstElementChild) && (!_isNode(currentNode.content) || !_isNode(currentNode.content.firstElementChild)) && regExpTest(/<[!/\w]/g, currentNode.innerHTML) && regExpTest(/<[!/\w]/g, currentNode.textContent)) {
        _forceRemove(currentNode);
        return true;
      }

      /* Remove element if anything forbids its presence */
      if (!ALLOWED_TAGS[tagName] || FORBID_TAGS[tagName]) {
        /* Keep content except for bad-listed elements */
        if (KEEP_CONTENT && !FORBID_CONTENTS[tagName] && typeof currentNode.insertAdjacentHTML === 'function') {
          try {
            var htmlToInsert = currentNode.innerHTML;
            currentNode.insertAdjacentHTML('AfterEnd', trustedTypesPolicy ? trustedTypesPolicy.createHTML(htmlToInsert) : htmlToInsert);
          } catch (_) {}
        }

        _forceRemove(currentNode);
        return true;
      }

      /* Remove in case a noscript/noembed XSS is suspected */
      if ((tagName === 'noscript' || tagName === 'noembed') && regExpTest(/<\/no(script|embed)/i, currentNode.innerHTML)) {
        _forceRemove(currentNode);
        return true;
      }

      /* Sanitize element content to be template-safe */
      if (SAFE_FOR_TEMPLATES && currentNode.nodeType === 3) {
        /* Get the element's text content */
        content = currentNode.textContent;
        content = stringReplace(content, MUSTACHE_EXPR$$1, ' ');
        content = stringReplace(content, ERB_EXPR$$1, ' ');
        if (currentNode.textContent !== content) {
          arrayPush(DOMPurify.removed, { element: currentNode.cloneNode() });
          currentNode.textContent = content;
        }
      }

      /* Execute a hook if present */
      _executeHook('afterSanitizeElements', currentNode, null);

      return false;
    };

    /**
     * _isValidAttribute
     *
     * @param  {string} lcTag Lowercase tag name of containing element.
     * @param  {string} lcName Lowercase attribute name.
     * @param  {string} value Attribute value.
     * @return {Boolean} Returns true if `value` is valid, otherwise false.
     */
    // eslint-disable-next-line complexity
    var _isValidAttribute = function _isValidAttribute(lcTag, lcName, value) {
      /* Make sure attribute cannot clobber */
      if (SANITIZE_DOM && (lcName === 'id' || lcName === 'name') && (value in document || value in formElement)) {
        return false;
      }

      /* Allow valid data-* attributes: At least one character after "-"
          (https://html.spec.whatwg.org/multipage/dom.html#embedding-custom-non-visible-data-with-the-data-*-attributes)
          XML-compatible (https://html.spec.whatwg.org/multipage/infrastructure.html#xml-compatible and http://www.w3.org/TR/xml/#d0e804)
          We don't need to check the value; it's always URI safe. */
      if (ALLOW_DATA_ATTR && regExpTest(DATA_ATTR$$1, lcName)) ; else if (ALLOW_ARIA_ATTR && regExpTest(ARIA_ATTR$$1, lcName)) ; else if (!ALLOWED_ATTR[lcName] || FORBID_ATTR[lcName]) {
        return false;

        /* Check value is safe. First, is attr inert? If so, is safe */
      } else if (URI_SAFE_ATTRIBUTES[lcName]) ; else if (regExpTest(IS_ALLOWED_URI$$1, stringReplace(value, ATTR_WHITESPACE$$1, ''))) ; else if ((lcName === 'src' || lcName === 'xlink:href' || lcName === 'href') && lcTag !== 'script' && stringIndexOf(value, 'data:') === 0 && DATA_URI_TAGS[lcTag]) ; else if (ALLOW_UNKNOWN_PROTOCOLS && !regExpTest(IS_SCRIPT_OR_DATA$$1, stringReplace(value, ATTR_WHITESPACE$$1, ''))) ; else if (!value) ; else {
        return false;
      }

      return true;
    };

    /**
     * _sanitizeAttributes
     *
     * @protect attributes
     * @protect nodeName
     * @protect removeAttribute
     * @protect setAttribute
     *
     * @param  {Node} currentNode to sanitize
     */
    var _sanitizeAttributes = function _sanitizeAttributes(currentNode) {
      var attr = void 0;
      var value = void 0;
      var lcName = void 0;
      var l = void 0;
      /* Execute a hook if present */
      _executeHook('beforeSanitizeAttributes', currentNode, null);

      var attributes = currentNode.attributes;

      /* Check if we have attributes; if not we might have a text node */

      if (!attributes) {
        return;
      }

      var hookEvent = {
        attrName: '',
        attrValue: '',
        keepAttr: true,
        allowedAttributes: ALLOWED_ATTR
      };
      l = attributes.length;

      /* Go backwards over all attributes; safely remove bad ones */
      while (l--) {
        attr = attributes[l];
        var _attr = attr,
            name = _attr.name,
            namespaceURI = _attr.namespaceURI;

        value = stringTrim(attr.value);
        lcName = stringToLowerCase(name);

        /* Execute a hook if present */
        hookEvent.attrName = lcName;
        hookEvent.attrValue = value;
        hookEvent.keepAttr = true;
        hookEvent.forceKeepAttr = undefined; // Allows developers to see this is a property they can set
        _executeHook('uponSanitizeAttribute', currentNode, hookEvent);
        value = hookEvent.attrValue;
        /* Did the hooks approve of the attribute? */
        if (hookEvent.forceKeepAttr) {
          continue;
        }

        /* Remove attribute */
        _removeAttribute(name, currentNode);

        /* Did the hooks approve of the attribute? */
        if (!hookEvent.keepAttr) {
          continue;
        }

        /* Work around a security issue in jQuery 3.0 */
        if (regExpTest(/\/>/i, value)) {
          _removeAttribute(name, currentNode);
          continue;
        }

        /* Sanitize attribute content to be template-safe */
        if (SAFE_FOR_TEMPLATES) {
          value = stringReplace(value, MUSTACHE_EXPR$$1, ' ');
          value = stringReplace(value, ERB_EXPR$$1, ' ');
        }

        /* Is `value` valid for this attribute? */
        var lcTag = currentNode.nodeName.toLowerCase();
        if (!_isValidAttribute(lcTag, lcName, value)) {
          continue;
        }

        /* Handle invalid data-* attribute set by try-catching it */
        try {
          if (namespaceURI) {
            currentNode.setAttributeNS(namespaceURI, name, value);
          } else {
            /* Fallback to setAttribute() for browser-unrecognized namespaces e.g. "x-schema". */
            currentNode.setAttribute(name, value);
          }

          arrayPop(DOMPurify.removed);
        } catch (_) {}
      }

      /* Execute a hook if present */
      _executeHook('afterSanitizeAttributes', currentNode, null);
    };

    /**
     * _sanitizeShadowDOM
     *
     * @param  {DocumentFragment} fragment to iterate over recursively
     */
    var _sanitizeShadowDOM = function _sanitizeShadowDOM(fragment) {
      var shadowNode = void 0;
      var shadowIterator = _createIterator(fragment);

      /* Execute a hook if present */
      _executeHook('beforeSanitizeShadowDOM', fragment, null);

      while (shadowNode = shadowIterator.nextNode()) {
        /* Execute a hook if present */
        _executeHook('uponSanitizeShadowNode', shadowNode, null);

        /* Sanitize tags and elements */
        if (_sanitizeElements(shadowNode)) {
          continue;
        }

        /* Deep shadow DOM detected */
        if (shadowNode.content instanceof DocumentFragment) {
          _sanitizeShadowDOM(shadowNode.content);
        }

        /* Check attributes, sanitize if necessary */
        _sanitizeAttributes(shadowNode);
      }

      /* Execute a hook if present */
      _executeHook('afterSanitizeShadowDOM', fragment, null);
    };

    /**
     * Sanitize
     * Public method providing core sanitation functionality
     *
     * @param {String|Node} dirty string or DOM node
     * @param {Object} configuration object
     */
    // eslint-disable-next-line complexity
    DOMPurify.sanitize = function (dirty, cfg) {
      var body = void 0;
      var importedNode = void 0;
      var currentNode = void 0;
      var oldNode = void 0;
      var returnNode = void 0;
      /* Make sure we have a string to sanitize.
        DO NOT return early, as this will return the wrong type if
        the user has requested a DOM object rather than a string */
      if (!dirty) {
        dirty = '<!-->';
      }

      /* Stringify, in case dirty is an object */
      if (typeof dirty !== 'string' && !_isNode(dirty)) {
        // eslint-disable-next-line no-negated-condition
        if (typeof dirty.toString !== 'function') {
          throw typeErrorCreate('toString is not a function');
        } else {
          dirty = dirty.toString();
          if (typeof dirty !== 'string') {
            throw typeErrorCreate('dirty is not a string, aborting');
          }
        }
      }

      /* Check we can run. Otherwise fall back or ignore */
      if (!DOMPurify.isSupported) {
        if (_typeof(window.toStaticHTML) === 'object' || typeof window.toStaticHTML === 'function') {
          if (typeof dirty === 'string') {
            return window.toStaticHTML(dirty);
          }

          if (_isNode(dirty)) {
            return window.toStaticHTML(dirty.outerHTML);
          }
        }

        return dirty;
      }

      /* Assign config vars */
      if (!SET_CONFIG) {
        _parseConfig(cfg);
      }

      /* Clean up removed elements */
      DOMPurify.removed = [];

      /* Check if dirty is correctly typed for IN_PLACE */
      if (typeof dirty === 'string') {
        IN_PLACE = false;
      }

      if (IN_PLACE) ; else if (dirty instanceof Node) {
        /* If dirty is a DOM element, append to an empty document to avoid
           elements being stripped by the parser */
        body = _initDocument('<!---->');
        importedNode = body.ownerDocument.importNode(dirty, true);
        if (importedNode.nodeType === 1 && importedNode.nodeName === 'BODY') {
          /* Node is already a body, use as is */
          body = importedNode;
        } else if (importedNode.nodeName === 'HTML') {
          body = importedNode;
        } else {
          // eslint-disable-next-line unicorn/prefer-node-append
          body.appendChild(importedNode);
        }
      } else {
        /* Exit directly if we have nothing to do */
        if (!RETURN_DOM && !SAFE_FOR_TEMPLATES && !WHOLE_DOCUMENT &&
        // eslint-disable-next-line unicorn/prefer-includes
        dirty.indexOf('<') === -1) {
          return trustedTypesPolicy && RETURN_TRUSTED_TYPE ? trustedTypesPolicy.createHTML(dirty) : dirty;
        }

        /* Initialize the document to work on */
        body = _initDocument(dirty);

        /* Check we have a DOM node from the data */
        if (!body) {
          return RETURN_DOM ? null : emptyHTML;
        }
      }

      /* Remove first element node (ours) if FORCE_BODY is set */
      if (body && FORCE_BODY) {
        _forceRemove(body.firstChild);
      }

      /* Get node iterator */
      var nodeIterator = _createIterator(IN_PLACE ? dirty : body);

      /* Now start iterating over the created document */
      while (currentNode = nodeIterator.nextNode()) {
        /* Fix IE's strange behavior with manipulated textNodes #89 */
        if (currentNode.nodeType === 3 && currentNode === oldNode) {
          continue;
        }

        /* Sanitize tags and elements */
        if (_sanitizeElements(currentNode)) {
          continue;
        }

        /* Shadow DOM detected, sanitize it */
        if (currentNode.content instanceof DocumentFragment) {
          _sanitizeShadowDOM(currentNode.content);
        }

        /* Check attributes, sanitize if necessary */
        _sanitizeAttributes(currentNode);

        oldNode = currentNode;
      }

      oldNode = null;

      /* If we sanitized `dirty` in-place, return it. */
      if (IN_PLACE) {
        return dirty;
      }

      /* Return sanitized string or DOM */
      if (RETURN_DOM) {
        if (RETURN_DOM_FRAGMENT) {
          returnNode = createDocumentFragment.call(body.ownerDocument);

          while (body.firstChild) {
            // eslint-disable-next-line unicorn/prefer-node-append
            returnNode.appendChild(body.firstChild);
          }
        } else {
          returnNode = body;
        }

        if (RETURN_DOM_IMPORT) {
          /*
            AdoptNode() is not used because internal state is not reset
            (e.g. the past names map of a HTMLFormElement), this is safe
            in theory but we would rather not risk another attack vector.
            The state that is cloned by importNode() is explicitly defined
            by the specs.
          */
          returnNode = importNode.call(originalDocument, returnNode, true);
        }

        return returnNode;
      }

      var serializedHTML = WHOLE_DOCUMENT ? body.outerHTML : body.innerHTML;

      /* Sanitize final string template-safe */
      if (SAFE_FOR_TEMPLATES) {
        serializedHTML = stringReplace(serializedHTML, MUSTACHE_EXPR$$1, ' ');
        serializedHTML = stringReplace(serializedHTML, ERB_EXPR$$1, ' ');
      }

      return trustedTypesPolicy && RETURN_TRUSTED_TYPE ? trustedTypesPolicy.createHTML(serializedHTML) : serializedHTML;
    };

    /**
     * Public method to set the configuration once
     * setConfig
     *
     * @param {Object} cfg configuration object
     */
    DOMPurify.setConfig = function (cfg) {
      _parseConfig(cfg);
      SET_CONFIG = true;
    };

    /**
     * Public method to remove the configuration
     * clearConfig
     *
     */
    DOMPurify.clearConfig = function () {
      CONFIG = null;
      SET_CONFIG = false;
    };

    /**
     * Public method to check if an attribute value is valid.
     * Uses last set config, if any. Otherwise, uses config defaults.
     * isValidAttribute
     *
     * @param  {string} tag Tag name of containing element.
     * @param  {string} attr Attribute name.
     * @param  {string} value Attribute value.
     * @return {Boolean} Returns true if `value` is valid. Otherwise, returns false.
     */
    DOMPurify.isValidAttribute = function (tag, attr, value) {
      /* Initialize shared config vars if necessary. */
      if (!CONFIG) {
        _parseConfig({});
      }

      var lcTag = stringToLowerCase(tag);
      var lcName = stringToLowerCase(attr);
      return _isValidAttribute(lcTag, lcName, value);
    };

    /**
     * AddHook
     * Public method to add DOMPurify hooks
     *
     * @param {String} entryPoint entry point for the hook to add
     * @param {Function} hookFunction function to execute
     */
    DOMPurify.addHook = function (entryPoint, hookFunction) {
      if (typeof hookFunction !== 'function') {
        return;
      }

      hooks[entryPoint] = hooks[entryPoint] || [];
      arrayPush(hooks[entryPoint], hookFunction);
    };

    /**
     * RemoveHook
     * Public method to remove a DOMPurify hook at a given entryPoint
     * (pops it from the stack of hooks if more are present)
     *
     * @param {String} entryPoint entry point for the hook to remove
     */
    DOMPurify.removeHook = function (entryPoint) {
      if (hooks[entryPoint]) {
        arrayPop(hooks[entryPoint]);
      }
    };

    /**
     * RemoveHooks
     * Public method to remove all DOMPurify hooks at a given entryPoint
     *
     * @param  {String} entryPoint entry point for the hooks to remove
     */
    DOMPurify.removeHooks = function (entryPoint) {
      if (hooks[entryPoint]) {
        hooks[entryPoint] = [];
      }
    };

    /**
     * RemoveAllHooks
     * Public method to remove all DOMPurify hooks
     *
     */
    DOMPurify.removeAllHooks = function () {
      hooks = {};
    };

    return DOMPurify;
  }

  var purify = createDOMPurify();

  return purify;

}));
//# sourceMappingURL=purify.js.map


/***/ }),

/***/ "./node_modules/emotion/dist/emotion.esm.js":
/*!**************************************************!*\
  !*** ./node_modules/emotion/dist/emotion.esm.js ***!
  \**************************************************/
/*! exports provided: cache, css, cx, flush, getRegisteredStyles, hydrate, injectGlobal, keyframes, merge, sheet */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "cache", function() { return cache; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "css", function() { return css; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "cx", function() { return cx; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "flush", function() { return flush; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getRegisteredStyles", function() { return getRegisteredStyles; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "hydrate", function() { return hydrate; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "injectGlobal", function() { return injectGlobal; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "keyframes", function() { return keyframes; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "merge", function() { return merge; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "sheet", function() { return sheet; });
/* harmony import */ var create_emotion__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! create-emotion */ "./node_modules/create-emotion/dist/create-emotion.browser.esm.js");


var _createEmotion = Object(create_emotion__WEBPACK_IMPORTED_MODULE_0__["default"])(),
    flush = _createEmotion.flush,
    hydrate = _createEmotion.hydrate,
    cx = _createEmotion.cx,
    merge = _createEmotion.merge,
    getRegisteredStyles = _createEmotion.getRegisteredStyles,
    injectGlobal = _createEmotion.injectGlobal,
    keyframes = _createEmotion.keyframes,
    css = _createEmotion.css,
    sheet = _createEmotion.sheet,
    cache = _createEmotion.cache;




/***/ }),

/***/ "./node_modules/intersection-observer/intersection-observer.js":
/*!*********************************************************************!*\
  !*** ./node_modules/intersection-observer/intersection-observer.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Copyright 2016 Google Inc. All Rights Reserved.
 *
 * Licensed under the W3C SOFTWARE AND DOCUMENT NOTICE AND LICENSE.
 *
 *  https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
 *
 */
(function() {
'use strict';

// Exit early if we're not running in a browser.
if (typeof window !== 'object') {
  return;
}

// Exit early if all IntersectionObserver and IntersectionObserverEntry
// features are natively supported.
if ('IntersectionObserver' in window &&
    'IntersectionObserverEntry' in window &&
    'intersectionRatio' in window.IntersectionObserverEntry.prototype) {

  // Minimal polyfill for Edge 15's lack of `isIntersecting`
  // See: https://github.com/w3c/IntersectionObserver/issues/211
  if (!('isIntersecting' in window.IntersectionObserverEntry.prototype)) {
    Object.defineProperty(window.IntersectionObserverEntry.prototype,
      'isIntersecting', {
      get: function () {
        return this.intersectionRatio > 0;
      }
    });
  }
  return;
}

/**
 * Returns the embedding frame element, if any.
 * @param {!Document} doc
 * @return {!Element}
 */
function getFrameElement(doc) {
  try {
    return doc.defaultView && doc.defaultView.frameElement || null;
  } catch (e) {
    // Ignore the error.
    return null;
  }
}

/**
 * A local reference to the root document.
 */
var document = (function(startDoc) {
  var doc = startDoc;
  var frame = getFrameElement(doc);
  while (frame) {
    doc = frame.ownerDocument;
    frame = getFrameElement(doc);
  }
  return doc;
})(window.document);

/**
 * An IntersectionObserver registry. This registry exists to hold a strong
 * reference to IntersectionObserver instances currently observing a target
 * element. Without this registry, instances without another reference may be
 * garbage collected.
 */
var registry = [];

/**
 * The signal updater for cross-origin intersection. When not null, it means
 * that the polyfill is configured to work in a cross-origin mode.
 * @type {function(DOMRect|ClientRect, DOMRect|ClientRect)}
 */
var crossOriginUpdater = null;

/**
 * The current cross-origin intersection. Only used in the cross-origin mode.
 * @type {DOMRect|ClientRect}
 */
var crossOriginRect = null;


/**
 * Creates the global IntersectionObserverEntry constructor.
 * https://w3c.github.io/IntersectionObserver/#intersection-observer-entry
 * @param {Object} entry A dictionary of instance properties.
 * @constructor
 */
function IntersectionObserverEntry(entry) {
  this.time = entry.time;
  this.target = entry.target;
  this.rootBounds = ensureDOMRect(entry.rootBounds);
  this.boundingClientRect = ensureDOMRect(entry.boundingClientRect);
  this.intersectionRect = ensureDOMRect(entry.intersectionRect || getEmptyRect());
  this.isIntersecting = !!entry.intersectionRect;

  // Calculates the intersection ratio.
  var targetRect = this.boundingClientRect;
  var targetArea = targetRect.width * targetRect.height;
  var intersectionRect = this.intersectionRect;
  var intersectionArea = intersectionRect.width * intersectionRect.height;

  // Sets intersection ratio.
  if (targetArea) {
    // Round the intersection ratio to avoid floating point math issues:
    // https://github.com/w3c/IntersectionObserver/issues/324
    this.intersectionRatio = Number((intersectionArea / targetArea).toFixed(4));
  } else {
    // If area is zero and is intersecting, sets to 1, otherwise to 0
    this.intersectionRatio = this.isIntersecting ? 1 : 0;
  }
}


/**
 * Creates the global IntersectionObserver constructor.
 * https://w3c.github.io/IntersectionObserver/#intersection-observer-interface
 * @param {Function} callback The function to be invoked after intersection
 *     changes have queued. The function is not invoked if the queue has
 *     been emptied by calling the `takeRecords` method.
 * @param {Object=} opt_options Optional configuration options.
 * @constructor
 */
function IntersectionObserver(callback, opt_options) {

  var options = opt_options || {};

  if (typeof callback != 'function') {
    throw new Error('callback must be a function');
  }

  if (options.root && options.root.nodeType != 1) {
    throw new Error('root must be an Element');
  }

  // Binds and throttles `this._checkForIntersections`.
  this._checkForIntersections = throttle(
      this._checkForIntersections.bind(this), this.THROTTLE_TIMEOUT);

  // Private properties.
  this._callback = callback;
  this._observationTargets = [];
  this._queuedEntries = [];
  this._rootMarginValues = this._parseRootMargin(options.rootMargin);

  // Public properties.
  this.thresholds = this._initThresholds(options.threshold);
  this.root = options.root || null;
  this.rootMargin = this._rootMarginValues.map(function(margin) {
    return margin.value + margin.unit;
  }).join(' ');

  /** @private @const {!Array<!Document>} */
  this._monitoringDocuments = [];
  /** @private @const {!Array<function()>} */
  this._monitoringUnsubscribes = [];
}


/**
 * The minimum interval within which the document will be checked for
 * intersection changes.
 */
IntersectionObserver.prototype.THROTTLE_TIMEOUT = 100;


/**
 * The frequency in which the polyfill polls for intersection changes.
 * this can be updated on a per instance basis and must be set prior to
 * calling `observe` on the first target.
 */
IntersectionObserver.prototype.POLL_INTERVAL = null;

/**
 * Use a mutation observer on the root element
 * to detect intersection changes.
 */
IntersectionObserver.prototype.USE_MUTATION_OBSERVER = true;


/**
 * Sets up the polyfill in the cross-origin mode. The result is the
 * updater function that accepts two arguments: `boundingClientRect` and
 * `intersectionRect` - just as these fields would be available to the
 * parent via `IntersectionObserverEntry`. This function should be called
 * each time the iframe receives intersection information from the parent
 * window, e.g. via messaging.
 * @return {function(DOMRect|ClientRect, DOMRect|ClientRect)}
 */
IntersectionObserver._setupCrossOriginUpdater = function() {
  if (!crossOriginUpdater) {
    /**
     * @param {DOMRect|ClientRect} boundingClientRect
     * @param {DOMRect|ClientRect} intersectionRect
     */
    crossOriginUpdater = function(boundingClientRect, intersectionRect) {
      if (!boundingClientRect || !intersectionRect) {
        crossOriginRect = getEmptyRect();
      } else {
        crossOriginRect = convertFromParentRect(boundingClientRect, intersectionRect);
      }
      registry.forEach(function(observer) {
        observer._checkForIntersections();
      });
    };
  }
  return crossOriginUpdater;
};


/**
 * Resets the cross-origin mode.
 */
IntersectionObserver._resetCrossOriginUpdater = function() {
  crossOriginUpdater = null;
  crossOriginRect = null;
};


/**
 * Starts observing a target element for intersection changes based on
 * the thresholds values.
 * @param {Element} target The DOM element to observe.
 */
IntersectionObserver.prototype.observe = function(target) {
  var isTargetAlreadyObserved = this._observationTargets.some(function(item) {
    return item.element == target;
  });

  if (isTargetAlreadyObserved) {
    return;
  }

  if (!(target && target.nodeType == 1)) {
    throw new Error('target must be an Element');
  }

  this._registerInstance();
  this._observationTargets.push({element: target, entry: null});
  this._monitorIntersections(target.ownerDocument);
  this._checkForIntersections();
};


/**
 * Stops observing a target element for intersection changes.
 * @param {Element} target The DOM element to observe.
 */
IntersectionObserver.prototype.unobserve = function(target) {
  this._observationTargets =
      this._observationTargets.filter(function(item) {
        return item.element != target;
      });
  this._unmonitorIntersections(target.ownerDocument);
  if (this._observationTargets.length == 0) {
    this._unregisterInstance();
  }
};


/**
 * Stops observing all target elements for intersection changes.
 */
IntersectionObserver.prototype.disconnect = function() {
  this._observationTargets = [];
  this._unmonitorAllIntersections();
  this._unregisterInstance();
};


/**
 * Returns any queue entries that have not yet been reported to the
 * callback and clears the queue. This can be used in conjunction with the
 * callback to obtain the absolute most up-to-date intersection information.
 * @return {Array} The currently queued entries.
 */
IntersectionObserver.prototype.takeRecords = function() {
  var records = this._queuedEntries.slice();
  this._queuedEntries = [];
  return records;
};


/**
 * Accepts the threshold value from the user configuration object and
 * returns a sorted array of unique threshold values. If a value is not
 * between 0 and 1 and error is thrown.
 * @private
 * @param {Array|number=} opt_threshold An optional threshold value or
 *     a list of threshold values, defaulting to [0].
 * @return {Array} A sorted list of unique and valid threshold values.
 */
IntersectionObserver.prototype._initThresholds = function(opt_threshold) {
  var threshold = opt_threshold || [0];
  if (!Array.isArray(threshold)) threshold = [threshold];

  return threshold.sort().filter(function(t, i, a) {
    if (typeof t != 'number' || isNaN(t) || t < 0 || t > 1) {
      throw new Error('threshold must be a number between 0 and 1 inclusively');
    }
    return t !== a[i - 1];
  });
};


/**
 * Accepts the rootMargin value from the user configuration object
 * and returns an array of the four margin values as an object containing
 * the value and unit properties. If any of the values are not properly
 * formatted or use a unit other than px or %, and error is thrown.
 * @private
 * @param {string=} opt_rootMargin An optional rootMargin value,
 *     defaulting to '0px'.
 * @return {Array<Object>} An array of margin objects with the keys
 *     value and unit.
 */
IntersectionObserver.prototype._parseRootMargin = function(opt_rootMargin) {
  var marginString = opt_rootMargin || '0px';
  var margins = marginString.split(/\s+/).map(function(margin) {
    var parts = /^(-?\d*\.?\d+)(px|%)$/.exec(margin);
    if (!parts) {
      throw new Error('rootMargin must be specified in pixels or percent');
    }
    return {value: parseFloat(parts[1]), unit: parts[2]};
  });

  // Handles shorthand.
  margins[1] = margins[1] || margins[0];
  margins[2] = margins[2] || margins[0];
  margins[3] = margins[3] || margins[1];

  return margins;
};


/**
 * Starts polling for intersection changes if the polling is not already
 * happening, and if the page's visibility state is visible.
 * @param {!Document} doc
 * @private
 */
IntersectionObserver.prototype._monitorIntersections = function(doc) {
  var win = doc.defaultView;
  if (!win) {
    // Already destroyed.
    return;
  }
  if (this._monitoringDocuments.indexOf(doc) != -1) {
    // Already monitoring.
    return;
  }

  // Private state for monitoring.
  var callback = this._checkForIntersections;
  var monitoringInterval = null;
  var domObserver = null;

  // If a poll interval is set, use polling instead of listening to
  // resize and scroll events or DOM mutations.
  if (this.POLL_INTERVAL) {
    monitoringInterval = win.setInterval(callback, this.POLL_INTERVAL);
  } else {
    addEvent(win, 'resize', callback, true);
    addEvent(doc, 'scroll', callback, true);
    if (this.USE_MUTATION_OBSERVER && 'MutationObserver' in win) {
      domObserver = new win.MutationObserver(callback);
      domObserver.observe(doc, {
        attributes: true,
        childList: true,
        characterData: true,
        subtree: true
      });
    }
  }

  this._monitoringDocuments.push(doc);
  this._monitoringUnsubscribes.push(function() {
    // Get the window object again. When a friendly iframe is destroyed, it
    // will be null.
    var win = doc.defaultView;

    if (win) {
      if (monitoringInterval) {
        win.clearInterval(monitoringInterval);
      }
      removeEvent(win, 'resize', callback, true);
    }

    removeEvent(doc, 'scroll', callback, true);
    if (domObserver) {
      domObserver.disconnect();
    }
  });

  // Also monitor the parent.
  if (doc != (this.root && this.root.ownerDocument || document)) {
    var frame = getFrameElement(doc);
    if (frame) {
      this._monitorIntersections(frame.ownerDocument);
    }
  }
};


/**
 * Stops polling for intersection changes.
 * @param {!Document} doc
 * @private
 */
IntersectionObserver.prototype._unmonitorIntersections = function(doc) {
  var index = this._monitoringDocuments.indexOf(doc);
  if (index == -1) {
    return;
  }

  var rootDoc = (this.root && this.root.ownerDocument || document);

  // Check if any dependent targets are still remaining.
  var hasDependentTargets =
      this._observationTargets.some(function(item) {
        var itemDoc = item.element.ownerDocument;
        // Target is in this context.
        if (itemDoc == doc) {
          return true;
        }
        // Target is nested in this context.
        while (itemDoc && itemDoc != rootDoc) {
          var frame = getFrameElement(itemDoc);
          itemDoc = frame && frame.ownerDocument;
          if (itemDoc == doc) {
            return true;
          }
        }
        return false;
      });
  if (hasDependentTargets) {
    return;
  }

  // Unsubscribe.
  var unsubscribe = this._monitoringUnsubscribes[index];
  this._monitoringDocuments.splice(index, 1);
  this._monitoringUnsubscribes.splice(index, 1);
  unsubscribe();

  // Also unmonitor the parent.
  if (doc != rootDoc) {
    var frame = getFrameElement(doc);
    if (frame) {
      this._unmonitorIntersections(frame.ownerDocument);
    }
  }
};


/**
 * Stops polling for intersection changes.
 * @param {!Document} doc
 * @private
 */
IntersectionObserver.prototype._unmonitorAllIntersections = function() {
  var unsubscribes = this._monitoringUnsubscribes.slice(0);
  this._monitoringDocuments.length = 0;
  this._monitoringUnsubscribes.length = 0;
  for (var i = 0; i < unsubscribes.length; i++) {
    unsubscribes[i]();
  }
};


/**
 * Scans each observation target for intersection changes and adds them
 * to the internal entries queue. If new entries are found, it
 * schedules the callback to be invoked.
 * @private
 */
IntersectionObserver.prototype._checkForIntersections = function() {
  if (!this.root && crossOriginUpdater && !crossOriginRect) {
    // Cross origin monitoring, but no initial data available yet.
    return;
  }

  var rootIsInDom = this._rootIsInDom();
  var rootRect = rootIsInDom ? this._getRootRect() : getEmptyRect();

  this._observationTargets.forEach(function(item) {
    var target = item.element;
    var targetRect = getBoundingClientRect(target);
    var rootContainsTarget = this._rootContainsTarget(target);
    var oldEntry = item.entry;
    var intersectionRect = rootIsInDom && rootContainsTarget &&
        this._computeTargetAndRootIntersection(target, targetRect, rootRect);

    var newEntry = item.entry = new IntersectionObserverEntry({
      time: now(),
      target: target,
      boundingClientRect: targetRect,
      rootBounds: crossOriginUpdater && !this.root ? null : rootRect,
      intersectionRect: intersectionRect
    });

    if (!oldEntry) {
      this._queuedEntries.push(newEntry);
    } else if (rootIsInDom && rootContainsTarget) {
      // If the new entry intersection ratio has crossed any of the
      // thresholds, add a new entry.
      if (this._hasCrossedThreshold(oldEntry, newEntry)) {
        this._queuedEntries.push(newEntry);
      }
    } else {
      // If the root is not in the DOM or target is not contained within
      // root but the previous entry for this target had an intersection,
      // add a new record indicating removal.
      if (oldEntry && oldEntry.isIntersecting) {
        this._queuedEntries.push(newEntry);
      }
    }
  }, this);

  if (this._queuedEntries.length) {
    this._callback(this.takeRecords(), this);
  }
};


/**
 * Accepts a target and root rect computes the intersection between then
 * following the algorithm in the spec.
 * TODO(philipwalton): at this time clip-path is not considered.
 * https://w3c.github.io/IntersectionObserver/#calculate-intersection-rect-algo
 * @param {Element} target The target DOM element
 * @param {Object} targetRect The bounding rect of the target.
 * @param {Object} rootRect The bounding rect of the root after being
 *     expanded by the rootMargin value.
 * @return {?Object} The final intersection rect object or undefined if no
 *     intersection is found.
 * @private
 */
IntersectionObserver.prototype._computeTargetAndRootIntersection =
    function(target, targetRect, rootRect) {
  // If the element isn't displayed, an intersection can't happen.
  if (window.getComputedStyle(target).display == 'none') return;

  var intersectionRect = targetRect;
  var parent = getParentNode(target);
  var atRoot = false;

  while (!atRoot && parent) {
    var parentRect = null;
    var parentComputedStyle = parent.nodeType == 1 ?
        window.getComputedStyle(parent) : {};

    // If the parent isn't displayed, an intersection can't happen.
    if (parentComputedStyle.display == 'none') return null;

    if (parent == this.root || parent.nodeType == /* DOCUMENT */ 9) {
      atRoot = true;
      if (parent == this.root || parent == document) {
        if (crossOriginUpdater && !this.root) {
          if (!crossOriginRect ||
              crossOriginRect.width == 0 && crossOriginRect.height == 0) {
            // A 0-size cross-origin intersection means no-intersection.
            parent = null;
            parentRect = null;
            intersectionRect = null;
          } else {
            parentRect = crossOriginRect;
          }
        } else {
          parentRect = rootRect;
        }
      } else {
        // Check if there's a frame that can be navigated to.
        var frame = getParentNode(parent);
        var frameRect = frame && getBoundingClientRect(frame);
        var frameIntersect =
            frame &&
            this._computeTargetAndRootIntersection(frame, frameRect, rootRect);
        if (frameRect && frameIntersect) {
          parent = frame;
          parentRect = convertFromParentRect(frameRect, frameIntersect);
        } else {
          parent = null;
          intersectionRect = null;
        }
      }
    } else {
      // If the element has a non-visible overflow, and it's not the <body>
      // or <html> element, update the intersection rect.
      // Note: <body> and <html> cannot be clipped to a rect that's not also
      // the document rect, so no need to compute a new intersection.
      var doc = parent.ownerDocument;
      if (parent != doc.body &&
          parent != doc.documentElement &&
          parentComputedStyle.overflow != 'visible') {
        parentRect = getBoundingClientRect(parent);
      }
    }

    // If either of the above conditionals set a new parentRect,
    // calculate new intersection data.
    if (parentRect) {
      intersectionRect = computeRectIntersection(parentRect, intersectionRect);
    }
    if (!intersectionRect) break;
    parent = parent && getParentNode(parent);
  }
  return intersectionRect;
};


/**
 * Returns the root rect after being expanded by the rootMargin value.
 * @return {ClientRect} The expanded root rect.
 * @private
 */
IntersectionObserver.prototype._getRootRect = function() {
  var rootRect;
  if (this.root) {
    rootRect = getBoundingClientRect(this.root);
  } else {
    // Use <html>/<body> instead of window since scroll bars affect size.
    var html = document.documentElement;
    var body = document.body;
    rootRect = {
      top: 0,
      left: 0,
      right: html.clientWidth || body.clientWidth,
      width: html.clientWidth || body.clientWidth,
      bottom: html.clientHeight || body.clientHeight,
      height: html.clientHeight || body.clientHeight
    };
  }
  return this._expandRectByRootMargin(rootRect);
};


/**
 * Accepts a rect and expands it by the rootMargin value.
 * @param {DOMRect|ClientRect} rect The rect object to expand.
 * @return {ClientRect} The expanded rect.
 * @private
 */
IntersectionObserver.prototype._expandRectByRootMargin = function(rect) {
  var margins = this._rootMarginValues.map(function(margin, i) {
    return margin.unit == 'px' ? margin.value :
        margin.value * (i % 2 ? rect.width : rect.height) / 100;
  });
  var newRect = {
    top: rect.top - margins[0],
    right: rect.right + margins[1],
    bottom: rect.bottom + margins[2],
    left: rect.left - margins[3]
  };
  newRect.width = newRect.right - newRect.left;
  newRect.height = newRect.bottom - newRect.top;

  return newRect;
};


/**
 * Accepts an old and new entry and returns true if at least one of the
 * threshold values has been crossed.
 * @param {?IntersectionObserverEntry} oldEntry The previous entry for a
 *    particular target element or null if no previous entry exists.
 * @param {IntersectionObserverEntry} newEntry The current entry for a
 *    particular target element.
 * @return {boolean} Returns true if a any threshold has been crossed.
 * @private
 */
IntersectionObserver.prototype._hasCrossedThreshold =
    function(oldEntry, newEntry) {

  // To make comparing easier, an entry that has a ratio of 0
  // but does not actually intersect is given a value of -1
  var oldRatio = oldEntry && oldEntry.isIntersecting ?
      oldEntry.intersectionRatio || 0 : -1;
  var newRatio = newEntry.isIntersecting ?
      newEntry.intersectionRatio || 0 : -1;

  // Ignore unchanged ratios
  if (oldRatio === newRatio) return;

  for (var i = 0; i < this.thresholds.length; i++) {
    var threshold = this.thresholds[i];

    // Return true if an entry matches a threshold or if the new ratio
    // and the old ratio are on the opposite sides of a threshold.
    if (threshold == oldRatio || threshold == newRatio ||
        threshold < oldRatio !== threshold < newRatio) {
      return true;
    }
  }
};


/**
 * Returns whether or not the root element is an element and is in the DOM.
 * @return {boolean} True if the root element is an element and is in the DOM.
 * @private
 */
IntersectionObserver.prototype._rootIsInDom = function() {
  return !this.root || containsDeep(document, this.root);
};


/**
 * Returns whether or not the target element is a child of root.
 * @param {Element} target The target element to check.
 * @return {boolean} True if the target element is a child of root.
 * @private
 */
IntersectionObserver.prototype._rootContainsTarget = function(target) {
  return containsDeep(this.root || document, target) &&
    (!this.root || this.root.ownerDocument == target.ownerDocument);
};


/**
 * Adds the instance to the global IntersectionObserver registry if it isn't
 * already present.
 * @private
 */
IntersectionObserver.prototype._registerInstance = function() {
  if (registry.indexOf(this) < 0) {
    registry.push(this);
  }
};


/**
 * Removes the instance from the global IntersectionObserver registry.
 * @private
 */
IntersectionObserver.prototype._unregisterInstance = function() {
  var index = registry.indexOf(this);
  if (index != -1) registry.splice(index, 1);
};


/**
 * Returns the result of the performance.now() method or null in browsers
 * that don't support the API.
 * @return {number} The elapsed time since the page was requested.
 */
function now() {
  return window.performance && performance.now && performance.now();
}


/**
 * Throttles a function and delays its execution, so it's only called at most
 * once within a given time period.
 * @param {Function} fn The function to throttle.
 * @param {number} timeout The amount of time that must pass before the
 *     function can be called again.
 * @return {Function} The throttled function.
 */
function throttle(fn, timeout) {
  var timer = null;
  return function () {
    if (!timer) {
      timer = setTimeout(function() {
        fn();
        timer = null;
      }, timeout);
    }
  };
}


/**
 * Adds an event handler to a DOM node ensuring cross-browser compatibility.
 * @param {Node} node The DOM node to add the event handler to.
 * @param {string} event The event name.
 * @param {Function} fn The event handler to add.
 * @param {boolean} opt_useCapture Optionally adds the even to the capture
 *     phase. Note: this only works in modern browsers.
 */
function addEvent(node, event, fn, opt_useCapture) {
  if (typeof node.addEventListener == 'function') {
    node.addEventListener(event, fn, opt_useCapture || false);
  }
  else if (typeof node.attachEvent == 'function') {
    node.attachEvent('on' + event, fn);
  }
}


/**
 * Removes a previously added event handler from a DOM node.
 * @param {Node} node The DOM node to remove the event handler from.
 * @param {string} event The event name.
 * @param {Function} fn The event handler to remove.
 * @param {boolean} opt_useCapture If the event handler was added with this
 *     flag set to true, it should be set to true here in order to remove it.
 */
function removeEvent(node, event, fn, opt_useCapture) {
  if (typeof node.removeEventListener == 'function') {
    node.removeEventListener(event, fn, opt_useCapture || false);
  }
  else if (typeof node.detatchEvent == 'function') {
    node.detatchEvent('on' + event, fn);
  }
}


/**
 * Returns the intersection between two rect objects.
 * @param {Object} rect1 The first rect.
 * @param {Object} rect2 The second rect.
 * @return {?Object|?ClientRect} The intersection rect or undefined if no
 *     intersection is found.
 */
function computeRectIntersection(rect1, rect2) {
  var top = Math.max(rect1.top, rect2.top);
  var bottom = Math.min(rect1.bottom, rect2.bottom);
  var left = Math.max(rect1.left, rect2.left);
  var right = Math.min(rect1.right, rect2.right);
  var width = right - left;
  var height = bottom - top;

  return (width >= 0 && height >= 0) && {
    top: top,
    bottom: bottom,
    left: left,
    right: right,
    width: width,
    height: height
  } || null;
}


/**
 * Shims the native getBoundingClientRect for compatibility with older IE.
 * @param {Element} el The element whose bounding rect to get.
 * @return {DOMRect|ClientRect} The (possibly shimmed) rect of the element.
 */
function getBoundingClientRect(el) {
  var rect;

  try {
    rect = el.getBoundingClientRect();
  } catch (err) {
    // Ignore Windows 7 IE11 "Unspecified error"
    // https://github.com/w3c/IntersectionObserver/pull/205
  }

  if (!rect) return getEmptyRect();

  // Older IE
  if (!(rect.width && rect.height)) {
    rect = {
      top: rect.top,
      right: rect.right,
      bottom: rect.bottom,
      left: rect.left,
      width: rect.right - rect.left,
      height: rect.bottom - rect.top
    };
  }
  return rect;
}


/**
 * Returns an empty rect object. An empty rect is returned when an element
 * is not in the DOM.
 * @return {ClientRect} The empty rect.
 */
function getEmptyRect() {
  return {
    top: 0,
    bottom: 0,
    left: 0,
    right: 0,
    width: 0,
    height: 0
  };
}


/**
 * Ensure that the result has all of the necessary fields of the DOMRect.
 * Specifically this ensures that `x` and `y` fields are set.
 *
 * @param {?DOMRect|?ClientRect} rect
 * @return {?DOMRect}
 */
function ensureDOMRect(rect) {
  // A `DOMRect` object has `x` and `y` fields.
  if (!rect || 'x' in rect) {
    return rect;
  }
  // A IE's `ClientRect` type does not have `x` and `y`. The same is the case
  // for internally calculated Rect objects. For the purposes of
  // `IntersectionObserver`, it's sufficient to simply mirror `left` and `top`
  // for these fields.
  return {
    top: rect.top,
    y: rect.top,
    bottom: rect.bottom,
    left: rect.left,
    x: rect.left,
    right: rect.right,
    width: rect.width,
    height: rect.height
  };
}


/**
 * Inverts the intersection and bounding rect from the parent (frame) BCR to
 * the local BCR space.
 * @param {DOMRect|ClientRect} parentBoundingRect The parent's bound client rect.
 * @param {DOMRect|ClientRect} parentIntersectionRect The parent's own intersection rect.
 * @return {ClientRect} The local root bounding rect for the parent's children.
 */
function convertFromParentRect(parentBoundingRect, parentIntersectionRect) {
  var top = parentIntersectionRect.top - parentBoundingRect.top;
  var left = parentIntersectionRect.left - parentBoundingRect.left;
  return {
    top: top,
    left: left,
    height: parentIntersectionRect.height,
    width: parentIntersectionRect.width,
    bottom: top + parentIntersectionRect.height,
    right: left + parentIntersectionRect.width
  };
}


/**
 * Checks to see if a parent element contains a child element (including inside
 * shadow DOM).
 * @param {Node} parent The parent element.
 * @param {Node} child The child element.
 * @return {boolean} True if the parent node contains the child node.
 */
function containsDeep(parent, child) {
  var node = child;
  while (node) {
    if (node == parent) return true;

    node = getParentNode(node);
  }
  return false;
}


/**
 * Gets the parent node of an element or its host element if the parent node
 * is a shadow root.
 * @param {Node} node The node whose parent to get.
 * @return {Node|null} The parent node or null if no parent exists.
 */
function getParentNode(node) {
  var parent = node.parentNode;

  if (node.nodeType == /* DOCUMENT */ 9 && node != document) {
    // If this node is a document node, look for the embedding frame.
    return getFrameElement(node);
  }

  if (parent && parent.nodeType == 11 && parent.host) {
    // If the parent is a shadow root, return the host element.
    return parent.host;
  }

  if (parent && parent.assignedSlot) {
    // If the parent is distributed in a <slot>, return the parent of a slot.
    return parent.assignedSlot.parentNode;
  }

  return parent;
}


// Exposes the constructors globally.
window.IntersectionObserver = IntersectionObserver;
window.IntersectionObserverEntry = IntersectionObserverEntry;

}());


/***/ }),

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

/***/ "./node_modules/preact/dist/preact.module.js":
/*!***************************************************!*\
  !*** ./node_modules/preact/dist/preact.module.js ***!
  \***************************************************/
/*! exports provided: render, hydrate, createElement, h, Fragment, createRef, isValidElement, Component, cloneElement, createContext, toChildArray, __u, options */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return M; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "hydrate", function() { return O; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createElement", function() { return v; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "h", function() { return v; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Fragment", function() { return p; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createRef", function() { return y; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "isValidElement", function() { return l; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Component", function() { return d; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "cloneElement", function() { return S; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createContext", function() { return q; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "toChildArray", function() { return b; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "__u", function() { return I; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "options", function() { return n; });
var n,l,u,i,t,o,r,f={},e=[],c=/acit|ex(?:s|g|n|p|$)|rph|grid|ows|mnc|ntw|ine[ch]|zoo|^ord|itera/i;function s(n,l){for(var u in l)n[u]=l[u];return n}function a(n){var l=n.parentNode;l&&l.removeChild(n)}function v(n,l,u){var i,t,o,r=arguments,f={};for(o in l)"key"==o?i=l[o]:"ref"==o?t=l[o]:f[o]=l[o];if(arguments.length>3)for(u=[u],o=3;o<arguments.length;o++)u.push(r[o]);if(null!=u&&(f.children=u),"function"==typeof n&&null!=n.defaultProps)for(o in n.defaultProps)void 0===f[o]&&(f[o]=n.defaultProps[o]);return h(n,f,i,t,null)}function h(l,u,i,t,o){var r={type:l,props:u,key:i,ref:t,__k:null,__:null,__b:0,__e:null,__d:void 0,__c:null,constructor:void 0,__v:o};return null==o&&(r.__v=r),null!=n.vnode&&n.vnode(r),r}function y(){return{current:null}}function p(n){return n.children}function d(n,l){this.props=n,this.context=l}function _(n,l){if(null==l)return n.__?_(n.__,n.__.__k.indexOf(n)+1):null;for(var u;l<n.__k.length;l++)if(null!=(u=n.__k[l])&&null!=u.__e)return u.__e;return"function"==typeof n.type?_(n):null}function w(n){var l,u;if(null!=(n=n.__)&&null!=n.__c){for(n.__e=n.__c.base=null,l=0;l<n.__k.length;l++)if(null!=(u=n.__k[l])&&null!=u.__e){n.__e=n.__c.base=u.__e;break}return w(n)}}function k(l){(!l.__d&&(l.__d=!0)&&u.push(l)&&!m.__r++||t!==n.debounceRendering)&&((t=n.debounceRendering)||i)(m)}function m(){for(var n;m.__r=u.length;)n=u.sort(function(n,l){return n.__v.__b-l.__v.__b}),u=[],n.some(function(n){var l,u,i,t,o,r,f;n.__d&&(r=(o=(l=n).__v).__e,(f=l.__P)&&(u=[],(i=s({},o)).__v=i,t=T(f,o,i,l.__n,void 0!==f.ownerSVGElement,null,u,null==r?_(o):r),$(u,o),t!=r&&w(o)))})}function g(n,l,u,i,t,o,r,c,s,v){var y,d,w,k,m,g,b,A=i&&i.__k||e,P=A.length;for(s==f&&(s=null!=r?r[0]:P?_(i,0):null),u.__k=[],y=0;y<l.length;y++)if(null!=(k=u.__k[y]=null==(k=l[y])||"boolean"==typeof k?null:"string"==typeof k||"number"==typeof k?h(null,k,null,null,k):Array.isArray(k)?h(p,{children:k},null,null,null):null!=k.__e||null!=k.__c?h(k.type,k.props,k.key,null,k.__v):k)){if(k.__=u,k.__b=u.__b+1,null===(w=A[y])||w&&k.key==w.key&&k.type===w.type)A[y]=void 0;else for(d=0;d<P;d++){if((w=A[d])&&k.key==w.key&&k.type===w.type){A[d]=void 0;break}w=null}m=T(n,k,w=w||f,t,o,r,c,s,v),(d=k.ref)&&w.ref!=d&&(b||(b=[]),w.ref&&b.push(w.ref,null,k),b.push(d,k.__c||m,k)),null!=m?(null==g&&(g=m),s=x(n,k,w,A,r,m,s),v||"option"!=u.type?"function"==typeof u.type&&(u.__d=s):n.value=""):s&&w.__e==s&&s.parentNode!=n&&(s=_(w))}if(u.__e=g,null!=r&&"function"!=typeof u.type)for(y=r.length;y--;)null!=r[y]&&a(r[y]);for(y=P;y--;)null!=A[y]&&I(A[y],A[y]);if(b)for(y=0;y<b.length;y++)H(b[y],b[++y],b[++y])}function b(n,l){return l=l||[],null==n||"boolean"==typeof n||(Array.isArray(n)?n.some(function(n){b(n,l)}):l.push(n)),l}function x(n,l,u,i,t,o,r){var f,e,c;if(void 0!==l.__d)f=l.__d,l.__d=void 0;else if(t==u||o!=r||null==o.parentNode)n:if(null==r||r.parentNode!==n)n.appendChild(o),f=null;else{for(e=r,c=0;(e=e.nextSibling)&&c<i.length;c+=2)if(e==o)break n;n.insertBefore(o,r),f=r}return void 0!==f?f:o.nextSibling}function A(n,l,u,i,t){var o;for(o in u)"children"===o||"key"===o||o in l||C(n,o,null,u[o],i);for(o in l)t&&"function"!=typeof l[o]||"children"===o||"key"===o||"value"===o||"checked"===o||u[o]===l[o]||C(n,o,l[o],u[o],i)}function P(n,l,u){"-"===l[0]?n.setProperty(l,u):n[l]=null==u?"":"number"!=typeof u||c.test(l)?u:u+"px"}function C(n,l,u,i,t){var o,r;if(t&&"className"==l&&(l="class"),"style"===l)if("string"==typeof u)n.style=u;else{if("string"==typeof i&&(n.style=i=""),i)for(l in i)u&&l in u||P(n.style,l,"");if(u)for(l in u)i&&u[l]===i[l]||P(n.style,l,u[l])}else"o"===l[0]&&"n"===l[1]?(o=l!==(l=l.replace(/Capture$/,"")),(r=l.toLowerCase())in n&&(l=r),l=l.slice(2),n.l||(n.l={}),n.l[l]=u,u?i||n.addEventListener(l,z,o):n.removeEventListener(l,z,o)):"list"!==l&&"tagName"!==l&&"form"!==l&&"type"!==l&&"size"!==l&&"download"!==l&&"href"!==l&&!t&&l in n?n[l]=null==u?"":u:"function"!=typeof u&&"dangerouslySetInnerHTML"!==l&&(l!==(l=l.replace(/xlink:?/,""))?null==u||!1===u?n.removeAttributeNS("http://www.w3.org/1999/xlink",l.toLowerCase()):n.setAttributeNS("http://www.w3.org/1999/xlink",l.toLowerCase(),u):null==u||!1===u&&!/^ar/.test(l)?n.removeAttribute(l):n.setAttribute(l,u))}function z(l){this.l[l.type](n.event?n.event(l):l)}function N(n,l,u){var i,t;for(i=0;i<n.__k.length;i++)(t=n.__k[i])&&(t.__=n,t.__e&&("function"==typeof t.type&&t.__k.length>1&&N(t,l,u),l=x(u,t,t,n.__k,null,t.__e,l),"function"==typeof n.type&&(n.__d=l)))}function T(l,u,i,t,o,r,f,e,c){var a,v,h,y,_,w,k,m,b,x,A,P=u.type;if(void 0!==u.constructor)return null;(a=n.__b)&&a(u);try{n:if("function"==typeof P){if(m=u.props,b=(a=P.contextType)&&t[a.__c],x=a?b?b.props.value:a.__:t,i.__c?k=(v=u.__c=i.__c).__=v.__E:("prototype"in P&&P.prototype.render?u.__c=v=new P(m,x):(u.__c=v=new d(m,x),v.constructor=P,v.render=L),b&&b.sub(v),v.props=m,v.state||(v.state={}),v.context=x,v.__n=t,h=v.__d=!0,v.__h=[]),null==v.__s&&(v.__s=v.state),null!=P.getDerivedStateFromProps&&(v.__s==v.state&&(v.__s=s({},v.__s)),s(v.__s,P.getDerivedStateFromProps(m,v.__s))),y=v.props,_=v.state,h)null==P.getDerivedStateFromProps&&null!=v.componentWillMount&&v.componentWillMount(),null!=v.componentDidMount&&v.__h.push(v.componentDidMount);else{if(null==P.getDerivedStateFromProps&&m!==y&&null!=v.componentWillReceiveProps&&v.componentWillReceiveProps(m,x),!v.__e&&null!=v.shouldComponentUpdate&&!1===v.shouldComponentUpdate(m,v.__s,x)||u.__v===i.__v){v.props=m,v.state=v.__s,u.__v!==i.__v&&(v.__d=!1),v.__v=u,u.__e=i.__e,u.__k=i.__k,v.__h.length&&f.push(v),N(u,e,l);break n}null!=v.componentWillUpdate&&v.componentWillUpdate(m,v.__s,x),null!=v.componentDidUpdate&&v.__h.push(function(){v.componentDidUpdate(y,_,w)})}v.context=x,v.props=m,v.state=v.__s,(a=n.__r)&&a(u),v.__d=!1,v.__v=u,v.__P=l,a=v.render(v.props,v.state,v.context),v.state=v.__s,null!=v.getChildContext&&(t=s(s({},t),v.getChildContext())),h||null==v.getSnapshotBeforeUpdate||(w=v.getSnapshotBeforeUpdate(y,_)),A=null!=a&&a.type==p&&null==a.key?a.props.children:a,g(l,Array.isArray(A)?A:[A],u,i,t,o,r,f,e,c),v.base=u.__e,v.__h.length&&f.push(v),k&&(v.__E=v.__=null),v.__e=!1}else null==r&&u.__v===i.__v?(u.__k=i.__k,u.__e=i.__e):u.__e=j(i.__e,u,i,t,o,r,f,c);(a=n.diffed)&&a(u)}catch(l){u.__v=null,n.__e(l,u,i)}return u.__e}function $(l,u){n.__c&&n.__c(u,l),l.some(function(u){try{l=u.__h,u.__h=[],l.some(function(n){n.call(u)})}catch(l){n.__e(l,u.__v)}})}function j(n,l,u,i,t,o,r,c){var s,a,v,h,y,p=u.props,d=l.props;if(t="svg"===l.type||t,null!=o)for(s=0;s<o.length;s++)if(null!=(a=o[s])&&((null===l.type?3===a.nodeType:a.localName===l.type)||n==a)){n=a,o[s]=null;break}if(null==n){if(null===l.type)return document.createTextNode(d);n=t?document.createElementNS("http://www.w3.org/2000/svg",l.type):document.createElement(l.type,d.is&&{is:d.is}),o=null,c=!1}if(null===l.type)p!==d&&n.data!==d&&(n.data=d);else{if(null!=o&&(o=e.slice.call(n.childNodes)),v=(p=u.props||f).dangerouslySetInnerHTML,h=d.dangerouslySetInnerHTML,!c){if(null!=o)for(p={},y=0;y<n.attributes.length;y++)p[n.attributes[y].name]=n.attributes[y].value;(h||v)&&(h&&v&&h.__html==v.__html||(n.innerHTML=h&&h.__html||""))}A(n,d,p,t,c),h?l.__k=[]:(s=l.props.children,g(n,Array.isArray(s)?s:[s],l,u,i,"foreignObject"!==l.type&&t,o,r,f,c)),c||("value"in d&&void 0!==(s=d.value)&&s!==n.value&&C(n,"value",s,p.value,!1),"checked"in d&&void 0!==(s=d.checked)&&s!==n.checked&&C(n,"checked",s,p.checked,!1))}return n}function H(l,u,i){try{"function"==typeof l?l(u):l.current=u}catch(l){n.__e(l,i)}}function I(l,u,i){var t,o,r;if(n.unmount&&n.unmount(l),(t=l.ref)&&(t.current&&t.current!==l.__e||H(t,null,u)),i||"function"==typeof l.type||(i=null!=(o=l.__e)),l.__e=l.__d=void 0,null!=(t=l.__c)){if(t.componentWillUnmount)try{t.componentWillUnmount()}catch(l){n.__e(l,u)}t.base=t.__P=null}if(t=l.__k)for(r=0;r<t.length;r++)t[r]&&I(t[r],u,i);null!=o&&a(o)}function L(n,l,u){return this.constructor(n,u)}function M(l,u,i){var t,r,c;n.__&&n.__(l,u),r=(t=i===o)?null:i&&i.__k||u.__k,l=v(p,null,[l]),c=[],T(u,(t?u:i||u).__k=l,r||f,f,void 0!==u.ownerSVGElement,i&&!t?[i]:r?null:u.childNodes.length?e.slice.call(u.childNodes):null,c,i||f,t),$(c,l)}function O(n,l){M(n,l,o)}function S(n,l,u){var i,t,o,r=arguments,f=s({},n.props);for(o in l)"key"==o?i=l[o]:"ref"==o?t=l[o]:f[o]=l[o];if(arguments.length>3)for(u=[u],o=3;o<arguments.length;o++)u.push(r[o]);return null!=u&&(f.children=u),h(n.type,f,i||n.key,t||n.ref,null)}function q(n,l){var u={__c:l="__cC"+r++,__:n,Consumer:function(n,l){return n.children(l)},Provider:function(n,u,i){return this.getChildContext||(u=[],(i={})[l]=this,this.getChildContext=function(){return i},this.shouldComponentUpdate=function(n){this.props.value!==n.value&&u.some(k)},this.sub=function(n){u.push(n);var l=n.componentWillUnmount;n.componentWillUnmount=function(){u.splice(u.indexOf(n),1),l&&l.call(n)}}),n.children}};return u.Provider.__=u.Consumer.contextType=u}n={__e:function(n,l){for(var u,i;l=l.__;)if((u=l.__c)&&!u.__)try{if(u.constructor&&null!=u.constructor.getDerivedStateFromError&&(i=!0,u.setState(u.constructor.getDerivedStateFromError(n))),null!=u.componentDidCatch&&(i=!0,u.componentDidCatch(n)),i)return k(u.__E=u)}catch(l){n=l}throw n}},l=function(n){return null!=n&&void 0===n.constructor},d.prototype.setState=function(n,l){var u;u=null!=this.__s&&this.__s!==this.state?this.__s:this.__s=s({},this.state),"function"==typeof n&&(n=n(s({},u),this.props)),n&&s(u,n),null!=n&&this.__v&&(l&&this.__h.push(l),k(this))},d.prototype.forceUpdate=function(n){this.__v&&(this.__e=!0,n&&this.__h.push(n),k(this))},d.prototype.render=p,u=[],i="function"==typeof Promise?Promise.prototype.then.bind(Promise.resolve()):setTimeout,m.__r=0,o=f,r=0;
//# sourceMappingURL=preact.module.js.map


/***/ }),

/***/ "./node_modules/preact/hooks/dist/hooks.module.js":
/*!********************************************************!*\
  !*** ./node_modules/preact/hooks/dist/hooks.module.js ***!
  \********************************************************/
/*! exports provided: useState, useReducer, useEffect, useLayoutEffect, useRef, useImperativeHandle, useMemo, useCallback, useContext, useDebugValue, useErrorBoundary */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "useState", function() { return m; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "useReducer", function() { return p; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "useEffect", function() { return y; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "useLayoutEffect", function() { return l; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "useRef", function() { return h; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "useImperativeHandle", function() { return s; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "useMemo", function() { return _; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "useCallback", function() { return A; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "useContext", function() { return F; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "useDebugValue", function() { return T; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "useErrorBoundary", function() { return d; });
/* harmony import */ var preact__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
var t,u,r,o=0,i=[],c=preact__WEBPACK_IMPORTED_MODULE_0__["options"].__r,f=preact__WEBPACK_IMPORTED_MODULE_0__["options"].diffed,e=preact__WEBPACK_IMPORTED_MODULE_0__["options"].__c,a=preact__WEBPACK_IMPORTED_MODULE_0__["options"].unmount;function v(t,r){preact__WEBPACK_IMPORTED_MODULE_0__["options"].__h&&preact__WEBPACK_IMPORTED_MODULE_0__["options"].__h(u,t,o||r),o=0;var i=u.__H||(u.__H={__:[],__h:[]});return t>=i.__.length&&i.__.push({}),i.__[t]}function m(n){return o=1,p(k,n)}function p(n,r,o){var i=v(t++,2);return i.t=n,i.__c||(i.__c=u,i.__=[o?o(r):k(void 0,r),function(n){var t=i.t(i.__[0],n);i.__[0]!==t&&(i.__=[t,i.__[1]],i.__c.setState({}))}]),i.__}function y(r,o){var i=v(t++,3);!preact__WEBPACK_IMPORTED_MODULE_0__["options"].__s&&j(i.__H,o)&&(i.__=r,i.__H=o,u.__H.__h.push(i))}function l(r,o){var i=v(t++,4);!preact__WEBPACK_IMPORTED_MODULE_0__["options"].__s&&j(i.__H,o)&&(i.__=r,i.__H=o,u.__h.push(i))}function h(n){return o=5,_(function(){return{current:n}},[])}function s(n,t,u){o=6,l(function(){"function"==typeof n?n(t()):n&&(n.current=t())},null==u?u:u.concat(n))}function _(n,u){var r=v(t++,7);return j(r.__H,u)?(r.__H=u,r.__h=n,r.__=n()):r.__}function A(n,t){return o=8,_(function(){return n},t)}function F(n){var r=u.context[n.__c],o=v(t++,9);return o.__c=n,r?(null==o.__&&(o.__=!0,r.sub(u)),r.props.value):n.__}function T(t,u){preact__WEBPACK_IMPORTED_MODULE_0__["options"].useDebugValue&&preact__WEBPACK_IMPORTED_MODULE_0__["options"].useDebugValue(u?u(t):t)}function d(n){var r=v(t++,10),o=m();return r.__=n,u.componentDidCatch||(u.componentDidCatch=function(n){r.__&&r.__(n),o[1](n)}),[o[0],function(){o[1](void 0)}]}function q(){i.some(function(t){if(t.__P)try{t.__H.__h.forEach(b),t.__H.__h.forEach(g),t.__H.__h=[]}catch(u){return t.__H.__h=[],preact__WEBPACK_IMPORTED_MODULE_0__["options"].__e(u,t.__v),!0}}),i=[]}preact__WEBPACK_IMPORTED_MODULE_0__["options"].__r=function(n){c&&c(n),t=0;var r=(u=n.__c).__H;r&&(r.__h.forEach(b),r.__h.forEach(g),r.__h=[])},preact__WEBPACK_IMPORTED_MODULE_0__["options"].diffed=function(t){f&&f(t);var u=t.__c;u&&u.__H&&u.__H.__h.length&&(1!==i.push(u)&&r===preact__WEBPACK_IMPORTED_MODULE_0__["options"].requestAnimationFrame||((r=preact__WEBPACK_IMPORTED_MODULE_0__["options"].requestAnimationFrame)||function(n){var t,u=function(){clearTimeout(r),x&&cancelAnimationFrame(t),setTimeout(n)},r=setTimeout(u,100);x&&(t=requestAnimationFrame(u))})(q))},preact__WEBPACK_IMPORTED_MODULE_0__["options"].__c=function(t,u){u.some(function(t){try{t.__h.forEach(b),t.__h=t.__h.filter(function(n){return!n.__||g(n)})}catch(r){u.some(function(n){n.__h&&(n.__h=[])}),u=[],preact__WEBPACK_IMPORTED_MODULE_0__["options"].__e(r,t.__v)}}),e&&e(t,u)},preact__WEBPACK_IMPORTED_MODULE_0__["options"].unmount=function(t){a&&a(t);var u=t.__c;if(u&&u.__H)try{u.__H.__.forEach(b)}catch(t){preact__WEBPACK_IMPORTED_MODULE_0__["options"].__e(t,u.__v)}};var x="function"==typeof requestAnimationFrame;function b(n){"function"==typeof n.u&&n.u()}function g(n){n.u=n.__()}function j(n,t){return!n||t.some(function(t,u){return t!==n[u]})}function k(n,t){return"function"==typeof t?t(n):t}
//# sourceMappingURL=hooks.module.js.map


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

/***/ "./node_modules/throttle-debounce/index.umd.js":
/*!*****************************************************!*\
  !*** ./node_modules/throttle-debounce/index.umd.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

(function (global, factory) {
	 true ? factory(exports) :
	undefined;
}(this, (function (exports) { 'use strict';

	/* eslint-disable no-undefined,no-param-reassign,no-shadow */

	/**
	 * Throttle execution of a function. Especially useful for rate limiting
	 * execution of handlers on events like resize and scroll.
	 *
	 * @param  {number}    delay -          A zero-or-greater delay in milliseconds. For event callbacks, values around 100 or 250 (or even higher) are most useful.
	 * @param  {boolean}   [noTrailing] -   Optional, defaults to false. If noTrailing is true, callback will only execute every `delay` milliseconds while the
	 *                                    throttled-function is being called. If noTrailing is false or unspecified, callback will be executed one final time
	 *                                    after the last throttled-function call. (After the throttled-function has not been called for `delay` milliseconds,
	 *                                    the internal counter is reset).
	 * @param  {Function}  callback -       A function to be executed after delay milliseconds. The `this` context and all arguments are passed through, as-is,
	 *                                    to `callback` when the throttled-function is executed.
	 * @param  {boolean}   [debounceMode] - If `debounceMode` is true (at begin), schedule `clear` to execute after `delay` ms. If `debounceMode` is false (at end),
	 *                                    schedule `callback` to execute after `delay` ms.
	 *
	 * @returns {Function}  A new, throttled, function.
	 */
	function throttle (delay, noTrailing, callback, debounceMode) {
	  /*
	   * After wrapper has stopped being called, this timeout ensures that
	   * `callback` is executed at the proper times in `throttle` and `end`
	   * debounce modes.
	   */
	  var timeoutID;
	  var cancelled = false; // Keep track of the last time `callback` was executed.

	  var lastExec = 0; // Function to clear existing timeout

	  function clearExistingTimeout() {
	    if (timeoutID) {
	      clearTimeout(timeoutID);
	    }
	  } // Function to cancel next exec


	  function cancel() {
	    clearExistingTimeout();
	    cancelled = true;
	  } // `noTrailing` defaults to falsy.


	  if (typeof noTrailing !== 'boolean') {
	    debounceMode = callback;
	    callback = noTrailing;
	    noTrailing = undefined;
	  }
	  /*
	   * The `wrapper` function encapsulates all of the throttling / debouncing
	   * functionality and when executed will limit the rate at which `callback`
	   * is executed.
	   */


	  function wrapper() {
	    for (var _len = arguments.length, arguments_ = new Array(_len), _key = 0; _key < _len; _key++) {
	      arguments_[_key] = arguments[_key];
	    }

	    var self = this;
	    var elapsed = Date.now() - lastExec;

	    if (cancelled) {
	      return;
	    } // Execute `callback` and update the `lastExec` timestamp.


	    function exec() {
	      lastExec = Date.now();
	      callback.apply(self, arguments_);
	    }
	    /*
	     * If `debounceMode` is true (at begin) this is used to clear the flag
	     * to allow future `callback` executions.
	     */


	    function clear() {
	      timeoutID = undefined;
	    }

	    if (debounceMode && !timeoutID) {
	      /*
	       * Since `wrapper` is being called for the first time and
	       * `debounceMode` is true (at begin), execute `callback`.
	       */
	      exec();
	    }

	    clearExistingTimeout();

	    if (debounceMode === undefined && elapsed > delay) {
	      /*
	       * In throttle mode, if `delay` time has been exceeded, execute
	       * `callback`.
	       */
	      exec();
	    } else if (noTrailing !== true) {
	      /*
	       * In trailing throttle mode, since `delay` time has not been
	       * exceeded, schedule `callback` to execute `delay` ms after most
	       * recent execution.
	       *
	       * If `debounceMode` is true (at begin), schedule `clear` to execute
	       * after `delay` ms.
	       *
	       * If `debounceMode` is false (at end), schedule `callback` to
	       * execute after `delay` ms.
	       */
	      timeoutID = setTimeout(debounceMode ? clear : exec, debounceMode === undefined ? delay - elapsed : delay);
	    }
	  }

	  wrapper.cancel = cancel; // Return the wrapper function.

	  return wrapper;
	}

	/* eslint-disable no-undefined */
	/**
	 * Debounce execution of a function. Debouncing, unlike throttling,
	 * guarantees that a function is only executed a single time, either at the
	 * very beginning of a series of calls, or at the very end.
	 *
	 * @param  {number}   delay -         A zero-or-greater delay in milliseconds. For event callbacks, values around 100 or 250 (or even higher) are most useful.
	 * @param  {boolean}  [atBegin] -     Optional, defaults to false. If atBegin is false or unspecified, callback will only be executed `delay` milliseconds
	 *                                  after the last debounced-function call. If atBegin is true, callback will be executed only at the first debounced-function call.
	 *                                  (After the throttled-function has not been called for `delay` milliseconds, the internal counter is reset).
	 * @param  {Function} callback -      A function to be executed after delay milliseconds. The `this` context and all arguments are passed through, as-is,
	 *                                  to `callback` when the debounced-function is executed.
	 *
	 * @returns {Function} A new, debounced function.
	 */

	function debounce (delay, atBegin, callback) {
	  return callback === undefined ? throttle(delay, atBegin, false) : throttle(delay, callback, atBegin !== false);
	}

	exports.debounce = debounce;
	exports.throttle = throttle;

	Object.defineProperty(exports, '__esModule', { value: true });

})));
//# sourceMappingURL=index.umd.js.map


/***/ }),

/***/ "./node_modules/webpack/buildin/global.js":
/*!***********************************!*\
  !*** (webpack)/buildin/global.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var g;

// This works in non-strict mode
g = (function() {
	return this;
})();

try {
	// This works if eval is allowed (see CSP)
	g = g || new Function("return this")();
} catch (e) {
	// This works if the window reference is available
	if (typeof window === "object") g = window;
}

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

module.exports = g;


/***/ }),

/***/ "./resources/assets/js/TradeSubsystem/common.js":
/*!******************************************************!*\
  !*** ./resources/assets/js/TradeSubsystem/common.js ***!
  \******************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var ladda__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ladda */ "./node_modules/ladda/js/ladda.js");
/* harmony import */ var spin_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! spin.js */ "./node_modules/spin.js/spin.js");
/* harmony import */ var throttle_debounce__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! throttle-debounce */ "./node_modules/throttle-debounce/index.umd.js");
/* harmony import */ var throttle_debounce__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(throttle_debounce__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _giphy_js_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @giphy/js-components */ "./node_modules/@giphy/js-components/dist/index.js");
/* harmony import */ var _giphy_js_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_giphy_js_components__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _giphy_js_fetch_api__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @giphy/js-fetch-api */ "./node_modules/@giphy/js-fetch-api/dist/index.js");
/* harmony import */ var _giphy_js_fetch_api__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_giphy_js_fetch_api__WEBPACK_IMPORTED_MODULE_4__);
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

$ = jQuery;





var gf = new _giphy_js_fetch_api__WEBPACK_IMPORTED_MODULE_4__["GiphyFetch"]('GHa0uyS4S2nMHPMACTlNr0E8FfudCaLQ');

var fetchGifs = function fetchGifs(offset) {
  // use whatever end point you want,
  // but be sure to pass offset to paginate correctly
  //return gf.trending({ offset, limit: 25 })
  return gf.search('bitcoin', {
    sort: 'relevant',
    lang: 'en',
    offset: offset,
    limit: 25,
    type: 'gifs'
  });
};

var innerWidth;
var gifForm; // Creating a grid with window resizing and remove-ability

var makeGrid = function makeGrid(targetEl) {
  var render = function render() {
    // here is the @giphy/js-components import
    return Object(_giphy_js_components__WEBPACK_IMPORTED_MODULE_3__["renderGrid"])({
      width: innerWidth,
      noResultsMessage: 'No gifs found, try different query',
      fetchGifs: fetchGifs,
      columns: 3,
      gutter: 6,
      onGifClick: function onGifClick(gif, event) {
        event.preventDefault();
        gifForm.find('[name="gif"]').val(gif.id);
        gifForm.find('.gif-image').html('<img src="https://media.giphy.com/media/' + gif.id + '/giphy.gif">');
        gifForm.find('.gif-holder').removeClass('d-none').addClass('d-flex');
        $('#gif-modal').modal('hide');
        console.log(gif);
      }
    }, targetEl);
  };

  var resizeRender = Object(throttle_debounce__WEBPACK_IMPORTED_MODULE_2__["throttle"])(500, render);
  window.addEventListener('resize', resizeRender, false);

  var _remove = render();

  return {
    remove: function remove() {
      _remove();

      window.removeEventListener('resize', resizeRender, false);
    }
  };
};

var opts = {
  lines: 11,
  // The number of lines to draw
  length: 23,
  // The length of each line
  width: 10,
  // The line thickness
  radius: 34,
  // The radius of the inner circle
  scale: 0.2,
  // Scales overall size of the spinner
  corners: 0.3,
  // Corner roundness (0..1)
  color: '#623869',
  // CSS color or array of colors
  fadeColor: 'transparent',
  // CSS color or array of colors
  speed: 1.1,
  // Rounds per second
  rotate: 44,
  // The rotation offset
  animation: 'spinner-line-fade-quick',
  // The CSS animation name for the lines
  direction: 1,
  // 1: clockwise, -1: counterclockwise
  zIndex: 2e9,
  // The z-index (defaults to 2000000000)
  className: 'spinner',
  // The CSS class to assign to the spinner
  top: '50%',
  // Top position relative to parent
  left: '50%',
  shadow: '0 0 1px transparent',
  // Box-shadow for the lines
  position: 'absolute' // Element positioning

};
var unloadedTradesCache = '';
$('body').tooltip({
  html: true,
  trigger: 'hover focus click',
  selector: '[data-toggle="tooltip"]'
});
var title;

function copyInviteLink() {
  $('#copy-invite-link').on('click', function (e) {
    e.preventDefault();
    $('#invite-link').select();
    document.execCommand("copy");
    $('#copied-success').removeClass('d-none');
  });
}

function loadInvitedUsers() {
  $('a[data-target="#invite-modal"]').click(function () {
    axios({
      method: 'get',
      url: '/app/load-invited-users',
      responseType: 'json'
    }).then(function (response) {
      if (response.data.success) {
        $('#invited-users-content').html(response.data.html);
        $('#invited-users-heading').removeClass('d-none');
      }

      $('#invite-users-left').html(response.data.count);
    });
  });
}

function initTradeActions() {
  initTradeClose();
  initTradeCancel();
}

var cancelling = false;
var closing = false;

function initTradeClose() {
  $('body').on('click', '.close-trade', function (e) {
    e.preventDefault();
    if (closing) return;
    closing = true;
    var parent = $(this).parent();
    axios({
      method: 'get',
      url: $(this).attr('href'),
      responseType: 'json'
    }).then(function (response) {
      closing = false;

      if (response.data.success == 1) {
        parent.html('<span>Closed</span>');
      } else {
        alert(response.data.message);
      }
    })["catch"](function (error) {
      closing = false;
      parent.html('<span>Error</span>');
    });
  });
}

function initTradeCancel() {
  $('body').on('click', '.cancel-trade', function (e) {
    e.preventDefault();
    if (cancelling) return;
    cancelling = true;
    var parent = $(this).parent();
    axios({
      method: 'get',
      url: $(this).attr('href'),
      responseType: 'json'
    }).then(function (response) {
      cancelling = false;
      parent.html('<span>Cancelled</span>');
    })["catch"](function (error) {
      cancelling = false;
      parent.html('<span>Error</span>');
    });
  });
}

function fetchMetadata() {
  $('.link-meta-info').show();
  var spinner = new spin_js__WEBPACK_IMPORTED_MODULE_1__["Spinner"](opts).spin($('#spinner')[0]);
  var field = $('textarea[name="description"]');
  $(field).attr('disabled', 'disabled');
  axios({
    method: 'post',
    url: '/source-metadata/',
    data: {
      description: $(field).val()
    },
    responseType: 'json'
  }).then(function (response) {
    $(field).removeAttr('disabled');
    spinner.stop();

    if (response.data.success) {
      $('#analysis-field-wrapper').removeClass('active').hide();
      $('.link-meta-info').removeClass('image-preview video-preview tradingview-preview link-meta-preview');

      if (response.data.type == 'link') {
        if ($('input[name="source_type"]').length > 0) {
          $('input[name="source_type"]').val('link');
        } else {
          $('input[name="paying_with_currency_id"]').after('<input type="hidden" name="source_type" value="link">');
        }

        if (response.data.meta_title !== null) {
          var desc = response.data.meta_description;
          var html = '<a href="' + response.data.link + '" target="_blank" rel="nofollow" class="link-thumbnail"><img src="' + response.data.og_image + '" class="" alt=""/></a><h6 class="mb-1">' + response.data.meta_title + '</h6><small>' + desc + '</small>';
        } else {
          var desc = '';
          var html = '';
        }

        $('.link-meta-info').addClass('link-meta-preview');
      } else if (response.data.type == 'video') {
        var html = response.data.iframe;

        if ($('input[name="source_type"]').length > 0) {
          $('input[name="source_type"]').val('video');
        } else {
          $('input[name="paying_with_currency_id"]').after('<input type="hidden" name="source_type" value="video">');
        }

        $('.link-meta-info').addClass('video-preview');
      } else {
        var html = response.data.html;

        if ($('input[name="source_type"]').length > 0) {
          $('input[name="source_type"]').val('trading_view');
        } else {
          $('input[name="paying_with_currency_id"]').after('<input type="hidden" name="source_type" value="trading_view">');
        }

        $('.link-meta-info').addClass('tradingview-preview');
      }

      $('.link-meta-info').removeClass('failed empty').addClass('loaded').html(html);
      initTradingView();
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
  })["catch"](function () {
    $(field).removeAttr('disabled');
    $('.link-meta-info').addClass('empty').removeClass('failed loaded').html('');
    spinner.stop();
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

$(document).ready(function () {
  var grid;
  $('#gif-modal').on('shown.bs.modal', function (e) {
    gifForm = $(e.relatedTarget).closest('form');
    innerWidth = $('.gif-grid').width();
    grid = makeGrid(document.querySelector('.gif-grid'));
  });
  var typingTimer; //timer identifier

  var doneTypingInterval = 500; //time in ms, 5 second for example

  var $input = $('#search-giphy');
  $input.on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
  });
  $input.on('keydown', function () {
    clearTimeout(typingTimer);
  }); //user is "finished typing," do something

  function doneTyping() {
    var searchterm = $input.val();
    if (searchterm == '') searchterm = 'bitcoin';

    fetchGifs = function fetchGifs(offset) {
      // use whatever end point you want,
      // but be sure to pass offset to paginate correctly
      //return gf.trending({ offset, limit: 25 })
      return gf.search(searchterm, {
        sort: 'relevant',
        lang: 'en',
        offset: offset,
        limit: 25,
        type: 'gifs'
      });
    };

    grid.remove();
    makeGrid(document.querySelector('.gif-grid'));
  }

  $('body').on('click', '.remove-gif', function (e) {
    e.preventDefault();
    gifForm = $(this).closest('form');
    gifForm.find('.gif-holder').addClass('d-none').removeClass('d-flex');
    gifForm.find('[name="gif"]').val('');
    gifForm.find('.gif-image').html('');
  });

  if ($('#play_dollars_sats_amount').length) {
    var satoshiInput = new Cleave('#play_dollars_sats_amount', {
      numeral: true,
      numericOnly: true,
      rawValueTrimPrefix: true,
      prefix: '$',
      numeralThousandsGroupStyle: 'thousand'
    });
  }

  $('.increase-redeem,#play_dollars_sats_amount').on('click', function (e) {
    e.preventDefault();
    var satsVal = satoshiInput.getRawValue();
    satoshiInput.setRawValue(parseFloat(satsVal) + 1000);
    $('#play_dollars_sats_amount').trigger('change');
  });
  $('.decrease-redeem').on('click', function (e) {
    e.preventDefault();
    var satsVal = satoshiInput.getRawValue();

    if (satsVal > 1000) {
      satoshiInput.setRawValue(parseFloat(satsVal) - 1000);
      $('#play_dollars_sats_amount').trigger('change');
    }
  });
  $('.toast.success').toast({
    'delay': 5000,
    'autohide': true
  });
  $('.toast.success').toast('show');
  $('#play_dollars_sats_amount').trigger('change');
  $('#play_dollars_sats_amount').on('keyup keydown change', function () {
    var satoshi = Math.round(parseFloat(satoshiInput.getRawValue()) / 1000 * reward_per_thousand);
    var btc_amount = (Math.round(parseFloat(satoshiInput.getRawValue()) / 1000 * reward_per_thousand) / 100000000).toFixed(8);
    var usd_amount = (Math.round(parseFloat(satoshiInput.getRawValue()) / 1000 * reward_per_thousand) / 100000000).toFixed(8) * btc_rate;
    $('.btc-estimate').html(btc_amount + 'BTC');
    $('.usd-estimate').html(usd_amount.toFixed(2));
    $('#sats').html(satoshi);
  });
  $('#redeem-sats').submit(function (e) {
    e.preventDefault();
    $('#error-alert-redeem').hide();
    var laddaButton = ladda__WEBPACK_IMPORTED_MODULE_0__["create"]($('#redeem-sats button[type="submit"]')[0]);
    laddaButton.start();
    axios({
      method: 'post',
      //data: new FormData($(this)[0]),
      data: {
        amount: satoshiInput.getRawValue(),
        invoice_address: $('#invoice_address').val()
      },
      url: '/app/exchanges',
      responseType: 'json'
    }).then(function (response) {
      if (response.data.success) {
        $('#error-alert-redeem').hide();
        $('#redeem-sats-modal').modal('hide');
        Swal.fire({
          title: 'Processing...',
          type: 'info',
          showConfirmButton: false,
          showLoaderOnConfirm: true
        });
        Swal.showLoading();
        laddaButton.stop();
      } else {
        laddaButton.stop();
        $('#error-alert-text-redeem').html(response.data.message);
        $('#error-alert-redeem').show();
      }
    });
  });
  wdtEmojiBundle.init('textarea');
  initTradeActions();
  initSourceMetadataOnFocusOut();
  $('.trade-description').each(function () {
    var text = $(this).html();
    var output = wdtEmojiBundle.render(text);
    $(this).html(output);
  });
  $('.user-description').each(function () {
    var text = $(this).html();
    var output = wdtEmojiBundle.render(text);
    $(this).html(output);
  });
  $('.comment-text').each(function () {
    var text = $(this).html();
    var output = wdtEmojiBundle.render(text);
    $(this).html(output);
  });
  $('.messages').each(function () {
    var text = $(this).html();
    var output = wdtEmojiBundle.render(text);
    $(this).html(output);
  });
  loadInvitedUsers();
  copyInviteLink();
  sendChatMessage();
  initTinyMCE();
  initDropzone();
  toggleBalance();
  if ($(".messages").length) $(".messages").scrollTop($(".messages")[0].scrollHeight);
  var popOverSettings = {
    placement: 'top',
    container: 'body',
    trigger: 'focus',
    html: true,
    selector: '[data-toggle="popover"]',
    //Sepcify the selector here
    content: function content(e) {
      var share_link = encodeURI($(this).data('link'));
      var comment = encodeURI($(this).data('comment'));
      var tweet = comment + '' + share_link;
      var content = '<div class="share-popper"><a ' + 'class="px-2 py-1 btn btn-secondary mr-1 btn-smm font-weight-bold btn-sm"' + 'target="_blank"' + 'href="https://www.facebook.com/sharer/sharer.php?u=' + share_link + '&amp;src=sdkpreparse">' + '<i class="fab fa-facebook-f "></i>' + '</a>' + '<a target="_blank"' + 'class="px-2 py-1 btn btn-secondary btn-smm font-weight-bold btn-sm"' + 'href="https://twitter.com/intent/tweet?text=' + tweet + '&hashtags=niffler">' + '<i class="fab fa-twitter"></i>' + '</a>' + '<a href="https://www.linkedin.com/shareArticle?mini=true&url=' + share_link + '"' + 'target="_blank"' + 'class="px-2 py-1 ml-1 btn btn-secondary btn-sm font-weight-bold btn-smm">' + '<i class="fab fa-linkedin-in" style="position: relative;top:-1px;"></i>' + '</a>' + '<a href="' + share_link + '"' + 'target="_blank"' + 'class="px-2 py-1 ml-1 btn btn-secondary btn-sm font-weight-bold btn-smm">' + '<i class="far fa-link" style="position: relative;top:0px;"></i>' + '</a></div>';
      return content;
    }
  };
  $('body').popover(popOverSettings);
  title = document.title;
  populateModalDataToBecomeAPatronModalOnClick();

  if (window.location.href == siteUrl + '/app' || window.location.href == siteUrl + '/app#' || window.location.href == siteUrl + '/app#trade' || window.location.href == siteUrl + '/app/welcome#' || window.location.href == siteUrl + '/app/welcome') {
    loadMoreFeedsOnScroll();
  }

  if (typeof profileTimestamp !== 'undefined') {
    if (modalTrade != true) {
      loadMoreProfileTradesOnScroll();
    }
  }

  $('#tradeModal').modal('show');

  if (loggedIn) {
    console.log('listenForEvents');
    listenForEvents();
    changeMyFeedOnOff();
  }

  loadUnreadTradesOnClick();
  showCommentsOnClick();
  markNotificationsAsReadOnBellClick();
  voteForComments();
  postComment();
  replyComment();
  loadMoreComments();
  showAllReplies();
  initTradingView();
  toggleTradeVisibility();
  followUnfollow();
  resendConfirmationLink();
  showHideTradeModal();

  if (typeof totalFollowings !== 'undefined') {
    updateFollowSomeoneHeading();
  }
});

function showHideTradeModal() {
  $('#new-trade,.new-trade,#new-trade-nav').on('click', function (e) {
    e.preventDefault();

    if ($('.trade-modal').length) {
      if (!$('.trade-modal').hasClass('open')) {
        console.log('-' + String(window.scrollY) + 'px');
        var css = '-' + String(window.scrollY) + 'px';
        $('.trade-modal').addClass('open');
        $('body').addClass('shade-active modal-open');
        document.body.style.position = 'fixed';
        document.body.style.top = css;
        document.body.style.bottom = '0px';
        document.body.style.right = '0px';
        document.body.style.left = '0px';
        $('.trade-modal').trigger('open');
      } else {
        $('.trade-modal').removeClass('open');
        $('body').removeClass('shade-active modal-open');
        var scrollY = document.body.style.top;
        document.body.style.top = '';
        document.body.style.bottom = '';
        document.body.style.right = '';
        document.body.style.left = '';
        window.scrollTo(0, parseInt(scrollY || '0') * -1);
      }
    } else {
      window.location = '/app#trade';
    }
  });
}

function initTinyMCE() {
  tinymce.init({
    selector: '#contentfield',
    plugins: "image",
    menubar: "",
    image_caption: true
  });
}

function toggleBalance() {
  $('#toggle-balance').on('click', function (e) {
    e.preventDefault();
    $('#balance-dropdown-item').dropdown('toggle');
    console.log('balance-dropdown-item');
    e.stopPropagation();
  });
}

function initDropzone() {
  if ($('div#attachment').length == 0) return;
  var myDropzone = new Dropzone("div#attachment", {
    url: "/app/lessons/attachment",
    renameFile: function renameFile(file) {
      var dt = new Date();
      var time = dt.getTime();
      return time + file.name.replace(/[^\w.]+/g, "");
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    acceptedFiles: "image/jpeg,image/png,application/vnd.ms-excel,application/vnd.ms-powerpoint,application/msword,video/mpeg,video/mp4,application/pdf",
    addRemoveLinks: true,
    removedfile: function removedfile(file) {
      var name = file.upload.filename;
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: '/app/lessons/attachment/delete',
        data: {
          filename: name,
          lesson_id: $('input[name="lesson_id"]').val()
        },
        success: function success(data) {
          console.log("File has been successfully removed!!");
        },
        error: function error(e) {
          console.log(e);
        }
      });
      var fileRef;
      return (fileRef = file.previewElement) != null ? fileRef.parentNode.removeChild(file.previewElement) : void 0;
    }
  });
  myDropzone.on('sending', function (file, xhr, formData) {
    formData.append('lesson_id', $('input[name="lesson_id"]').val());
  });

  if ((typeof lessonAttachments === "undefined" ? "undefined" : _typeof(lessonAttachments)) !== undefined && lessonAttachments.length > 0) {
    for (var i = 0; i < lessonAttachments.length; i++) {
      myDropzone.emit("addedfile", lessonAttachments[i]); //myDropzone.emit("thumbnail", lessonAttachments[i], "/image/url");

      myDropzone.emit("complete", lessonAttachments[i]);
    }
  }
}

function changeMyFeedOnOff() {
  $('#turn-my-feed-on').click(function (e) {
    e.preventDefault();
    axios({
      method: 'get',
      url: '/app/filters/turn-on-my-feed-mode',
      responseType: 'json'
    }).then(function (response) {
      window.location.reload();
    });
  });
  $('#turn-my-feed-off').click(function (e) {
    e.preventDefault();
    axios({
      method: 'get',
      url: '/app/filters/turn-off-my-feed-mode',
      responseType: 'json'
    }).then(function (response) {
      window.location.reload();
    });
  });
}

function resendConfirmationLink() {
  $('#resend').click(function (e) {
    e.preventDefault();
    axios({
      method: 'get',
      url: '/app/resend-confirmation-link',
      responseType: 'json'
    }).then(function (response) {
      if (response.data.success === true) {
        $('#success-alert-text').html(response.data.message);
        $('.toast.success').toast({
          'delay': 5000,
          'autohide': true
        });
        $('.toast.success').toast('show');
        $('#success-alert').show();
      } else {
        $('#error-alert-text').html(response.data.message);
        $('.toast.error').toast({
          'delay': 5000,
          'autohide': true
        });
        $('.toast.error').toast('show');
        $('#error-alert').show();
      }

      $('html, body').animate({
        scrollTop: $("main").offset().top
      }, 1000);
    });
  });
}

function updateFollowSomeoneHeading() {
  if (leftToFollow < 1) {
    $('#follow-someone-heading').text('Done!');
  } else {
    $('#left-to-follow').text(leftToFollow);
  }
}

function followUnfollow() {
  $('.follow-unfollow-button').click(function (e) {
    e.preventDefault();

    if (!$(this).hasClass('disabled')) {
      var button = $(this);
      axios({
        method: 'get',
        url: $(this).attr('href'),
        responseType: 'json'
      }).then(function (response) {
        if ($(button).hasClass('follow-button')) {
          if ($(button).hasClass('follow-someone-page-button')) {
            var id = $(button).attr('data-id');
            $('a[data-id="' + id + '"]').removeClass('follow-button').addClass('unfollow-button').addClass('disabled');
            $('#proceed-to-platform').removeClass('disabled');
            leftToFollow--;
            updateFollowSomeoneHeading();
          } else {
            $(button).removeClass('follow-button').addClass('unfollow-button').removeClass('btn-primary').addClass('btn-white');
            $(button).attr('href', $(button).attr('href').replace('follow', 'unfollow'));
            $(button).text('Unfollow');
          }
        } else {
          if ($(button).hasClass('follow-someone-page-button')) {
            $('a[data-id="' + id + '"]').removeClass('unfollow-button').addClass('follow-button').addClass('disabled');
          } else {
            $(button).removeClass('unfollow-button').addClass('follow-button').removeClass('btn-white').addClass('btn-primary');
            $(button).attr('href', $(button).attr('href').replace('unfollow', 'follow'));
            $(button).text('Follow');
          }
        }
      })["catch"](function (error) {
        window.location.href = '/login';
      });
    }
  });
}

function toggleTradeVisibility() {
  $('body').on('click', '.toggleTradeVisibility', function () {
    if ($(this).hasClass('fa-eye')) {
      $(this).parents('form').find('input[name="public"]').val('off');
      $(this).removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
      $(this).parents('form').find('input[name="public"]').val('on');
      $(this).removeClass('fa-eye-slash').addClass('fa-eye');
    }

    $(this).parents('form').submit();
  });
  $('body').on('submit', '.update-trade-visibility', function (e) {
    e.preventDefault();
    var data = $(this).serialize();
    axios({
      method: 'get',
      url: $(this).attr('action') + '?' + data,
      responseType: 'json'
    }).then(function (response) {});
  });
}

function populateModalDataToBecomeAPatronModalOnClick() {
  $('body').on('click', '.feed-page-open-patron-button', function (e) {
    var userId = $(this).attr('data-id');
    var avatar = $(this).attr('data-avatar');
    var username = $(this).attr('data-username');
    var price = $(this).attr('data-price');
    $('.insert-username').html(username);
    $('.insert-price').html(price);
    $('.insert-avatar').attr('src', avatar);
    $('#ccModal form').each(function () {
      $(this).attr('action', '/app/become-patron/' + userId);
    });
  });
}

function loadMoreProfileTradesOnScroll() {
  scroll = $('.feed-wrapper').infiniteScroll({
    // options
    path: '/' + profileSlug + '/trades/page/{{#}}',
    checkLastPage: '.trade-item',
    append: '.trade-item',
    history: false
  });
  scrollEvents();
}

function loadMoreFeedsOnScroll() {
  scroll = $('.feed-wrapper').infiniteScroll({
    // options
    path: function path() {
      var pageIndex = this.loadCount + 1;
      return '/app/feed/page/' + pageIndex;
    },
    checkLastPage: '.trade-item',
    append: '.trade-item',
    history: false
  });
  scrollEvents();

  if (currentFilter == null) {
    scroll.infiniteScroll('loadNextPage');
  }
}

function addNewTradeToFeed(e) {
  if ($('#trade-item-' + e.tradeId).length > 0) {
    return;
  }

  axios({
    method: 'get',
    url: '/app/trade/load/' + e.tradeId,
    responseType: 'json'
  }).then(function (response) {
    if (response.data.success) {
      if (myFeedOn && !response.data.myFeed) {
        $('#global-feed-bubble').show();
      } else if (!myFeedOn && response.data.myFeed) {
        $('#my-feed-bubble').show();
      } else {
        var currentCount = parseInt($('#unread-trades-count').attr('data-count'));
        var currentCountWord = 'trade';
        currentCount++;

        if (isNaN(parseFloat(currentCount))) {
          currentCount = 1;
        }

        if (currentCount > 1) {
          currentCountWord = 'trades';
        }

        $('#unread-trades-count-trades-word').html(currentCountWord);
        var newTitle = '(' + currentCount + ') ' + title;
        document.title = newTitle;
        document.getElementById('favicon').href = activeFavicon;
        $('#unread-trades-count').attr('data-count', currentCount);
        $('#unread-trades-count').html(currentCount);
        unloadedTradesCache = response.data.html + unloadedTradesCache;
        $('#unread-trades-button').show();
      }
    }
  });
}

function listenForEvents() {
  window.Echo.channel('price-updated').listen('CurrencyUpdated', function (e) {
    updatePair(e);
  });
  window.Echo.channel('new-trade').listen('NewTrade', function (e) {
    addNewTradeToFeed(e);
  });
  window.Echo["private"]('user.' + ownId).listen('UserNotification', function (e) {
    addNotification(e);
  });
  window.Echo["private"]('user.' + ownId).listen('RedeemCompleted', function (e) {
    console.log('redeemed');
    notifyAboutRedeem(e);
  });
}

function notifyAboutRedeem(e) {
  $('#error-alert-redeem').hide();

  if (e.status == 'completed') {
    $('#redeem-sats-modal').modal('hide');
    Swal.fire({
      title: 'Hooray! Payout Successful!',
      html: 'Your reward was made possible by our sponsor <a href="https://cryptoparrot.com/ospreyfx" target="_blank">OspreyFX</a> - Trade Crypto and Forex (FX) on MT4 with up to 1:500 leverage. Thank them by checking out their website.',
      type: 'success',
      showCancelButton: true,
      confirmButtonColor: '#15c670',
      confirmButtonText: '<i class="far fa-external-link-square-alt"></i> Visit Sponsor\'s Site',
      cancelButtonText: 'Close'
    }).then(function (result) {
      if (result.value) {
        window.open('https://cryptoparrot.com/ospreyfx', '_blank');
      } else if (result.dismiss === Swal.DismissReason.cancel) {}

      $('#invoice_address').val('');
    });
    axios({
      method: 'get',
      url: '/app/current-portfolio-html',
      responseType: 'json'
    }).then(function (response) {
      // TBA
      $('#portfolio-card-wrapper').html(response.data.html);
    });
  } else {
    $('#redeem-sats-modal').modal('hide');
    Swal.fire('Redeem failed!', 'Something went wrong. Please try again.', 'error');
  }
}

function updatePair(e) {
  console.log(e);
  $('.card-' + e.pairId).removeClass('up down');

  if (e.direction == 'up') {
    $('.card-' + e.pairId).addClass("up");
    $('.card-' + e.pairId + ' .pct').addClass("pct-up");
  } else if (e.direction == 'down') {
    $('.card-' + e.pairId).addClass("down");
    $('.card-' + e.pairId + ' .pct').addClass("pct-down");
  }

  $('.card-' + e.pairId + ' .pct').removeClass("pct-up pct-down");
  $('.col-card-' + e.pairId).data('change', e.change);
  if (parseFloat(e.change) > 0) $('.card-' + e.pairId + ' .pct').addClass("pct-up");
  if (parseFloat(e.change) < 0) $('.card-' + e.pairId + ' .pct').addClass("pct-down");
  $('.card-' + e.pairId + ' .pct,.pair-pct-' + e.pairId).html(parseFloat(e.change).toFixed(2) + '%');
  $('.pair-price-' + e.pairId).html(e.price);
}

function addNotification(e) {
  var currentCount = parseInt($('#unread-count').attr('data-count'));
  currentCount++;
  var newTitle = '(' + currentCount + ') ' + title;
  document.title = newTitle;
  document.getElementById('favicon').href = activeFavicon;
  $('#unread-count').attr('data-count', currentCount);
  $('#unread-count').html(currentCount);
  $('#unread-count').show();
  $('#no-notifications').hide(); //if($('a .notification__icon-wrapper').length < 5) {
  //$('#notifications').prepend('<a class="dropdown-item" href="'+e.url+'"><div class="notification__icon-wrapper"><div class="notification__icon"><i class="far '+e.icon+'"></i></div></div><div class="notification__content"><span class="notification__category"><i class="far fa-circle text-success mr-1"></i>'+e.title+'</span><p>'+e.text+'</p></div></a>');
  //}
}

function loadUnreadTradesOnClick() {
  $('body').on('click', '#unread-trades-button', function () {
    $('.feed-wrapper').prepend(unloadedTradesCache);
    unloadedTradesCache = '';
    document.title = title;
    document.getElementById('favicon').href = normalFavicon;
    $('#unread-trades-count').attr('data-count', 0);
    $('#unread-trades-count').html('0');
    $('#unread-trades-button').hide();
    $('#my-feed-bubble').hide();
    $('#global-feed-bubble').hide();
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

    $('.trade-description').each(function () {
      var text = $(this).html();
      var output = wdtEmojiBundle.render(text);
      $(this).html(output);
    });
    $('.comment-text').each(function () {
      var text = $(this).html();
      var output = wdtEmojiBundle.render(text);
      $(this).html(output);
    });
    initTradingView();
  });
}

function showCommentsOnClick() {
  $('body').on('click', '.show-comments-button', function (e) {
    e.preventDefault();
    var targetId = $(this).attr('data-id');
    $('#comments-' + targetId).show();
    $('.commentForm[data-trade-id=' + targetId + ']').closest('.reply-block').show();
    $('.commentForm[data-trade-id=' + targetId + '] textarea').focus();
  });
}

function loadMoreComments() {
  $('body').on('click', '.load-more-comments', function () {
    var button = $(this);
    var page = parseInt(button.attr('data-page'));
    var tradeId = button.attr('data-trade-id');
    button.attr('data-page', page + 1);
    axios({
      method: 'get',
      url: '/load-more/trade-comments/' + tradeId + '/page/' + page,
      responseType: 'json'
    }).then(function (response) {
      if (response.data.success) {
        $('#comments-' + tradeId + '-wrapper').append(response.data.html);
        voteForComments();
        showAllReplies();

        if (!response.data.hasMore) {
          $('.load-more-comments[data-trade-id="' + tradeId + '"]').hide();
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

        $('.trade-description').each(function () {
          var text = $(this).html();
          var output = wdtEmojiBundle.render(text);
          $(this).html(output);
        });
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
      url: '/load-more/trade-comment-replies/' + commentId,
      responseType: 'json'
    }).then(function (response) {
      if (response.data.success) {
        $('#replies-' + commentId + '-wrapper').html(response.data.html);
        voteForComments();
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

function markNotificationsAsReadOnBellClick() {
  $('#notifications-list').click(function () {
    document.title = title;
    document.getElementById('favicon').href = normalFavicon;
    $('#unread-count').attr('data-count', 0);
    $('#unread-count').html(0);
    $('#unread-count').hide();
    axios({
      method: 'get',
      url: '/app/load-notifications',
      responseType: 'json'
    }).then(function (response) {
      if (response.data.success) {
        $('#notifications-list-items').html(response.data.notifications);
        axios({
          method: 'post',
          url: '/app/read-notifications',
          responseType: 'json'
        });
      }
    });
  });
}

var likingTrade = false;

function voteForComments() {
  $('body').on('click', '.voteUp', function () {
    if (likingTrade == true) return;
    likingTrade = true;
    var userId = $(this).attr('data-user-id');
    var tradeId = $(this).attr('data-trade-id');
    var currentVotes = $(this).attr('data-current-votes');
    currentVotes++;
    $(this).attr('data-current-votes', currentVotes);
    $('.votes-' + tradeId).html(currentVotes);
    $(this).addClass('voteDown').removeClass('voteUp');
    $(this).find('i').removeClass('far').addClass('fas');
    axios({
      method: 'get',
      url: '/app/vote-up/' + userId + '/' + tradeId,
      responseType: 'json'
    }).then(function (response) {
      likingTrade = false;
    })["catch"](function (error) {
      likingTrade = false;
    });
  });
  $('body').on('click', '.voteDown', function () {
    if (likingTrade == true) return;
    likingTrade = true;
    var userId = $(this).attr('data-user-id');
    var tradeId = $(this).attr('data-trade-id');
    var currentVotes = $(this).attr('data-current-votes');
    currentVotes--;
    $('.votes-' + tradeId).html(currentVotes);
    $(this).attr('data-current-votes', currentVotes);
    $(this).addClass('voteUp').removeClass('voteDown');
    $(this).find('i').removeClass('fas').addClass('far');
    axios({
      method: 'get',
      url: '/app/vote-down/' + userId + '/' + tradeId,
      responseType: 'json'
    }).then(function (response) {
      likingTrade = false;
    })["catch"](function (error) {
      likingTrade = false;
    });
  });
  $('body').on('click', '.voteUpComment', function () {
    if (likingTrade == true) return;
    likingTrade = true;
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
      url: '/app/vote-up/trade-comment/' + userId + '/' + commentId,
      responseType: 'json'
    }).then(function (response) {
      likingTrade = false;
    })["catch"](function (error) {
      likingTrade = false;
    });
  });
  $('body').on('click', '.voteDownComment', function () {
    if (likingTrade == true) return;
    likingTrade = true;
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
      url: '/app/vote-down/trade-comment/' + userId + '/' + commentId,
      responseType: 'json'
    }).then(function (response) {
      likingTrade = false;
    })["catch"](function (error) {
      likingTrade = false;
    });
  });
}

function replyComment() {
  $('body').on('click', '.comment-reply', function (e) {
    e.preventDefault();
    var targetId = $(this).attr('data-id');
    $('form[data-reply-id="' + targetId + '"]').closest('.reply-block').show();
    $('form[data-reply-id="' + targetId + '"] textarea').focus();
  });
}

var sendingComment = false;

function postComment() {
  $('body').on('keyup', '.commentForm textarea', function (e) {
    if (e.which == 13) {
      console.log('click enter');
      $(this).closest('form').submit();
      return false; //<---- Add this line
    }
  });
  $('body').on('submit', '.commentForm', function (e) {
    e.preventDefault();
    if (sendingComment) return;
    sendingComment = true;
    $('#comment-post-error').html('');
    var form = $(this);
    var type = $(this)[0].hasAttribute('data-reply-id') ? 'reply' : 'trade';
    var id = type === 'reply' ? $(this).attr('data-reply-id') : $(this).attr('data-trade-id');
    var query = type === 'reply' ? 'replies-' + id + '-wrapper' : 'comments-' + id;
    var comment = $(this).find('textarea[name="comment"]').val();
    var gif = form.find('[name="gif"]').val();
    var gif_html = '';

    if (gif != '') {
      gif_html = "\n                    <div class=\"gif-image-comment mt-3\">\n                        <img src=\"https://media.giphy.com/media/" + gif + "/giphy.gif\">\n                        <div class=\"giphy-attribution-holder\">\n                        <a href=\"https://media.giphy.com/media/" + gif + "/giphy.gif\" class=\"giphy-attribution\" target=\"_blank\" rel=\"nofollow\"><img src=\"/assets/images/giphy.png\"  alt=\"\"></a>\n                        </div>\n                    </div>\n            ";
    }

    if (comment != '') {
      if (type == 'reply') {
        $('#' + query).append('<div class="comment newly-added-comment"><div class="mb-3"><div class="comment-container comment-container-parent"><div class="comment-avatar d-none d-sm-block"><img class="user-avatar rounded-circle w-100" src="' + myAvatar + '" alt="User Avatar"></div><div class="comment-box p-3 mb-1"><a href="/' + myHandle + '"><img class="d-inline-block d-sm-none user-avatar-sm rounded-circle mr-1" src="' + myAvatar + '" alt="User Avatar"> <strong>' + myUsername + '</strong></a>  <span class="comment-text">' + comment + '</span>' + gif_html + '<div class="comment-meta text-muted mt-2"><span>0</span><span class="px-2">1 second ago</span></div></div></div></div></div>');
      } else {
        $('#' + query).prepend('<div class="comment newly-added-comment"><div class="mb-3"><div class="comment-container comment-container-parent"><div class="comment-avatar d-none d-sm-block"><img class="user-avatar rounded-circle w-100" src="' + myAvatar + '" alt="User Avatar"></div><div class="comment-box p-3 mb-1"><a href="/' + myHandle + '"><img class="d-inline-block d-sm-none user-avatar-sm rounded-circle mr-1" src="' + myAvatar + '" alt="User Avatar"> <strong>' + myUsername + '</strong></a>  <span class="comment-text">' + comment + '</span>' + gif_html + '<div class="comment-meta text-muted mt-2"><span>0</span><span class="px-2">1 second ago</span></div></div></div></div></div>');
      }
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
        form.find('.gif-holder').addClass('d-none').removeClass('d-flex');
        form.find('[name="gif"]').val('');
        form.find('.gif-image').html('');
      } else {
        $('.newly-added-comment').addClass('action-failed');
        $(form).find('.comment-post-error').html(response.data.message);
        $('.newly-added-comment').addClass('d-none');
      }

      sendingComment = false;
    })["catch"](function (error) {
      sendingComment = false;
    });
  });
}

var sendingMessage = false;
var messageId = 0;

function sendChatMessage() {
  listenToMessages();
  $('#chat-form textarea[name="message"]').on('keypress', function (e) {
    if (e.which == 13 && !e.shiftKey) {
      //submit form via ajax, this is not JS but server side scripting so not showing here
      $('#chat-form').submit();
      e.preventDefault();
    }
  });
  $('body').on('submit', '#chat-form', function (e) {
    e.preventDefault();
    if (sendingMessage || $('textarea[name="message"]').val().length === 0) return;
    sendingMessage = true;
    $('#message-post-error').html('');
    var data = $(this).serialize();
    messageId++;
    var currentMessageId = messageId;
    appendMessage(currentMessageId);
    axios({
      method: $(this).attr('method'),
      url: $(this).attr('action'),
      responseType: 'json',
      data: data
    }).then(function (response) {
      if (response.data.success !== true) {
        $('li[data-id="' + currentMessageId + '"]').addClass('failed');
      } else {
        $('#comment-post-error').html(response.data.message);
      }

      $(".messages").scrollTop($(".messages")[0].scrollHeight);
      $('.messages').each(function () {
        var text = $(this).html();
        var output = wdtEmojiBundle.render(text);
        $(this).html(output);
      });
      sendingMessage = false;
    })["catch"](function (error) {
      sendingMessage = false;
    });
  });
  $('body').on('click', '#load-older-messages', function () {
    if (oldestMessageId) {
      axios({
        method: 'POST',
        url: window.location.href + '/load',
        responseType: 'json',
        data: {
          lastMessageId: oldestMessageId
        }
      }).then(function (response) {
        if (response.data.success) {
          var message = null;
          var dataToPrepend = '';

          for (var i = 0; i < response.data.messages.data.length; i++) {
            message = response.data.messages.data[i];

            if (i == 0) {
              oldestMessageId = message['id'];
            }

            if (message['author'] == myRole) {
              dataToPrepend += '<li class="sent d-flex"><p class="ml-auto">' + message['message'] + '</p><div class="pl-2"><img src="' + myAvatar + '" alt="" /></div></li>';
            } else {
              dataToPrepend += '<li class="replies d-flex"><div class="pr-2"><img src="' + otherAvatar + '" alt="" /></div><p class="">' + message['message'] + '</p></li>';
            }
          }

          if (!response.data.messages.hasMore) {
            $('#load-older-messages').hide();
          }

          $('#load-older-messages').after(dataToPrepend);
        } else {
          $('#load-older-messages').hide();
        }

        $('.messages').each(function () {
          var text = $(this).html();
          var output = wdtEmojiBundle.render(text);
          $(this).html(output);
        });
      })["catch"](function (error) {
        $('#load-older-messages').hide();
      });
    }
  });
}

function appendMessage(id) {
  $('.messages ul').append('<li data-id="' + id + '" class="sent d-flex"><p class="ml-auto">' + $('textarea[name="message"]').val() + '</p><div class="pl-2"><img src="' + myAvatar + '" alt="" /></div></li>');
  $('textarea[name="message"]').val('');
}

function listenToMessages() {
  if ((typeof conversationsToListen === "undefined" ? "undefined" : _typeof(conversationsToListen)) !== undefined && conversationsToListen.length > 0) {
    for (var i = 0; i < conversationsToListen.length; i++) {
      window.Echo["private"]('conversation.' + conversationsToListen[i]).listen('NewMessage', function (e) {
        if (e.conversation.id === currentConversationId) {
          if (e.message.author !== myRole) {
            $('.messages ul').append('<li class="replies"><img src="' + otherAvatar + '" alt="" /><p>' + e.message.message + '</p></li>');
          }

          var objDiv = $('.messages')[0];
          objDiv.scrollTop = objDiv.scrollHeight;
        } else {
          if ($.inArray(e.conversation.id, unreadConversations) == -1) {
            unreadConversations.push(e.conversation.id);
            var currentCount = parseInt($('#conversations-unread-count').attr('data-count'));
            currentCount++;
            var newTitle = '(' + currentCount + ') ' + title;
            document.title = newTitle;
            document.getElementById('favicon').href = activeFavicon;
            $('#conversations-unread-count').attr('data-count', currentCount);
            $('#conversations-unread-count').html(currentCount);
            $('#conversations-unread-count').show();
            $('#conversation-' + e.conversation.id).addClass('new-message');
          }
        }
      });
    }
  }
}
/* refactored */


$('.dropdown').on('show.bs.dropdown', function (e) {
  $('body').addClass('shade-active');
});
$('.dropdown').on('hide.bs.dropdown', function (e) {
  $('body').removeClass('shade-active');
});
$(document).on('click', '.dropdown-menu', function (e) {
  e.stopPropagation();
});
$('#show-portfolio').on("click", function (e) {
  e.preventDefault();
  $('#new-card,#switch-card,#show-portfolio').addClass('d-none');
  $('#portfolio-card,#show-new,#show-switch').removeClass('d-none');
});
$('#show-new').on("click", function (e) {
  e.preventDefault();
  $('#portfolio-card,#switch-card,#show-new').addClass('d-none');
  $('#new-card,#show-portfolio,#show-switch').removeClass('d-none');
});
$('#show-switch').on("click", function (e) {
  e.preventDefault();
  $('#portfolio-card,#new-card,#show-switch').addClass('d-none');
  $('#switch-card,#show-portfolio,#show-new').removeClass('d-none');
});

/***/ }),

/***/ 2:
/*!************************************************************!*\
  !*** multi ./resources/assets/js/TradeSubsystem/common.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/forge/dev.cryptoparrot.com/resources/assets/js/TradeSubsystem/common.js */"./resources/assets/js/TradeSubsystem/common.js");


/***/ })

/******/ });