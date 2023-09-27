////////////////////////////////////////////////////////////////////////////////////////////////////
//
// This is the utility JavaScript that will support all basic function across the application
// Date: 10/11/2022
// Author: Robert Lai
//
////////////////////////////////////////////////////////////////////////////////////////////////////

var utils = {
	convertFileSize: function(size) {
		let sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
		if (size == 0) {
			return '0 Byte';
		}
		let index = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
		return Math.round(size / Math.pow(1024, index), 2) + ' ' + sizes[index];
	},
	getEventTarget: function(event) {
		event = event || window.event;

		//added by MS, needed for IE8
		if (window.attachEvent && event.customTarget) {
			return event.customTarget;
		}

		var obj = (event.currentTarget) ? event.currentTarget : (event.srcElement) ? event.srcElement : event.customTarget;
		if ((obj == null || obj == undefined) && window.event) {
			obj = window.event.srcElement;
		}
		if ((obj == null || obj == undefined) && this != window) {
			obj = this;
		}
		return obj;
	},
	cancelEvent: function(event) {
		if (event) {
			if (event.stopPropagation) {
				event.stopPropagation();
			}
			if (event.preventDefault) {
				event.preventDefault();
			}
			event.cancelBubble = true;
			event.cancel = true;
		}
	},
	stopPropagation: function(event) {
		if (event) {
			if (event.stopPropagation) {
				event.stopPropagation();
			}
			event.cancelBubble = true;
		}
	},
	getRandomText: function(length=10) {
		var result = '';
		var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		var charactersLength = characters.length;
		for (var i = 0; i < length; i++) {
			result += characters.charAt(Math.floor(Math.random() *  charactersLength));
		}
		return result;
	},
	sentToPrinter: function() {
		window.print();
	},
	showPopup: function(header, content) {
		if ($('#popup').length) {
			$('#popup #header').html(header);
			$('#popup #content').html(content);
			$('#popup').show();	
		}
	},

	hidePopup: function() {
		$('#popup #header').html('');
		$('#popup #content').html('');
		$('#popup').hide();
	}
};