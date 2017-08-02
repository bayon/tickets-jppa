<script> 
 // PARAMETERS ///////////////////////////////////////////////////////////////////////////////////////////
 var controller = 'snapshot_controller';
 var TABLE_DATA = []; 
 var itemsPerPage = null;
 </script> 
 <!--  THE MODAL -->
 <div style='margin-top:5%;' class='modal fade' id='modal-container-snapshot' role='dialog' aria-labelledby='myModalLabel' aria-hidden='false'>
 	<div class='modal-dialog'>
 		<div class='modal-content'>
 			<div class='modal-header'>
 			<!--	<button type='button' class='close' data-dismiss='modal' aria-hidden='false'>
 					×
 				</button>
 -->				<h4 class='modal-title' id='myModalLabel'> Edit   </h4>
 			</div>
 			<div class='modal-body'>
 				...
 			</div>
 			<div class='modal-footer'>
 				<button type='button' class='btn btn-default' data-dismiss='modal'>
 					Close
 				</button>
 			</div>
 		</div>
 	</div>
 </div>
 <!--  THE PAGE -->
 <div id='template_view_1' class='container animated fadeIn kioview' style='text-align:center;'  >
 	<div class='xxxpagination_page' >
 		<div class='row top-row'>
 			<div class='col-md-12'>
 				<h3>snapshot</h3>
  <button class='create_btn' >+</button> 
				<!-- hidden anchor that calls the modal -->
 				<a id='modal-snapshot' style='' href='#modal-container-snapshot' role='button' class='btn invisible' data-toggle='modal'>modal-1</a>
 				<!-- ======================================================  -->
 				<div class='row'>
 							<div id='tableBody1-pagination' class='tableLiteTBody-pagination'>
 								<input type='search' class='light-table-filter' data-table='order-table' placeholder='Filter'>
 								<a id='tableBody1-previous' href='#'>
 								<button class='table-lite-btn'>
 									&laquo; Previous
 								</button></a>
 								<a id='tableBody1-next' href='#'>
 								<button class='table-lite-btn'>
 									Next &raquo;
 								</button></a>
 
 								<select id='itemsPerPage' onchange='changeItemsPerPage(this);'>
 									<option>10</option>
 									<option>25</option>
 									<option>50</option>
 									<option>100</option>
 									<option>500</option>
 									<option>1000</option>
 								</select>
 								<a href = '' >
 								<button class='table-lite-btn' >
 									refresh
 								</button></a>
 								<button onclick='tableLiteCheckedRows('table');'>
 									handle checked rows
 								</button>
 							</div>
 							</div>
 				<div class='row'>
 							<table id='table' class='sortable order-table table layout display responsive-table'>
 								<thead>
 									<tr id='table_headers'>
 <th></th><th>id</th>
