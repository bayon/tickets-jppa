<script> 
 // PARAMETERS ///////////////////////////////////////////////////////////////////////////////////////////
 var controller = 'projects_controller';
 var TABLE_DATA = []; 
 var itemsPerPage = null;
 </script> 
 <style>
 ul{
 	 list-style-type: none;
 }

.project{
	color:blue;
	font-weight:bold;
}
.requirement{
	color:green;
}
.task{
	color:orange;
}
.btn-report{
	width:100%;
}
.btn-create{
	font-weight:bold;
	 color:darkgreen;
	 min-width:125px;
}
 </style>
 <!--  THE MODAL -->
 <div style='margin-top:5%;' class='modal fade' id='modal-container-projects' role='dialog' aria-labelledby='myModalLabel' aria-hidden='false'>
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
 				<h3>projects: </h3>
 				<p><a href='https://jppa-07e79089336e9e.sharepoint.com/personal/bayon_forte_parkseed_com/My%20New%20App3/default.aspx#Tile=Projects&View=Projects%20List' target='_blank'>Requirements App </p>
 				<p>Prioritization: X:\Department Files\ECommerce\UI-UX\PROJECT_PRIORITIZATION</p>
  				
				<!-- hidden anchor that calls the modal -->
 				<a id='modal-projects' style='' href='#modal-container-projects' role='button' class='btn invisible' data-toggle='modal'>modal-1</a>
 				<!-- ======================================================  -->
 				<div class='row ' >
							<div id='tableBody1-pagination' class='tableLiteTBody-pagination'>
							<button class='create_btn btn-create' >+</button> 
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
 						<div class="row text-center  " style="margin-top:15px;" >
	                        <div class="col-lg-2 ">
	                            <button onclick='projectSummary();' class="txt-bold btn-report">
	                                Project Summary
	                            </button>
	                        </div>
	                        <div class="col-lg-2 ">
	                            <button onclick='sortReport();' class="txt-bold btn-report">
	                                Sort Report
	                            </button>
	                        </div>
	                        <div class="col-lg-2">
	                            <button onclick='wrapUp();' class="txt-bold btn-report">
	                                Wrap Up
	                            </button>
	                        </div>
	                         <div class="col-lg-2">
	                            
	                            <a href='http://localhost:8989/jppa/tickets/includes/controllers/PROJECT_TO_EXCEL.php'>To EXCEL</a>
	                        </div>
                		</div>
 						 
                        





 				<div class='row'>
 							<table id='table' class='sortable order-table table layout display responsive-table'>
 								<thead>
 									<tr id='table_headers'>
									<!-- <th></th>
									 <th>id</th>
									<th>parent_id</th> -->
									<th>name</th>
									<th>owner</th>
									<th>brand</th>
									<th>priority</th>
									<th>description</th>
									<th>location</th>
									<th>mockup</th>
									<th>est_hours</th>
									<th>percent_complete</th>
									<th>desired_dt</th>
									<th>est_dt</th>
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
 	drill_down();
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
 				/*html += "<td><input type='checkbox'  ><input type='hidden' name='id' value='' + row.id + ''></td>";
				 html += '<td>' + row.id + '</td>';
				 html += '<td>' + row.parent_id + '</td>';*/
				 html += '<td class="data" >' + row.name + '</td>';
				 html += '<td class="data" >' + row.owner + '</td>';
				 html += '<td class="data" >' + row.brand + '</td>';
				 html += '<td class="data" >' + row.priority + '</td>';
				 html += '<td class="data" >' + row.description + '</td>';
				 html += '<td class="data" >' + row.location + '</td>';
				 html += '<td class="data" >' + row.mockup + '</td>';
				 html += '<td class="data" >' + row.est_hours + '</td>';
				 html += '<td class="data" >' + row.percent_complete + '</td>';
				 html += '<td class="data" >' + row.desired_dt + '</td>';
				 html += '<td class="data" >' + row.est_dt + '</td>';
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
 	//by pass normal load_data function to calculate all the percentages via the drill_down method.
 	drill_down();

 	//var dataString = "c=projects_controller&m=readToJSONByParentId&data_only=true";
 	//ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, load_data_callback);
 }
 function drill_down_callback(data){
 	console.log(data);
 }
  function drill_down(){
 	var dataString = "c=projects_controller&m=drill_down&data_only=true";
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
 	var table_header =  TABLE_DATA[i]['name']  ;
 	document.getElementById('modal-projects').click();
 	//$('.paginator_details_content').html(html);
 		var html = "<div class='row'><div class='col-md-12 ui_wrapper'><div id='row_" + TABLE_DATA[i]['id'] + "' >";
 		html += "<div class='row'><h2>" + table_header + "</h2></div>";
 html += "<div class='row'><h3><a  style='color:green;' href='<?=BASE_URL;?>index.php?c=requirements_controller&m=read_parent_id&parent_id="+TABLE_DATA[i]['id']+"&parent_name="+TABLE_DATA[i]['name']+"     '> Requirements </a></h3></div> "; html += "<input type='hidden' id='id'  name='id' class='info' value='"+TABLE_DATA[i]['id']+"' />";html += "<input type='hidden' id='parent_id'  name='parent_id' class='info' value='"+TABLE_DATA[i]['parent_id']+"' />"; 
	 html += "<div class='row'><div class='col-md-6 text-right' >id:</div><div class='col-md-6 text-left'><input type='text' id='id'  name='id' class='info' value='"+TABLE_DATA[i]['id']+"' /> </div></div>" 
	 html += "<div class='row'><div class='col-md-6 text-right' >parent_id:</div><div class='col-md-6 text-left'><input type='text' id='parent_id'  name='parent_id' class='info' value='"+TABLE_DATA[i]['parent_id']+"' /> </div></div>" 
	 html += "<div class='row'><div class='col-md-6 text-right' >name:</div><div class='col-md-6 text-left'><input type='text' id='name'  name='name' class='info' value='"+TABLE_DATA[i]['name']+"' /> </div></div>" 
	 html += "<div class='row'><div class='col-md-6 text-right' >owner:</div><div class='col-md-6 text-left'><input type='text' id='owner'  name='owner' class='info' value='"+TABLE_DATA[i]['owner']+"' /> </div></div>" 
	 html += "<div class='row'><div class='col-md-6 text-right' >brand:</div><div class='col-md-6 text-left'><input type='text' id='brand'  name='brand' class='info' value='"+TABLE_DATA[i]['brand']+"' /> </div></div>" 
	 html += "<div class='row'><div class='col-md-6 text-right' >priority:</div><div class='col-md-6 text-left'><input type='text' id='priority'  name='priority' class='info' value='"+TABLE_DATA[i]['priority']+"' /> </div></div>" 
	 

	 /*html += "<div class='row'><div class='col-md-6 text-right' >description:</div><div class='col-md-6 text-left'><input type='text' id='description'  name='description' class='info' value='"+TABLE_DATA[i]['description']+"' /> </div></div>" ;
*/
html += "<div class='row'><div class='col-md-6 text-right' >description:</div><div class='col-md-6 text-left'>";
 html += "<textarea   id='description'  name='description' class='info'  class='modal-text-area'>" + TABLE_DATA[i]['description'] + "</textarea>  ";
html += "</div></div>";
	 html += "<div class='row'><div class='col-md-6 text-right' >location:</div><div class='col-md-6 text-left'><input type='text' id='location'  name='location' class='info' value='"+TABLE_DATA[i]['location']+"' /> </div></div>" 
	 html += "<div class='row'><div class='col-md-6 text-right' >mockup:</div><div class='col-md-6 text-left'><input type='text' id='mockup'  name='mockup' class='info' value='"+TABLE_DATA[i]['mockup']+"' /> </div></div>" 
	 html += "<div class='row'><div class='col-md-6 text-right' >est_hours:</div><div class='col-md-6 text-left'><input type='text' id='est_hours'  name='est_hours' class='info' value='"+TABLE_DATA[i]['est_hours']+"' /> </div></div>" 
	 html += "<div class='row'><div class='col-md-6 text-right' >percent_complete:</div><div class='col-md-6 text-left'><input type='text' id='percent_complete'  name='percent_complete' class='info' value='"+TABLE_DATA[i]['percent_complete']+"' /> </div></div>" 
	 html += "<div class='row'><div class='col-md-6 text-right' >desired_dt:</div><div class='col-md-6 text-left'><input type='text' id='desired_dt'  name='desired_dt' class='info' value='"+TABLE_DATA[i]['desired_dt']+"' /> </div></div>" 
	 html += "<div class='row'><div class='col-md-6 text-right' >est_dt:</div><div class='col-md-6 text-left'><input type='text' id='est_dt'  name='est_dt' class='info' value='"+TABLE_DATA[i]['est_dt']+"' /> </div></div>" 
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
	var table_header =  'projects' ; 
	document.getElementById('modal-projects').click();
 	$('.paginator_create_content').html(html); 
 		var html = "<div class='row'><div class='col-md-12 ui_wrapper'><div id='row_create' >";
 		html += "<div class='row'><h2>" + table_header + "</h2></div>"; 
		html += "<div class='row'><h3>create:</h3></div>";
 		 
	 html += "<div class='row'><div class='col-md-6 text-right' >id:</div><div class='col-md-6 text-left'><input type='text' id='id'  name='id' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >parent_id:</div><div class='col-md-6 text-left'><input type='text' id='parent_id'  name='parent_id' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >name:</div><div class='col-md-6 text-left'><input type='text' id='name'  name='name' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >owner:</div><div class='col-md-6 text-left'><input type='text' id='owner'  name='owner' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >brand:</div><div class='col-md-6 text-left'><input type='text' id='brand'  name='brand' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >priority:</div><div class='col-md-6 text-left'><input type='text' id='priority'  name='priority' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >description:</div><div class='col-md-6 text-left'><input type='text' id='description'  name='description' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >location:</div><div class='col-md-6 text-left'><input type='text' id='location'  name='location' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >mockup:</div><div class='col-md-6 text-left'><input type='text' id='mockup'  name='mockup' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >est_hours:</div><div class='col-md-6 text-left'><input type='text' id='est_hours'  name='est_hours' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >percent_complete:</div><div class='col-md-6 text-left'><input type='text' id='percent_complete'  name='percent_complete' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >desired_dt:</div><div class='col-md-6 text-left'><input type='text' id='desired_dt'  name='desired_dt' class='info' value='' /></div></div>" 

	 html += "<div class='row'><div class='col-md-6 text-right' >est_dt:</div><div class='col-md-6 text-left'><input type='text' id='est_dt'  name='est_dt' class='info' value='' /></div></div>" 
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
	case 'parent_id':
	data.parent_id = e.value;
	break;
	case 'name':
	data.name = e.value;
	break;
	case 'owner':
	data.owner = e.value;
	break;
	case 'brand':
	data.brand = e.value;
	break;
	case 'priority':
	data.priority = e.value;
	break;
	case 'description':
	data.description = escapeHtml(e.value);
	break;
	case 'location':
	data.location = e.value;
	break;
	case 'mockup':
	data.mockup = e.value;
	break;
	case 'est_hours':
	data.est_hours = e.value;
	break;
	case 'percent_complete':
	data.percent_complete = e.value;
	break;
	case 'desired_dt':
	data.desired_dt = e.value;
	break;
	case 'est_dt':
	data.est_dt = e.value;
	break;				default:
 				//default code block
 				break;
 			}
 	});
 	var params = $.param(data);
 	var dataString = 'c=projects_controller&m=create&'+params;
 	
 	//alert(dataString +' || '+  url);
 	ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, create_callback);
 }
 function create_callback(data){
 	//alert(data);
 	 $(location).attr('href',JS_CONFIG.BASE_URL+'?c=projects_controller&m=read');
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
	case 'parent_id':
	data.parent_id = e.value;
	break;
	case 'name':
	data.name = e.value;
	break;
	case 'owner':
	data.owner = e.value;
	break;
	case 'brand':
	data.brand = e.value;
	break;
	case 'priority':
	data.priority = e.value;
	break;
	case 'description':
	data.description =  escapeHtml(e.value);
	break;
	case 'location':
	data.location = e.value;
	break;
	case 'mockup':
	data.mockup = e.value;
	break;
	case 'est_hours':
	data.est_hours = e.value;
	break;
	case 'percent_complete':
	data.percent_complete = e.value;
	break;
	case 'desired_dt':
	data.desired_dt = e.value;
	break;
	case 'est_dt':
	data.est_dt = e.value;
	break;				default:
 				//default code block
 				break;
 			}
 	});
 	var params = $.param(data);
 	var dataString = 'c=projects_controller&m=edit&'+params;
 	
 	//alert(dataString +' || '+  url);
 	ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, edit_callback);
 }
 function edit_callback(data){
 	//alert(data);
 	 $(location).attr('href',JS_CONFIG.BASE_URL+'?c=projects_controller&m=read');
 }
 function deny() {
 }
 function cancel_edit(id){
 		  $(location).attr('href',JS_CONFIG.BASE_URL+'?c=projects_controller&m=read');
 }
 function delete_user(id){
 		if(confirm('Are you sure you want to delete this user?'))
 		{ verify_delete(id); } else {  deny(); }
 }
 function verify_delete(id) {
 	var data = {};
 	data.id = id;
 	var dataString = 'c=projects_controller&m=delete&id=' + data.id  ;
 	 
 	//alert(BASE_URL+'---'+dataString);
 	ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, delete_callback);
 }
 function delete_callback(data){
 	 $(location).attr('href',JS_CONFIG.BASE_URL+'?c=projects_controller&m=read');
 }
 	 
 </script>

