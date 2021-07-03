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
import MemberList from "./Components/MemberList.vue";

export default {
  components: {
    "main-header": Header,
    filters: Filters,
    "member-list": MemberList,
  },
};
</script>

<style>
</style>