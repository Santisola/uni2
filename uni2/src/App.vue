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
    --perdida: #E5446D;
    --encontrada: #44BBA4;
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

.btn{
    font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
    border-radius: 4px;
    font-size: 18px;
    transition: all 250ms ease;
    padding: .5rem;
}

.btn-secondary{
    color: var(--primary);
    border: none;
    background: none;
    font-weight: bold;
}

.btn-primary{
    border: solid 1px var(--primary);
    background: var(--primary);
    font-weight: normal;
    color: #fff;
}

.btn-disabled{
    background: #ccc;
    color: #e6e6e6;
    pointer-events: none;
}

.form-group > input,
.form-group > div > input,
.form-group > label,
.form-group > select,
.form-group > textarea{
    display: block;
    width: 100%;
    padding: 1rem .5rem;
    font-size: 14px;
}

.form-group > input,
.form-group > select,
.form-group > textarea{
    border: solid 1px #cecece;
    border-radius: 4px;
}

.form-group > label{
    padding-left: 0;
    margin-top: .5rem;
}

.form-group > textarea{
    resize: none;
    margin-top: .75rem;
    font-family: 'Montserrat', Helvetica, Arial, sans-serif;
    font-size: 18px;
}
</style>
