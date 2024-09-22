import VueRouter from "vue-router";

import Map from "./pages/Map/Map.vue";
import Docs from "./pages/Docs/Docs.vue";
import User from "./pages/User/User.vue";
import Tree from "./pages/Tree/Tree.vue";
import Login from "./pages/Auth/Login.vue";
import Signup from "./pages/Auth/Signup.vue";
import Strata from "./pages/Strata/Strata.vue";
import Reports from "./pages/Reports/Reports.vue";
import TreeVisit from "./pages/Tree/TreeVisit.vue";
import Overview from "./pages/Blocks/Overview.vue";
import EditBlock from "./pages/Blocks/EditBlock.vue";
import ListBlocks from "./pages/Blocks/ListBlocks.vue";
import DataImport from "./pages/DataImport/DataImport.vue";
import Properties from "./pages/Properties/Properties.vue";
import ForgotPassword from "./pages/Auth/ForgotPassword.vue";
import ChangePassword from "./pages/User/ChangePassword.vue";
import ResetPasswordForm from "./pages/Auth/ResetPasswordForm";
import AddProperties from "./pages/Properties/AddProperties.vue";
import SamplingPoint from "./pages/SamplingPoint/SamplingPoint.vue";
import SharedProperties from "./pages/Properties/SharedProperties.vue";
import AddOperationalUnit from "./pages/Strata/AddOperationalUnit.vue";
import HomogeneousArea from "./pages/HomogeneousArea/HomogeneousArea.vue";
import HomogeneousAreaPractice from "./pages/HomogeneousArea/HomogeneousAreaPractice.vue";

const router = new VueRouter({
	mode: "history",
	base: process.env.BASE_URL,
	routes: [
		{
			path: "/login",
			component: Login,
		},
		{
			path: "/signup",
			component: Signup,
		},
		{
			path: "/reset",
			name: "reset-password",
			component: ForgotPassword,
		},
		{
			path: "/reset/:token",
			name: "reset-password-form",
			component: ResetPasswordForm,
		},
		{
			path: "/panel",
			name: "map",
			component: Map,
			beforeEnter: (to, from, next) => {
				if (window.Roles[0].label === "pre-registered") {
					next({ name: "properties" });
				} else {
					next();
				}
			},
		},
		{
			path: "/panel/homogeneous-area",
			component: HomogeneousArea,
			name: 'homogeneous-area',
		},
		{
			path: "/panel/homogeneous-area-practice",
			component: HomogeneousAreaPractice,
		},
		{
			path: "/panel/strata",
			component: Strata,
			name: 'strata',
		},
		{
			path: "/panel/blocks",
			component: ListBlocks,
		},
		{
			path: "/panel/add-operational-unit",
			component: AddOperationalUnit,
		},
		{
			path: "/panel/edit-block",
			component: EditBlock,
		},
		{
			path: "/panel/properties",
			component: Properties,
			name: "properties",
		},
		{
			path: "/panel/properties/shared",
			component: SharedProperties,
			name: "shared-properties",
		},
		{
			path: "/panel/overview",
			component: Overview,
			name: "overview",
		},
		{
			path: "/panel/add-property",
			component: AddProperties,
		},
		{
			path: "/panel/users",
			component: User,
			name: 'users',
		},
		{
			path: "/panel/sampling-points",
			component: SamplingPoint,
			name: 'sampling-point',
		},
		{
			path: "/panel/trees",
			component: Tree,
			name: 'trees',
		},
		{
			path: "/panel/tree-visits",
			component: TreeVisit,
			name: 'tree-visit',
		},
		{
			path: "/panel/reports",
			component: Reports,
			name: 'reports',
		},
		{
			path: "/panel/docs",
			component: Docs,
			name: 'docs',
		},
		{
			path: "/panel/data-import",
			component: DataImport,
		},
		{
			path: "/panel/change-password",
			component: ChangePassword,
		},
		
	],
});

export default router;
