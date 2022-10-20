<template>
  <div>
    <NavBar />

    <div class="add-product">
      <form
        class="add-product-section"
        ref="formName"
        @submit.prevent="onAddProduct"
      >
        <div class="input-section">
          <input
            class="input"
            type="text"
            v-model="newProductName"
            placeholder="Product Name"
            required
          />
          <input
            class="input"
            type="text"
            v-model="newProductType"
            placeholder="Product Type"
            required
          />
          <textarea
            class="input"
            v-model="newProductDescription"
            placeholder="Product Description"
            required
          >
          </textarea>
        </div>
        <input class="button" type="submit" value="Add Product" />
      </form>

      <ValidationErrors
        class="error-section"
        v-if="validationErrors"
        :errors="validationErrors"
      />
    </div>

    <div class="product-list">
      <table>
        <thead>
          <tr>
            <th>Aviable</th>
            <th>Name</th>
            <th>Type</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="product-item"
            v-for="product in productList"
            v-bind:key="product"
          >
            <th>
              <img
                width="16px"
                height="16px"
                v-if="!product.reserved"
                src="~/assets/images/check.svg"
              />
              <span v-else class="red-bull">&bull;</span>
            </th>
            <th>
              <nuxt-link :to="'/product/' + product.id">
                {{ product.name }}
              </nuxt-link>
            </th>
            <th>
              <nuxt-link :to="'/product/' + product.id">
                {{ product.type }}
              </nuxt-link>
            </th>
            <th class="description">
              <nuxt-link :to="'/product/' + product.id">
                {{ product.description }}
              </nuxt-link>
            </th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import axios from "axios";
import ValidationErrors from "@/components/ValidationErrors";

export default Vue.extend({
  components: { ValidationErrors },

  name: "IndexPage",

  data() {
    return {
      productList: [],
      newProductName: null,
      newProductType: null,
      newProductDescription: null,

      validationErrors: null,
    };
  },

  created() {
    this.fetchProducts();
  },

  methods: {
    async fetchProducts() {
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
        this.productList = res.data.data;
      } catch (error) {
        console.log("TERRIBLE ERROR:", error);
      }
    },

    async onAddProduct() {
      this.validationErrors = null;
      const payload = {
        name: this.newProductName,
        type: this.newProductType,
        description: this.newProductDescription,
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "Access-Control-Allow-Origin": "*",
        },
      };

      try {
        const res = await axios.post(
          this.$config.BACKEND_URI + "/products",
          payload
        );
        this.productList.push(res.data.data);
        this.$refs.formName.reset();
        // this.fetchProducts();
      } catch (error) {
        this.validationErrors = error;
      }
    },
  },
});
</script>

<style scoped>
.error-section {
  padding: 20px;
}

.add-product {
  display: flex;
  flex-direction: row;
  padding: 20px;
  margin-right: 20px;
}

.add-product-section {
  display: flex;
  flex-direction: column;
  padding: 20px;
}

.input-section {
  display: flex;
  flex-direction: column;
}

.input {
  border-radius: 10px;
  width: 300px;
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

.product-list {
  padding: 20px;
}

th {
  padding: 7px 32px 0 0;
  /* padding: 7px 4px 0 4px; */
  text-align: left;
}
.product-item:hover {
  background: lightgray;
}

.description {
  word-wrap: normal;
}

.red-bull {
  color: red;
}
</style>