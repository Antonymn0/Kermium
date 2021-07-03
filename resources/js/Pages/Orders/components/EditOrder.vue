<template>
  <div class="wrapper">
    <top-nav></top-nav>
    <aside-nav></aside-nav>

    <div class="content-wrapper floating-form pb-4 pt-4">
        <div class="container p-2 m-3">
            <div class="alert-success  p-2 mb-2 rounded" v-if="success">
                {{ success_message }}
            </div>
            <div class="alert-danger   p-2 mb-2 rounded" v-if="failed">
                {{ failed_message }}
            </div>
        </div>
        <form class="border p-3 bg-white"  @submit.prevent="submit">
           
            <h2> Edit order</h2>
            <hr>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleFormControlInput1">Topic <span class=" text-sm ml-1"> * </span> </label>
                    <input type="text" class="form-control" placeholder="topic" v-model="form.topic" @change="validateTopic()">
                    <small class="text-danger"> {{ errors.topic}} </small>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">User ID <span class=" text-sm ml-1"> * </span></label>
                    <input type="text" class="form-control" placeholder="user id" v-model="form.user_id" @change="validateUserId()">
                    <small class="text-danger"> {{ errors.user_id}} </small>
                </div>
                <div class="form-group col-md-2">
                    <label for="exampleFormControlInput1">Type <span class=" text-sm ml-1"> * </span></label>
                    <input type="text" class="form-control" placeholder="type" v-model="form.type" @change="validateType()">
                    <small class="text-danger"> {{ errors.type}} </small>
                </div>
            </div>
            <div class="form-row">                    
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Status </label>
                    <select  class="form-control" v-model="form.status" @blur="validateStatus()">
                        <option value="" default>-Select status-</option>
                        <option value="complete">Complete</option>
                        <option value="onHold">On hold</option>
                        <option value="inProgress"> In progress</option>
                        <option value="revisions">Revisions</option>
                    </select>
                    <small class="text-danger"> {{ errors.status}} </small>
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Deadline <span class=" text-sm ml-1"> * </span></label>
                    <input type="date" class="form-control"  placeholder="date" v-model="form.deadline" @blur="validateDeadline()">
                    <small class="text-danger"> {{ errors.deadline}} </small>
                </div>

                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Paper type <span class=" text-sm ml-1"> * </span></label>
                    <select class="form-control"  v-model="form.paper_type"  @change="validatePaperType()">
                    <option value="" default> -Select- </option>
                    <option value="type1">Type1</option>
                    <option value="type">Type2</option>
                    <option value="type3">Type3</option>
                    </select>
                    <small class="text-danger"> {{ errors.paper_type}} </small>
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Quantity <span class=" text-sm ml-1"> * </span></label>
                    <input type="text" class="form-control"  placeholder="type" v-model="form.quantity" @change="validateQuantity()">
                    <small class="text-danger"> {{ errors.quantity}} </small>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Spacing <span class=" text-sm ml-1"> * </span></label>
                    <input type="text" class="form-control" placeholder="type" v-model="form.spacing"  @change="validateSpacing()">
                    <small class="text-danger"> {{ errors.spacing}} </small>
                </div>

                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Pages</label>
                    <input type="text" class="form-control"  placeholder="type" v-model="form.pages"  @change="validatePages()">
                    <small class="text-danger"> {{ errors.pages}} </small>
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Words</label>
                    <input type="text" class="form-control"  placeholder="type" v-model="form.words" @change="validateWords()">
                    <small class="text-danger"> {{ errors.words}} </small>
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Academic level</label>
                    <input type="text" class="form-control"  placeholder="academic level" v-model="form.academic_level" @change="validateAcademicLevel()" >
                <small class="text-danger"> {{ errors.academic_level}} </small>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">Formatting style</label>
                    <input type="text" class="form-control"  placeholder="type" v-model="form.formating_style" @change="validateFormattingStyle()">
                    <small class="text-danger"> {{ errors.formatting_style}} </small>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">Number of sources</label>
                    <input type="text" class="form-control"  placeholder="type" v-model="form.number_of_sources" @change="validateNumberOfSources()">
                    <small class="text-danger"> {{ errors.number_of_sources}} </small>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">Sample upload</label>
                    <input type="file" class="form-control" name="file"   @change="validateFile">
                    <small class="text-danger"> {{ errors.file}} </small>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="exampleFormControlTextarea1">Instructions</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="form.instructions" @blur="validateInstructions()" ></textarea>
                    <small class="text-danger"> {{ errors.instructions}} </small>
                </div>
            </div>
            <div class=" text-center ">
                <a href="/dashboard/orders" class="btn btn-danger m-2">Cancel</a>
                <button type="submit" class="btn btn-primary m-2" :disabled="form.processing || Object.keys(this.errors).length">Update</button>
                <p class="text-danger d-block" v-if="Object.keys(this.errors).length"> Errors in the form! </p>
            </div>
        </form>
    </div>

    <footer-sec></footer-sec> 
  </div>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import TopNav from "../../../AdminLTEComponents/TopNav";
import AsideNav from "../../../AdminLTEComponents/AsideNav";
import Footer from "../../../AdminLTEComponents/Footer";


import moment from 'moment'

