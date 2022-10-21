<template>
  <div>
    <NavBar />
    <div class="frame">
      <div class="add-client">
        <form
          class="add-client-section"
          ref="formName"
          @submit.prevent="onAddClient"
        >
          <div class="input-section">
            <input
              class="input"
              type="text"
              v-model="newClientName"
              placeholder="Client Name"
              required
            />
            <input
              class="input"
              type="text"
              v-model="newClientAddress"
              placeholder="Client Address"
              required
            />
            <textarea
              class="input"
              v-model="newClientDescription"
              placeholder="Client Description"
              required
            >
            </textarea>
          </div>
          <input class="button" type="submit" value="Add Client" />
        </form>

        <ValidationErrors
          class="error-section"
          v-if="validationErrors"
          :errors="validationErrors"
        />
      </div>

      <div class="client-list">
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Adress</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="product-item"
              v-for="client in clientList"
              v-bind:key="client"
            >
              <th>
                <nuxt-link :to="'/client/' + client.id">
                  {{ client.name }}
                </nuxt-link>
              </th>
              <th>
                <nuxt-link :to="'/client/' + client.id">
                  {{ client.address }}
                </nuxt-link>
              </th>
              <th class="description">
                <nuxt-link :to="'/client/' + client.id">
                  {{ client.description }}
                </nuxt-link>
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
  name: "ClientsPage",

  data() {
    return {
      clientList: [],
      newClientName: null,
      newClienAddress: null,
      newClientDescription: null,

      validationErrors: null,
    };
  },

  created() {
    this.getClients();
  },

  methods: {
    async getClients() {
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

    async onAddClient() {
      this.validationErrors = null;
      const payload = {
        name: this.newClientName,
        address: this.newClientAddress,
        description: this.newClientDescription,
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "Access-Control-Allow-Origin": "*",
        },
      };

      try {
        const res = await axios.post(
          this.$config.BACKEND_URI + "/clients",
          payload
        );
        this.clientList.push(res.data.data);
        this.$refs.formName.reset();
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

.add-client {
  display: flex;
  flex-direction: row;
  padding: 20px;
  margin-right: 20px;
}

.add-client-section {
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

.client-list {
  padding: 20px;
}

th {
  padding: 7px 32px 0 0;
  /* padding: 7px 4px 0 4px; */
  text-align: left;
}
.client-item:hover {
  background: lightgray;
}

.description {
  word-wrap: normal;
}
</style>