<template>
  <div class="container">
    <!-- meta csrf -->
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="row">
            <div class="col-12">
              <!-- Card header -->
              <div class="card-header">
                <div class="row">
                  <div class="col-8">
                    <h1>Game Store</h1>
                  </div>
                  <div class="col-4 mt-2">
                    <form @submit.stop.prevent="searchClick" class="d-flex">
                      <input
                        class="form-control me-2"
                        type="search"
                        placeholder="Search"
                        v-model="searchText"
                        name="search"
                        required
                      />
                      <button class="btn btn-outline-success" type="submit">
                        Search
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <!-- Carousel -->
                    <div
                      id="carouselExampleFade"
                      class="carousel slide carousel-fade"
                      data-bs-ride="carousel"
                    >
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img
                            src="https://s.isanook.com/ga/0/ui/224/1121313/gal-1121313-20211026120012-5164b95.jpg"
                            class="d-block w-100"
                          />
                        </div>
                        <div class="carousel-item">
                          <img
                            src="https://gamerbraves.sgp1.cdn.digitaloceanspaces.com/2020/01/arknights-feature-c.jpg"
                            class="d-block w-100"
                          />
                        </div>
                        <div class="carousel-item">
                          <img
                            src="https://www.anime-os.com/info/image/2021/10/arknights-game-keyvisual-5.jpg.webp"
                            class="d-block w-100"
                          />
                        </div>
                        <div class="carousel-item">
                          <img
                            src="https://www.anime-os.com/info/image/2021/10/arknights-game-keyvisual-5.jpg.webp"
                            class="d-block w-100"
                          />
                        </div>
                        <div class="carousel-item">
                          <img
                            src="https://www.pcgamesn.com/wp-content/uploads/2020/10/best-anime-games-pcgamesn.jpg"
                            class="d-block w-100"
                          />
                        </div>
                      </div>
                      <button
                        class="carousel-control-prev"
                        type="button"
                        data-bs-target="#carouselExampleFade"
                        data-bs-slide="prev"
                      >
                        <span
                          class="carousel-control-prev-icon"
                          aria-hidden="true"
                        ></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button
                        class="carousel-control-next"
                        type="button"
                        data-bs-target="#carouselExampleFade"
                        data-bs-slide="next"
                      >
                        <span
                          class="carousel-control-next-icon"
                          aria-hidden="true"
                        ></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    </div>
                  </div>
                  <div class="col-12">
                    <!-- Games -->

                    <div class="row my-5">
                      <!-- Loop games -->

                      <div class="col-6" v-for="game in games" :key="game.id">
                        <form action="orders" method="POST">
                          <!-- check csrf to go order page -->
                          <input type="hidden" name="_token" :value="csrf" />
                          <!-- check product id -->
                          <input
                            type="hidden"
                            name="product_id"
                            :value = game.id
                          />
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
                                        class="btn btn-info btn-block"
                                        @click="buyGame(game.id)"
                                      >
                                        Read more
                                      </button>
                                      <button
                                        class="btn btn-primary btn-block"
                                        :value="csrf"
                                      >
                                        buy
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>

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
                                <h2>{{ price }} ฿</h2>
                              </div>
                              <div class="row">
                                <div class="col text-center mt-2"></div>
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
  props: ["post-route"],
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      games: [],
      productId: "",
      productName: "",
      productImg: "",
      price: "",
      description: "",
      searchText: null,
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
    buyGame(id) {
      axios.get(`/api/product/show/${id}`).then((data) => {
        this.productId = data.data.id;
        this.productName = data.data.product_name;
        this.productImg = data.data.product_image;
        this.price = data.data.price;
        this.description = data.data.description;
      });
    },

    searchClick() {
      window.location.replace(`/search/${this.searchText}`);
    },
  },
};
</script>
