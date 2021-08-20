<script>
    //update delete e insert
    function fntInsert() {

        alertify.confirm('AVISO', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "usr_perfil_pac.php?ajax=true&validaciones=proces",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            fntDibujoTabla()
                            document.getElementById("Search").focus();
                            document.getElementById('tablaUsuarios').style.display = 'block';
                            document.getElementById('formulario').style.display = 'none';
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
                url: "usr_perfil_pac.php?ajax=true&validaciones=delete",
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

            url: "usr_perfil_pac.php?validaciones=busqueda_tabla",
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

    function fntValUsuario() {

        var datos = $('#formData').serialize();
        //alert(datos);
        //return false;
        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "usr_perfil_pac.php?ajax=true&validaciones=val_usuario",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.alert('AVISO', 'Este usuario ya existe!');
                        document.getElementById("username").value = "";
                    }
                } else {
                    if (r.status == 0) {
                        alertify.set('notifier','position', 'bottom-right');
                        alertify.success('Usuario : Disponible');
                    }
                }
            }
        });

        return false;
    };

    function fntValMail() {

        var datos = $('#registration').serialize();
        //alert(datos);
        //return false;
        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "usr_perfil_pac.php?ajax=true&validaciones=val_mail",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.alert('AVISO', 'Esta email ya existe!');
                        document.getElementById("ctg_pac_email").value = "";
                    }
                } else {
                    if (r.status == 0) {
                        alertify.set('notifier', 'position', 'bottom-right');
                        alertify.success('email : Disponible');
                    }
                }
            }
        });

        return false;
    };

    function fntValEmpresa() {

        var datos = $('#formData').serialize();
        //alert(datos);
        //return false;
        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "usr_perfil_pac.php?ajax=true&validaciones=val_com_empresa",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.alert('AVISO', 'Esta empresa ya existe!');
                        document.getElementById("ctg_fac_razsoc").value = "";

                    }
                } else {
                    if (r.status == 0) {
                        alertify.set('notifier','position', 'bottom-right');
                        alertify.success('Nombre de Empresa : Disponible');
                    }
                }
            }
        });

        return false;
    };

    function fntValSucEmpresa() {

        var datos = $('#formData').serialize();
        //alert(datos);
        //return false;
        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "usr_perfil_pac.php?ajax=true&validaciones=val_suc_empresa",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.alert('AVISO', 'Esta empresa ya existe!');
                        document.getElementById("ctg_fac_razsoc").value = "";

                    }
                } else {
                    if (r.status == 0) {
                        alertify.set('notifier','position', 'bottom-right');
                        alertify.success('Nombre de Empresa : Disponible');
                    }
                }
            }
        });

        return false;
    };

    function fntValContrato() {

        var datos = $('#formData').serialize();
        //alert(datos);
        //return false;
        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "usr_perfil_pac.php?ajax=true&validaciones=val_contrato",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.alert('AVISO', 'Este contrato ya existe!');
                        document.getElementById("ctg_fac_contrato").value = "";

                    }
                } else {
                    if (r.status == 0) {
                        alertify.set('notifier','position', 'bottom-right');
                        alertify.success('Contrato : Disponible');
                    }
                }
            }
        });

        return false;
    };

    function fntDibujoDropDep() {

        //alert(strPais + "                                  strPais");

        $.ajax({

            url: "usr_perfil_pac.php?validaciones=dibujo_dropdow_dep",
            data: {},
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#region").html("");
                $("#region").html(data);
                $('#region').val($('#hid_region').val())
                if ($('#hid_region').val() != '0') {
                    fntDibujoDropMun()
                }
                return false;
            }
        });

    };

    function fntDibujoDropMun() {

        var strReg = $("#region").val();

        //alert(strReg + "                                  strReg");

        $.ajax({

            url: "usr_perfil_pac.php?validaciones=dibujo_dropdow_mun",
            data: {
                region: strReg,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#distrito").html("");
                $("#distrito").html(data);
                $('#distrito').val($('#hid_distrito').val())
                return false;
            }
        });

    };
    window.addEventListener('load', fntDibujoDropDep, false)
    window.addEventListener('load', fntDibujoTabla, false)
</script>