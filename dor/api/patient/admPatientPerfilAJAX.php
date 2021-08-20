<script>
    //update delete e insert

    function fntUpdate() {
        valor = document.getElementById("DocPersonal").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('USUARIO', 'Por favor complete el siguiente campo:No. De Documento Personal');
            return false;
        }

        valor = document.getElementById("Name").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:Nombre');
            return false;
        }

        valor = document.getElementById("LastName").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:Apelllido');
            return false;
        }

        valor = document.getElementById("Sex").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:Sexo');
            return false;
        }

        valor = document.getElementById("Mail").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:Correo');
            return false;
        }

        valor = document.getElementById("Tell").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:telefono');
            return false;
        }

        valor = document.getElementById("Adress").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:Direccion');
            return false;
        }

        valor = document.getElementById("FullName").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:Nombre Completo');
            return false;
        }

        valor = document.getElementById("Cell").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:Telefono emergencia');
            return false;
        }

        valor = document.getElementById("Email").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:Correo emergencia');
            return false;
        }

        alertify.confirm('USUARIO', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "patientPerfilInfo.php?ajax=true&validaciones=update",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            alertify.alert('USUARIO', 'Datos cargados correctamente');
                            $('#Tabla').load('doctorsPatient.php?validaciones=busqueda_patient');
                            document.getElementById("loading-screen").style.display = "none";
                            //location.reload(); 
                        }
                    } else {
                        alertify.alert('USUARIO', 'Datos no cargados correctamente!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    function fntDibujoDropDep() {

        //alert(strPais + "                                  strPais");

        $.ajax({

            url: "patientPerfilInfo.php?validaciones=dibujo_dropdow_dep",
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

            url: "patientPerfilInfo.php?validaciones=dibujo_dropdow_mun",
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


    function fntDibujoTablaPatientAdm() {
        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "patientPerfilInfo.php?validaciones=busqueda_patient_adm",
            data: {},
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla_patient_adm").html("");
                $("#Tabla_patient_adm").html(data);
                document.getElementById("loading-screen").style.display = "none";

                var strId = $("#hidId_").val();
                var strDPI = $("#hidDpi_").val();
                var strName = $("#hidName_").val();
                var strLastName = $("#hidLasName_").val();
                var strSex = $("#hidSex_").val();
                var strReg = $("#hidReg_").val();
                var strDis = $("#hidDis_").val();
                var strZona = $("#hidZona_").val();
                var strMail = $("#hidMail_").val();
                var strCell = $("#hidCell_").val();
                var strAdress = $("#hidAdress_").val();
                var strFullName = $("#hidFullName_").val();
                var strTell = $("#hidTell_").val();
                var strEmail = $("#hidEmail_").val();

                // alert(strDPI + "                         strDPI");

                $("#id").val(strId);
                $("#DocPersonal").val(strDPI);
                $("#Hid_DocPersonal").val(strDPI);
                $("#Name").val(strName);
                $("#LastName").val(strLastName);
                $("#Sex").val(strSex);

                $("#Region").val(strReg);
                $("#hid_region").val(strReg);
                $("#hid_distrito").val(strDis);
                $("#distrito").val(strDis);

                $("#Mail").val(strMail);
                $("#Zona").val(strZona);
                $("#Tell").val(strCell);
                $("#Adress").val(strAdress);
                $("#FullName").val(strFullName);
                $("#Cell").val(strTell);
                $("#Email").val(strEmail);


                fntDibujoDropDep()

                return false;
            }
        });

    };

    $(function() {

        $('#form-perfil').on('change', 'input[type="file"]', function(event) {
            let extensionesPermitidas = [
                "jpeg", "jpg", "png"
            ]
            let id = String($(this).attr('id'))

            let file_data = $(this).prop('files')[0];
            let form_data = new FormData();
            if (file_data.name) {
                let strExtension = ''
                let TMP = file_data.type.indexOf('/') !== -1 ? file_data.type.split('/') : file_data.type
                strExtension = TMP
                if (typeof(TMP) == "object")
                    strExtension = TMP[TMP.length - 1]
                if ($('#' + id).hasClass('tbl-btn-upload') || extensionesPermitidas.indexOf(strExtension) !== -1) {
                    form_data.append('getPrecargarArchivos', 1);
                    form_data.append('archivo', file_data);
                    form_data.append('nombre_archivo', file_data.name);
                    form_data.append('extension', strExtension);
                    $.ajax({
                        url: "patientPerfilInfo.php?validaciones=proces_img",
                        dataType: 'json',
                        async: true,
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function(data) {
                            if (String(data.respuesta) !== "false") {
                                let strName = file_data.name.substr(0, file_data.name.indexOf('.'));
                                $('#img_' + id).attr('src', data.respuesta);
                                $('#img_' + id).attr('name', strName);
                            } else {
                                let mensaje = " correcta"
                                if (extensionesPermitidas.length > 0)
                                    mensaje = ": " + extensionesPermitidas.join(",")
                                $('#img_' + id).attr('src', "http://placehold.it/512x512");
                            }
                        },
                        error: function() {
                            let mensaje = " correcta"
                            if (extensionesPermitidas.length > 0)
                                mensaje = ": " + extensionesPermitidas.join(",")
                            $('#img_' + id).attr('src', "http://placehold.it/512x512");
                        }
                    })
                } else {
                    let mensaje = " correcta"
                    if (extensionesPermitidas.length > 0)
                        mensaje = ": " + extensionesPermitidas.join(",")
                    $('#img_' + id).attr('src', "http://placehold.it/512x512");
                }
            } else {
                $('#img_' + id).attr('src', "http://placehold.it/512x512");
            }
        });

    })
    window.addEventListener('load', fntDibujoTablaPatientAdm, false)

    window.addEventListener('load', fntDibujoDropDep, false)
</script>