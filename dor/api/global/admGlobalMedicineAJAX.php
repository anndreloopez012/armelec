<script>  

    //////////////////////////////////////////////////// INSERTS SESSIONES //////////////////////////////////////////////////////////

    function fntInsertMed() {

            var datos = $('#formDataMed').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "globalMedicine.php?ajax=true&validaciones=insert_med",
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
    function fntDibujoTablaMed() {

        var strSearch = $("#SearchMed").val();


        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "globalMedicine.php?validaciones=table_med",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableMed").html("");
                $("#tableMed").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    /////////////////////////// TABLAS SEGUNDO NIVEL///////////////////////////////
    function fntDibujoTablaMedFar() {

        var strFilterFar = $("#filterMed").val();
        var strSearch = $("#SearchFar").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "globalMedicine.php?validaciones=table_med_far",
            data: {
                Search: strSearch,
                strFilterFar: strFilterFar,

            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableMedFar").html("");
                $("#tableMedFar").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

   // window.addEventListener('load', fntSessionVac, false)
    window.addEventListener('load', fntDibujoTablaMed, false)
</script>