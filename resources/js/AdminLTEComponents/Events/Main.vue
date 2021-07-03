<template>
  <div class="content-wrapper">
    <main-header></main-header>
    <section class="content">
      <div class="container-fluid">
        <filters></filters>
        <div class="row mb-4">
            <div class="col-md-12">
              <events-table></events-table>
            </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Header from "./Components/Header";
import Filters from "./Components/Filters";
import EventsTable from "../EventsTable";

export default {
  components: {
    "main-header": Header,
    filters: Filters,
    "events-table": EventsTable,
  },
};
</script>

<style>
</style>