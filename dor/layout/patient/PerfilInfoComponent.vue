<template>
    <main class="main">
        <div class="content-header">
            <div class="container-fluid">
                <input type="hidden" id="titlePage" v-model="titlePage">
            </div>
        </div>
<!-- INFORMACION PERSONAL ----------------------------------------------------------------------------------------------------------------------- -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-primary">
                        <div class="card-header"> 
                        <h3 class="card-title">Informacion Personal</h3>
                            <div class="card-tools">
                                <button @click="updatePersonalInfo" ref="savePersonal" type="button"  class="btn btn-tool" data-toggle="tooltip" data-placement="top" title="Grabar cambios" >
                                    <i class="far fa-save fa-2x"></i></button>
                                <button @click="editPersonalInfo" ref="editPersonal" type="button" class="btn btn-tool" data-toggle="tooltip" data-placement="top" title="Editar">
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
                                <select class="form-control" :disabled="true" v-model="countrySelect" @change="fillData(countrySelect)">
                                    <option selected disabled value="N/A">Seleccione pais...</option>
                                    <option v-for="country in countryArray" :key="country.geo_id" :value="country.geo_id"> {{country.geo_desc}} </option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputRegion">Región/Departamento</label>
                                <select class="form-control" :disabled="!isActive" v-model="citySelect" @change="fillData(citySelect)" >
                                    <option selected disabled value="N/A">Seleccione departamento...</option>
                                    <option v-for="city in cityArray" :key="city.geo_id" :value="city.geo_id"> {{city.geo_desc}} </option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputDistrict">Distrito/Municipio</label>
                                 <select class="form-control" :disabled="!isActive" v-model="locationSelect">
                                    <option selected disabled value="0">Seleccione municipio...</option>
                                    <option v-for="department in departmentArray" :key="department.geo_id" :value="department.geo_id"> {{department.geo_desc}} </option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputPhonePatient">Numero Telefonico</label>
                                <input v-model="phoneNumber" :disabled="!isActive" type="text" id="inputPhonePatient" class="form-control" placeholder="Numero Telefonico">
                            </div>
                        </div>
                    </div>
                </div>
