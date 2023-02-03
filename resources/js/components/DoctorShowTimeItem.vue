<template>
  <div>
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
        {{ formatTime(start_time)}} - {{ formatTime(end_time) }}
      </label>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    start_time: String,
    end_time: String,
  },
  computed: {},
  methods: {
    formatTime(timeSlot) {
      return String(timeSlot).substring(0, timeSlot.length - 3);
    },
  },
};
</script>