<th>name</th>
<th>description</th>
<th>created_dt</th>
									</tr>
 								</thead>
 								<tbody id='tableBody1' class='tableLiteTBody'>
 									<!-- json data inserted here -->
 								</tbody>
 							</table>
 						</div>
 			</div>
 		</div>
 	</div>
 
 	<!-- BACKGROUND IMAGES -->
 	<div id='BG_IMG'>
 		&nbsp;
 		<!-- <img src='img/sky.jpg'> -->
 	</div>
 	<div id='BG_IMG_LEFT'>
 		&nbsp;
 	</div>
 	<div id='BG_IMG_RIGHT'>
 		&nbsp;
 	</div>
 	<div id='BG_IMG_TOP'>
 		&nbsp;
 	</div>
 	<!-- end of BACKGROUND IMAGES -->
 <script>
  function read_ModelKV_callback(data){ 
  	var obj = JSON.parse(data); 
  	console.log(obj); 
  } 
    function getChildren(){    	read_ModelKV('model','key','value');    }    function read_ModelKV(model,k,v){     	var dataString = 'c='+model+'_controller&m=read_ModelKV&data_only=true&model='+model+'&k='+k+'&v='+v+'';     	ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, read_ModelKV_callback);     } function changeItemsPerPage(obj) {
 	itemsPerPage = obj.value;
 	load_data();
 }
 function tableLiteCheckedRows_callback(array_of_ids) {
 	console.log('table-lite: Loop through these ids and handle them as you will...');
 }
 $(document).ready(function() {
 	itemsPerPage = 10;
 	load_data();
 });	 
 function load_data_callback(data){
 	console.log('load data callback fn:');
 	var obj = JSON.parse(data);
 	TABLE_DATA = obj;
 	var rows = [];
 		$.each(obj, function(i, row) {
 			if ( typeof row == 'object') {
 				var html = '';
 				html += "<tr id=''+row.id+'' onclick='rowClick("+i+");' class='data_row' >";
 				html += "<td><input type='checkbox'  ><input type='hidden' name='id' value='' + row.id + ''></td>";
 html += '<td>' + row.id + '</td>';
 html += '<td>' + row.name + '</td>';
 html += '<td>' + row.description + '</td>';
 html += '<td>' + row.created_dt + '</td>';
 				html += '</tr>';
 				rows.push(html);
 			}
 		});
 		$('#tableBody1').append(rows.join(''));
 		$('#tableBody1').paginate({
 			itemsPerPage : itemsPerPage
 		});
 	
 };
 function load_data(){
 	var dataString = "c=snapshot_controller&m=readToJSON&data_only=true";
 	ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, load_data_callback);
 }
 </script>
 <script>
 	( function() {
 			$('#BG_IMG').addClass('gradient6');//be sure to remove unwanted classes before applying a new one.
 		}()); 
 </script>
 	<!-- /////////////////////////////////////////////////////////  -->
      <!-- paginator_details_content CAN NOT be an 'id' some kind of duplication occurs. -->
       <!-- <div class='paginator_details_content'></div>  -->
 
 
 <script>
 //  POPULATE DETAILS PANEL  /////////////////////////////////////////////////////////////////////////////////
  function rowClick(i) {
 	var table_header =  'snapshot' ;
 	document.getElementById('modal-snapshot').click();
 	//$('.paginator_details_content').html(html);
 		var html = "<div class='row'><div class='col-md-12 ui_wrapper'><div id='row_" + TABLE_DATA[i]['id'] + "' >";
 		html += "<div class='row'><h2>" + table_header + "</h2></div>";
 
	 html += "<div class='row'><div class='col-md-6 text-right' >id:</div><div class='col-md-6 text-left'><input type='text' id='id'  name='id' class='info' value='"+TABLE_DATA[i]['id']+"' /> </div></div>" 
	 html += "<div class='row'><div class='col-md-6 text-right' >name:</div><div class='col-md-6 text-left'><input type='text' id='name'  name='name' class='info' value='"+TABLE_DATA[i]['name']+"' /> </div></div>" 
	 html += "<div class='row'><div class='col-md-6 text-right' >description:</div><div class='col-md-6 text-left'><input type='text' id='description'  name='description' class='info' value='"+TABLE_DATA[i]['description']+"' /> </div></div>" 
	 html += "<div class='row'><div class='col-md-6 text-right' >created_dt:</div><div class='col-md-6 text-left'><input type='text' id='created_dt'  name='created_dt' class='info' value='"+TABLE_DATA[i]['created_dt']+"' /> </div></div>" 
		html +="<div class='row'>";
 
		html += " <input type='hidden' id='app_id'  name='app_id' class='info' value='" + TABLE_DATA[i]['app_id'] + "'    /> ";
 	   	html += "<div class='col-md-3' ><a onclick='save_edit( "  +TABLE_DATA[i]['id']+");' class='panel_anchor'>save</a></div>";
 	   	html += "<div class='col-md-3' ><a onclick='cancel_edit( "+TABLE_DATA[i]['id']+");' class='panel_anchor'>cancel</a></div>";
 	    html += "<div class='col-md-3' ><a onclick='delete_user( "+TABLE_DATA[i]['id']+");' class='panel_anchor'>delete</a></div>";
 		html +="</div>";
 		html +="</div></div></div>";
 		$('.modal-body').html(html);
 	/*$('.paginator_details_content').html(html);
 	panel_slide_in();
 	$('.paginator_details_content').click(function() {
 		 // ADD A CONDITION TO CLICK EVENT
 		 // SO THAT DATA INPUTS CAN BE ACCESSED.
 		   if( ! $( event.target).is('input') ) {
 	           panel_slide_out();
 	      }
 	});*/
 
 }
 
  
 $('.create_btn').click(function() { 
	//var i = this.id; 
	var table_header =  'snapshot' ; 
	document.getElementById('modal-snapshot').click();
 	$('.paginator_create_content').html(html); 
 		var html = "<div class='row'><div class='col-md-12 ui_wrapper'><div id='row_create' >";
 		html += "<div class='row'><h2>" + table_header + "</h2></div>"; 
		html += "<div class='row'><h3>create:</h3></div>";
 		 
	 html += "<div class='row'><div class='col-md-6 text-right' >id:</div><div class='col-md-6 text-left'><input type='text' id='id'  name='id' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >name:</div><div class='col-md-6 text-left'><input type='text' id='name'  name='name' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >description:</div><div class='col-md-6 text-left'><input type='text' id='description'  name='description' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >created_dt:</div><div class='col-md-6 text-left'><input type='text' id='created_dt'  name='created_dt' class='info' value='' /></div></div>" 
		html +="<div class='row'>"; 

		html += " <input type='hidden' id='app_id'  name='app_id' class='info' value=''    /> "; 
	   	html += "<div class='col-md-3' ><a onclick='save_create();' class='panel_anchor'>save</a></div>";
 	   	html += "<div class='col-md-3' ><a onclick='cancel_create();' class='panel_anchor'>cancel</a></div>";
 		html +="</div></div>"; 
		html +="</div>"; 
		$('.modal-body').html(html);
 	//panel_slide_in(); 
	panel_slide_in_right(); 
	$('.paginator_create_content').click(function() { 
		 // ADD A CONDITION TO CLICK EVENT 
		 // SO THAT DATA INPUTS CAN BE ACCESSED.
 		   if( ! $( event.target).is('input') ) { 
	           panel_slide_out_right();
 	      }
 	});
 
 }); 
