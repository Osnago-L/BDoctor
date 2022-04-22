<template>
    <div>
        <form @submit.prevent="inviaMessaggio()">
            <input
                type="text"
                id="name"
                placeholder="Inserisci il nome"
                v-model="inputUtente.author"
            />
            <input
                type="text"
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
                author: "",
                content: "",
                email: "",
                user_id: null,
            },
            messageConfirm: false,
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
                console.log(response);
            });
        },
    },
};
</script>

<style></style>

