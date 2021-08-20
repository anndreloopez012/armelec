<?php 

// detalles de la conexion
$conn_string = "host=192.99.70.181 port=5432 dbname=IrimsADM user=postgres password=p05tgr35 options='--client_encoding=UTF8'";
 
// establecemos una conexion con el servidor postgresSQL
$rmfAdm = pg_connect($conn_string);
 
// Revisamos el estado de la conexion en caso de errores. 
if(!$rmfAdm) {
echo "Error: No se ha podido conectar a la base de datos\n";
} 
// Close connection
// pg_close($rmfAdm);
 
?>