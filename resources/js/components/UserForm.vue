<template>
  <div>
    <h2 v-if="isNewUser">Add User</h2>
    <h2 v-else>Edit User</h2>
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input class="form-control" type="text" id="name" v-model="user.name" required />
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <textarea class="form-control" id="email" v-model="user.email" required></textarea>
        </div>
        <div class="mb-3">
          <label for="Time" class="form-label">Price:</label>
          <input class="form-control" type="number" id="current_team_id" v-model="user.current_team_id" required />
        </div>
        <button type="submit" v-if="isNewUser" class="btn btn-primary">Add User</button>
        <button type="submit" v-else class="btn btn-primary">Update User</button>
      </form>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      user: {
        name: '',
        email: '',
        current_team_id: 0
      }
    }
  },
  computed: {
    isNewProduct() {
      return !this.$route.path.includes('edit');
    }
  },
  async created() {
    if (!this.isNewProduct) {
      const response = await axios.get(`/api/users/${this.$route.params.id}`);
      this.user = response.data;
    }
  },
  methods: {
    async submitForm() {
      try {
        if (this.isNewProduct) {
          await axios.post('/api/users', this.user);
        } else {
          await axios.put(`/api/users/${this.$route.params.id}`, this.user);
        }
        this.$router.push('/');
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>
