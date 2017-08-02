<?php
//mkdir()
 $path_to_dir = BASE_PATH."\\includes\\docs\\docs_".$documents->get_parent_id();
 if (!file_exists($path_to_dir)) {
    mkdir($path_to_dir, 0777, true);
}
         
         