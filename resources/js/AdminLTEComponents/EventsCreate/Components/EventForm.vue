<template>
  <div class="row mb-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">New Event </h3>
        </div>
        <div class="card-body p-0"></div>
        <div class="card-footer clearfix">
          <form>
            <div class="form-row align-items-center">
              <div class="col-sm-4 my-1">
                <label class="sr-only" for="name"
                  >Event Name</label
                >
                <input
                  v-model="name"
                  type="text"
                  class="form-control"
                  id="eventName"
                  placeholder="Event Name"
                  @change="save()"
                />
              </div>
              <div class="col-sm-4 my-1">
                <label class="sr-only" for="startDate"
                  >Start Date</label
                >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-calendar-alt"></span>
                    </div>
                  </div>
                  <date-field id="startDate" placeholder="Start Date" v-on:selected="setStartDate" :value="start_date" ></date-field>
                </div>
              </div>
              <div class="col-sm-4 my-1">
                <label class="sr-only" for="endDate"
                  >End Date</label
                >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-calendar-alt"></span>
                    </div>
                  </div>
                  <date-field id="endDate" placeholder="End Date" v-on:selected="setEndDate" :value="end_date"></date-field>
                </div>
              </div>
              <div class="col-sm-4 my-1">
                <label class="sr-only" for="venue"
                  >Venue </label
                >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-map-marker-alt"></span>
                    </div>
                  </div>
                  <input
                    v-model="venue"
                    type="text"
                    class="form-control"
                    id="venue"
                    placeholder="Venue"
                    @change="save()"
                  />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DateField from "../../DateField";

export default {
   data() {
    return {
        name:this.$page.props.event ? this.$page.props.event.name : null,
        start_date:this.$page.props.event ? this.$page.props.event.start_date : null,
        end_date:this.$page.props.event ? this.$page.props.event.end_date : null,
        venue:this.$page.props.event ? this.$page.props.event.venue : null,
    }
  },
  methods:{
    save:function(){
     this.$page.props.event_name = this.name
     this.$page.props.event_start_date = this.start_date
     this.$page.props.event_end_date = this.end_date
     this.$page.props.event_venue = this.venue
    },
    setStartDate:function(date){
     this.start_date = date
     this.save()
    },
    setEndDate:function(date){
     this.end_date = date
     this.save()
    },
  },
  components: {
    "date-field": DateField,
  },
  mounted(){
    this.save()
  }
};
</script>

<style>
</style>