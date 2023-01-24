<template>
    <div class="container w-75 ">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <router-link class="nav-link link-dark" aria-current="page" :to="{name:'home'}">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link link-dark" aria-current="page" :to="{name:'about'}">About</router-link>
                    </li>
                </ul>
        </header>

        <router-view></router-view>
    </div>
</template>