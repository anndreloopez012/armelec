<template>
    <main class="main">
        <div class="content-header">
            <div class="container-fluid">
                <input type="hidden" id="titlePage" v-model="titlePage">
            </div>
        </div>
    <section class="content col-md-12">
        <div class="container-fluid">
            <div class="row">
<!-- NUEVO ---------------------------------------------------------------------------------------->
            <section class="content col-md-9">
                <div class="container-fluid">
                    <div class="row">
                          <div class="col-md-12 title-card">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>
                                    <div class="card-tools">
                                        <popper trigger="hover" :options="{placement: 'top'}" v-if="cancel">
                                            <div class="popper">
                                                Cancelar
                                            </div>

                                            <button
                                                    type="button"
                                                    class="btn btn-tool"
                                                    @click="cancelForm"
                                                    slot="reference"
                                            >
                                                <i class="far fa-minus fa-2x"></i>
                                            </button>
                                        </popper>
                                        <popper trigger="hover" :options="{placement: 'top'}" v-if="create">
                                            <div class="popper">
                                                Crear familiar
                                            </div>

                                            <button
                                                type="button"
                                                class="btn btn-tool"
                                                @click="familiarCreate"
                                                slot="reference"
                                                >
                                                <i class="far fa-plus fa-2x"></i>
                                            </button>
                                        </popper>
                                        <popper trigger="hover" :options="{placement: 'top'}" v-if="save">
                                        <div class="popper">
                                            Guardar
                                        </div>

                                        <button
                                                type="button"
                                                class="btn btn-tool"
                                                @click="familiarStore"
                                                slot="reference"
                                        >
                                            <i class="far fa-save fa-2x"></i>
                                        </button>
                                    </popper>
                                        <popper trigger="hover" :options="{placement: 'top'}" v-if="update">
                                            <div class="popper">
                                                Actualizar
                                            </div>

                                            <button
                                                    type="button"
                                                    class="btn btn-tool"
                                                    @click="familiarUpdate"
                                                    slot="reference"
                                            >
                                                <i class="far fa-sync fa-2x"></i>
                                            </button>
                                        </popper>

                                    </div>
                                </div>
                                <div class="card-body animated fadeInDown fast" v-if="form == 1">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label> Relacion Del Familiar </label>
                                                <select class="form-control" v-model="familiaRelSelect">
                                                    <option selected disabled value="0">Selecciones una relación...</option>
                                                    <option v-for="familiaRel in familiarRelArray" :key="familiaRel.ctg_ref_id" :value="familiaRel.ctg_ref_id"> {{familiaRel.ctg_ref_desc}} </option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>No. De Documento</label>
                                                <input v-model="numDocument" type="text" class="form-control" placeholder="Documento">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nombres </label>
                                                <input v-model="names" type="text" class="form-control" placeholder="Nombres">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Apellidos</label>
                                                <input v-model="lastNames" type="text" class="form-control" placeholder="Apellidos">
                                            </div>
                                        </div>
                                         <div class="col-sm-4">
                                            <div class="form-group">
                                                <label> Sexo </label>
                                                <select class="form-control" v-model="sex">
                                                    <option selected disabled value="0">Selecciones un sexo...</option>
                                                    <option value="1">Masculino</option>
                                                    <option value="2">Femenino</option>


                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Fecha De Nacimiento</label>
                                                <input v-model="dateBorn" type="date" class="form-control" @blur="age = calcAgeAndFormatDate(dateBorn,1)">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Edad</label>
                                                <input v-model="age" type="text" class="form-control" placeholder="edad" :disabled="true">
                                        </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Peso</label>
                                                <input v-model="weight" type="text" class="form-control" placeholder="peso">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Estatura</label>
                                                <input v-model="height" type="text" class="form-control" placeholder="Estatura">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo De Sangre</label>
                                                <select class="form-control" v-model="bloodTypeSelect">
                                                    <option selected disabled value="0">Selecciones un tipo de sangre...</option>
                                                    <option v-for="bloodType in bloodTypeArray" :key="bloodType.ctg_tps_id" :value="bloodType.ctg_tps_id"> {{bloodType.ctg_tps_desc}} </option>

                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


