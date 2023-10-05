<template>
  <div>
    <p>Number of Users: {{ numberOfUsers }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      numberOfUsers: 0
    };
  },
  mounted() {
    this.fetchInitialCount(); // Initial fetch

    window.Echo.channel('users')
      .listen('NewUserRegistered', (e) => {
        console.log("sdsdad");
        this.numberOfUsers += 1;
      });

      window.Echo.channel('trades')
      .listen('NewTrade', (e) => {
        console.log("qqqqqqqqqqqqq");
        this.numberOfUsers += 1;
      });

  },
  methods: {
    async fetchInitialCount() {
      // Make an API call to get initial user count
      // Update this with your actual API endpoint
      try {
        const response = await axios.get('/user/count');
        this.numberOfUsers = response.data.count;
      } catch (error) {
        console.error('There was an error!', error);
      }
    }
  }
};
</script>

<style scoped>
/* Add your styling here */
</style>
