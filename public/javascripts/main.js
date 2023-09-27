////////////////////////////////////////////////////////////////////////////////////////////////////
//
// This is the primary JavaScript that will run either when the DOM elements loaded or Page loaded
// Date: 10/11/2022
// Author: Robert Lai
//
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////
// This section will take action when Page is ready
////////////////////////////////////////////////////////
$(window).on('load', function() {

	// Make footer always at the bottom
	var footerHeight = 0;
	var footerTop = 0;
	let $footer = $("#footer");

	positionFooter();

	function positionFooter() {
		footerHeight = $footer.height();
		footerTop = ($(window).scrollTop()+$(window).height()-footerHeight)+"px";

		if ( ($(document.body).height()+footerHeight) < $(window).height()) {
			$footer.css({
				position: "absolute"
			}).animate({
				top: footerTop
			})
		} else {
			$footer.css({
				position: "static"
			})
		}
	}

	// $(window).scroll(positionFooter).resize(positionFooter);

});

////////////////////////////////////////////////////////
// This section will take action when DOM elements ready
////////////////////////////////////////////////////////
$(document).ready(function() {
	
});
