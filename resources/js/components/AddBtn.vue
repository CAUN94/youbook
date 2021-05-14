<template>
	<div>
		<div class="form-group" v-for="(input,index) in inputs" :key="index" >
			<input type="text" name="indications[]" class="form-control">
			<span>
				<a href="" @click.prevent="add(index)" v-show="index== inputs.length-1" style="color: green;">Agregar Cuadro</a>

				<a href="" @click.prevent="remove(index)" v-show="index ||(!index &&inputs.length >1) ">Borrar Cuadro</a>
			</span>

		</div>
	</div>
</template>

<script type="text/javascript">
	export default{
		data(){
			return{
				inputs:[{}]
			}
		},
		methods:{
			add(){
				this.inputs.push({
					indication:''
				})
			},
			remove(index)
			{
				this.inputs.splice(index,1)
			}
		}

	}
</script>
