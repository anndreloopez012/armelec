<?php

switch ($pais) {
    case "GUT":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFGUTfar user=postgres password=p05tgr35 options='--client_encoding=UTF8'";
        $tmfFar = pg_connect($conn_string);
        if (!$tmfFar) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection
        // pg_close($rmfAdm);

        break;
    case "DOR":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFDORfar user=postgres password=p05tgr35 options='--client_encoding=UTF8'";
        $tmfFar = pg_connect($conn_string);
        if (!$tmfFar) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection
        // pg_close($rmfAdm);

        break;
}
