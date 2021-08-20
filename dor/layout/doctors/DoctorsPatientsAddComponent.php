<template>
    <main class="main">
        <div class="content-header">
            <div class="container-fluid">
                <input type="hidden" id="titlePage" v-model="titlePage">
            </div>
        </div>
<!-- INFORMACION PERSONAL ------------------------------------------------------------------------------------------------------------------------->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Informacion Personal</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputDocPer">No. De Documento Personal</label>
                                        <input type="text" id="inputDocPer" class="form-control" placeholder="No. De Documento Personal">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Nombre</label>
                                        <input type="text" id="inputName" class="form-control" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputLastN">Apellido</label>
                                        <input type="text" id="inputLastN" class="form-control" placeholder="Apellido">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputSex">Sexo</label>
                                        <select class="form-control custom-select">
                                        <option selected disabled>Seleccione...</option>
                                        <option>Masculino</option>
                                        <option>Femenino</option>
                                        <option selected>Otros</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputCountry">Pais</label>
                                        <select class="form-control custom-select">
                                        <option selected disabled>Seleccione pais...</option>
                                        <option selected>Guatemala</option>
                                        <option>Honduras</option>
                                        <option>Nicaragua</option>
                                        <option >Salvador</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputReg">Región/Departamento</label>
                                        <select class="form-control custom-select">
                                        <option selected disabled>Seleccione pais...</option>
                                        <option>Guatemala</option>
                                        <option>Xela</option>
                                        <option>Progreso</option>
                                        <option selected>Izabal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputDist">Distrito/Municipio</label>
                                        <select class="form-control custom-select">
                                        <option selected disabled>Seleccione Distrito/Municipio
                                            ...</option>
                                        <option>Guatemala</option>
                                        <option>Xela</option>
                                        <option>Progreso</option>
                                        <option selected>Izabal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputNum">Numero Telefonico</label>
                                        <input type="number" id="inputNum" class="form-control" placeholder="Numero Telefonico">
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
<!-- EN CASO DE EMERGENCIA CONTACTAR --------------------------------------------------------------------------------------------------------------------------------->
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                                <h4>En Caso De Emergencia Contactar</h4><hr>
                                <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="inputName">Nombre</label>
                                        <input type="text" id="inputName" class="form-control" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputClientCompany">Numero Telefonico</label>
                                        <input type="text" id="inputClientCompany" class="form-control" placeholder="Numero Telefonico">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputName">Correo</label>
                                        <input type="text" id="inputName" class="form-control" placeholder="Correo">
                                    </div>
                                </div>
                                <br>
                                <div class="col-sm-12">
                                    <h4>General</h4>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">                                      
                                        <button type="button" class="btn add btn-block btn-outline-primary btn-lg" data-toggle="modal" data-target=".PerfilClinico"><i class="fad fa-briefcase-medical"> </i>Pefil Clinico</button>
                                        <button type="button" class="btn add btn-block btn-outline-primary btn-lg" data-toggle="modal" data-target=".Antecedentes"><i class="fad fa-star-of-life"> </i>Antecedentes</button>
                                        <button type="button" class="btn add btn-block btn-outline-primary btn-lg" data-toggle="modal" data-target=".AsociadosPreferidos"><i class="fad fa-users"> </i>Asociados Preferidos</button>
                                        <button type="button" class="btn add btn-block btn-outline-primary btn-lg" data-toggle="modal" data-target=".GenerarCita"><i class="fad fa-calendar-alt"> </i>Generar Cita</button>
                                        <button type="button" class="btn add btn-block btn-outline-primary btn-lg" data-toggle="modal" data-target=".RegistraConsulta"><i class="fad fa-files-medical"> </i>Registrar Consulta</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!-- PUBLICIDAD -------------------------------------------------------------------------------------------------------------------------------------------------- -->
                <template>
                    <promotion></promotion>
                </template>
            </div>
        </div>
    </section>
