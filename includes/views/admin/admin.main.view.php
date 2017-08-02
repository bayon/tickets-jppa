<?php ?>


 <div id="template_view_1" class="container-fluid animated fadeIn kioview"    >
     
     <div class="row top-row">
        <div class="col-md-12  ">
            
            <div class="col-md-3" style="text-align:left;">
                <h3>admin.main.view.php</h3>
                <div  >
                    <p>Manage:</p>
                    <ul>
                        <li>admins</li>
                        <li>write code</li>
                         
                    </ul>
                </div>
                 <?php
                    
                    echo("<pre>");
                    print_r($_SESSION);
                    echo("</pre");
                    
                      echo("<pre>");
                    print_r($data);
                    echo("</pre");
                    ?>
            </div>
            
             
        </div>
     </div>
     <div class="row">
        <div id="content_stage" class="col-md-12  ">
            <p>content stage here...</p>
        </div>
     </div>
</div>
<!-- BACKGROUND IMAGES -->
<div id="BG_IMG">
    &nbsp;
    <!-- <img src="img/sky.jpg"> -->
</div>
<div id="BG_IMG_LEFT">
    &nbsp;
</div>
<div id="BG_IMG_RIGHT">
    &nbsp;
</div>
<div id="BG_IMG_TOP">
    &nbsp;
</div>
<!-- end of BACKGROUND IMAGES -->
<script>
    ( function() {
            $('#BG_IMG').addClass('gradient6');//be sure to remove unwanted classes before applying a new one.
        }()); 
</script>


<!-- ////////////////////////////   -->
 
