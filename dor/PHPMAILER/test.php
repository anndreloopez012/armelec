
<?php

$fechaIng = date("Y-m-d");
$newDate = date("d/m/Y", strtotime($fechaIng));
echo $newDate;
