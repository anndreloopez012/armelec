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
                                <button @click="savePersonalInfo" type="button" class="btn btn-tool" data-toggle="tooltip" data-placement="top" title="Grabar cambios" >
                                    <i class="far fa-save fa-2x"></i></button>
                                <button @click="editPersonalInfo" type="button" class="btn btn-tool" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="far fa-edit fa-2x"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputDocPer">No. De Documento Personal</label>
                                <input v-model="noDocument" :disabled="!isActive" type="text" id="inputDocPer" class="form-control" placeholder="No. De Documento Personal">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Nombre</label>
                                <input v-model="names" :disabled="!isActive" type="text" id="inputNamePatient" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                                <label for="inputLastName">Apellido</label>
                                <input v-model="lastNames" :disabled="!isActive" type="text" id="inputLastName" class="form-control" placeholder="Apellido">
                            </div>
                            <div class="form-group">
                                <label for="inputSex">Sexo</label>
                                <select class="form-control custom-select" :disabled="!isActive" v-model="sex">
                                    <option disabled value="0">Seleccione...</option>
                                    <option value="1">Masculino</option>
                                    <option value="2">Femenino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputCountry">Pais</label>
                                <select class="form-control custom-select" :disabled="!isActive" v-model="country">
                                    <option  disabled>Seleccione pais...</option>
                                    <option value="GUT">Guatemala</option>
                                    <option value="BRA">Brasil</option>
                                    <option value="PAN">Panamá</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputRegion">Región/Departamento</label>
                                <select class="form-control custom-select" :disabled="!isActive">
                                <option selected disabled>Seleccione Departamento...</option>
                                <option>Guatemala</option>
                                <option>Xela</option>
                                <option>Progreso</option>
                                <option selected>Izabal</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputDistrict">Distrito/Municipio</label>
                                <select class="form-control custom-select" :disabled="!isActive">
                                <option selected disabled>Seleccione Distrito/Municipio
                                    ...</option>
                                <option>Guatemala</option>
                                <option>Xela</option>
                                <option>Progreso</option>
                                <option selected>Izabal</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputPhonePatient">Numero Telefonico</label>
                                <input v-model="phoneNumber" :disabled="!isActive" type="text" id="inputPhonePatient" class="form-control" placeholder="Numero Telefonico">
                            </div>
                        </div>
                    </div>
                </div>
<!-- EN CASO DE EMERGENCIA CONTACTAR --------------------------------------------------------------------------------------------------------------------------------->
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">En Caso De Emergencia <br>Contactar</h3>
                            <div class="card-tools">
                                <button @click="saveEmergencyInfo" type="button"  class="btn btn-tool" data-toggle="tooltip" data-placement="top" title="Grabar cambios">
                                    <i class="far fa-save fa-2x"></i></button>
                                <button @click="editEmergencyInfo" type="button" class="btn btn-tool" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="far fa-edit fa-2x"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputNameEmergency">Nombre</label>
                                <input v-model="emergencyName" :disabled="!isActiveEmergency" type="text" id="inputNameEmergency" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                                <label for="inputMailEmergency">Correo</label>
                                <input v-model="emergencyMail" :disabled="!isActiveEmergency" type="email" id="inputMailEmergency" class="form-control" placeholder="Correo">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Numero Telefonico</label>
                                <input v-model="emergencyPhones" :disabled="!isActiveEmergency" type="text" id="inputClientCompany" class="form-control" placeholder="Deveint Inc">
                            </div>
                        </div>
                    </div>
                </div>
<!-- PUBLICIDAD ---------------------------------------------------------------------------------------------------------------------------------------------------->
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
    import toastr from 'toastr/toastr';
    import  'toastr/build/toastr.css';
    import Swal from 'sweetalert2';
    import 'sweetalert2/dist/sweetalert2.js';
    const prefixUrl = '/tumedifile/gut';
   export default {
        data(){
            return{

                noDocument:'',
                names:'',
                lastNames:'',
                sex:'',
                country:'',
                city:'',
                location:'',
                phoneNumber:'',
                emergencyName:'',
                emergencyMail:'',
                emergencyPhones:'',
                isActive:false,
                isActiveEmergency:false,
                titlePage: 'Tu Información Personal',
                countryArray:[],
                cityArray:[],
                locationArray:[],

            }
        },
        methods:{



            getDataPatientLogin(){
                 var url = prefixUrl+'/patient-get-data';
                 this.alertMessagesLoadPage("Cargando la información del paciente", 3000);
                axios.get(url).then((response) => {
                    var res         = response.data.patient[0];
                    var resCode     = response.data.code;
                    var resMessage  = response.data.message;
                    // console.log(res['ctg_pac_apellidos']);
                    this.noDocument = res['ctg_pac_dpi'];
                    this.names = res['ctg_pac_nombres'];
                    this.lastNames = res['ctg_pac_apellidos'];
                    this.sex = res['ctg_pac_sexo'];
                    this.country = 'GUT';
                    this.city = res['ctg_pac_dep'];
                    this.location = res['ctg_pac_mun'];
                    this.phoneNumber = res['ctg_pac_telcel'];
                    this.emergencyName = res['ctg_pac_eme_nombre'];
                    this.emergencyMail = res['ctg_pac_eme_email'];
                    this.emergencyPhones = res['ctg_pac_eme_tels'];

                     if(resCode == 200){
                         this.messagesToastrSuc(resMessage);
                        }else{
                            this.messagesToastrErr("Ha ocurrido un erro en la carga de la información");
                        }

                })
                .catch(function(error){
                    console.log(error)
                })
            },

            savePersonalInfo(){

            },

            saveEmergencyInfo(){
                alert('saved');
            },

            editPersonalInfo(){

                this.isActive = this.isActive !== true;

            },

            editEmergencyInfo(){

                this.isActiveEmergency = this.isActiveEmergency !== true;
            },

            // Messages perfil system
            messagesToastrSuc(message){

                toastr.options={
                    "closeButton": true,
                    "positionClass": "toast-top-right",
                    "progressBar": true,
                };
                toastr.success(message);
            },

            messagesToastrErr(message){
                toastr.options={
                    "closeButton": true,
                    "positionClass": "toast-top-right",
                    "progressBar": true,
                };
                toastr.error(message);
            },

            messagesToastrWarning(message){
                toastr.options={
                    "closeButton": true,
                    "positionClass": "toast-top-right",
                    "progressBar": true,
                };
                toastr.warning(message);
            },


            alertMessagesLoadPage(title, time){
                let timerInterval;
                Swal.fire({
                    title: title,
                    //html: 'I will close in <b></b> milliseconds.',
                    timer: time, //1000
                    onBeforeOpen: () => {
                        Swal.showLoading()
                        // timerInterval = setInterval(() => {
                        //     Swal.getContent().querySelector('b')
                        //         .textContent = Swal.getTimerLeft()
                        // }, 100)
                    },
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.timer
                    ) {
                        // console.log('I was closed by the timer')
                    }
                });
            },

            getCountry(){


            },


            setTitlePage(){
                    document.getElementById("titleHeader").innerHTML = this.titlePage;
                
             // this.userName = 'Juan';

            },

            

        },
        mounted() {
            this.getDataPatientLogin();
            this.setTitlePage();
        }
    }
</script>
