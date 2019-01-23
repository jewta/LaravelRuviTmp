/**
 * Password Generator plugin for jQuery
 *
 * Copyright (c) 2011 .p.i.x.e.l. (www.pixel-tyumen.ru)
 *
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * Usage example: $.password_generator({'count':12,'special':true});
 *
 */

/*jslint plusplus: true, white: true */

$.extend({
    password_generator: function (options) {
	
		'use strict';
	
		var chars = '',
			result = '',
			defaults = {
				count   : 8,
	            digits  : true,
	            upper   : true,
	            lower   : true,
	            special : false
			},
			genRangeChars = function (start, stop) {
	            var chars = '', n;
	            for (n = start; n <= stop; n++) {
	                chars += String.fromCharCode(n);
	            }
	            return chars;
	        },
	        i;
	

        options = $.extend(defaults, options);

        (function () {
            if (options.digits) {
            	chars += genRangeChars(48, 57);
            }
            if (options.upper) {
            	chars += genRangeChars(65, 90);
            }
            if (options.lower) {
            	chars += genRangeChars(97, 122);
            }
            if (options.special) {
            	chars += genRangeChars(33, 47);
            }
            if (options.special) {
            	chars += genRangeChars(58, 64);
            }
            if (options.special) {
            	chars += genRangeChars(91, 96);
            }
            if (options.special) {
            	chars += genRangeChars(123, 126);
            }
        })();

        for (i = 0; i < options.count; i++) {
            result += chars.charAt( Math.floor( Math.random() * chars.length ) );
        }

        return result;

    }
});
