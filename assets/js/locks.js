function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };

jQuery(document).ready(function(){
	if(window.location.pathname.indexOf('trytest') !== -1)
		jQuery(document).on("keydown", disableF5);
});

if(1 && (window.location.href.indexOf('Admin_') === -1) && (window.location.host.indexOf('tiengviettieuhoc') === -1)) jQuery(document).bind("contextmenu", function(e) {
	e.preventDefault();
});

// We also check for a text selection if ctrl/command are pressed along
// w/certain keys
if(1 && (window.location.href.indexOf('Admin_') === -1) && (window.location.host.indexOf('tiengviettieuhoc') === -1)) jQuery(document).keydown(function(ev) {
	// capture the event for a variety of browsers
	ev = ev || window.event;
	// catpure the keyCode for a variety of browsers
	kc = ev.keyCode || ev.which;
	// check to see that either ctrl or command are being pressed along w/any
	// other keys
	if ((ev.ctrlKey || ev.metaKey) && kc) {
		// these are the naughty keys in question. 'x', 'c', and 'c'
		// (some browsers return a key code, some return an ASCII value)
		if (kc == 99 || kc == 67 || kc == 88) {
			return false;
		}
	}
});

jQuery(document).bind('keydown', function(e) {
  if(e.ctrlKey && (e.which == 83)) {
    e.preventDefault();
    return false;
  }
});