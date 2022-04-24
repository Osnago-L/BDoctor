<template>
    <div class="ground">
        <div class="container"> 
                <div class="row all_page justify-content-between align-items-center text-center">
                    <div class="col-2 text-center d-lg-none">
                        <div class="sm_description">
                        specializzazioni:
                        <span class="" v-for="(title,index) in doctor.titles" :key="index">
                            <div class="sm_description"><i class="bi bi-mortarboard"></i> {{title.name}}</div>
                        </span>
                    </div>
                </div>
                <div class="col-3 d-lg-none" v-if="doctor.image">
                    <img class="w-100 img-show" :src="doctor.image">   
                </div>
                <div class="col-3 d-lg-none" v-else>
                    <img class="w-100 img-show" src="https://cdn-icons-png.flaticon.com/512/149/149071.png">   
                </div>
                <div class="col-2 text-center d-lg-none">
                    <div><span class="sm_description">Indirizzo:</span><span class="sm_description">{{doctor.address}}</span></div>
                    <div v-if="doctor.phone_n"><span class="sm_description">Numero di telefono:</span><span class="sm_description">{{doctor.phone_n}}</span></div>
                </div>
                <div class="col-12 col-lg-6 shadow_my">
                    <form
                        @submit.prevent="checkForm();">
                        <h4 class="m-4">Scrivi a {{doctor.name}} {{doctor.surname}}</h4>
                        <label class="" for="score">Nome:</label>
                        <input
                            type="text"
                            class="form-control text-center"
                            id="name"
                            placeholder="Inserisci il tuo nome"
                            v-model="inputUtente.author"
                        />
                        <label class="" for="score">Mail:</label>
                        <input
                            type="email"
                            class="form-control text-center"
                            id="name"
                            placeholder="Inserisci la tua mail"
                            v-model="inputUtente.email"
                        />
                        <label class="" for="score">Messaggio:</label>
                        <textarea
                            class="form-control text-center"
                            id="testo"
                            cols="30"
                            rows="5"
                            v-model="inputUtente.content"
                        ></textarea>
                        
                        <button type="submit" class="send_butt">Invia</button>

                        <div v-show="errors.length > 0">
                            <ul>
                                <li
                                    v-for="(element, index) in errors"
                                    :key="index"
                                    style="color: red"
                                >
                                    {{ element }}
                                </li>
                            </ul>
                        </div>
                    </form>
                <div v-show="messageConfirm">Inviato!</div>
            </div>
            <div class="col-2 text-center d-none d-lg-block">
                <div class="sm_description">
                    specializzazioni:
                    <span class="" v-for="(title,index) in doctor.titles" :key="index">
                        <div class="sm_description"><i class="bi bi-mortarboard"></i> {{title.name}}</div>
                    </span>
                </div>
            </div>
            <div class="col-2 d-none d-lg-block" v-if="doctor.image">
                <img class="w-100 img-show" :src="doctor.image">   
            </div>
            <div class="col-2 d-none d-lg-block" v-else>
                <img class="w-100 img-show" src="https://cdn-icons-png.flaticon.com/512/149/149071.png">   
            </div>
            <div class="col-2 text-center d-none d-lg-block">
                <div><span class="sm_description">Indirizzo:</span><span class="sm_description">{{doctor.address}}</span></div>
                <div v-if="doctor.phone_n"><span class="sm_description">Numero di telefono:</span><span class="sm_description">{{doctor.phone_n}}</span></div>
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
                author: null,
                content: null,
                email: null,
                user_id: null,
            },
            messageConfirm: false,
            errors: [],
        };
    },
    created() {
        this.getDoc();
    },
    methods: {
        getDoc: function () {
            axios
                .get(`/api/doctors/${this.$route.params.id}`)
                .then((response) => {
                    this.doctor = response.data;
                    this.inputUtente.user_id = this.doctor.id;
                    console.log(response.data);
                });
        },
        inviaMessaggio: function () {
            axios.post(`/api/messages/`, this.inputUtente).then((response) => {
                this.inputUtente.author = "";
                this.inputUtente.content = "";
                this.messageConfirm = true;
                this.errors = [];
                console.log(response);
            });
        },
        checkForm: function () {
            if (
                this.inputUtente.author &&
                this.inputUtente.content &&
                this.inputUtente.email
            ) {
                return this.inviaMessaggio();
            } else {
                this.errors = [];
                if (!this.inputUtente.author) {
                    this.errors.push("Nome richiesto");
                }
                if (!this.inputUtente.email){
                    this.errors.push("Inserisci una mail valida!");
                }
                if (!this.inputUtente.content) {
                    this.errors.push("Inserisci un messaggio");
                }
            }
        },
    },
};
</script>

<style lang="scss" scoped>
@import '../../../sass/guest/_variables.scss';
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css");
.sm_description{
    font-size: 12px;
}
.all_page{
    height: calc(100vh - 80px) ;
}
img{
    transition: ease 0.5s;
}
img:hover{
    filter: brightness(50%);
    transition: all ease-in-out 0.5s;
}
.shadow_my{
    padding: 30px 80px;
    background-color: $ms_blue;
    color: white;
    border-radius: 15px;
    box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.100);
}
.send_butt{
    padding: 5px 10px;
    background-color: $ms_cyan;
    border-radius: 10px;
    border: 2px solid white;
    color: white;
    font-size: 12px;
    margin-top: 15px;
}
.ground{
    background-color: $ms_white;
}
</style>
