<?php 
require_once("view_paths.php");
fwrite($fp, "<script> \n ");
fputs($fp, "// PARAMETERS ///////////////////////////////////////////////////////////////////////////////////////////\n ");
fputs($fp, "var controller = '".strtolower($objectName)."_controller';\n ");
fputs($fp, "var TABLE_DATA = []; \n ");
fputs($fp, "var itemsPerPage = null;\n ");
fputs($fp, "</script> \n ");
fputs($fp, "<!--  THE MODAL -->\n ");
fputs($fp, "<div style='margin-top:5%;' class='modal fade' id='modal-container-".strtolower($objectName)."' role='dialog' aria-labelledby='myModalLabel' aria-hidden='false'>\n ");
fputs($fp, "	<div class='modal-dialog'>\n ");
fputs($fp, "		<div class='modal-content'>\n ");
fputs($fp, "			<div class='modal-header'>\n ");
fputs($fp, "				<button type='button' class='close' data-dismiss='modal' aria-hidden='false'>\n ");
fputs($fp, "					×\n ");
fputs($fp, "				</button>\n ");
fputs($fp, "				<h4 class='modal-title' id='myModalLabel'> Edit User </h4>\n ");
fputs($fp, "			</div>\n ");
fputs($fp, "			<div class='modal-body'>\n ");
fputs($fp, "				...\n ");
fputs($fp, "			</div>\n ");
fputs($fp, "			<div class='modal-footer'>\n ");
fputs($fp, "				<button type='button' class='btn btn-default' data-dismiss='modal'>\n ");
fputs($fp, "					Close\n ");
fputs($fp, "				</button>\n ");
fputs($fp, "			</div>\n ");
fputs($fp, "		</div>\n ");
fputs($fp, "	</div>\n ");
fputs($fp, "</div>\n ");
fputs($fp, "<!--  THE PAGE -->\n ");
fputs($fp, "<div id='template_view_1' class='container animated fadeIn kioview' style='text-align:center;'  >\n ");
fputs($fp, "	<div class='xxxpagination_page' >\n ");
fputs($fp, "		<div class='row top-row'>\n ");
fputs($fp, "			<div class='col-md-12'>\n ");
// <h2 style='  '>ZONK</h2><button class='create_btn' >+</button>

fputs($fp, "				<h3>".strtolower($objectName)."</h3>\n ");
fputs($fp, " <button class='create_btn' >+</button> \n");
fputs($fp, "				<!-- hidden anchor that calls the modal -->\n ");
fputs($fp, "				<a id='modal-".strtolower($objectName)."' style='' href='#modal-container-".strtolower($objectName)."' role='button' class='btn invisible' data-toggle='modal'>modal-1</a>\n ");
fputs($fp, "				<!-- ======================================================  -->\n ");
fputs($fp, "				<div class='row'>\n ");
 
fputs($fp, "							<div id='tableBody1-pagination' class='tableLiteTBody-pagination'>\n ");
fputs($fp, "								<input type='search' class='light-table-filter' data-table='order-table' placeholder='Filter'>\n ");
fputs($fp, "								<a id='tableBody1-previous' href='#'>\n ");
fputs($fp, "								<button class='table-lite-btn'>\n ");
fputs($fp, "									&laquo; Previous\n ");
fputs($fp, "								</button></a>\n ");
fputs($fp, "								<a id='tableBody1-next' href='#'>\n ");
fputs($fp, "								<button class='table-lite-btn'>\n ");
fputs($fp, "									Next &raquo;\n ");
fputs($fp, "								</button></a>\n ");
fputs($fp, "\n ");
fputs($fp, "								<select id='itemsPerPage' onchange='changeItemsPerPage(this);'>\n ");
fputs($fp, "									<option>10</option>\n ");
fputs($fp, "									<option>25</option>\n ");
fputs($fp, "									<option>50</option>\n ");
fputs($fp, "									<option>100</option>\n ");
fputs($fp, "									<option>500</option>\n ");
fputs($fp, "									<option>1000</option>\n ");
fputs($fp, "								</select>\n ");
fputs($fp, "								<a href = '' >\n ");
fputs($fp, "								<button class='table-lite-btn' >\n ");
fputs($fp, "									refresh\n ");
fputs($fp, "								</button></a>\n ");
fputs($fp, "								<button onclick='tableLiteCheckedRows('table');'>\n ");
fputs($fp, "									handle checked rows\n ");
fputs($fp, "								</button>\n ");
fputs($fp, "							</div>\n ");
fputs($fp, "							</div>\n ");//end of row