<!-- MODALES ---------------------------------------------------------------------------------------------------------------------------------------------------->
<!-- PERFIL CLINICO ---------------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="modal fade bd-example-modal-lg PerfilClinico" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <section class="content col-md-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">General</h3>
                                        <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputName">Alergias</label>
                                            <input type="text" id="inputName" class="form-control" placeholder="Alergias">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName">Padece Enfermedades</label>
                                            <input type="text" id="inputName" class="form-control" placeholder="Padece Enfermedades">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputClientCompany">Toma Algun Medicamento</label>
                                            <input type="text" id="inputClientCompany" class="form-control" placeholder="Toma Algun Medicamento">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-primary collapsed-card">
                                    <div class="card-header">
                                        <h3 class="card-title">Antecedentes</h3>
                                        <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox">
                                                        <label class="form-check-label">Hipertensión</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" >
                                                        <label class="form-check-label">EPOC</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" >
                                                        <label class="form-check-label">Diabetes</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" >
                                                        <label class="form-check-label">Insuficiencia renal, diálisis</label>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox">
                                                        <label class="form-check-label">VIH</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" >
                                                        <label class="form-check-label">TBC</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" >
                                                        <label class="form-check-label">ACV con secuelas </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" >
                                                        <label class="form-check-label">IAM o ICC recientes 6 meses</label>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox">
                                                        <label class="form-check-label">Parkinson</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" >
                                                        <label class="form-check-label">Demencia</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" >
                                                        <label class="form-check-label">Enfermedad Terminal</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" >
                                                        <label class="form-check-label">Otras</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label>Textarea</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Lugar De Nacimiento</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputCountry">Pais</label>
                                            <select class="form-control custom-select">
                                            <option selected disabled>Seleccione pais...</option>
                                            <option>Guatemala</option>
                                            <option>Honduras</option>
                                            <option>Nicaragua</option>
                                            <option selected>Salvador</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputReg">Región/Departamento</label>
                                            <select class="form-control custom-select">
                                            <option selected disabled>Seleccione pais...</option>
                                            <option>Guatemala</option>
                                            <option>Xela</option>
                                            <option>Progreso</option>
                                            <option selected>Izabal</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDist">Distrito/Municipio</label>
                                            <select class="form-control custom-select">
                                            <option selected disabled>Seleccione Distrito/Municipio
                                                ...</option>
                                            <option>Guatemala</option>
                                            <option>Xela</option>
                                            <option>Progreso</option>
                                            <option selected>Izabal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Nacimiento</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputName">Dia</label>
                                            <input type="text" id="inputName" class="form-control" placeholder="Nombre">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName">Mes</label>
                                            <input type="text" id="inputName" class="form-control" placeholder="Correo">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDist">Año</label>
                                            <select class="form-control custom-select">
                                            <option selected disabled>Seleccione Año
                                                ...</option>
                                            <option>1990</option>
                                            <option>1994</option>
                                            <option>1998</option>
                                            <option selected>2000</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputClientCompany">Edad</label>
                                            <input type="number" id="inputClientCompany" class="form-control" placeholder="Deveint Inc">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Info. Medica</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputName">Peso</label>
                                            <input type="text" id="inputName" class="form-control" placeholder="Peso">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName">Altura</label>
                                            <input type="text" id="inputName" class="form-control" placeholder="Altura">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDist">Tipo de Sangre</label>
                                            <select class="form-control custom-select">
                                            <option selected disabled>Seleccione tipo...</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>O</option>
                                            <option selected>O+</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>        
            </div>
        </div>
        </div>
<!-- ANTECEDENTES ---------------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="modal fade bd-example-modal-lg Antecedentes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Antecedentes mórbidos</label>
                                        <textarea rows="3" class="form-control" placeholder="Abarca afecciones, traumatismos, operaciones que el paciente ha tenido durante toda su vida. Se acentúan las patologías más notables"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Antecedentes familiares</label>
                                        <textarea rows="3" class="form-control" placeholder="En esta parte se plasman afecciones que presenten o hayan manifestado familiares muy cercanos por la probabilidad de heredarlas.."></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Antecedentes ginecoobstétricos</label>
                                        <textarea rows="3" class="form-control" placeholder="Menciona datos sobre embarazo, períodos menstruales, entre otros."></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Inmunizaciones</label>
                                        <textarea rows="3" class="form-control" placeholder="Dependiendo el cuadro clínico que tenga el paciente puede ser importante abarcar las vacunaciones que le paciente ha obtenido."></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hábitos</label>
                                        <textarea rows="3" class="form-control" placeholder="Bebidas alcohólicas, tabaquismo, uso de drogas, alimentación, etc."></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Antecedentes sociales y personales</label>
                                        <textarea rows="5" class="form-control" placeholder="En este punto se estudian temas personales del paciente que facilitan conocerlo mejor. Lo que se quiere es entender y evaluar cómo la enfermedad afecta a la persona y qué ayuda podría llegar a requerir en el ámbito familiar, de su previsión, trabajo, y de sus vínculos interpersonales."></textarea>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
