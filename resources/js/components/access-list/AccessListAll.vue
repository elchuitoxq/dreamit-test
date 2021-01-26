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
                    :items="accessList"
                    :search="search"
                >
                <template v-slot:top>
                    <v-toolbar flat>
                        <v-toolbar-title>Lista de Accesos</v-toolbar-title>
                    </v-toolbar>
                </template>
                </v-data-table>
            </v-col>
        </v-row>
    </v-col>
</template>
<script>
export default {
    name: "AccessListAll",
    data: () => ({
        search: "",
        headers: [
            { text: "Usuario", value: "user.name" },
            { text: "Edificio", value: "building.name" },
            { text: "Dirección", value: "building.address" },
            { text: "Acceso", value: "access.message" },
            { text: "Fecha", value: "created_at" },
        ],
    }),

    mounted() {
        this.$store.dispatch('getAccessListAll');
    },

    computed: {
        accessList: {
            get() {
                return this.$store.state.accessList.accessListAll;
            }
        }
    },
};
</script>
<style lang="scss" scoped>
</style>