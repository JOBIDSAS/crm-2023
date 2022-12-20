<template>
	<div class="d-flex flex-row">
		<cropper ref="cropper" style="height: 400px; width:400px"
			class="preview-result-example__cropper"
			:src="image.src"
			:debounce="false"
			:stencil-props="{aspectRatio: 1,}"
			stencil-component="circle-stencil"
			@change="onChange"/>
			<input style="display:none" type="file" ref="file" @change="loadImage($event)" accept="image/*">
	</div>
</template>

<script>
import { CircleStencil, Cropper, Preview } from 'vue-advanced-cropper';
import 'vue-advanced-cropper/dist/style.css';
import requester from "../modules/requester";
export default {
	components: {
		Cropper, CircleStencil,Preview 
	},

	data() {
		return {
			image: {
				src: null,
				type: null
			},
			result: {
				coordinates: null,
				image: null
			}
		};
	},

	mounted:function(){
		this.$bus.$on("image/upload", ()=>{
			this.$refs.file.click()
		})
		this.$bus.$on("image/save", ()=>{
			this.crop()
		})
	},

	methods: {

		crop() {
			const { canvas } = this.$refs.cropper.getResult();
			canvas.toBlob((blob) => {
				var reader = new FileReader();
				reader.readAsDataURL(blob); 
				reader.onloadend = function() {
					var base64data = reader.result;
					requester.saveImage(JSON.stringify({avatar:base64data}))
					.then(r=>console.log(r.data))
					.catch(e=>console.log(e));
				}
			}, this.image.type);
		},

		onChange({ coordinates, canvas, image }) {
			this.result = {
				coordinates,
				image,
			};
		},

		loadImage(event) {
			const { files } = event.target;
			if (files && files[0]) {
				if (this.image.src) {
					URL.revokeObjectURL(this.image.src)
				}
				const blob = URL.createObjectURL(files[0]);
				const reader = new FileReader();
				reader.onload = () => {
					this.image = {
						src: blob,
						type: files[0].type,
					};
				};
				reader.readAsArrayBuffer(files[0]);
			}
		},
	},

	destroyed() {
		if (this.image.src) {
			URL.revokeObjectURL(this.image.src)
		}
	}
};
</script>