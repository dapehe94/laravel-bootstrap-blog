<script setup>
	import { Link } from '@inertiajs/vue3';
</script>
<template>
  
	<div class="position-sticky pt-5">
	    <ul class="nav flex-column mb-auto">
	      <li class="nav-item nav-link">
	      	<i class="bi bi-speedometer2"></i>
	        <Link :href="route('dashboard')">
	            Dashboard
	        </Link>
	      </li>

	      <li class="nav-item nav-link">
	         <Link :href="route('post.index')">
	          <i class="bi bi-pin-angle"></i>
	          Posts
	        </Link>
	      </li>

	      <li class="nav-item nav-link">
	        <Link :href="route('category.create')">
	          <i class="bi bi-archive"></i>
	          Categories
	        </Link>
	      </li>

	      <li class="nav-item nav-link">
	        <Link :href="route('tag.create')">
	          <i class="bi bi-tags"></i>
	          Tags
	        </Link>
	      </li>

	      <li class="nav-item nav-link">
	        <Link :href="route('comment.index')">
	          <i class="bi bi-chat-square-text"></i>
	          Comments
	        </Link>
	      </li>

	      <li class="nav-item nav-link">
	        <Link :href="route('user.index')">
	          <i class="bi bi-people"></i>
	          Users
	        </Link>
	      </li>

	    </ul>

	    <hr />

	    <ul class="nav flex-column mb-auto">

	      <li class="nav-item nav-link">
	        <Link :href="route('profile.edit')">
	          <i class="bi bi-person"></i>
	          Profile
	        </Link>
	      </li>

	      <li class="nav-item nav-link">
            <Link :href="route('logout')" method="post">
				<i class="bi bi-box-arrow-right"></i> Logout
			</Link>
	      </li>

	  	</ul>

	</div>

</template>