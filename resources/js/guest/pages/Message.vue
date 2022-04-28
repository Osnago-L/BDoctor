<template>
    <div class="ground all_page pb-5">
        <div class="container">
            <div class="row justify-content-between">
                <!-- <div class="col-3 text-center d-lg-none">
                    <div class="sm_description breack_sb">
                        specializzazioni:
                        <span
                            class=""
                            v-for="(title, index) in doctor.titles"
                            :key="index"
                        >
                            <div class="sm_description">
                                <i class="bi bi-mortarboard"></i>
                                {{ title.name }}
                            </div>
                        </span>
                    </div>
                </div>
                <div class="d-lg-none" v-if="doctor.image">
                    <img class="img-show" :src="'/storage/' + doctor.image" />
                </div>
                <div class="d-lg-none img-show" v-else>
                    <img
                        class="w-100"
                        src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                    />
                </div>
                <div class="col-3 text-center d-lg-none breack_sb">
                    <div>
                        <span class="sm_description">Indirizzo:</span
                        ><span class="sm_description">{{
                            doctor.address
                        }}</span>
                    </div>
                    <div v-if="doctor.phone_n">
                        <span class="sm_description">Numero di telefono:</span
                        ><span class="sm_description">{{
                            doctor.phone_n
                        }}</span>
                    </div>
                </div> -->
                <div class="col-12">
                    <div class="ms_card d-flex my-3">
                        <div class="d-flex px-4">
                            <div class="ms_image" v-if="doctor.image">
                                <img
                                    class="rounded-circle circle"
                                    :src="'/storage/' + doctor.image"
                                />
                            </div>

                            <div class=" img-show" v-else>
                                <img
                                    class="w-100"
                                    src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                                />
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div>
                                <h3>{{ doctor.name }} {{ doctor.surname }}</h3>
                            </div>
                            <div>
                                <p>
                                    <i class="fa-solid fa-envelope px-2"></i
                                    >{{ doctor.email }}
                                    <i class="fa-solid fa-phone px-2"></i
                                    >{{ doctor.phone_n }}
                                </p>
                                <!-- <p>{{ doctor.phone_n }}</p> -->
                            </div>
                            <div class="">
                                <i class="fa-solid fa-stethoscope"></i
                                >specializzazioni:
                                <div
                                    v-for="(title, index) in doctor.titles"
                                    :key="index"
                                    class="sm_description badge ms_badge m-1 text-white"
                                >
                                    <i class=""></i>
                                    {{ title.name }}
                                </div>

                                <div class="">
                                    <i class="bi bi-mortarboard"></i
                                    >Prestazioni:
                                    <div
                                        v-for="(
                                            performance, index
                                        ) in doctor.performances"
                                        :key="index"
                                        class="sm_description badge ms_badge m-1 text-white"
                                    >
                                        {{ performance.name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-left shadow_my">
                    <form @submit.prevent="checkForm()">
                    <div class="title">
                        Scrivi un messaggio a {{ doctor.name }} {{ doctor.surname }}
                    </div>
                    <div class="input-container ic1 mb-2">
                        <input
                            type="text"
                            class="input"
                            id="name"
                            placeholder=" "
                            v-model="inputUtente.author"
                        />
                        <div class="cut"></div>
                        <label for="firstname" class="placeholder">Nome</label>
                        <div v-show="errors.name">
                            <ul>
                                <li class="errorss text-right">
                                    {{ errors.name }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="input-container ic2">
                        <input
                            id="email"
                            class="input"
                            type="text"
                            placeholder=" "
                            v-model="inputUtente.email"
                        />
                        <div class="cut"></div>
                        <label for="lastname" class="placeholder">Email</label>
                        <div v-show="errors.mail">
                            <ul>
                                <li class="errorss text-right">
                                    {{ errors.mail }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="input-container ic2">
                        <input
                            id="testo"
                            class="input"
                            type="text"
                            placeholder=" "
                            v-model="inputUtente.content"
                        />
                        <div class="cut cut-short"></div>
                        <label for="text" class="placeholder">Testo</label>
                        <div v-show="errors.message">
                            <ul>
                                <li class="errorss text-right">
                                    {{ errors.message }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <button type="submit" class="ms_buttonform text-white my-3 px-3">
                        {{ confirmed }}
                    </button>
                </form>
                </div>
                <!-- <div v-show="messageConfirm">Inviato!</div> -->
            </div>
            <!-- <div class="col-2 text-center d-none d-lg-block">
                    <div class="sm_description">
                        specializzazioni:
                        <span
                            class="breack_sb"
                            v-for="(title, index) in doctor.titles"
                            :key="index"
                        >
                            <div class="sm_description">
                                <i class="bi bi-mortarboard"></i>
                                {{ title.name }}
                            </div>
                        </span>
                    </div>
                </div>
                <div class="d-none d-lg-block" v-if="doctor.image">
                    <img class="img-show" :src="'/storage/' + doctor.image" />
                </div>
                <div class="img-show d-none d-lg-block" v-else>
                    <img
                        class="w-100"
                        src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                    />
                </div>
                <div class="col-2 text-center breack_sb d-none d-lg-block">
                    <div>
                        <span class="sm_description">Indirizzo:</span
                        ><span class="sm_description">{{
                            doctor.address
                        }}</span>
                    </div>
                    <div v-if="doctor.phone_n">
                        <span class="sm_description breack_sb"
                            >Numero di telefono:</span
                        ><span class="breack_sb sm_description">{{
                            doctor.phone_n
                        }}</span>
                    </div>
                </div> -->
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
            errors: {
                name: "",
                mail: "",
                message: "",
            },
            confirmed: "Invia",
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
                this.errors.name = "";
                this.errors.mail = "";
                this.errors.message = "";
                this.confirmed = "Inviato!";
                this.$router.push({
                    name: "single-doctor",
                    params: { id: this.$route.params.id },
                });
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
                this.errors.name = "";
                this.errors.mail = "";
                this.errors.message = "";
                if (!this.inputUtente.author) {
                    this.errors.name = "Nome richiesto";
                }
                if (!this.inputUtente.email) {
                    this.errors.mail = "Inserisci una mail valida!";
                }
                if (!this.inputUtente.content) {
                    this.errors.message = "Inserisci un messaggio";
                }
            }
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/guest/_variables.scss";
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css");
.sm_description {
    font-size: 12px;
}
.all_page {
    height: 100vh;
}
.img-show {
    border-radius: 100%;
    transition: ease 0.5s;
    height: 160px;
    width: 160px;
}

.img-show:hover {
    filter: brightness(50%);
    transition: all ease-in-out 0.5s;
}
.breack_sb {
    word-break: break-word;
}
.shadow_my {
    padding: 30px 80px;
    background-color: $ms_blue;
    color: white;
    border-radius: 15px;
    box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.1);
}
.send_butt {
    padding: 5px 10px;
    background-color: rgba(5, 62, 122, 0.9176470588);
    border-radius: 10px;
    border: 2px solid white;
    color: white;
    font-size: 12px;
    margin-top: 15px;
}
.ground {
    background-color: $ms_white;
}
textarea {
    border: none;
    background-color: rgba(5, 62, 122, 0.9176470588);
}
.errorss {
    color: red;
    list-style-type: none;
}

.ms_card {
    padding: 15px 15px;
    box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    background-color: white;
    word-break: break-all;
}

.ms_image {
    img {
        width: 150px;
        height: 150px;
        background-color: #444;
    }

    .circle {
        border: 3px solid rgba(24, 67, 112, 0.7);
    }
}

.ms_badge {
    background-color: $ms_blue;
    font-size: 12px;
    font-weight: normal;
}

.form {
    background-color: #15172b;
    border-radius: 20px;
    box-sizing: border-box;
    height: 500px;
    padding: 20px;
    width: 320px;
}

.title {
    color: #eee;
    font-family: sans-serif;
    font-size: 36px;
    font-weight: 600;
    margin-top: 30px;
}

.subtitle {
    color: #eee;
    font-family: sans-serif;
    font-size: 16px;
    font-weight: 600;
    margin-top: 10px;
}

.input-container {
    height: 50px;
    position: relative;
    width: 100%;
}

.ic1 {
    margin-top: 40px;
}

.ic2 {
    margin-top: 30px;
}

.input {
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    border: 0;
    box-sizing: border-box;
    color: rgb(255, 247, 247);
    font-size: 18px;
    height: 100%;
    outline: 0;
    padding: 4px 20px 0;
    width: 100%;
}

.cut {
    background-color: #184370;
    border-radius: 10px;
    height: 20px;
    left: 20px;
    position: absolute;
    top: -20px;
    transform: translateY(0);
    transition: transform 200ms;
    width: 76px;
}

.cut-short {
    width: 50px;
}

.input:focus ~ .cut,
.input:not(:placeholder-shown) ~ .cut {
    transform: translateY(8px);
}

.placeholder {
    color: #ffffff;
    font-family: sans-serif;
    left: 20px;
    line-height: 14px;
    pointer-events: none;
    position: absolute;
    transform-origin: 0 50%;
    transition: transform 200ms, color 200ms;
    top: 20px;
}

.input:focus ~ .placeholder,
.input:not(:placeholder-shown) ~ .placeholder {
    transform: translateY(-30px) translateX(10px) scale(0.75);
}

.input:not(:placeholder-shown) ~ .placeholder {
    color: #808097;
}

.input:focus ~ .placeholder {
    color: #dc2f55;
}

.submit {
    background-color: #08d;
    border-radius: 12px;
    border: 0;
    box-sizing: border-box;
    color: #eee;
    cursor: pointer;
    font-size: 18px;
    height: 50px;
    margin-top: 38px;
    // outline: 0;
    text-align: center;
    width: 100%;
}

.submit:active {
    background-color: #06b;
}

.ms_buttonform {
    border: 0;
    width: 100px;
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    height: 35px;
    margin-top: 5px;

    &:hover {
        opacity: 0.5;
    }
}
</style>
