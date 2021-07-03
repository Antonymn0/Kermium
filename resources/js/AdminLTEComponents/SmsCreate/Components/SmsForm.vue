<template>
  <div class="row mb-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">New SMS</h3>
        </div>
        <div class="card-body p-0"></div>
        <div class="card-footer clearfix">
          <form>
            <div class="form-row align-items-center">
              <div class="col-sm-12 my-1">
                <label class="sr-only" for="content">SMS content</label>
                <textarea
                  @change="save()"
                  v-model="content"
                  id="content"
                  class="form-control"
                  placeholder="Write SMS content here"
                ></textarea>
              </div>
            </div>
            <div class="form-row align-items-center">
              <div class="col-sm-4 my-1">
                <label class="sr-only" for="send_date_choice">Send now</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-share-square"></span>
                    </div>
                  </div>
                  <select
                    v-model="send_date_choice"
                    @change="save()"
                    class="form-control"
                    name=""
                    id="send_date_choice"
                  >
                    <option value="1">Send now</option>
                    <option value="2">Send later</option>
                  </select>
                </div>
              </div>

              <div v-if="send_date_choice > 1" class="col-sm-4 my-1">
                <label class="sr-only" for="sent_on">Send Date</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-calendar-alt"></span>
                    </div>
                  </div>
                  <date-field
                    id="sent_on"
                    placeholder="Send Date"
                    v-on:selected="setSendDate"
                    :value="sent_on"
                  ></date-field>
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
      sent_on: this.$page.props.sms ? this.$page.props.sms.sent_on : new Date(),
      send_date_choice: this.$page.props.updateDisabled ? 1 : 2,
      content: this.$page.props.sms ? this.$page.props.sms.message : null,
    };
  },
  methods: {
    save: function () {
      this.$page.props.sent_on = this.sent_on;
      this.$page.props.send_date_choice = this.send_date_choice;
      this.$page.props.content = this.content;
    },
    setSendDate: function (date) {
      this.sent_on = date;
      this.save();
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