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
<!-- GENERAL ---------------------------------------------------------------------------------------->
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
                                                
                                            </div>

                                            <button
                                                type="button" 
                                                class="btn btn-tool" 
                                                @click="vaccineCreate"
                                                slot="reference"
                                                >
                                                <i class="far fa-plus fa-2x"></i>
                                            </button>
                                        </popper>
                                        <popper trigger="hover" :options="{placement: 'top'}" v-if="save">
                                        <div class="popper">
                                            
                                        </div>

                                        <button
                                                type="button"
                                                class="btn btn-tool"
                                                @click="vaccineStore"
                                                slot="reference"
                                        >
                                            <i class="far fa-save fa-2x"></i>
                                        </button>
                                    </popper>
                                        <popper trigger="hover" :options="{placement: 'top'}" v-if="update">
                                            <div class="popper">
                                                
                                            </div>

                                            <button
                                                    type="button"
                                                    class="btn btn-tool"
                                                    @click="vaccineUpdate"
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
                                                <label>Fecha</label>
                                                <input v-model="date" id="date" type="date" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-6"></div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>No. Factura</label>
                                                <input v-model="bill" id="bill" type="number" class="form-control" placeholder="Numero de la factura ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Costo</label>
                                                <input v-model="cost" id="cost"  type="number" class="form-control" placeholder="Costo ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Unidades</label>
                                                <input v-model="unity" id="unity" type="number" class="form-control" placeholder="Unidad ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Cod. Vacuna </label>
                                                <input v-model="vaccineCod" id="vaccineCod" type="number" class="form-control" placeholder="Codigo de la vacuna ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Descripcion Vacuna</label>
                                                <textarea v-model="descripVacc" id="descripVacc" type="text" class="form-control" placeholder="Descripcion de la vacuna ..."></textarea>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                  
