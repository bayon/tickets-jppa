var i = 0;
var y_response = 10;
//PLAYER URL:
//location.href
//var W_BASE_URL="http://localhost:8888/00_CommunityWall/Editor/db_monitor/";
 
// localhost
//var W_BASE_URL=final_path;// "http://localhost:8888/00_CommunityWall/Editor/db_monitor/";
var W_BASE_URL="https://shout.gocodigo.net/communitywall/db_monitor/";
//does not recognize dbMonitor variables.
function timedCount() {
	try{
		 i = i + 1;
	    y_response = checking();
	    postMessage(y_response);

	} catch(e){
		 postMessage(e);
	}

    setTimeout("timedCount()",1000);
}

timedCount();



function checking(){
	try {
	    var xhr = new XMLHttpRequest();
	    xhr.open('GET', W_BASE_URL+"check_db_server.php", false);
	    xhr.send();
	    y_response = xhr.responseText;
	   	return y_response;
	  } catch (e) {
	    //postMessage(e);
	    return e;
	  }
}
