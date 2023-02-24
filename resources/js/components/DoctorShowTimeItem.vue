<template>
  <div>
    <div class="form-group" v-for="(slot, index) in timeSlot" :key="index">
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          :value="slot.id"
          v-model="selectedId"
          name="timeSlot"
        />
        <label class="form-check-label" for="timeSlot">
          {{ formatTime(slot.start_time) }} - {{ formatTime(slot.end_time) }}
        </label>
      </div>
    </div>

    <div class="form-group mt-3" v-if="getUserPermission">
      <button
        class="btn btn-secondary btn-sm w-auto"
        :disabled="radioSelected"
        @click="submitAppointmentTime"
      >
        Submit
      </button>
    </div>
    <div class="form-group mt-3 p-2 text-muted" v-else>
      <p class="m-0 p-0 text-primary" style="font-size: 0.7rem">
        Login or Register to book an appointment!
      </p>
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
      // error: false,
    };
  },
  computed: {
    // radioSelected() {
    // return Array.isArray(this.timeSlot) && !this.timeSlot.length;
    // },
    radioSelected() {
      return this.selectedId === null;
    },
    getUserPermission() {
      const permission = this.$store.state.user.permissions;
      const isLogin = this.$store.state.isLogin;
      return (
        isLogin &&
        permission.map((item) => {
          item === "submit appointment request";
        })
      );
    },
  },
  methods: {
    formatTime(timeSlot) {
      return String(timeSlot).substring(0, timeSlot.length - 3);
    },
    submitAppointmentTime() {
      // axios request
      const postData = {
        doctor_id: this.$route.params.id,
        date: this.$moment(new Date()).format("YYYY-MM-DD"),
        patient_id: "3",
        schedule_id: String(this.selectedId),
      };
      axios
        .post(`/api/doctors/appointment`, postData)
        .then((response) => {
          console.log(response.status);
          this.$emit("reloadDoctorShow", response.status);
        })
        .catch((err) => {
          // console.log(`you have error : ${err.response.status}`);
          // console.log(err);
          // console.log(postData);
          if (
            err.response &&
            err.response.status &&
            err.response.status === 422
          ) {
            console.log(err.response.status);
            this.$emit("reloadDoctorShow", err.response.status);
          }
        });

      // reload calendar component on success request
      // console.log(
      //   `schedule id: ${this.selectedId}, doctor id: ${
      //     this.$route.params.id
      //   }, today : ${this.$moment(new Date()).format("YYYY-MM-DD")}`
      // );
      // this.timeSlot = null;
      // if axios success emit to parent value
    },
  },
};
</script>