fputs($fp, "				<div class='row'>\n ");
fputs($fp, "							<table id='table' class='sortable order-table table layout display responsive-table'>\n ");
fputs($fp, "								<thead>\n ");
fputs($fp, "									<tr id='table_headers'>\n ");
fputs($fp,"<th></th>");// for the rows checkbox
 $max = count($arrayOfProperties);
			for ($x = 0; $x < $max; $x++) {
				fputs($fp,"<th>".$arrayOfProperties[$x]."</th>\n");
			}

/*			
fputs($fp, "										<th></th>\n ");
fputs($fp, "										<th>ID</th>\n ");
fputs($fp, "										<th>username</th>\n ");
fputs($fp, "										<th>password</th>\n ");
*/

fputs($fp, "									</tr>\n ");
fputs($fp, "								</thead>\n ");
fputs($fp, "								<tbody id='tableBody1' class='tableLiteTBody'>\n ");
fputs($fp, "									<!-- json data inserted here -->\n ");
fputs($fp, "								</tbody>\n ");
fputs($fp, "							</table>\n ");
fputs($fp, "						</div>\n ");


fputs($fp, "			</div>\n ");
fputs($fp, "		</div>\n ");
fputs($fp, "	</div>\n ");
fputs($fp, "\n ");
fputs($fp, "	<!-- BACKGROUND IMAGES -->\n ");
fputs($fp, "	<div id='BG_IMG'>\n ");
fputs($fp, "		&nbsp;\n ");
fputs($fp, "		<!-- <img src='img/sky.jpg'> -->\n ");
fputs($fp, "	</div>\n ");
fputs($fp, "	<div id='BG_IMG_LEFT'>\n ");
fputs($fp, "		&nbsp;\n ");
fputs($fp, "	</div>\n ");
fputs($fp, "	<div id='BG_IMG_RIGHT'>\n ");
fputs($fp, "		&nbsp;\n ");
fputs($fp, "	</div>\n ");
fputs($fp, "	<div id='BG_IMG_TOP'>\n ");
fputs($fp, "		&nbsp;\n ");
fputs($fp, "	</div>\n ");
fputs($fp, "	<!-- end of BACKGROUND IMAGES -->\n ");
 
fputs($fp, "<script>\n ");


fputs($fp, " function read_ModelKV_callback(data){ \n "); 
fputs($fp, " 	var obj = JSON.parse(data); \n "); 
fputs($fp, " 	console.log(obj); \n "); 
fputs($fp, " } \n "); 
 


fputs($fp,"   function getChildren(){ "); 
fputs($fp,"   	read_ModelKV('model','key','value'); "); 
fputs($fp,"   } "); 
fputs($fp,"   function read_ModelKV(model,k,v){  "); 
fputs($fp,"   	var dataString = 'c='+model+'_controller&m=read_ModelKV&data_only=true&model='+model+'&k='+k+'&v='+v+'';  "); 
fputs($fp,"   	ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, read_ModelKV_callback);  "); 
fputs($fp,"   } ");

 
fputs($fp, "function changeItemsPerPage(obj) {\n ");
fputs($fp, "	itemsPerPage = obj.value;\n ");
fputs($fp, "	load_data();\n ");
fputs($fp, "}\n ");
fputs($fp, "function tableLiteCheckedRows_callback(array_of_ids) {\n ");
fputs($fp, "	console.log('table-lite: Loop through these ids and handle them as you will...');\n ");
fputs($fp, "}\n ");
fputs($fp, "$(document).ready(function() {\n ");
fputs($fp, "	itemsPerPage = 10;\n ");
fputs($fp, "	load_data();\n ");
fputs($fp, "});	 \n ");
fputs($fp, "function load_data_callback(data){\n ");
fputs($fp, "	console.log('load data callback fn:');\n ");
fputs($fp, "	var obj = JSON.parse(data);\n ");
fputs($fp, "	TABLE_DATA = obj;\n ");
fputs($fp, "	var rows = [];\n ");
fputs($fp, "		$.each(obj, function(i, row) {\n ");
fputs($fp, "			if ( typeof row == 'object') {\n ");
fputs($fp, "				var html = '';\n ");
fputs($fp, "				html += \"<tr id=''+row.id+'' onclick='rowClick(\"+i+\");' class='data_row' >\";\n ");
fputs($fp, "				html += \"<td><input type='checkbox'  ><input type='hidden' name='id' value='' + row.id + ''></td>\";\n ");
   $max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		fputs($fp,"html += '<td>' + row.".$arrayOfProperties[$x]." + '</td>';\n ");
	}
 

