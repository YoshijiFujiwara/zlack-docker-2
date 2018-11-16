
export const getters = {
  authenticated(state) {
    return state.loggedIn;
  },

  Iam(state) {
    return state.user;
  },
}