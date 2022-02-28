<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <table class="table">
          <thead class="table-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Order ID</th>
              <th scope="col">product_ID</th>
              <th scope="col">Product Name</th>
              <th scope="col">Amount</th>
              <th scope="col">Price</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="orders in order" :key="orders.id">
              <td>{{ orders.id }}</td>
              <td>{{ orders.order_id }}</td>
              <td>{{ orders.product_id }}</td>
              <td>{{ orders.product_name }}</td>
              <td>{{ orders.amount }}</td>
              <td>{{ orders.price }}</td>
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
      order: [],
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  mounted() {
    axios
      .get("/api/Checkout")
      .then((data) => {
        this.order = data.data;
      })
      .catch((err) => console.log(err));
  },
};
</script>

<style>
</style>
