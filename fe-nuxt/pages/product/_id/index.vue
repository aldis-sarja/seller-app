<template>
  <div>
    <NavBar />

    <div class="frame">
      <div class="headline">
        <div class="name">
          <b>{{ product.name }}</b>
        </div>
        <div class="type">
          {{ product.type }}
        </div>
        <div v-if="product.reserved" class="client">
          has taken by
          <nuxt-link :to="'/client/' + product.service.client.id">
            <em>{{ product.service.client.name }}</em>
          </nuxt-link>
        </div>
      </div>
      <div class="description">
        {{ product.description }}
      </div>
      <nuxt-link
        v-if="!product.reserved"
        :to="'/order?product_id=' + product.id"
      >
        Add Product to Client
      </nuxt-link>

      <button type="button" class="button" v-on:click="onToggleEdit">
        Edit Product
      </button>

      <dir v-if="toggleEdit">
        <div class="edit-product">
          <form
            class="edit-product-section"
            ref="formName"
            @submit.prevent="onEditProduct"
          >
            <div class="input-section">
              <input
                class="input"
                type="text"
                v-model="productNewName"
                placeholder="Product Name"
                required
              />
              <input
                class="input"
                type="text"
                v-model="productNewType"
                placeholder="Product Type"
                required
              />
              <textarea
                class="input"
                v-model="productNewDescription"
                placeholder="Product Description"
                required
              >
              </textarea>
            </div>
            <input class="button" type="submit" value="Change" />
          </form>

          <ValidationErrors
            class="error-section"
            v-if="validationErrors"
            :errors="validationErrors"
          />
        </div>
      </dir>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import axios from "axios";

export default Vue.extend({
  name: "ProductPage",

  data() {
    return {
      product: [],
      productNewName: null,
      productNewType: null,
      productNewDescription: null,
      validationErrors: null,
      toggleEdit: false,
    };
  },

  created() {
    this.getProduct();
  },

  methods: {
    async getProduct() {
      const payload = {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "Access-Control-Allow-Origin": "*",
        },
      };

      try {
        const res = await axios.get(
          this.$config.BACKEND_URI + "/products/" + this.$route.params.id,
          payload
        );
        this.product = res.data.data;
        this.productNewName = this.product.name;
        this.productNewType = this.product.type;
        this.productNewDescription = this.product.description;

        this.$store.commit("setProduct", res.data.data);
      } catch (error) {
        this.validationErrors = error.response.data;
        console.log("TERRIBLE ERROR:", error);
      }
    },

    async onEditProduct() {
      this.validationErrors = null;
      const payload = {
        name: this.productNewName,
        type: this.productNewType,
        description: this.productNewDescription,
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "Access-Control-Allow-Origin": "*",
        },
      };

      try {
        const res = await axios.put(
          this.$config.BACKEND_URI + "/products/" + this.$route.params.id,
          payload
        );
        this.product = res.data.data;
        this.$refs.formName.reset();
      } catch (error) {
        this.validationErrors = error.response.data;
      }
    },

    onToggleEdit() {
      this.toggleEdit = !this.toggleEdit;
    },
  },
});
</script>

<style scoped>
.frame {
  margin-top: 30px;
}

.headline {
  display: flex;
  flex-direction: row;
  padding: 20px;
}

.name {
  padding: 0 10px 0 10px;
}

.description {
  padding: 0 10px 0 20px;
}

.client {
  margin-left: 25px;
}

.error-section {
  padding: 20px;
}

.edit-product {
  display: flex;
  flex-direction: row;
  padding: 5px;
  margin-right: 20px;
}

.edit-product-section {
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
</style>