//fputs($fp, "				html += '<td>' + row.id + '</td>';\n ");
//fputs($fp, "				html += '<td>' + row.username + '</td>';\n ");
//fputs($fp, "				html += '<td>' + row.password + '</td>';\n ");


fputs($fp, "				html += '</tr>';\n ");
fputs($fp, "				rows.push(html);\n ");
fputs($fp, "			}\n ");
fputs($fp, "		});\n ");
fputs($fp, "		$('#tableBody1').append(rows.join(''));\n ");
fputs($fp, "		$('#tableBody1').paginate({\n ");
fputs($fp, "			itemsPerPage : itemsPerPage\n ");
fputs($fp, "		});\n ");
fputs($fp, "	\n ");
fputs($fp, "};\n ");
fputs($fp, "function load_data(){\n ");
fputs($fp, "	var dataString = \"c=".strtolower($objectName)."_controller&m=readToJSON&data_only=true\";\n ");
fputs($fp, "	ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, load_data_callback);\n ");
fputs($fp, "}\n ");
fputs($fp, "</script>\n ");
fputs($fp, "<script>\n ");
fputs($fp, "	( function() {\n ");
fputs($fp, "			$('#BG_IMG').addClass('gradient6');//be sure to remove unwanted classes before applying a new one.\n ");
fputs($fp, "		}()); \n ");
fputs($fp, "</script>\n ");
fputs($fp, "	<!-- /////////////////////////////////////////////////////////  -->\n ");
fputs($fp, "     <!-- paginator_details_content CAN NOT be an 'id' some kind of duplication occurs. -->\n ");
fputs($fp, "      <!-- <div class='paginator_details_content'></div>  -->\n ");
fputs($fp, "\n ");
fputs($fp, "\n ");
fputs($fp, "<script>\n ");

fputs($fp, "//  POPULATE DETAILS PANEL  /////////////////////////////////////////////////////////////////////////////////\n ");
fputs($fp, " function rowClick(i) {\n ");
fputs($fp, "	var table_header =  '".strtolower($objectName)."' ;\n ");
 fputs($fp, "	document.getElementById('modal-".strtolower($objectName)."').click();\n ");
fputs($fp, "	//$('.paginator_details_content').html(html);\n ");



fputs($fp, "		var html = \"<div class='ui_wrapper'><div id='row_\" + TABLE_DATA[i]['id'] + \"' >\";\n ");
fputs($fp, "		html += '<h2>' + table_header + '</h2>';\n ");

 	$max = count($arrayOfProperties);
		for ($x = 0; $x < $max; $x++) {
			//if property-suffix ends in '_id' then make a link to related table.
			$a_relation = explode("_",$arrayOfProperties[$x]);
			if($a_relation[1] == "id"){
				fputs($fp,"\n\t html += \"<p>".$arrayOfProperties[$x].":<input type='text' id='".$arrayOfProperties[$x]."'  name='".$arrayOfProperties[$x]."' class='info' value='\"+TABLE_DATA[i]['".$arrayOfProperties[$x]."']+\"' /> </p>\" ");
				
			}else{
				fputs($fp,"\n\t html += \"<p>".$arrayOfProperties[$x].":<input type='text' id='".$arrayOfProperties[$x]."'  name='".$arrayOfProperties[$x]."' class='info' value='\"+TABLE_DATA[i]['".$arrayOfProperties[$x]."']+\"' /> </p>\" ");
				
			}
 		}
 

