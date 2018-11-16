<template>
    <div>
        <v-layout
                column
                justify-center
                align-center>
            <!--<v-flex xs12>-->
                <!--<pre>-->
                    <!--{{messages}}-->
                <!--</pre>-->
            <!--</v-flex>-->

            <v-jumbotron height="auto" style="margin-bottom: 100px;">
                <v-list three-line>
                    <template v-for="(message, index) in messages">
                        <v-list-tile
                            :key="message.id"
                            avatar
                            @click=""
                        >
                            <v-list-tile-avatar>
                                <v-icon>accessibility_new</v-icon>
                            </v-list-tile-avatar>

                            <v-list-tile-content>
                                <v-list-tile-title class="subheading"><span class="font-weight-bold">{{message.user.name}}</span>  <small class="grey--text lighten-1">{{message.created_at}}</small></v-list-tile-title>
                                <p class="black--text">{{message.body}}</p>
                            </v-list-tile-content>
                        </v-list-tile>
                    </template>
                </v-list>
            </v-jumbotron>
        </v-layout>
        <v-footer
                fixed
                height="auto"
        >
            <v-layout
                    justify-end
                    row
                    wrap
            >
                <v-flex xs9 offset-xs-3 id="message-post-field">
                    <v-form @submit.prevent="createMessage">
                        <v-layout row wrap justify-end align-center>
                            <v-flex xs10>
                                <v-textarea
                                        v-model="form.messageBody"
                                        outline
                                        name="input-7-4"
                                        auto-grow
                                        rows="1"
                                ></v-textarea>
                            </v-flex>
                            <v-flex xs2>
                                <v-btn type="submit" color="success">送信</v-btn>
                            </v-flex>
                        </v-layout>
                    </v-form>
                </v-flex>
            </v-layout>
        </v-footer>
    </div>
</template>

<script>
  export default {
    middleware: ['auth'], // ログインしてなければ、ログインページにリダイレクト
    data() {
      return {
        messages: [],
        form: {
          messageBody: ''
        }
      }
    },
    async asyncData({ $axios, params }) {
      let { data } = await $axios.$get(`/workspaces/${params.id}/users/${params.userid}/messages`);
      return {
        messages: data
      }
    },
    methods: {
      async createMessage() {
        await this.$axios.$post(`/workspaces/${this.$route.params.id}/users/${this.$route.params.userid}/messages`, {body: this.form.messageBody});
        this.form.messageBody = '';
      }
    }
  }
</script>

<style scoped>
    .v-footer {
        background-color: rgba(0,0,0,0);
    }

    #message-post-field {
        background-color: white;
    }
</style>