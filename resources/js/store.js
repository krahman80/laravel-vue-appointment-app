export default {
    state: {
        keyword: "",
    },
    mutations: {
        lastSearch(state, payload) {
            state.keyword = payload;
        }
    }
}