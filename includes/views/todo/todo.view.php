<script>
    // PARAMETERS ///////////////////////////////////////////////////////////////////////////////////////////
    var controller = 'todo_controller';
    var TABLE_DATA = [];
    var itemsPerPage = null;
</script>

<!--  THE MODAL -->
<div style='margin-top:5%;' class='modal fade' id='modal-container-todo' role='dialog' aria-labelledby='myModalLabel' aria-hidden='false'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='false'>
                    ×
                </button>
                <h4 class='modal-title' id='myModalLabel'> edit </h4>
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
<div id='template_view_1' class='container animated fadeIn kioview' style='text-align:center;'>
    <div class='xxxpagination_page'>
        <div class='row top-row'>
            <div class='col-md-12'>
                <h3>todo</h3><div style="text-align:right;"><h4 style="color:red;">Kalio Emergency Support: 1 (513) 619-6000 </h4>
                <p>chinna@kaliocommerce.com</p>
                <p>aedwards@kaliocommerce.com</p>
                <p>Prioritization: X:\Department Files\ECommerce\UI-UX\PROJECT_PRIORITIZATION </p>
                <p>CSS Guides: C:\xampp\htdocs\jppa\tickets\img\uploads</p>
                <a href="http://localhost:8989/jppa/tickets/img/uploads/">CSS Guides</a>
                </div>
                <button class='create_btn'>+</button>
                <!-- hidden anchor that calls the modal -->
                <a id='modal-todo' style='' href='#modal-container-todo' role='button' class='btn invisible' data-toggle='modal'>modal-1</a>
                <!-- ======================================================  -->
                <div class='row'>
                    <div id='tableBody1-pagination' class='tableLiteTBody-pagination'>
                        <input type='search' class='light-table-filter' data-table='order-table' placeholder='Filter'>
                        <a id='tableBody1-previous' href='#'>
                            <button class='table-lite-btn'>
                                &laquo; Previous
                            </button>
                        </a>
                        <a id='tableBody1-next' href='#'>
                            <button class='table-lite-btn'>
                                Next &raquo;
                            </button>
                        </a>

                        <select id='itemsPerPage' onchange='changeItemsPerPage(this);'>
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                            <option>500</option>
                            <option>1000</option>
                        </select>
                        <a href=''>
                            <button class='table-lite-btn'>
                                refresh
                            </button>
                        </a>
                       

                    </div>
                    <div class="row text-center">
                        <div class="col-lg-1">
                            <button onclick='exportToOutline();' class="txt-bold">
                                Weekly Report
                            </button>
                        </div>
