<template>
    <div class="back_app">
        <div class="container py-3">
            <h1>Scrivi una recensione</h1>
            <div class="row justify-content-center">
                
                <div class="mt-4 d-none d-lg-block col-lg-4 blu_ln">
                    <div
                        class="row d-flex align-items-center justify-content-center mt-4 personal_i"
                    >
                        <!-- <div class="col-4 text-center">
                            <div v-if="doctor.birth_date">
                                <span>Anno di nascita:</span>
                                {{
                                    formattazione_anno(doctor.birth_date, true)
                                }}
                            </div>
                            <div>
                                <span>Indirizzo:</span> {{ doctor.address }}
                            </div>
                            <div class="my_hr"></div>
                        </div> -->
                        <div class="col-4 text-center">
                            <div v-if="doctor.birth_date">
                                <span>Anno di nascita:</span>
                                {{
                                    formattazione_anno(doctor.birth_date, true)
                                }}
                            </div>
                            <div>
                                <span>Indirizzo:</span> {{ doctor.address }}
                            </div>
                            <div class="my_hr"></div>
                        </div>
                        <!-- <div class="" v-if="doctor.image">
                            <img
                                class="img-show"
                                :src="'/storage/' + doctor.image"
                            />
                        </div>
                        <div class="img-show" v-else>
                            <img
                                class="w-100"
                                src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                            />
                        </div> -->
                        <div class="" v-if="doctor.image">
                            <img
                                class="img_size"
                                :src="'/storage/' + doctor.image"
                            />
                        </div>
                        <div class="img-show no_photo" v-else>
                            <!-- <img
                                class="w-100"
                                src="../../../../public/img/default_user.webp"
                            /> -->
                        </div>
                        <!-- <div class="col-4 text-center">
                            <div v-if="doctor.phone_n">
                                <span>Numero di telefono:</span>
                                {{ doctor.phone_n }}
                            </div>
                            <div class="my_hr"></div>
                        </div>
                    </div>
                    <div class="text-center m-5">
                        <h2>
                            {{
                                doctor.name.charAt(0).toUpperCase() +
                                doctor.name.slice(1)
                            }}
                            {{
                                doctor.surname.charAt(0).toUpperCase() +
                                doctor.surname.slice(1)
                            }}
                        </h2>
                    </div> -->
                        <div class="col-4 text-center">
                            <div v-if="doctor.phone_n">
                                <span>Numero di telefono:</span>
                                {{ doctor.phone_n }}
                            </div>
                            <div class="my_hr"></div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h2>
                            {{
                                doctor.name.charAt(0).toUpperCase() +
                                doctor.name.slice(1)
                            }}
                            {{
                                doctor.surname.charAt(0).toUpperCase() +
                                doctor.surname.slice(1)
                            }}
                        </h2>
                    </div>
                    <!-- <div class="row justify-content-around">
                        <div class="bb col-5 p-0 ml-2 mt-4 text-center">
                            <h5 class="">Specializzazioni</h5>
                            <span
                                class="ml-4"
                                v-for="(title, index) in doctor.titles"
                                :key="index"
                            >
                                <div class="sm_description">
                                    <i class="bi bi-mortarboard"></i>
                                    {{ title.name }}
                                </div>
                            </span>
                        </div>
                        <div
                            v-if="doctor.performances"
                            class="bb p-0 col-5 mt-4 text-center"
                        >
                            <h5 class="">Prestazioni</h5>
                            <span
                                class="ml-4"
                                v-for="(
                                    performance, index
                                ) in doctor.performances"
                                :key="index"
                            >
                                <div class="sm_description">
                                    {{ performance.name }}
                                </div>
                            </span>
                        </div>
                    </div> -->
                    <div class="row justify-content-around">
                        <div class="bb col-5 mt-4">
                            <ul>
                                <h5 class="ml-2">
                                    <!-- <i class="bi bi-mortarboard"></i> -->
                                    Specializzazioni
                                </h5>
                                <li
                                    class="ml-4 mt-2 txt"
                                    v-for="(title, index) in doctor.titles"
                                    :key="index"
                                >
                                    {{ title.name }}
                                </li>
                            </ul>
                        </div>
                        <div class="bb col-5 mt-4">
                            <ul>
                                <h5 class="ml-2">
                                    <!-- <i
                                        class="icon fa-brands fa-accessible-icon"
                                    ></i> -->
                                    Prestazioni
                                </h5>
                                <li
                                    class="ml-4 mt-2 txt"
                                    v-for="(
                                        performance, index
                                    ) in doctor.performances"
                                    :key="index"
                                >
                                    {{ performance.name }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="m-5 text-center">
                        <router-link
                            :to="{ name: 'message', params: { id: doctor.id } }"
                            ><button type="button" class="mt-5 rew_button">
                                Scrivi un Messaggio
                            </button></router-link
                        >
                    </div> -->
                    <div class="text-center position_messageButton">
                        <router-link
                            :to="{ name: 'single-doctor', params: { id: doctor.id } }"
                            ><button type="button" class="rew_button">
                                Ritorna al profilo
                            </button></router-link
                        >
                    </div>
                </div>
                <div
                    class="col-lg-7 rew_scr col-12 mt-4 ml-md-3 h_rew text-center"
                >
                    <div v-if="!reviewConfirm">
                        <form @submit.prevent="checkForm()">
                            <h4 class="m-4">
                                Scrivi la tua Recensione a {{ doctor.name }}
                                {{ doctor.surname }}
                            </h4>
                            <div class="input-container ic1">
                                <input
                                    type="text"
                                    class="input"
                                    id="name"
                                    placeholder=" "
                                    v-model="inputUtente.author"
                                />
                                <div class="cut"></div>
                                <label for="firstname" class="placeholder"
                                    >Nome</label
                                >
                                <div v-show="errors.name">
                                    <ul>
                                        <li class="errorss">
                                            {{ errors.name }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--                             <label class="" for="score">Nome:</label>
                            <input
                                class="form-control"
                                type="text"
                                id="name"
                                placeholder="Inserire un nome..."
                                v-model="inputUtente.author"
                            /> -->
                            <!-- <label class="mt-4" for="score"
                                >Titolo Recensione:</label
                            >
                            <input
                                class="form-control"
                                type="text"
                                id="name"
                                placeholder="Inserire il titolo della recensione"
                                v-model="inputUtente.title"
                            /> -->
                            <div class="input-container ic1">
                                <input
                                    type="text"
                                    class="input"
                                    id="name"
                                    placeholder=" "
                                    v-model="inputUtente.title"
                                />
                                <div class="cut"></div>
                                <label for="firstname" class="placeholder"
                                    >Titolo</label
                                >
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
                                <label for="text" class="placeholder"
                                    >Testo</label
                                >
                            </div>
                            <!-- <label class="mt-4" for="score"
                                >Testo Recensione:</label
                            >
                            <textarea
                                class="form-control"
                                id="testo"
                                cols="30"
                                rows="5"
                                placeholder=" "
                                v-model="inputUtente.content"
                            ></textarea> -->

                            <div class="input-row">
                                <label for="score">Valutazione</label>
                                <span class="ms_required">*</span>

                                <div class="stars">
                                    <i
                                        v-for="index in 5"
                                        :id="'star' + index"
                                        :key="'star' + index"
                                        :class="isSelected(index)"
                                        class="fa-star fa-2x ms_star"
                                        @click="setStars(index)"
                                    ></i>
                                </div>
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
                            </div>
                            <button class="send_butt mt-4 mb-3" type="submit">
                                Invia
                            </button>
                        </form>
                    </div>
                    <div v-else class="">
                        <h4 class="m-5 pt-5 send">Recensione inviata</h4>
                        <div class="sm_description">
                            Grazie per la sua recensione.Lasciare una recensione
                            aiuta i nostri utenti e il medico specialista.Grazie
                            a questo servizio i nostri utenti poreanno
                            selezionare il medico più indicato per loro e potrà
                            aiutare i medici a comprendere critiche e
                            apprezzamenti !
                        </div>
                        <router-link
                            :to="{
                                name: 'single-doctor',
                                params: { id: doctor.id },
                            }"
                            ><button class="mt-5 rew_button">
                                Torna indietro
                            </button></router-link
                        >
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
            errors: [],
        };
    },
    created() {
        this.getDoc();
    },
    methods: {
        formattazione_anno(dato, valore) {
            const date = new Date(dato);
            if (valore) {
                return date.getFullYear();
            } else {
                return (
                    date.getDate() +
                    "-" +
                    (date.getMonth() + 1) +
                    "-" +
                    date.getFullYear()
                );
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
            if (this.inputUtente.score) {
                return this.inviaRecensione();
            } else {
                this.errors = [];
                if (!this.inputUtente.score) {
                    this.errors.push("Inserisci una valutazione!");
                }
            }
        },
        setStars: function (index) {
            this.inputUtente.score = index;
            let i = 1;
            document.getElementByClassName("ms_star").classList =
                "fa far fa-star ms_star fa-2x";

            while (i <= index) {
                document.getElementById("star" + i).className =
                    "fa fas fa-star ms_star active fa-2x";
                i++;
            }
        },
        isSelected: function (index) {
            if (index <= this.inputUtente.score) {
                return "fas active";
            } else return "far";
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/guest/_variables.scss";
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css");
.back_app {
    background-color: white;
    position: relative;

    .back_rew {
        padding: 30px 80px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.5);
    }
    ul {
        li {
            list-style-type: none;
            // color: red;
        }
    }
    .send_butt {
        padding: 5px 10px;
        background-color: $ms_blue;
        border-radius: 10px;
        border: 2px solid white;
        color: white;
        font-size: 12px;
        transition: ease 0.5s;
    }
    .send_butt:hover {
        filter: brightness(50%);
        transition: all ease-in-out 0.5s;
    }
    .sm_description {
        font-size: 12px;
    }
    .curr_h {
        max-height: 200px;
        overflow: scroll;
    }
    .curr_h::-webkit-scrollbar {
        display: none;
    }
    .rew_scr {
        background-color: white;
        border-radius: 8px;
        box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.2);
        height: calc(100vh - 170px);
    }
    .profile_scr::-webkit-scrollbar {
        display: none;
    }
    .img-show {
        background-image: url("https://cdn-icons-png.flaticon.com/512/149/149071.png");
        background-position: center;
        background-size: cover;
        height: 65px;
        width: 65px;
        border-radius: 100%;
    }
    .img_size {
        border-radius: 100%;
        height: 120px;
        width: 120px;
    }
    .personal_i {
        color: rgb(136, 136, 136);
        font-size: 12px;
    }
    .my_hr {
        height: calc(100vh - 170px);
        margin-top: 20px;
        background-color: rgba($ms_blue, 0.3);
        height: 2px;
    }
    div {
        .bb {
            border-left: 5px solid $ms_blue;
            border-radius: 10px;
        }
    }
    .rew_button {
        padding: 5px 10px;
        background-color: $ms_blue;
        border-radius: 10px;
        border: 2px solid white;
        color: white;
        transition: ease 0.5s;
        font-size: 12px;
    }
    .rew_button:hover {
        filter: brightness(50%);
        transition: all ease-in-out 0.5s;
    }
    .h_rew {
        max-height: 100vh;
        box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.5);
        background-color: $ms_blue;
        color: white;
    }
    .send {
        color: $ms_green;
    }
    .blu_ln {
        height: calc(100vh - 170px);
        overflow: scroll;
        border-bottom: 4px solid $ms_blue;
        border-top: 4px solid $ms_blue;
        box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }
    img {
        transition: ease 0.5s;
    }
    // img:hover {
    //     filter: brightness(50%);
    //     transition: ease-in-out 0.5s;
    // }
    /*     input {
        background-color: white;
        border: none;
        color: rgba(5, 62, 122, 0.9176470588);
    } */
    textarea {
        border: none;
        background-color: white;
    }
    select {
        border: none;
        background-color: white;
        option {
            border: none;
            background-color: rgbawhite;
            color: rgba(5, 62, 122, 0.9176470588);
        }
    }
    .ms_star {
        color: #777 !important;
    }

    .ms_star:hover {
        cursor: pointer;
    }
    .ms_star.active {
        color: orange !important;
    }
}
.position_messageButton {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
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
