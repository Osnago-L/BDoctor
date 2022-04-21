<template> 
  <div class="main container-fluid">
<!-- ///////////////////// -->
<!-- search bar -->
    <div class="row">
      <!-- /////////////////// -->
        <div class="test_color col-sm-12 col-md-2">
              <input class="search_bar" v-model="input" type="text" id="search" name="search" autocomplete="off"> 
              <router-link :to="{query:{search: input}}"><button type="button" class="button_search ">SC</button></router-link>
        </div>  
<!-- /////////////////// -->
        <div class="test_color col-sm-12 col-md-10">
          One of three columns
        </div>
    </div>
<!-- //////////////////////// -->

  </div>
</template>

<script>
export default {
    name: "Search",
    data(){
      return{
        input : '',
        selected : ''
      }
    },
}
</script>

<style lang="scss" scoped>
@import '../../../sass/guest/_variables.scss';
.test_color{
  border: 1px solid black;
}

.main{
  padding: 20px 30px;
}

.search_bar{
    width: 80%;
    height: 38px;
    border-radius: 2px;
    // border: 0.5 solid black;
        border: none;
    border: 0.5px solid gray;
}
.button_search{
  height: 38px;
  width: 15%;
  border: none;
}
</style>