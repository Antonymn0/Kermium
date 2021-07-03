<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">New Member</h3>

          <div class="card-tools">
            <button
              type="button"
              class="btn btn-tool"
              data-card-widget="collapse"
            >
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form>
            <div class="form-row align-items-center">
              <div class="col-sm-4 my-1">
                <label class="sr-only" for="name">User</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-user"></span>
                    </div>
                  </div>
                  <input
                    v-model="name"
                    type="text"
                    class="form-control"
                    id="name"
                    placeholder="User"
                  />
                </div>
              </div>
              <div class="col-sm-4 my-1">
                <label class="sr-only" for="email">Email</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-envelope"></span>
                    </div>
                  </div>
                  <input
                    v-model="email"
                    type="text"
                    class="form-control"
                    id="email"
                    placeholder="Email"
                  />
                </div>
              </div>
              <div class="col-sm-4 my-1">
                <label class="sr-only" for="phone">Phone</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-phone"></span>
                    </div>
                  </div>
                  <input
                    v-model="phone"
                    type="text"
                    class="form-control"
                    id="phone"
                    placeholder="Phone"
                  />
                </div>
              </div>
              <div class="col-sm-4 my-1">
                <label class="sr-only" for="database">Database</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-database"></span>
                    </div>
                  </div>
                  <select
                    v-model="database"
                    class="form-control"
                    name=""
                    id="database"
                  >
                    <option value="kazi place">Kazi Place</option>
                    <option value="jobs platform">Jobs Platform</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4 my-1">
                <label class="sr-only" for="status">Status</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-lightbulb"></span>
                    </div>
                  </div>
                  <select
                    v-model="status"
                    class="form-control"
                    name=""
                    id="status"
                  >
                    <option value="subscribed">Subscribed</option>
                    <option value="unsubscribed">Unsubscribed</option>
                    <option value="suspended">Suspended</option>
                  </select>
                </div>
              </div>
              <div class="col-auto my-1">
                <button type="button" class="btn btn-info" @click="submit()">
                  Create Member
                </button>
              </div>
            </div>
          </form>
        </div>
        <div class="card-footer clearfix"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      name: null,
      email: null,
      phone: null,
      database: "kazi place",
      status: "subscribed",
    };
  },
  methods: {
    submit: function () {
      ///Temporary validation
      if (!this.name || !this.email || !this.phone) return false;

      axios({
        method: "POST",
        url: "/v1/members",
        data: {
          name: this.name,
          email: this.email,
          phone: this.phone,
          database: this.database,
          status: this.status,
        },
      })
        .then((response) => {
          if (response.data.success) window.open("/dashboard/members", "_self");
          else alert("An error occured, please try again later ");
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