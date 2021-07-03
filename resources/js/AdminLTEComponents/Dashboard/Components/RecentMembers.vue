<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Recently Added Members</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body max-height-card p-0">
      <ul v-if="$page.props.recentMembers" class="products-list product-list-in-card pl-2 pr-2">
        
        <li v-for=" (member,index) in $page.props.recentMembers.data" :key="index" class="item">
          <div class="product-img">
            <img
              src="/img/avatar.png"
              alt="Product Image"
              class="img-size-50"
            />
          </div>
          <div class="product-info">
            <a href="javascript:void(0)" class="product-title"
              >{{member.name}}
              <span v-if="member.database == 'kazi place'" class="badge badge-warning float-right">KP</span>
              <span v-else-if="member.database == 'jobs platform'" class="badge badge-info float-right">JP</span></a
            >
            <span class="product-description">
              Member since {{member.created_at}}
            </span>
          </div>
        </li>

      </ul>
    </div>
    <div class="card-footer text-center">
      <inertia-link href="/dashboard/members" class="uppercase">View All Members</inertia-link>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>