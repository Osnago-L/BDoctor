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
                placeholder="Inserisci un titolo"
                v-model="inputUtente.title"
            />
            <textarea
                id="testo"
                cols="30"
                rows="5"
                placeholder="Scrivi qui"
                v-model="inputUtente.content"
            ></textarea>
            <label for="score">Valutazione</label>

            <select v-model="inputUtente.score" name="score" id="score">
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
            <button type="submit">Invia</button>
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
            axios.post(`/api/reviews/`, this.inputUtente).then((response) => {
                this.inputUtente.author = "";
                this.inputUtente.title = "";
                this.inputUtente.content = "";
                this.inputUtente.score = "";
                this.reviewConfirm = true;
                console.log(response);
            });
        },
    },
};
</script>

<style></style>

