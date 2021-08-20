<script>
    function fntInsert() {
        valor = document.getElementById("DocPersonal").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus Pacientes', 'Por favor complete el siguiente campo:No. De Documento Personal');
            return false;
        }

        valor = document.getElementById("Name").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus Pacientes', 'Por favor complete el siguiente campo:Nombres');
            return false;
        }

        valor = document.getElementById("LastName").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus Pacientes', 'Por favor complete el siguiente campo:Apellidos');
            return false;
        }

        valor = document.getElementById("Mail").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus Pacientes', 'Por favor complete el siguiente campo:Correo');
            return false;
        }

        alertify.confirm('Tus Pacientes', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsPatient.php?ajax=true&validaciones=insert",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('doctorsPatient.php?validaciones=busqueda_patient');
                            alertify.alert('Tus Pacientes', 'Datos cargados correctamente');
                            document.getElementById("loading-screen").style.display = "none";
                            //location.reload(); 
                        }
                    } else {
                        alertify.alert('Tus Pacientes', 'no se pudo completar!');
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
        valor = document.getElementById("DocPersonal").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Tus Pacientes', 'Por favor complete el siguiente campo:No. De Documento Personal');
            return false;
        }

        alertify.confirm('Tus Pacientes', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsPatient.php?ajax=true&validaciones=update",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 2) {
                            alertify.alert('Tus Pacientes', 'Datos cargados correctamente');
                            $('#Tabla').load('doctorsPatient.php?validaciones=busqueda_patient');
                            document.getElementById("loading-screen").style.display = "none";
                            //location.reload(); 
                        }
                    } else {
                        alertify.alert('Tus Pacientes', 'no se pudo completar!');
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

        alertify.confirm('Tus Pacientes', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsPatient.php?ajax=true&validaciones=delete",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            alertify.alert('Tus Pacientes', 'Datos cargados correctamente');
                            $('#Tabla').load('doctorsPatient.php?validaciones=busqueda_patient');
                            $('#formData')[0].reset();
                            document.getElementById("loading-screen").style.display = "none";
                            //location.reload(); 
                        }
                    } else {
                        alertify.alert('Tus Pacientes', 'no se pudo completar!');
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
            // alert(strDPI + "                         strDPI");
            $("#id").val(strId);
        }
        fntDelete()
    }

    //validar codigo 
    function fntValidacioncodigo() {

        var objcolegiado = document.getElementById("colegiado_");
        var intcolegiado = objcolegiado.value * 1;

        if (!isNaN(intcolegiado) && (intcolegiado > 0)) {

            $.ajax({

                url: "doctorsPatient.php?validaciones=validacion_colegiado&colegiado=" + intcolegiado,
                async: true,
                global: false,

                success: function(data) {

                    if (data == "Y") {
                        alertify.alert('Tus Pacientes', 'this colegiado is already being used');
                    }
                }
            });

        }
        return false;
    }

    function fntDibujoDropDep() {

        //alert(strPais + "                                  strPais");

        $.ajax({

            url: "doctorsPatient.php?validaciones=dibujo_dropdow_dep",
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

            url: "doctorsPatient.php?validaciones=dibujo_dropdow_mun",
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

    function fntDibujoTablaPatientMed() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorsPatient.php?validaciones=busqueda_patient",
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

    function fntDibujoTablaPatientAdm() {

        var strSearch = $("#SearchAdm").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorsPatient.php?validaciones=busqueda_patient_adm",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla_patient_adm").html("");
                $("#Tabla_patient_adm").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntValDpi() {

        var strSearch = $("#DocPersonal").val();
        //alert(datos);
        //return false;
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({
            type: "POST",
            data: {
                Search: strSearch,
            },
            dataType: 'json',
            url: "doctorsPatient.php?ajax=true&validaciones=val_dpi",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        document.getElementById("loading-screen").style.display = "none";

                        alertify.set('notifier', 'position', 'bottom-right');
                        alertify.alert('Aviso!', 'Este dpi ya se encuentra en uso!');
                        alertify.success('Numero DPI : No disponible');
                        document.getElementById("DocPersonal").value = "";
                    }
                } else {
                    if (r.status == 0) {
                        document.getElementById("loading-screen").style.display = "none";
                        alertify.set('notifier', 'position', 'bottom-right');
                        alertify.success('Numero DPI : disponible');
                    }
                }
            }
        });

        return false;
    };

    function fntValMail() {

        var strSearch = $("#Mail").val();
        //alert(datos);
        //return false;
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({
            type: "POST",
            data: {
                Search: strSearch,
            },
            dataType: 'json',
            url: "doctorsPatient.php?ajax=true&validaciones=val_mail",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        document.getElementById("loading-screen").style.display = "none";

                        alertify.set('notifier', 'position', 'bottom-right');
                        alertify.alert('Aviso!', 'Este correo ya se encuentra en uso!');
                        alertify.success('Email : No disponible');
                        document.getElementById("Mail").value = "";
                    }
                } else {
                    if (r.status == 0) {
                        document.getElementById("loading-screen").style.display = "none";
                        alertify.set('notifier', 'position', 'bottom-right');
                        alertify.success('Email : disponible');
                    }
                }
            }
        });

        return false;
    };

    window.addEventListener('load', fntDibujoDropDep, false)
    window.addEventListener('load', fntDibujoTablaPatientAdm, false)
    window.addEventListener('load', fntDibujoTablaPatientMed, false)
</script>