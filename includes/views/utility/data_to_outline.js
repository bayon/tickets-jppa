 function exportToOutline(){
	console.log(TABLE_DATA);
	document.getElementById('modal-todo').click();
    var html = "<div class='ui_wrapper'> ";
        html += '<h2>Weekly Report</h2>';
        var date = new Date();
        console.log(date);
       html += '<p>'+date+'</p>';
         html += '<div class="outline_wrapper">  ';
        
        for(var i in TABLE_DATA){
        	html += "<ul>";
        	html += "<li>Name:"+TABLE_DATA[i]['name']+"</li>";
        		html += "<ul>";
        		html += "<li>Description:"+ TABLE_DATA[i]['description']+"</li>";
        		html += "<li>Notes:"+ TABLE_DATA[i]['notes']+"</li>";
        		html += "<li>Status:"+ TABLE_DATA[i]['completed']+"</li>";
        		html += "</ul>";
        	html += "</ul>";
        }
    html += "</div>"; 

    html += "</div>";
    $('.modal-body').html(html);
}