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
                    <section class="content col-md-9">
                        <div class="container-fluid">
                            <div class="row">
        <!-- ANTECEDENTES ---------------------------------------------------------------------------------------->
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title"></h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                    <i class="fas fa-minus"></i></button>
                                            </div>
                                        </div>
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
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
