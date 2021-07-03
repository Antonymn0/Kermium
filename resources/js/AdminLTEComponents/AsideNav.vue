<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link img-brand">
      <img
        class="elevation-3"
        src="/img/logo.png"
        alt="Acamium Plus"
        style="opacity: 0.8"
      />
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <a href="/">
            <img
              src="/img/avatar.png"
              class="img-circle elevation-2"
              alt="User Image"
            />
          </a>
        </div>
        <div v-if="$page.props.authUser" class="info">
          <a href="/" class="d-block text-capitalize">{{
            $page.props.authUser.first_name 
          }}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li
            v-if=" ! can('view dashboard')"
            :class="{ 'menu-open': $page.props.asideActiveEl == 1 }"
            class="nav-item"
          >
            <inertia-link
              href="/dashboard"
              :class="{ active: $page.props.asideActiveEl == 1 }"
              class="nav-link"
            >
              <i class="nav-icon fas fa-tachometer-alt text-info"></i>
              <p>Dashboard</p>
            </inertia-link>
          </li>

          <li
            v-if="! can('view kazi place')"
            :class="{ 'menu-open': $page.props.asideActiveEl == 7 }"
            class="nav-item"
          >
            <inertia-link
              href="/dashboard/orders/create"
              :class="{ active: $page.props.asideActiveEl == 7 }"
              class="nav-link"
            >
              <i class="nav-icon fa fa-list-alt text-warning"></i>
              <p>New Order</p>
            </inertia-link>
          </li>

          <li
            v-if="! can('view kazi place')"
            :class="{ 'menu-open': $page.props.asideActiveEl == 7 }"
            class="nav-item"
          >
            <inertia-link
              href="/dashboard/orders"
              :class="{ active: $page.props.asideActiveEl == 7 }"
              class="nav-link"
            >
              <i class="nav-icon fa fa-list-alt text-info"></i>
              <p>All Orders</p>
            </inertia-link>
          </li>

          <li
            v-if="! can('view kazi place')"
            :class="{ 'menu-open': $page.props.asideActiveEl == 7 }"
            class="nav-item"
          >
            <inertia-link
              href="/dashboard/orders-onhold"
              :class="{ active: $page.props.asideActiveEl == 7 }"
              class="nav-link"
            >
              <i class="nav-icon fa fa-hand-paper text-danger"></i>
              <p>On Hold</p>
            </inertia-link>
          </li>
          <li
            v-if="! can('view jobs platform')"
            :class="{ 'menu-open': $page.props.asideActiveEl == 8 }"
            class="nav-item"
          >
            <inertia-link
              href="/dashboard/orders-inprogress"
              :class="{ active: $page.props.asideActiveEl == 8 }"
              class="nav-link"
            >
              <i class="nav-icon fa fa-clock text-info"></i>
              <p>In Progress</p>
            </inertia-link>
          </li>
          <li
            v-if="! can('view jobs platform')"
            :class="{ 'menu-open': $page.props.asideActiveEl == 8 }"
            class="nav-item"
          >
            <inertia-link
              href="/dashboard/orders-revisions"
              :class="{ active: $page.props.asideActiveEl == 8 }"
              class="nav-link"
            >
              <i class="nav-icon fa fa-history text-warning"></i>
              <p>Revisions</p>
            </inertia-link>
          </li>
          <li
            v-if="! can('view jobs platform')"
            :class="{ 'menu-open': $page.props.asideActiveEl == 8 }"
            class="nav-item"
          >
            <inertia-link
              href="/dashboard/orders-complete"
              :class="{ active: $page.props.asideActiveEl == 8 }"
              class="nav-link"
            >
              <i class="nav-icon fa fa-check-circle text-success"></i>
              <p>Complete</p>
            </inertia-link>
          </li>
          <li
            v-if="! can('view jobs platform')"
            :class="{ 'menu-open': $page.props.asideActiveEl == 8 }"
            class="nav-item"
          >
            <a
              href="/dashboard/refunds"
              :class="{ active: $page.props.asideActiveEl == 8 }"
              class="nav-link"
            >
              <i class="nav-icon fa fa-money-bill text-danger"></i>
              <p>Refund Request</p>
            </a>
          </li>
          


          <li
            v-if="! can('view users')"
            :class="{ 'menu-open': $page.props.asideActiveEl == 6 }"
            class="nav-item"
          >
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <inertia-link href="/dashboard/users" 
                  :class="{ active: $page.props.asideActiveSubEl == 6.1 }"
                  class="nav-link"
                >
                  <p>All Users</p>
                </inertia-link>
              </li>
              <li v-if="! can('create users')" class="nav-item">
                <inertia-link href="/dashboard/users/create" 
                  :class="{ active: $page.props.asideActiveSubEl == 6.2 }"
                  class="nav-link"
                >
                  <p>Add New</p>
                </inertia-link>
              </li>
            </ul>
          </li>

          <li
            class="nav-item"
          >
            <a
              href="#" onclick="event.preventDefault();document.getElementById('logoutForm').submit()"
              class="nav-link"
            >
              <i class="nav-icon fa fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
            <form id="logoutForm" action="/logout" method="post">
              <input v-model="csrf_token" type="hidden" name="_token">
            </form>
          </li>

          
        </ul>
      </nav>
    </div>
  </aside>
</template>

<script>
import Input from '../Components/Input.vue';
export default {
  data:function(){
    return {
      'csrf_token' : null
    }
  },
  methods: {
    can: function (permission) {
      let possible = false;
      let permissions = this.$page.props.authUserPermissions;
      
      if( ! permissions )
        return false;

      for (let i = 0; i < permissions.length; i++) {
        if (permissions[i].name.toLowerCase() == permission.toLowerCase()) {
          possible = true;
          break;
        }
      }

      return possible;
    },
  },
  components: { Input },
  mounted(){
    this.csrf_token = $("meta[name=csrf-token]").attr('content')
  }
};
</script>

<style>
</style>