fputs($fp, "\n		html += \" <input type='hidden' id='app_id'  name='app_id' class='info' value='\" + TABLE_DATA[i]['app_id'] + \"'    /> \";\n ");
fputs($fp, "	   	html += \"<a onclick='save_edit( \"  +TABLE_DATA[i]['id']+\");' class='panel_anchor'>save</a>\";\n ");
fputs($fp, "	   	html += \"<a onclick='cancel_edit( \"+TABLE_DATA[i]['id']+\");' class='panel_anchor'>cancel</a>\";\n ");
fputs($fp, "	    html += \"<a onclick='delete_user( \"+TABLE_DATA[i]['id']+\");' class='panel_anchor'>delete</a>\";\n ");
fputs($fp, "		html +=\"</div></div>\";\n ");



fputs($fp, "		$('.modal-body').html(html);\n ");
fputs($fp, "	/*$('.paginator_details_content').html(html);\n ");
fputs($fp, "	panel_slide_in();\n ");
fputs($fp, "	$('.paginator_details_content').click(function() {\n ");
fputs($fp, "		 // ADD A CONDITION TO CLICK EVENT\n ");
fputs($fp, "		 // SO THAT DATA INPUTS CAN BE ACCESSED.\n ");
fputs($fp, "		   if( ! $( event.target).is('input') ) {\n ");
fputs($fp, "	           panel_slide_out();\n ");
fputs($fp, "	      }\n ");
fputs($fp, "	});*/\n ");
fputs($fp, "\n ");
fputs($fp, "}\n ");
fputs($fp, "\n ");
fputs($fp, " \n ");


 
fputs($fp, "$('.create_btn').click(function() { \n");  
fputs($fp, "	//var i = this.id; \n");  
fputs($fp, "	var table_header =  '".strtolower($objectName)."' ; \n");  
 fputs($fp, "	document.getElementById('modal-".strtolower($objectName)."').click();\n ");
 
fputs($fp, "	$('.paginator_create_content').html(html); \n ");  
fputs($fp, "		var html = \"<div class='ui_wrapper'><div id='row_create' >\";\n ");  
fputs($fp, "		html += \"<h2>\" + table_header + \"</h2>\"; \n");  
fputs($fp, "		html += \"<h3>create:</h3>\";\n ");  
fputs($fp, "		 ");  
$max = count($arrayOfProperties);
		for ($x = 0; $x < $max; $x++) {
			fputs($fp,"\n\t html += \"<p>".$arrayOfProperties[$x].":<input type='text' id='".$arrayOfProperties[$x]."'  name='".$arrayOfProperties[$x]."' class='info' value='' /></p>\" \n");
		
		}
/*
fputs($fp, "	 html += '<p>id:<input type='text' id='id'  name='id' class='info' value='' /></p>'  ");  
fputs($fp, "	 html += '<p>name:<input type='text' id='name'  name='name' class='info' value='' /></p>'  ");  
fputs($fp, "	 html += '<p>thing1:<input type='text' id='thing1'  name='thing1' class='info' value='' /></p>'  ");  
fputs($fp, "	 html += '<p>thing2:<input type='text' id='thing2'  name='thing2' class='info' value='' /></p>'  "); 
 */
fputs($fp, "\n		html += \" <input type='hidden' id='app_id'  name='app_id' class='info' value=''    /> \"; \n");  
fputs($fp, "	   	html += \"<a onclick='save_create();' class='panel_anchor'>save</a>\";\n ");  
fputs($fp, "	   	html += \"<a onclick='cancel_create();' class='panel_anchor'>cancel</a>\";\n ");  
fputs($fp, "		html +=\"</div></div>\"; \n");  

fputs($fp, "		$('.modal-body').html(html);\n ");
//fputs($fp, "	$('.paginator_create_content').html(html); \n");  

