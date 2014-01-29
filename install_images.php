<?php
include('Mysql.php');

if ($handle = opendir('images')) {
/* This is the correct way to loop over the directory. */
$image_id=0;
while (false !== ($file = readdir($handle))) {
  if($file!='.' && $file!='..') {
   $image_id++;
   $images[] = "('".$image_id."','".$file."',0,0,0)";
  }
}
closedir($handle);
}
$query = "INSERT INTO images (image_id,filename,wins,losses,score) VALUES ".implode(',', $images)." ";
if (!mysql_query($query)) {
print mysql_error();
}
else {
print "finished installing your images!";
}

?>