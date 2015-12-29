/*!
	Autosize 3.0.13
	license: MIT
	http://www.jacklmoore.com/autosize
*/
(function (global, factory) {
	if (typeof define === 'function' && define.amd) {
		define(['exports', 'module'], factory);
	} else if (typeof exports !== 'undefined' && typeof module !== 'undefined') {
		factory(exports, module);
	} else {
		var mod = {
			exports: {}
		};
		factory(mod.exports, mod);
		global.autosize = mod.exports;
	}
})(this, function (exports, module) {
	'use strict';

	var set = typeof Set === 'function' ? new Set() : (function () {
		var list = [];

		return {
			has: function has(key) {
				return Boolean(list.indexOf(key) > -1);
			},
			add: function add(key) {
				list.push(key);
			},
			'delete': function _delete(key) {
				list.splice(list.indexOf(key), 1);
			} };
	})();

	function assign(ta) {
		var _ref = arguments[1] === undefined ? {} : arguments[1];

		var _ref$setOverflowX = _ref.setOverflowX;
		var setOverflowX = _ref$setOverflowX === undefined ? true : _ref$setOverflowX;
		var _ref$setOverflowY = _ref.setOverflowY;
		var setOverflowY = _ref$setOverflowY === undefined ? true : _ref$setOverflowY;

		if (!ta || !ta.nodeName || ta.nodeName !== 'TEXTAREA' || set.has(ta)) return;

		var heightOffset = null;
		var overflowY = null;
		var clientWidth = ta.clientWidth;

		function init() {
			var style = window.getComputedStyle(ta, null);

			overflowY = style.overflowY;

			if (style.resize === 'vertical') {
				ta.style.resize = 'none';
			} else if (style.resize === 'both') {
				ta.style.resize = 'horizontal';
			}

			if (style.boxSizing === 'content-box') {
				heightOffset = -(parseFloat(style.paddingTop) + parseFloat(style.paddingBottom));
			} else {
				heightOffset = parseFloat(style.borderTopWidth) + parseFloat(style.borderBottomWidth);
			}
			// Fix when a textarea is not on document body and heightOffset is Not a Number
			if (isNaN(heightOffset)) {
				heightOffset = 0;
			}

			update();
		}

		function changeOverflow(value) {
			{
				// Chrome/Safari-specific fix:
				// When the textarea y-overflow is hidden, Chrome/Safari do not reflow the text to account for the space
				// made available by removing the scrollbar. The following forces the necessary text reflow.
				var width = ta.style.width;
				ta.style.width = '0px';
				// Force reflow:
				/* jshint ignore:start */
				ta.offsetWidth;
				/* jshint ignore:end */
				ta.style.width = width;
			}

			overflowY = value;

			if (setOverflowY) {
				ta.style.overflowY = value;
			}

			resize();
		}

		function resize() {
			var htmlTop = window.pageYOffset;
			var bodyTop = document.body.scrollTop;
			var originalHeight = ta.style.height;

			ta.style.height = 'auto';

			var endHeight = ta.scrollHeight + heightOffset;

			if (ta.scrollHeight === 0) {
				// If the scrollHeight is 0, then the element probably has display:none or is detached from the DOM.
				ta.style.height = originalHeight;
				return;
			}

			ta.style.height = endHeight + 'px';

			// used to check if an update is actually necessary on window.resize
			clientWidth = ta.clientWidth;

			// prevents scroll-position jumping
			document.documentElement.scrollTop = htmlTop;
			document.body.scrollTop = bodyTop;
		}

		function update() {
			var startHeight = ta.style.height;

			resize();

			var style = window.getComputedStyle(ta, null);

			if (style.height !== ta.style.height) {
				if (overflowY !== 'visible') {
					changeOverflow('visible');
				}
			} else {
				if (overflowY !== 'hidden') {
					changeOverflow('hidden');
				}
			}

			if (startHeight !== ta.style.height) {
				var evt = document.createEvent('Event');
				evt.initEvent('autosize:resized', true, false);
				ta.dispatchEvent(evt);
			}
		}

		var pageResize = function pageResize() {
			if (ta.clientWidth !== clientWidth) {
				update();
			}
		};

		var destroy = (function (style) {
			window.removeEventListener('resize', pageResize);
			ta.removeEventListener('input', update);
			ta.removeEventListener('keyup', update);
			ta.removeEventListener('autosize:destroy', destroy);
			set['delete'](ta);

			Object.keys(style).forEach(function (key) {
				ta.style[key] = style[key];
			});
		}).bind(ta, {
			height: ta.style.height,
			resize: ta.style.resize,
			overflowY: ta.style.overflowY,
			overflowX: ta.style.overflowX,
			wordWrap: ta.style.wordWrap });

		ta.addEventListener('autosize:destroy', destroy);

		// IE9 does not fire onpropertychange or oninput for deletions,
		// so binding to onkeyup to catch most of those events.
		// There is no way that I know of to detect something like 'cut' in IE9.
		if ('onpropertychange' in ta && 'oninput' in ta) {
			ta.addEventListener('keyup', update);
		}

		window.addEventListener('resize', pageResize);
		ta.addEventListener('input', update);
		ta.addEventListener('autosize:update', update);
		set.add(ta);

		if (setOverflowX) {
			ta.style.overflowX = 'hidden';
			ta.style.wordWrap = 'break-word';
		}

		init();
	}

	function destroy(ta) {
		if (!(ta && ta.nodeName && ta.nodeName === 'TEXTAREA')) return;
		var evt = document.createEvent('Event');
		evt.initEvent('autosize:destroy', true, false);
		ta.dispatchEvent(evt);
	}

	function update(ta) {
		if (!(ta && ta.nodeName && ta.nodeName === 'TEXTAREA')) return;
		var evt = document.createEvent('Event');
		evt.initEvent('autosize:update', true, false);
		ta.dispatchEvent(evt);
	}

	var autosize = null;

	// Do nothing in Node.js environment and IE8 (or lower)
	if (typeof window === 'undefined' || typeof window.getComputedStyle !== 'function') {
		autosize = function (el) {
			return el;
		};
		autosize.destroy = function (el) {
			return el;
		};
		autosize.update = function (el) {
			return el;
		};
	} else {
		autosize = function (el, options) {
			if (el) {
				Array.prototype.forEach.call(el.length ? el : [el], function (x) {
					return assign(x, options);
				});
			}
			return el;
		};
		autosize.destroy = function (el) {
			if (el) {
				Array.prototype.forEach.call(el.length ? el : [el], destroy);
			}
			return el;
		};
		autosize.update = function (el) {
			if (el) {
				Array.prototype.forEach.call(el.length ? el : [el], update);
			}
			return el;
		};
	}

	module.exports = autosize;
});
// jQuery(document).ready(function($) {

