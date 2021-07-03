<template>
  <div class="content-wrapper">
    <main-header></main-header>
    <section class="content">
      <div class="container-fluid">
        <user-form></user-form>
      </div>
    </section>
  </div>
</template>

<script>
import Header from "./Components/Header";
import UserForm from "./Components/UserForm";

export default {
  components: {
    "main-header": Header,
    'user-form': UserForm,
  },
};
</script>

<style>
</style>