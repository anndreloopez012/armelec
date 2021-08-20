<script>
    //update delete e insert
    function fntInsert() {
        valor = document.getElementById("nombre").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus Dietas', 'Por favor complete el siguiente campo:Nombre Dieta');
            return false;
        }


        alertify.confirm('Tus Dietas', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsDiet.php?ajax=true&validaciones=insert",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('doctorsDiet.php?validaciones=busqueda_table');
                            alertify.alert('Tus Dietas', 'Datos cargados correctamente');
                            document.getElementById("loading-screen").style.display = "none";
                            //location.reload(); 
                        }
                    } else {
                        alertify.alert('Tus Dietas', 'no se pudo completar!');
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
        valor = document.getElementById("nombre").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus Dietas', 'Por favor complete el siguiente campo:Nombre Dieta');
            return false;
        }

        alertify.confirm('Tus Dietas', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsDiet.php?ajax=true&validaciones=update",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#Tabla').load('doctorsDiet.php?validaciones=busqueda_table');
                            alertify.alert('Tus Dietas', 'Datos cargados correctamente');
                            //location.reload(); 
                            document.getElementById("loading-screen").style.display = "none";
                            document.getElementById('form_diet').style.display = 'inline';
                            document.getElementById('tab_diet').style.display = 'inline';
                            document.getElementById('formDiet').style.display = 'none';
                            document.getElementById('diet').style.display = 'block';
                        }
                    } else {
                        alertify.alert('Tus Dietas', 'no se pudo completar!');
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

        alertify.confirm('Tus Dietas', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsDiet.php?ajax=true&validaciones=delete",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('doctorsDiet.php?validaciones=busqueda_table');
                            alertify.alert('Tus Dietas', 'Datos cargados correctamente');
                            document.getElementById("loading-screen").style.display = "none";
                            //location.reload(); 
                        }
                    } else {
                        alertify.alert('Tus Dietas', 'no se pudo completar!');
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
            var strId = $("#hidId_" + intParametro).val();
            $("#idDiet").val(strId);
        }

        fntDelete()
    }

    //validar codigo 
    function fntValidacioncodigo() {

        var objnombre = document.getElementById("nombre");
        var intnombre = objnombre.value * 1;

        if (!isNaN(intnombre) && (intcnombre > 0)) {

            $.ajax({

                url: "doctorsDiet.php?validaciones=validacion_nombre&nombre=" + intnombre,
                async: true,
                global: false,

                success: function(data) {

                    if (data == "Y") {
                        alertify.alert('Tus Dietas', 'este nombre ya esta siendo usado');
                    }
                }
            });

        }
        return false;
    }

    function fntDibujoTabla() {

        var strSearch = $("#Search").val();
        var strCategori = $("#categori").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorsDiet.php?validaciones=busqueda_table",
            data: {
                categori: strCategori,
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