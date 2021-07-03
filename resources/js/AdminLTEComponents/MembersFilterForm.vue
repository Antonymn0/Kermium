<template>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Filter Members</h3>

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
            <div class="row">
              <div class="col-md-4 text-center text-md-left mb-2">
                <span class="fa fa-database"></span>
                <span> Kazi Place</span>
                <p>
                  <input v-model="kaziPlaceSource" type="radio" name="kp_add_type" value="all" /> All &nbsp;
                  <input v-model="kaziPlaceSource" type="radio" name="kp_add_type" value="search" /> Search
                </p>
              </div>
              <div class="col-md-5 mb-2">
                  <search-member db='kp'></search-member>
              </div>
              <div class="col-md-3 text-right">
                <button type="button" class="btn btn-info" @click="addFromKP()">Add To List</button>
              </div>
            </div>
          </form>
          <hr />
          <form>
            <div class="row">
              <div class="col-md-4 text-center text-md-left mb-2">
                <span class="fa fa-database"></span>
                <span> Jobs Platform</span>
                <p>
                  <input v-model="jobsPlatformSource" type="radio" name="jp_add_type" value="all"  /> All &nbsp;
                  <input v-model="jobsPlatformSource" type="radio" name="jp_add_type" value="search" /> Search
                </p>
              </div>
              <div class="col-md-5 mb-2">
                  <search-member db='jp'></search-member>
              </div>
              <div class="col-md-3 text-right">
                <button type="button" class="btn btn-info" @click="addFromJP()">Add To List</button>
              </div>
            </div>
          </form>
          <hr />
          <new-event-member-form></new-event-member-form>
        </div>
        <div class="card-footer clearfix"></div>
      </div>
</template>

<script>
import NewEventMemberForm from "./NewEventMemberForm";
import SearchMember from "./SearchMember";
export default {
  data: function(){
        return{
            kaziPlace: [],
            jobsPlatform: [],
            kaziPlaceSource: 'all',
            jobsPlatformSource: 'all',
            kaziPlaceSearchedMember: null,
            jobsPlatformSearchedMember: null,
        }
    },
  methods:{
    addFromKP:function(){

      let member = {name:null,email:null,id:'kp',database:null}
      if( this.kaziPlaceSource == 'all' ){
        member.name = 'All Kazi Place members'
        member.database = 'kazi place'
      }
      else 
        member = this.kaziPlaceSearchedMember

      if( this.memberAlreadyAdded(member) )
        return false

      this.$page.props.eventMembers.push( member )

    },
    addFromJP:function(){
      
      let member = {name:null,email:null,id:'jp',database:null}
      if( this.jobsPlatformSource == 'all' ){
        member.name = 'All Jobs Platform members'
        member.database = 'jobs platform'
      }
      else 
        member = this.jobsPlatformSearchedMember

      if( this.memberAlreadyAdded(member) )
        return false

      this.$page.props.eventMembers.push( member )

    },
    memberAlreadyAdded:function(member){

      let added = false 

      for( let i = 0; i < this.$page.props.eventMembers.length; i++ )
      {
        if( this.$page.props.eventMembers[i].id == member.id &&  this.$page.props.eventMembers[i].name == member.name )
        {
          added = true 
          break
        }
      }

      return added

    }
  },
  components: {
    "new-event-member-form": NewEventMemberForm,
    "search-member":SearchMember
  },
  watch:{
    kaziPlaceSource(val,oldVal){
      this.$page.props.kaziPlaceSource = val == 'all' ? true : false 
    },
    jobsPlatformSource(val,oldVal){
      this.$page.props.jobsPlatformSource = val == 'all' ? true : false
    },
  }
};
</script>

<style>
</style>