<script>
// SUMMARY OUTLINE CODE:
function projectSummary() {
    console.log(TABLE_DATA);
    document.getElementById('modal-projects').click();
    var html = "<div class='ui_wrapper'> ";
    html += '<h2>Project Summary</h2>';
    var date = new Date();
    console.log(date);
    html += '<p>' + date + '</p>';
    html += '<div class="outline_wrapper">  ';

    for (var i in TABLE_DATA) {
        html += "<ul>";
        html += "<li style='font-weight:bold;' >" + TABLE_DATA[i]['name'] + "</li>";
        html += "<ul>";
       // html += "<li> Name: " + TABLE_DATA[i]['name'] + "</li>";
       // html += "<li> Owner: " + TABLE_DATA[i]['owner'] + "</li>";
       // html += "<li> Brand: " + TABLE_DATA[i]['brand'] + "</li>";
        html += "<li> Priority: " + TABLE_DATA[i]['priority'] + "</li>";
		//html += "<li> Description: " + TABLE_DATA[i]['description'] + "</li>";
		//html += "<li> Location: " + TABLE_DATA[i]['location'] + "</li>";
		//html += "<li> Mockup: " + TABLE_DATA[i]['mockup'] + "</li>";
		//html += "<li> Estimated Hours: " + TABLE_DATA[i]['est_hours'] + "</li>";
		html += "<li> Percent Complete: " + TABLE_DATA[i]['percent_complete'] + "</li>";
		//html += "<li> Desired Date: " + TABLE_DATA[i]['desired_dt'] + "</li>";
		html += "<li> Estimated Date: " + TABLE_DATA[i]['est_dt'] + "</li>";
        html += "</ul>";
        html += "</ul>";
    }
    html += "</div>";
    //html += "<button onclick='snapShot()' data-dismiss='modal' >snapshot</button>";
    html += "</div>";
    $('.modal-body').html(html);
}

