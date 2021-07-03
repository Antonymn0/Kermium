<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Members List</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body max-height-card p-0">
      <ul
        v-if="$page.props.eventMembers.length"
        class="products-list product-list-in-card pl-2 pr-2"
      >
        <li
          v-for="(member, index) in $page.props.eventMembers"
          :key="index"
          class="item"
        >
          <div class="product-img">
            <span
              v-if="member.database == 'kazi place'"
              class="badge badge-warning"
              >KP</span
            >
            <span
              v-else-if="member.database == 'jobs platform'"
              class="badge badge-info"
              >JP</span
            >
          </div>
          <div class="product-info">
            <a href="javascript:void(0)" class="product-title"
              >{{ member.name }}
              <span
                @click="removeMember(index)"
                class="badge badge-danger float-right"
              >
                <span class="fa fa-times"></span> </span
            ></a>
            <span class="product-description">
              {{ member.database }}
            </span>
          </div>
        </li>
      </ul>
    </div>
    <div class="card-footer text-center">
      <div v-if="$page.props.remindersSec == '1'">
        <div class="row mb-2 text-left">
          <div class="col-sm-4">
            <label for="">Send Reminders</label>
          </div>
          <div class="col-sm-8 my-1">
            <label class="sr-only" for="inlineFormInputGroupUsername"
              >Database</label
            >
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="fa fa-clock"></span>
                </div>
              </div>
              <select
                v-model="send_reminders"
                class="form-control"
                name=""
                id=""
              >
                <option value="1">30 min b4</option>
                <option value="11">1 hour b4</option>
                <option value="21">1 day b4</option>
                <option value="0">Don't send</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row mb-2 text-left">
          <div class="col-sm-4">
            <label for="">Reminders Via</label>
          </div>
          <div class="col-sm-8 my-1">
            <label class="sr-only" for="inlineFormInputGroupUsername"
              >Database</label
            >
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="fa fa-comments"></span>
                </div>
              </div>
              <select
                v-model="reminders_via"
                class="form-control"
                name=""
                id=""
              >
                <option value="1">Email & SMS</option>
                <option value="11">Email only</option>
                <option value="21">SMS only</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <button
        v-if="type == 'event'"
        type="button"
        class="btn btn-info"
        @click="submitEvent()"
        :disabled="updateDisabled"
      >
        <span class="text-capitalize">{{save_type}}</span> Event
      </button>
      <button
        v-else-if="type == 'sms'"
        type="button"
        class="btn btn-info"
        @click="submitSms()"
        :disabled="updateDisabled"
      >
        <span class="text-capitalize">{{save_type}}</span> Sms
      </button>
      <button
        v-else-if="type == 'email'"
        type="button"
        class="btn btn-info"
        @click="submitEmail()"
        :disabled="updateDisabled"
      >
        <span class="text-capitalize">{{save_type}}</span> Email
      </button>
      <p class="text-danger" v-if="updateDisabled"> Update is no longer possible </p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    type: String,
  },
  data: function () {
    return {
      reminders_via: 1,
      send_reminders: 1,
      save_type:this.$page.props.saveType ? this.$page.props.saveType : 'create',
      updateDisabled:this.$page.props.updateDisabled ? true : false
    };
  },
  methods: {
    removeMember: function (index) {
      this.$page.props.eventMembers.splice(index, 1);
    },
    submitEvent: function () {
      axios({
        method: "POST",
        url: "/v1/events",
        data: {
          id:this.$page.props.event ? this.$page.props.event.id : null,
          members: this.getMemberIDs(),
          name: this.$page.props.event_name,
          start_date: this.$page.props.event_start_date,
          end_date: this.$page.props.event_end_date,
          venue: this.$page.props.event_venue,
          status: "pending",
          reminders_via: this.reminders_via, //1 Email & sms, 11 Email only, 21 sms only
          send_reminders: this.send_reminders, //0 don't send, 11 30 min b4, 21 1 hr b4, 31 1 day b4
        },
      })
        .then((response) => {
          if (response.data.success && this.save_type == 'update' ) location.reload();
          else if (response.data.success) window.open("/dashboard/events", "_self");
          else alert("An error occured, please try again later ");
        })
        .catch((error) => {
          console.log(error);
        });
    },
    submitSms: function () {
      axios({
        method: "POST",
        url: "/v1/sms",
        data: {
          id:this.$page.props.sms ? this.$page.props.sms.id : null,
          members: this.getMemberIDs(),
          message: this.$page.props.content,
          sent_on: this.$page.props.sent_on,
          send_date_choice: this.$page.props.send_date_choice,
          status: "scheduled",
        },
      })
        .then((response) => {
          if (response.data.success && this.save_type == 'update' ) location.reload();
          else if (response.data.success) window.open("/dashboard/sms", "_self");
          else alert("An error occured, please try again later ");
        })
        .catch((error) => {
          console.log(error);
        });
    },
    submitEmail: function () {
      axios({
        method: "POST",
        url: "/v1/emails",
        data: {
          id:this.$page.props.email ? this.$page.props.email.id : null,
          members: this.getMemberIDs(),
          message: this.$page.props.content,
          sent_on: this.$page.props.sent_on,
          send_date_choice: this.$page.props.send_date_choice,
          status: "scheduled",
        },
      })
        .then((response) => {
          if (response.data.success && this.save_type == 'update' ) location.reload();
          else if (response.data.success) window.open("/dashboard/emails", "_self");
          else alert("An error occured, please try again later ");
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getMemberIDs: function () {
      let ids = [];

      for (let i = 0; i < this.$page.props.eventMembers.length; i++) {
        ids.push(this.$page.props.eventMembers[i].id);
      }
      return ids;
    },
  },
};
</script>

<style>
</style>