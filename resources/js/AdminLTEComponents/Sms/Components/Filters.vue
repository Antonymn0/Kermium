<template>
  <div class="card">
    <div class="card-header border-transparent">
      <h3 class="card-title">Filters</h3>
    </div>
    <div class="card-body p-0"></div>
    <div class="card-footer clearfix">
      <form>
        <div class="form-row align-items-center">
          <div class="col-sm-4 my-1">
            <label class="sr-only" for="search"
              >Search</label
            >
            <div class="input-group">
              <input
                v-model="search_str"
                type="text"
                class="form-control"
                id="search"
                placeholder="Search..."
                @keyup="search()"
              />
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="fa fa-search"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4 my-1">
            <label class="sr-only" for="status">
              Status</label
            >
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="fa fa-lightbulb"></span>
                </div>
              </div>
              <select v-model="status" class="form-control" @change="search()">
                <option value="0">Any status SMS</option>
                <option value="sent">Sent SMS only</option>
                <option value="scheduled">Scheduled SMS only</option>
                <option value="cancelled">Cancelled SMS only</option>
              </select>
            </div>
          </div>
          <div class="col-sm-4 my-1">
            <label class="sr-only" for="sort">
              Sort</label
            >
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="fa fa-sort-alpha-down"></span>
                </div>
              </div>
              <select v-model="order" class="form-control" @change="search()">
                <option value="DESC">Newest first</option>
                <option value="ASC">Oldest first</option>
              </select>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      search_str: "",
      status: "0",
      order_field: "created_at",
      order: "DESC",
    };
  },
  methods: {
    search: function () {
      axios({
        method: "POST",
        url: "/v1/search/sms",
        data: {
          search_str: this.search_str.length > 2 ? this.search_str : null,
          status: this.status != "0" ? this.status : null,
          order_field: this.order_field,
          order: this.order,
        },
      })
        .then((response) => {
          this.$page.props.recentSms = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style>
</style>