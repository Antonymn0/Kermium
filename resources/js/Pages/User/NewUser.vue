<template>
   <div class="wrapper">
    <top-nav></top-nav>
    <aside-nav></aside-nav>
    <div class="content-wrapper floating-form pb-4 pt-4">
        <form class="border p-3 bg-white" enctype="multipart/form-data" @submit.prevent="submit">
            <div class="alert-success  p-2 mb-2 rounded" v-if="success">
                {{ success_message }}
            </div>
            <div class="alert-danger  p-2 mb-2 rounded" v-if="failed">
                {{ failed_message }}
            </div>
            <h2> New user</h2>

            <hr>  
                            
            <div class="form-group">
                <label for="exampleFormControlInput1">Full Name</label>
                <input type="text" class="form-control" placeholder="full name" v-model="form.full_name" @change="validateFullName()">
                <small class="text-danger"> {{ errors.full_name}} </small>
            </div>
            <div class="form-row row"> 
                <div class="form-group col">
                    <label for="exampleFormControlInput1">Email</label>
                    <input type="text" class="form-control" placeholder="email" v-model="form.email" @blur="validateEmail()" >
                    <small class="text-danger"> {{ errors.email}} </small>
                </div>
             
                <div class="form-group col">
                    <label for="exampleFormControlInput1">Phone</label>
                    <input type="text" class="form-control" placeholder="phone" v-model="form.phone" @blur="validatePhone()">
                    <small class="text-danger"> {{ errors.phone}} </small>
                </div>
            </div>
            <div class="form-row"> 
                <div class="form-group col">
                    <label for="exampleFormControlInput1">Role</label>
                        <select  class="form-control" v-model="form.role" placeholer="role" @blur="validateRole()">
                        <option value="" default>- Select role -</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="guest"> Guest</option>
                        <option value="writer">Writer</option>
                    </select>
                    <small class="text-danger"> {{ errors.role}} </small>
                </div>
                <div class="form-group col">
                    <label for="exampleFormControlInput1">Upload image <small>(optional) </small> </label>
                    <input type="file" class="form-control" name="img"  @change="validateImage">
                    <small class="text-danger"> {{ errors.image}} </small>
                </div>
            </div>
            <div class="form-row"> 
                <div class="form-group col">
                    <label for="exampleFormControlInput1">Password</label>
                    <input type="password" class="form-control" placeholder="password" v-model="form.password" @blur="validatePassword()">
                    <small class="text-danger"> {{ errors.password}} </small>
                </div>
                <div class="form-group col">
                    <label for="exampleFormControlInput1">Password again</label>
                    <input type="password" class="form-control" placeholder="password again" v-model="form.password_again" @blur="validatePasswordAgain()">
                    <small class="text-danger"> {{ errors.password_again}} </small>
                </div>
            </div>
                
                <div class=" text-center ">
                    <a href="/dashboard/users" class="btn btn-danger m-2">Cancel</a>
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
            full_name:'',
            email:'',
            phone:'',
            role:'',
            img:null,
            password:'',
            password_again:'',
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
                let form_data= new FormData();
                form_data.append('full_name', this.form.full_name);
                form_data.append('email', this.form.email);
                form_data.append('phone', this.form.phone);
                form_data.append('role', this.form.role);
                form_data.append('img', this.form.img);
                form_data.append('password', this.form.password);
                form_data.append('password_again', this.form.password_again);
                
                axios.post('/v1/users', form_data)
                .then( response => {;
                    console.log(response.data)
                })
                .catch( error => {
                    if(error.response.status === 422) {
                        console.log(error.response.data.errors);
                    }
                });
            }
        },
        validateFullName: function(){
            if(!this.form.full_name) this.errors.full_name = 'Please provide your full name!' ;
            else if( this.form.full_name.length < 6 ) this.errors.full_name = 'Name too short!';
            else if( !_.isString(this.form.full_name)) this.errors.full_name = 'Invalid characters!';
            else  delete this.errors.full_name;       
        },
        validateEmail: function(){
            if(!this.form.email) this.errors.email = 'Email is required!' ;
            else if( !_.isString(this.form.email)) this.errors.email = 'Invalid characters!';
            else if( !this.email_regx.test(this.form.email)) this.errors.email = 'Email not valid!';
            else  delete this.errors.email;       
        },
        validatePhone: function(){
            if(!this.form.phone) this.errors.phone = 'Phone is required!';
            else if( isNaN(this.form.phone)  ) this.errors.phone = 'Invalid phone number!';
            else if( this.form.phone.length <10 ) this.errors.phone = 'Phone number too short!';
            else  delete this.errors.phone;       
        },
        validateRole: function(){
            if(!this.form.role) this.errors.role = 'This field is required!' ;
            else if( !_.isString(this.form.role)) this.errors.role = 'Invalid characters!';
            else  delete this.errors.role;       
        },
        validateImage: function(e){            
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)  return;
            this.form.img = e.target.files[0];    
        },       
        validatePassword: function(){
            if(!this.form.password) this.errors.password = 'Password is required!' ;
            else if( !this.password_regx.test(this.form.password)) this.errors.password = `Weak password! \n Password must contain  letters, numbers, special characters and be atleast 8 chararacters long.`;
            else  delete this.errors.password;       
        },
        validatePasswordAgain: function(){
            if(!this.form.password_again) this.errors.password_again = 'Type your password again!' ;
            else if( this.form.password_again !== this.form.password ) this.errors.password_again = "Passwords do not match!";
            else  delete this.errors.password_again;       
        },
        validate: function (){
        this.validateFullName();
        this.validateEmail();
        this.validatePhone();
        this.validateRole();
        this.validatePassword();
        this.validatePasswordAgain();
        // this.validateImage(0);
        
        Object.keys(this.errors).length ? this.can_submit = false : this.can_submit = true;
    }
    }

};
</script>
