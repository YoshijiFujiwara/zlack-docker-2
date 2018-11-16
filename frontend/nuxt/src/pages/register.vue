<template>
    <v-layout
            column
            justify-center
            align-center>
        <v-form @submit.prevent="register">
            <v-card>
                <v-card-title primary-title>
                    <h2 class="display-1 mb-3 font-weight-bold">アカウント作成</h2>

                    <v-flex xs12>
                        <v-text-field
                            v-model.trim="form.name"
                            label="ユーザーネーム"
                            autofocus
                            prepend-icon="create"
                        ></v-text-field>
                        <span v-if="errors.name" class="red--text">{{errors.name[0]}}</span>
                    </v-flex>

                    <v-flex xs12>
                        <v-text-field
                            v-model.trim="form.email"
                            label="メールアドレス"
                            prepend-icon="email"
                        ></v-text-field>
                        <span v-if="errors.email" class="red--text">{{errors.email[0]}}</span>
                    </v-flex>

                    <v-flex xs12>
                        <v-text-field
                            v-model.trim="form.password"
                            label="パスワード"
                            type="password"
                            prepend-icon="security"
                        ></v-text-field>
                        <span v-if="errors.password" class="red--text">{{errors.password[0]}}</span>
                    </v-flex>

                    <v-btn
                            block
                            color="success"
                            dark
                            type="submit"
                    >登録</v-btn>
                </v-card-title>

                <v-card-actions>
                    <p>
                        アカウントをお持ちですか？
                        <nuxt-link to="/login">ここからログイン</nuxt-link>
                    </p>
                </v-card-actions>
            </v-card>
        </v-form>
    </v-layout>
</template>

<script>
  export default {
    middleware: ['guest'],
    layout: 'initial',
    data() {
      return {
        form: {
          name: '',
          email: '',
          password: ''
        }
      }
    },
    methods: {
      async register() {
        await this.$axios.$post('register', this.form);
        await this.$auth.loginWith('local', {
          data: {
            email: this.form.email,
            password: this.form.password
          }
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