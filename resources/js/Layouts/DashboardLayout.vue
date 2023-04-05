<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import DashboardSidebar from '@/Components/DashboardSidebar.vue';
import NavTop from '@/Components/Navigation/NavTop.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div>

        <header>
            <NavTop />
        </header>

        <main class="pt-5">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-2 bg-white border-end">
                        <DashboardSidebar />
                    </div>

                    <div class="col-10 ps-4">
                        <slot />
                    </div>

                </div>

            </div>
        </main>

      <footer>
        
      </footer>

    </div>
</template>