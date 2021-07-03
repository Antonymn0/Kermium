<template>
  <div class="wrapper">
    <top-nav></top-nav>
    <aside-nav></aside-nav>
    <main-sec v-bind="$props" title="On hold"></main-sec>
   
    <footer-sec></footer-sec>
  </div>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import TopNav from "../../AdminLTEComponents/TopNav";
import AsideNav from "../../AdminLTEComponents/AsideNav";
import AllOrders from "./components/AllOrders";
import Footer from "../../AdminLTEComponents/Footer";

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
    orders:Object,
    title: String
  },
  components: {
    BreezeAuthenticatedLayout,
    "top-nav": TopNav,
    "aside-nav": AsideNav,
    "main-sec": AllOrders,
    "footer-sec": Footer,
  },
};
</script>
