<template>
  <div class="wrapper">
    <top-nav></top-nav>
    <aside-nav></aside-nav>

     <div class="content-wrapper ">
    <div class="col-md-12">
        <div class="row p-2">
          <h2 class="ml-5 p-1"> All Refunds</h2>
           <inertia-link href="/dashboard/refunds-create" class="btn btn-primary m-2"> <i class="fa fa-plus p-1"> </i></inertia-link>  
       
        </div>
        <div class="container">
            <div class="alert-success container p-2 m-2 rounded" v-if="success">
               {{ success_message }}!
            </div>
            <div class="alert-danger container p-2 rounded" v-if="failed">
               {{ failed_message }}!
            </div>
          
         </div>
        <div class="p-2">
            <table class="table  table-responsive table-bordered table-hover ">
                <thead class="thead-dark ">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order Id</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Reason</th>
                        <th scope="col">More explanation</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  <tr  v-for="(refund,index) in data" :key="refund.id" class=" mb-1"> 
                      <td> <div class="t-cell"> {{ index+1}} </div></td>
                      <td> <div class="t-cell"> {{ refund.order_id}} </div></td>
                      <td> <div class="t-cell"> {{refund.name}} </div></td>
                      <td> <div class="t-cell"> {{refund.reason}} </div></td>
                      <td> <div class="t-cell"> {{refund.more_explanation}} </div></td>
                      <td> <div class="t-cell"> {{refund.created_at}} </div></td>
                      <td> <div class="t-cell">  
                          <div class="row">
                              <div class="col m-auto">
                                  
                                  <a href ="#" class="btn btn-danger btn-sm m-1" @click="deleteItem(refund)">  <i class="fa fa-trash p-1"></i></a>                             
                                  
                              </div>
                          </div>
                       </div> </td>        
                  </tr>
                  
                </tbody>
               
            </table>
        </div>
        
    </div>
  </div>
   
    <footer-sec></footer-sec>
  </div>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import TopNav from "../../AdminLTEComponents/TopNav";
import AsideNav from "../../AdminLTEComponents/AsideNav";
import Footer from "../../AdminLTEComponents/Footer";

export default {
  data: function (){
    return{
      errors: { },
      success_message: '',
      success: false,
      failed: false,
      failed_message: '' 
    }
  },
  props: {
    asideActiveEl: String,
    asideActiveSubEl: String,
    authUser: Object,
    authUserPermissions: Array,
    monthlySmsCount: String,
    monthlyEmailsCount: String,
    monthlyMembersCountJP: String,
    monthlyMembersCountKP: String,
    latestEvents: Object,
    recentMembers: Object,
    notifications: Array,
    footerDate: String,
    data:Object,
    title: String
  },
  components: {
    BreezeAuthenticatedLayout,
    "top-nav": TopNav,
    "aside-nav": AsideNav,    
    "footer-sec": Footer,
  },
  methods:{
        deleteItem(refund) {
            if (!confirm('Are you sure want to delete this refund?')) return;
               axios.delete('/v1/refund/' + refund.id, this.form)
               .then( response => {
                  if(response.status == 200){
                     this.success= true;
                     this.success_message = response.data.message;
                  } 
                  this.$inertia.visit('/dashboard/refunds');
               })
                .catch( error => {
                  this.failed= true;
                  this.failed_message = 'Failed. Operation not successful! Please try again';
                  console.log(error);
                });         
        },
  },
   mounted() {
      //expand or collapse table rows
      $(".table tr ").click(function(){
        let tr =  $(".table tr td div").parent();
        $(this).children().children().toggleClass("t-cell");
        console.log('clicked');
      });
  }
};


</script>

<style scoped>
 .table tr td .t-cell {
    height: 3.3em;
    z-index: -5;
    overflow: hidden;
  }
</style>

