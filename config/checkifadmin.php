<?php
if($row['ID_UserType'] != 1 && $row['ID_UserType'] != 5 ){
header("Location: logout"); 
}
?>