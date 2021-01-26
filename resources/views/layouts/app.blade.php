<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DreamIT</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <v-app id="inspire">
            <v-app-bar app color="white" flat>
                <v-container class="py-0 fill-height">
    
                    <v-btn href="{{ url('/') }}" :key="link" text>
                        DreamIT
                    </v-btn>
    
                    <v-spacer></v-spacer>
                    <!-- Authentication Links -->
                    @guest
                        <v-btn href="{{ route('login') }}" :key="link" text>
                            Ingresar
                        </v-btn>
                        @if (Route::has('register'))
                            <v-btn href="{{ route('register') }}" :key="link" text>
                                Registar
                            </v-btn>
                        @endif
                    @else

                        <v-menu
                            left
                            bottom
                        >
                            <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                v-bind="attrs"
                                v-on="on"
                                text
                            >
                                {{ Auth::user()->name }}
                            </v-btn>
                            </template>
                    
                            <v-list>
                                <v-list-item href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    Cerrar Sesion

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    @endguest
                </v-container>
            </v-app-bar>


        
        
            <main class="py-4">
                @yield('content')
            </main>
        </v-app>
    </div>
</body>
</html>
