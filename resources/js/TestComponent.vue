<template>
  <div>
    <h1>{{ message }}</h1>
    <h1>{{ nowX() }}</h1>
    <h1>{{ showAge() }}</h1>
    <h1>{{ showtestParametar(55) }}</h1>


    <p>
      Name: <span>{{ latestTradeUser }}</span> <!-- Data binding here -->
    </p>

    <div v-if="apiData">
      <h2>Data from API:</h2>
      <ul>
        <li v-for="(country, index) in apiData.countries" :key="index">
          <span @click="increaseTax(index)">{{ country.name }}</span> (Tax: {{ country.country_tax }})
        </li>
      </ul>
    </div>
    <div class="product-card">
      <div class="product-image">
        <!-- <img :src="product.image" alt="Product Image" /> -->
      </div>
      <div class="product-details">
        <h2 class="product-name">{{ productData.name }}</h2>
        <p class="product-price">$ {{ productData.price }}</p>
      </div>
    </div>
    <button @click="handleButtonClick">Click Me</button>
    <div>
      <p v-if="showMessage">This message is displayed if showMessage is true.</p>
      <p v-else>This message is displayed if showMessage is false.</p>
      {{ showMessage ?'hi':'may' }}
    </div>
    <div v-if="value === 1">
      Value is one
    </div>

    <div v-else-if="value === 2">
      Value is two
    </div>

    <div v-else-if="value === 3">
      Value is three
    </div>

    <div v-else>
      Value is not one, two, or three
    </div>
    <p v-bind:class="message">test</p>
    <p :class="showMessage ?'red':'green'">hi every one i am color</p>
    <div>
      <ul>
        <li v-for="(item, index) in examplelist" :key="index">{{ item }}</li>
      </ul>
    </div>
  </div>
  <p>{{ result }}</p>
  <input v-on:input="username = $event.target.value" type="text">
  <button @click="showMeEvent">show Me</button>


  <br><br>
  <input v-on:input="eventParatmeterTest($event)" type="text">

  <p v-html="htmltest"></p>
  <p v-text="text"></p>

  <div>
    <ul>
      <li v-for="item in usersdata">{{ item.name }}</li>
    </ul>
  </div>
</template>

<script>
export default {
   data() {
     return {    value: 3 ,
      htmltest:"<b> you can put html code here </b>",
      text:"any text",
       message: 'Hello from Vue!',           
       username: 'taha',    
       result: 'no',
       apiData: null,
       productData: {  // Provide product data to the 'product' prop
        name: 'Product Name',
        price: 19.99,
   
        // other properties...
      },
        showMessage: true,
      examplelist :[50,60,40,80,50],
     users:[
     {
      name:"taha", age:"19",
     },
     {
      name:"mohamed", age:"18",
     },   
     {
      name:"yousef", age:"17",
     },
     ] ,
       age: 'Hello my age is 28!',
       latestTradeUser: ''  // New data property
     };
   },  props: {
        usersdata: {
            type: Array, // Adjust the type to match the data structure
            required: true
        }
    },
  mounted (){
this.fetchDataFromApi();
  },
  created() {
    // Fetch data from an API when the component is created
    // this.fetchDataFromApi();
  },
   methods :{
    eventParatmeterTest(event){
    console.log(event);    console.log("================");    console.log(event.target.value);
    },
    increaseTax(index) {
      // Increment the tax by 5 for the clicked country
      this.apiData.countries[index].country_tax = (parseFloat(this.apiData.countries[index].country_tax) + 5).toFixed(1);
    },
     nowX(){
         return "hi everyone"
     },
     showMeEvent(){
         this.result = this.username;
     },
     showAge(){
         return `${this.age}`
        },    
      showtestParametar(testParametar){
         return "HI I AM FIRST TESST PARAMETAT -> " + `${testParametar}`
      },
     handleButtonClick() {
      // This function will be executed when the button is clicked.
      console.log("Button clicked!");
      // this.productData.price +=15;
      this.productData.price +=15;
      // You can perform any action or call other methods here.
      // For example, you can update data properties, make an API request, or navigate to a different route.
    },
    
    fetchDataFromApi() {
      // Make an API request using Axios
      axios.get('https://wealthest22.com/khymat-zaman-back/public/api/countries') // Replace with your API endpoint
        .then(response => {
          // Update apiData with the fetched data
          this.apiData = response.data;
        })
        .catch(error => {
          console.error('Error fetching data from the API:', error);
        });
    },


   },

};

</script>

<style scoped>
.red {
  color: #ff5733;
}

.green {
  color: chartreuse;
}

.product-card {
  width: 300px;
  border: 1px solid #e0e0e0;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease-in-out;
  cursor: pointer;
  margin: 20px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.product-card:hover {
  transform: translateY(-5px);
}

.product-image img {
  max-width: 100%;
  height: auto;
  object-fit: cover;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

.product-details {
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.product-name {
  font-size: 1.5rem;
  margin: 10px 0;
  color: #333;
}

.product-price {
  font-size: 1.25rem;
  font-weight: bold;
  color: #ff5733;
}
</style>