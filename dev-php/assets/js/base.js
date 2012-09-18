/*global Modernizr,log,_gaq,console,alert*/

// usage: log('inside coolFunc', this, arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function f(){ log.history = log.history || []; log.history.push(arguments); if(this.console) { var args = arguments, newarr; try { args.callee = f.caller; } catch(e) { } newarr = [].slice.call(args); if (typeof console.log === 'object') { log.apply.call(console.log, console, newarr); } else { console.log.apply(console, newarr); } } };

// make it safe to use console.log always
(function(a){function b(){}for(var c="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","),d;!!(d=c.pop());){a[d]=a[d]||b;}})
(function(){try{console.log();return window.console;}catch(a){return (window.console={});}}());


var bigscreen;
var maxwide= 1120;

function updateHeightOfaside() {
  if(bigscreen){
    // console.log("screen: " + $(window).innerHeight() + "  content: " +   $("#content").height());

    if($(window).innerHeight() > $("#content").height()) {
      $("aside").css("height",$(window).innerHeight());
    } else {
      $("aside").css("height",$("#content").height());
    }
  } else {
    $("aside").css("height","auto");
  }
}

function checkScreen() {
  if(window.innerWidth > maxwide) {
    bigscreen = true;
  } else {
    bigscreen = false;
  }

  updateHeightOfaside();
}

function toggleDetail() {
  $("details").removeClass("open");
  $("details").find("div").slideUp("fast");
  $(this).parent().addClass("open");
  $(this).next("div").slideDown("fast");
	_gaq.push(['_trackEvent', 'profiles', 'pageview',$(this).text() ]);
	
  checkScreen();
}

function cols(columns) {
  $('.col').columnize({
    columns: columns,
    buildOnce: false
  });
}

function cols(columns) {
  $('.col').columnize({
    columns: columns,
    buildOnce: false
  });
}

$(document).ready(function() {

  checkScreen();

  if (Modernizr.csscolumns) {
    /* properties for browsers that
       support audio */
  }else{
    if(bigscreen) {
      cols(2);
    }
  }

  // when user resizes the window
  $(window).resize(function() {
    checkScreen();
  });

  $("details summary").click(toggleDetail);
  $("details summary").keypress(toggleDetail);

  //nav scrolling
  $.localScroll({easing: 'easeInOutExpo', offset:0, hash: true, lazy: true, queue: false});

	// mobile: bind form to page navigation
	$('#mobile_navigation_select').bind('change select submit blur', function(evt){
		if($(this).val() !== ""){
			window.location = $(this).val();
		}
	});

  // personal code post
  $('#personal-code form').submit(function() {
    var ref = $(this);
    $('#personal-code #loader').show();
    $('#personal-code form').hide();
    $('#personal-code #error').hide();
    $('#personal-code input[type=submit]').attr('disabled', 'disabled').addClass('disabled');
    $.post(
      ref.attr("action"),
      ref.serialize(),
      function(data) {
        $('#personal-code form').show();
        $('#personal-code #loader').hide();
        $('#personal-code input[type=submit]').removeAttr('disabled').removeClass('disabled');
        if(data === "") {
          // no error
          $('#personal-code .form-collapse').hide();
          $('#personal-code #thanks').show();
					_gaq.push(['_trackEvent', 'form', 'submit', 'submit succeed']);
        } else {
          // error
          $('#personal-code #error').html(data);
          $('#personal-code #error').css('display', 'inline-block');
					_gaq.push(['_trackEvent', 'form', 'submit', 'submit error']);
        }
      });

    return false;
  });
});

