<template>
    <div>
        <form
            @submit.prevent="checkForm();">
            <input
                type="text"
                id="name"
                placeholder="Inserisci il nome"
                v-model="inputUtente.author"
            />
            <input
                type="email"
                id="name"
                placeholder="Inserisci la tua mail"
                v-model="inputUtente.email"
            />
            <textarea
                id="testo"
                cols="30"
                rows="5"
                placeholder="Scrivi qui"
                v-model="inputUtente.content"
            ></textarea>
            
            <button type="submit">Invia</button>

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

<style></style>
