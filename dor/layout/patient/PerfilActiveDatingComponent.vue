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
                          <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Nuevo</h3>
                                    <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body " style="display: none;">
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
<!-- FAMILIA-->
                        <div class="col-md-12">
                            <v-app id="inspire">
                                <v-data-table
                                    :headers="headers"
                                    :items="desserts"
                                    sort-by="calories"
                                    class="elevation-1"
                                    >
                                    <template v-slot:top>
                                        <v-toolbar flat color="white">
                                        <v-toolbar-title>My CRUD</v-toolbar-title>
                                        <v-divider
                                            class="mx-4"
                                            inset
                                            vertical
                                        ></v-divider>
                                        <v-spacer></v-spacer>
                                        <v-dialog v-model="dialog" max-width="500px">
                                            <template v-slot:activator="{ on }">
                                            <v-btn color="primary" dark class="mb-2" v-on="on">New Item</v-btn>
                                            </template>
                                            <v-card>
                                            <v-card-title>
                                                <span class="headline">{{ formTitle }}</span>
                                            </v-card-title>
                                
                                            <v-card-text>
                                                <v-container>
                                                <v-row>
                                                    <!-- <v-col cols="12" sm="6" md="4">
                                                    <v-text-field v-model="editedItem.name" label="Dessert name"></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" sm="6" md="4">
                                                    <v-text-field v-model="editedItem.calories" label="Calories"></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" sm="6" md="4">
                                                    <v-text-field v-model="editedItem.fat" label="Fat (g)"></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" sm="6" md="4">
                                                    <v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" sm="6" md="4">
                                                    <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                                                    </v-col> -->
                                                </v-row>
                                                </v-container>
                                            </v-card-text>
                                
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                                                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                                            </v-card-actions>
                                            </v-card>
                                        </v-dialog>
                                        </v-toolbar>
                                    </template>
                                    <template v-slot:item.action="{ item }">
                                        <v-icon
                                        small
                                        class="mr-2"
                                        @click="editItem(item)"
                                        >
                                        edit
                                        </v-icon>
                                        <v-icon
                                        small
                                        @click="deleteItem(item)"
                                        >
                                        delete
                                        </v-icon>
                                    </template>
                                    <template v-slot:no-data>
                                        <v-btn color="primary" @click="initialize">Reset</v-btn>
                                    </template>
                                </v-data-table>
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
