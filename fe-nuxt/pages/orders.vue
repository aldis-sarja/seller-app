<template>
  <div>
    <NavBar />
    <div class="frame">
      <div class="order-list">
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Client</th>
              <th>Product</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="order-item"
              v-for="order in orderList"
              v-bind:key="order"
            >
              <th>
                {{ order.date }}
              </th>
              <th>
                <nuxt-link :to="'/client/' + order.client.id">
                  {{ order.client.name }}
                </nuxt-link>
              </th>
              <th>
                <nuxt-link :to="'/product/' + order.product.id">
                  {{ order.product.name }}
                </nuxt-link>
              </th>
              <th class="order-price">
                {{ (order.price / 100).toFixed(2) }}
              </th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import axios from "axios";

export default Vue.extend({
  name: "OrdersPage",

  data() {
    return {
      orderList: [],
    };
  },

  created() {
    this.getOrders();
  },

  methods: {
    async getOrders() {
      const payload = {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "Access-Control-Allow-Origin": "*",
        },
      };
      try {
        const res = await axios.get(
          this.$config.BACKEND_URI + "/services",
          payload
        );
        this.orderList = res.data.data;
        console.log("ORDERLIST:", res.data.data);
      } catch (error) {
        this.validationErrors = error.response.data;
      }
    },
  },
});
</script>

<style scoped>
.frame {
  margin-top: 30px;
}

.error-section {
  padding: 20px;
}

.order-list {
  padding: 20px;
}

th {
  padding: 7px 32px 0 0;
  /* padding: 7px 4px 0 4px; */
  text-align: left;
}
.order-item:hover {
  background: lightgray;
}
</style>
