<script>
    //////////////////////////////////////////////////// INSERTS SESSIONES //////////////////////////////////////////////////////////
    function fntInsertLab() {

        var datos = $('#formDataLab').serialize();
        //alert(datos);
        //return false;
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "globalLaboratory.php?ajax=true&validaciones=insert_lab",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        $('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload(); 
                        document.getElementById("loading-screen").style.display = "none";
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });
        return false;
    };


    ////////////////////////////////TABLAS PRIMER NIVEL//////////////////////////////////

    function fntDibujoTablaLabExa() {

        var strSearch = $("#SearchExa").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "globalLaboratory.php?validaciones=table_lab_exa",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableLab").html("");
                $("#tableLab").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };


    /////////////////////////// TABLAS SEGUNDO NIVEL///////////////////////////////


    function fntDibujoTablaLab() {

        var strFilterLab = $("#filterExa").val();
        var strSearch = $("#SearchLab").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "globalLaboratory.php?validaciones=table_lab",
            data: {
                Search: strSearch,
                strFilterLab: strFilterLab,

            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableLabExa").html("");
                $("#tableLabExa").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    //////////////TABLAS DE VARIABLES SESSION ////////////////////////////////////////////////////////

    // window.addEventListener('load', fntSessionVac, false)
    window.addEventListener('load', fntDibujoTablaLab, false)
</script>