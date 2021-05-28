<template>
  <v-row>
    <v-col>
      <v-sheet height="600">
        <v-calendar
          ref="calendar"
          :now="today"
          :value="today"
          :events = "events"
          color="primary"
          type="week"
        ></v-calendar>
      </v-sheet>
    </v-col>
  </v-row>
</template>

<script>
  import moment from 'moment';
  export default {
    data: () => ({
      today: new Date(),
      events: [
        {
          name: 'Weekly Meeting',
          start: '2021-05-18 09:00',
          end: '2021-05-18 10:00',
        },
        {
          name: `Thomas' Birthday`,
          start: '2021-05-20 09:00',
          emd: '2021-05-20 13:00',
        },
        {
          name: 'Mash Potatoes',
          start: '2021-05-21 12:30',
          end: '2021-05-21 15:30',
        }
    ]
    }),
    mounted () {
      this.$refs.calendar.scrollToTime('08:00')
    },
  }
</script>

<style scoped>
.my-event {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  border-radius: 2px;
  background-color: #1867c0;
  color: #ffffff;
  border: 1px solid #1867c0;
  font-size: 12px;
  padding: 3px;
  cursor: pointer;
  margin-bottom: 1px;
  left: 4px;
  margin-right: 8px;
  position: relative;
}

.my-event.with-time {
  position: absolute;
  right: 4px;
  margin-right: 0px;
}
</style>
