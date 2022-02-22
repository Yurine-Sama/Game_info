<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="row">
            <div class="col-12">
              <!-- Card header -->
              <div class="card-header">
                <div class="row">
                  <div class="col">
                    <h1>Game Store</h1>
                  </div>
                  <div class="col text-end my-2">
                    <button
                      type="button"
                      class="btn btn-success me-md-2"
                      data-bs-toggle="modal"
                      data-bs-target="#addProduct"
                    >
                      Create Product
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <!-- Card body for table -->
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <!-- Table head -->
                    <thead class="table-dark">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Update</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="game in games" :key="game.id">
                        <td>{{ game.id }}</td>
                        <td width="150px">
                          <img :src="game.product_image" width="100%" />
                        </td>
                        <td>{{ game.product_name }}</td>
                        <td>{{ game.price }} ฿</td>
                        <td width="500px">{{ game.description }}</td>
                        <td>
                          <button
                            class="btn btn-danger mt-2"
                            @click="delProduct(game.id)"
                          >
                            Delete
                          </button>
                        </td>
                        <td>
                          <button
                            type="button"
                            @click="updateModal(game.id)"
                            class="btn btn-primary mt-2"
                            data-bs-toggle="modal"
                            data-bs-target="#updateModal"
                          >
                            Update
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Add Product -->
      <div
        class="modal fade"
        id="addProduct"
        tabindex="-1"
        aria-labelledby="modal-header"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal-header">New Game</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <form @submit.stop.prevent="addProduct()">
                <label for="name">Name of game</label>
                <input
                  type="text"
                  id="name"
                  v-model="productName"
                  class="form-control"
                  required
                />
                <label for="img">Image Url</label>
                <input
                  type="text"
                  id="img"
                  v-model="productImg"
                  class="form-control"
                  required
                />
                <label for="price">Price</label>
                <input
                  type="number"
                  id="price"
                  v-model="price"
                  class="form-control"
                  required
                />
                <label for="des">Description</label>
                <textarea
                  id="des"
                  v-model="description"
                  rows="3"
                  class="form-control"
                  required
                />
                <div class="mt-3 text-end">
                  <button type="reset" class="btn btn-danger mr-2">
                    Cancel
                  </button>
                  <button type="submit" class="btn btn-success">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Update product -->
    </div>
    <div
      class="modal fade"
      id="updateModal"
      tabindex="-1"
      aria-labelledby="modal-header"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal-header">Update Game</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form @submit.stop.prevent="updateProduct()">
              <label for="name">Name of game</label>
              <input
                type="text"
                id="name"
                v-model="productName"
                class="form-control"
                required
              />
              <label for="img">Image Url</label>
              <input
                type="text"
                id="img"
                v-model="productImg"
                class="form-control"
                required
              />
              <label for="price">Price</label>
              <input
                type="number"
                id="price"
                v-model="price"
                class="form-control"
                required
              />
              <label for="des">Description</label>
              <textarea
                id="des"
                v-model="description"
                rows="3"
                class="form-control"
                required
              />
              <div class="mt-3 text-end">
                <button type="reset" class="btn btn-danger mr-2">Cancel</button>
                <button type="submit" class="btn btn-success">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      games: [],
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      // from product
      productId: "",
      productName: "",
      productImg: "",
      price: "",
      description: "",
    };
  },
  mounted() {
    axios
      .get("/api/product")
      .then((data) => {
        this.games = data.data;
      })
      .catch((err) => console.log(err));
  },
  methods: {
    // Add product function
    addProduct() {
      axios
        .post("/api/product/store", {
          product_name: this.productName,
          product_image: this.productImg,
          price: this.price,
          description: this.description,
        })
        .then(() => {
          alert("Add product success.");
          window.location.reload();
        })
        .catch((err) => alert(err));
    },

    // Update product function
    updateModal(id) {
      // API Get data from id and set it on from
      axios.get(`/api/product/show/${id}`).then((data) => {
        (this.productId = data.data.id),
          (this.productName = data.data.product_name);
        this.productImg = data.data.product_image;
        this.price = data.data.price;
        this.description = data.data.description;
      });
    },
    updateProduct() {
      axios
        .post(`/api/product/update/${this.productId}`, {
          product_name: this.productName,
          product_image: this.productImg,
          price: this.price,
          description: this.description,
        })
        .then(() => {
          alert("Update product success.");
          window.location.reload();
        })
        .catch((err) => alert(err));
    },

    // Delete function
    delProduct(id) {
      const isComfirm = confirm("Are you sure to delete this game?");
      if (isComfirm == true) {
        axios
          .delete(`/api/product/del/${id}`)
          .then(() => {
            alert("Delete product success.");
            window.location.reload();
          })
          .catch((err) => alert(err));
      }
    },
  },
};
</script>
