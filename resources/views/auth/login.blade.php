@extends('layouts.app')

@section('content')
<v-main>
    <v-container>
        <v-row justify="center">
            <v-col
              cols="12"
              sm="10"
              md="8"
              lg="6"
            >
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <v-card ref="form">
                        <v-card-title>Ingresar</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text>
                            <v-text-field
                                ref="email"
                                v-model="email"
                                name="email"
                                :rules="[() => !!email || 'Este campo es requerido']"
                                :error-messages="errorMessages"
                                label="Correo Electronico"
                                placeholder="example@example.com"
                                required
                                outlined
                                clearable
                                @error('email') error @enderror
                            ></v-text-field>
                            <v-text-field
                                ref="password"
                                v-model="password"
                                name="password"
                                type="password"
                                :rules="[() => !!password || 'Este campo es requerido']"
                                :error-messages="errorMessages"
                                label="Contraseña"
                                placeholder="**********"
                                required
                                outlined
                                clearable
                                @error('password') error @enderror
                            ></v-text-field>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="primary"
                                text
                                type="submit"
                            >
                                Ingresar
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </form>
            </v-col>
        </v-row>
    </v-container>
</v-main>
@endsection
