<?php

switch ($pais) {
    case "GUT":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFGUTpac user=p0stgr3s_us3r password=[P05tGr5_V15u@lM3d_Db@. options='--client_encoding=UTF8'";
        $tmfPac = pg_connect($conn_string);
        if (!$tmfPac) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection

        break;
    case "DOR":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFDORpac user=p0stgr3s_us3r password=[P05tGr5_V15u@lM3d_Db@. options='--client_encoding=UTF8'";
        $tmfPac = pg_connect($conn_string);
        if (!$tmfPac) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection

        break;
    case "PAN":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFPANpac user=p0stgr3s_us3r password=[P05tGr5_V15u@lM3d_Db@. options='--client_encoding=UTF8'";
        $tmfPac = pg_connect($conn_string);
        if (!$tmfPac) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection

        break;
}
