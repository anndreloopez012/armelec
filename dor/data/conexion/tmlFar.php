<?php

switch ($pais) {
    case "GUT":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFGUTfar user=p0stgr3s_us3r password=[P05tGr5_V15u@lM3d_Db@. options='--client_encoding=UTF8'";
        $tmfFar = pg_connect($conn_string);
        if (!$tmfFar) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection
        // pg_close($rmfAdm);

        break;
    case "DOR":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFDORfar user=p0stgr3s_us3r password=[P05tGr5_V15u@lM3d_Db@. options='--client_encoding=UTF8'";
        $tmfFar = pg_connect($conn_string);
        if (!$tmfFar) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection
        // pg_close($rmfAdm);

        break;
    case "PAN":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFPANfar user=p0stgr3s_us3r password=[P05tGr5_V15u@lM3d_Db@. options='--client_encoding=UTF8'";
        $tmfFar = pg_connect($conn_string);
        if (!$tmfFar) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection
        // pg_close($rmfAdm);

        break;
}
