<template>
  <input
    type="text"
    class="form-control"
    :id="id"
    :placeholder="placeholder"
    :value="value"
    />
</template>

<script>
export default {
emits: ['selected'],
props: {
    id: String,
    placeholder: String,
    value:String
  },
  methods:{
    setDate:function(value){
        this.$emit('selected', value)
    },
    selectDate:function(){
      jQuery('#'+this.id).datetimepicker({
          onChangeDateTime: (dp,$input) => {
                this.setDate($input.val())
            },
            /*allowTimes:[
  '12:00', '13:00', '15:00', 
  '17:00', '17:05', '17:20', '19:00', '20:00'
 ],*/
  minDate:'0',//yesterday is minimum date(for today use 0 or -1970/01/01)
 //maxDate:'+1970/01/02'//tomorrow is maximum date calendar

      });
    }
  },
  mounted(){
      this.selectDate()
  }
}
</script>

<style>

</style>