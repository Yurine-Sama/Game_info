<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <table class="table">
          <thead class="table-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">user_ID</th>
              <th scope="col">user_name</th>
              <th scope="col">status</th>
              <th scope="col">total</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="orders in orderCheck" :key="orders.id">
              <td>{{ orders.id }}</td>
              <td>{{ orders.user_id }}</td>
              <td>{{ orders.user_name }}</td>
              <td>{{ orders.status }}</td>
              <td>{{ orders.total }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      orderCheck: [],
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  mounted() {
    axios
      .get("/api/admin/order")
      .then((data) => {
        this.orderCheck = data.data;
      })
      .catch((err) => console.log(err));
  },
};
</script>

<style>
</style>
