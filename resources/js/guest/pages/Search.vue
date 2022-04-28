<template>
    <div class="background_color">
        <div class="container">
            <!-- ///////////////////// -->
            <!-- search bar -->
            <div class="row">
                <!-- /////////////////// -->
                <div
                    class="d-flex align-items-center justify-content-between search-group test_color col-12 px-3"
                >
                    <div>
                        <a
                            id="filter"
                            class="d-flex align-items-center"
                            @click="filterDrop()"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"
                            >
                                <path
                                    d="M320 224H416c17.67 0 32-14.33 32-32s-14.33-32-32-32h-95.1c-17.67 0-32 14.33-32 32S302.3 224 320 224zM320 352H480c17.67 0 32-14.33 32-32s-14.33-32-32-32h-159.1c-17.67 0-32 14.33-32 32S302.3 352 320 352zM320 96h32c17.67 0 31.1-14.33 31.1-32s-14.33-32-31.1-32h-32c-17.67 0-32 14.33-32 32S302.3 96 320 96zM544 416h-223.1c-17.67 0-32 14.33-32 32s14.33 32 32 32H544c17.67 0 32-14.33 32-32S561.7 416 544 416zM192.4 330.7L160 366.1V64.03C160 46.33 145.7 32 128 32S96 46.33 96 64.03v302L63.6 330.7c-6.312-6.883-14.94-10.38-23.61-10.38c-7.719 0-15.47 2.781-21.61 8.414c-13.03 11.95-13.9 32.22-1.969 45.27l87.1 96.09c12.12 13.26 35.06 13.26 47.19 0l87.1-96.09c11.94-13.05 11.06-33.31-1.969-45.27C224.6 316.8 204.4 317.7 192.4 330.7z"
                                />
                            </svg>
                            <span class="ml-1 font-weight-bold"
                                >Filter({{ filters }})</span
                            >
                        </a>
                    </div>
                    <div class="w-50">
                        <div class="input-group">
                            <select
                                id="title_select"
                                class="custom-select"
                                v-model="title"
                            >
                                <option value="" selected>{{ alert }}</option>
                                <option value="podologia">Podologia</option>
                                <option value="urologia">Urologia</option>
                                <option value="dermatologia">
                                    Dermatologia
                                </option>
                                <option value="cardiologia">Cardiologia</option>
                            </select>
                            <div class="input-group-append">
                                <router-link
                                    @click.native="
                                        resetPages();
                                        search();
                                    "
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
                    <!-- /////////////////// -->
                    <div id="filter-box" class="filter-group">
                        <div class="row p-4">
                            <div
                                class="col-4 col-lg-3 d-flex flex-column border-right"
                            >
                                <a
                                    v-for="(element, index) in 4"
                                    :key="'a' + index"
                                    :id="4 - index"
                                    :class="[
                                        score == 4 - index
                                            ? 'selected_element'
                                            : '',
                                    ]"
                                    @click="
                                        [
                                            score == 4 - index
                                                ? (score = 0)
                                                : (score = 4 - index),
                                        ]
                                    "
                                    ><span
                                        class="text-warning"
                                        v-for="(stars_filter, index) in 4 -
                                        index"
                                        :key="'sf' + index"
                                        >&#9733;</span
                                    >
                                    o più</a
                                >
                            </div>
                            <div class="col-4 col-lg-3 d-flex flex-column">
                                <a
                                    :class="[
                                        reviews == 1 ? 'selected_element' : '',
                                    ]"
                                    @click="
                                        [
                                            reviews == 1
                                                ? (reviews = 0)
                                                : (reviews = 1),
                                        ]
                                    "
                                    >1+ recensioni</a
                                >
                                <a
                                    :class="[
                                        reviews == 5 ? 'selected_element' : '',
                                    ]"
                                    @click="
                                        [
                                            reviews == 5
                                                ? (reviews = 0)
                                                : (reviews = 5),
                                        ]
                                    "
                                    >5+ recensioni</a
                                >
                                <a
                                    :class="[
                                        reviews == 10 ? 'selected_element' : '',
                                    ]"
                                    @click="
                                        [
                                            reviews == 10
                                                ? (reviews = 0)
                                                : (reviews = 10),
                                        ]
                                    "
                                    >10+ recensioni</a
                                >
                                <a
                                    :class="[
                                        reviews == 15 ? 'selected_element' : '',
                                    ]"
                                    @click="
                                        [
                                            reviews == 15
                                                ? (reviews = 0)
                                                : (reviews = 15),
                                        ]
                                    "
                                    >15+ recensioni</a
                                >
                            </div>
                            <div class="col-2 col-lg-3"></div>
                            <div class="col-2 col-lg-3"></div>
                        </div>
                        <button
                            class="btn btn-sm button_ms_blue reset_button"
                            @click="
                                score = 0;
                                reviews = 0;
                                search();
                            "
                        >
                            Reset
                        </button>
                    </div>
                </div>

                <!-- /////////////////// -->
                <h3
                    v-if="selected != '' && data.foundResults > 0"
                    class="mt-3 ml-2"
                >
                    I nostri specialisti in
                    {{
                        selected.charAt(0).toUpperCase() + selected.slice(1)
                    }}({{ data.foundResults }}):
                </h3>

                <div class="card-group col-12 px-sm-5 px-md-5">
                    <h3
                        v-if="data.foundResults == 0"
                        class="mt-3 ml-2 text-center"
                    >
                        Nessun risultato per questa ricerca
                    </h3>
                    <div
                        v-for="(element, index) in data.doctors"
                        :key="'b' + index"
                        class="doctor_card mb-3"
                        :class="{
                            sponsor_border: checkSponsor(element.sponsorships),
                        }"
                    >
                        <router-link
                            :to="{
                                name: 'single-doctor',
                                params: { id: element.id },
                            }"
                        >
                            <div class="row">
                                <div
                                    class="col-3 col-lg-2 d-flex align-items-center rounded-div"
                                >
                                    <img
                                        v-if="element.image"
                                        :src="'../storage/' + element.image"
                                        alt=""
                                    />
                                    <img
                                    class="opacity_img"
                                        v-else
                                        src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                                        alt=""
                                    />
                                </div>
                                <div
                                    class="col-5 col-lg-3 d-flex flex-column justify-content-between"
                                >
                                    <div class="d-flex flex-column">
                                        <h5>
                                            {{
                                                element.name
                                                    .charAt(0)
                                                    .toUpperCase() +
                                                element.name.slice(1)
                                            }}
                                            {{
                                                element.surname
                                                    .charAt(0)
                                                    .toUpperCase() +
                                                element.surname.slice(1)
                                            }}
                                        </h5>
                                        <span
                                            class="small-fonts"
                                            :class="{
                                                'd-none':
                                                    titles.name.toLowerCase() !=
                                                    $route.query.title.toLowerCase(),
                                            }"
                                            v-for="(
                                                titles, index
                                            ) in element.titles"
                                            :key="'c' + index"
                                            >{{ titles.name }}</span
                                        >
                                    </div>
                                    <div
                                    v-if="element.reviews.length > 1"
                                     class="">
                                        <span
                                            v-for="(
                                                stars, index
                                            ) in getAvarageScore(
                                                element.reviews
                                            )"
                                            :key="'s' + index"
                                            class="text-warning"
                                            >&#9733;</span
                                        >
                                        ({{ element.reviews.length }})
                                    </div>
                                    <div v-else class="small-fonts">
                                        Nessuna recensione
                                    </div>
                                </div>
                                <div
                                    class="border-left col-3 col-lg-3 d-flex flex-column justify-content-center"
                                >
                                    <span
                                        class="small-fonts"
                                        v-for="(
                                            performances, index
                                        ) in element.performances"
                                        :key="'p' + index"
                                        >{{ performances.name }}</span
                                    >
                                </div>
                                <div class="col col-lg-4"></div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
            <!-- //////////////////////// -->
        </div>
        <nav v-if="data.foundResults > 0" class="mt-2 pagination_position">
            <ul class="pagination justify-content-center">
                <li
                    class="page-item"
                    :class="{ disabled: page == 1 || data.maxPages == 1 }"
                >
                    <router-link
                        class="page-link"
                        @click.native="
                            page--;
                            search();
                        "
                        :to="{}"
                        >Precedente</router-link
                    >
                </li>
                <li
                    v-for="(pages, index) in data.maxPages"
                    :key="'pages' + index"
                    class="page-item"
                    :class="{ active: page == index + 1 }"
                >
                    <router-link
                        class="page-link"
                        @click.native="
                            page = index + 1;
                            search();
                        "
                        :to="{}"
                        >{{ index + 1 }}
                    </router-link>
                </li>
                <li
                    class="page-item"
                    :class="{ disabled: page == data.maxPages }"
                >
                    <router-link
                        class="page-link"
                        @click.native="
                            page++;
                            search();
                        "
                        :to="{}"
                        >Successiva
                    </router-link>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name: "Search",
    data() {
        return {
            filters: "",
            title: "",
            score: "",
            reviews: "",
            data: "",
            page: "",
            selected: "",
            alert: "Scegli una specializzazione...",
        };
    },
    mounted() {
        if (!this.$route.query.title) {
            this.$router.push({ name: "home" });
            return;
        }
        this.filters = "0";
        if (this.$route.query.score) {
            this.score = this.$route.query.score;
            this.filters++;
        }
        if (this.$route.query.reviews) {
            this.reviews = this.$route.query.reviews;
            this.filters++;
        }
        if (!this.$route.query.page) {
            this.$router.push({
                query: {
                    title: this.$route.query.title,
                    page: 1,
                },
            });
        }
        this.selected = this.$route.query.title;
        this.page = this.$route.query.page;
        this.title = this.$route.query.title;
        this.getApi();
    },
    methods: {
        // GET API
        getApi() {
            axios
                .get(`/api/doctors/`, {
                    params: {
                        title: this.$route.query.title,
                        stars: this.$route.query.score,
                        reviews: this.$route.query.reviews,
                        page: this.$route.query.page,
                    },
                })
                .then((response) => {
                    this.data = response.data.data;
                });
        },
        // SEARCH USING DIFFERENTS FILTERS
        search() {
            if (!this.title) {
                this.alert =
                    "Selezionare una specializzazione per continuare...";
            } else {
                this.filters = 2;
                this.$router.push({
                    query: {
                        title: this.title,
                        score: this.score,
                        reviews: this.reviews,
                        page: this.page,
                    },
                });

                this.removeQuery();
                this.getApi();
                document.getElementById("filter-box").classList.remove("show");
                this.selected = this.$route.query.title;
                this.alert = "Scegli una specializzazione...";
            }
        },
        resetPages() {
            if (this.page > 1) {
                this.page = 1;
            }
        },
        //  REMOVE ALL QUERY
        removeQuery() {
            if (this.score == 0) {
                this.filters--;
                let query = Object.assign({}, this.$route.query);
                delete query.score;
                this.$router.replace({ query });
            }
            if (this.reviews == 0) {
                this.filters--;
                let query = Object.assign({}, this.$route.query);
                delete query.reviews;
                this.$router.replace({ query });
            }
        },
        //////////////////////////
        /////////////////////////
        // DROPDOWN FILTER BOX
        filterDrop() {
            let filter_box = document.getElementById("filter-box");
            if (filter_box.classList.contains("show")) {
                filter_box.classList.remove("show");
            } else {
                filter_box.classList.add("show");
            }
        },

        getAvarageScore(data) {
            let getLength = data.length;
            if (getLength == 0) {
                return 0;
            } else {
                let sum = 0;
                data.map((x) => (sum = sum + x.score));
                return Math.floor(sum / getLength);
            }
        },
        checkSponsor(data) {
            if (data.length > 0) {
                let checkExpire = new Date(
                    data[data.length - 1].pivot.expiration
                );
                let today = new Date();
                return checkExpire > today ? true : false;
            } else {
                return false;
            }
        },
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

svg {
    width: 25px;
    height: 25px;
}
.search-group {
    position: relative;
    height: 100%;
    margin-top: 30px;
    background-color: white;
    border-radius: 8px;
    padding: 20px 0px;
    border: 0.5px solid rgba(0, 0, 0, 0.11);
    box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.1);
    a {
        color: inherit;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
        cursor: pointer;
    }
}
.show {
    display: inline-block !important;
    animation-duration: 0.5s;
    animation-name: show-block;
}
@keyframes show-block {
    from {
        // height: 0;
        opacity: 0;
    }
    to {
        // height: inherit;
        opacity: 1;
    }
}

