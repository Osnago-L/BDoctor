<template>
    <div class="ms_background">
        <div class="ms_background_search">
            <div class="container-fluid px-5 margin-top">
                <div class="row align-items-center">
                    <div
                        class="col-sm-12 col-md-5 offset-md-7 mb-3 text-white text-right"
                    >
                        <h1>Cerca tra i nostri migliori medici specialisti:</h1>
                    </div>

                    <div
                        class="d-flex align-items-center col-sm-12 col-md-4 offset-md-8"
                    >
                        <div class="input-group">
                            <select
                                id="title_select"
                                class="custom-select"
                                v-model="input"
                            >
                                <option value="" selected>{{ alert }}</option>
                                <option value="podologia">Podologia</option>
                                <option value="urologia">Urologia</option>
                                <option value="dermatologia">
                                    Dermatologia
                                </option>
                                <option value="Andrologia">Andrologia</option>
                                <option value="Gastroenterologia">Gastroenterologia</option>
                                <option value="Ginecologia">Ginecologia</option>
                                <option value="Oculistica">Oculistica</option>
                                <option value="Ortopedia">Ortopedia</option>
                                <option value="Proctologia">Proctologia</option>
                            </select>
                            <div class="input-group-append">
                                <router-link
                                    @click.native="checkIfEmpty()"
                                    :event="input ? 'click' : ''"
                                    :to="{
                                        name: 'search',
                                        query: {
                                            title: input,
                                            page: 1,
                                        },
                                    }"
                                >
                                    <button
                                        type="button"
                                        class="text-white button-search btn button_ms_blue"
                                    >
                                        Cerca
                                    </button>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 ms_sponsored-doctors-container">
            <div class="container">
                <h2 class="text-center my-4">Medici in evidenza</h2>
                <div class="row">
                        <div
                            class="col-sm-6 col-lg justify-content-center"
                            v-for="element in doctors"
                            :key="element.id"
                        >
                        <router-link :to="{name:'single-doctor', params:{id:element.id}}">
                            <div class="text-center ms_img-container">
                                <img
                                    v-if="element.image"
                                    :src="'../storage/' + element.image"
                                    alt=""
                                />
                                <img
                                    v-else
                                    src="../../../../public/img/default_user.webp"
                                    alt=""
                                />
                            </div>
    
                            <h4 class="text-center mt-3">
                                {{
                                    element.name.charAt(0).toUpperCase() +
                                    element.name.slice(1)
                                }}
                                {{
                                    element.surname.charAt(0).toUpperCase() +
                                    element.surname.slice(1)
                                }}
                            </h4>
                            <h6 class="text-center">
                                {{ element.titles[0].name }}
                            </h6>
                        </router-link>
                        </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-12 col-md-4 ms_bdoctor-info-card ">
                    <div class="card-background">
                        <img class="mb-3"
                            src="https://www.idoctors.it/images/frontend/consultazione-sito.svg?v=2"
                            alt=""
                        />
                        <h5>Scegli un medico</h5>
                        <p>
                            Fai la scelta migliore secondo le tue esigenze:
                            valuta curriculum, prezzo delle prestazioni,
                            patologie trattate e recensioni degli altri
                            pazienti.
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 ms_bdoctor-info-card mb-3">
                    <div class="card-background">
                        <img class="mb-3"
                            src="https://www.idoctors.it/images/frontend/prenotazione-online.svg?v=2"
                            alt=""
                        />
                        <h5>Prenota la visita</h5>
                        <p>
                            Ti bastano pochi secondi: è facile e veloce, non
                            serve telefonare e non è richiesta la carta di
                            credito: pagherai direttamente al medico.
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 ms_bdoctor-info-card mb-3">
                    <div class="card-background">
                        <img class="mb-3"
                            src="https://www.idoctors.it/images/frontend/medico-e-paziente.svg?v=2"
                            alt=""
                        />
                        <h5>Vai all'appuntamento</h5>
                        <p>
                            Vai dal Medico scelto, nel giorno e nell'ora
                            selezionati. Dopo la visita potrai lasciare una tua
                            recensione che sarà utile per gli altri pazienti.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="doctor_background">
            <div class="container mt-5">
                <div class="row px-3 px-lg-0">
                    <div class="col-sm-6 ms_doctor-reg
                    ">
                        <img
                            src="https://www.idoctors.it/images/frontend/medico-vertical.svg"
                            alt=""
                        />
                    </div>
                    <div class="col-sm-6">
                        <h5>Sei un medico?</h5>
                        <p>Iscriviti e raggiungi nuovi pazienti</p>
                        <p>
                            Più di 2 milioni di pazienti cercano ogni mese il
                            loro Medico su iDoctors, il primo sito in Italia per
                            visitatori e numero di prenotazioni.
                        </p>
                        <p>Con BDoctors:</p>
                        <ul>
                            <li>Ricevi prenotazioni da nuovi pazienti</li>
                            <li>
                                Migliori la tua visibilità e la tua reputazione
                                online
                            </li>
                            <li>
                                Organizzi al meglio il tuo lavoro con una suite
                                completa di strumenti dedicati al Medico
                            </li>
                            <li>
                                Puoi usare la nostra App multipiattaforma
                                dedicata ai Medici
                            </li>
                            <li>
                                Hai il nostro staff sempre disponibile ad
                                aiutarti
                            </li>
                        </ul>
                        <a href="/register">
                            <button type="button" class="btn btn-warning">
                                Registrati
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Home",
    data() {
        return {
            input: "",
            alert: "Scegli una specializzazione...",
            doctors: [],
        };
    },
    created() {
        this.getApi();
    },
    methods: {
        checkIfEmpty() {
            if (!this.input) {
                this.alert =
                    "Selezionare una specializzazione per continuare...";
            }
        },
        random(min, max) {
            return min + Math.floor(Math.random() * (max - min + 1));
        },
        getApi() {
            axios.get(`/api/doctors`).then((response) => {
                let randomPick = [];
                let maxUsers =
                    response.data.data.sponsoredDoctors.length < 4
                        ? response.data.data.sponsoredDoctors.length
                        : 4;

                while (randomPick.length < maxUsers) {
                    let numGen = this.random(
                        0,
                        response.data.data.sponsoredDoctors.length - 1
                    );

                    if (!randomPick.includes(numGen)) {
                        randomPick.push(numGen);
                    }
                }

                console.log(randomPick);
                for (let k = 0; k < maxUsers; k++) {
                    this.doctors.push(
                        response.data.data.sponsoredDoctors[randomPick[k]]
                    );
                }
                console.log(this.doctors);
            });
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/guest/_variables.scss";
.ms_background {
    background-image: linear-gradient($ms_white, white);
}
.ms_background_search {
    background-image: url("https://www.cura-avanzata.it/wp-content/uploads/2019/07/andrologo-torino.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    height: 700px;
    display: flex;
    align-items: center;
    position: relative;

    &::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }
}
.margin-top {
    margin-top: 250px;
}

.card-background {
    min-height: 333px;
    padding: 10px 10px;
    background-color: rgba($ms_white, 0.4);
    border-radius: 20px;
}
.doctor_background {
    margin-top: 30px;
    padding: 20px 0;
    background-color: rgba($ms_cyan, 0.05);
}

.ms_height {
    height: 35px;
}
.ms_bdoctor-info-card {
    text-align: center;
    img {
        width: 50%;
        height: auto;
        border-radius: 50%;
    }
}
.ms_doctor-reg {
    img {
        width: 100%;
        height: 500px;
    }
}
.ms_sponsored-doctors-container {
    padding: 10px 10px;
    background-color: rgba($ms_white, 0.4);
    border-radius: 20px;
    .ms_img-container {
        img {
            aspect-ratio: 1/1;
            border-radius: 50%;
            height: 200px;
            width: auto;
        }
    }
    a {
        color: inherit;
        text-decoration: none;
    }
}
</style>