<!-- EN CASO DE EMERGENCIA CONTACTAR ------------------------------------------------------------------------------------------------------------------------------- -->
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">En Caso De Emergencia <br>Contactar</h3>
                            <div class="card-tools">
                                <button @click="updateEmergencyInfo" type="button"  class="btn btn-tool" data-toggle="tooltip" data-placement="top" title="Grabar cambios">
                                    <i class="far fa-save fa-2x"></i></button>
                                <button @click="editEmergencyInfo" ref="editEmergency" type="button" class="btn btn-tool" data-toggle="tooltip" data-placement="top" title="Editar">
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
    import toastr from 'toastr/toastr';
    import  'toastr/build/toastr.css';
    import Swal from 'sweetalert2';
    import 'sweetalert2/dist/sweetalert2.js';


    const prefixUrl = '/tumedifile/gut/';
   export default {
        data(){
            return{

                noDocument:'',
                names:'',
                lastNames:'',
                sex:'',
                countrySelect:'',
                citySelect:'',
                locationSelect:'',
                phoneNumber:'',
                emergencyName:'',
                emergencyMail:'',
                emergencyPhones:'',
                isActive:false,
                isActiveEmergency:false,
                titlePage: 'Tu Información Personal',
                countryArray:[],
                cityArray:[],
                departmentArray:[],


            }
        },
        methods:{

            getDataPatientLogin(){
                 var url = prefixUrl+'patient-get-data';
                 //this.alertMessagesLoadPage("Cargando la información del paciente", 3500);
                axios.get(url).then((response) => {
                    var res         = response.data.patient[0];
                    var resCode     = response.data.code;
                    var resMessage  = response.data.message;
                    // console.log(res['ctg_pac_apellidos']);
                    this.noDocument         = res['ctg_pac_dpi'];
                    this.names              = res['ctg_pac_nombres'];
                    this.lastNames          = res['ctg_pac_apellidos'];
                    this.sex                = res['ctg_pac_sexo'];
                    this.countrySelect      = 'GUT';
                    this.citySelect         = res['ctg_pac_dep'];
                    this.locationSelect     = res['ctg_pac_mun'];
                    this.phoneNumber        = res['ctg_pac_telcel'];
                    this.emergencyName      = res['ctg_pac_eme_nombre'];
                    this.emergencyMail      = res['ctg_pac_eme_email'];
                    this.emergencyPhones    = res['ctg_pac_eme_tels'];

                     if(resCode == 200){
                         this.fillData('null');
                         this.fillData(this.countrySelect);
                         this.fillData(this.citySelect);
                        //  this.messagesToastrSuc(resMessage);
                        
                        }else{
                            this.messagesToastrErr("Ha ocurrido un error en la carga de la información");
                        }

                })
                .catch(function(error){
                    console.log(error)
                })
            },

            updatePersonalInfo(){
               var url =  prefixUrl+'update-personal-data';

                axios.post(url, {
                    'ctg_pac_dpi'           :   this.noDocument,
                    'ctg_pac_nombres'       :   this.names,
                    'ctg_pac_apellidos'     :   this.lastNames,
                    'ctg_pac_sexo'          :   this.sex,
                    'ctg_pac_dep'           :   this.citySelect,
                    'ctg_pac_mun'           :   this.locationSelect,
                    'ctg_pac_telcel'        :   this.phoneNumber
                    
                    
                }).then((response) =>{
                  var  responseResult = response.data;

                    console.log( responseResult);

                   if(responseResult.code == 200){
                        toastr.options={
                            "closeButton": true,
                            "positionClass": "toast-top-right",
                            "progressBar": true,
                        };
                        toastr.success(responseResult.message);
                        this.getDataPatientLogin();
                        var element = this.$refs.editPersonal;
                        element.click();
                        
                    }else{
                       toastr.options={
                           "closeButton": true,
                           "positionClass": "toast-top-right",
                           "progressBar": true,
                       };
                       toastr.error("Hubo un error al guardar los datos");
                   }

                }).catch((error) => {
                    console.log(error)

                });

            },

            updateEmergencyInfo(){
                var url =  prefixUrl+'update-emergency-data';

                axios.post(url, {
                    'ctg_pac_eme_nombre'       :   this.emergencyName,
                    'ctg_pac_eme_tels'         :   this.emergencyPhones,
                    'ctg_pac_eme_email'        :   this.emergencyMail                    
                                        
                }).then((response) =>{
                  var  responseResult = response.data;

                    console.log( responseResult);

                   if(responseResult.code == 200){
                        toastr.options={
                            "closeButton": true,
                            "positionClass": "toast-top-right",
                            "progressBar": true,
                        };
                        toastr.success(responseResult.message);
                        this.getDataPatientLogin();
                        var element = this.$refs.editEmergency;
                        element.click();
                        
                    }else{
                       toastr.options={
                           "closeButton": true,
                           "positionClass": "toast-top-right",
                           "progressBar": true,
                       };
                       toastr.error("Hubo un error al guardar los datos");
                   }

                }).catch((error) => {
                    console.log(error)

                });
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
                        Swal.showLoading();

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


            fillData(parent){
                var url = prefixUrl+'geography/get-countries/?parent='+parent;
                axios.get(url).then((response) => {
                    var resCode = response.data.code;
                    var respuesta = response.data.countries;
                    console.log("Respuesta: "+respuesta);

                    if(resCode == 200){
                        switch(parent){
                            case 'null':
                                this.countryArray = respuesta;
                                break;
                            case 'GUT':
                                this.cityArray = respuesta;
                                break;
                            default:
                                this.departmentArray = respuesta;
                            break;
                        }

                    }else{
                        this.messagesToastrErr("Ha ocurrido un error en la carga de la información");
                    }

                })
                .catch(function(error){
                    console.log(error)
                })
            },


            setTitlePage(){
                    document.getElementById("titleHeader").innerHTML = this.titlePage;
                
             // this.userName = 'Juan';

            },

            

        },
        mounted() {
            this.getDataPatientLogin();
            this.setTitlePage();
        },
    }
</script>
