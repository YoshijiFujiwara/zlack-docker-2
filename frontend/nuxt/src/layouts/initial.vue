<template>
    <v-app>
        <v-toolbar
            :clipped-left="clipped"
            fixed
            app
        >
            <v-toolbar-title v-text="title"/>
            <v-spacer></v-spacer>

            <!-- ログインしてない -->
            <template v-if="!authenticated">
                <v-btn class="elevation-0">
                    <nuxt-link to="/login">ログイン</nuxt-link>
                </v-btn>

                <v-btn class="elevation-0">
                    <nuxt-link to="/register">登録</nuxt-link>
                </v-btn>
            </template>

            <!-- ログインしている -->
            <template v-if="authenticated">
                <v-btn class="elevation-0">
                    <a>{{Iam.name}}さん</a>
                </v-btn>
                <v-btn class="elevation-0">
                    <nuxt-link to="/workspaces">ワークスペース選択</nuxt-link>
                </v-btn>
                <v-btn class="elevation-0">
                    <nuxt-link to="/create_workspace">ワークスペース作成</nuxt-link>
                </v-btn>
                <v-btn class="elevation-0">
                    <a @click.prevent="logout">ログアウト</a>
                </v-btn>
            </template>
        </v-toolbar>
        <v-content>
            <v-container>
                <nuxt />
            </v-container>
        </v-content>

        <v-footer
            :fixed="fixed"
            app
        >
            <span>&copy; 2017</span>
        </v-footer>
    </v-app>
</template>

<script>
  // import {mapGetters} from 'vuex';

  export default {
    // global mixinにより不要になる
    // 参考のために一応残しておく
    // computed: {
    //   ...mapGetters({
    //     loggedIn: 'auth/authenticated'
    //   })
    // },
    data() {
      return {
        clipped: false,
        title: 'Zlack',
        fixed: false,
      }
    },
    methods: {
      logout() {
        this.$auth.logout(); // nuxt.config authに書いているから、一行で済む
      }
    }
  }
</script>
