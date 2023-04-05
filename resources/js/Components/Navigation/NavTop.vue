<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';	
</script>
<template>
	<nav class="navbar navbar-expand-lg border-bottom bg-white fixed-top shadow-sm white-navbar px-3">
	    <div class="container-fluid">
	    
	        <div class="mb-0 pe-5">
	            <ApplicationLogo />
	        </div>

	        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	          <span class="navbar-toggler-icon"></span>
	        </button>

	        <div class="collapse navbar-collapse flex-grow-1">

				<ul class="navbar-nav ms-auto flex-nowrap text-end">

				    <li class="nav-item">
				        <a class="nav-link" aria-current="page" href="#search">
				            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" role="img" class="color-grey">
				                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.6002 12.0498C9.49758 12.8568 8.13777 13.3333 6.66667 13.3333C2.98477 13.3333 0 10.3486 0 6.66667C0 2.98477 2.98477 0 6.66667 0C10.3486 0 13.3333 2.98477 13.3333 6.66667C13.3333 8.15637 12.8447 9.53194 12.019 10.6419C12.0265 10.6489 12.0338 10.656 12.0411 10.6633L15.2935 13.9157C15.6841 14.3063 15.6841 14.9394 15.2935 15.33C14.903 15.7205 14.2699 15.7205 13.8793 15.33L10.6269 12.0775C10.6178 12.0684 10.6089 12.0592 10.6002 12.0498ZM11.3333 6.66667C11.3333 9.244 9.244 11.3333 6.66667 11.3333C4.08934 11.3333 2 9.244 2 6.66667C2 4.08934 4.08934 2 6.66667 2C9.244 2 11.3333 4.08934 11.3333 6.66667Z"></path>
				            </svg>     
				        </a>        
				    </li>

			        <li class="nav-item ps-3" v-if="!$page.props.auth.user">
			            <Link			                
			                :href="route('login')"
			                class="nav-link"
			                >Sign in</Link
			            >				            
			        </li>

			        <li class="nav-item ps-3" v-if="!$page.props.auth.user">
			            <Link			                
			                :href="route('register')"
			                class="btn btn-primary"
			                >Sign up</Link
			            >					            
			        </li>

					<li class="nav-item ps-3" v-if="$page.props.auth.user">
			            <Link			                
			                :href="route('dashboard')"
			                class="nav-link"
			                >Dashboard</Link
			            >
			        </li>

					<li class="nav-item ps-3" v-if="$page.props.auth.user">

			            <Link			                
			                :href="route('logout')"
			                method="post"			                
			                class="nav-link pointer"
			                as="link"
			                >Logout</Link
			            >
			        </li>

				</ul>
	        
	        </div>

	    </div>
	</nav>	
</template>