fputs($fp, "	//panel_slide_in(); \n");  
fputs($fp, "	panel_slide_in_right(); \n");  
fputs($fp, "	$('.paginator_create_content').click(function() { \n");  
fputs($fp, "		 // ADD A CONDITION TO CLICK EVENT \n");  
fputs($fp, "		 // SO THAT DATA INPUTS CAN BE ACCESSED.\n ");  
fputs($fp, "		   if( ! $( event.target).is('input') ) { \n");  
fputs($fp, "	           panel_slide_out_right();\n ");  
fputs($fp, "	      }\n ");  
fputs($fp, "	});\n ");  
fputs($fp, "\n ");  
fputs($fp, "}); \n");  
 
fputs($fp, "//  DATA CREATE   /////////////////////////////////////////////////////////////////////////////////         \n ");
fputs($fp, "function save_create(id) {\n ");
fputs($fp, "	var data = {};\n ");
fputs($fp, "	data.id = id;\n ");
fputs($fp, "	$.each($('#row_create .info'), function(i, e) {\n ");
fputs($fp, "			//alert(i + '||' + e.name + '||' + e.value);\n ");
fputs($fp, "			switch(e.name) {\n ");
$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		fputs($fp,"\n\tcase '".strtolower($arrayOfProperties[$x])."':");
		fputs($fp,"\n\tdata.".strtolower($arrayOfProperties[$x])." = e.value;");
		fputs($fp,"\n\tbreak;");
	}
fputs($fp, "				default:\n ");
fputs($fp, "				//default code block\n ");
fputs($fp, "				break;\n ");
fputs($fp, "			}\n ");
fputs($fp, "	});\n ");
fputs($fp, "	var params = $.param(data);\n ");
fputs($fp, "	var dataString = 'c=".strtolower($objectName)."_controller&m=create&'+params;\n ");
fputs($fp, "	\n ");
fputs($fp, "	//alert(dataString +' || '+  url);\n ");
fputs($fp, "	ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, create_callback);\n ");
fputs($fp, "}\n ");

fputs($fp, "function create_callback(data){\n ");
fputs($fp, "	//alert(data);\n ");
fputs($fp, "	 $(location).attr('href',JS_CONFIG.BASE_URL+'?c=".strtolower($objectName)."_controller&m=read');\n ");
fputs($fp, "}\n ");



fputs($fp, "//  DATA EDITING   /////////////////////////////////////////////////////////////////////////////////         \n ");
fputs($fp, "function save_edit(id) {\n ");
fputs($fp, "	var data = {};\n ");
fputs($fp, "	data.id = id;\n ");
fputs($fp, "	$.each($('#row_' + id + ' .info'), function(i, e) {\n ");
fputs($fp, "			//alert(i + '||' + e.name + '||' + e.value);\n ");
fputs($fp, "			switch(e.name) {\n ");
$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		fputs($fp,"\n\tcase '".strtolower($arrayOfProperties[$x])."':");
		fputs($fp,"\n\tdata.".strtolower($arrayOfProperties[$x])." = e.value;");
		fputs($fp,"\n\tbreak;");
	}
fputs($fp, "				default:\n ");
fputs($fp, "				//default code block\n ");
fputs($fp, "				break;\n ");
fputs($fp, "			}\n ");
fputs($fp, "	});\n ");
fputs($fp, "	var params = $.param(data);\n ");
fputs($fp, "	var dataString = 'c=".strtolower($objectName)."_controller&m=edit&'+params;\n ");
fputs($fp, "	\n ");
fputs($fp, "	//alert(dataString +' || '+  url);\n ");
fputs($fp, "	ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, edit_callback);\n ");
fputs($fp, "}\n ");

fputs($fp, "function edit_callback(data){\n ");
fputs($fp, "	//alert(data);\n ");
fputs($fp, "	 $(location).attr('href',JS_CONFIG.BASE_URL+'?c=".strtolower($objectName)."_controller&m=read');\n ");
fputs($fp, "}\n ");





