// usage: log('inside coolFunc', this, arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function(){ log.history = log.history || []; log.history.push(arguments); arguments.callee = arguments.callee.caller; if(this.console) { console.log( Array.prototype.slice.call(arguments) ); } };

// make it safe to use console.log always
(function(b){function c(){}for(var d="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info, log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","),a;a=d.pop();){b[a]=b[a]||c}})(window.console=window.console||{});

/** 
 * Track an event:
 *  @category: button or pageChange
 *  @label: what type of link was clicked? 
 *  @value: which button was clicked? i.e. registerForm button
 **/
function trackEvent(category, label, value) {
  try {
    log("track: category:" + category + " - label: " + label + " - value: " + value);

    if(label !== undefined && value !== undefined)
      _gaq.push(['_trackEvent', category, label, value]);
    else if(label !== undefined)
      _gaq.push(['_trackEvent', category, label]);
    else
      _gaq.push(['_trackEvent', category]);
  } catch(err) {
    log("couldn't track event: " + category + " " + label + " " + value);
  }
}

/** 
 * Track errors globally: it enables global error catching and sends them to Google Analytics.
 **/
window.onerror = function(message, file, line) {
  trackEvent('Errors', 'Site', '[' + file + ' (L ' + line + ')] ' + message);
};

$(document).ready(function(){

	if (Modernizr.csscolumns) {
     /* properties for browsers that
     support audio */
	}else{
		if(window.innerWidth > 1200)
		{
			cols(2)
		}
	}
	
	
	$("details summary").click(toggleDetail);
	$("details summary").keypress(toggleDetail);


	

});


function toggleDetail() {
		$(this).parent().toggleClass("open").siblings("details").removeClass("open");
		$(this).next("div").slideToggle("fast").parent("details").siblings("details").find("div").slideUp("fast");
}

function cols(columns){

		$('.col').columnize({
			columns : columns,
			buildOnce : false
		});
	
}
