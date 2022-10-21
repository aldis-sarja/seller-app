<template>
  <div>
    <NavBar />
    <div class="create-order">
      <form
        class="create-order-section"
        ref="formName"
        @submit.prevent="onCreateOrder"
      >
        <div v-if="$route.query.product_id">
          <div class="headline">
            <div class="name">
              <b>{{ $store.state.product.name }}</b>
            </div>
            <div class="type">
              {{ $store.state.product.type }}
            </div>
          </div>

          <div class="input-line">
            <label class="label" for="select">Choose Client:</label>

            <select class="select" v-model="client_id" required id="select">
              <option
                v-for="client in clientList"
                :key="client.id"
                :value="client.id"
              >
                {{ client.name }}
              </option>
            </select>
          </div>
        </div>

        <div v-if="$route.query.client_id">
          <div class="headline">
            <div class="name">
              <b>{{ $store.state.client.name }}</b>
            </div>
          </div>

          <div class="input-line">
            <label class="label" for="select">Choose Product:</label>

            <select class="select" v-model="product_id" required id="select">
              <option
                v-for="product in productList"
                :key="product.id"
                :value="product.id"
              >
                {{ product.name }}
              </option>
            </select>
          </div>
        </div>

        <div class="input-section">
          <div class="input-line">
            <label class="label" for="price">Price:</label>
            <input
              class="input"
              type="number"
              min="0.00"
              step="0.01"
              placeholder="Price"
              v-model="price"
              required
              name="price"
            />
          </div>
          <div class="input-line">
            <label class="label" for="date">Date:</label>
            <input
              class="input"
              type="datetime-local"
              v-model="date"
              required
              name="date"
            />
          </div>
          <input type="submit" class="button" value="Give Product" />
        </div>
      </form>

      <ValidationErrors
        class="error-section"
        v-if="validationErrors"
        :errors="validationErrors"
      />
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import axios from "axios";

export default Vue.extend({
  name: "orderPage",

  data() {
    return {
      client_id: null,
      product_id: null,
      price: 0,
      date: null,
      productList: [],
      clientList: [],
      validationErrors: null,
    };
  },

  created() {
    if (this.$route.query.product_id) {
      this.product_id = this.$route.query.product_id;
      this.getClientList();
    } else if (this.$route.query.client_id) {
      this.client_id = this.$route.query.client_id;
      this.getProductList();
    }
  },

  methods: {
    async getProductList() {
      const payload = {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "Access-Control-Allow-Origin": "*",
        },
      };
      try {
        const res = await axios.get(
          this.$config.BACKEND_URI + "/products",
          payload
        );
        this.productList = res.data.data.filter(function (product) {
          return !product.reserved;
        });
      } catch (error) {
        this.validationErrors = error.response.data;
      }
    },

    async getClientList() {
      const payload = {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "Access-Control-Allow-Origin": "*",
        },
      };
      try {
        const res = await axios.get(
          this.$config.BACKEND_URI + "/clients",
          payload
        );

        this.clientList = res.data.data;
      } catch (error) {
        this.validationErrors = error.response.data;
      }
    },

    async onCreateOrder() {
      const payload = {
        client_id: this.client_id,
        product_id: this.product_id,
        price: this.price,
        date: this.date,
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "Access-Control-Allow-Origin": "*",
        },
      };
      try {
        const res = await axios.post(
          this.$config.BACKEND_URI + "/services",
          payload
        );

        this.$refs.formName.reset();

        this.$router.push("/orders");
      } catch (error) {
        console.log("Router Error:", error);
        this.validationErrors = error.response.data;
      }
    },
  },
});
</script>

<style scoped>
.error-section {
  padding: 20px;
}

.create-order {
  display: flex;
  flex-direction: row;
  padding: 20px;
  margin-right: 20px;
}

.create-order-section {
  display: flex;
  flex-direction: column;
  padding: 20px;
}

.headline {
  display: flex;
  flex-direction: row;
  padding: 20px;
}

.name {
  padding: 0 10px 0 10px;
}

.input-section {
  display: flex;
  flex-direction: column;
}

.input-line {
  display: flex;
  flex-direction: row;
  padding: 2px;
}

.input {
  border-radius: 10px;
  width: 200px;
  margin-top: 10px;
  margin-left: 20px;
  padding: 5px;
}

.select {
  border-radius: 10px;
  margin-top: 10px;
  margin-left: 20px;
  padding: 5px;
}

.label {
  width: 100px;
  margin-top: 10px;
  margin-left: 20px;
  padding: 5px;
}

.button {
  border-radius: 10px;
  width: 90px;
  margin-top: 10px;
  margin-left: 20px;
  padding: 5px;
  cursor: pointer;
}
</style>