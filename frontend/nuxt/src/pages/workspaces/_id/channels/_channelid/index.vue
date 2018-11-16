<template>
    <div>
        <v-layout
                column
                justify-center
                align-center>
            <!--<v-flex xs12>-->
            <!--<pre>-->
            <!--{{channel}}-->
            <!--</pre>-->
            <!--</v-flex>-->
            <v-jumbotron>
                <v-container fill-height>
                    <v-layout align-center>
                        <v-flex>
                            <h3 class="display-3">#{{channel.name}}</h3>

                            <span class="subheading">Lorem ipsum dolor sit amet, pri veniam forensibus id. Vis maluisset molestiae id, ad semper lobortis cum. At impetus detraxit incorrupte usu, repudiare assueverit ex eum, ne nam essent vocent admodum.</span>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-jumbotron>

            <pre>
                {{ channel.massage }}
            </pre>

            <v-container style="margin-bottom: 100px;">
                <v-layout
                column
                wrap
                >
                    <v-flex
                    style="margin-top: 30px;"
                    v-for="(message, index) in channel.messages"
                    >
                        <!-- アクションボタン集 -->
                        <span v-if="message.id == hoveredMessageId" class="action-buttons">
                            <v-btn-toggle>
                                <v-tooltip top>
                                    <v-btn slot="activator" flat>
                                    <v-icon>feedback</v-icon>
                                    </v-btn>
                                    <span>リアクションする</span>
                                </v-tooltip>
                                <v-tooltip top>
                                    <v-btn slot="activator" flat>
                                    <v-icon>chat</v-icon>
                                    </v-btn>
                                    <span>スレッドを開始する</span>
                                </v-tooltip>
                                <v-tooltip top>
                                    <v-btn slot="activator" flat>
                                    <v-icon>arrow_forward</v-icon>
                                    </v-btn>
                                    <span>メッセージを共有する</span>
                                </v-tooltip>
                                <v-tooltip top>
                                    <v-btn slot="activator" flat>
                                        <v-icon>star_border</v-icon>
                                    </v-btn>
                                    <span>メッセージにスターを付ける</span>
                                </v-tooltip>
                                <v-menu offset-y>
                                    <v-btn
                                    slot="activator"
                                    icon
                                    >
                                        <v-icon>more_horiz</v-icon>
                                    </v-btn>
                                    <v-list>
                                        <v-list-tile v-if="message.user.id == Iam.id">
                                          <v-list-tile-title @click.prevent="editMessge(message)"><v-icon>edit</v-icon> メッセージを編集する</v-list-tile-title>
                                        </v-list-tile>
                                        <!-- todo: とりあえず、自分のメッセージだけ削除できるようにしておく -->
                                        <v-list-tile v-if="message.user.id == Iam.id">
                                           <v-list-tile-title @click.prevent="openDeleteDialog(message)"><v-icon>delete_forever</v-icon> メッセージを削除する</v-list-tile-title>
                                        </v-list-tile>
                                    </v-list>
                                </v-menu>
                            </v-btn-toggle>
                        </span>

                        <v-layout row wrap @mouseover="showActionButton(message.id)">
                            <!-- 左側部分 -->
                            <v-flex style="width: 5%;">
                                <v-icon>accessibility_new</v-icon>
                            </v-flex>

                            <!-- 右側部分 -->
                            <v-flex style="width: 95%;">
                                <v-layout column wrap>
                                    <v-flex>
                                        <span class="font-weight-bold title">{{message.user.name}}</span>
                                        <small class="grey--text lighten-1">{{message.created_at}}</small>
                                    </v-flex>

                                    <!-- 編集対象ではないとき -->
                                    <v-flex
                                    v-if="tryEditMessage.id != message.id"
                                    style="width: 100%; overflow-wrap: break-word;">
                                        {{message.body}}
                                    </v-flex>

                                    <!-- 編集するとき -->
                                    <v-flex
                                    v-else
                                    style="width: 100%; overflow-wrap: break-word;">
                                        <v-form @submit.prevent="updateMessage">
                                            <v-textarea
                                            v-model="editForm.messageBody"
                                            outline
                                            name="input-7-4"
                                            ></v-textarea>
                                            <div style="margin-top: -20px;">
                                                <v-btn @click="closeEditArea">キャンセル</v-btn>
                                                <v-btn type="submit" class="success"><v-icon>subdirectory_arrow_left</v-icon>変更を保存する</v-btn>
                                            </div>
                                        </v-form>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-container>

            <!-- 削除モーダル -->
            <v-dialog
                v-model="deleteDialog"
                max-width="290"
            >
                <v-card>
                    <v-card-title class="headline">メッセージを削除する</v-card-title>

                    <v-card-text>
                        このメッセージを本当に削除しますか？削除後は元に戻すことはできません。
                    </v-card-text>

                    <v-card-text>
                        {{tryDeleteMessage.body}}
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn
                            color="green darken-1"
                            flat="flat"
                            @click="deleteDialog = false, tryDeleteMessage = {}"
                        >
                            キャンセル
                        </v-btn>

                        <v-btn
                            color="red darken-1"
                            flat="flat"
                            @click="deleteMessage(tryDeleteMessage.id)"
                        >
                            削除
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
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
        channel: [],
        form: {
          messageBody: ''
        },
        hoveredMessageId: '', // マウスオーバーされているメッセージのid
        showOtherActionMenuId: '', // 表示するその他のアクションメニューの親メッセージid

        deleteDialog: false,

        // 編集対象のメッセージ
        tryEditMessage: '',

        // 削除しようとしているメッセージ
        tryDeleteMessage: {},

        editForm: {
          messageBody: ''
        }

      }
    },
    async asyncData({$axios, params}) {
      let {data} = await $axios.$get(`/workspaces/${params.id}/channels/${params.channelid}`);
      return {
        channel: data
      }
    },
    methods: {
      async createMessage() {
        await this.$axios.$post(`/workspaces/${this.$route.params.id}/channels/${this.$route.params.channelid}/messages`, {body: this.form.messageBody});
        this.form.messageBody = '';
      },

      // ホバーしているときのみアクションボタングループを表示する
      showActionButton(messageId) {
        this.hoveredMessageId = messageId;
      },

      // 削除ダイアログを表示する
      openDeleteDialog(message) {
        this.deleteDialog = true;
        this.tryDeleteMessage = message;
      },

      // 編集用のメッセージの用意
      editMessge(message) {
        this.tryEditMessage = message;
        this.editForm.messageBody = message.body;
      },

      // 編集を中断する
      closeEditArea() {
        this.tryEditMessage = {};
      },

      // 編集内容を保存する
      async updateMessage() {
        await this.$axios.$patch(`/workspaces/${this.$route.params.id}/channels/${this.$route.params.channelid}/messages/${this.tryEditMessage.id}`,
          {body: this.editForm.messageBody});

        // 成功したら編集テキストエリアを閉じる
        this.tryEditMessage = {};

        // 編集内容をリアルタイムで対象メッセージに反映する
      },

      // メッセージを削除する
      async deleteMessage(messageId) {
        console.log(this.tryDeleteMessage);
        await this.$axios.$delete(`/workspaces/${this.$route.params.id}/channels/${this.$route.params.channelid}/messages/${messageId}`);
      },

      // メッセージにスターを付ける
      // async starAction(messageId) {
      //   await this.$axios.$post(`/workspaces/${this.$route.params.id}/channels/${this.$route.params.channelid}/messages/${messageId}/change_star`);
      // }
    },
    // mountedは必ずクライアント側で呼ばれるので、if(process.browser)が不要になる
    // 参考：https://qiita.com/hareku/items/ea09602bf40bf0a42040
    mounted() {
      // サーバーサイドレンダリング時は、windowオブジェクトがないので、エラーが出る
      // やったね！

      // メッセージ新規作成イベントを受け取る
      window.Echo.channel('createMessageChannel').listen('CreateMessageEvent', (e) => {
        // メッセージの末尾に追加
        this.channel.messages.push(e.message);
      });

      // todo: 綺麗に書き直す
        window.Echo.channel('updateMessageChannel').listen('UpdateMessageEvent', (e) => {
          let obj = this.channel.messages;
          Object.keys(obj).forEach(function(key) {
            if (obj[key].id == e.message.id) {
              obj[key].body = e.message.body;
            }
s          });
          this.channel.messages = obj;
        });

      // todo: 綺麗に書き直す
      window.Echo.channel('deleteMessageChannel').listen('UpdateMessageEvent', (e) => {
        let obj = this.channel.messages;
        Object.keys(obj).forEach(function(key) {
          if (obj[key].id == e.message.id) {
            obj[key] = null;
          }
        });
        this.channel.messages = obj;
      });

      // star
      // window.Echo.channel('starMessageChannel').listen('StarMessageEvent', (e) => {
      //   alert('star!');
      // });
    }
  }
</script>

<style scoped>
    .v-footer {
        background-color: rgba(0, 0, 0, 0);
    }

    #message-post-field {
        background-color: white;
    }

    .message-wrapper {
        position: relative;
    }

    .action-buttons {
        position: absolute;
        right: 0;
        z-index: 1000;
    }

</style>