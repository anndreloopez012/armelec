<script>
    //update delete e insert
    function fntInsert() {
        valor = document.getElementById("Nombres").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus CItas', 'Por favor complete el siguiente campo:Nombres');
            return false;
        }


        alertify.confirm('Tus CItas', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "patientsActiveAppointments.php?ajax=true&validaciones=insert",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('patientsActiveAppointments.php?validaciones=busqueda_table');
                            alertify.alert('Tus CItas', 'Datos cargados correctamente');
                            //location.reload(); 
                            document.getElementById("loading-screen").style.display = "none";
                        }
                    } else {
                        alertify.alert('Tus CItas', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    function fntUpdate() {
        valor = document.getElementById("Nombres").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus CItas', 'Por favor complete el siguiente campo:Nombres');
            return false;
        }

        alertify.confirm('Tus CItas', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "patientsActiveAppointments.php?ajax=true&validaciones=update",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('patientsActiveAppointments.php?validaciones=busqueda_table');
                            alertify.alert('Tus CItas', 'Datos cargados correctamente');
                            //location.reload(); 
                            document.getElementById("loading-screen").style.display = "none";
                        }
                    } else {
                        alertify.alert('Tus CItas', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    function fntDelete() {
        alertify.confirm('Tus CItas', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "patientsActiveAppointments.php?ajax=true&validaciones=delete",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('patientsActiveAppointments.php?validaciones=busqueda_table');
                            alertify.alert('Tus CItas', 'Datos cargados correctamente');
                            //location.reload(); 
                            document.getElementById("loading-screen").style.display = "none";
                        }
                    } else {
                        alertify.alert('Tus CItas', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    function fntSelectDelete(intParametro) {

        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strId = $("#med_id_" + intParametro).val();
            $("#id").val(strId);
        }
        fntDelete()

    }

    function fntDibujoTabla() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "patientsActiveAppointments.php?validaciones=busqueda_table",
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

  
    window.addEventListener('load', fntDibujoTabla, false)
</script>