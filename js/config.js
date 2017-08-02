if ( typeof JS_CONFIG == "undefined") {
	var JS_CONFIG = {};
}
JS_CONFIG.DEV = 1;
// FBF
//JS_CONFIG.ROOT_DIR = "/00_CommunityWall/";
// SHOUT
//JS_CONFIG.ROOT_DIR = "/communitywall/";//"communitywall/";
//LOCAL
//
JS_CONFIG.ROOT_DIR = "/tickets-jppa/";

JS_CONFIG.PATH_ARRAY = window.location.pathname.split('/');
JS_CONFIG.BASE_URL = window.location.origin + "/" + JS_CONFIG.PATH_ARRAY[1] + JS_CONFIG.ROOT_DIR;
JS_CONFIG.HOST = window.location.host + "/" + JS_CONFIG.PATH_ARRAY[1];
JS_CONFIG.BRAND_NAME = "tickets";

JS_CONFIG.load_js = (function(script_urls) {
	//write_scripts_array_to_head
	for (var i = 0; i < script_urls.length; i++) {
		var uri_enc = encodeURIComponent(script_urls[i]);
		var script_tag_head = "%3Cscript%20src%3D%27";
		var script_tag_foot = "%27%3E%3C%2Fscript%3E";
		document.write(unescape(script_tag_head + uri_enc + script_tag_foot));
	}
});
JS_CONFIG.load_css = (function(css_urls) {
	//write_css_array_to_head
	//%3Clink%20rel%3D%27stylesheet%27%20type%3D%27text%2Fcss%27%20href%3D%27style_sheet_name.css%27%3E
	for (var i = 0; i < css_urls.length; i++) {
		var uri_enc = encodeURIComponent(css_urls[i]);
		var css_tag_head = "%3Clink%20rel%3D%27stylesheet%27%20type%3D%27text%2Fcss%27%20href%3D%27";
		var css_tag_foot = "%27%3E";
		document.write(unescape(css_tag_head + uri_enc + css_tag_foot));
	}
});
JS_CONFIG.getQueryValueByKey = (function(key){
	 key = key.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
     var regex = new RegExp("[\\?&]" + key + "=([^&#]*)"),
          results = regex.exec(location.search);
     return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
});

/*
function getParameterByName(name) {
     name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
     var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
          results = regex.exec(location.search);
     return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}*/
 function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 }
