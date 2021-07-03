<template>
  <div class="row mb-4">
    <div class="col-md-12">
      <div v-if="$page.props.users" class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">All Members </h3>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive resp-table">
            <table class="table table-striped mb-0">
              <thead>
                <tr>
                  <th>Choose</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>

                <tr v-for="(user, index) in $page.props.users.data"
              :key="index">
                  <td label="Choose"><input type="checkbox" :value="user.id" @click="selectUser($event.target)" /></td>
                  <td label="Name"><a href="#">{{user.name}}</a></td>
                  <td label="Email">{{user.email}}</td>
                  <td label="Phone"> {{user.phone}} </td>
                  <td label="Status">
                    <span class="badge" 
                    :class="[user.status == 'active' ? 'badge-success' : null,user.status == 'suspended' ? 'badge-danger' : null]"> 
                      {{user.status}}
                    </span>
                  </td>
                </tr>

                
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer clearfix">
          <div class="row">
            <div class="col-8 col-md-4 col-lg-3">
              <select
              v-model="action"
                class="form-control form-control-sm"
                @change="act()"
            >
              <option value="0">Bulk Action</option>
              <option value="suspended">Suspend</option>
              <option value="active">Mark as active</option>
              <option value="delete">Delete</option>
            </select>
            </div>
          </div>
          
        </div>
      </div>

      <div v-else class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">No user found. Click <a href="/dashboard/users/create">here</a> to create a user. </h3>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  data: function(){
            return{
                selectedUsers : [],
                action:"0"
            }
        },
      methods:{
        selectUser:function(element){

          if( element.checked )
            this.selectedUsers.push(element.value)
          else
            this.selectedUsers.splice(this.selectedUsers.indexOf(element.value), 1);
        },
        act:function(){

          if( this.action == '0' )
            return false

          if( ! confirm( "Are you sure you want to perform this action?" ) )
            return false

          if( this.action == 'delete' && this.selectedUsers.length )
            this.bulkDelete( this.selectedUsers )
          else if( this.action && this.selectedUsers.length )
            this.bulkChangeState( this.action , this.selectedUsers )

        },
        bulkChangeState:function( status, userIDs ){

          axios({
            method: "POST",
            url: "/v1/users/bulk-change-state",
            data: {
              status: status,
              userIDs: userIDs,
            },
          })
            .then((response) => {
              if( response.data.success )
                location.reload()
              else 
                alert( "An error occured, please try again later.")
            })
            .catch((error) => {
              console.log(error);
            });

        },
        bulkDelete:function( userIDs ){
          axios({
            method: "DELETE",
            url: "/v1/users/bulk-delete",
            data: {
              userIDs: userIDs,
            },
          })
            .then((response) => {
              if( response.data.success )
                location.reload()
              else 
                alert( "An error occured, please try again later.")
            })
            .catch((error) => {
              console.log(error);
            });
        }
      },
};
</script>

<style>
</style>