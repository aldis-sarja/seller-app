<template>
  <div class="error-section">
    <div
      class="error-messages"
      v-for="message in listOfErrors"
      v-bind:key="message"
    >
      {{ message }}
    </div>
  </div>
</template>

<script>
export default {
  name: "ValidationErrors",
  props: ["errors"],

  data() {
    return {
      listOfErrors: [],
    };
  },

  mounted() {
    if (this.errors.errors) {
      for (const key in this.errors.errors) {
        for (const errorIndex in this.errors.errors[key]) {
          this.listOfErrors.push(this.errors.errors[key][errorIndex]);
        }
      }
    } else if (this.errors.message) {
      this.listOfErrors = [this.errors.message];
    }
  },
};
</script>

<style scoped>
.error-messages {
  color: red;
  margin-top: 10px;
}
</style>
