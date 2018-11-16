<template>
    <v-layout
        column
        justify-center
        align-center>
        <v-form @submit.prevent="create">
            <v-card>
                <v-card-title primary-title>
                    <h2 class="display-1 mb-3 font-weight-bold">ワークスペースを作成</h2>
                    <v-flex xs12>
                        <v-text-field
                            v-model.trim="form.name"
                            label="ワークスペース名"
                            autofocus
                            prepend-icon="group_work"
                        ></v-text-field>
                        <span v-if="errors.name" class="red--text">{{errors.name[0]}}</span>
                    </v-flex>

                    <v-btn
                        block
                        color="success"
                        dark
                        type="submit"
                    >作成</v-btn>
                </v-card-title>
            </v-card>
        </v-form>
    </v-layout>
</template>

<script>
  export default {
    middleware: ['auth'],
    layout: 'initial',
    data() {
      return {
        form: {
          name: ''
        }
      }
    },
    methods: {
      async create() {
        await this.$axios.$post('/workspaces', this.form);
        this.$router.push('/create_workspace');
      }
    }
  }
</script>

<style>

</style>