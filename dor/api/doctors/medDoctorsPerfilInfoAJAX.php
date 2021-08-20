<script>
    //update delete e insert

    function fntUpdate() {

        valor = document.getElementById("colegiado_").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:colegiado');
            return false;
        }

        valor = document.getElementById("nombre_").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:nombre');
            return false;
        }

        valor = document.getElementById("apellido_").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:apellido');
            return false;
        }

        valor = document.getElementById("direccion_").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:direccion');
            return false;
        }

        valor = document.getElementById("tell_").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:telefono');
            return false;
        }

        alertify.confirm('Tu Perfil', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsPerfilInfo.php?ajax=true&validaciones=update",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            alertify.alert('Aviso', 'Datos cargados correctamente');
                            //location.reload(); 
                            document.getElementById("loading-screen").style.display = "none";
                        }
                    } else {
                        alertify.alert('Aviso', 'Datos no cargados correctamente!');
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

        var objcolegiado = document.getElementById("colegiado_");
        var intcolegiado = objcolegiado.value * 1;

        if (!isNaN(intcolegiado) && (intcolegiado > 0)) {

            $.ajax({

                url: "doctorsPerfilInfo.php?validaciones=validacion_colegiado&colegiado=" + intcolegiado,
                async: true,
                global: false,

                success: function(data) {

                    if (data == "Y") {
                        alertify.alert('Aviso', 'this colegiado is already being used');
                    }
                }
            });

        }
        return false;
    }

    function fntDibujoDropDep() {

        //alert(strPais + "                                  strPais");

        $.ajax({

            url: "doctorsPerfilInfo.php?validaciones=dibujo_dropdow_dep",
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

            url: "doctorsPerfilInfo.php?validaciones=dibujo_dropdow_mun",
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

    ///////////////////////////////////////IMG PROCES///////////////////////////////////
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
                        url: "doctorsPerfilInfo.php?validaciones=proces_img",
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

    window.addEventListener('load', fntDibujoDropDep, false)
</script>