function sortReport(){

	 
	    var data = $("#tableBody1 tr.data_row").map(function (index, elem) {
	        var ret = [];
	        $('.data', this).each(function () {
	            var d = $(this).val()||$(this).text();
	            ret.push(d);
 	            if (d == "N/A") {
	                console.log(true);
	            }
	        });
	        return ret;
	    });
	    console.log('sortReport data:');
	    console.log(data);
 	    var projects = [];
	    //CHUNKIFY
	    var i,j,temparray,chunk = 11;
		for (i=0,j=data.length; i<j; i+=chunk) {
		    temparray = data.slice(i,i+chunk);
		    // do whatever
		    projects.push(temparray);
		}
	console.log(projects);

	///////////////////////////////////////////////////
	
	 //console.log(TABLE_DATA);
    document.getElementById('modal-projects').click();
    var html = "<div class='ui_wrapper'> ";
    html += '<h2>Project Report</h2>';
    var date = new Date();
    console.log(date);
    html += '<p>' + date + '</p>';
    html += '<div class="outline_wrapper">  ';

    for (var i in projects) {
        html += "<ul>";
        html += "<li style='font-weight:bold;' >" + projects[i][0] + "</li>";
        html += "<ul>";
       // html += "<li> Name: " + projects[i][0] + "</li>";
       // html += "<li> Owner: " + projects[i][1] + "</li>";
       // html += "<li> Brand: " + projects[i][1] + "</li>";
        html += "<li> Priority: " + projects[i][3] + "</li>";
		html += "<li> Description: " + projects[i][4] + "</li>";
		//html += "<li> Location: " + projects[i][5] + "</li>";
		//html += "<li> Mockup: " + projects[i][6] + "</li>";
		//html += "<li> Estimated Hours: " + projects[i][7] + "</li>";
		html += "<li> Percent Complete: " + projects[i][8] + "</li>";
		//html += "<li> Desired Date: " + projects[i][9] + "</li>";
		html += "<li> Estimated Date: " + projects[i][10] + "</li>";
        html += "</ul>";
        html += "</ul>";
    }
    html += "</div>";
    //html += "<button onclick='snapShot()' data-dismiss='modal' >snapshot</button>";
    html += "</div>";
    $('.modal-body').html(html);

	


	//////////////////////////////////////////////
}

