<template>
  <div class="row">
    <div class="col-lg-9 col-md-12 mb-2">
      <div class="card">

        <div
          class="card-body"
          v-if="isLoading"
        >
          data is loading ...
        </div>
        <div
          class="card-body"
          v-else
        >
          <h4 class="card-title text-center">{{ doctor.name }}</h4>
          <h6 class="card-subtitle mb-2 text-muted text-center">{{ doctor.email }}</h6>
          <hr>
          <div class="card-text p-3">
            <!-- <div class="alert alert-dismissible alert-success">
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
              ></button>
              <h4 class="alert-heading">Success!</h4>
              <p class="mb-0">Best check yo self, you're not looking too good. <a
                  href="#"
                  class="alert-link"
                >cek your appointment status</a>.</p>
            </div> -->

            <div class="row">
              <div class="col-lg-6 col-md-12 d-flex justify-content-center">
                <div class="my-2">
                  <h5 class="text-muted mb-3 text-center">Calendar</h5>
                  <vc-calendar
                    :attributes="attributes"
                    :min-date="new Date()"
                    @dayclick="onClickDay"
                    :key="componentKey"
                  ></vc-calendar>
                </div>

              </div>
              <div class="col-lg-6 col-md-12 d-flex justify-content-center">
                <div class="my-2 text-center">
                  <h5 class="text-muted mb-3">Available Schedule</h5>

                  <div v-if="timeSlotIsEmpty">
                    <p
                      v-if="timeSlotRequestIsEmpty"
                      class="text-success"
                    >
                      Schedule not available!
                    </p>
                    <p
                      v-if="beforeInitialRequest"
                      class="text-muted"
                    >Click Calendar to show schedule!</p>
                  </div>
                  <div v-else>
                    <doctor-show-time-item
                      v-bind:time-slot="timeSlot"
                      @reloadTimeSlot="reloadTimeSlot"
                    ></doctor-show-time-item>
                  </div>

                </div>
              </div>
            </div>
            <!-- <div class="row mt-4">
              <div class="col col-10 mx-auto">
                
              </div>

            </div> -->

          </div>

        </div>

      </div>
    </div>
    <div class="col-lg-3 col-md-12 mb-2">
      xxx

    </div>
  </div>
</template>

<script>
import DoctorShowTimeItem from "./DoctorShowTimeItem.vue";

export default {
  components: {
    DoctorShowTimeItem,
  },
  data() {
    return {
      componentKey: 0,
      doctor: null,
      schedules: null,
      isLoading: false,
      timeSlot: [],
      status: null,
      isInitial: true,
    };
  },
  created() {
    // console.log(this.$route.params.id);
    this.isLoading = true;
    axios
      .all([
        axios.get(`/api/doctors/${this.$route.params.id}`),
        axios.get(`/api/doctors/${this.$route.params.id}/schedule`),
      ])
      .then(
        axios.spread((first, second) => {
          this.doctor = first.data.data;
          this.schedules = second.data.data;
          this.isLoading = false;
        })
      )
      .catch((error) => {
        if (error.response.status === 404) {
          // what the hell do i do here?
          this.$router.push({ name: "404" });
        }
      });
  },
  methods: {
    reloadTimeSlot() {
      // console.log("we are sure");
      this.componentKey += 1;
      this.timeSlot = [];
      this.isInitial = true;
    },
    onClickDay(day) {
      this.timeSlot = [];
      this.status = null;
      const dayString = this.convertDate(day.date);
      const url = `/api/doctors/${this.$route.params.id}/schedule/${dayString}`;
      //make axios request
      axios
        .get(url)
        .then((response) => (this.timeSlot = response.data.data))
        .catch((error) => (this.status = error.response.status))
        .then(() => (this.isInitial = false));
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
  },
  computed: {
    attributes() {
      if (this.schedules != null) {
        return [
          {
            key: "today",
            highlight: {
              color: "blue",
              fillMode: "light",
            },
            dates: new Date(),
          },
          {
            dot: true,
            highlight: {
              color: "green",
              fillMode: "light",
            },
            dates: [...this.schedules.map((obj) => new Date(obj.date))],
          },
        ];
      }
    },
    timeSlotIsEmpty() {
      // return this.timeSlot.length == 0;
      return Array.isArray(this.timeSlot) && !this.timeSlot.length;
    },
    timeSlotRequestIsEmpty() {
      return this.status === 404 || this.status === 422;
    },
    beforeInitialRequest() {
      return this.isInitial === true;
    },
  },
};
</script>