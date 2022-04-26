<template>
  <div class="background_color">
    <div class="container">
      <!-- ///////////////////// -->
      <!-- search bar -->
      <div class="row">
        <!-- /////////////////// -->
        <div
          class="
            d-flex
            align-items-center
            justify-content-between
            search-group
            test_color
            col-12
            px-3
          "
        >
          <div>
            <a
              id="filter"
              class="d-flex align-items-center"
              @click="filterDrop()"
            >
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path
                  d="M320 224H416c17.67 0 32-14.33 32-32s-14.33-32-32-32h-95.1c-17.67 0-32 14.33-32 32S302.3 224 320 224zM320 352H480c17.67 0 32-14.33 32-32s-14.33-32-32-32h-159.1c-17.67 0-32 14.33-32 32S302.3 352 320 352zM320 96h32c17.67 0 31.1-14.33 31.1-32s-14.33-32-31.1-32h-32c-17.67 0-32 14.33-32 32S302.3 96 320 96zM544 416h-223.1c-17.67 0-32 14.33-32 32s14.33 32 32 32H544c17.67 0 32-14.33 32-32S561.7 416 544 416zM192.4 330.7L160 366.1V64.03C160 46.33 145.7 32 128 32S96 46.33 96 64.03v302L63.6 330.7c-6.312-6.883-14.94-10.38-23.61-10.38c-7.719 0-15.47 2.781-21.61 8.414c-13.03 11.95-13.9 32.22-1.969 45.27l87.1 96.09c12.12 13.26 35.06 13.26 47.19 0l87.1-96.09c11.94-13.05 11.06-33.31-1.969-45.27C224.6 316.8 204.4 317.7 192.4 330.7z"
                />
              </svg>
              <span class="ml-1 font-weight-bold"
                >Filter({{ Object.keys(this.$route.query).length - 1 }})</span
              >
            </a>
          </div>
          <div class="w-50">
            <div class="input-group">
              <select id="title_select" class="custom-select" v-model="title">
                <option value="" selected>{{ alert }}</option>
                <option value="podologia">Podologia</option>
                <option value="urologia">Urologia</option>
                <option value="dermatologia">Dermatologia</option>
                <option value="cardiologia">Cardiologia</option>
              </select>
              <div class="input-group-append">
                <router-link
                  @click.native="checkIfEmpty()"
                  :event="title ? 'click' : ''"
                  :to="{}"
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
        <!-- /////////////////// -->
        <div id="filter-box" class="filter-group">
          <div class="row p-4">
            <div class="col-3 d-flex flex-column">
              <a
                v-for="(element, index) in 4"
                :key="'a' + index"
                :id="4 - index"
                :class="[score == 4 - index ? 'font-weight-bold' : '']"
                @click="
                  [score == 4 - index ? (score = 0) : (score = 4 - index)]
                "
                >{{ 4 - index }} stelle o più</a
              >
            </div>
            <div class="col-3 d-flex flex-column">
              Numero recensioni:
              <a
                :class="[reviews == 1 ? 'font-weight-bold' : '']"
                @click="[reviews == 1 ? (reviews = 0) : (reviews = 1)]"
                >1+</a
              >
              <a
                :class="[reviews == 5 ? 'font-weight-bold' : '']"
                @click="[reviews == 5 ? (reviews = 0) : (reviews = 5)]"
                >5+</a
              >
              <a
                :class="[reviews == 10 ? 'font-weight-bold' : '']"
                @click="[reviews == 10 ? (reviews = 0) : (reviews = 10)]"
                >10+</a
              >
            </div>
            <div class="col-3"></div>
            <div class="col-3"></div>
          </div>
          <button
            class="btn btn-sm button_ms_blue reset_button"
            @click="
              score = 0;
              reviews = 0;
              checkIfEmpty();
            "
          >
            Reset
          </button>
        </div>
        <!-- /////////////////// -->
        <h3
          v-if="
            selected != '' && (doctors.length > 0)
          "
          class="mt-3 ml-2"
        >
          I nostri specialisti in {{ 
            selected.charAt(0).toUpperCase() +
            selected.slice(1) 
          }}:
        </h3>

        <div class="card-group col-12 px-sm-5 px-md-5">
          <h3
            v-if="doctors.length == 0"
            class="mt-3 ml-2 text-center"
          >
            Nessun risultato per questa ricerca
          </h3>
          <div
            v-for="(element, index) in doctors"
            :key="'b' + index"
            class="doctor_card mb-3"
          >
            <div class="row">
              <div class="col-3 col-lg-2">
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
              <div class="col-4 col-lg-3 d-flex flex-column justify-content-between">
                <div>
                  <h5>
                    {{
                      element.name.charAt(0).toUpperCase() +
                      element.name.slice(1)
                    }}
                    {{
                      element.surname.charAt(0).toUpperCase() +
                      element.surname.slice(1)
                    }}
                  </h5>
                  <span
                    v-for="(titles, index) in element.titles"
                    :key="'c' + index"
                    >{{ titles.name }}</span
                  >
                </div>
                <div class="">
                  <span v-for="stars,index in getAvarageScore(element.reviews)" :key="'s'+ index" class="text-warning">&#9733;</span>
                  ({{element.reviews.length}}):
                  </div>
              </div>
              <div class="border-left col-3 col-lg-3 d-flex flex-column justify-content-center">
                <span v-for="performances,index in element.performances" :key="'p'+ index">{{performances.name}}</span>
              </div>
              <div class="col-2 col-lg-4"></div>
              <img v-if="checkSponsor(element.sponsorships)" class="sponsor_badge" src="/img/badge.png" alt="" />
            </div>
            <router-link
              class="view_doctor"
              :to="{
                name: 'single-doctor',
                params: { id: element.id },
              }"
              ><button class="btn btn-sm button_ms_blue">
                Mostra
              </button></router-link
            >
          </div>
        </div>
      </div>
      <!-- //////////////////////// -->
    </div>
  </div>
