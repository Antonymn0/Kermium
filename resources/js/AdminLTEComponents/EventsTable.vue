<template>
<div>
<div v-if="$page.props.latestEvents" class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">Events</h3>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive resp-table">
  <table class="table table-striped mb-0">
          <thead>
            <tr>
              <th>Choose</th>
              <th>Date</th>
              <th>Name</th>
              <th>Status</th>
              <th>Channels</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(event, index) in $page.props.latestEvents.data"
              :key="index"
            >
              <td label="Choose"><input type="checkbox" :value="event.id" @click="selectEvent($event.target)" /></td>
              <td label="Date">{{ formatDate(event.start_date) }}</td>
              <td label="Name"> <a :href="'/dashboard/events/'+event.id+'/edit'"> {{ event.name }} </a></td>
              <td label="Status">
                <span v-if="event.status == 'pending'" class="badge badge-info"
                  >Pending</span
                >
                <span
                  v-if="event.status == 'ongoing'"
                  class="badge badge-warning"
                  >Ongoing</span
                >
                <span
                  v-if="event.status == 'complete'"
                  class="badge badge-success"
                  >Complete</span
                >
                <span
                  v-if="event.status == 'cancelled'"
                  class="badge badge-danger"
                  >Cancelled</span
                >
              </td>
              <td label="Channels">
                <span v-if="event.reminders_via == 1">SMS, Email</span>
                <span v-else-if="event.reminders_via == 11">Email only</span>
                <span v-else-if="event.reminders_via == 21">SMS only</span>
              </td>
            </tr>
          </tbody>
        </table>
        </div>
        </div>
        <div class="card-footer clearfix">
          <div class="row">

          <div class="col-8 col-sm-6 col-md-4 col-lg-3">
            <select v-model="action" class="form-control form-control-sm" @change="act()">
              <option value="0">Bulk Action</option>
              <option value="complete">Mark as complete</option>
              <option value="pending">Mark as pending</option>
              <option value="ongoing">Mark as ongoing</option>
              <option value="cancelled">Mark as cancelled</option>
              <option value="delete">Delete</option>
            </select>
          </div>

        <div v-if="$page.props.asideActiveEl == 1" class="col-8 col-sm-6 col-md-4 col-lg-3 offset-md-4 offset-lg-6">
          <a 
            href="/dashboard/events"
            class="btn btn-sm btn-info float-right"
            >View All Events</a
          >
        </div>

          </div>
        </div>
      </div>
      <div v-else class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">No Event found. Click <a href="/dashboard/events/create">here</a> to create an event. </h3>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  data: function(){
            return{
                selectedEvents : [],
                action:"0"
            }
        },
      methods:{
        selectEvent:function(element){

          if( element.checked )
            this.selectedEvents.push(element.value)
          else
            this.selectedEvents.splice(this.selectedEvents.indexOf(element.value), 1);
        },
        act:function(){

          if( this.action == '0' )
            return false

          if( ! confirm( "Are you sure you want to perform this action?" ) )
            return false

          if( this.action == 'delete' && this.selectedEvents.length )
            this.bulkDelete( this.selectedEvents )
          else if( this.action && this.selectedEvents.length )
            this.bulkChangeState( this.action , this.selectedEvents )

        },
        bulkChangeState:function( status, eventIDs ){

          axios({
            method: "POST",
            url: "/v1/events/bulk-change-state",
            data: {
              status: status,
              eventIDs: eventIDs,
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
        bulkDelete:function( eventIDs ){
          axios({
            method: "DELETE",
            url: "/v1/events/bulk-delete",
            data: {
              eventIDs: eventIDs,
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