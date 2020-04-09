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

/***/ "./resources/js/index.js":
/*!*******************************!*\
  !*** ./resources/js/index.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  // check all
  $("#check-all").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
  }); // update status

  var _loop = function _loop(index) {
    if ($('.publish-' + index).length) {
      $('.publish-' + index).click(function () {
        var id = $('.publish-' + index).attr('data-id');
        var value = $('.publish-' + index).attr('data-value');
        var type = $('.publish-' + index).attr('data-name');
        var url = $('.publish-' + index).attr('data-url');
        axios.post(url, {
          id: id,
          value: value,
          type: type
        }).then(function (response) {
          console.log(response.data.publish);

          if (response.data.publish == 1) {
            $('.publish-' + index).attr('class', 'fas fa-check text-success fa-lg publish-' + index);
            $('.publish-' + index).attr('data-value', 1);
            toastr.success('Kích hoạt trạng thái thành công.');
          } else {
            $('.publish-' + index).attr('class', 'fas fa-times text-danger fa-lg publish-' + index);
            $('.publish-' + index).attr('data-value', 0);
            toastr.warning('Hủy bỏ trạng thái thành công.');
          }
        })["catch"](function (error) {
          console.log(error);
        });
      });
    }

    if ($('.highlight-' + index).length) {
      $('.highlight-' + index).click(function () {
        var id = $('.highlight-' + index).attr('data-id');
        var value = $('.highlight-' + index).attr('data-value');
        var type = $('.highlight-' + index).attr('data-name');
        var url = $('.highlight-' + index).attr('data-url');
        axios.post(url, {
          id: id,
          value: value,
          type: type
        }).then(function (response) {
          console.log(response.data.highlight);

          if (response.data.highlight == 1) {
            $('.highlight-' + index).attr('class', 'fas fa-check text-success fa-lg highlight-' + index);
            $('.highlight-' + index).attr('data-value', 1);
            toastr.success('Kích hoạt trạng thái thành công.');
          } else {
            $('.highlight-' + index).attr('class', 'fas fa-times text-danger fa-lg highlight-' + index);
            $('.highlight-' + index).attr('data-value', 0);
            toastr.warning('Hủy bỏ trạng thái thành công.');
          }
        })["catch"](function (error) {
          console.log(error);
        });
      });
    }

    if ($('.sort-order-' + index).length) {
      $('.sort-order-' + index).keyup(function () {
        var value = $('.sort-order-' + index).val();
        var url = $('.sort-order-' + index).attr('data-url');
        var id = $('.sort-order-' + index).attr('data-id');
        var type = $('.sort-order-' + index).attr('data-name');
        axios.post(url, {
          id: id,
          value: value,
          type: type
        }).then(function (response) {
          console.log(response);
          toastr.success('Cập nhật thứ tự thành công.');
        })["catch"](function (error) {
          console.log(error);
        });
      });
    }

    if ($('.row-' + index).length) {
      $('.remove-' + index).click(function () {
        var id = $('.remove-' + index).attr('data-id');
        var url = $('.remove-' + index).attr('data-url');
        $('#modal-delete').modal();
        $('.nb-yes').attr('data-id', id);
        $('.nb-yes').attr('data-url', url);
        $('.nb-yes').attr('data-key', index);
      });
    }
  };

  for (var index = 0; index < $('tbody tr').length; index++) {
    _loop(index);
  }

  $('.nb-yes').click(function () {
    var id = $('.nb-yes').attr('data-id');
    var url = $('.nb-yes').attr('data-url');
    var key = $('.nb-yes').attr('data-key');

    if (id) {
      $('.row-' + key).fadeOut("slow");
      axios.post(url, {
        id: id
      }).then(function (response) {
        console.log(response);
        toastr.success('Thao tác xóa thành công.');
      })["catch"](function (error) {
        console.log(error);
      });
    }
  }); // remove much

  $("input:checkbox").change(function () {
    var someObj = {};
    someObj.fruitsGranted = [];
    someObj.fruitsDenied = [];
    $("input:checkbox").each(function () {
      if ($(this).is(":checked")) {
        someObj.fruitsGranted.push($(this).attr("data-id"));
      } else {
        someObj.fruitsDenied.push($(this).attr("data-id"));
      }
    });
    $('.cta-delete-more').attr('data-ids', someObj.fruitsGranted); // console.log(someObj.fruitsGranted)
  });
  $('.cta-delete-more').click(function () {
    // console.log(123);
    var ids = $('.cta-delete-more').attr('data-ids');
    var url = $('.cta-delete-more').attr('data-url');
    $('.nb-yes-all').attr('data-ids', ids);
    $('.nb-yes-all').attr('data-url', url); // console.log(url)

    $('#modal-delete-all').modal();
  });
  $('.nb-yes-all').click(function () {
    var ids = $('.nb-yes-all').attr('data-ids');
    var url = $('.nb-yes-all').attr('data-url');
    axios.post(url, {
      ids: ids
    }).then(function (response) {
      console.log(response);

      if (response.statusText == 'OK') {
        var idArr = ids.split(',');
        $.each(idArr, function (index, value) {
          $('.remove-m' + value).fadeOut();
        });
      }
    })["catch"](function (error) {
      console.log(error);
    });
  });
});

/***/ }),

/***/ 1:
/*!*************************************!*\
  !*** multi ./resources/js/index.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Admin\Homestead\doan-3\resources\js\index.js */"./resources/js/index.js");


/***/ })

/******/ });