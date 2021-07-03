<template>
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="/">Acamium</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block"><b>Version</b> 1.1.0</div>

    <div class="update-success-div" v-if="show_loading_icon">
            <div  v-if="loading_success">
                <img class="img img-fluid" src="/img/update-success.gif" />
                <p>Done</p>
            </div>
            <div v-else>
                <img  class="img img-fluid" src="/img/img-loader-cirlce.gif" />
                <p>Processing...</p>
            </div>
        </div>
  </footer>
</template>

<script>
export default {
  data:()=>{
    return{
      show_loading_icon:false,
      loading_success: false
    }
  },
  methods:{
    loadingComplete:function(){
               this.loading_success = true
               setTimeout( () => { this.resetLoading() }, 1400 );
          },
         resetLoading:function(){
               this.show_loading_icon = false
               this.loading_success = false                      
         },
  },
  mounted () {
    axios.interceptors.request.use((config) => {
         this.show_loading_icon = true;
         return config;
         }, function(error) {
               // Do something with request error
               console.log('Error');
               return Promise.reject(error);
         });

         axios.interceptors.response.use((response) => {
               this.loadingComplete();
               return response;
         }, function(error) {
               console.log('Error fetching the data');
               return Promise.reject(error);
         });
    },
};
</script>

<style>
</style>