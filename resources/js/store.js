import { isLoggedIn, logOut } from "./components/utils/auth";

export default {
    state: {
        keyword: "",
        isLogin: false,
        user: {}
    },
    mutations: {
        lastKeyword(state, payload) {
            state.keyword = payload;
        },
        setUser(state, payload) {
            state.user = payload;
        },
        setLoggedIn(state, payload) {
            state.isLogin = payload;
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
        },
        loadStoredState(context) {
            const lastKeyword = localStorage.getItem('lastKeyword');
            if (lastKeyword) {
                context.commit('lastKeyword', JSON.parse(lastKeyword));
            }

            context.commit("setLoggedIn", isLoggedIn());
        },
        async loadUser({ commit, dispatch }) {
            if (isLoggedIn) {
                try {
                    const user = (await axios.get("/user")).data;
                    //add user object to user state
                    commit("setUser", user);
                    //change login state to true
                    commit("setLoggedIn", true);
                } catch (error) {
                    dispatch("logoutUser");
                }
            }
        },
        logoutUser({ commit }) {
            //set user state to null object
            commit("setUser", {});
            //set login state to false
            commit("setLoggedIn", false);
            //set local storage to logout
            logOut();
        }
    }
}