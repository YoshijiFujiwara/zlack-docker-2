/**
 * どこでもつかうようなメソッドなどを登録しとくとよい
 * nuxt.config のpluginに追加を忘れないように
 */

import Vue from 'vue';
import { mapGetters } from 'vuex';

const User = {
  install(Vue, options) {
    Vue.mixin({
      computed: {
        ...mapGetters({
          Iam: 'auth/Iam',
          authenticated: 'auth/authenticated'
        })
      }
    })
  }
}

Vue.use(User);