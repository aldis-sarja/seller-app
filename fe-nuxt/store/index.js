export const state = () => ({
    product: "Hello Focked state!",
    client: "Hello focked client!"
});

export const getters = {
    getProduct(state) {
        return state.product;
    },
 
    getClient(state) {
        return state.client;
    }

}

export const mutations = {
    setProduct(state, product) {
        state.product = product;
    },

    setClient(state, client) {
        state.client = client;
    }
}
