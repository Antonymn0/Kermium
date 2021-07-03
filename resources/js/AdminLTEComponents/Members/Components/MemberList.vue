<template>
  <div class="row mb-4">
    <div class="col-md-12">
      <div v-if="$page.props.recentMembers" class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">All Members</h3>
        </div>
        <div  class="card-body p-0">
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

                <tr v-for="(member, index) in $page.props.recentMembers.data"
              :key="index">
                  <td label="Choose"><input type="checkbox" :value="member.id" @click="selectMember($event.target)" /></td>
                  <td label="Name"><a href="#">{{member.name}}</a></td>
                  <td label="Email">{{member.email}}</td>
                  <td label="Phone">{{member.phone}}</td>
                  <td label="Status">
                    <span class="badge" 
                    :class="[member.status == 'subscribed' ? 'badge-success' : null,member.status == 'unsubscribed' ? 'badge-warning' : null, member.status == 'suspended' ? 'badge-danger' : null]"> 
                      {{member.status}}
                    </span>
                  </td>
                </tr>

                <tr class="d-block d-md-none">
                  <td colspan="3"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer clearfix">
          <div class="row">
            <div class="col-8 col-md-4 col-lg-3">
              <select v-model="action"
                class="form-control form-control-sm"
                @change="act()"
              >
                  <option value="0">Bulk Action</option>
                  <option value="subscribed">Mark as subscribed</option>
                  <option value="unsubscribed">Mark as unsubscribed</option>
                  <option value="suspended">Mark as suspended</option>
                  <option value="delete">Delete</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">No Member found. Click <a href="/dashboard/members/create">here</a> to create a member. </h3>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function(){
            return{
                selectedMembers : [],
                action:"0"
            }
        },
      methods:{
        selectMember:function(element){

          if( element.checked )
            this.selectedMembers.push(element.value)
          else
            this.selectedMembers.splice(this.selectedMembers.indexOf(element.value), 1);
        },
        act:function(){

          if( this.action == '0' )
            return false

          if( ! confirm( "Are you sure you want to perform this action?" ) )
            return false

          if( this.action == 'delete' && this.selectedMembers.length )
            this.bulkDelete( this.selectedMembers )
          else if( this.action && this.selectedMembers.length )
            this.bulkChangeState( this.action , this.selectedMembers )

        },
        bulkChangeState:function( status, memberIDs ){

          axios({
            method: "POST",
            url: "/v1/members/bulk-change-state",
            data: {
              status: status,
              memberIDs: memberIDs,
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
        bulkDelete:function( memberIDs ){
          axios({
            method: "DELETE",
            url: "/v1/members/bulk-delete",
            data: {
              memberIDs: memberIDs,
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