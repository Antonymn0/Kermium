<template>
  <form>
            <div class="form-row align-items-center">
              <div class="col-md-6 my-1">
                <label class="sr-only" for="name"
                  >User</label
                >
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
                    placeholder="Full name"
                  />
                </div>
              </div>
              <div class="col-md-6 my-1">
                <label class="sr-only" for="email"
                  >Email</label
                >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-envelope"></span>
                    </div>
                  </div>
                  <input
                   v-model="email"
                    type="email"
                    class="form-control"
                    id="email"
                    placeholder="Email"
                  />
                </div>
              </div>
              <div class="col-md-6 my-1">
                <label class="sr-only" for="phone"
                  >Phone</label
                >
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
              <div class="col-md-6 my-1">
                <label class="sr-only" for="database"
                  >Database</label
                >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-database"></span>
                    </div>
                  </div>
                  <select v-model="database" class="form-control" id="database">
                    <option value="kazi place">Kazi Place</option>
                    <option value="jobs platform">Jobs Platform</option>
                  </select>
                </div>
              </div>
              <div class="col-auto my-1">
                <button type="button" class="btn btn-info" @click="submit">Add To List</button>
              </div>
            </div>
          </form>
</template>

<script>
export default {
data: function(){
        return{
            'name' : null,
            'email' : null,
            'phone' : null,
            'database' : 'kazi place',
            'status' : 'subscribed',
        }
    },
methods:{
    submit:function(){

        ///Temporary validation
        if( !this.name || !this.email || !this.phone )
            return false

        axios({
        method: "POST",
        url: "/v1/members",
        data: {
            'name' : this.name,
            'email' : this.email,
            'phone' : this.phone,
            'database' : this.database,
            'status' : this.status,
        },
      })
        .then((response) => {
          this.reset()
          this.$page.props.eventMembers.push( response.data.data )
        })
        .catch((error) => {
          console.log(error);
        });
    },
    reset:function(){
        this.name = null
        this.email = null
        this.phone = null
        this.database = 'kazi place'
        this.status = 'subscribed'
    }
}
}
</script>

<style>

</style>