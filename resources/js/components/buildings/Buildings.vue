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
                    :items="buildings"
                    sort-by="calories"
                    :search="search"
                >
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>Edificios</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-dialog v-model="dialog" max-width="500px">
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                        color="primary"
                                        dark
                                        class="mb-2"
                                        v-bind="attrs"
                                        v-on="on"
                                    >
                                        Nuevo Edificio
                                    </v-btn>
                                </template>
                                <v-card>
                                    <v-card-title>
                                        <span class="headline">{{
                                            formTitle
                                        }}</span>
                                    </v-card-title>

                                    <v-card-text>
                                        <v-container>
                                            <v-row>
                                                <input type="hidden" v-model="editedItem.id"/>
                                                <v-col cols="12" sm="6">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.name
                                                        "
                                                        label="Nombre"
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.address
                                                        "
                                                        label="Dirección"
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                    </v-card-text>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="close"
                                        >
                                            Cancelar
                                        </v-btn>
                                        <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="save"
                                        >
                                            Guardar
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                            <v-dialog v-model="dialogDelete" max-width="500px">
                                <v-card>
                                    <v-card-title class="headline"
                                        >Eliminar Edificio</v-card-title
                                    >
                                    <v-card-text>
                                        ¿Estas seguro que quieres eliminar el edificio <strong>{{editedItem.name}}</strong>?
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
                            >
                            <v-icon small @click="editItem(item)">
                                mdi-pencil
                            </v-icon>
                        </v-btn>
                        <v-btn
                            icon
                            small
                            color="primary"
                            >
                            <v-icon small @click="deleteItem(item)">
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
    name: "Buildings",
    data: () => ({
        search: "",
        dialog: false,
        dialogDelete: false,
        headers: [
            { text: "Nombre", value: "name" },
            { text: "Dirección", value: "address" },
            { text: "Acciones", value: "actions", sortable: false }
        ],
        editedIndex: -1,
        editedItem: {
            name: "",
            address: ""
        },
        defaultItem: {
            name: "",
            address: ""
        },
        showPass: false
    }),

    mounted(){
        this.$store.dispatch('getBuildings');
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "Nuevo Edificio" : "Editar Edificio";
        },
        buildings: {
            get() {
                return this.$store.state.buildings.buildings;
            }
        }
    },

    watch: {
        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        }
    },

    methods: {

        editItem(item) {
            this.editedIndex = this.buildings.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.editedItem.password = '';
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.buildings.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.buildings.splice(this.editedIndex, 1);
            this.$store.dispatch('delBuilding',this.editedItem)
            this.closeDelete();
        },

        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        save() {
            console.log(this.editedItem);
            if (this.editedIndex > -1) {
                Object.assign(this.buildings[this.editedIndex], this.editedItem);
                this.$store.dispatch('editBuilding',this.editedItem)
                .then(() => {
                    this.close();
                });
            } else {
                this.$store.dispatch('addBuilding',this.editedItem)
                .then(() => {
                    this.close();
                }).catch((error) => {
                    console.log(error)
                });
                this.buildings.push(this.editedItem);
            }
        }
    }
};
</script>
<style lang="scss" scoped>
</style>