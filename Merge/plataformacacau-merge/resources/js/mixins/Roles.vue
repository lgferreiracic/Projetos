<script>
export default {
	methods: {
		$can(roleName) {
			return (
				Roles.map(function(role) {
					return role.label;
				}).indexOf(roleName) !== -1
			);
		}
	}
};
</script>
