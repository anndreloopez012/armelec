<script>
    function fntInsertHosp() {

        var datos = $('#formDataHosp').serialize();
        //alert(datos);
        //return false;
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "globalHospital.php?ajax=true&validaciones=insert_hosp",
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

    function fntDibujoTablaHospServ() {

        var strSearch = $("#SearchServ").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "globalHospital.php?validaciones=table_hosp_serv",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableHospServ").html("");
                $("#tableHospServ").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };
    /////////////////////////// TABLAS SEGUNDO NIVEL///////////////////////////////


    function fntDibujoTablaHosp() {

        var strFilterHosp = $("#filterServ").val();
        var strSearch = $("#SearchHosp").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "globalHospital.php?validaciones=table_hosp",
            data: {
                Search: strSearch,
                strFilterHosp: strFilterHosp,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableHospital").html("");
                $("#tableHospital").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };


    // window.addEventListener('load', fntSessionVac, false)
    window.addEventListener('load', fntDibujoTablaHospServ, false)
</script>