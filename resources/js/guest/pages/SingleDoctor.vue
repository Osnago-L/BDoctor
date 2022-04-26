<template>
    <div class="all_bac">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mr-5 mt-4 col-12 profile_scr">
                    <div :class="doctor.sponsorships.length==0 ? 'd-none' : 'd-block'" class="col-2 mt-4">
                        <img src="https://1.bp.blogspot.com/-oESQV74WVu8/Wn8p7575E5I/AAAAAAAAKco/_y8P6VjRF0oQK7Dx-2vhF81MhB-etCSJwCEwYBhgL/s1600/Sponsored-Stamp.png" alt="" class="w-100">
                    </div>
                    <div class="row d-flex align-items-center justify-content-center mt-5 personal_i">
                        <div class="col-4 text-center">
                            <div v-if="doctor.birth_date">
                                <span>Anno di nascita:</span> 
                                {{formattazione_anno(doctor.birth_date,true)}}
                            </div>
                            <div><span>Indirizzo:</span> {{doctor.address}}</div>
                            <div class="my_hr"></div>
                        </div>
                        <div class="col-3 img-show back_user" v-if="doctor.image" >
                            <img class="w-100" :src="'../storage/'+doctor.image">   
                        </div>
                        <div class="col-3 img-show no_photo" v-else>
                            <img class="w-100" src="https://cdn-icons-png.flaticon.com/512/149/149071.png">   
                        </div>
                        <div class="col-4 text-center">
                            <div v-if="doctor.phone_n"><span>Numero di telefono:</span> {{doctor.phone_n}}</div>
                            <div class="my_hr"></div>
                        </div>
                    </div>
                    <div class="text-center m-5">
                        <h2>{{doctor.name}} {{doctor.surname}}</h2>     
                    </div>
                    <div class="row justify-content-around">
                        <div class="bb col-5 p-0 ml-2 mt-4 text-center">
                            <h5 class="">Specializzazioni</h5>
                            <span class="ml-4" v-for="(title,index) in doctor.titles" :key="index">
                                <div class="txt"><i class="bi bi-mortarboard"></i> {{title.name}}</div>
                            </span>
                        </div>
                        <div v-if="doctor.performances" class="bb p-0 col-5 mt-4 text-center">
                            <h5 class="">Prestazioni</h5>
                            <span class="ml-4" v-for="(performance,index) in doctor.performances" :key="index">
                                <div class="txt">{{performance.name}}</div>
                            </span>
                        </div>
                    </div>
                    <div class=" m-5 text-center"><router-link :to="{ name:'message', params: { id:doctor.id }}"><button type="button" class="rew_button">Scrivi un Messaggio</button></router-link></div>
                    <div>
                        <h5 class="ml-4 mt-5" v-if="doctor.cv">Curriculum Vitae:</h5>
                        <div class="ml-4 txt">{{doctor.cv}}</div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mt-4 h_rew text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="text-center mt-4">Recensioni </h3> 
                        <span class="personal_i"> ({{doctor.reviews.length}})</span>
                    </div>
                    <div class="personal_i"> Media Recensioni: 
                        <span v-for="n in media(doctor.reviews)" :key="n">
                            <i class="star bi bi-star-fill"></i>
                        </span>
                    </div>   
                    <router-link :to="{ name:'review', params: { id:doctor.id }}"><button type="button" class="rew_button mt-3">Scrivi una recensione</button></router-link>

                    <div class="review_my" v-for="(review,index) in filterRew(doctor.reviews)" :key="index">
                        <div class="mt-4 text-left" v-if="review">
                            <div>
                                <h5>{{review.title}}</h5>
                            </div>
                            <div>
                                <strong><i class="user bi bi-person-fill"></i>{{review.author}}</strong>
                            </div>
                            <div class="txt">
                                {{review.content}}
                            </div>
                            <div>
                                Voto:
                                    <span v-for="(score,index) in review.score" :key="index" class=""><i class="star bi bi-star-fill"></i></span>
                            </div>
                            <div class="date_rew mt-2">
                                {{formattazione_anno(review.created_at)}}
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 pt-5 personal_i" v-if="doctor.reviews.length==0">
                        Al momento non ci sono recensioni. Scrivere una recensione dopo l'esperienza aiuta il medico a migliorarsi e tutti gli utenti della piattaforma.
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
    methods:{
        formattazione_anno(dato,valore){
            const date= new Date(dato);
            if(valore){
                    return date.getFullYear();

            }else{
                    return date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear();
            }       
        },
        media(data){
            console.log(data);
            let getLength = data.length;
            let sum = 0
            data.map(x=>sum=sum + x.score)
            return Math.round(sum/getLength)

        } ,
        filterRew(array){
            console.log(array);
            return array.slice().sort(function(a, b){
            return (a.review > b.review) ? 1 : -1;
  });
}
        
    },

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
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css");
.all_bac{
    background-color: rgba($ms_white,0.5);
}
.date_rew{
    font-size: 10px;
}
.h_rew{
    height: calc(100vh - 90px) ;
    overflow: scroll;
    background-color:white ;
    border-top: 4px solid $ms_blue;
    border-bottom: 4px solid $ms_blue;
    border-radius: 5%;
    box-shadow: 2px 2px 30px 1px rgba(51, 58, 154, 0.1);
    transition: ease 0.5s;
}
.h_rew::-webkit-scrollbar {
    display: none;
}
.h_rew:hover{
    transition: all ease-in-out 0.5s;
    box-shadow: 2px 2px 30px 1px rgba(77, 87, 217, 0.415);
}

.profile_scr{
    background-color: white;
    height: calc(100vh - 90px) ;
    border-radius: 20px;
    box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.100);
    overflow-y: scroll;
    overflow-x: hidden;
    border-top: 5px solid $ms_pink;
    border-bottom: 5px solid $ms_pink;
    transition: ease 0.5s;
}
.profile_scr:hover{
    transition: all ease-in-out 0.5s;
    box-shadow: 2px 2px 30px 1px rgba(226, 109, 109, 0.324);
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
.txt{
    font-size: 12px;
    word-wrap: break-word;
}
.my_hr{
    margin-top: 20px;
    background-color:$ms_cyan;
    height: 2px;
}
div{
 .bb{
    border-left: 5px solid $ms_pink;
    border-radius: 10px;
 }
}
.rew_button{
    padding: 5px 10px;
    background-color: $ms_blue;
    border-radius: 10px;
    border: 2px solid white;
    color: white;
    font-size: 12px;
    transition: ease 0.5s;
}
.s_button{
    padding: 5px 10px;
    background-color: white;
    border-radius: 10px;
    border: 2px solid $ms_blue;
    color: $ms_blue;
    font-size: 12px;
    transition: ease 0.5s;
}
.rew_button:hover{
    background-color: rgba($ms_blue, 0.9);
    transition: all ease-in-out 0.5s;
}
.user{
    color: $ms_blue;
}
.star{
    color:  rgb(241, 241, 35);;
}
.review_my{
    padding-bottom: 15px;
    border-bottom: 1px solid white;
}
img{
    transition: ease 0.5s;
}
img:hover{
    filter: brightness(50%);
    transition: all ease-in-out 0.5s;
}
.back_user{
    background-image:image-set(url("'..storage'+ doctor.image"));
}
</style>