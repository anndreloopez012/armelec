<script>
    //update delete e insert
    function fntInsert() {

        alertify.confirm('Tus Pedidos', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "pharmacistsOrders.php?ajax=true&validaciones=insert",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('pharmacistsOrders.php?validaciones=busqueda_table');
                            alertify.alert('Tus Pedidos', 'Datos cargados correctamente');
                            document.getElementById("loading-screen").style.display = "none";
                            //location.reload(); 
                        }
                    } else {
                        alertify.alert('Tus Pedidos', 'no se pudo completar!');
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

        alertify.confirm('Tus Pedidos', 'Seguro que desea continuar? ', function() {
            var datos = $('#formDataPed').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "pharmacistsOrders.php?ajax=true&validaciones=update",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#Tabla').load('pharmacistsOrders.php?validaciones=busqueda_table');
                            alertify.alert('Tus Pedidos', 'Datos cargados correctamente');
                            //location.reload(); 
                            document.getElementById("loading-screen").style.display = "none";

                        }
                    } else {
                        alertify.alert('Tus Pedidos', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };


    function fntSelectUpdate(intParametro) {

        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strId = $("#hidId_" + intParametro).val();
            $("#far_ord_id").val(strId);
        }

        fntUpdate()
    }

    //validar codigo 
    function fntValidacioncodigo() {

        var objnombre = document.getElementById("nombre");
        var intnombre = objnombre.value * 1;

        if (!isNaN(intnombre) && (intcnombre > 0)) {

            $.ajax({

                url: "pharmacistsOrders.php?validaciones=validacion_nombre&nombre=" + intnombre,
                async: true,
                global: false,

                success: function(data) {

                    if (data == "Y") {
                        alertify.alert('Tus Pedidos', 'este nombre ya esta siendo usado');
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

            url: "pharmacistsOrders.php?validaciones=busqueda_table",
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