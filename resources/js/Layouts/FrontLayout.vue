<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavTop from '@/Components/Navigation/NavTop.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div>

        <header>
            <NavTop />
        </header>

        <main class="px-3 pt-100">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <slot />
                    </div>            
                </div>

            </div>
        </main>

      <footer>
        
      </footer>

    </div>
</template>