<!-- -->
                            <div class="container-fluid title-personality">
                                <v-app id="inspire">
                                    <div class="card-body">

                                        <template>
                                          
                                            <v-data-table
                                            :headers="headers"
                                            :items="arraydocListBuyVacc"
                                            sort-by="key_value"
                                            class="elevation-1"
                                            :search="search"
                                            >
                                            <template v-slot:top>

                                            </template>
                                            <template v-slot:top>
                                                <v-text-field v-model="search" label="Buscar" class="mx-4"></v-text-field>
                                            </template>
                                                <template v-slot:item.med_vam_sta="{item}">
                                                    <v-chip :color = "statusColor(item.med_vam_sta)" dark  v-if="item.med_vam_sta == 1">Activo</v-chip>
                                                    <v-chip :color = "statusColor(item.med_vam_sta)" dark  v-else>Edición</v-chip>
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
    const prefixUrl = '/tumedifile/gut/';
    export default {
        vuetify: new Vuetify(),

        data(){
            return{
                date                : '',
                bill                : '',
                cost                : '',
                unity               : '',
                vaccineCod          : '',
                FamilyRel           : '',
                descripVacc         : '',
                titlePage           : 'Compra de Vacunas',
                arraydocListBuyVacc : [],
                max25chars          : v => v.length <= 25 || 'Entrada demasiada larga!',
                pagination          : {},
                search              : '',
                headers:[
                    {
                        text: 'Numero De Factura',
                        align: 'left',
                        value: 'med_vam_fac'
                    },
                    {
                        text: 'Costo',
                        align: 'left',
                        value: 'med_vam_costo'
                    },
                    {
                        text: 'Unidades',
                        align: 'left',
                        value: 'med_vam_uni'
                    },
                    {
                        text: 'Codigo De La Vacuna',
                        align: 'left',
                        value: 'med_vam_id'
                    },
                    {
                        text: 'Estado',
                        align: 'center',
                        value: 'med_vam_sta'
                    },

                    { text: 'Acciones', value: 'action'}
                ],
                key_value           :  '',
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
            docListBuyVacc(){
                var url = prefixUrl+'doctor-info-buy-vaccine';
                // this.alertMessagesLoadPage("Cargando la información de los hospitales", 2000);
                axios.get(url).then((response) => {
                    var res         = response.data.docListBuyVacc.data;
                    var resCode     = response.data.code;
                    var resMessage  = response.data.message;

                    console.log(res);


                    if(resCode == 200){

                        // this.messagesToastrSuc(resMessage);
                        this.arraydocListBuyVacc = res;

                    }else{
                        // this.messagesToastrErr("Ha ocurrido un error en la carga de la información");
                    }

                })
                    .catch(function(error){
                        console.log(error)
                    })
            },

            saveVaccine(){
                var url =  prefixUrl+'doctor-save-buy-vaccine';

                axios.post(url, {
                    'med_vam_id'            : this.vaccineCod,
                    'med_vam_fac'           : this.bill,
                    'med_vam_fac_dt'        : this.date,
                    'med_vam_costo'         : this.cost,
                    'med_vam_uni'           : this.unity,
                }).then((response) =>{
                  var  responseResult = response.data;

                   if(responseResult.code == 200){
                        toastr.options={
                            "CERRARButton": true,
                            "positionClass": "toast-top-right",
                            "progressBar": true,
                        };
                        toastr.success(responseResult.message);
                        this.docListBuyVacc();

                           this.create           = true;
                           this.save             = false;
                           this.form             = 0;
                   }else{
                       toastr.options={
                           "CERRARButton": true,
                           "positionClass": "toast-top-right",
                           "progressBar": true,
                       };
                       toastr.error("Hubo un error al guardar los datos");
                   }

                }).catch((error) => {
                    console.log(error)

                });
                    
            },

            vaccineUpdate(){
                var url =  prefixUrl+'doctor-update-buy-vaccine';

                axios.put(url, {
                    'med_vam_fac_dt'        : this.date,
                    'med_vam_fac'           : this.bill,
                    'med_vam_costo'         : this.cost,
                    'med_vam_uni'           : this.unity,
                    'med_vam_id'            : this.vaccineCod,

                }).then((response) =>{
                    var  responseResult = response.data;

                    if(responseResult.code == 200){
                        toastr.options={
                            "CERRARButton": true,
                            "positionClass": "toast-top-right",
                            "progressBar": true,
                        };
                        toastr.success(responseResult.message);
                        this.docListBuyVacc();

                        this.create           = true;
                        this.save             = false;
                        this.cancel           = false;
                        this.update           = false;
                        this.form             = 0;
                    }else{
                        toastr.options={
                            "CERRARButton": true,
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

                this.date               =  item.med_vam_fac_dt;
                this.bill               =  item.med_vam_fac;
                this.cost               =  item.med_vam_costo;
                this.unity              =  item.med_vam_uni;
                this.vaccineCod         =  item.med_vam_id;
                this.form               =  1;

            },

            deleteItem( item ){
                var url =  prefixUrl+'doctor-delete-buy-vaccine';
                this.alertMessagesLoadPage("Elimando registro", 1500);
                axios.put(url, {
                   'med_vam_id'            : this.vaccineCod,

                }).then((response) =>{
                    var  responseResult = response.data;

                    if(responseResult.code == 200){
                        toastr.options={
                            "CERRARButton": true,
                            "positionClass": "toast-top-right",
                            "progressBar": true,
                        };
                        toastr.success(responseResult.message);
                        this.docListBuyVacc();
                    }else{
                        toastr.options={
                            "CERRARButton": true,
                            "positionClass": "toast-top-right",
                            "progressBar": true,
                        };
                        toastr.error("Hubo un error al guardar los datos");
                    }

                }).catch((error) => {
                    console.log(error)

                });

            },

            vaccineCreate(){

                this.date               =  '';
                this.bill               =  '';
                this.cost               =  '';
                this.unity              =  '';
                this.vaccineCod         =  '';
                this.cancel             = true;
                this.create             = false;
                this.save               = true;
                this.form               = 1;

            },

            vaccineStore(){
                
                var validate = this.validate();

                if(validate)
                {
                     toastr.options={
                           "CERRARButton": true,
                           "positionClass": "toast-top-right",
                           "progressBar": true,
                       };
                       toastr.error("Todos los datos son requeridos");
                       
                            this.create    = false;
                            this.save      = true;
                            this.cancel    = true;
                            this.update    = false;
                }else{
                    this.saveVaccine();
                }
                
                
            },

            cancelForm(){
                this.date               =  '';
                this.bill               =  '';
                this.cost               =  '';
                this.unity              =  '';
                this.vaccineCod         =  '';
                this.create           = true;
                this.cancel           = false;
                this.save             = false;
                this.update           = false;
                this.form             = 0;
            },

            validate(){
                return this.date        ==  ''||
                this.bill               ==  ''||
                this.cost               ==  ''||
                this.unity              ==  ''||
                this.vaccineCod         ==  '';
            },



            setTitlePage(){
            document.getElementById("titleHeader").innerHTML = this.titlePage;

            },

             // Messages perfil system
            messagesToastrSuc( message ){

                toastr.options={
                    "CERRARButton": true,
                    "positionClass": "toast-top-right",
                    "progressBar": true,
                };
                toastr.success(message);
            },

            messagesToastrErr( message ){
                toastr.options={
                    "CERRARButton": true,
                    "positionClass": "toast-top-right",
                    "progressBar": true,
                };
                toastr.error(message);
            },

            messagesToastrWarning( message ){
                toastr.options={
                    "CERRARButton": true,
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
                    onCERRAR: () => {
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

            statusColor( item ){
                if( item == 1 ) return 'green'
                else return 'orange'
            }

        },

         mounted() {
            this.setTitlePage();
            this.docListBuyVacc();
        },
        components:{ Vuetify, popper }
    }
</script>
