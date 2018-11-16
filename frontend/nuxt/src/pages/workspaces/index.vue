<template>
    <v-layout
        column
        justify-center
        align-center>

        <v-card>
            <v-card-title>
                <h3 class="headline font-weight-bold">参加中のワークスペース</h3>
            </v-card-title>
            <v-list
                v-for="(workspace, index) in workspaces"
                :key="index">
                <v-list-tile
                    @click.prevent="moveWorkspace(workspace.id)"
                >
                    <v-list-tile-action>
                        <v-icon color="success">group_work</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content xs6>
                        <v-list-tile-title v-text="workspace.name"></v-list-tile-title>
                    </v-list-tile-content>

                    <v-list-tile-action>
                        <v-icon>arrow_forward_ios</v-icon>
                    </v-list-tile-action>
                </v-list-tile>
                <v-divider></v-divider>
            </v-list>
        </v-card>
        <!--<v-card-actions>-->
            <!--<div class="text-xs-center">-->
                <!--<v-btn-toggle>-->
                    <!--<v-btn-->
                        <!--flat-->
                        <!--v-for="(key, value) in links"-->
                        <!--class="page-link"-->
                        <!--@click.prevent="loadMore(key)">-->
                        <!--{{value}}-->
                    <!--</v-btn>-->
                <!--</v-btn-toggle>-->
            <!--</div>-->
        <!--</v-card-actions>-->
    </v-layout>
</template>

<script>
  /**
   * todo
   * linksがひつようになったら、コメントアウトを外す
   */
  export default {
    middleware: ['auth'],
    layout: 'initial',
    data() {
      return {
        workspaces: [],
        // links: [],
      }
    },
    async asyncData({ $axios }) {
      let { data } = await $axios.$get('/workspaces');
      // let { data, links } = await $axios.$get('/workspaces');
      return {
        workspaces: data,
        // links
      }
    },
    methods: {
      moveWorkspace(workspaceId) {
        this.$router.push(`/workspaces/${workspaceId}`);
      },
      // async loadMore(key) {
      //   let {data} = await this.$axios.$get(key);
      //   // この書き方理解できていない
      //   return this.workspaces = {...this.workspaces, ...data}
      // },
    },
    computed: {
      // lastPage() {
      //   // linksのラストページのpage=?の数字を取得する
      //   return Number(this.links.last.match(/\?page=(\d)/)[1]);
      // }
    }
  }
</script>

<style scoped>

</style>