fputs($fp, "function deny() {\n ");
fputs($fp, "}\n ");
fputs($fp, "function cancel_edit(id){\n ");
fputs($fp, "		  $(location).attr('href',JS_CONFIG.BASE_URL+'?c=".strtolower($objectName)."_controller&m=read');\n ");
fputs($fp, "}\n ");
fputs($fp, "function delete_user(id){\n ");
fputs($fp, "		if(confirm('Are you sure you want to delete this user?'))\n ");
fputs($fp, "		{ verify_delete(id); } else {  deny(); }\n ");
fputs($fp, "}\n ");
fputs($fp, "function verify_delete(id) {\n ");
fputs($fp, "	var data = {};\n ");
fputs($fp, "	data.id = id;\n ");
fputs($fp, "	var dataString = 'c=".strtolower($objectName)."_controller&m=delete&id=' + data.id  ;\n ");
fputs($fp, "	 \n ");
fputs($fp, "	//alert(BASE_URL+'---'+dataString);\n ");
fputs($fp, "	ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, delete_callback);\n ");
fputs($fp, "}\n ");
fputs($fp, "function delete_callback(data){\n ");
fputs($fp, "	 $(location).attr('href',JS_CONFIG.BASE_URL+'?c=".strtolower($objectName)."_controller&m=read');\n ");
fputs($fp, "}\n ");
fputs($fp, "	 \n ");
fputs($fp, "</script>\n ");
fputs($fp, "\n ");
fputs($fp, " \n ");

 ////////////////////////////
 fputs($fp, "<script>  \n "); 
fputs($fp, "	/* SELECTION CHOICE:  \n  "); 
fputs($fp, "	 *  html += '<select id='bigdog'  name='bigdog' class='info'>';  \n  "); 
fputs($fp, "	 for(var i = 0; i <= o_bigdogs.length; i++){  \n  "); 
fputs($fp, "	 	if(typeof o_bigdogs[i] != 'undefined'){  \n  "); 
fputs($fp, "	 		html += '<option value=''+o_bigdogs[i]['id']+''';   \n "); 
fputs($fp, "	 		if (o_bigdogs[i]['id'] == row.parent_id){   \n "); 
fputs($fp, "	 			html += ' selected '   \n "); 
fputs($fp, "	 		}   \n "); 
fputs($fp, "	 		html +=' >'+o_bigdogs[i]['name']+'</option>'  \n  "); 
fputs($fp, "	 	}		  \n  "); 
fputs($fp, "	 }   \n "); 
fputs($fp, "	 html += '</select>';   \n "); 
fputs($fp, "	 */   \n "); 
fputs($fp, "	/* BUTTON CHOICE:  \n  "); 
fputs($fp, "	 *    html += '<div class='btn-group'>';  \n  "); 
fputs($fp, "	 for(var i = 0; i <= o_bigdogs.length; i++){  \n  "); 
fputs($fp, "	 	if(typeof o_bigdogs[i] != 'undefined'){   \n "); 
fputs($fp, "	 		html += '<button id=''+i+'_'+o_bigdogs[i]['id']+''  name=''+o_bigdogs[i]['id']+'' class=' info btn btn-default ';   \n "); 
fputs($fp, "	 		if (o_bigdogs[i]['id'] == row.parent_id){   \n "); 
fputs($fp, "	 			html += ' active ';  \n  "); 
fputs($fp, "	 		}   \n "); 
fputs($fp, "	 		html += '' type='button'> ';  \n  "); 
fputs($fp, "	 		html += '<em class='glyphicon glyphicon-user'></em>'+o_bigdogs[i]['name']+'';   \n  "); 
fputs($fp, "	 		html += '</button>  ';   \n  "); 
fputs($fp, "	 	}		  \n  "); 
fputs($fp, "	 }  \n  "); 
fputs($fp, "	 html += '</div>';   \n "); 
fputs($fp, "	 */  \n  "); 
fputs($fp, "	/*   \n "); 
fputs($fp, "	 *  BUTTON DROPDOWN MENU   \n  "); 
fputs($fp, "html += '<div class='btn-group'>';  \n  "); 
fputs($fp, "html += '				<button class='btn btn-default'>  ';   \n  "); 
fputs($fp, "html += '					Action  ';   \n  "); 
fputs($fp, "html += '				</button>   ';    \n "); 
fputs($fp, "html += '				<button data-toggle='dropdown' class='btn btn-default dropdown-toggle'>  ';   \n  "); 
fputs($fp, "html += '					<span class='caret'></span>  ';   \n  "); 
fputs($fp, "html += '				</button>  ';   \n  "); 
fputs($fp, "html += '				<ul class='dropdown-menu'>  ';   \n  "); 
fputs($fp, "	 for(var i = 0; i <= o_bigdogs.length; i++){  \n  "); 
fputs($fp, "	 	if(typeof o_bigdogs[i] != 'undefined'){  \n  "); 
fputs($fp, "	 		html += '<li id=''+i+'_'+o_bigdogs[i]['id']+''  name=''+o_bigdogs[i]['id']+'' class='info' ';   \n "); 
fputs($fp, "	 		html += '						<a href='#'  id=''+i+'_'+o_bigdogs[i]['id']+''  name=''+o_bigdogs[i]['id']+'' class='info'  >'+o_bigdogs[i]['name']+'</a>  ';   \n  "); 
fputs($fp, " 	 		html += '</li>  ';   \n  "); 
fputs($fp, "	 	}		  \n  "); 
fputs($fp, "	 }  \n  "); 
fputs($fp, "html += '</ul>  ';   \n  "); 
fputs($fp, "html += '</div>';  \n  "); 
fputs($fp, "    \n  "); 
fputs($fp, "	 */  \n  "); 
fputs($fp, "</script> \n  ");
 
 ///////////////////////////// 
 
 fclose($fp);
