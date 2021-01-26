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
                    :items="users"
                    sort-by="calories"
                    :search="search"
                >
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>Usuarios</v-toolbar-title>
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
                                        Nuevo Usuario
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
                                                            editedItem.email
                                                        "
                                                        label="Email"
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <v-text-field
                                                        v-model="editedItem.role_id"
                                                        label="Rol"
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.code_access
                                                        "
                                                        label="Codigo"
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.password
                                                        "
                                                        :append-icon="showPass ? 'mdi-eye' : 'mdi-eye-off'"
                                                        :rules="[rulesPassword.required, rulesPassword.min]"
                                                        :type="showPass ? 'text' : 'password'"
                                                        name="input-10-2"
                                                        label="Contraseña"
                                                        class="input-group--focused"
                                                        @click:append="showPass = !showPass"
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
                                    <v-card-title class="headline">
                                        Eliminar Usuario
                                    </v-card-title>
                                    <v-card-text>
                                        ¿Estas seguro que quieres Eliminar al usuario <strong>{{editedItem.name}}</strong>?
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
                            <v-dialog v-model="dialogBlock" max-width="500px">
                                <v-card>
                                    <v-card-title class="headline">
                                        Bloquear Usuario
                                    </v-card-title>
                                    <v-card-text>
                                        ¿Estas seguro que quieres enviar a la Lista de Bloqueo al usuario <strong>{{editedItem.name}}</strong>?
                                    </v-card-text>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="closeBlock"
                                            >Cancelar</v-btn
                                        >
                                        <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="blockItemConfirm"
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
                            @click="editItem(item)"
                            >
                            <v-icon small >
                                mdi-pencil
                            </v-icon>
                        </v-btn>
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
                        <v-btn
                            icon
                            small
                            color="primary"
                            @click="blockItem(item)"
                            >
                            <v-icon small >
                                mdi-lock
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
    name: "Users",
    data: () => ({
        search: "",
        dialog: false,
        dialogDelete: false,
        dialogBlock: false,
        rulesPassword: {
          required: value => !!value || 'Campo requerido.',
          min: v => v.length >= 8 || 'Minimo 8 caracteres'
        },
        headers: [
            { text: "Nombre", value: "name" },
            { text: "Email", value: "email" },
            { text: "Role", value: "role.role" },
            { text: "Codigo", value: "code_access"},
            { text: "Acciones", value: "actions", sortable: false }
        ],
        editedIndex: -1,
        editedItem: {
            name: "",
            email: "",
            role_id: "",
            code_access: ""
        },
        defaultItem: {
            name: "",
            email: "",
            role_id: "",
            code_access: ""
        },
        showPass: false
    }),

    mounted(){
        this.$store.dispatch('getUsers');
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "Nuevo Usuario" : "Editar Usuario";
        },
        users: {
            get() {
                return this.$store.state.users.users;
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
            this.editedIndex = this.users.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.editedItem.password = '';
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.users.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.users.splice(this.editedIndex, 1);
            this.$store.dispatch('delUser',this.editedItem);
            this.closeDelete();
        },

        blockItem(item) {
            this.editedIndex = this.users.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogBlock = true;
        },
        blockItemConfirm() {
            this.$store.dispatch('addBlockList',this.editedItem)
            this.closeBlock();
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

        closeBlock() {
            this.dialogBlock = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        save() {
            console.log(this.editedItem);
            if (this.editedIndex > -1) {
                Object.assign(this.users[this.editedIndex], this.editedItem);
                this.$store.dispatch('editUser',this.editedItem)
                .then(() => {
                    this.close();
                }).catch((error) => {
                    console.log(error)
                });
            } else {
                this.$store.dispatch('addUser',this.editedItem)
                .then(() => {
                    this.close();
                }).catch((error) => {
                    console.log(error)
                });
                this.users.push(this.editedItem);
            }
        }
    }
};
</script>
<style lang="scss" scoped>
</style>
