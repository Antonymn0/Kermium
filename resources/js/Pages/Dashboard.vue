<template>
  <div class="wrapper">
    <top-nav></top-nav>
    <aside-nav></aside-nav>
    <main-sec></main-sec>
    <footer-sec></footer-sec>
  </div>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import TopNav from "../AdminLTEComponents/TopNav";
import AsideNav from "../AdminLTEComponents/AsideNav";
import Main from "../AdminLTEComponents/Dashboard/Main";
import Footer from "../AdminLTEComponents/Footer";

export default {
  props: {
    asideActiveEl: String,
    asideActiveSubEl: String,
    authUser: Object,
    authUserPermissions: Array,
    monthlySmsCount: String,
    monthlyEmailsCount: String,
    monthlyMembersCountJP: String,
    monthlyMembersCountKP: String,
    latestEvents: Object,
    recentMembers: Object,
    notifications: Array,
    footerDate: String,
  },
  components: {
    BreezeAuthenticatedLayout,
    "top-nav": TopNav,
    "aside-nav": AsideNav,
    "main-sec": Main,
    "footer-sec": Footer,
  },
};
</script>
