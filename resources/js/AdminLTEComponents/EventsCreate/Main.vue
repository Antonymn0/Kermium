<template>
  <div class="content-wrapper">
    <main-header></main-header>
    <section class="content">
      <div class="container-fluid">
        <event-form></event-form>
        <div class="row mb-4">
          <div class="col-md-8">
            <members-filter-form></members-filter-form>
          </div>
          <div class="col-md-4">
            <members-list type="event"></members-list>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Header from "./Components/Header";
import EventForm from "./Components/EventForm";
import MembersList from "../MembersList";
import MembersFilterForm from "../MembersFilterForm";

export default {
  components: {
    "main-header": Header,
    "event-form": EventForm,
    "members-list": MembersList,
    "members-filter-form": MembersFilterForm,
  },
};
</script>

<style>
</style>