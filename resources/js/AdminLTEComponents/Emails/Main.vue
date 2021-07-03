<template>
  <div class="content-wrapper">
    <main-header></main-header>
    <section class="content">
      <div class="container-fluid">
        <filters></filters>
        <emails-list></emails-list>
      </div>
    </section>
  </div>
</template>

<script>
import Header from "./Components/Header";
import Filters from "./Components/Filters";
import EmailsList from "./Components/EmailsList.vue";

export default {
  components: {
    "main-header": Header,
    filters: Filters,
    "emails-list": EmailsList,
  },
};
</script>

<style>
</style>