<!-- FAMILIA-->


                            <div class="container-fluid title-personality">
                                <v-card>
                                    <v-container>
                                        <h3>Miembros Familiares</h3>
                                    </v-container>
                                </v-card>
                                <v-app id="inspire">
                                    <div class="card-body">

                                        <template>

                                            <v-data-table
                                            :headers="headers"
                                            :items="arrayPerfilFamily"
                                            sort-by="key_value"
                                            class="elevation-1"
                                            :search="search"
                                            >
                                            <template v-slot:top>

                                            </template>
                                            <template v-slot:top>
                                                <v-text-field v-model="search" label="Buscar" class="mx-4"></v-text-field>
                                            </template>
                                                <template v-slot:item.ctg_paf_sta="{item}">
                                                    <v-chip :color = "statusColor(item.ctg_paf_sta)" dark  v-if="item.ctg_paf_sta == 1">Activo</v-chip>
                                                    <v-chip :color = "statusColor(item.ctg_paf_sta)" dark  v-else>Edición</v-chip>
                                                </template>
                                                    <template v-slot:item.action="{ item }">
                                                        <v-icon
                                                                small
                                                                class="mr-2"
                                                                @click="editItem(item)"

                                                        >
                                                            fas fa-edit
                                                        </v-icon>
                                                        <v-icon
                                                                small
                                                                @click="deleteItem(item)"

                                                        >
                                                           fas fa-trash
                                                        </v-icon>
                                                    </template>
                                                    <template v-slot:no-data>
                                                        <v-btn color="primary" >Reset</v-btn>
                                                    </template>
                                                </v-data-table>
                                        </template>

                                    </div>

                                </v-app>
                            </div>

                    </div>
                </div>
            </section>


