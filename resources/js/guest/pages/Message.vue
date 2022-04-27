<template>
    <div class="ground all_page d-flex align-items-center">
        <div class="container"> 
                <div class="row justify-content-between align-items-center text-center">
                    <div class="col-3 text-center d-lg-none">
                        <div class="sm_description breack_sb">
                        specializzazioni:
                        <span class="" v-for="(title,index) in doctor.titles" :key="index">
                            <div class="sm_description"><i class="bi bi-mortarboard"></i> {{title.name}}</div>
                        </span>
                    </div>
                </div>
                <div class="d-lg-none" v-if="doctor.image">
                    <img class="img-show" :src="'/storage/'+ doctor.image"> 
                </div>
                <div class="d-lg-none img-show" v-else>
                    <img class="w-100 " src="https://cdn-icons-png.flaticon.com/512/149/149071.png">   
                </div>
                <div class="col-3 text-center d-lg-none breack_sb">
                    <div><span class="sm_description">Indirizzo:</span><span class="sm_description">{{doctor.address}}</span></div>
                    <div v-if="doctor.phone_n"><span class="sm_description">Numero di telefono:</span><span class="sm_description">{{doctor.phone_n}}</span></div>
                </div>
                <div class="col-12 text-left col-lg-6 shadow_my">
                    <form
                        @submit.prevent="checkForm();">
                        <h4 class="text-center m-4">Scrivi a {{doctor.name}} {{doctor.surname}}</h4>
                        <label class="" for="score">Nome:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            placeholder="Inserisci il tuo nome"
                            v-model="inputUtente.author"
                            
                        />
                        <div v-show="errors.length > 0">
                            <ul>
                                <li class="errorss"
                                >
                                    {{errors[0]}}
                                </li>
                            </ul>
                        </div>
                        <label class="" for="score">Mail:</label>
                        <input
                            type="email"
                            class="form-control"
                            id="name"
                            placeholder="Inserisci la tua mail"
                            v-model="inputUtente.email"
                        />
                        <div v-show="errors.length > 0">
                            <ul>
                                <li class="errorss"
                                >
                                    {{errors[1]}}
                                </li>
                            </ul>
                        </div>
                        <label class="" for="score">Messaggio:</label>
                        <textarea
                            class="form-control"
                            id="testo"
                            cols="30"
                            rows="5"
                            v-model="inputUtente.content"
                        ></textarea>
                        <div v-show="errors.length > 0">
                            <ul>
                                <li class="errorss"
                                >
                                    {{errors[2]}}
                                </li>
                            </ul>
                        </div>
                        <button type="submit" class="send_butt">Invia</button>
                    </form>
                <div v-show="messageConfirm">Inviato!</div>
            </div>
            <div class="col-2 text-center d-none d-lg-block">
                <div class="sm_description">
                    specializzazioni:
                    <span class="breack_sb" v-for="(title,index) in doctor.titles" :key="index">
                        <div class="sm_description"><i class="bi bi-mortarboard"></i> {{title.name}}</div>
                    </span>
                </div>
            </div>
            <div class="d-none d-lg-block" v-if="doctor.image">
                <img class="img-show" :src="'/storage/'+ doctor.image"> 
            </div>
            <div class="img-show d-none d-lg-block" v-else>
                <img class="w-100" src="https://cdn-icons-png.flaticon.com/512/149/149071.png">   
            </div>
            <div class="col-2 text-center breack_sb d-none d-lg-block">
                <div><span class="sm_description">Indirizzo:</span><span class="sm_description">{{doctor.address}}</span></div>
                <div v-if="doctor.phone_n"><span class="sm_description breack_sb">Numero di telefono:</span><span class="breack_sb sm_description">{{doctor.phone_n}}</span></div>
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
    height: 100vh; 
}
.img-show{
    border-radius: 100%;
    transition: ease 0.5s;
    height: 160px;
    width: 160px;
}

.img-show:hover{
    filter: brightness(50%);
    transition: all ease-in-out 0.5s;
}
.breack_sb{
    word-break: break-word;
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
    background-color: rgba(5, 62, 122, 0.9176470588);
    border-radius: 10px;
    border: 2px solid white;
    color: white;
    font-size: 12px;
    margin-top: 15px;
}
.ground{
    background-color: $ms_white;
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
.errorss{
    color: red;
    list-style-type: none;
}
</style>
