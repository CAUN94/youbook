<template>
	<div>
		<div class="card">
			<div class="card-header">Encuentra a tu profesional</div>
			<div class="card-body">
				<datepicker class="my-datepicker" calendar-class="my-datepicker_calendar"  :format="customDate" v-model="time" :inline=true :disabledDates="disabledDates"></datepicker>
			</div>
		</div>

		<div class="card">
			<div class="card-header">Profesionales</div>
			<div class="card-body">
				<table class="table table-stiped">
					<thead>
						<tr>
							<th>#</th>
							<th>Foto</th>
							<th>Nombre</th>
							<th>Área</th>
							<th>Agendar</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(d,index) in professionals" v-if="!loading">
								<td scope="row">{{index+1}}</td>
								<td>
									<img class="thumb1" width="60" height="60" :src="'/img/professionals/'+ d.professional.image" >
								</td>
								<td>{{d.professional.name}}</td>
								<td>{{d.professional.department}}</td>
								<td>
									<a :href="'/new-appoinment/'+ d.user_id+'/'+d.date "><button class="btn btn-success">Agendar</button></a>
								</td>
							</tr>
							<td v-if="professionals.length==0">Sin profesionales disponiible para el {{this.time}}</td>
					</tbody>
				</table>
				<div class="text-center">
					<!-- <pulse-loader :loading="loading" :color="loadcolor" :size="size"></pulse-loader> -->
				</div>
			</div>
		</div>
	</div>

</template>

<script type="text/javascript">
	import datepicker from 'vuejs-datepicker';
	import moment from 'moment';
	// import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
	export default{
		data(){
			return {
				loadcolor: '#f1715a',
				time: new Date(),
				size: '20px',
				professionals:[],
				loading:false,
				disabledDates:{
					to:new Date(Date.now() - 86400000)
				},
			}
		},
		components:{
			datepicker,
			// PulseLoader
		},
		methods:{
			customDate(date){
				this.loading =true
				this.time = moment(date).format(' YYYY-MM-DD');
				axios.post('/api/findprofessionals',{date:this.time}).
				then((response)=>{

					setTimeout(()=>{
						this.professionals =response.data
						this.loading=false
					},500)



				}).catch((error)=>{alert('error')})
			}
		},
		mounted(){
			//let time = moment(date).parseZone("Australia/Melbourne");
			this.loading=true
			axios.get('/api/professionals/today').then((response)=>{
				this.professionals = response.data
				this.loading=false

			})
		}
	}
</script>
<style scoped>
	.my-datepicker >>> .my-datepicker_calendar{
		width: 100%;
		height: 330px;
		font-weight: bold;
	}
	.my-datepicker >>> .my-datepicker_calendar .selected{
		background: #f1715a;
	}
	.my-datepicker >>> .my-datepicker_calendar .cell:hover{
		border-color: #f1715a !important;
	}
	.my-datepicker >>> .my-datepicker_calendar .selected:hover{
		background: #f1715a;
	}



</style>
