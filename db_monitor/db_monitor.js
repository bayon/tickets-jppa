if(typeof dbMonitor == "undefined"){
	var dbMonitor = {};
  //	dbMonitor.BASE_URL="http://localhost:8888/00_CommunityWall/Editor/db_monitor/";
	//	dbMonitor.BASE_URL="http://localhost:8888/00_CommunityWall/Editor/db_monitor/";
		var pathname = location.pathname;
		var segments = pathname.split('index.html');
		var current_path = segments[0];
		var final_path = location.protocol +"//"+ location.host +current_path+"db_monitor/";
			dbMonitor.BASE_URL = final_path;
	 dbMonitor.lastJSONData = "";
	 dbMonitor.currentJSONData = "";
	 dbMonitor.change=0;


}
dbMonitor.init = (function() {
		console.log('db_monitor.init() .............................');
 		if (typeof(w) == "undefined") {
		    w = new Worker(dbMonitor.BASE_URL+"worker-1.0.js");
		}
		w.onmessage = function(event){
		 	//console.log('event.data from:'+dbMonitor.BASE_URL+"worker-1.0.js");
			//console.log(event.data);
			var obj = JSON.parse(event.data);
			console.log('event');
			console.log(event);
			console.log('event.data');
			console.log(event.data);
			dbMonitor.currentJSONData = obj;
			 if(dbMonitor.compare(dbMonitor.currentJSONData , dbMonitor.lastJSONData)){
			 	//console.log('TRUE THE SAME');

				//return 0;
			 }else{
			 	console.log('- - - - - - -    FALSE something changed - - - - - - - ');
			 	console.log(dbMonitor.currentJSONData);
			 	//load_data();
					//poop();
				reload_data();
				//return 1;
			 }
			dbMonitor.lastJSONData = dbMonitor.currentJSONData ;
		};
});
// compare 2 json object strings
dbMonitor.compare = function(a, b) {
  return JSON.stringify(a) === JSON.stringify(b);
};
