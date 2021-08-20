<?PHP

//VARIABLES GLOBALES
$pais = 'GUT';

//variable de pais de instalacion de aplicacion
//$paisName = 'Republica Dominicana';

//filtros para dropdown
//$paisDrop = 'DOR';

//idioma app
//$lan = 'ESP';

//encript
//$arrInfo["datos"] = utf8_encode($pais);
//$json = json_encode($arrInfo);
//$data = $json;
//$strEncript =  encrypt($data, $key);
//session_start();

$date = date("Y-m-d");

$key = '[W1r3Mo0ga@_[V15U@Lm3D_[R05@ltA';

function encrypt($data, $key)
{
    return strtoupper(bin2hex(openssl_encrypt($data, 'aes-128-ecb', $key, OPENSSL_PKCS1_PADDING)));
}

function decrypt($data, $key)
{
    return openssl_decrypt(hex2bin(($data)), 'aes-128-ecb', $key, OPENSSL_PKCS1_PADDING);
}


//encript cr
define("KEY", "develoteca");
define("COD", "aes-128-ECB");

function rem_special_caract($strString, $boolCodigo = false)
{
    $strReturn = "";

    if ($boolCodigo) {

        $strReturn = str_replace('- ', '', $strString);
        $strReturn = str_replace(' -', '', $strReturn);
        $strReturn = str_replace('-', '', $strReturn);
        $strReturn = str_replace('_', '', $strReturn);
        $strReturn = str_replace(' ', '-', $strReturn);
        $strReturn = str_replace(array("/", " ", "%", ";", ":", "?", "¿", "!", "¡", "(", ")", "&", "%", "$", "#", "\\", "+", "*", "\"", "\'", ",", ".", "~", "{", "}", "[", "]", ">", "<", "!", "¡", "#", "\"", "¨", "°", "|", "'"), "", $strReturn);
        $strReturn = str_replace(
            array("´", "á", "é", "í", "ó", "ú", "ñ", "à", "è", "ì", "ò", "ù", "Á", "É", "Í", "Ó", "Ú", "Ñ", "À", "È", "Ì", "Ò", "Ù", "ä", "ë", "ï", "ö", "ü", "Ä", "Ë", "Ï", "Ö", "Ü", "`", "à", "è", "ì", "ò", "ù", "À", "È", "Ì", "Ò", "Ù", "^", "â", "ê", "î", "ô", "û", "Â", "Ê", "Î", "Ô", "Û", "ç", "Ç"),
            array("", "a", "e", "i", "o", "u", "n", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "c", "C"),
            $strReturn
        );
    } else {

        $strReturn = str_replace(array("/", "%", ";", "'"), "", $strString);
        $strReturn = str_replace(
            array("´", "á", "é", "í", "ó", "ú", "ñ", "à", "è", "ì", "ò", "ù", "Á", "É", "Í", "Ó", "Ú", "Ñ", "À", "È", "Ì", "Ò", "Ù", "ä", "ë", "ï", "ö", "ü", "Ä", "Ë", "Ï", "Ö", "Ü", "`", "à", "è", "ì", "ò", "ù", "À", "È", "Ì", "Ò", "Ù", "^", "â", "ê", "î", "ô", "û", "Â", "Ê", "Î", "Ô", "Û", "ç", "Ç", "Ã³", "Ã¡", "Ã", "*"),
            array("", "a", "e", "i", "o", "u", "n", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "c", "C", "o", "a", "i", "."),
            $strReturn
        );
    }

    return $strReturn;
}


function core_save_file($strInputFileName, $strExtraPath = "", $strAntelacionArchivo = "attach", $intImagenId = 0, $boolDeletePreviousFile = true, $boolAjax = false, $boolNombreOriginal = false)
{
    $strFileName = isset($_FILES[$strInputFileName]['name']) ? $_FILES[$strInputFileName]['name'] : "";

    //drawDebug($strFileName, "strFileName");
    //$strFileName = rem_special_caract(str_replace(" ","_",$strFileName));
    if ($boolAjax)
        //$strFileName = user_input_delmagic($strFileName, true);
        //drawDebug($strFileName, "strFileName");
        $strFileName = rem_special_caract(str_replace(" ", "_", $strFileName));
    $intImagenId = ($intImagenId == 0 || strlen($intImagenId) == 0) ? uniqid() : $intImagenId;

    $strAntelacionArchivo = empty($strAntelacionArchivo) ? "" : rem_special_caract($strAntelacionArchivo);

    //drawDebug($strFileName, "strFileName 222");

    $strPath = "attach/";

    if (!empty($strExtraPath)) {
        if (substr($strExtraPath, -1, 1) != "/") {
            $strExtraPath = $strExtraPath . "/";
        }
    }

    $strPath = $strPath . $strExtraPath;
    $strPathAndFile = "";
    if (!file_exists($strPath)) {
        mkdir($strPath, 0777, true);
    }

    if (file_exists($strPath)) {

        if (isset($_FILES[$strInputFileName]['name']) && $_FILES[$strInputFileName]['error'] == UPLOAD_ERR_OK) {

            $strExtension = pathinfo(strtolower($strFileName), PATHINFO_EXTENSION);

            //drawDebug($strExtension, "strExtension");

            if ($boolNombreOriginal) {
                $strPathInfoFileName = $strPath . rem_special_caract(str_replace(" ", "_", pathinfo($strFileName, PATHINFO_FILENAME)));
                $strPathAndFile .= empty($strAntelacionArchivo) ? "" : $strAntelacionArchivo . "_";
                $strPathAndFile .= $strPathInfoFileName . "_" . $intImagenId . "." . $strExtension;
            } else {
                $strPathAndFile = $strPath . $strAntelacionArchivo . "_" . $intImagenId . "." . $strExtension;
            }

            if ($boolDeletePreviousFile) {
                if (strlen($strPathAndFile) > 0) {
                    if (file_exists($strPathAndFile)) {
                        @chmod($strPathAndFile, 0777);
                        unlink($strPathAndFile);
                    }
                }
            }

            if (!file_exists($strPathAndFile)) {
                @chmod("attach/lib_images/", 0777);
                move_uploaded_file($_FILES[$strInputFileName]["tmp_name"], $strPathAndFile);
                @chmod($strPathAndFile, 0777);
            }
        }
    }

    return $strPathAndFile;
}




?>

