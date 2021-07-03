<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">New User</h3>

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
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="name"
                  >Name <span class="text-danger">*</span>
                </label>
                <input
                  v-model="name"
                  type="text"
                  class="form-control"
                  id="name"
                  placeholder="Full name"
                />
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Phone</label>
                <input
                  v-model="phone"
                  type="text"
                  class="form-control"
                  id="inputPassword4"
                  placeholder="Phone number"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="email"
                  >Email <span class="text-danger">*</span></label
                >
                <input
                  v-model="email"
                  type="email"
                  class="form-control"
                  id="email"
                  placeholder="Email"
                />
              </div>
              <div class="form-group col-md-6">
                <label for="idNo">ID</label>
                <input
                  v-model="idNo"
                  type="text"
                  class="form-control"
                  id="idNo"
                  placeholder="National ID number"
                />
              </div>
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input
                v-model="address"
                type="text"
                class="form-control"
                id="address"
                placeholder=""
              />
            </div>
            <div class="form-group">
              <label for="bio">Bio</label>
              <textarea
                v-model="bio"
                name=""
                id="bio"
                class="form-control"
              ></textarea>
            </div>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="status">Status</label>
                <select v-model="status" id="status" class="form-control">
                  <option value="active">Active</option>
                  <option value="suspended">Suspended</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="role">Role</label>
                <select v-model="role" id="role" class="form-control">
                  <option value="kp editor">Kazi place editor</option>
                  <option value="jp editor">Jobs platform editor</option>
                  <option value="kp admin">Kazi place Admin</option>
                  <option value="jp admin">Jobs platform Admin</option>
                  <option value="admin">Super Admin</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="password"
                  >Password <span class="text-danger">*</span>
                </label>
                <input
                  v-model="password"
                  type="text"
                  class="form-control"
                  id="password"
                  placeholder="Enter new password"
                />
              </div>
            </div>
            <hr />
            <div class="row text-right">
              <div class="col-md-2 offset-md-10">
                <button type="button" class="btn btn-info" @click="submit()">
                  Save
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
      idNo: null,
      address: null,
      bio: null,
      role: "kp editor",
      password: null,
      password_confirmation: null,
      status: "active",
    };
  },
  methods: {
    submit: function () {
      ///Temporary validation
      if (!this.name || !this.email || !this.password) return false;

      axios({
        method: "POST",
        url: "/v1/users",
        data: {
          name: this.name,
          email: this.email,
          phone: this.phone,
          idNo: this.idNo,
          address: this.address,
          bio: this.bio,
          role: this.role,
          password: this.password,
          password_confirmation: this.password, ///////
          status: this.status,
        },
      })
        .then((response) => {
          if (response.data.success) window.open("/dashboard/users", "_self");
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