</template>

<script>
export default {
  name: "Search",
  data() {
    return {
      title: "",
      score: "",
      reviews: "",
      doctors:"",
      selected: "",
      alert: "Scegli una specializzazione...",
    };
  },
  mounted() {
    this.selected = this.$route.query.title;
    if (this.$route.query.score) {
      this.score = this.$route.query.score;
    }
    if (this.$route.query.reviews) {
      this.reviews = this.$route.query.reviews;
    }
    this.selected = this.$route.query.title;
    this.title = this.$route.query.title;
    this.getApi();
  },
  methods: {
    getApi() {
      axios
        .get(`/api/doctors/`, {
          params: {
            title: this.$route.query.title,
            stars: this.$route.query.score,
            reviews: this.$route.query.reviews,
          },
        })
        .then((response) => {
          this.doctors = response.data.data.sponsoredDoctors.concat(response.data.data.unsponsoredDoctors)
        });
    },
    checkIfEmpty() {
      if (!this.title) {
        this.alert = "Selezionare una specializzazione per continuare...";
      } else {
        this.$router.push({
          query: {
            title: this.title,
            score: this.score,
            reviews: this.reviews,
          },
        });
        if (this.score == 0) {
          let query = Object.assign({}, this.$route.query);
          delete query.score;
          this.$router.replace({ query });
        }
        if (this.reviews == 0) {
          let query = Object.assign({}, this.$route.query);
          delete query.reviews;
          this.$router.replace({ query });
        }

        this.getApi();
        document.getElementById("filter-box").classList.remove("show");
        this.selected = this.$route.query.title;
        this.alert = "Scegli una specializzazione...";
      }
    },
    filterDrop() {
      let filter_box = document.getElementById("filter-box");
      if (filter_box.classList.contains("show")) {
        filter_box.classList.remove("show");
      } else {
        filter_box.classList.add("show");
      }
    },
    removeQuery() {
      if (this.score == 0) {
        let query = Object.assign({}, this.$route.query);
        delete query.score;
        this.$router.replace({ query });
      }
    },
    getAvarageScore(data){
      let getLength = data.length;
      let sum = 0
      data.map(x=>sum=sum + x.score)
      return Math.round(sum/getLength)
    },
    checkSponsor(data){
      
      if(data.length>0){
        let checkExpire = new Date(data[data.length-1].pivot.expiration) 
        let today = new Date();
        return checkExpire>today ? true :false
      }else{
        return false
      }
    }
  },
};
</script>

<style lang="scss" scoped>

@import "../../../sass/guest/_variables.scss";
.background_color {
  background-image: linear-gradient(
    rgba($ms-white, 0.5),
    rgba(207, 207, 207, 0.26)
  );
  height: calc(100vh - 70px);
}
a {
  color: inherit;
  text-decoration: none;
}
a:hover {
  text-decoration: underline;
  cursor: pointer;
}
svg {
  width: 25px;
  height: 25px;
}
.search-group {
  height: 100%;
  margin-top: 30px;
  background-color: white;
  border-radius: 8px;
  padding: 20px 0px;
  border: 0.5px solid rgba(0, 0, 0, 0.11);
  box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.1);
}
.show {
  display: inline-block !important;
  animation-duration: 0.5s;
  animation-name: show-block;
}
@keyframes show-block {
  from {
    height: 0;
    opacity: 0;
  }
  to {
    height: inherit;
    opacity: 1;
  }
}

.filter-group {
  width: 100%;
  margin-top: 5px;
  background-color: white;
  border-radius: 8px;

  border: 0.5px solid rgba(0, 0, 0, 0.11);
  box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.1);
  display: none;
  position: relative;
}
.reset_button {
  position: absolute;
  bottom: 1.5rem;
  right: 1.5rem;
}
.card-group {
  margin-top: 30px;
  max-height: calc(100vh - 300px);
  overflow-y: scroll;
}

.search_bar {
  width: 100%;
  height: 38px;
  border-radius: 5px;
  border: none;
  border: 0.5px solid gray;
  padding: 5px 10px;
  font-size: 14px;
}
.button_search {
  margin-top: 10px;
  height: 38px;
  width: 100%;
  border: none;
  border-radius: 5px;
  background-color: $ms-blue;
  color: white;
  font-weight: bold;
}
.doctor_card {
  width: 100%;
  padding: 20px 20px;
  background-color: white;
  border: 0.5px solid rgba(0, 0, 0, 0.11);
  box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  position: relative;

  img {
    width: 100%;
    border-radius: 50%;
  }

  .view_doctor {
    position: absolute;
    bottom: 10px;
    right: 10px;
  }
  .sponsor_badge {
    width: 38px;
    height: 22px;
    position: absolute;
    top: 16px;
    right: 20px;
  }
}
</style>
