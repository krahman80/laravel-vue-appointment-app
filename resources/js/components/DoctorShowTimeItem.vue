<template>
  <div>
    <div
      class="form-group"
      v-for="(slot, index) in timeSlot"
      :key="index"
    >
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          :value="slot.id"
          v-model="selectedId"
          name="timeSlot"
        >
        <label
          class="form-check-label"
          for="timeSlot"
        >
          {{ formatTime(slot.start_time)}} - {{ formatTime(slot.end_time) }}
        </label>
      </div>
    </div>

    <div class="form-group mt-3">
      <button
        class="btn btn-secondary btn-sm w-auto"
        :disabled="radioSelected"
        @click="submitAppointmentTime"
      >Submit</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    timeSlot: Array,
  },
  data() {
    return {
      selectedId: null,
    };
  },
  computed: {
    // radioSelected() {
    // return Array.isArray(this.timeSlot) && !this.timeSlot.length;
    // },
    radioSelected() {
      return this.selectedId === null;
    },
  },
  methods: {
    formatTime(timeSlot) {
      return String(timeSlot).substring(0, timeSlot.length - 3);
    },
    convertDate(date) {
      var yyyy = date.getFullYear().toString();
      var mm = (date.getMonth() + 1).toString();
      var dd = date.getDate().toString();

      var mmChars = mm.split("");
      var ddChars = dd.split("");

      return (
        yyyy +
        "-" +
        (mmChars[1] ? mm : "0" + mmChars[0]) +
        "-" +
        (ddChars[1] ? dd : "0" + ddChars[0])
      );
    },
    submitAppointmentTime() {
      // axios request
      //       axios.post("https://reqres.in/api/login", {
      //       email: email,
      //       password: password
      //     })
      //     .then((response) => {
      //       console.log(response);
      //     });
      // });

      // reload calendar component on success request
      console.log(
        `schedule id: ${this.selectedId}, doctor id: ${
          this.$route.params.id
        }, today : ${this.convertDate(new Date())}`
      );
      // this.timeSlot = null;
      // emit parent value
      this.$emit("reloadTimeSlot");
    },
  },
};
</script>