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
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <section class="content" >
                                <div class="container-fluid" style="min-height: 400px">
                                    <v-app id="inspire">
                                        <v-data-table
                                                :headers="headers"
                                                :items="arrayGlobalHospital"
                                                sort-by="key_value"
                                                class="elevation-1"
                                                :search="search"
                                                item-key="ctg_hos_nomcom"
                                                loading loading-text="Cargando... Espere un momento"
                                        >
                                            <template v-slot:top>

                                            </template>
                                            <template v-slot:top>
                                                <v-text-field v-model="search" label="Buscar" class="mx-4"></v-text-field>
                                            </template>
                                            <template v-slot:item.action="{ item }">
                                                <v-icon
                                                        small
                                                        class="mr-2"

                                                >
                                                    edit
                                                </v-icon>
                                                <v-icon
                                                        small

                                                >
                                                    delete
                                                </v-icon>
                                            </template>
                                            <template v-slot:no-data>
                                                <v-btn color="primary" >Reset</v-btn>
                                            </template>
                                        </v-data-table>


                                    </v-app>
                                </div>
                            </section>
                            </div> 
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
    import  'toastr/build/toastr.css';
    import Swal from 'sweetalert2';
    import 'sweetalert2/dist/sweetalert2.js';
    const prefixUrl = '/tumedifile/gut/';
    export default {
        vuetify: new Vuetify(),

        data(){
            return{
                titlePage           : 'Hospitales',
                arrayGlobalHospital  : [],
                max25chars          : v => v.length <= 25 || 'Entrada demasiada larga!',
                pagination          : {},
                search              : '',
                headers:[
                    {
                        text: 'Nombre Del Hospital',
                        align: 'left',
                        value: 'ctg_hos_nomcom'
                    },
                    {
                        text: 'Direccion',
                        align: 'left',
                        value: 'ctg_hos_dir'
                    },
                    {
                        text: 'Telefono',
                        align: 'left',
                        value: 'ctg_hos_tels'
                    },
                    {
                        text: 'Servicio',
                        align: 'left',
                        value: ''
                    }

                ],
                key_value: '',
            }
        },

        methods:{
            hospitalList(){
                var url = prefixUrl+'list-hospital';
                // this.alertMessagesLoadPage("Cargando la información de los hospitales", 2000);
                axios.get(url).then((response) => {
                    var res         = response.data.HospitalList.data;
                    var resCode     = response.data.code;
                    var resMessage  = response.data.message;

                    console.log(res);


                    if(resCode == 200){

                        // this.messagesToastrSuc(resMessage);
                        this.arrayGlobalHospital = res;

                    }else{
                        // this.messagesToastrErr("Ha ocurrido un error en la carga de la información");
                    }

                })
                    .catch(function(error){
                        console.log(error)
                    })
            },

            // alertMessagesLoadPage(title, time){
            //     let timerInterval;
            //     Swal.fire({
            //         title: title,
            //         //html: 'I will close in <b></b> milliseconds.',
            //         timer: time, //1000
            //         onBeforeOpen: () => {
            //             Swal.showLoading();

            //         },
            //         onClose: () => {
            //             clearInterval(timerInterval)
            //         }
            //     }).then((result) => {
            //         if (
            //             /* Read more about handling dismissals below */
            //             result.dismiss === Swal.DismissReason.timer
            //         ) {
            //             // console.log('I was closed by the timer')
            //         }
            //     });
            // },

            setTitlePage(){
            document.getElementById("titleHeader").innerHTML = this.titlePage;

            },
        },
         mounted() {
            this.setTitlePage();
            this.hospitalList();
        }
    }
</script>
