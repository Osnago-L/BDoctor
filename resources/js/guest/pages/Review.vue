<template>
    <div class="container-lg mt-4">

        <form @submit.prevent="checkForm()">
            <div class="input-row">
                <input
                    type="text"
                    id="name"
                    placeholder="Il tuo nome / nickname"
                    v-model="inputUtente.author"
                />
                </div>
            <div class="input-row">
                <input
                    type="text"
                    id="name"
                    placeholder="Titolo della recensione"
                    v-model="inputUtente.title"
                />
            </div>
            <div class="input-row">
                <textarea
                    id="testo"
                    cols="30"
                    rows="5"
                    placeholder="Testo della recensione"
                    v-model="inputUtente.content"
                ></textarea>
            </div>

            <div class="input-row">
                <label for="score">Valutazione</label>
                <span class="ms_required">*</span>
            
                <div class="stars">
                    <i v-for="index in 5" :id="'star'+index" :key="'star'+index"
                    :class='isSelected(index)' class='fa-star fa-2x ms_star'  @click="setStars(index)"
                    ></i>
                </div>
            </div>

            <button class='col-sm-10 col-md-5' type="submit">Invia</button>
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
        <div v-show="reviewConfirm">Inviato!</div>
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

<style scoped>

    .input-row {
        margin: 1rem 0;
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

    .ms_required {
        color: red;
        font-weight: bold;
    }

    input, textarea {
        width: 80%;
    }

    button[type='submit'] {
        background-color: #194471;
        color: white;
        padding: 0.5rem 0;
        font-variant: small-caps;
        font-size: 1.2rem;
        border-radius: 8px;
    }

    button[type='submit']:hover {
        font-weight: bolder;
        opacity: 0.9;
        color: red;
    }
</style>
