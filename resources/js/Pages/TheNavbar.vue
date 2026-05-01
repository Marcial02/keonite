<script setup>
import { RiSearch2Line } from '@remixicon/vue'
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <nav class="nav-bar">

        <div class="nav-div left">

            <Link href="/home">
                <img class="keonite-logo" src="/keoniteLogo.svg" alt="Keonite Logo" >
            </Link>

            <div class="search-container">
                <RiSearch2Line class="search-icon" />
                <input type="text" placeholder="Search..."
                class="focus:outline-none focus:ring-0 focus:shadow-none">
            </div>

        </div>

        <div class="nav-div center">

            <Link href="/comics">Comics</Link>
            <div class="line"></div>
            <Link href="/novels">Novels</Link>
            <div class="line"></div>
            <Link href="/animations">Animations</Link>
        </div>

        <div class="nav-div right">
            <Link href="/create">Create</Link>
            <Link href="/login">Log in</Link>
            <Link href="/register">Sign up</Link>
        </div>


    </nav>
</template>
<style>
    .nav-bar{
        display: flex;
        justify-content: space-between;
        position: sticky;
        background-color: #222;
        padding: 0 30px;

    }
    .nav-div{
        display: flex;
        gap: 10px;
        flex: 1;
       align-items: center;

    }
    .left  {
        justify-content: flex-start;
    }
    .center{
        justify-content: center;
    }
    .right{
        justify-content: flex-end;
    }
    a{
         color: white;
         text-decoration: none;
         padding: 10px;

    }
    .line{
        height: 60%;
        width: 1px;
        background-color: white;
    }
   .search-container{
    background-color: white;
    padding: 2px;
    display: flex;
    align-items: center;
    border-radius: 5px;
    width: 200px;
   }
   .search-container input{
    border: none;
    width: 100%;
   }
   .search-icon{
    color: #555;
   }
   .keonite-logo{
    width: 100px;
    height: 50px;
    object-fit: cover ;
    background-position: center;
   }


</style>