.filter-group {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 99;
    width: 100%;
    margin-top: 5px;
    background-color: rgba(255, 255, 255);
    border-radius: 8px;

    border: 0.5px solid rgba(0, 0, 0, 0.11);
    box-shadow: 2px 15px 30px 1px rgba(0, 0, 0, 0.2);
    display: none;
    a {
        color: inherit;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
        cursor: pointer;
    }
}
.reset_button {
    position: absolute;
    bottom: 10px;
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
.sponsor_border {
    border: 1px solid RGBA(24, 67, 112, 0.2) !important;
    background-image: url("../../../../public/img/wave_search.svg");
    background-position-y: 15px;
    background-size: cover;
    background-repeat: no-repeat;
}
.doctor_card {
    width: 100%;
    padding: 20px 20px;

    background-color: white;
    border: 0.5px solid rgba(0, 0, 0, 0.11);
    box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    position: relative;
    .rounded-div{
        width: 100%;
        height: 100%;
    }
    a {
        color: inherit;
        text-decoration: none;
    }

    img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    .view_doctor {
        position: absolute;
        bottom: 10px;
        right: 10px;
    }
}
.pagination_position {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
}
.selected_element {
    text-decoration: underline !important;
    font-weight: bolder;
}
.active .page-link {
    color: white !important;
    background-color: RGBA(24, 67, 112) !important;
}
.disabled .page-link {
    color: grey !important;
}
.page-link {
    color: RGBA(24, 67, 112) !important;
}
.small-fonts {
    font-size: 14px;
}
.opacity_img{
  opacity: 0.7;
}
</style>