export default {
    props: {  
        order:Object
    },
    components: {
        BreezeAuthenticatedLayout,
        "top-nav": TopNav,
        "aside-nav": AsideNav,
        "footer-sec": Footer,
    },
    data:function (){
        return{
            form:{
                user_id: this.order.user_id,
                topic: this.order.topic,
                type: this.order.type,
                deadline: moment(this.order.deadline).format("YYYY-MM-DD"),
                paper_type: this.order.paper_type,
                quantity: this.order.quantity,
                spacing:this.order.spacing,
                status:this.order.status,
                pages:this.order.pages,
                words: this.order.words,
                academic_level: this.order.academic_level,
                instructions:this.order.instructions,
                formating_style: this.order.formating_style,
                number_of_sources: this.order.number_of_sources,
                sample_file: this.order.sample_file,
                old_sample_file: this.order.sample_file
            },
            errors: { },
            can_submit: true,
            success_message: '',
            success: false,
            failed: false,
            failed_message: ''            
        }
    },
    methods:{
     submit: function(){
        this.validate();
        if(this.can_submit){  
            let form_data = new FormData();
            form_data.append('user_id', this.form.user_id);
            form_data.append('topic', this.form.topic);
            form_data.append('type', this.form.type);
            form_data.append('deadline', this.form.deadline);
            form_data.append('paper_type', this.form.paper_type);
            form_data.append('quantity', this.form.quantity);
            form_data.append('spacing', this.form.spacing);
            form_data.append('status', this.form.status);
            form_data.append('pages', this.form.pages);
            form_data.append('words', this.form.words);
            form_data.append('academic_level', this.form.academic_lebvel);
            form_data.append('instructions', this.form.instructions);
            form_data.append('formating_style', this.form.formating_style);
            form_data.append('number_of_sources', this.form.number_of_sources);
            form_data.append('sample_file', this.form.sample_file);
            form_data.append('old_sample_file', this.form.old_sample_file);
            form_data.append('_method', 'PUT');

            axios.post('/v1/order/'+ this.order.id,  form_data)
            .then( response => {
                    if(response.status == 200){
                        this.success= true;
                        this.success_message = response.data.message;
                    }              
                    console.log(response.data);
                })
                .catch( error => {
                    this.failed= true;
                    this.failed_message = 'Failed. Operation not successful! Please try again';
                    console.log(error.response.data.errors)
                });
        }
        },

    validateUserId: function(){
    if(!this.form.user_id) this.errors.user_id = 'Please enter your user ID.' ;
    else if(isNaN(this.form.user_id)) this.errors.user_id = 'Field must be numeric.';
    else  delete this.errors.user_id;       
    },
    validateTopic: function(){
        if(!this.form.topic) this.errors.topic = 'This field is required!' ;
        else if( !_.isString(this.form.topic)) this.errors.topic = 'Invalid characters.';
        else  delete this.errors.topic;       
    },
    validateType: function(){
        if(!this.form.type) this.errors.type = 'This field is required!' ;
        else if( !_.isString(this.form.type)) this.errors.type = 'Invalid characters!';
        else  delete this.errors.type;       
    },
    validateStatus: function(){
        if(!this.form.status) this.errors.status = 'Please select status!' ;
        else if( !_.isString(this.form.status)) this.errors.status = 'Invalid characters!';
        else  delete this.errors.status;       
    },
    validateDeadline: function(){        
        if(!this.form.deadline) this.errors.deadline = 'Please select a deadline date!' ;
        else if( !Date.parse(this.form.deadline)) this.errors.deadline = 'Invalid date format!';
        else  delete this.errors.deadline;       
    },
    validatePaperType: function(){
        if(!this.form.paper_type) this.errors.paper_type = 'This field is required!' ;
        else if( !_.isString(this.form.paper_type)) this.errors.paper_type = 'Invalid characters!';
        else  delete this.errors.paper_type;       
    },
    validateQuantity: function(){
        if(!this.form.quantity) this.errors.quantity = 'This field is required!' ;
        else if( isNaN(this.form.quantity)) this.errors.quantity = 'Field must be numeric!';
        else  delete this.errors.quantity;       
    },
    validateSpacing: function(){
        if(!this.form.spacing) this.errors.spacing = 'This field is required' ;
        else if( !_.isString(this.form.spacing)) this.errors.spacing = 'Invalid characters!';
        else  delete this.errors.spacing;       
    },
    validatePages: function(){
        if( isNaN(this.form.pages)) this.errors.pages = 'Field must be numeric!';
        else  delete this.errors.pages;       
    },
    validateWords: function(){
        if( isNaN(this.form.words)) this.errors.words = 'Field must be numeric!';
        else  delete this.errors.words;       
    },
    validateAcademicLevel: function(){
        if( !_.isString(this.form.academic_level)) this.errors.academic_level = 'Invalid characters!';
        else  delete this.errors.academic_level;       
    },
    validateInstructions: function(){
        if( !_.isString(this.form.instructions)) this.errors.instructions = 'Invalid characters!';
        else  delete this.errors.instructions;       
    },
    validateFormatingStyle: function(){
        if( !_.isString(this.form.formating_style)) this.errors.formating_style = 'Invalid characters!';
        else  delete this.errors.formating_style;       
    },
    validateNumberOfSources: function(){
         if( isNaN(this.form.number_of_sources)) this.errors.number_of_sources = 'Field must be numeric!';
        else  delete this.errors.number_of_sources;       
    },
    validateFile: function(e){ 
        if(!e.target.files[0]) return;
        // for (let item in e.target.files)  this.form.file.push(item);          
        this.form.sample_file = e.target.files[0];
        console.log(this.form.sample_file);     
    },

    validate: function (){
        this.validateUserId();
        this.validateTopic();
        this.validateType();
        this.validateStatus();
        this.validateDeadline();
        this.validatePaperType();
        this.validateQuantity();
        this.validateSpacing();
        this.validatePages();
        this.validateWords();
        this.validateAcademicLevel();
        this.validateAcademicLevel();
        this.validateInstructions();
        this.validateFormatingStyle();
        this.validateNumberOfSources();
        // this.validateFile();

        Object.keys(this.errors).length ? this.can_submit = false : this.can_submit = true;
    }
    },
    computed:{
        //
    },
    mounted () {
      //
    }

};
</script>
