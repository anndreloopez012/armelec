<script>
    //update delete e insert
    function fntInsert() {

        valor = document.getElementById("ctg_pro_cod").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus Pacientes', 'Por favor complete el siguiente campo:Codigo');
            return false;
        }


        valor = document.getElementById("ctg_pro_desc").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus Pacientes', 'Por favor complete el siguiente campo:Descripcion');
            return false;
        }


        valor = document.getElementById("ctg_pro_labfar").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus Pacientes', 'Por favor complete el siguiente campo:Laboratorio');
            return false;
        }

        valor = document.getElementById("ctg_pro_fecaut").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus Pacientes', 'Por favor complete el siguiente campo:Fecha de Activacion');
            return false;
        }

        valor = document.getElementById("ctg_pro_fecven").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus Pacientes', 'Por favor complete el siguiente campo:Fecha de Vencimiento');
            return false;
        }

        valor = document.getElementById("ctg_pro_psinar").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus Pacientes', 'Por favor complete el siguiente campo:psinar');
            return false;
        }

        alertify.confirm('AVISO', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "cat_product.php?ajax=true&validaciones=proces",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            fntDibujoTabla()
                            alertify.alert('AVISO', 'Datos cargados correctamente');
                            document.getElementById("loading-screen").style.display = "none";
                        }
                    } else {
                        alertify.alert('AVISO', 'no se pudo completar!');
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    function fntEdit() {

        alertify.confirm('AVISO', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "cat_product.php?ajax=true&validaciones=edit",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            fntDibujoTabla()
                            alertify.alert('AVISO', 'Datos actualizados correctamente');
                            document.getElementById('edit').style.display = 'none';
                            document.getElementById('save').style.display = 'block';
                            document.getElementById("loading-screen").style.display = "none";
                        }
                    } else {
                        alertify.alert('AVISO', 'no se pudo completar!');
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    function fntDelete() {

        alertify.confirm('AVISO', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "cat_product.php?ajax=true&validaciones=delete",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            fntDibujoTabla()
                            alertify.alert('AVISO', 'Datos eliminado correctamente');
                            document.getElementById("loading-screen").style.display = "none";
                        }
                    } else {
                        alertify.alert('AVISO', 'no se pudo completar!');
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    function fntDibujoTabla() {
        var $strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "cat_product.php?validaciones=busqueda_tabla",
            data: {
                Search: $strSearch,
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

    function fntDibujoTablaPri() {

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "cat_product.php?validaciones=tabla_prinActiv",
            data: {},
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#TablaPinAct").html("");
                $("#TablaPinAct").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTablaLab() {

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "cat_product.php?validaciones=tabla_labo",
            data: {},
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#TablaLaboratory").html("");
                $("#TablaLaboratory").html(data);

                $('#labFar').modal('show')

                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntValCodigo() {

        var datos = $('#formData').serialize();
        //alert(datos);
        //return false;
        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "cat_product.php?ajax=true&validaciones=val_codigo",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.alert('AVISO', 'Esta codigo ya existe!');
                        document.getElementById("ctg_fac_razsoc").value = "";

                    }
                } else {
                    if (r.status == 0) {
                        alertify.set('notifier', 'position', 'bottom-right');
                        alertify.success('Codigo : Disponible');
                    }
                }
            }
        });

        return false;
    };


    window.addEventListener('load', fntDibujoTabla, false)
    window.addEventListener('load', fntDibujoTablaPri, false)
</script>