<?php
define( "PDO_DSN", "mysql:dbname=e1745; host=localhost; charset=utf8" );
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$PDO = new PDO(PDO_DSN, 'root', $password, $options);

$sql="SELECT * FROM report_mn ORDER bY DTIME DESC LIMIT 1";
$pre = $PDO->prepare($sql);
$pre->execute();
$data = array();

while($row = $pre->fetch(2)){
    $data[]= $row;
}
echo json_encode($data[0]);
?>
