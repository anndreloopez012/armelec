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
                        <h3 class="card-title">Informacion </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputDocPer">Nombre Del Comercial</label>
                                        <input type="text" id="inputNameComer" class="form-control" placeholder="Nombre Del Comercial">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputName">Numero De Nit</label>
                                        <input type="text" id="inputNumberNit" class="form-control" placeholder="Numero De Nit">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputLastN">Nombre De La Sucursal</label>
                                        <input type="text" id="inputNameOffice" class="form-control" placeholder="Nombre De La Sucursal">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputLastN">Horario De Atencion Al Publico</label>
                                        
                                        <datePicker v-model="publicIni" :config="options"></datePicker>
                                        <datePicker v-model="publicFin" :config="options"></datePicker>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputLastN">Horario De Atencion A Domicilio</label>

                                        <datePicker v-model="domiIni" :config="options"></datePicker>
                                        <datePicker v-model="domiFin" :config="options"></datePicker>

                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Motivo De La Consulta</label>
                                        <textarea type="text" id="inputAdress" class="form-control" placeholder="Escriba la direccion"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Zona</label>
                                        <input type="number" id="inputZone" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
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
                                <div class="col-sm-6">
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
                                <h3 class="card-title">Informacion Del Encargado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputName">No. De Documento Personal</label>
                                        <input type="text" id="inputNumberDocument" class="form-control" placeholder="Numero de documento personal">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputName">Nombre Completo</label>
                                        <input type="text" id="inputName" class="form-control" placeholder="Nombre Completo">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputClientCompany">Edad</label>
                                        <input type="number" id="inputAge" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputReg">Sexo</label>
                                        <select class="form-control custom-select">
                                            <option selected disabled>Seleccione pais...</option>
                                            <option>Masculino</option>
                                            <option>Femenino</option>
                                        </select>
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
    </main>
</template>

<script>
    import Vuetify from 'vuetify';
    import 'vuetify/dist/vuetify.min.css';
    import 'bootstrap/dist/css/bootstrap.css';
    import datePicker from 'vue-bootstrap-datetimepicker';
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

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

                    publicIni: new Date(),
                    publicFin: new Date(),
                    domiIni: new Date(),
                    domiFin: new Date(),
                    options: {
                    format: 'h:mm:ss',
                    useCurrent: false,
                    },

            }
        },
            methods:{
                // list(){
                //     alert("yp");
                // }
                testHoras(){
                    alert(this.publicIni);
                }
            },
            components:{Vuetify, datePicker},
        }

</script>
