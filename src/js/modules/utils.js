function debounce(fn, delay) {
	var timer = null;
	return function () {
		var context = this, args = arguments;
		clearTimeout(timer);
		timer = setTimeout(function () {
			fn.apply(context, args);
		}, delay);
	};
}

function isMobile() {
	var mobileWidth = 480;
	return $(window).width() < mobileWidth;
}

function isTouch() {
	return 'ontouchstart' in document.documentElement;
}

function getUrlVars() {
	var vars = {}, hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for(var i=0; i<hashes.length;i++) {
		if(hashes[i].indexOf('http') < 0) {
			hash = hashes[i].split('=');
			vars[hash[0]] = hash[1];
		}
	}
	return vars;
}

module.exports = {
	debounce,
	isMobile,
	isTouch,
	getUrlVars
};
