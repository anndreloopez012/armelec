<script>
    //update delete e insert
    function fntInsert() {
        valor = document.getElementById("codigo").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:codigo');
            return false;
        }
        valor = document.getElementById("Nombres").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:Nombre');
            return false;
        }

        valor = document.getElementById("date").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:Fecha');
            return false;
        }

        valor = document.getElementById("Estado").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:Estado');
            return false;
        }

        document.getElementById("loading-screen").style.display = "block";
        alertify.confirm('Aviso', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsVaccine.php?ajax=true&validaciones=insert",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('doctorsVaccine.php?validaciones=busqueda_tableVaccine');
                            alertify.alert('Aviso', 'Datos cargados correctamente');
                            document.getElementById("loading-screen").style.display = "none";
                            //location.reload(); 
                        }
                    } else {
                        alertify.alert('Aviso', 'no se pudo completar!');
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
        valor = document.getElementById("codigo").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:codigo');
            return false;
        }
        document.getElementById("loading-screen").style.display = "block";
        alertify.confirm('Aviso', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsVaccine.php?ajax=true&validaciones=update",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            alertify.alert('Aviso', 'Datos cargados correctamente');
                            document.getElementById("loading-screen").style.display = "none";
                            //location.reload(); 
                        }
                    } else {
                        alertify.alert('Aviso', 'no se pudo completar!');
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
        alertify.confirm('Aviso', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";
            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsVaccine.php?ajax=true&validaciones=delete",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            alertify.alert('Aviso', 'Datos cargados correctamente');
                            document.getElementById("loading-screen").style.display = "none";
                            //location.reload(); 
                        }
                    } else {
                        alertify.alert('Aviso', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    //validar codigo 
    function fntValidacioncodigo() {

        var objcodigo = document.getElementById("codigo");
        var intcodigo = objcodigo.value * 1;

        if (!isNaN(intcodigo) && (intcodigo > 0)) {
            $.ajax({

                url: "doctorsVaccine.php?validaciones=validacion_codigo&codigo=" + intcodigo,
                async: true,
                global: false,

                success: function(data) {

                    if (data == "Y") {
                        alertify.alert('Aviso', 'this codigo is already being used');
                    }
                }
            });

        }
        return false;
    }

    function fntDibujoTabla() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";
        $.ajax({

            url: "doctorsVaccine.php?validaciones=busqueda_table",
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