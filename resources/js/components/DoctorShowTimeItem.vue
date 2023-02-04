<template>
  <div>
    <div
      class="form-group"
      v-for="(slot,index) in timeSlot"
      :key="index"
    >
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          name="flexRadioDefault"
        >
        <label
          class="form-check-label"
          for="flexRadioDefault1"
        >
          {{ formatTime(slot.start_time)}} - {{ formatTime(slot.end_time) }}
        </label>
      </div>
    </div>

    <div class="form-group">
      <button
        class="btn btn-secondary btn-sm w-auto"
        :disabled="timeSlotIsEmpty"
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
    return {};
  },
  computed: {
    timeSlotIsEmpty() {
      return Array.isArray(this.timeSlot) && !this.timeSlot.length;
    },
  },
  methods: {
    formatTime(timeSlot) {
      return String(timeSlot).substring(0, timeSlot.length - 3);
    },
  },
};
</script>