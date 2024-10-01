<template>
	<div v-if="loading" class="loader-overlay">
		<div class="loader"></div>
		<span class="text"></span>
	</div>
</template>

<script>
export default {
	props: {
		loading: {
			type: Boolean,
			required: true
		}
	}
};
</script>
