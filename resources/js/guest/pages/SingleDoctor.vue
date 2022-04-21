<template>
    <div class="all_bac">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mt-4 col-12 profile_scr">
                    <div class="text-center m-5">
                        <h2>{{doctor.name}} {{doctor.surname}}</h2>     
                    </div>
                    <div class="row d-flex align-items-center mt-5 personal_i">
                        <div class="col-4 text-center">
                            <div v-if="doctor.birth_date"><span>Data di nascita:</span> {{doctor.birth_date}}</div>
                            <div><span>Indirizzo:</span> {{doctor.address}}</div>
                            <div class="my_hr"></div>
                        </div>
                        <div class="col-4">
                            <img class="w-100 img-show" src="https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png" alt="">   
                        </div>
                        <div class="col-4 text-center">
                            <div v-if="doctor.phone_n"><span>Numero di telefono:</span> {{doctor.phone_n}}</div>
                            <div><span>Mail:</span> {{doctor.email}}</div>
                            <div class="my_hr"></div>
                        </div>
                    </div>
                        <div class="row justify-content-around">
                            <div class="bb col-5 p-0 ml-2 mt-5 text-center">
                            <h4 class="">Specializzazioni</h4>
                            <span class="ml-4" v-for="(title,index) in doctor.titles" :key="index">
                                <div>{{title.name}}</div>
                            </span>
                        </div>
                        <div v-if="doctor.performances" class="bb p-0 col-5 mt-5 text-center">
                            <h4 class="">Performances</h4>
                            <span class="ml-4" v-for="(performance,index) in doctor.performances" :key="index">
                                <div>{{performance.name}}</div>
                            </span>
                        </div>
                    </div>
                    <div>
                        <h4 class="ml-4 mt-5" v-if="doctor.cv">Curriculum Vitae:</h4>
                        <div class="ml-4">{{doctor.cv}}</div>
                    </div>
                </div>
                <div class="col-lg-3 col-12 mt-5 h_rew">
                    <h3 class="text-center">RecenZioni</h3>
                     <div class="mt-5" v-for="(review,index) in doctor.reviews" :key="index">
                        <div>
                            <h5>{{review.title}}</h5>
                        </div>
                        <div>
                            <strong>{{review.author}}</strong>
                        </div>
                        <div>
                            {{review.content}}
                        </div>
                        <div class="date_rew mt-2">
                            {{review.created_at}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"SingleDoctor",
    data(){
        return{
            doctor:{},               //deve ritornare un oggetto
        }
    } ,
    created(){
        axios                                              //la chiamata axios avviene per verificare l'id del singolo elemento
        .get(`/api/doctors/${this.$route.params.id}`)    //il collegamento lo vediamo da ispeziona nel browser   this senza$
        .then((apirisp)=>{
            this.doctor= apirisp.data;
        })
    }
}
</script>

<style lang="scss" scoped>
@import '../../../sass/guest/_variables.scss';
.all_bac{
    background-color: $ms_white;
}
.date_rew{
    font-size: 10px;
}
.h_rew{
    max-height: calc(100vh - 120px) ;
    overflow: scroll;
}
.h_rew::-webkit-scrollbar {
    display: none;
}
.profile_scr{
    max-height: calc(100vh - 110px) ;
    overflow: scroll;
    border-radius: 20px;
    box-shadow: 10px 10px 40px grey;
}
.profile_scr::-webkit-scrollbar {
    display: none;
}
.img-show{
    border-radius: 100%;
}
.personal_i{
    color: rgb(136, 136, 136);
    font-size: 12px;
}
.my_hr{
    margin-top: 20px;
    background-color:$ms_cyan;
    height: 2px;
}
div{
 .bb{
    border-left: 3px solid $ms_pink;
 }
}

</style>