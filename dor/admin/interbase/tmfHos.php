<?php

switch ($pais) {
    case "GUT":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFGUThos user=postgres password=p05tgr35 options='--client_encoding=UTF8'";
        $tmfHos = pg_connect($conn_string);
        if (!$tmfHos) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection
        // pg_close($rmfAdm);

        break;
    case "DOR":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFDORhos user=postgres password=p05tgr35 options='--client_encoding=UTF8'";
        $tmfHos = pg_connect($conn_string);
        if (!$tmfHos) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection
        // pg_close($rmfAdm);

        break;
}
