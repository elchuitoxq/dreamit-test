<template>
    <v-col cols="12">
        <v-row justify="center">
            <v-col cols="4">
                <v-img 
                lazy-src="https://picsum.photos/id/11/10/6"
                max-height="auto"
                max-width="250"
                src="/img/logo.png"/>  
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="6">
                <v-form
                    ref="formEntry"
                    v-model="validEntry"
                    lazy-validation
                    @submit.prevent="entryForm"
                >
                    <v-card>
                        <v-card-title>Entrada</v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12" class="pb-0">
                                    <v-select
                                        v-model="entry.building"
                                        :items="buildings"
                                        item-text="name"
                                        item-value="id"
                                        :rules="rules"
                                        label="Edificios"
                                        outlined
                                        dense
                                        required
                                    ></v-select>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" class="pb-0">
                                    <v-text-field
                                        v-model="entry.code"
                                        label="Codigo de Entrada"
                                        :rules="rules"
                                        outlined
                                        dense
                                        required
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-card-text>
                        <v-card-actions>
                                <v-col cols="12">
                                    <v-btn
                                        block
                                        color="primary"
                                        :disabled="!validEntry"
                                        @click="validateEntry"
                                        type="submit"
                                    >Ingresar Entrada</v-btn>
                                </v-col>
                        </v-card-actions>
                    </v-card>
                </v-form>
            </v-col>
            <v-col cols="12" md="6">
                <v-form
                    ref="formExit"
                    v-model="validExit"
                    lazy-validation
                    @submit.prevent="exitForm"
                >
                    <v-card>
                        <v-card-title>Salida</v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12" class="pb-0">
                                    <v-select
                                        v-model="exit.building"
                                        :items="buildings"
                                        item-text="name"
                                        item-value="id"
                                        :rules="rules"
                                        label="Edificios"
                                        outlined
                                        dense
                                        required
                                    ></v-select>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" class="pb-0">
                                    <v-text-field
                                        v-model="exit.code"
                                        label="Codigo de Salida"
                                        :rules="rules"
                                        outlined
                                        dense
                                        required
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-card-text>
                        <v-card-actions>
                                <v-col cols="12">
                                    <v-btn
                                        block
                                        color="primary"
                                        :disabled="!validExit"
                                        @click="validateExit"
                                        type="submit"
                                    >Ingresar Salida</v-btn>
                                </v-col>
                        </v-card-actions>
                    </v-card>
                </v-form>
            </v-col>
        </v-row>
    </v-col>
</template>
<script>

export default {
    name:'AccessControl',
    data() {
        return {
            validEntry: false,
            validExit: false,
            rules: [v => !!v || 'El campo es requerido'],
            entry:{
                building:0,
                code:""
            },
            exit:{
                building:0,
                code:""
            }
        }
    },
    computed: {
        buildings: {
            get() {
                return this.$store.state.buildings.buildings;
            }
        }
    },
    methods: {
        validateEntry () {
            this.$refs.formEntry.validate()
        },
        validateExit () {
            this.$refs.formExit.validate()
        },
        entryForm(){
            console.log('Ingreso');
            this.$store.dispatch('addEntry', this.entry);
        },
        exitForm(){
            console.log('Salida');
            this.$store.dispatch('addExit', this.exit);
        }
    },
    mounted() {
        this.$store.dispatch('getBuildings');
    }
}
</script>