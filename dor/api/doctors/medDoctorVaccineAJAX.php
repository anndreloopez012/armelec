<script>
    //update delete e insert
    function fntInsert() {
        valor = document.getElementById("codigo").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:codigo');
            return false;
        }

        valor = document.getElementById("nombre").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:nombre');
            return false;
        }

        valor = document.getElementById("costo").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:costo');
            return false;
        }

        valor = document.getElementById("precio_venta").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:precio de venta');
            return false;
        }

        valor = document.getElementById("saldo_inicial").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:saldo inicial');
            return false;
        }


        alertify.confirm('Aviso', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

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

        alertify.confirm('Aviso', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsVaccine.php?ajax=true&validaciones=update",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('doctorsVaccine.php?validaciones=busqueda_tableVaccine');
                            alertify.alert('Aviso', 'Datos cargados correctamente');
                            document.getElementById("loading-screen").style.display = "none";
                            //location.reload(); 
                            document.getElementById('vaccine').style.display = 'none';
                            document.getElementById('vaccineList').style.display = 'block';
                            document.getElementById('vaccineBuyList').style.display = 'none';
                            document.getElementById('vaccineShop').style.display = 'none';

                            document.getElementById('buy').style.display = 'inline';
                            document.getElementById('shop').style.display = 'inline';
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

    function fntUpdate_compra() {
        valor = document.getElementById("med_vam_id").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:codigo');
            return false;
        }

        valor = document.getElementById("med_vam_nom").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:nombre');
            return false;
        }

        valor = document.getElementById("med_vam_fac").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:numero de factura');
            return false;
        }

        valor = document.getElementById("med_vam_fac_dt").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:fecha');
            return false;
        }

        valor = document.getElementById("med_vam_costo").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:costo');
            return false;
        }

        valor = document.getElementById("med_vam_uni").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:unidades');
            return false;
        }   


        alertify.confirm('Aviso', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsVaccine.php?ajax=true&validaciones=update_compra",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('doctorsVaccine.php?validaciones=busqueda_tableVaccine');
                            alertify.alert('Aviso', 'Datos cargados correctamente');
                            document.getElementById("loading-screen").style.display = "none";
                            //location.reload(); 
                            document.getElementById('vaccine').style.display = 'none';
                            document.getElementById('vaccineList').style.display = 'block';
                            document.getElementById('vaccineBuyList').style.display = 'none';
                            document.getElementById('vaccineShop').style.display = 'none';

                            document.getElementById('buy').style.display = 'inline';
                            document.getElementById('shop').style.display = 'inline';
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

    function fntSelectDelete(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strId = $("#id_" + intParametro).val();
            // alert(strDPI + "                         strDPI");
            $("#id").val(strId);
        }
        fntDelete()
    }

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
                        alertify.alert('Aviso', 'Este codigo se encuentra en uso!');
                        document.getElementById("codigo").value = "";
                    }
                }
            });

        }
        return false;
    }

    function fntDibujoTablaVaccine() {

        var strSearch = $("#SearchVacine").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorsVaccine.php?validaciones=busqueda_tableVaccine",
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

    function fntDibujoTablavaccineBuyList() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorsVaccine.php?validaciones=busqueda_vaccineBuyList",
            data: {
                Search: strSearch,
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

    function fntHideVaccine() {

        fntDibujoTablavaCompra()
        $('#modalVaccine').modal('show')

    }

    function fntDibujoTablavaCompra() {
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorsVaccine.php?validaciones=selectVaccine",
            data: {
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#TablaSelectVaccine").html("");
                $("#TablaSelectVaccine").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntValCod() {

        var strSearch = $("#codigo").val();
        //alert(datos);
        //return false;
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({
            type: "POST",
            data: {
                Search: strSearch,
            },
            dataType: 'json',
            url: "doctorsVaccine.php?ajax=true&validaciones=val_codigo",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        document.getElementById("loading-screen").style.display = "none";

                        alertify.set('notifier', 'position', 'bottom-right');
                        alertify.alert('Aviso!', 'Este codigo ya se encuentra en uso!');
                        alertify.success('codigo : No disponible');
                        document.getElementById("codigo").value = "";
                    }
                } else {
                    if (r.status == 0) {
                        document.getElementById("loading-screen").style.display = "none";
                        alertify.set('notifier', 'position', 'bottom-right');
                        alertify.success('codigo : disponible');
                    }
                }
            }
        });

        return false;
    };

    window.addEventListener('load', fntDibujoTablaVaccine, false)
    window.addEventListener('load', fntDibujoTablavaccineBuyList, false)
</script>