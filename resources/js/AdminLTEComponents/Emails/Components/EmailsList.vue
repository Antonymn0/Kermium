<template>
  <div class="row mb-4">
    <div class="col-md-12">
      <div v-if="$page.props.recentEmails" class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">Emails</h3>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive resp-table">
            <table class="table table-striped mb-0">
              <thead>
                <tr>
                  <th>Choose</th>
                  <th>Date</th>
                  <th>Message</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>

                <tr v-for="(email, index) in $page.props.recentEmails.data"
              :key="index">
                  <td label="Choose"><input type="checkbox" :value="email.id" @click="selectEmails($event.target)" /></td>
                  <td label="Date"> <a :href="'/dashboard/emails/'+email.id+'/edit'"> {{formatDate(email.created_at)}} </a></td>
                  <td label="Message" v-html="email.message"> </td>
                  <td label="Status">
                    <span class="badge" 
                    :class="[email.status == 'scheduled' ? 'badge-info' : null,email.status == 'sent' ? 'badge-success' : null, email.status == 'cancelled' ? 'badge-danger' : null]"> 
                      {{email.status}}
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
              <select v-model="action"
                class="form-control form-control-sm"
                @change="act()">
              <option value="0">Bulk Action</option>
              <option value="sent">Mark as sent</option>
              <option value="cancelled">Mark as cancelled</option>
              <option value="delete">Delete</option>
            </select>
            </div>
          </div>
          
        </div>
      </div>

      <div v-else class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">No email found. Click <a href="/dashboard/emails/create">here</a> to create an email. </h3>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  data: function(){
            return{
                selectedEmails : [],
                action:"0"
            }
        },
      methods:{
        selectEmails:function(element){

          if( element.checked )
            this.selectedEmails.push(element.value)
          else
            this.selectedEmails.splice(this.selectedEmails.indexOf(element.value), 1);
        },
        act:function(){

          if( this.action == '0' )
            return false

          if( ! confirm( "Are you sure you want to perform this action?" ) )
            return false

          if( this.action == 'delete' && this.selectedEmails.length )
            this.bulkDelete( this.selectedEmails )
          else if( this.action && this.selectedEmails.length )
            this.bulkChangeState( this.action , this.selectedEmails )

        },
        bulkChangeState:function( status, emailIDs ){

          axios({
            method: "POST",
            url: "/v1/emails/bulk-change-state",
            data: {
              status: status,
              emailIDs: emailIDs,
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
        bulkDelete:function( emailIDs ){
          axios({
            method: "DELETE",
            url: "/v1/emails/bulk-delete",
            data: {
              emailIDs: emailIDs,
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
        formatDate:function( string = null ){
          return new Date(string).toLocaleDateString('en-GB')
        }
      },
};
</script>

<style>
</style>