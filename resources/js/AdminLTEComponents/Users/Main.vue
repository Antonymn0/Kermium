<template>
  <div class="content-wrapper">
    <main-header></main-header>
    <section class="content">
      <div class="container-fluid">
        <filters></filters>
        <member-list></member-list>
      </div>
    </section>
  </div>
</template>

<script>
import Header from "./Components/Header";
import Filters from "./Components/Filters";
import UsersList from "./Components/UsersList.vue";

export default {
  components: {
    "main-header": Header,
    filters: Filters,
    "member-list": UsersList,
  },
};
</script>

<style>
</style>