//  DATA CREATE   /////////////////////////////////////////////////////////////////////////////////         
 function save_create(id) {
 	var data = {};
 	data.id = id;
 	$.each($('#row_create .info'), function(i, e) {
 			//alert(i + '||' + e.name + '||' + e.value);
 			switch(e.name) {
 
	case 'id':
	data.id = e.value;
	break;
	case 'name':
	data.name = e.value;
	break;
	case 'description':
	data.description = e.value;
	break;
	case 'created_dt':
	data.created_dt = e.value;
	break;				default:
 				//default code block
 				break;
 			}
 	});
 	var params = $.param(data);
 	var dataString = 'c=snapshot_controller&m=create&'+params;
 	
 	//alert(dataString +' || '+  url);
 	ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, create_callback);
 }
 function create_callback(data){
 	//alert(data);
 	 $(location).attr('href',JS_CONFIG.BASE_URL+'?c=snapshot_controller&m=read');
 }
 //  DATA EDITING   /////////////////////////////////////////////////////////////////////////////////         
 function save_edit(id) {
 	var data = {};
 	data.id = id;
 	$.each($('#row_' + id + ' .info'), function(i, e) {
 			//alert(i + '||' + e.name + '||' + e.value);
 			switch(e.name) {
 
	case 'id':
	data.id = e.value;
	break;
	case 'name':
	data.name = e.value;
	break;
	case 'description':
	data.description = e.value;
	break;
	case 'created_dt':
	data.created_dt = e.value;
	break;				default:
 				//default code block
 				break;
 			}
 	});
 	var params = $.param(data);
 	var dataString = 'c=snapshot_controller&m=edit&'+params;
 	
 	//alert(dataString +' || '+  url);
 	ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, edit_callback);
 }
 function edit_callback(data){
 	//alert(data);
 	 $(location).attr('href',JS_CONFIG.BASE_URL+'?c=snapshot_controller&m=read');
 }
 function deny() {
 }
 function cancel_edit(id){
 		  $(location).attr('href',JS_CONFIG.BASE_URL+'?c=snapshot_controller&m=read');
 }
 function delete_user(id){
 		if(confirm('Are you sure you want to delete this user?'))
 		{ verify_delete(id); } else {  deny(); }
 }
 function verify_delete(id) {
 	var data = {};
 	data.id = id;
 	var dataString = 'c=snapshot_controller&m=delete&id=' + data.id  ;
 	 
 	//alert(BASE_URL+'---'+dataString);
 	ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, delete_callback);
 }
 function delete_callback(data){
 	 $(location).attr('href',JS_CONFIG.BASE_URL+'?c=snapshot_controller&m=read');
 }
 	 
 </script>
 
  
 <script>  
 	/* SELECTION CHOICE:  
  	 *  html += '<select id='bigdog'  name='bigdog' class='info'>';  
  	 for(var i = 0; i <= o_bigdogs.length; i++){  
  	 	if(typeof o_bigdogs[i] != 'undefined'){  
  	 		html += '<option value=''+o_bigdogs[i]['id']+''';   
 	 		if (o_bigdogs[i]['id'] == row.parent_id){   
 	 			html += ' selected '   
 	 		}   
 	 		html +=' >'+o_bigdogs[i]['name']+'</option>'  
  	 	}		  
  	 }   
 	 html += '</select>';   
 	 */   
 	/* BUTTON CHOICE:  
  	 *    html += '<div class='btn-group'>';  
  	 for(var i = 0; i <= o_bigdogs.length; i++){  
  	 	if(typeof o_bigdogs[i] != 'undefined'){   
 	 		html += '<button id=''+i+'_'+o_bigdogs[i]['id']+''  name=''+o_bigdogs[i]['id']+'' class=' info btn btn-default ';   
 	 		if (o_bigdogs[i]['id'] == row.parent_id){   
 	 			html += ' active ';  
  	 		}   
 	 		html += '' type='button'> ';  
  	 		html += '<em class='glyphicon glyphicon-user'></em>'+o_bigdogs[i]['name']+'';   
  	 		html += '</button>  ';   
  	 	}		  
  	 }  
  	 html += '</div>';   
 	 */  
  	/*   
 	 *  BUTTON DROPDOWN MENU   
  html += '<div class='btn-group'>';  
  html += '				<button class='btn btn-default'>  ';   
  html += '					Action  ';   
  html += '				</button>   ';    
 html += '				<button data-toggle='dropdown' class='btn btn-default dropdown-toggle'>  ';   
  html += '					<span class='caret'></span>  ';   
  html += '				</button>  ';   
  html += '				<ul class='dropdown-menu'>  ';   
  	 for(var i = 0; i <= o_bigdogs.length; i++){  
  	 	if(typeof o_bigdogs[i] != 'undefined'){  
  	 		html += '<li id=''+i+'_'+o_bigdogs[i]['id']+''  name=''+o_bigdogs[i]['id']+'' class='info' ';   
 	 		html += '						<a href='#'  id=''+i+'_'+o_bigdogs[i]['id']+''  name=''+o_bigdogs[i]['id']+'' class='info'  >'+o_bigdogs[i]['name']+'</a>  ';   
   	 		html += '</li>  ';   
  	 	}		  
  	 }  
  html += '</ul>  ';   
  html += '</div>';  
      
  	 */  
  </script> 
  