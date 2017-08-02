<?php
/*
<?php
header('Access-Control-Allow-Origin: *');
//header('Cache-Control: no-cache, must-revalidate');
//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
?>

*/
//TO DO: When you create an admin ALSO create a directory for their documents
  // following the format "admin_".$data
  /*
   * mkdir(path,mode,recursive,context)
   * Parameter    Description
      path    Required. Specifies the name of the directory to create
      mode    Optional. Specifies permissions. By default, the mode is 0777 (widest possible access).
      The mode parameter consists of four numbers:

          The first number is always zero
          The second number specifies permissions for the owner
          The third number specifies permissions for the owner's user group
          The fourth number specifies permissions for everybody else
          Possible values (to set multiple permissions, add up the following numbers):

          1 = execute permissions
          2 = write permissions
          4 = read permissions
      recursive   Optional. Specifies if the recursive mode is set (added in PHP 5)
      context Optional. Specifies the context of the file handle. Context is a set of options that can modify the behavior of a stream (added in PHP 5)
               */
function global_mkdir($parent_id){
    $path_to_dir = BASE_PATH."\\includes\\docs\\admin_".$parent_id;
    if (!file_exists($path_to_dir)) {
        mkdir($path_to_dir, 0777, true);
    }
}

function global_fwrite($parent_id,$doc_id,$data,$file_type='json'){
    $filename =  BASE_PATH."\\includes\\docs\\admin_".$parent_id."\\doc_".$doc_id.".".$file_type.".php";
    $fp = fopen($filename, "w") or die("Couldn't open $filename");

    $final_data = " <?php header('Access-Control-Allow-Origin: *'); header('Content-type: application/json'); ?>";
 $final_data .= $data;

    fwrite($fp,  $final_data);
    fclose($fp);
}
function global_timestamp(){
     $time =  date( "Y-m-d H:i:s");
     return $time;
}
