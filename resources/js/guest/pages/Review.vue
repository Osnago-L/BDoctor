<template>
    <div class="back_app">
        <div class="container">
            <div class="row justify-content-center">
                <div class="mt-4 d-none d-lg-block col-lg-4 blu_ln">
                    <div class="row d-flex align-items-center justify-content-center mt-5 personal_i">
                        <div class="col-4 text-center">
                            <div v-if="doctor.birth_date">
                                <span>Anno di nascita:</span> 
                                {{formattazione_anno(doctor.birth_date,true)}}
                            </div>
                            <div><span>Indirizzo:</span> {{doctor.address}}</div>
                            <div class="my_hr"></div>
                        </div>
                        <div class="col-3" v-if="doctor.image">
                            <img class="w-100 img-show" :src="'../storage/'+ doctor.image">   
                        </div>
                        <div class="col-3" v-else>
                            <img class="w-100 img-show" src="https://cdn-icons-png.flaticon.com/512/149/149071.png">   
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
                                <div class="sm_description"><i class="bi bi-mortarboard"></i> {{title.name}}</div>
                            </span>
                        </div>
                        <div v-if="doctor.performances" class="bb p-0 col-5 mt-4 text-center">
                            <h5 class="">Prestazioni</h5>
                            <span class="ml-4" v-for="(performance,index) in doctor.performances" :key="index">
                                <div class="sm_description">{{performance.name}}</div>
                            </span>
                        </div>
                    </div>
                    <div class=" m-5 text-center"><router-link :to="{ name:'message', params: { id:doctor.id }}"><button type="button" class="mt-5 rew_button">Scrivi un Messaggio</button></router-link></div>
                </div>
                <div class="col-lg-7 rew_scr col-12 mt-4 ml-5 h_rew text-center">
                    <div v-if="!reviewConfirm">
                        <form @submit.prevent="checkForm()">
                            <h4 class="m-4">Scrivi la tua Recensione</h4>
                            <label class="" for="score">Nome:</label>
                            <input
                                class="form-control"
                                type="text"
                                id="name"
                                placeholder=""
                                v-model="inputUtente.author"
                            />
                            <label class="mt-4 " for="score">Titolo Recensione:</label>
                            <input
                                class="form-control"
                                type="text"
                                id="name"
                                placeholder=""
                                v-model="inputUtente.title"
                            />
                            <label class="mt-4 " for="score">Testo Recensione:</label>
                            <textarea
                                class="form-control"
                                id="testo"
                                cols="30"
                                rows="5"
                                placeholder=""
                                v-model="inputUtente.content"
                            ></textarea>
                            <label class="mt-4 " for="score">Valutazione</label>

                            <select class="form-control" v-model="inputUtente.score" name="score" id="score">
                                <option value="1">1</option>
                                <option value="1.5">1.5</option>
                                <option value="2">2</option>
                                <option value="2.5">2.5</option>
                                <option value="3">3</option>
                                <option value="3.5">3.5</option>
                                <option value="4">4</option>
                                <option value="4.5">4.5</option>
                                <option value="5">5</option>
                            </select>
                            <button class="send_butt mt-4 mb-3" type="submit">Invia</button>
                            <div v-show="errors.length > 0">
                                <ul>
                                    <li
                                        v-for="(element, index) in errors"
                                        :key="index"
                                    >
                                        {{ element }}
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <div v-else class="">
                        <h4 class="m-5 pt-5 send"> Recensione inviata</h4>
                        <div class="sm_description">Grazie per la sua recensione.Lasciare una recensione aiuta i nostri utenti e il medico specialista.Grazie a questo servizio i nostri utenti poreanno selezionare il medico più indicato per loro e potrà aiutare i medici a comprendere critiche e apprezzamenti !</div>
                        <router-link :to="{ name:'single-doctor', params: { id:doctor.id }}"><button class="mt-5 rew_button">Torna indietro</button></router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            doctor: {},
            inputUtente: {
                author: "",
                title: "",
                content: "",
                score: "",
                user_id: null,
            },
            reviewConfirm: false,
            errors: []
        };
    },
    created() {
        this.getDoc();
    },
    methods: {
           
       formattazione_anno(dato,valore){
          const date= new Date(dato);
          if(valore){
                return date.getFullYear();

          }else{
                return date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear();
          }
         
       },
    
        getDoc: function () {
            axios
                .get(`/api/doctors/${this.$route.params.id}`)
                .then((response) => {
                    this.doctor = response.data;
                    this.inputUtente.user_id = this.doctor.id;
                    console.log(response.data);
                });
        },
        inviaRecensione: function () {
            axios.post(`/api/reviews/`, this.inputUtente).then((response) => {
                this.inputUtente.author = "";
                this.inputUtente.title = "";
                this.inputUtente.content = "";
                this.inputUtente.score = "";
                this.reviewConfirm = true;
                console.log(response);
            });
        },
        checkForm: function () {
            if (
                this.inputUtente.score
            ) {
                return this.inviaRecensione();
            }else {
                this.errors = [];
                if (!this.inputUtente.score) {
                    this.errors.push("Inserisci una valutazione!");
                }
            }
        },
        setStars: function (index) {

            this.inputUtente.score = index;
            let i = 1;
            document.getElementByClassName("ms_star").classList = 'fa far fa-star ms_star fa-2x';

            while (i <= index){
                document.getElementById("star"+i).className = 'fa fas fa-star ms_star active fa-2x';
                i++;
            }
            
            
        },
        isSelected: function(index){
            if (index <= this.inputUtente.score){
                return "fas active";
            }
            else return "far";
        }
    },
};
</script>

<style lang="scss" scoped>
@import '../../../sass/guest/_variables.scss';
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css");
.back_app{
    background-color: rgba($ms_white,0.5);
    position: relative;

    .back_rew{
        padding: 30px 80px;
        background-color: white;
        border-radius: 20px;
        box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.500);
    }
    ul{
        li{
            list-style-type: none;
        color: red;
        }
    }
    .send_butt{
        padding: 5px 10px;
        background-color: $ms_blue;
        border-radius: 10px;
        border: 2px solid white;
        color: white;
        font-size: 12px;
    }
    .sm_description{
        font-size: 12px;
    }
    .curr_h{
        max-height: 200px;
        overflow: scroll;
    }
    .curr_h::-webkit-scrollbar {
        display: none;
    }
    .rew_scr{
    background-color: white;
    border-radius: 20px;
    box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.100);
    height: calc(100vh - 90px) ;
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
    }
    .h_rew{
        max-height: 100vh;
        background-color: $ms_blue;
        color: white;
    }
    .send{
        color: $ms_green;
    }
    .blu_ln{
        height: calc(100vh - 90px) ;
        overflow: scroll;
        border-bottom: 4px solid $ms_blue;
        border-top: 4px solid $ms_blue;
        box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.100);
        border-radius: 5%;
    }
    img{
        transition: ease 0.5s;
    }
    img:hover{
        filter: brightness(50%);
        transition: all ease-in-out 0.5s;
    }
    input{
        background-color: rgba(5, 62, 122, 0.9176470588); 
        border: none;
        color: white;
    }
    textarea{
        border: none;
        background-color: rgba(5, 62, 122, 0.9176470588); 
    }
    select{
            border: none;
            background-color: rgba(5, 62, 122, 0.9176470588); 
        option{
            border: none;
            background-color: rgba(5, 62, 122, 0.9176470588); 
            color: white;
            
        }
    }
}
</style>
