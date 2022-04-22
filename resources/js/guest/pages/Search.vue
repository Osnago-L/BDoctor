<template> 
<div class="background_color">
    <div class="container px-sm-5">
  <!-- ///////////////////// -->
  <!-- search bar -->
      <div class="row">
        <!-- /////////////////// -->
          <div class="d-flex justify-content-center search-group test_color col-sm-12 col-md-3">
                <div class="mt-3 w-75">
                  <input class="search_bar" v-model="input" type="text" id="search" name="search" autocomplete="off" placeholder="Cerca una specializzazione..."> 
                  <router-link @click.native="getApi()" :to="{query:{search: input}}"><button type="button" class="button_search ">Cerca</button></router-link>
                </div>
          </div>  
  <!-- /////////////////// -->
          <div class="card-group p-0 pl-md-3 col-sm-12 col-md-9">
            <div v-for="element,index in data " :key="index" class="doctor_card mb-3">
                <h3>{{element.name}} {{element.surname}}</h3>          
                <span>Numero di telefono: {{element.phone_n}}</span>
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
    data(){
      return{
        input : '',
        selected : '',
        data:''
      }
    },
    created() {
      this.getApi()
  },
  methods:{
    getApi(){
      axios.get(`/api/doctors`,{
        params: {
        title: this.$route.query.search
        }
      }).then((response) => {
        console.log(this.$route);
        this.data = response.data.data.sponsoredDoctors.concat(response.data.data.unsponsoredDoctors);
      });
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../../sass/guest/_variables.scss';
.background_color{
  background-image: linear-gradient($ms-white, rgba(207, 207, 207, 0.26)) ;
  height: calc(100vh - 70px);
}
.search-group{
  height: 100%;
  margin-top:30px ;
  background-color: white ;
  border-radius: 8px;
  padding: 20px 0px;
  border: 0.5px solid rgba(0, 0, 0, 0.11);
  box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.100);
}
.card-group{
  margin-top:30px ;
  max-height: calc(100vh - 100px);;
  overflow-y:scroll;
}

.search_bar{
    width: 100%;
    height: 38px;
    border-radius: 5px;
    border: none;
    border: 0.5px solid gray;
    padding: 5px 10px;
    font-size: 14px;
}
.button_search{
  margin-top: 10px;
  height: 38px;
  width: 100%;
  border: none;
  border-radius: 5px;
  background-color: $ms-blue;
  color: white;
  font-weight: bold;
}
.doctor_card{
  width: 100%;
  height: 300px;
  padding: 20px 20px;
  background-color: white ;
  border: 0.5px solid rgba(0, 0, 0, 0.11);
  box-shadow: 2px 2px 30px 1px rgba(0, 0, 0, 0.100);
  border-radius: 8px;
}
</style>