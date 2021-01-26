<template>
    <v-col cols="12">
        <v-row>
            <v-col cols="12">
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Buscar"
                    single-line
                    hide-details
                ></v-text-field>
                <v-data-table
                    :headers="headers"
                    :items="blockList"
                    sort-by="calories"
                    :search="search"
                >
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>Lista de Bloqueos</v-toolbar-title>
                            
                            <v-dialog v-model="dialogDelete" max-width="500px">
                                <v-card>
                                    <v-card-title class="headline">
                                        Lista de Bloqueo
                                    </v-card-title>
                                    <v-card-text>
                                        ¿Estas seguro que quieres eliminar al usuario <strong>{{editedItem.user.name}}</strong> de la Lista de Bloqueo?
                                    </v-card-text>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="closeDelete"
                                            >Cancelar</v-btn
                                        >
                                        <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="deleteItemConfirm"
                                            >Aceptar</v-btn
                                        >
                                        <v-spacer></v-spacer>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-toolbar>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-btn
                            icon
                            small
                            color="primary"
                            @click="deleteItem(item)"
                            >
                            <v-icon small >
                                mdi-delete
                            </v-icon>
                        </v-btn>
                    </template>
                </v-data-table>
            </v-col>
        </v-row>
    </v-col>
</template>
<script>
export default {
    name: "BlockList",
    data: () => ({
        search: "",
        dialogDelete: false,
        headers: [
            { text: "Nombre", value: "user.name" },
            { text: "Email", value: "user.email" },
            { text: "Codigo", value: "user.code_access"},
            { text: "Acciones", value: "actions", sortable: false }
        ],
        editedIndex: -1,
        editedItem: {
            user:{
                name:""
            }
        },
        defaultItem: {
            user:{
                name:""
            }
        },
        showPass: false
    }),

    mounted(){
        this.$store.dispatch('getBlockList');
    },

    computed: {
        blockList: {
            get() {
                return this.$store.state.blockList.blockList;
            }
        }
    },

    watch: {
        dialogDelete(val) {
            val || this.closeDelete();
        }
    },

    methods: {

        deleteItem(item) {
            this.editedIndex = this.blockList.indexOf(item);
            this.editedItem = Object.assign({}, item);
            console.log(this.editedItem);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.blockList.splice(this.editedIndex, 1);
            this.$store.dispatch('delBlockList',this.editedItem);
            this.closeDelete();
        },

        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
    }
};
</script>
<style lang="scss" scoped>
</style>