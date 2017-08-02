<?php ?>

<style>
.codeTextArea{
    height:300px;
    width:100%;
    border:solid 1px #000;
}
</style>
 <div id="template_view_1" class="container-fluid animated fadeIn kioview"    >
     
     <div class="row top-row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  ">
            <h3>Convert Kalio DMI syntax from 'old' to 'new'</h3>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="text-align:left;">
                <h3>Code</h3>
                <div  >
                    
                   <textarea id='codeToConvert' class='codeTextArea'></textarea>
                     
                </div>
                <button id="convertButton" >convert</button>
                
            </div>
             <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="text-align:left;">
                <h3>Converted</h3>
                <div  >
                     
                   <textarea id='codeConverted' class='codeTextArea'></textarea>
                     
                </div>
                
            </div>
            
             
        </div>

     </div>
     <div class="row">
         <p>Kalio Syntax Kim Planet Video screenshots</p>
         <p>file:///C:/Users/bayon.forte/Documents/KNOWLEDGE_BASE/KalioArchitectVideoScreens.pdf</p>
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
    String.prototype.replaceAll = function(search, replacement) {
        var target = this;
        return target.split(search).join(replacement);
    };

    var codeToConvert = null;
   
    $("#convertButton").bind('click',function(){
        codeToConvert = $('#codeToConvert').val();
        var codeConverted = convertOldKalioSyntaxToNew(codeToConvert)
       $("#codeConverted").val(codeConverted);
    });

    function convertOldKalioSyntaxToNew(code_snip){
        //console.log(code_snip);
        var res = code_snip.replaceAll("[[DMI:","<dmi:");
        res = res.replaceAll("[[/DMI:","</dmi:");
        res = res.replaceAll("]]",">");
        //additions
         res = res.replaceAll(":Control",":control");
        res = res.replaceAll(":If",":if");
        res = res.replaceAll(":Then",":then");
        res = res.replaceAll(":Property",":property");
        res = res.replaceAll(":Expression",":expression");
        res = res.replaceAll(":USE",":loop");
         res = res.replaceAll(":Use",":loop");
          // TOO DANGEROUS res = res.replaceAll("Use","loop");
        return res;
          
    }
</script>


<!-- ////////////////////////////   -->
 
