<template>
    <div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.current_team_id }}</td>
                    <td>
                      <div class="row gap-3">
                        <router-link :to="`/users/${user.id}`" class="p-2 col border btn btn-primary">View</router-link>
                        <router-link :to="`/users/${user.id}/edit`" class="p-2 col border btn btn-success">Edit</router-link>
                        <button @click="deleteProduct(user.id)" type="button" class="p-2 col border btn btn-danger">Delete</button>
                      </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      users: []
    }
  },
  async created() {
    try {
      const response = await axios.get('/api/users');
      this.users = response.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async deleteProduct(id) {
      try {
        await axios.delete(`/api/users/${id}`);
        this.users = this.users.filter(product => user.id !== id);
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>
