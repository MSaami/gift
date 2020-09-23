<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <router-link :to="{name: 'code-index'}" class="nav-link" href="#">لیست کدها</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link :to="{name: 'winner-index'}" class="nav-link" href="#">جستجوی برنده‌ها</router-link>
                    </li>
                </ul>
            </div>
        </nav> 
    </div>
</template>
