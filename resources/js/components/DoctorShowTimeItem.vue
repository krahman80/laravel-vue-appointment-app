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
        }, today : ${this.$moment(new Date()).format("YYYY-MM-DD")}`
      );
      // this.timeSlot = null;
      // emit parent value
      this.$emit("reloadTimeSlot");
    },
  },
};
</script>