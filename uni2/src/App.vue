<template>
    <div id="app">
        <router-view/>
        <Navbar />
    </div>
</template>
<script>
import Navbar from './components/Navbar.vue'

export default {
    components:{
        Navbar
    }
}
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

:root{
    --primary: #4f3bc0;
}

#app {
  font-family: 'Montserrat', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2b2b2b;
  padding: 1rem;
  padding-bottom: 85px;
  min-height: 100vh;
  background: #f6f6f6;
}

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  scroll-behavior: smooth;
}

ul{
    list-style: none;
}

a{
    text-decoration: none;
    color: inherit;
}
</style>
