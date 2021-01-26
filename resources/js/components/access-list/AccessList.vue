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
    name: "AccessList",
    data: () => ({
        search: "",
        headers: [
            { text: "Edificio", value: "building.name" },
            { text: "Dirección", value: "building.address" },
            { text: "Acceso", value: "access.message" },
            { text: "Fecha", value: "created_at" },
        ],
    }),

    mounted() {
        this.$store.dispatch('getAccessList');
    },

    computed: {
        accessList: {
            get() {
                return this.$store.state.accessList.accessList;
            }
        }
    },
};
</script>
<style lang="scss" scoped>
</style>