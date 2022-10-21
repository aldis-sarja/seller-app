<template>
  <div>
    <div class="nav-bar">
      <div class="side-links">
        <nuxt-link class="menu-item" :to="'/'">Products</nuxt-link>
        <nuxt-link class="menu-item" :to="'/clients'">Clients</nuxt-link>
        <nuxt-link class="menu-item" :to="'/orders'">Orders</nuxt-link>
      </div>
    </div>
  </div>
</template>

<style scoped>
.nav-bar {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  padding: 2px 2px 20px 2px;
  width: 100%;
  background-color: burlywood;
  position: fixed;
  top: 0;
  left: 0;
}

.side-links {
  display: flex;
  flex-direction: row;
}

.menu-item {
  padding: 0 20px;
}
</style>