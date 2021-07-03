<template>
  <div class="content-wrapper">
    <main-header></main-header>
    <section class="content">
      <div class="container-fluid">
        <member-form></member-form>
      </div>
    </section>
  </div>
</template>

<script>
import Header from "./Components/Header";
import MemberForm from "./Components/MemberForm";

export default {
  components: {
    "main-header": Header,
    "member-form": MemberForm,
  },
};
</script>

<style>
</style>