// 	var form = $('.comment-form');

// 	var is_legit_field = '<p class="comment-form-legit"><input class="is-legit" name="is-legit" type="text" value="" /><label for="is-legit">Fill in if you\'re a spambot</label></p>';

// 	// form.append(is_legit_field);

// 	// new Request({
// 	//     url: form.action,
// 	//     method: 'post',
// 	//     onRequest: function() {},
// 	//     onSuccess: function(content) {},
// 	//     onComplete: function() {}
// 	// }).send(form.toQueryString() + '&is_legit=1');

// });
jQuery(document).ready(function($) {	
	/*------------------------------------------------------------------
	Material Design Form
	-------------------------------------------------------------------*/

	//* When page is loaded, check if input fields and textareas have content
	$('.comment-form input, .comment-form textarea').each( function() {
		if ( $(this).val() !== '' )
   			$(this).prev('label').addClass('superscript');
   	});

	//* Input on focus
   	$('.comment-form input, .comment-form textarea').focus(function() {
   		$(this).prev('label').addClass('superscript');
   	});

   	//* Input lose focus (blur)
   	$('.comment-form input, .comment-form textarea').blur(function() {
   		if ( $(this).val() === '' )
   			$(this).prev('label').removeClass('superscript');
   	});

	
	//* Prepare all textareas for autosize
	$('.sce-edit-button').on('click', 'a', function() {
		console.log('test');
		$('.sce-textarea').css('display', 'block');
		// $('.sce-textarea').css('background-color', 'black');
		$('.sce-textarea textarea').css('overflow-y', 'hidden');
		autosize($('.sce-textarea textarea'));
	});
	$('textarea').attr('rows', '2');
	// from a jQuery collection
   	//* Autosize Textarea
	autosize($('textarea'));

	// overflow-x: hidden; word-wrap: break-word; resize: none; overflow-y: visible;
	// overflow: hidden; word-wrap: break-word; resize: none; height: 101px;


	//* When click on bewerk comment, make textarea autosize...
	// .css('overflow-y', 'hidden')



	//* Werkt niet. Waarom weet ik niet..
	// $('.comment-form input').on( "focus", function() {
	// 	$(this).prev('label').addClass('superscript');
	// });

	// $('.comment-form input').off( "focus", function() {
	// 	if ( $(this).val() == '' )
	// 		$(this).prev('label').removeClass('superscript');
	// });
});
jQuery(document).ready(function($){

	//* Target menu and menu-icon
	var navigation = $("#menu-primary-mobile-items");
	var responsive_menu_icon = $(".menu-toggle");

	//* Click on show menu icon
	responsive_menu_icon.click(function(){
		$(this).toggleClass("expanded");
		navigation.slideToggle();
	});

	//* Add triangle next to submenu in menu
	$(navigation).find(".sub-menu").before('<span class="touch-button">&#9660;</span>');

	//* Click toggles submenu visibility
	navigation.find(".touch-button").click(function(){
		$(this).closest(".menu-item").toggleClass("expanded");
		$(this).next(".sub-menu").slideToggle();
	});

	//* Reset on resize
	$(window).resize(u_debounce(function(){
		//Remove inline style because that overrules stylesheet
		if($(window).width() >= 1000) {  
			navigation.removeAttr('style');
			navigation.find(".sub-menu").removeAttr('style');
			navigation.children(".menu-item").removeClass("expanded");
			responsive_menu_icon.removeClass("expanded");
		}  
	}, 250 ));

});
jQuery(document).ready(function($) {

	//* Add class to all anchors which wrap an image (do not wrap image links which are inside content)
	$('a > img').not( $('#content .entry-content a > img') ).parent().addClass('image-wrap');

	// To Top button
	$('#toTop').click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });

});
//* Wait a couple of miniseconds before action. Useful to prevent multiple triggers on resize
//* Underscore-framework functionality
u_debounce = function(func, wait, immediate) {
	var timeout, args, context, timestamp, result;

	var later = function() {
		var last = u_now() - timestamp;

		if (last < wait && last > 0) {
			timeout = setTimeout(later, wait - last);
		} else {
			timeout = null;
			if (!immediate) {
				result = func.apply(context, args);
				if (!timeout) context = args = null;
			}
		}
	};

	return function() {
		context = this;
		args = arguments;
		timestamp = u_now();
		var callNow = immediate && !timeout;
		if (!timeout) timeout = setTimeout(later, wait);
		if (callNow) {
			result = func.apply(context, args);
			context = args = null;
		}

		return result;
	};
};

//* Calculate now
//* Underscore-framework functionality
u_now = Date.now || function() {
	return new Date().getTime();
};