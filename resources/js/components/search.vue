<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="row">
            <div class="col-12">
              <!-- Card header -->
            </div>
            <div class="col-12">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <!-- Carousel -->
                  </div>
                  <div class="col-12">
                    <!-- Games -->
                    <div class="row my-5">
                      <!-- Loop games -->
                      <div class="col-6" v-for="game in games" :key="game.id">
                        <div class="card mb-3" style="max-width: 540px">
                          <div class="row g-0">
                            <div class="col-md-4">
                              <img
                                :src="game.product_image"
                                class="img-fluid rounded-start"
                              />
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h5 class="card-title">
                                  {{ game.product_name }}
                                </h5>
                                <p class="card-text text-truncate mt-2">
                                  {{ game.description }}
                                </p>
                                <h4 class="card-text mt-5">
                                  Price : {{ game.price }} ฿
                                </h4>
                                <div class="card-text">
                                  <!-- buy btn -->
                                  <div class="d-grid gap-2 mt-5">
                                    <button
                                      type="button"
                                      data-bs-toggle="modal"
                                      data-bs-target="#buyGame"
                                      class="btn btn-primary btn-block"
                                      @click="buyGame(game.id)"
                                    >
                                      Read more
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal -->
                        <div
                          class="modal fade"
                          id="buyGame"
                          data-bs-backdrop="static"
                          data-bs-keyboard="false"
                          tabindex="-1"
                          aria-labelledby="staticBackdropLabel"
                          aria-hidden="true"
                        >
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="G_name">
                                  {{ productName }}
                                </h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body text-center">
                                <img
                                  :src="productImg"
                                  class="img-fluid"
                                  style="max-height: 300px"
                                />
                              </div>
                              <!-- text area -->
                              <div class="mb-3 text-center">
                                <label
                                  for="exampleFormControlTextarea1"
                                  class="form-label"
                                  >info</label
                                >
                                <textarea
                                  readonly
                                  class="form-control"
                                  id="exampleFormControlTextarea1"
                                  rows="3"
                                  v-model="description"
                                ></textarea>
                              </div>
                              <div class="text-center">
                                <h2>in steam {{ price }} ฿</h2>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--end modal-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
      searchText: null,

      games: [],
      productId: "",
      productName: "",
      productImg: "",
      price: "",
      description: "",
    };
  },
  created() {
    const route = window.location.href.split("/");
    this.searchText = route[route.length - 1];
  },
  mounted() {
    axios
      .get(`/api/product/search/${this.searchText}`)
      .then((data) => {
        this.games = data.data;
      })
      .catch((err) => console.log(err));
  },
  methods: {
    buyGame(id) {
      axios.get(`/api/product/show/${id}`).then((data) => {
        this.productId = data.data.id;
        this.productName = data.data.product_name;
        this.productImg = data.data.product_image;
        this.price = data.data.price;
        this.description = data.data.description;
      });
    },
  },
};
</script>
