@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <v-app id="app">
        <router-view></router-view>
    </v-app>
</div>
@endsection