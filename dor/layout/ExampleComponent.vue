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
                <section class="content col-md-9 card-anuncios">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2>Bienvenido</h2>
                                        </div>

                                        <div class="card-body">
                                            <h3 v-text="userName"></h3>
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
    export default {
        data(){
            return{
                userName : '',
                titlePage: '',

            }
        },

          methods:{
            

            getUser(){
                var user = ''
                     user =  document.getElementById("userName").innerHTML;
                this.userName = user
             // this.userName = 'Juan';

            },

             setTitlePage(){
                document.getElementById("titleHeader").innerHTML = this.titlePage;

            },


            

        },


        mounted() {
            this.setTitlePage();
            this.getUser();
        }
    }
</script>