echo('<h3>TABLE-LITE VIEW</h3>');
showCode($view_list_final_filepath);
 ?>
			
			
			
			
			<script>
	/* SELECTION CHOICE:
	 *  html += "<select id='bigdog'  name='bigdog' class='info'>";
	 for(var i = 0; i <= o_bigdogs.length; i++){
	 	if(typeof o_bigdogs[i] != "undefined"){
	 		html += "<option value='"+o_bigdogs[i]['id']+"'";
	 		if (o_bigdogs[i]['id'] == row.parent_id){
	 			html += " selected "
	 		}
	 		html +=" >"+o_bigdogs[i]['name']+"</option>"
	 	}		
	 }
	 html += "</select>";
	 */
	/* BUTTON CHOICE:
	 *    html += "<div class='btn-group'>";
	 for(var i = 0; i <= o_bigdogs.length; i++){
	 	if(typeof o_bigdogs[i] != "undefined"){
	 		html += "<button id='"+i+"_"+o_bigdogs[i]['id']+"'  name='"+o_bigdogs[i]['id']+"' class=' info btn btn-default ";
	 		if (o_bigdogs[i]['id'] == row.parent_id){
	 			html += " active ";
	 		}
	 		html += "' type='button'> ";
	 		html += "<em class='glyphicon glyphicon-user'></em>"+o_bigdogs[i]['name']+""; 
	 		html += "</button>  "; 
	 	}		
	 }
	 html += "</div>";
	 */
	/*
	 *  BUTTON DROPDOWN MENU 
html += "<div class='btn-group'>";
html += "				<button class='btn btn-default'>  "; 
html += "					Action  "; 
html += "				</button>   "; 
html += "				<button data-toggle='dropdown' class='btn btn-default dropdown-toggle'>  "; 
html += "					<span class='caret'></span>  "; 
html += "				</button>  "; 
html += "				<ul class='dropdown-menu'>  "; 
	 for(var i = 0; i <= o_bigdogs.length; i++){
	 	if(typeof o_bigdogs[i] != "undefined"){
	 		html += "<li id='"+i+"_"+o_bigdogs[i]['id']+"'  name='"+o_bigdogs[i]['id']+"' class='info' ";
	 		html += "						<a href='#'  id='"+i+"_"+o_bigdogs[i]['id']+"'  name='"+o_bigdogs[i]['id']+"' class='info'  >"+o_bigdogs[i]['name']+"</a>  "; 
 	 		html += "</li>  "; 
	 	}		
	 }
html += "</ul>  "; 
html += "</div>";
  
	 */
</script> 