<template>
  <div>
    <label for="search">Search the site:</label>
    <input v-model="input" type="text" id="search" name="search" autocomplete="off">

    <select v-model="selected">
      <option value="opzione1">opzione1</option>
      <option value="opzione2">opzione2</option>
      <option value="opzione3">opzione3</option>
    </select>

    <router-link :to="{query:{search: input,title: selected}}">Search</router-link>

    <h1>ecco la lista dottori</h1>
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

<style lang="sass" scoped>

</style>