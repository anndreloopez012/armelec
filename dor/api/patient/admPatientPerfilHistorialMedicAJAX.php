<script>
    //update delete e insert
    function fntInsert() {
        valor = document.getElementById("Medico").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Historial Medico', 'Por favor complete el siguiente campo:Medico');
            return false;
        }


        alertify.confirm('Historial Medico', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "patientPerfilHistorialMedic.php?ajax=true&validaciones=insert",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('patientPerfilHistorialMedic.php?validaciones=busqueda_table');
                            fnthistorialMedicMostrarOcultar()
                            alertify.alert('Historial Medico', 'Datos cargados correctamente');
                            //location.reload(); 
                            document.getElementById("loading-screen").style.display = "none";
                        }
                    } else {
                        alertify.alert('Historial Medico', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };


    function fntDibujoTabla() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "patientPerfilHistorialMedic.php?validaciones=busqueda_table",
            data: {
                Search: strSearch,
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

    function fntDibujoTablaDoctor() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "patientPerfilHistorialMedic.php?validaciones=busqueda_table_doctor",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#TablaDoctor").html("");
                $("#TablaDoctor").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    //////////////////////////////////////////////////////////////ORDENES /////////////////////////////////////////

    function fntDibujoTablaOrderMedicament() {
        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "patientPerfilHistorialMedic.php?validaciones=busqueda_table_order_medicament",
            data: {
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#TablaMedicamentosOrder").html("");
                $("#TablaMedicamentosOrder").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTablaOrderHospital() {
        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "patientPerfilHistorialMedic.php?validaciones=busqueda_table_order_hospital",
            data: {
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#TablaHospitalesOrder").html("");
                $("#TablaHospitalesOrder").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTablaOrderFarmac() {
        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "patientPerfilHistorialMedic.php?validaciones=busqueda_table_order_farmac",
            data: {
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#TablaFarmaceuticasOrder").html("");
                $("#TablaFarmaceuticasOrder").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTablaOrderVac() {
        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "patientPerfilHistorialMedic.php?validaciones=busqueda_table_order_vac",
            data: {
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#TablaVacunasOrder").html("");
                $("#TablaVacunasOrder").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    window.addEventListener('load', fntDibujoTablaDoctor, false)
    window.addEventListener('load', fntDibujoTabla, false)

    window.addEventListener('load', fntDibujoTablaOrderMedicament, false)
    window.addEventListener('load', fntDibujoTablaOrderHospital, false)
    window.addEventListener('load', fntDibujoTablaOrderFarmac, false)
    window.addEventListener('load', fntDibujoTablaOrderVac, false)
</script>