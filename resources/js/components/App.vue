<template>
    <v-main>
        <v-container>
            <v-row>
                <v-col cols="12" sm="12" md="3" >
                    <v-sheet rounded="lg">
                        <v-list color="transparent">
                            <v-list-item v-for="(elem, index) in menu" :key="index" :to="elem.route" link>
                                <v-list-item-content>
                                    <v-list-item-title>
                                        {{elem.title}}
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-sheet>
                </v-col>

                <v-col cols="12" sm="12" md="9">
                    <v-sheet rounded="lg">
                        <transition name="fade">
                            <router-view></router-view>
                        </transition>
                    </v-sheet>
                </v-col>
            </v-row>
        </v-container>
        <Snackbar/>
    </v-main>
</template>

<script>
import Snackbar from './snackbar/Snackbar';
export default {
    name: 'App',
    components:{
        Snackbar
    },
    computed:{
        user: {
            get() {
                return this.$store.state.users.user;
            }
        },
        menu() {
            if(this.user.role_id == 1){
                return [
                    {title: 'Home', route: '/home'},
                    {title: 'Usuarios', route: '/users'},
                    {title: 'Edificios', route: '/buildings'},
                    {title: 'Lista de Accesos', route: '/access-list'},
                    {title: 'Lista de Todos los Accesos', route: '/access-list-all'},
                    {title: 'Lista de Bloqueos', route: '/block-list'}
                ]
            } else if(this.user.role_id == 2) {
                return [
                    {title: 'Home', route: '/home'},
                    {title: 'Lista de Accesos', route: '/access-list'},
                ]
            } else {
                return [
                    {title: 'Home', route: '/home'}
                ]
            }
        }
    },
    mounted(){
        this.$store.dispatch('getAuth');
    },
};
</script>
<style lang="scss">
</style>