(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define("Dialog", [], factory);
	else if(typeof exports === 'object')
		exports["Dialog"] = factory();
	else
		root["Dialog"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/dialog.js":
/*!********************************!*\
  !*** ./resources/js/dialog.js ***!
  \********************************/
/***/ ((module) => {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Dialog = /*#__PURE__*/function () {
  function Dialog(dialogContent) {
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

    _classCallCheck(this, Dialog);

    this.content = document.getElementById(dialogContent);
    this.isShow = false;
    this.dialogBackground = document.getElementsByClassName('dialog_background')[0];

    if (typeof this.dialogBackground != 'undefined' && this.dialogBackground != null) {
      this.wrapContent(this.dialogBackground, this.content);
    } else {
      this.dialogBackground = document.createElement('div');
      this.dialogBackground.setAttribute('class', 'dialog_background');
      this.wrapContent(this.dialogBackground, this.content);
    }

    this.content.setAttribute('class', 'dialog-main-block');
    this.content.style.display = 'none';

    if (options) {
      if (options['title']) {
        var title = document.createElement('div');
        title.setAttribute('class', 'dialog_title');
        this.closeButton = document.createElement('img');
        this.closeButton.setAttribute('class', 'dialog_close_btn');
        this.closeButton.setAttribute('src', '/img/close.svg');
        title.prepend(this.closeButton);
        title.prepend(options['title']);
        this.content.prepend(title);
      }
    }

    this.dialogBackground.addEventListener('click', this.hideDialogBackground.bind(this));
    this.closeButton.addEventListener('click', this.closeDialog.bind(this));
  }

  _createClass(Dialog, [{
    key: "hideDialogBackground",
    value: function hideDialogBackground(e) {
      if (e.target.className === 'dialog_background') {
        this.closeDialog();
      }
    }
  }, {
    key: "closeDialog",
    value: function closeDialog() {
      if (this.isShow) {
        this.isShow = false;
        this.dialogBackground.style.display = 'none';
        this.content.style.display = 'none';
      }
    }
  }, {
    key: "openDialog",
    value: function openDialog() {
      if (!this.isShow) {
        this.isShow = true;
        this.dialogBackground.style.display = 'flex';
        this.content.style.display = 'block';
      }
    }
  }, {
    key: "wrapContent",
    value: function wrapContent(parent, child) {
      this.content.parentNode.insertBefore(parent, child);
      parent.appendChild(child);
    }
  }]);

  return Dialog;
}();

module.exports = Dialog;

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/js/dialog.js");
/******/ 	
/******/ 	return __webpack_exports__;
/******/ })()
;
});