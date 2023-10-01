<template>
  <div>
    <h1>Chat Room</h1>
    <div v-for="msg in messages" :key="msg.id" :class="{ 'my-message': msg.isMine, 'other-message': !msg.isMine }">
      <strong>{{ msg.user }}:</strong> {{ msg.content }}
    </div>
    <input v-model="newMessage" @keyup.enter="sendMessage" placeholder="Type a message..." />
  </div>
</template>

<script>
export default {
  data() {
    return {
      newMessage: '',
      messages: [],
      user: '' // Set this dynamically from authenticated user
    };
  },
  mounted() {
    this.user = 'YourUserName'; // Retrieve this dynamically from session or API
    window.Echo.channel('chat')
      .listen('MessageSent', (e) => {
        this.messages.push({
          content: e.message,
          user: e.user,
          isMine: e.user === this.user,
          id: this.messages.length + 1 // Improve ID assignment for production
        });
      });
  },
  methods: {
    sendMessage() {
      axios.post('/send-message', { message: this.newMessage })
        .then(response => {
          this.newMessage = ''; // Reset the input after sending
        })
        .catch(error => {
          console.error('There was an error!', error);
        });
    }
  }
};
</script>

<style scoped>
.my-message {
  color: blue;
}

.other-message {
  color: red;
}
</style>
