<template>
  <div>
    <h1>{{ message }}</h1>
    <h1>{{ nowX() }}</h1>
    <h1>{{ showAge() }}</h1>



    <p>
      Name: <span>{{ latestTradeUser }}</span> <!-- Data binding here -->
    </p>




  </div>
</template>

<script>
export default {
   data() {
     return {
       message: 'Hello from Vue!',
       age: 'Hello my age is 28!',
       latestTradeUser: ''  // New data property
     };
   },
   methods :{
     nowX(){
         return "hi everyone"
     },
     showAge(){
         return `${this.age}`
     }
   },
   mounted(){
    window.Echo.channel('trades')
        .listen('NewTrade', (e) => {
            console.log(e.trade);
               console.log("asddddddddddddddddddd");
            this.latestTradeUser  = e.trade;
        });

   },
};

</script>

<style scoped>
h1 {
  color: blue;
}
</style>
