<?php

switch ($pais) {
    case "GUT":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFGUThos user=p0stgr3s_us3r password=[P05tGr5_V15u@lM3d_Db@. options='--client_encoding=UTF8'";
        $tmfHos = pg_connect($conn_string);
        if (!$tmfHos) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection
        // pg_close($rmfAdm);

        break;
    case "DOR":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFDORhos user=p0stgr3s_us3r password=[P05tGr5_V15u@lM3d_Db@. options='--client_encoding=UTF8'";
        $tmfHos = pg_connect($conn_string);
        if (!$tmfHos) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection
        // pg_close($rmfAdm);

        break;
    case "PAN":

        $conn_string = "host=174.142.204.91 port=5432 dbname=TMFPANhos user=p0stgr3s_us3r password=[P05tGr5_V15u@lM3d_Db@. options='--client_encoding=UTF8'";
        $tmfHos = pg_connect($conn_string);
        if (!$tmfHos) {
            echo "Error: No se ha podido conectar a la base de datos\n";
        }
        // Close connection
        // pg_close($rmfAdm);

        break;
}
