<?php 
require_once('view_paths.php');
fwrite($fp, "<!-- PAGINATION VIEW -->
				<!--
					Validation Methods:
					onblur='checkNotEmpty(this);'
					onblur='checkEmail(this);'
					onblur='checkPhone(this);'
				-->");
fputs($fp,"<div   class='pagination_page' >");	
fputs($fp," <div class='ui_wrapper'>");	

fputs($fp,"
		<?php 
		\$conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
		\$limit = ( isset(\$_GET['limit'])) ? \$_GET['limit'] : 25;
		\$page = ( isset(\$_GET['page'])) ? \$_GET['page'] : 1;
		\$links = ( isset(\$_GET['links'])) ? \$_GET['links'] : 7;
		\$orderby = (isset(\$_GET['orderby'])) ? \$_GET['orderby'] : 'name DESC ';
 		\$where = (isset(\$_GET['where'])) ? \$_GET['where'] : '';  
		\$query = 'SELECT 
		");
		$max = count($arrayOfProperties);
		for ($x = 0; $x < $max; $x++) {
			if($x == 0){
				fputs($fp,strtolower($objectName.".".$arrayOfProperties[$x]));
			}else{
				fputs($fp,strtolower(" ,". $objectName.".".$arrayOfProperties[$x]));
			}
		}
fputs($fp,"
	FROM ".strtolower($objectName)." '.\$where.' ORDER BY '.\$orderby.' ';
	//echo('<br>'.\$query);
	\$Paginator = new Paginator(\$conn, \$query);
	if (\$page == '".strtolower($objectName)."') {
		\$page = 10;
	}
	echo('<script>var limit = '.\$limit.';</script>');
	echo('<script>var page = '.\$page.';</script>');
	\$results = \$Paginator -> getData(\$limit,\$page );
	?>
");
	
fputs($fp,"
	 <div class='container' style=' margin-top:7%;width:100%;'>
	    <h2 style='  '>".ucfirst($objectName)."</h2><button class='create_btn' >+</button>
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
	                    	
	 ");                  	
    
           $max = count($arrayOfProperties);
			for ($x = 0; $x < $max; $x++) {
				fputs($fp,"<th id='id' class='th_link'  >".$arrayOfProperties[$x]."</th>");
			}
	        fputs($fp,"             
                        </tr>
                    </thead>
                    <tbody class='paginator_table_body'>
                    	<?php for( \$i = 0; \$i < count( \$results->data ); \$i++ ) : ?>
                    		
						        <tr   id='<?php echo \$i; ?>' class='data_row'     >
						      ");  	
						        	
						        	 $max = count($arrayOfProperties);
										for ($x = 0; $x < $max; $x++) {
											fputs($fp,"<td><?php echo \$results -> data[\$i]['".$arrayOfProperties[$x]."']; ?></td>");
										}
						        	
						                
			fputs($fp," 			                 
						        </tr>
						 <?php 
						 	\$json = json_encode(\$results -> data[\$i]);
							echo('
								<script>
									//This script is filling out the details panel by row.
									var row_' . \$i . ' = ' . \$json . ';
									data.push(row_' . \$i . ');
								</script>
							');
						 ?>      
						<?php endfor; ?>
                    	
                    </tbody>
                </table>
                </div>
                <div id='paginator_container' style='text-align:center;'>
            	<?php echo \$Paginator -> createLinks(\$links, 'pagination pagination-sm'); ?> 
            	</div>
            </div>
        </div>
        
        <!-- paginator_details_content CAN NOT be an 'id' some kind of duplication occurs. -->
        <div class='paginator_details_content'></div>
         <div class='paginator_create_content'></div>

</div>
</div>
");  
 
 fputs($fp,"
<script>
// PARAMETERS ///////////////////////////////////////////////////////////////////////////////////////////
var controller = '".strtolower($objectName)."_controller';
var search_fields = ['id','name','thing1','thing2'];

//  SEARCH FUNCTIONALITY   /////////////////////////////////////////////////////////////////////////////////
 $(\"[data-type='search']\").on('keyup', function(e) {
 	var search_text;
	search_text = $(this).val();
	
	if(search_text.length >= 3){
		 var where=\"\";
		  for(var i=0;i <search_fields.length ;i++){
		  	if(i==0){
		  		where +=\"  WHERE \"+search_fields[i]+\" LIKE '%\"+search_text+\"%' \";
		  	}else{
		  		where +=\"  OR   \"+search_fields[i]+\" LIKE '%\"+search_text+\"%' \" ;
		  	}
		  }
		$(location).attr('href','<?php BASE_URL?>?c='+controller+'&m=paginate&page=1&limit=100&where='+where);
	}
});
");

fputs($fp,"
//  POPULATE DETAILS PANEL  /////////////////////////////////////////////////////////////////////////////////
$('.data_row').click(function() {
	var i = this.id;
	var table_header =  '".ucfirst($objectName)."' ;
	var display_fields = ['id','name','thing1','thing2'];
	
	$('.paginator_details_content').html(html);

		var html = \"<div class='ui_wrapper'><div id='row_\" + data[i]['id'] + \"' >\";
		html += \"<h2>\" + table_header + \"</h2>\";
		html += \"<h3>update:</h3>\";
	    
");
		$max = count($arrayOfProperties);
		for ($x = 0; $x < $max; $x++) {
			//if property-suffix ends in '_id' then make a link to related table.
			$a_relation = explode("_",$arrayOfProperties[$x]);
			if($a_relation[1] == "id"){
				fputs($fp,"\n\t html += \"<p>".$arrayOfProperties[$x].":<input type='text' id='".$arrayOfProperties[$x]."'  name='".$arrayOfProperties[$x]."' class='info' value='\"+data[i]['".$arrayOfProperties[$x]."']+\"' /><a href='?c=XXX_controller&m=read_id&id=\"+data[i]['XXX_id']+\"' >see</a></p>\" ");
				
			}else{
				fputs($fp,"\n\t html += \"<p>".$arrayOfProperties[$x].":<input type='text' id='".$arrayOfProperties[$x]."'  name='".$arrayOfProperties[$x]."' class='info' value='\"+data[i]['".$arrayOfProperties[$x]."']+\"' /> </p>\" ");
				
			}
 		}
	fputs($fp,"	 
		html += \" <input type='hidden' id='app_id'  name='app_id' class='info' value='\" + data[i]['app_id'] + \"'    /> \";
	   	html += \"<a onclick='save_edit( \"  +data[i]['id']+\");' class='panel_anchor'>save</a>\";
	   	html += \"<a onclick='cancel_edit( \"+data[i]['id']+\");' class='panel_anchor'>cancel</a>\";
	    html += \"<a onclick='delete_this( \"+data[i]['id']+\");' class='panel_anchor'>delete</a>\";
		html +=\"</div></div>\";
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
");

fputs($fp,"
$('.create_btn').click(function() {
	//var i = this.id;
	var table_header =  '".ucfirst($objectName)."' ;
	var display_fields = ['id','name','thing1','thing2'];
	$('.paginator_create_content').html(html);
		var html = \"<div class='ui_wrapper'><div id='row_create' >\";
		html += \"<h2>\" + table_header + \"</h2>\";
		html += \"<h3>create:</h3>\";
		");
		
		$max = count($arrayOfProperties);
		for ($x = 0; $x < $max; $x++) {
			fputs($fp,"\n\t html += \"<p>".$arrayOfProperties[$x].":<input type='text' id='".$arrayOfProperties[$x]."'  name='".$arrayOfProperties[$x]."' class='info' value='' /></p>\" ");
		
		}
		
		fputs($fp,"
		html += \" <input type='hidden' id='app_id'  name='app_id' class='info' value=''    /> \";
	   	html += \"<a onclick='save_create();' class='panel_anchor'>save</a>\";
	   	html += \"<a onclick='cancel_create();' class='panel_anchor'>cancel</a>\";
		html +=\"</div></div>\";
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
 ");

 fputs($fp,"
////   DATA CREATE ////////////////////////////////////////////////
function save_create() {
	var data = {};
	//alert(id);
	//data.id = id;
		$.each($('#row_create .info'), function(i, e) {
				//alert(i + '||' + e.name + '||' + e.value);
				switch(e.name) {
					");
					$max = count($arrayOfProperties);
					for ($x = 0; $x < $max; $x++) {
						fputs($fp,"\n\tcase '".strtolower($arrayOfProperties[$x])."':");
						fputs($fp,"\n\tdata.".strtolower($arrayOfProperties[$x])." = e.value;");
						fputs($fp,"\n\tbreak;");
					}
					 
		fputs($fp,"
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
");

 fputs($fp,"
////   DATA EDIT ////////////////////////////////////////////////
function save_edit(id) {
	var data = {};
	//alert(id);
	data.id = id;
		$.each($('#row_' + id + ' .info'), function(i, e) {
				//alert(i + '||' + e.name + '||' + e.value);
				switch(e.name) {
					");
					
					$max = count($arrayOfProperties);
					for ($x = 0; $x < $max; $x++) {
						fputs($fp,"\n\tcase '".strtolower($arrayOfProperties[$x])."':");
						fputs($fp,"\n\tdata.".strtolower($arrayOfProperties[$x])." = e.value;");
						fputs($fp,"\n\tbreak;");
					}
					 
		fputs($fp,"
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
");

fputs($fp,"
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
");

fclose($fp);
echo('<h3>PAGINATION VIEW</h3>');
showCode($view_list_final_filepath);

?>
