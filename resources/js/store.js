export default {
    state: {
        keyword: "",
    },
    mutations: {
        lastKeyword(state, payload) {
            state.keyword = payload;
        }
    },
    actions: {
        setLastKeyword(context, payload) {
            context.commit('lastKeyword', payload);
            localStorage.setItem('lastKeyword', JSON.stringify(payload));
        },
        getLastKeyword(context) {
            const lastKeyword = localStorage.getItem('lastKeyword');
            if (lastKeyword) {
                context.commit('lastKeyword', JSON.parse(lastKeyword));
            }
        }
    }
}