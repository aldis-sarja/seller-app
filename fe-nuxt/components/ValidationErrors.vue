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
    // console.log("MOUNTED");
    if (this.errors.response.data.errors) {
      //   console.log("IF:01");
      const errorCollection = this.errors.response.data.errors;
      for (const key in errorCollection) {
        for (const errorIndex in errorCollection[key]) {
          this.listOfErrors.push(errorCollection[key][errorIndex]);
        }
      }
    } else if (this.errors.message) {
      // console.log("ELSE IF:01");
      this.listOfErrors = [this.errors.message];
    } else {
      console.log(this.errors);
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
