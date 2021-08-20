<script>
    function fntUpdate() {

        alertify.confirm('Tus Asociados Preferidos', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "patientPreferredPartners.php?ajax=true&validaciones=update",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            //$('#formData')[0].reset();
                            //$('#Tabla').load('doctorsDiet.php?validaciones=busqueda_table');
                            alertify.alert('Tus Asociados Preferidos', 'Datos cargados correctamente');
                            //location.reload(); 
                            document.getElementById("loading-screen").style.display = "none";
                        }
                    } else {
                        $('#formData')[0].reset();
                        alertify.alert('Tus Asociados Preferidos', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });

        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    function fntPrintFar() {

        var datos = $('#formData').serialize();
        //alert(datos);
        //return false;

        var objCode = document.getElementById("hid_far");
        var intCode = objCode.value * 1;

        if (!isNaN(intCode) && (intCode > 0)) {

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "patientPreferredPartners.php?ajax=true&validaciones=print_table_far&code=" + intCode,
                success: function(r) {

                }
            });
        }

        return false;
    };

    function fntDibujoTablaFar() {

        var strSearch = $("#SearchFar").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "patientPreferredPartners.php?validaciones=busqueda_table_far",
            data: {
                SearchFar: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla").html("");
                $("#Tabla").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTablaLab() {

        var strSearch = $("#SearchLab").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "patientPreferredPartners.php?validaciones=busqueda_table_lab",
            data: {
                SearchLab: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#TablaTwo").html("");
                $("#TablaTwo").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTablaHosp() {

        var strSearch = $("#SearchHosp").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "patientPreferredPartners.php?validaciones=busqueda_table_hosp",
            data: {
                SearchHosp: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#TablaThre").html("");
                $("#TablaThre").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };


    window.addEventListener('load', fntPrintFar, false)

    window.addEventListener('load', fntDibujoTablaFar, false)
    window.addEventListener('load', fntDibujoTablaLab, false)
    window.addEventListener('load', fntDibujoTablaHosp, false)
</script>