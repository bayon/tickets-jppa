
<?php 
require_once('view_paths.php');// SHOULD BE SOMETHING LIKE MODULE PATHS
fwrite($fp,"function makeModule_".strtolower($objectName)."(");
//loop through properies instead
//fputs($fp,"name,id");
//PROPERTIES
	$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		if ($x == 0) {
			fputs($fp, "" . $arrayOfProperties[$x]);
		} else {
			fputs($fp, "," . $arrayOfProperties[$x]);
		}
	}
fputs($fp,"){ \n");  
fputs($fp,"\tvar MODULE = (function () { \n");  
fputs($fp,"	var obj = {},  \n");  
fputs($fp,"		privateVariable = 1; \n ");  
fputs($fp,"  \n");  
fputs($fp,"	function privateMethod() {  \n");  
fputs($fp,"		// ...  \n");  
fputs($fp,"	}  \n");  
fputs($fp,"  \n"); 
 
fputs($fp,"	obj.moduleProperty = 1; \n ");  

//fputs($fp,"	obj.name = name; ");  
//fputs($fp,"	obj.id = id; ");  
$max = count($arrayOfProperties);
	for ($x = 0; $x < $max; $x++) {
		//if ($x == 0) {
			fputs($fp, "\tobj." . $arrayOfProperties[$x] ." = " . $arrayOfProperties[$x] ." \n");
		//}  
	}

fputs($fp,"	 \n");  
fputs($fp,"	obj.moduleMethod = function () { \n ");  
fputs($fp,"		// ... \n ");  
fputs($fp,"	}; \n ");  
fputs($fp,"        obj.html = function(){ \n ");  
fputs($fp,"       \t html ='<div>'; \n ");  
fputs($fp,"       \t html += 'content';  \n");  
fputs($fp,"       \t html += '</div>'; \n ");  
fputs($fp,"       \t return html;  \n");  
fputs($fp,"\t} \n ");  
fputs($fp,"	return obj;  \n");  
fputs($fp,"\t}()); \n ");  
fputs($fp,"\treturn MODULE; \n ");  
fputs($fp,"} \n ");


fclose($fp);
echo('<h3>PAGINATION VIEW</h3>');
showCode($view_list_final_filepath);

?>