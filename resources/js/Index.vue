<template>
    <div class="container w-75 ">
        <nav class="navbar navbar-light bg-white border mb-3">
            <div class="container">
                <router-link class="navbar-brand mr-auto" :to="{name:'home'}">home</router-link>
                
                <div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <router-link class="nav-link" aria-current="page" :to="{name:'about'}">about</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <router-view></router-view>
    </div>
</template>