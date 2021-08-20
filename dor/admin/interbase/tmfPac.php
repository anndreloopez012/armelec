<?php

switch ($pais) {
    case "GUT":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFGUTpac user=postgres password=p05tgr35 options='--client_encoding=UTF8'";
        $tmfPac = pg_connect($conn_string);
        if (!$tmfPac) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection

        break;
    case "DOR":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFDORpac user=postgres password=p05tgr35 options='--client_encoding=UTF8'";
        $tmfPac = pg_connect($conn_string);
        if (!$tmfPac) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection

        break;
}
