<!-- PAGINATION VIEW -->
				<!--
					Validation Methods:
					onblur='checkNotEmpty(this);'
					onblur='checkEmail(this);'
					onblur='checkPhone(this);'
				--><div   class='pagination_page' > <div class='ui_wrapper'>
		<?php 
		$conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
		$limit = ( isset($_GET['limit'])) ? $_GET['limit'] : 25;
		$page = ( isset($_GET['page'])) ? $_GET['page'] : 1;
		$links = ( isset($_GET['links'])) ? $_GET['links'] : 7;
		$orderby = (isset($_GET['orderby'])) ? $_GET['orderby'] : 'name DESC ';
 		$where = (isset($_GET['where'])) ? $_GET['where'] : '';  
		$query = 'SELECT 
		admin.id ,admin.name ,admin.app_id ,admin.username ,admin.password ,admin.settings_id ,admin.acct_id ,admin.dt_created ,admin.dt_modified
	FROM admin '.$where.' ORDER BY '.$orderby.' ';
	//echo('<br>'.$query);
	$Paginator = new Paginator($conn, $query);
	if ($page == 'admin') {
		$page = 10;
	}
	echo('<script>var limit = '.$limit.';</script>');
	echo('<script>var page = '.$page.';</script>');
	$results = $Paginator -> getData($limit,$page );
	?>

	 <div class='container' style=' margin-top:7%;width:100%;'>
	    <h2 style='  '>Admin</h2><button class='create_btn' >+</button>
	        <div class='col-xs-12 col-xs-offset-0'> <!-- col-xs-offset-0 -->
	            		<div  class='paginator_search_wrapper' style=''>
	      					<a href='<?=BASE_URL;?>index.php?c='+controller+'&m=paginate&page=1&limit=100&where='>refresh</a> 
	  						<input id='search' data-type='search'  class='paginator_search_input'    >
						 </div>  
	         	<div class='list_wrapper'  >
	
	            <table class='table table-striped table-condensed table-bordered table-rounded' >
	            	<script> var data = []; </script>  
	            	<thead>
	                    <tr>
	                    	
	 <th id='id' class='th_link'  >id</th><th id='id' class='th_link'  >name</th><th id='id' class='th_link'  >app_id</th><th id='id' class='th_link'  >username</th><th id='id' class='th_link'  >password</th><th id='id' class='th_link'  >settings_id</th><th id='id' class='th_link'  >acct_id</th><th id='id' class='th_link'  >dt_created</th><th id='id' class='th_link'  >dt_modified</th>             
                        </tr>
                    </thead>
                    <tbody class='paginator_table_body'>
                    	<?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
                    		
						        <tr   id='<?php echo $i; ?>' class='data_row'     >
						      <td><?php echo $results -> data[$i]['id']; ?></td><td><?php echo $results -> data[$i]['name']; ?></td><td><?php echo $results -> data[$i]['app_id']; ?></td><td><?php echo $results -> data[$i]['username']; ?></td><td><?php echo $results -> data[$i]['password']; ?></td><td><?php echo $results -> data[$i]['settings_id']; ?></td><td><?php echo $results -> data[$i]['acct_id']; ?></td><td><?php echo $results -> data[$i]['dt_created']; ?></td><td><?php echo $results -> data[$i]['dt_modified']; ?></td> 			                 
						        </tr>
						 <?php 
						 	$json = json_encode($results -> data[$i]);
							echo('
								<script>
									//This script is filling out the details panel by row.
									var row_' . $i . ' = ' . $json . ';
									data.push(row_' . $i . ');
								</script>
							');
						 ?>      
						<?php endfor; ?>
                    	
                    </tbody>
                </table>
                </div>
                <div id='paginator_container' style='text-align:center;'>
            	<?php echo $Paginator -> createLinks($links, 'pagination pagination-sm'); ?> 
            	</div>
            </div>
        </div>
        
        <!-- paginator_details_content CAN NOT be an 'id' some kind of duplication occurs. -->
        <div class='paginator_details_content'></div>
         <div class='paginator_create_content'></div>

</div>
</div>

<script>
// PARAMETERS ///////////////////////////////////////////////////////////////////////////////////////////
var controller = 'admin_controller';
var search_fields = ['id','name','thing1','thing2'];

//  SEARCH FUNCTIONALITY   /////////////////////////////////////////////////////////////////////////////////
 $("[data-type='search']").on('keyup', function(e) {
 	var search_text;
	search_text = $(this).val();
	
	if(search_text.length >= 3){
		 var where="";
		  for(var i=0;i <search_fields.length ;i++){
		  	if(i==0){
		  		where +="  WHERE "+search_fields[i]+" LIKE '%"+search_text+"%' ";
		  	}else{
		  		where +="  OR   "+search_fields[i]+" LIKE '%"+search_text+"%' " ;
		  	}
		  }
		$(location).attr('href','<?php BASE_URL?>?c='+controller+'&m=paginate&page=1&limit=100&where='+where);
	}
});

//  POPULATE DETAILS PANEL  /////////////////////////////////////////////////////////////////////////////////
$('.data_row').click(function() {
	var i = this.id;
	var table_header =  'Admin' ;
	var display_fields = ['id','name','thing1','thing2'];
	
	$('.paginator_details_content').html(html);

		var html = "<div class='ui_wrapper'><div id='row_" + data[i]['id'] + "' >";
		html += "<h2>" + table_header + "</h2>";
		html += "<h3>update:</h3>";
	    

	 html += "<p>id:<input type='text' id='id'  name='id' class='info' value='"+data[i]['id']+"' /></p>" 
	 html += "<p>name:<input type='text' id='name'  name='name' class='info' value='"+data[i]['name']+"' /></p>" 
	 html += "<p>app_id:<input type='text' id='app_id'  name='app_id' class='info' value='"+data[i]['app_id']+"' /></p>" 
	 html += "<p>username:<input type='text' id='username'  name='username' class='info' value='"+data[i]['username']+"' /></p>" 
	 html += "<p>password:<input type='text' id='password'  name='password' class='info' value='"+data[i]['password']+"' /></p>" 
	 html += "<p>settings_id:<input type='text' id='settings_id'  name='settings_id' class='info' value='"+data[i]['settings_id']+"' /></p>" 
	 html += "<p>acct_id:<input type='text' id='acct_id'  name='acct_id' class='info' value='"+data[i]['acct_id']+"' /><a href='?c=account_controller&m=read_id&id="+data[i]['acct_id']+"' >see</a></p>" 
	 html += "<p>dt_created:<input type='text' id='dt_created'  name='dt_created' class='info' value='"+data[i]['dt_created']+"' /></p>" 
	 html += "<p>dt_modified:<input type='text' id='dt_modified'  name='dt_modified' class='info' value='"+data[i]['dt_modified']+"' /></p>" 	 
		html += " <input type='hidden' id='app_id'  name='app_id' class='info' value='" + data[i]['app_id'] + "'    /> ";
	   	html += "<a onclick='save_edit( "  +data[i]['id']+");' class='panel_anchor'>save</a>";
	   	html += "<a onclick='cancel_edit( "+data[i]['id']+");' class='panel_anchor'>cancel</a>";
	    html += "<a onclick='delete_this( "+data[i]['id']+");' class='panel_anchor'>delete</a>";
		html +="</div></div>";
	$('.paginator_details_content').html(html);
	panel_slide_in();
	$('.paginator_details_content').click(function() {
		 // ADD A CONDITION TO CLICK EVENT
		 // SO THAT DATA INPUTS CAN BE ACCESSED.
		   if( ! $( event.target).is('input') ) {
	           panel_slide_out();
	      }
	});

});

$('.create_btn').click(function() {
	//var i = this.id;
	var table_header =  'Admin' ;
	var display_fields = ['id','name','thing1','thing2'];
	$('.paginator_create_content').html(html);
		var html = "<div class='ui_wrapper'><div id='row_create' >";
		html += "<h2>" + table_header + "</h2>";
		html += "<h3>create:</h3>";
		
	 html += "<p>id:<input type='text' id='id'  name='id' class='info' value='' /></p>" 
	 html += "<p>name:<input type='text' id='name'  name='name' class='info' value='' /></p>" 
	 html += "<p>app_id:<input type='text' id='app_id'  name='app_id' class='info' value='' /></p>" 
	 html += "<p>username:<input type='text' id='username'  name='username' class='info' value='' /></p>" 
	 html += "<p>password:<input type='text' id='password'  name='password' class='info' value='' /></p>" 
	 html += "<p>settings_id:<input type='text' id='settings_id'  name='settings_id' class='info' value='' /></p>" 
	 html += "<p>acct_id:<input type='text' id='acct_id'  name='acct_id' class='info' value='' /></p>" 
	 html += "<p>dt_created:<input type='text' id='dt_created'  name='dt_created' class='info' value='' /></p>" 
	 html += "<p>dt_modified:<input type='text' id='dt_modified'  name='dt_modified' class='info' value='' /></p>" 
		html += " <input type='hidden' id='app_id'  name='app_id' class='info' value=''    /> ";
	   	html += "<a onclick='save_create();' class='panel_anchor'>save</a>";
	   	html += "<a onclick='cancel_create();' class='panel_anchor'>cancel</a>";
		html +="</div></div>";
	$('.paginator_create_content').html(html);
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
 
////   DATA CREATE ////////////////////////////////////////////////
function save_create() {
	var data = {};
	//alert(id);
	//data.id = id;
		$.each($('#row_create .info'), function(i, e) {
				//alert(i + '||' + e.name + '||' + e.value);
				switch(e.name) {
					
	case 'id':
	data.id = e.value;
	break;
	case 'name':
	data.name = e.value;
	break;
	case 'app_id':
	data.app_id = e.value;
	break;
	case 'username':
	data.username = e.value;
	break;
	case 'password':
	data.password = e.value;
	break;
	case 'settings_id':
	data.settings_id = e.value;
	break;
	case 'acct_id':
	data.acct_id = e.value;
	break;
	case 'dt_created':
	data.dt_created = e.value;
	break;
	case 'dt_modified':
	data.dt_modified = e.value;
	break;
					default:
					//default code block
					break;
				}
		});
		var params = $.param(data);
		var dataString = 'c='+controller+'&m=create&'+params;
		var BASE_URL = '<?php BASE_URL?>'; 
		//alert(dataString +' || '+  BASE_URL);
		ajax_datastring_URL_callback(dataString, BASE_URL, create_callback);
}
function create_callback(data){
	//alert('uncomment redirect);
	//console.log(data);
	$(location).attr('href','<?php BASE_URL?>?c='+controller+'&m=read');
}

////   DATA EDIT ////////////////////////////////////////////////
function save_edit(id) {
	var data = {};
	//alert(id);
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
	case 'app_id':
	data.app_id = e.value;
	break;
	case 'username':
	data.username = e.value;
	break;
	case 'password':
	data.password = e.value;
	break;
	case 'settings_id':
	data.settings_id = e.value;
	break;
	case 'acct_id':
	data.acct_id = e.value;
	break;
	case 'dt_created':
	data.dt_created = e.value;
	break;
	case 'dt_modified':
	data.dt_modified = e.value;
	break;
					default:
					//default code block
					break;
				}
		});
		var params = $.param(data);
		var dataString = 'c='+controller+'&m=edit&'+params;
		var BASE_URL = '<?php BASE_URL?>'; 
		//alert(dataString +' || '+  BASE_URL);
		ajax_datastring_URL_callback(dataString, BASE_URL, edit_callback);
}
function edit_callback(data){
	//alert('uncomment redirect');
	//console.log(data);
	$(location).attr('href','<?php BASE_URL?>?c='+controller+'&m=read');
}

function deny() {
}
function cancel_edit(id){
		  $(location).attr('href','<?php BASE_URL?>?c='+controller+'&m=read');
}
function delete_this(id){
		if(confirm('Are you sure you want to delete this ?'))
		{ verify_delete(id); } else {  deny(); }
}
function verify_delete(id) {
	var data = {};
	data.id = id;
	var dataString = 'c='+controller+'&m=delete&id=' + data.id  ;
	var BASE_URL = '<?php BASE_URL?> ';
	//alert(BASE_URL+'---'+dataString);
	ajax_datastring_URL_callback(dataString, BASE_URL, delete_callback);
}
function delete_callback(data){
	 $(location).attr('href','<?php BASE_URL?>?c='+controller+'&m=read');
}
	 
</script>
