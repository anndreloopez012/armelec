<?php

$conn_string = "host=174.142.204.91 port=5432 dbname=TMFweb user=postgres password=p05tgr35 options='--client_encoding=UTF8'";
$tmfWeb = pg_connect($conn_string);
if (!$tmfWeb) {
    echo "Error: No se ha podido conectar a la base de datos\n";
} 
// Close connection
// pg_close($rmfAdm);