<!-- ASOCIADOS PREFERIDOS ---------------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="modal fade bd-example-modal-lg AsociadosPreferidos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Tu Farmacia Preferida</label>
                                    <input type="text" id="inputName" class="form-control" placeholder="Buscar farmacia">
                                    <input type="text" id="inputName" class="form-control" placeholder="Direccion" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Tu Laboratorio Clinico Preferido</label>
                                    <input type="text" id="inputName" class="form-control" placeholder="Buscar laboratorio">
                                    <input type="text" id="inputName" class="form-control" placeholder="Direccion" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputClientCompany">Tu Hospital Preferido</label>
                                    <input type="text" id="inputClientCompany" class="form-control" placeholder="Buscar hospital">
                                    <input type="text" id="inputName" class="form-control" placeholder="Direccion" disabled> 
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
<!--  GENERAR CITA ---------------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="modal fade bd-example-modal-lg GenerarCita" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Fecha De La Consulta</label>
                                        <input type="date" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label>Nombre Del Medico </label>
                                        <input type="text" class="form-control" placeholder="Escriba el nombre del medico">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Motivo De La Consulta</label>
                                        <textarea type="text" class="form-control" placeholder="Escriba los motivos de la consulta a realizar"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label></label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label></label>
                                        <button class="btn btn-block btn-success btn-flat" type="button"><i class="far fa-save"> Guardar</i></button>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
<!--  GENERAR CITA ---------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="modal fade bd-example-modal-lg RegistraConsulta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="col-md-12">
                    <div class="card card-primary collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body " style="display: block;">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <input type="date" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Numero De Documento Personal</label>
                                        <input type="number" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>telefono</label>
                                        <input type="number" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Apellido</label>
                                        <input type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <textarea type="text" class="form-control" placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputSex">Sexo</label>
                                        <select class="form-control custom-select">
                                        <option selected disabled>Seleccione...</option>
                                        <option>Masculino</option>
                                        <option>Femenino</option>
                                        <option selected>Otros</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputCountry">Pais</label>
                                        <select class="form-control custom-select">
                                        <option selected disabled>Seleccione pais...</option>
                                        <option>Guatemala</option>
                                        <option>Honduras</option>
                                        <option>Nicaragua</option>
                                        <option selected>Salvador</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputReg">Región/Departamento</label>
                                        <select class="form-control custom-select">
                                        <option selected disabled>Seleccione pais...</option>
                                        <option>Guatemala</option>
                                        <option>Xela</option>
                                        <option>Progreso</option>
                                        <option selected>Izabal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputDist">Distrito/Municipio</label>
                                        <select class="form-control custom-select">
                                        <option selected disabled>Seleccione Distrito/Municipio
                                            ...</option>
                                        <option>Guatemala</option>
                                        <option>Xela</option>
                                        <option>Progreso</option>
                                        <option selected>Izabal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Motivo De La Consulta</label>
                                        <textarea type="text" class="form-control" placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Diagnostico</label>
                                        <textarea type="text" class="form-control" placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label>Indicaciones de La Receta</label>
                                        <textarea type="text" class="form-control" placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>.</label>
                                        <button class="btn btn-block btn-success btn-flat" type="button"><i class="far fa-save"> Guardar</i></button>
                                        <button class="btn btn-block btn-warning btn-flat" type="button"><i class="far fa-save"> Regresar</i></button>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>  
                </div>  
            </div>
        </div>
    </div>
<!--  GENERAR CITA SUB MODALES ---------------------------------------------------------------------------------------------------------------------------------------------------->
<!--  SELECCIONAR MEDICAMENTOS---------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="modal fade bd-example-modal-lg SeleccionarMedicamentos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 
            </div>
        </div>
    </div>
<!-- REGISTRAR VACUNAS APLICADAS---------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="modal fade bd-example-modal-lg RegistrarVacunasAplicadas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 
            </div>
        </div>
    </div>
<!--  ORDEN DE LABORATORIO---------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="modal fade bd-example-modal-lg OrdenDeLaboratorio" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 
            </div>
        </div>
    </div>
<!--  ORDEN DE SERVICIOS HOSPITALARIOS---------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="modal fade bd-example-modal-lg OrdenServiciosHospitalarios" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 
            </div>
        </div>
    </div>
<!--  EMINITIR RECETA---------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="modal fade bd-example-modal-lg EmitirReceta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 
            </div>
        </div>
    </div>
    </main>
</template>

<script>
    import Vuetify from 'vuetify';
    import 'vuetify/dist/vuetify.min.css';
    export default {
        vuetify: new Vuetify(),
        data(){
            return{
                    arrayQrHead:[],
                    snack: false,
                    snackColor: '',
                    snackText: '',
                    max25chars: v => v.length <= 25 || 'Entrada demasiada larga!',
                    pagination:{},
                    search: '',
                    headers:[
                                {
                            // text: 'Ubicación',
                            // align: 'center',
                            // value: 'location'
                        },
                    { text: 'Acciones', value: 'action'}
                    ],
                  }
        },
            methods: {
                
            },
            components:{Vuetify},
        }
</script>
