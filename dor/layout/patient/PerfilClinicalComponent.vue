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
<!-- GENERAL ---------------------------------------------------------------------------------------->
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">General</h3>
                                    <div class="card-tools">
                                   
                                        <popper trigger="hover" :options="{placement: 'top'}" v-if="cancel">
                                            <div class="popper">
                                                Ver mas
                                            </div>

                                            <button
                                                    type="button"
                                                    class="btn btn-tool"
                                                    slot="reference"
                                                    data-card-widget="collapse"
                                            >
                                                <i class="fas fa-minus fa-2x"></i>
                                            </button>
                                        </popper>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>¿ Alergias ? </label>
                                        <input type="checkbox" v-model="chkAllergies" @click="isActive(1)"> 
                                        <input type="text" v-model="txtAllergies" id="inputAllergies" :disabled="activeAllergies" class="form-control" placeholder="Describa las alergias que padece">
                                    </div>
                                    <div class="form-group">
                                        <label>¿ Padece Enfermedades ?</label>
                                         <input type="checkbox" v-model="chkDiseases" @click="isActive(2)">  
                                        <input type="text" id="inputDiseases"  v-model="txtDiseases" :disabled="activeDiseases" class="form-control" placeholder="Padece Enfermedades">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">¿ Toma Algún Medicamento ?</label>
                                         <input type="checkbox" v-model="chkMedicine" @click="isActive(3)"> 
                                        <input type="text" id="inputClientCompany" v-model="chkMedicine" :disabled="activeMedicine" class="form-control" placeholder="Toma Algún Medicamento">
                                    </div>
                                </div>
                            </div>
                        </div>
<!-- ANTECEDENTES ---------------------------------------------------------------------------------------->
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
                                        <label>Otras</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
<!-- LUGAR DE NACIMIENTO------------------------------------------------------------------------------------------------------------------ -->
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
<!-- NACIMIENTO ---------------------------------------------------------------------------------------->
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
<!-- INFORMACION MEDICA ---------------------------------------------------------------------------------------->
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
    import popper from 'vue-popperjs/dist/vue-popper';
    import 'vue-popperjs/dist/vue-popper.css';
    export default {
        data(){
            return{
                allergies       :  '',
                chkAllergies    : false,
                chkDiseases     : false,
                chkMedicine     : false,
                titlePage       : 'Perfil clinico',
                result          : false,
                txtAllergies    : '',
                txtDiseases     : '',
                chkMedicine     : '',
                activeAllergies : true,
                activeDiseases  : true,
                activeMedicine  : true,



            }
        },

        methods:{

            isActive(chkPress){

                switch(chkPress){
                    case 1:
                        (this.chkAllergies  == false) ? this.activeAllergies = false : this.activeAllergies = true;
                        
                    break;
                    case 2:
                        (this.chkDiseases  == false) ? this.activeDiseases = false : this.activeDiseases = true;
                    break;
                    case 3:
                        (this.chkMedicine  == false) ? this.activeMedicine = false : this.activeMedicine = true;
                    break;

                }
               

            },


            setTitlePage(){
                document.getElementById("titleHeader").innerHTML = this.titlePage;
            },

              components:{ popper }
        },


        mounted() {
            console.log('Component mounted.');
            this.setTitlePage();

        }
    }
        
</script>