function wrapUp_callback(data){
	//console.log('wrapUp callback');
	//console.log(data);
	var obj = JSON.parse(data);
	//console.log(obj);
	projectWrapUp(obj);
}
function wrapUp(){
	var dataString = 'c=projects_controller&m=readToJSONByParentId_ALL&data_only=true';
		//alert(dataString +' || '+  JS_CONFIG.BASE_URL);
		ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, wrapUp_callback);

}

function projectWrapUp(obj) {
             document.getElementById('modal-projects').click();
            var html = "<div class='ui_wrapper'> ";
            html += '<h2>Projects Wrap Up</h2>';
            var date = new Date();
            console.log(date);
            html += '<p>' + date + '</p>';
            html += '<div class="outline_wrapper">  ';
             for (var i in obj) {
              	 
             	 if(obj[i][0] != null){
             	 	// P R O J E C T    L E V E L 
             	 	 html += "<ul><div class='project' >Project:</div>";
                		html += "<li style='font-weight:bold;' >" + obj[i][0].name + "</li>";
                		html += "<li>" + obj[i][0].description + "</li>";
                		html += "<li>owner: " + obj[i][0].owner + "</li>";
                		html += "<li>priority: " + obj[i][0].priority + "</li>";
                		html += "<li>" + obj[i][0].percent_complete + "%</li>";
              	 	var obj_req = obj[i][1];
             	 	 for(var j in obj_req){
             	 	 	if(obj_req[j] != null){
             	 	 		// R E Q U I R E M E N T     L E V E L 
             	 	 		html += "<ul><div class='requirement'>Requirement:</div>";
		                	html += "<li style='font-weight:bold;' >" + obj_req[j].name + "</li>";
		                	if(obj_req[j].description != ""){
		                		html += "<li>" + obj_req[j].description + "</li>";
		                	}
		                	html += "<li>owner: " + obj_req[j].owner + "</li>";
		                	html += "<li>" + obj_req[j].percent_complete + "%</li>";
		                	
	             	 	 	var obj_task = obj_req[j][0];
	             	 	 	 for(var k in obj_task){
		             	 	 	if(obj_task[k] != null){
		             	 	 		// T A S K      L E V E L 
		             	 	 		html += "<ul><div class='task'>Task:</div>";
				                	html += "<li style='font-weight:bold;' >" + obj_task[k].name + "</li>";
				                	if(obj_task[k].description != ""){
				                		html += "<li>" + obj_task[k].description + "</li>";
				                	}
				                	

				                	html += "<li>owner: " + obj_task[k].owner + "</li>";
			             	 	 	html += "<li>" + obj_task[k].percent_complete + "%</li>";
 			             	 	 	html += "</ul>";// end of task
		             	 	 	}
		             	 	 }
		             	 	
		             	 	  html += "</ul>";//end of requirements
	             	 	 }
	             	 	 
             	 	 }
             	 	
             	 	 html += "</ul>";//end of project
             	 } 
             	
             }
             html += "</div>";
                html += "<button onclick='snapUp()' data-dismiss='modal' >snapshot</button>";
             html += "</div>";
            $('.modal-body').html(html);
 
 }
 ///////////////////////////////////////////////
 function snapUp_callback(data){
	//console.log('wrapUp callback');
	//console.log(data);
	var obj = JSON.parse(data);
	//console.log(obj);
	projectSnapUp(obj);
}
function snapUp(){
	var dataString = 'c=projects_controller&m=readToJSONByParentId_ALL&data_only=true';
		//alert(dataString +' || '+  JS_CONFIG.BASE_URL);
		ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, snapUp_callback);

}

   function snapShot_callback(data){
            console.log('snapShot_callback');
            //console.log(data);
        }
        //function projectWrapUp(obj) {
        function projectSnapUp( obj){
           // console.log('snapshot:');
            var snapData ={};
            snapData.id = 'null';
            snapData.name = 'proj_snapshot_';
            var description_json =   JSON.stringify(obj);
            snapData.description = description_json;
            snapData.created_dt = 'timestamp';
            //var dataString = "c=todo_controller&m=create&data_only=true&data="+data;
            var params = $.param(snapData);
            //console.log(params);
            var dataString = 'c=snapshot_controller&m=snapshot&data_only=true&' + params;
            ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, snapShot_callback);
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
  
