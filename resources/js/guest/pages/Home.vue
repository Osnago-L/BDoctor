<template>
    <div class="ms_background">

      <div class="container-fluid pt-4 d-flex justify-content-center ms_background_search">
          <div class="row">
              <div class="d-flex align-items-center col-sm-12">
                  <label for="search"> <h3 class="m-0">Search the site: </h3></label>
              </div>

              <div class="d-flex align-items-center col-sm-12 col-md-6">
                  <input
                      v-model="input"
                      type="text"
                      id="search"
                      name="search"
                      autocomplete="off"
                      placeholder="Inserisci qui la tua ricerca"
                      class="ms_height w-100"
                  />
              </div>

          <!--<div class="col-sm-12">
                  <select class="w-100 mt-2 ms_height" v-model="selected">
                      <option value="opzione1">opzione1</option>
                      <option value="opzione2">opzione2</option>
                      <option value="opzione3">opzione3</option>
                  </select>
              </div> -->

              <div class="d-flex align-items-center col-sm-12 col-md-6 p-3">
                  <router-link
                      :to="{
                          name: 'search',
                          query: { search: input, title: selected },
                      }"
                  >
                      <button type="button" class="btn btn-primary">
                          Search
                      </button>
                  </router-link>
              </div>
          </div>
      </div>

      <div class="container mt-5">
        <div class="row">
          <div class="col-sm-12 col-md-4 ms_bdoctor-info-card">
            <img src="https://www.idoctors.it/images/frontend/consultazione-sito.svg?v=2" alt="">
            <h6>Scegli un medico</h6>
            <p>Fai la scelta migliore secondo le tue esigenze: valuta curriculum, prezzo delle prestazioni, patologie trattate e recensioni degli altri pazienti.</p>
          </div>
          <div class="col-sm-12 col-md-4 ms_bdoctor-info-card">
            <img src="https://www.idoctors.it/images/frontend/prenotazione-online.svg?v=2" alt="">
            <h6>Prenota la visita</h6>
            <p>Ti bastano pochi secondi: è facile e veloce, non serve telefonare e non è richiesta la carta di credito: pagherai direttamente al medico.</p>
          </div>
          <div class="col-sm-12 col-md-4 ms_bdoctor-info-card">
            <img src="https://www.idoctors.it/images/frontend/medico-e-paziente.svg?v=2" alt="">
            <h6>Vai all'appuntamento</h6>
            <p>Vai dal Medico scelto, nel giorno e nell'ora selezionati. Dopo la visita potrai lasciare una tua recensione che sarà utile per gli altri pazienti.</p>
          </div>
        </div>
      </div>

      <div class="container mt-5">
        <div class="row">
          <div class="col-sm-6 ms_doctor-reg">
            <img src="https://www.idoctors.it/images/frontend/medico-vertical.svg" alt="">
          </div>
          <div class="col-sm-6">
            <h5>
              Sei un medico?
            </h5>
            <p>Iscriviti e raggiungi nuovi pazienti</p>
            <p>Più di 2 milioni di pazienti cercano ogni mese il loro Medico su iDoctors, il primo sito in Italia per visitatori e numero di prenotazioni.</p>
            <p>Con iDoctors:</p>
            <ul>
              <li>
                Ricevi prenotazioni da nuovi pazienti
              </li>
              <li>
                Migliori la tua visibilità e la tua reputazione online
              </li>
              <li>
                Organizzi al meglio il tuo lavoro con una suite completa di strumenti dedicati al Medico
              </li>
              <li>
                Puoi usare la nostra App multipiattaforma dedicata ai Medici
              </li>
              <li>
                Hai il nostro staff sempre disponibile ad aiutarti
              </li>
            </ul>
            <button type="button" class="btn btn-warning">Registrati qui</button>
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
            selected: "",
        };
    },
/*     created() {
        this.getDocs();
    },
    methods: {
        getDocs: function () {
            axios.get("/api/doctors").then((response) => {
                this.doctors = response.data;
            });
        },
    } */
};
</script>

<style lang="scss" scoped>
@import "../../../sass/guest/_variables.scss";
.ms_background{
  background-image: linear-gradient($ms_white, white);
}

.ms_height {
    height: 35px;
}
.ms_bdoctor-info-card{
  text-align: center;
  img{
    width: 50%;
    height: auto;
    border-radius: 50%;
  }
}
.ms_doctor-reg{
  img{
    width: 100%;
    height: 500px;
  }
}

</style>
