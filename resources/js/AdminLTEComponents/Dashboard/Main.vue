<template>
  <div class="content-wrapper">
    <main-header></main-header>
    <section class="content">
      <div class="container-fluid">
        <info-boxes></info-boxes>
        <div class="row">
          <div class="col-md-8">
            <events-table></events-table>
          </div>
          <div class="col-md-4 mb-4">
            <recent-members></recent-members>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Header from "./Components/Header";
import InfoBoxes from "./Components/InfoBoxes";
import RecentMembers from "./Components/RecentMembers.vue";
import EventsTable from "../EventsTable";
export default {
  components: {
    "main-header": Header,
    "info-boxes": InfoBoxes,
    "recent-members": RecentMembers,
    "events-table": EventsTable,
  },
};
</script>

<style>
</style>