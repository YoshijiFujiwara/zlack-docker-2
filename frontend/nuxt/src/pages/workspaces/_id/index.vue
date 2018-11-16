<template>
    <v-layout
        column
        justify-center
        align-center>
        ワークスペース
    </v-layout>
</template>

<script>
  export default {
    middleware: ['auth'], // ログインしてなければ、ログインページにリダイレクト
    data() {
      return {

      }
    },
    // async created() {
    //   // let {data} = await this.$axios.$get(`/workspaces/${this.$route.params.id}`);
    //   // // とりあえず、最初に作成されたchannelに移動する
    //   // this.$router.push(`/workspaces/${data.id}/channels/${data.channels[0].id}`);
    // }
  }
</script>
