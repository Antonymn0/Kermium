<template>
<div>
    <div class="input-group">
        <input
            v-model="search_str"
            type="text"
            class="form-control"
            :placeholder="placeholder"
            :disabled="db == 'kp' ? $page.props.kaziPlaceSource : $page.props.jobsPlatformSource"
            @keyup="search()"
        />
        <div class="input-group-append">
        <span class="input-group-text">
            <i class="fas fa-search"></i>
        </span>
        </div>
    </div>
    <div class="search-results-panel border bg-light">
        <ul>
            <li v-for="(member,index) in results" :key="index" class="border bg-white">
                <a href="#" @click.prevent="addToList(member)"> <strong>{{member.name}}</strong>  <small>{{member.email}}</small>  <small>{{member.phone}}</small>  </a>
            </li>
        </ul>
    </div>
</div>
</template>

<script>
export default {
props: {
    db: String,
  },
data: function(){
        return{
            placeholder: null,
            search_str:'',
            results: [],
            database:null
        }
    },
methods:{
    search:function(){

        if( this.search_str.length < 3 )
            return false 

        axios({
            method: "POST",
            url: "/v1/search/member",
            data: {
            search_str:this.search_str,
            database:this.database
            },
        })
            .then((response) => {
                if( response.data.success )
                    this.results = response.data.data.data
            })
            .catch((error) => {
            console.log(error);
        });
        
    },
    addToList:function(member){
        this.$page.props.eventMembers.push( member )
        this.results = []
        this.search_str = null
    }
},
mounted(){

    if( this.db == 'kp' ){
        this.placeholder = "Search from Kazi Place"
        this.database = 'kazi place'
    }
    else if( this.db == 'jp' ){
        this.placeholder = "Search from Jobs Platform"
        this.database = 'jobs platform'
    }

}
}
</script>

<style>

</style>