<!-- SNIPPET  //////    bf43adc-->
<!--  <a href="URL" target="_blank"><button>TITLE</button></a> -->
 
                </div>
                <div class='row'>
                    <table id='table' class='sortable order-table table layout display responsive-table'>
                        <thead>
                            <tr id='table_headers'>
                                <th></th>
                                <th>id</th>
                                <th  id='nameHeader' style="width:20% !important;min-width:20% !important;" >name </th>
                                <th>description</th>
                                <th>notes</th>
                                <th>last update</th><!-- hacked the completed field -->
                               
                                <th>percent</th>
                                 <th>due</th>
                                 <!-- -->
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
        function read_ModelKV_callback(data) {
            var obj = JSON.parse(data);
            console.log(obj);
        }

        function getChildren() {
            read_ModelKV('model', 'key', 'value');
        }

        function read_ModelKV(model, k, v) {
            var dataString = 'c=' + model + '_controller&m=read_ModelKV&data_only=true&model=' + model + '&k=' + k + '&v=' + v + '';
            ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, read_ModelKV_callback);
        }

        function changeItemsPerPage(obj) {
            itemsPerPage = obj.value;
            load_data();
        }

        function tableLiteCheckedRows_callback(array_of_ids) {
            console.log('table-lite: Loop through these ids and handle them as you will...');
        }

        function exportToOutline() {
            console.log(TABLE_DATA);
            document.getElementById('modal-todo').click();
            var html = "<div class='ui_wrapper'> ";
            html += '<h2>Weekly Report</h2>';
            var date = new Date();
            console.log(date);
            html += '<p>' + date + '</p>';
            html += '<div class="outline_wrapper">  ';

            for (var i in TABLE_DATA) {
                html += "<ul>";
                html += "<li style='font-weight:bold;' >" + TABLE_DATA[i]['name'] + "</li>";
                html += "<ul>";
                html += "<li> " + TABLE_DATA[i]['description'] + "</li>";
                html += "<li>" + TABLE_DATA[i]['notes'] + "</li>";
                html += "<li>" + TABLE_DATA[i]['completed'] + "</li>";
                html += "<li>" + TABLE_DATA[i]['percent'] + "</li>";
                html += "<li>" + TABLE_DATA[i]['due'] + "</li>";
                html += "</ul>";
                html += "</ul>";
            }
            html += "</div>";
            html += "<button onclick='snapShot()' data-dismiss='modal' >snapshot</button>";
            html += "</div>";
            $('.modal-body').html(html);
        }
        $(document).ready(function() {
            itemsPerPage = 10;
            load_data();
        });
        function snapShot_callback(data){
            //console.log('snapShot_callback');
            //console.log(data);
        }
        function snapShot( ){
           // console.log('snapshot:');
            var snapData ={};
            snapData.id = 'null';
            snapData.name = 'snapshot_';
            var description_json =   JSON.stringify(TABLE_DATA);
            snapData.description = description_json;
            snapData.created_dt = 'timestamp';
            //var dataString = "c=todo_controller&m=create&data_only=true&data="+data;
            var params = $.param(snapData);
            //console.log(params);
            var dataString = 'c=snapshot_controller&m=snapshot&data_only=true&' + params;
            ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, snapShot_callback);
        }

        function load_data_callback(data) {
            console.log('load data callback fn:');
            var obj = JSON.parse(data);
            TABLE_DATA = obj;
            var rows = [];
            $.each(obj, function(i, row) {
                if (typeof row == 'object') {
                    var html = '';
                    html += "<tr id=''+row.id+'' onclick='rowClick(" + i + ");' class='data_row' >";
                    html += "<td><input type='checkbox'  ><input type='hidden' name='id' value='' + row.id + ''></td>";
                    html += '<td>' + row.id + '</td>';
                    html += '<td>' + row.name + '</td>';
                    html += '<td>' + row.description + '</td>';
                    html += '<td>' + row.notes + '</td>';
                    html += '<td>' + row.completed + '</td>';
                    html += '<td>' + row.percent + '</td>';
                    html += '<td>' + row.due + '</td>';
                    html += '</tr>';
                    rows.push(html);
                }
            });
            $('#tableBody1').append(rows.join(''));
            $('#tableBody1').paginate({
                itemsPerPage: itemsPerPage
            });
            $('#nameHeader').css('width','150px !important;');
            $('#nameHeader').css('minWidth','150px !important;');

        };

        function load_data() {
            var dataString = "c=todo_controller&m=readToJSON&data_only=true";
            ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, load_data_callback);
        }
    </script>
    <script>
        (function() {
            $('#BG_IMG').addClass('gradient6'); //be sure to remove unwanted classes before applying a new one.
        }());
    </script>
    <!-- /////////////////////////////////////////////////////////  -->
    <!-- paginator_details_content CAN NOT be an 'id' some kind of duplication occurs. -->
    <!-- <div class='paginator_details_content'></div>  -->


    <script>
        //  POPULATE DETAILS PANEL  /////////////////////////////////////////////////////////////////////////////////
        function rowClick(i) {
            var table_header = 'todo';
            document.getElementById('modal-todo').click();
            //$('.paginator_details_content').html(html);
            var html = "<div class='ui_wrapper'><div id='row_" + TABLE_DATA[i]['id'] + "'  class='row' >";

            html += '<h2>' + table_header + '</h2>';
            html += "<div class='col-xs-12 col-sm-12 col-md-3 col-lg-3  '>id:</div>";
            html += "<div class='col-xs-12 col-sm-12 col-md-9 col-lg-9  '>";
            html += "<input type='text' id='id'  name='id' class='info' value='" + TABLE_DATA[i]['id'] + "' /> ";
            html += "</div>";

            html += "<div class='col-xs-12 col-sm-12 col-md-3 col-lg-3 '>name:</div>";
            html += "<div class='col-xs-12 col-sm-12 col-md-9 col-lg-9  '>";
            html += "<input type='text' id='name'  name='name' class='info' value='" + TABLE_DATA[i]['name'] + "' /> ";
            html += "</div>";
            html += "<div class='col-xs-12 col-sm-12 col-md-3 col-lg-3  '>description:</div>";
            html += "<div class='col-xs-12 col-sm-12 col-md-9 col-lg-9  '>";
            
             html += "<textarea   id='description'  name='description' class='info'  class='modal-text-area'>" + TABLE_DATA[i]['description'] + "</textarea>  ";
            html += "</div>";
            html += "<div class='col-xs-12 col-sm-12 col-md-3 col-lg-3  '>notes:</div>";
            html += "<div class='col-xs-12 col-sm-12 col-md-9 col-lg-9  '>";
             html += "<textarea   id='notes'  name='notes' class='info'  class='modal-text-area'>" + TABLE_DATA[i]['notes'] + "</textarea>  ";
            html += "</div>";
            html += "<div class='col-xs-12 col-sm-12 col-md-3 col-lg-3  '>completed:</div>";
            html += "<div class='col-xs-12 col-sm-12 col-md-9 col-lg-9  '>";
            html += "<input type='text' id='completed'  name='completed' class='info' value='" + TABLE_DATA[i]['completed'] + "' /> ";
            html += "</div>";
            /* */
  html += "<div class='col-xs-12 col-sm-12 col-md-3 col-lg-3  '>percent:</div>";
            html += "<div class='col-xs-12 col-sm-12 col-md-9 col-lg-9  '>";
             html += "<textarea   id='percent'  name='percent' class='info'  class='modal-text-area'>" + TABLE_DATA[i]['percent'] + "</textarea>  ";
            html += "</div>";

              html += "<div class='col-xs-12 col-sm-12 col-md-3 col-lg-3  '>due:</div>";
            html += "<div class='col-xs-12 col-sm-12 col-md-9 col-lg-9  '>";
             html += "<textarea   id='due'  name='due' class='info'  class='modal-text-area'>" + TABLE_DATA[i]['due'] + "</textarea>  ";
            html += "</div>";


           

            html += "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12  '>";
            html += " <input type='hidden' id='app_id'  name='app_id' class='info' value='" + TABLE_DATA[i]['app_id'] + "'    /> ";
            html += "<a onclick='save_edit( " + TABLE_DATA[i]['id'] + ");' class='panel_anchor' data-dismiss='modal' >save</a>";
            html += "<a onclick='cancel_edit( " + TABLE_DATA[i]['id'] + ");' class='panel_anchor'>cancel</a>";
            html += "<a onclick='delete_user( " + TABLE_DATA[i]['id'] + ");' class='panel_anchor'>delete</a>";

            html += "</div>"
            html += "</div></div>";

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
            var table_header = 'todo';
            document.getElementById('modal-todo').click();
            $('.paginator_create_content').html(html);
            var html = "<div class='ui_wrapper'><div id='row_create' >";
            html += "<h2>" + table_header + "</h2>";
            html += "<h3>create:</h3>";

            html += "<p>id:<input type='text' id='id'  name='id' class='info' value='' /></p>"

            html += "<p>name:<input type='text' id='name'  name='name' class='info' value='' /></p>"

            html += "<p>description:<input type='text' id='description'  name='description' class='info' value='' /></p>"

            html += "<p>notes:<input type='text' id='notes'  name='notes' class='info' value='' /></p>"

            html += "<p>completed:<input type='text' id='completed'  name='completed' class='info' value='' /></p>";
            /**/
             html += "<p>percent:<input type='text' id='percent'  name='percent' class='info' value='complete:' /></p>";

              html += "<p>due:<input type='text' id='due'  name='due' class='info' value='due:' /></p>";


            

            html += " <input type='hidden' id='app_id'  name='app_id' class='info' value=''    /> ";
            html += "<a onclick='save_create();' class='panel_anchor'>save</a>";
            html += "<a onclick='cancel_create();' class='panel_anchor'>cancel</a>";
            html += "</div></div>";
            $('.modal-body').html(html);
            //panel_slide_in(); 
            panel_slide_in_right();
            $('.paginator_create_content').click(function() {
                // ADD A CONDITION TO CLICK EVENT 
                // SO THAT DATA INPUTS CAN BE ACCESSED.
                if (!$(event.target).is('input')) {
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
                switch (e.name) {

                    case 'id':
                        data.id = e.value;
                        break;
                    case 'name':
                        //data.name = e.value;
                        data.name = escapeHtml(e.value);
                        break;
                    case 'description':
                        //data.description = e.value;
                        //data.description =  e.value.replace(/[^a-z0-9]/gi, '');
                        data.description = escapeHtml(e.value);
                        break;
                    case 'notes':
                        //data.notes = e.value;
                        data.notes = escapeHtml(e.value);
                        break;
                    case 'completed':
                        data.completed = e.value;
                        break;
                    /**/
                    case 'percent':
                        
                        data.percent = escapeHtml(e.value);
                        break;

                    case 'due':
                         
                        data.due = escapeHtml(e.value);
                        break;


                    
                    default:
                        //default code block
                        break;
                }
            });
            var params = $.param(data);
            var dataString = 'c=todo_controller&m=create&' + params;

            //alert(JS_CONFIG.BASE_URL  +' || '+  dataString   );
            ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, create_callback);
        }
            function escapeHtmlORIGINAL(unsafe) {
                return unsafe
                     .replace(/&/g, "&amp;")
                     .replace(/</g, "&lt;")
                     .replace(/>/g, "&gt;")
                     .replace(/"/g, "&quot;")
                     .replace(/'/g, "&#039;");
             }
        function create_callback(data) {
                //console.log(data)
                //alert('look at data before redirect.....in console.');
                $(location).attr('href', JS_CONFIG.BASE_URL + '?c=todo_controller&m=read');
            }
            //  DATA EDITING   /////////////////////////////////////////////////////////////////////////////////         
        function save_edit(id) {
            var data = {};
            data.id = id;
            $.each($('#row_' + id + ' .info'), function(i, e) {
                //alert(i + '||' + e.name + '||' + e.value);
                switch (e.name) {

                    case 'id':
                        data.id = e.value;
                        break;
                    case 'name':
                        data.name = e.value;
                        break;
                    case 'description':
                        data.description = e.value;
                        break;
                    case 'notes':
                        data.notes = e.value;
                        break;
                    case 'completed':
                        data.completed = e.value;
                        break;
                     /* */
                     case 'percent':
                        data.percent = e.value;
                        break;
                     case 'due':
                        data.due = e.value;
                        break;
                       
                    default:
                        //default code block
                        break;
                }
            });
            var params = $.param(data);
            var dataString = 'c=todo_controller&m=edit&' + params;

           // alert(dataString  );
            ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, edit_callback);
        }

        function edit_callback(data) {
            //alert(data);
            $(location).attr('href', JS_CONFIG.BASE_URL + '?c=todo_controller&m=read');
        }

        function deny() {}

        function cancel_edit(id) {
            $(location).attr('href', JS_CONFIG.BASE_URL + '?c=todo_controller&m=read');
        }

        function delete_user(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                verify_delete(id);
            } else {
                deny();
            }
        }

        function verify_delete(id) {
            var data = {};
            data.id = id;
            var dataString = 'c=todo_controller&m=delete&id=' + data.id;

            //alert(BASE_URL+'---'+dataString);
            ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, delete_callback);
        }

        function delete_callback(data) {
            $(location).attr('href', JS_CONFIG.BASE_URL + '?c=todo_controller&m=read');
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