<template>
 <div class="content-wrapper container">
    <div class="col-md-12">
       
        <div class="container alert alert-success p-2 m-2" v-if="successMessage">
            {{ successMessage }}
        </div>
        <div class="row p-2">
          <h2 class="ml-5 p-1"> {{ title }}</h2>
          <inertia-link href="/dashboard/orders/create" class="btn btn-primary m-2"> <i class="fa fa-plus p-1"> </i></inertia-link>  
        </div>
        <div class=" table-responsive">
            <table class="table table-bordered table-sm table-hover w-auto">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Topic</th>
                        <th scope="col">Type</th>
                        <th scope="col">Status</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Paper type</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Spacing</th>
                        <th scope="col">Pages</th>
                        <th scope="col">Words</th>
                        <th scope="col">Academic level</th>
                        <th scope="col">Instaructions</th>
                        <th scope="col">Formatting style</th>
                        <th scope="col">No of sources</th>
                        <th scope="col">Sample files</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody > 
                    <tr  v-for="(order, index) in orders.data" :key="order.id">                
                        <td> <div class="t-cell"> {{ index +1}} </div>  </td>
                        <td> <div class="t-cell"> {{ order.topic }}  </div> </td>
                        <td> <div class="t-cell"> {{order.type}} </div> </td>
                        <td> <div class="t-cell"> {{order.status}}</div>  </td>
                        <td> <div class="t-cell"> {{order.deadline}}</div>  </td>
                        <td> <div class="t-cell"> {{order.paper_type}}</div>  </td>
                        <td> <div class="t-cell"> {{order.quantity}} </div> </td>
                        <td> <div class="t-cell"> {{order.spacing}} </div> </td>
                        <td> <div class="t-cell"> {{order.pages}} </div> </td>
                        <td> <div class="t-cell"> {{order.words}}  </div> </td>
                        <td> <div class="t-cell"> {{order.academic_level}} </div>   </td>
                        <td> <div class="t-cell"> {{order.instructions}} </div> </td>
                        <td> <div class="t-cell"> {{order.formatting_style}} </div> </td>
                        <td> <div class="t-cell"> {{order.number_of_sources}} </div> </td>
                        <td> <div class="t-cell"> <inertia-link :href="'/storage/' + order.sample_file" download="download">{{order.sample_file}} </inertia-link>  </div> </td>
                        <td>   
                            <div class="row">
                                    <div class="col m-auto">
                                        <inertia-link :href="'/dashboard/orders-edit/'+  order.id"  class="btn btn-primary btn-sm mb-1"> <i class="fa fa-edit p-1"></i> </inertia-link> 
                                        <inertia-link href ="#" class=" btn-danger btn-sm m-1" @click="deleteItem(order)">  <i class="fa fa-trash p-1"></i></inertia-link>                             
                                        
                                    </div>
                                </div>                      
                        </td>                   
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
  </div>
</template>

<script>
export default {
    props:['orders', 'successMessage', 'title'],
    data:function () {
        return {
           
            
        };       
    },
    components:{

    },
    methods:{
        editItem(order){
            this.$inertia.post('/orders/' + order.id, order)
        },
        deleteItem(order) {
            if (!confirm('Are you sure want to delete this order?')) return;
               axios.delete('/v1/order/'+ order.id)
               .then( response => {
                   this.$inertia.visit('/dashboard/orders'); //redirect back
                })
                .catch( error => {
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
 .table{
   display: block !important;
   overflow-x: auto !important;
   width: 100% !important;
   display: block
 }
</style>


