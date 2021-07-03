<template>
  <div class="row mb-4">
    <div class="col-md-12">

      <div v-if="$page.props.recentSms" class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">SMS</h3>
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

                <tr v-for="(sms, index) in $page.props.recentSms.data"
              :key="index">
                  <td label="Choose"><input type="checkbox" :value="sms.id" @click="selectSms($event.target)" /></td>
                  <td label="Date"> {{formatDate(sms.created_at)}} </td>
                  <td label="Message"> <a :href="'/dashboard/sms/'+sms.id+'/edit'"> {{sms.message}} </a></td>
                  <td label="Status">
                    <span class="badge" 
                    :class="[sms.status == 'scheduled' ? 'badge-info' : null,sms.status == 'sent' ? 'badge-success' : null, sms.status == 'cancelled' ? 'badge-danger' : null]"> 
                      {{sms.status}}
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
          <h3 class="card-title">No Sms found. Click <a href="/dashboard/sms/create">here</a> to create an sms. </h3>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  data: function(){
            return{
                selectedSms : [],
                action:"0"
            }
        },
      methods:{
        selectSms:function(element){

          if( element.checked )
            this.selectedSms.push(element.value)
          else
            this.selectedSms.splice(this.selectedSms.indexOf(element.value), 1);
        },
        act:function(){

          if( this.action == '0' )
            return false

          if( ! confirm( "Are you sure you want to perform this action?" ) )
            return false

          if( this.action == 'delete' && this.selectedSms.length )
            this.bulkDelete( this.selectedSms )
          else if( this.action && this.selectedSms.length )
            this.bulkChangeState( this.action , this.selectedSms )

        },
        bulkChangeState:function( status, smsIDs ){

          axios({
            method: "POST",
            url: "/v1/sms/bulk-change-state",
            data: {
              status: status,
              smsIDs: smsIDs,
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
        bulkDelete:function( smsIDs ){
          axios({
            method: "DELETE",
            url: "/v1/sms/bulk-delete",
            data: {
              smsIDs: smsIDs,
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