<!-- PUBLICIDAD -------------------------------------------------------------------------------------------------------------------------------------------------->
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
    import 'toastr/build/toastr.css';
    import Swal from 'sweetalert2';
    import 'sweetalert2/dist/sweetalert2.js';
    import popper from 'vue-popperjs/dist/vue-popper';
    import 'vue-popperjs/dist/vue-popper.css';
    const prefixUrl = '/tumedifile/gut/patient/';

    export default {
        vuetify: new Vuetify(),

        data(){
            return{
                id                  : 0,
                numDocument         : '',
                names               : '',
                lastNames           : '',
                sex                 : 0,
                dateBorn            : '',
                age                 : 0,
                height              : '',
                weight              : '',
                bloodTypeSelect     : 0,
                bloodTypeArray      : [],
                titlePage           : 'Tu Familia',
                arrayPerfilFamily   : [],
                max25chars          : v => v.length <= 25 || 'Entrada demasiada larga!',
                pagination          : {},
                search              : '',
                headers:[
                    {
                        text: 'Id',
                        align: 'left',
                        value: 'ctg_paf_dpi'
                    },
                    {
                        text: 'Familiar',
                        align: 'justify',
                        value: 'full_name'
                    },
                    {
                        text: 'Peso',
                        align: 'right',
                        value: 'ctg_paf_peso'
                    },
                    {
                        text: 'Estatura',
                        align: 'right',
                        value: 'ctg_paf_esta'
                    },
                    {
                        text: 'Estado',
                        align: 'center',
                        value: 'ctg_paf_sta'
                    },

                    { text: 'Acciones', value: 'action'}
                ],
                key_value           :  '',
                familiaRelSelect    : '0',
                familiarRelArray    :  '',
                btnSave             :   1,
                //  Buttons header card
                cancel              : false,
                create              : true,
                save                : false,
                update              : false,
                form                : 0,

            }
        },
        methods:{

            familyList(){
                var url = prefixUrl+'family/list';
                axios.get(url).then((response) => {
                    var res         = response.data.familyList.data;
                    var resCode     = response.data.code;
                    var resMessage  = response.data.message;

                    if(resCode == 200){

                        this.arrayPerfilFamily = res;
                        this.getRelations();
                        this.getBloodTypes();
                        this.cancel            = false;
                        this.form              = 0;

                    }else{
                        this.messagesToastrErr("Ha ocurrido un error en la carga de la información");
                    }

                })
                    .catch(function(error){
                        console.log(error)
                    })
            },

            saveFamily(){
                var url =  prefixUrl+'family/add';

                axios.post(url, {
                    'ctg_paf_rel_id'        : this.familiaRelSelect,
                    'ctg_paf_dpi'           : this.numDocument,
                    'ctg_paf_nombres'       : this.names,
                    'ctg_paf_apellidos'     : this.lastNames,
                    'ctg_pef_sexo'          : this.sex,
                    'ctg_paf_nac_full'      : this.dateBorn,
                    'ctg_paf_peso'          : this.weight,
                    'ctg_paf_esta'          : this.height,
                    'ctg_paf_tpsa'          : this.bloodTypeSelect
                }).then((response) =>{
                  var  responseResult = response.data;

                   if(responseResult.code == 200){
                        toastr.options={
                            "closeButton": true,
                            "positionClass": "toast-top-right",
                            "progressBar": true,
                        };
                        toastr.success(responseResult.message);
                        this.familyList();

                           this.create           = true;
                           this.save             = false;
                           this.form             = 0;
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

            familiarUpdate(){
                var url =  prefixUrl+'family/update';

                axios.put(url, {
                    'id'                    : this.id,
                    'ctg_paf_rel_id'        : this.familiaRelSelect,
                    'ctg_paf_dpi'           : this.numDocument,
                    'ctg_paf_nombres'       : this.names,
                    'ctg_paf_apellidos'     : this.lastNames,
                    'ctg_pef_sexo'          : this.sex,
                    'ctg_paf_nac_full'      : this.dateBorn,
                    'ctg_paf_peso'          : this.weight,
                    'ctg_paf_esta'          : this.height,
                    'ctg_paf_tpsa'          : this.bloodTypeSelect

                }).then((response) =>{
                    var  responseResult = response.data;

                    if(responseResult.code == 200){
                        toastr.options={
                            "closeButton": true,
                            "positionClass": "toast-top-right",
                            "progressBar": true,
                        };
                        toastr.success(responseResult.message);
                        this.familyList();

                        this.create           = true;
                        this.save             = false;
                        this.cancel           = false;
                        this.update           = false;
                        this.form             = 0;
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

            editItem( item ){
                this.create     =  false;
                this.save       =  false;
                this.update     =  true;
                this.cancel     =  true;
              this.getRelations();
              this.getBloodTypes();

              var dateBorn = this.calcAgeAndFormatDate(item.ctg_paf_nac_full);
              var age      = this.calcAgeAndFormatDate(item.ctg_paf_nac_full,1);

              this.id                  =  item.id;
              this.familiaRelSelect    =  item.ctg_paf_rel_id;
              this.numDocument         =  item.ctg_paf_dpi;
              this.names               =  item.ctg_paf_nombres;
              this.lastNames           =  item.ctg_paf_apellidos;
              this.sex                 =  item.ctg_pef_sexo;
              this.height              =  item.ctg_paf_esta;
              this.weight              =  item.ctg_paf_peso;
              this.bloodTypeSelect     =  item.ctg_paf_tpsa;
              this.dateBorn            =  dateBorn;
              this.age                 =  age;
              this.form                =  1;

            },

            deleteItem( item ){
                var url =  prefixUrl+'family/delete';
                this.alertMessagesLoadPage("Elimando registro", 1500);
                axios.put(url, {
                    'id'                    : item.id,

                }).then((response) =>{
                    var  responseResult = response.data;

                    if(responseResult.code == 200){
                        toastr.options={
                            "closeButton": true,
                            "positionClass": "toast-top-right",
                            "progressBar": true,
                        };
                        toastr.success(responseResult.message);
                        this.familyList();
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

            getRelations(){
                var url = prefixUrl+'api/famly/relation';

                axios.get(url).then((response) => {
                    var res         = response.data.relations;
                    var resCode     = response.data.code;
                    var resMessage  = response.data.message;
                   this.familiarRelArray = res;

                })
                    .catch(function(error){
                        this.messagesToastrErr("Ha ocurrido un error en la carga de la información");
                    })

            },

            getBloodTypes(){
               var url = prefixUrl+'api/blood-types';
               axios.get(url).then((response) => {

                    var res         = response.data.bloodTypes;
                   this.bloodTypeArray = res;

                })
                    .catch((error) => {
                        console.log(error);

                        this.messagesToastrErr("Ha ocurrido un error en la carga de la información");
                    })

            },

            familiarCreate(){

                this.familiaRelSelect = 0;
                this.numDocument      = '';
                this.names            = '';
                this.lastNames        = '';
                this.sex              = 0;
                this.dateBorn         = '';
                this.weight           = '';
                this.height           = '';
                this.bloodTypeSelect  = 0;
                this.age              = 0;
                this.cancel           = true;
                this.create           = false;
                this.save             = true;
                this.form             = 1;

            },

            familiarStore(){

                var validate = this.validate();

                if(validate)
                {
                     toastr.options={
                           "closeButton": true,
                           "positionClass": "toast-top-right",
                           "progressBar": true,
                       };
                       toastr.error("Todos los datos son requeridos");

                            this.create    = false;
                            this.save      = true;
                            this.cancel    = true;
                            this.update    = false;
                }else{
                    this.saveFamily();
                }


            },

            cancelForm(){
                this.familiaRelSelect = 0;
                this.numDocument      = '';
                this.names            = '';
                this.lastNames        = '';
                this.sex              = 0;
                this.dateBorn         = '';
                this.weight           = '';
                this.height           = '';
                this.bloodTypeSelect  = 0;
                this.create           = true;
                this.cancel           = false;
                this.save             = false;
                this.update           = false;
                this.form             = 0;
            },

            validate(){
                return this.familiaRelSelect == 0 ||
                       this.numDocument == '' ||
                       this.names == '' ||
                       this.lastNames == '' ||
                       this.sex == 0 ||
                       this.dateBorn == '' ||
                       this.weight == '' ||
                       this.height == '' ||
                       this.bloodTypeSelect == 0;
            },

            setTitlePage(){
                document.getElementById("titleHeader").innerHTML = this.titlePage;

            },

            // Messages perfil system
            messagesToastrSuc( message ){

                toastr.options={
                    "closeButton": true,
                    "positionClass": "toast-top-right",
                    "progressBar": true,
                };
                toastr.success(message);
            },

            messagesToastrErr( message ){
                toastr.options={
                    "closeButton": true,
                    "positionClass": "toast-top-right",
                    "progressBar": true,
                };
                toastr.error(message);
            },

            messagesToastrWarning( message ){
                toastr.options={
                    "closeButton": true,
                    "positionClass": "toast-top-right",
                    "progressBar": true,
                };
                toastr.warning(message);
            },

            alertMessagesLoadPage( title, time ){
                let timerInterval;
                Swal.fire({
                    title: title,
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
                    }
                });
            },

            calcAgeAndFormatDate: ( data, typeProcess ) =>{
                var res = '',
                myDateBorn    = new Date(data),
                myMonth       = ( "0" + (myDateBorn.getMonth() + 1) ).slice(-2),
                myDay         = ( "0" + myDateBorn.getDate() ).slice(-2),
                myYear        = ( myDateBorn.getFullYear() ),
                dateProcessed = moment( myYear+'-'+myMonth+'-'+myDay ),
                today = moment(),
                age =  today.diff( dateProcessed, 'years' );

                if( typeProcess === 1 ){
                    res = age;
                }else{
                    res = dateProcessed.format( 'YYYY-MM-DD' );
                }

                if( data === '' ){
                    res = 0;
                }

                return res;

            },

            statusColor( item ){
                if( item == 1 ) return 'green'
                else return 'orange'
            }

        },


        mounted() {
            this.setTitlePage();
            this.familyList();
        },
        components:{ Vuetify, popper }
    }
</script>
<style>
    .title-card{
        margin-top:5px !important;
    }
    .title-personality{
        margin-top:5px !important;
    }
</style>
