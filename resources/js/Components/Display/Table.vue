<script setup>
	import { computed, reactive, watch, ref } from 'vue';
	import { Link, useForm } from '@inertiajs/vue3';
	import { sort } from 'fast-sort';

	const props = defineProps({
	  items: {
	    type: Array,
	    required: true,
	  },	
	  fields: {
	    type: Array,
	    required: true,
	  },
	  search: {
	  	type: String,
	  	value: ''
	  }
	});

	defineEmits(['update:search']);

	const pagination = reactive({
	  currentPage: 1,
	  perPage: 5,
	  totalPages: computed(() =>
	    Math.ceil(props.items.length / pagination.perPage)
	  ),
	});

	const sortBy = ref(null);
	const sortDesc = ref(null);

	const sortedItems = computed(() => {
	  const { items } = props;
	  if (sortDesc.value === null) return items;

	  if (sortDesc.value) {
	    return sort(items).desc(sortBy.value);
	  } else {
	    return sort(items).asc(sortBy.value);
	  }
	});

	const setSort = (key) => {
	  if (sortBy.value === key) {
	    if (sortDesc.value === true) sortDesc.value = null;
	    else if (sortDesc.value === false) sortDesc.value = true;
	    else sortDesc.value = false;
	  } else {
	    sortBy.value = key;
	    sortDesc.value = false;
	  }
	};

	const paginatedItems = computed(() => {
	  const { currentPage, perPage } = pagination;
	  const start = (currentPage - 1) * perPage;
	  const stop = start + perPage;

	  return sortedItems.value.slice(start, stop);
	});

	watch(
	  () => pagination.totalPages,
	  () => (pagination.currentPage = 1)
	);

	const formDelete = useForm({});

	const destroy = (routing, id) => {
	    if (confirm("Are you sure you want to Delete")) {
	        formDelete.delete(route(routing, id), {
	        	preserveScroll: true
	        });
	    }
	};	

	const formApprove = useForm({
		'approved': 1
	});

	const approve = (routing, id) => {
	    if (confirm("Are you sure you want to Update")) {
	        formApprove.patch(route(routing, id), {
	        	preserveScroll: true
	        });
	    }
	};

	const formEdit = useForm({});

	const edit = (routing, id) => {
        formEdit.get(route(routing, id), {
        	preserveScroll: true
        });	    
	};	
</script>
<template>
	<div class="row pb-3">
		<div class="col">
			<input 
				id="search" 
				type="text" 
				class="form-control form-control-sm" 
				@input="$emit('update:search', $event.target.value)"
				placeholder="Search" />
		</div>
		<div class="col">
			<div class="float-end">
				{{props.items.length}} items
				<button type="button" class="btn btn-outline-secondary btn-sm"
				  :disabled="pagination.currentPage <= 1"
				  @click="pagination.currentPage--"
				>
				  <i class="bi bi-caret-left-fill"></i>
				</button>
				{{ pagination.currentPage }} of {{ pagination.totalPages }}
				<button type="button" class="btn btn-outline-secondary btn-sm"
				  :disabled="pagination.currentPage >= pagination.totalPages"
				  @click="pagination.currentPage++"
				>
				  <i class="bi bi-caret-right-fill"></i>
				</button>
			</div>		
		</div>
	</div>

    <table class="table table-sm table-striped table-hover">
	    <thead class="bg-white">
	      <tr>
	        <template v-for="{ key, label, sortable } in fields" :key="key">
	          <th v-if="sortable" @click="setSort(key)" class="pointer">
	            {{ label }}
	            <template v-if="sortBy === key">
	              <span v-if="sortDesc === true">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
					  <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"></path>
					</svg>	              	
	              </span>
	              <span v-else-if="sortDesc === false">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
					<path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"></path>
					</svg>
				  </span>
	            </template>
	          </th>
	          <th v-else>
	            {{ label }}
	          </th>
	        </template>
	      </tr>
	    </thead>
	    <tbody>
	      <tr v-for="item in paginatedItems" :key="item.id">
	        <td v-for="{ key, action, routing, badge } in fields" :key="key">        	
				<slot :name="`cell(${key})`" :value="item[key]" :item="item">
					<template v-if="action">
						<button v-if="key === 'delete'" type="button" class="btn btn-outline-danger btn-sm" @click="destroy(routing, item.id)">
							<i class="bi bi-trash"></i>
						</button>
						<button v-if="key === 'approve' && item['approved'] === 0" type="button" class="btn btn-outline-success btn-sm" @click="approve(routing, item.id)">
							<i class="bi bi-check-lg"></i>
						</button>
						<button v-if="key === 'edit'" type="button" class="btn btn-outline-success btn-sm" @click="edit(routing, item.id)">
							<i class="bi bi-pencil"></i>
						</button>						
					</template>		
					<template v-else-if="badge">
						<span class="badge text-center" :class="badge">{{ item[key] }}</span>
					</template>	
					<template v-else>
						<span v-if="key === 'user_id'">{{ item.author.name }}</span>
						<span v-else-if="key === 'categories'">
							<span v-for="(category, index) in item.categories" :key="category.id">
								<Link :href="route('category.show', category.slug)">{{category.name}}</Link>
								<span v-if="index != (item.categories.length - 1)">, </span>
							</span>
						</span>
						<span v-else-if="key === 'tags'">
							<span v-for="(tag, index) in item.tags" :key="tag.id">
								<Link :href="route('tag.show', tag.slug)">{{tag.name}}</Link>
								<span v-if="index != (item.tags.length - 1)">, </span>
							</span>
						</span>						
						<span v-else-if="key === 'post_id'">{{ item.post.title }}</span>
						<span v-else-if="key === 'created_at'">{{ $filters.mmmddyyyy(item.created_at) }}</span>
						<span v-else>{{ item[key] }}</span>
					</template>
				</slot>
	        </td>
	      </tr>
	    </tbody> 
    </table>	
</template>