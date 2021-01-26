<template>
  <v-snackbar
        v-model="snackbar.showing"
        :timeout="snackbar.timeout"
        :color="snackbar.color"
        top
        right
        >
        {{snackbar.text}}
        <template v-slot:action="{ attrs }">
            <v-btn
                small
                text
                @click="snackbar.showing = false"
                >
                <v-icon small>
                    mdi-close
                </v-icon>
            </v-btn>
        </template>
    </v-snackbar>
</template>

<script>
export default {
  data () {
    return {
      show: false,
      message: ''
    }
  },
  computed:{
      snackbar:{
          get(){
              return this.$store.state.snackbar.snackbar
          }
      }
  }
}
</script>