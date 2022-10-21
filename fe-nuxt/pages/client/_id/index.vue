<template>
  <div>
    <NavBar />
    <div class="frame">
      <div class="headline">
        <div class="name">
          <b>{{ client.name }}</b>
        </div>
        <div class="address">
          {{ client.type }}
        </div>
      </div>
      <div class="description">
        {{ client.description }}
      </div>
      <div class="order-section" v-if="client.service">
        <ul>
          <li v-for="service in client.service" v-bind:key="service">
            <nuxt-link :to="'/product/' + service.product.id">
              <em>{{ service.product.name }}</em>
            </nuxt-link>
            sold for €{{ (service.price / 100).toFixed(2) }}
          </li>
        </ul>
      </div>
      <nuxt-link :to="'/order?client_id=' + client.id">
        Add Product to Client
      </nuxt-link>

      <button type="button" class="button" v-on:click="onToggleEdit">
        Edit Client
      </button>

      <button type="button" class="button-delete" v-on:click="deleteClient">
        REMOVE CLIENT
      </button>

      <dir v-if="toggleEdit">
        <div class="edit-client">
          <form
            class="edit-client-section"
            ref="formName"
            @submit.prevent="onEditClient"
          >
            <div class="input-section">
              <input
                class="input"
                type="text"
                v-model="clientNewName"
                placeholder="Client Name"
                required
              />
              <input
                class="input"
                type="text"
                v-model="clientNewAddress"
                placeholder="Client Adress"
                required
              />
              <textarea
                class="input"
                v-model="clientNewDescription"
                placeholder="Client Description"
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
  name: "ClientPage",

  data() {
    return {
      client: [],
      clientNewName: null,
      clientNewAdress: null,
      clientNewDescription: null,
      validationErrors: null,
      toggleEdit: false,
    };
  },

  created() {
    this.getClient();
  },

  methods: {
    async getClient() {
      const payload = {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "Access-Control-Allow-Origin": "*",
        },
      };

      try {
        const res = await axios.get(
          this.$config.BACKEND_URI + "/clients/" + this.$route.params.id,
          payload
        );
        this.client = res.data.data;
        this.clientNewName = this.client.name;
        this.clientNewAddress = this.client.address;
        this.clientNewDescription = this.client.description;

        this.$store.commit("setClient", res.data.data);
      } catch (error) {
        this.validationErrors = error.response.data;
        console.log("TERRIBLE ERROR:", error);
      }
    },

    async onEditClient() {
      this.validationErrors = null;
      const payload = {
        name: this.clientNewName,
        address: this.clientNewAddress,
        description: this.clientNewDescription,
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "Access-Control-Allow-Origin": "*",
        },
      };

      try {
        const res = await axios.put(
          this.$config.BACKEND_URI + "/clients/" + this.$route.params.id,
          payload
        );
        this.client = res.data.data;
        this.$refs.formName.reset();
      } catch (error) {
        this.validationErrors = error.response.data;
      }
    },

    onToggleEdit() {
      this.toggleEdit = !this.toggleEdit;
    },

    async deleteClient() {
      const payload = {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "Access-Control-Allow-Origin": "*",
        },
      };

      try {
        const res = await axios.delete(
          this.$config.BACKEND_URI + "/clients/" + this.$route.params.id,
          payload
        );

        this.$router.push("/clients");
      } catch (error) {
        alert("Can't delete!");
      }
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

.error-section {
  padding: 20px;
}

.edit-client {
  display: flex;
  flex-direction: row;
  padding: 5px;
  margin-right: 20px;
}

.edit-client-section {
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
  width: 400px;
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

.button-delete {
  border-radius: 10px;
  width: 130px;
  margin-top: 10px;
  margin-left: 20px;
  padding: 5px;
  cursor: pointer;
  background: lightblue;
  color: red;
}
</style>