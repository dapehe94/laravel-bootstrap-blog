<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="container-fluid h-100">

    <div class="row h-100">

      <div class="col-lg-5 bg-primary bg-gradient d-flex justify-content-center align-items-center">
          
          <div class="container">
            <div class="row text-center">
              <ApplicationLogo />
            </div>

            <div class="row text-center">
              <h1>A brief description of what the website is about.</h1>  
            </div>            
          </div>          

      </div>

      <div class="col-lg-7 px-5">

        <slot />

      </div>   
               
    </div>
    
  </div>
</template>