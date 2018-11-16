<template>
    <v-layout
        column
        justify-center
        align-center>
        <v-form @submit.prevent="login">
            <v-card>
                <v-card-title primary-title>
                    <h2 class="display-1 mb-3 font-weight-bold">ログイン</h2>
                    <v-flex xs12>
                        <v-text-field
                            v-model.trim="form.email"
                            label="メールアドレス"
                            autofocus
                            prepend-icon="email"
                        ></v-text-field>
                        <span v-if="errors.email" class="red--text">{{errors.email[0]}}</span>
                    </v-flex>

                    <v-flex xs12>
                        <v-text-field
                            v-model.trim="form.password"
                            label="パスワード"
                            prepend-icon="security"
                            type="password"
                        ></v-text-field>
                        <span v-if="errors.password" class="red--text">{{errors.password[0]}}</span>
                    </v-flex>

                    <v-btn
                        block
                        color="success"
                        dark
                        type="submit"
                    >ログイン</v-btn>
                </v-card-title>

                <v-card-actions>
                    <p>
                        アカウントをお持ちではないですか？
                        <nuxt-link to="/register">ここから登録</nuxt-link>
                    </p>
                </v-card-actions>
            </v-card>
        </v-form>
    </v-layout>
</template>

<script>
  export default {
    // middleware: ['guest'],
    layout: 'initial',
    data() {
      return {
        form: {
          email: '',
          password: ''
        }
      }
    },
    methods: {
      async login() {
        // 便利すぎる
        await this.$auth.loginWith('local', {
          data: this.form
        });

        // このページまたはホームページに
        this.$router.push({
          path: this.$route.query.redirect || '/workspaces'
        });
      }
    }
  }
</script>

<style>

</style>