<template>
	<div>
		<NcModal
				v-if="showModal"
				@close="closeModal"
				title="Sample Modal"
				:outTransition="true"
		>
			<div class="modal__content">Hello world</div>
		</NcModal>
	</div>
</template>

<script lang="ts">
import Vue from 'vue'
import { NcModal } from '@nextcloud/vue'

export default Vue.extend({
	name: 'SampleView',
	components: {
		NcModal,
	},
	data() {
		return {
			showModal: true
		}
	},
	methods: {
		closeModal() {
			this.showModal = false
		}
	}
})
</script>

<style scoped>
.modal__content {
	margin: 50px;
	text-align: center;
}
</style>
