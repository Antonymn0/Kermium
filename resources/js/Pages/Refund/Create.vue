<template>
   <div class="wrapper">
    <top-nav></top-nav>
    <aside-nav></aside-nav>
    <div class="content-wrapper floating-form pb-4 pt-4">
        <form class="border p-3 bg-white"  @submit.prevent="submit">
            <div class="alert-success  p-2 mb-2 rounded" v-if="success">
                {{ success_message }}
            </div>
            <div class="alert-danger  p-2 mb-2 rounded" v-if="failed">
                {{ failed_message }}
            </div>
            <h2> Refund request form</h2>

            <hr>  
                            
            
            <div class="form-row row">
                <div class="form-group mr-2">
                  <label for="exampleFormControlInput1">Order Id</label>
                  <select class="form-control p-2 " placeholder="Order id" v-model="form.order_id" @change="validateOrderId()">
                    <option value=""> -Select-</option>
                    <option value="11">011</option>
                    <option value="12">012</option>
                    <option value="13">013</option>
                    <option value="14">014</option>
                   </select>
                  <small class="text-danger"> {{ errors.order_id}} </small>
                </div>

                <div class="form-group col">
                    <label for="exampleFormControlInput1">Reason</label>
                    <input type="text" class="form-control p-2" placeholder="Reason" v-model="form.reason" @blur="validateReason()" >
                    <small class="text-danger"> {{ errors.reason}} </small>
                </div>
             </div>
                <div class="form-group col">
                    <label for="exampleFormControlInput1">More Explanation</label>
                    <textarea  class="form-control"  placeholder="Explanation" v-model="form.more_explanation" @blur="validateMoreExplanation()"> </textarea>
                    <small class="text-danger"> {{ errors.more_explanation}} </small>
                </div>  
                <div class=" text-center ">
                    <a href="/dashboard/refunds" class="btn btn-danger m-2">Cancel</a>
                    <button type="submit" class="btn btn-primary m-2" :disabled="form.processing || Object.keys(this.errors).length" >Save</button>
                    <p class="text-danger d-block" v-if="Object.keys(this.errors).length"> Errors in the form! </p>
                </div>
            </form>
        </div>

    <footer-sec></footer-sec> 
  </div>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import TopNav from "../../AdminLTEComponents/TopNav";
import AsideNav from "../../AdminLTEComponents/AsideNav";
import Footer from "../../AdminLTEComponents/Footer";

import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {   
    components: {
        BreezeAuthenticatedLayout,
        "top-nav": TopNav,
        "aside-nav": AsideNav,
        "footer-sec": Footer,
    },
    computed: {
        validationErrors(){
            let errors = Object.values(this.errors);
            errors = errors.flat();
            return errors;
        }
    },
    data(){
    return{         
        form: {
            order_id:'',
            reason:'',
            more_explanation:'',
            status:'pending'
        }, 
        errors: { },
        can_submit: true,
        success_message: '',
        success: false,
        failed: false,
        failed_message: '',
        config: {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                },
        password_regx:  /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/,
        email_regx: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/
        
    }
    }, 
    methods:{
        submit: function(){
            this.validate();
            if(this.can_submit){
                axios.post('/v1/refund', this.form)
                .then( response => {
                    console.log(response.data)
                    this.$inertia.visit('/dashboard/refunds');
                })
                .catch( error => {
                    if(error.response.status === 422) {
                        console.log(error.response.data.errors);
                    }
                });
            }
        },
        validateOrderId: function(){
            if(!this.form.order_id) this.errors.order_id = 'Please select order Id!' ;
            else if( _.isNaN(this.form.order_id)) this.errors.order_id = 'Id must be numeric!';
            else  delete this.errors.order_id;       
        },
        validateReason: function(){
            if(!this.form.reason) this.errors.reason = 'Reason is required!';
            else if( this.form.reason.length <10 ) this.errors.reason = 'Reason too short!';
            else  delete this.errors.reason;       
        },
        validateMoreExplanation: function(){
            if(!this.form.more_explanation) this.errors.more_explanation = 'Please provide an explanation!' ;
            else  delete this.errors.more_explanation;       
        },

        validate: function (){
          this.validateOrderId();
          this.validateReason();
          this.validateMoreExplanation();
          console.log(Object.keys(this.errors));
          Object.keys(this.errors).length ? this.can_submit = false : this.can_submit = true;
        }
    }

};
</script>
