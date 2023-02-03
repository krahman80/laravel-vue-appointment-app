<template>
  <div>
    <input
      class="form-check-input"
      type="radio"
      name="optionsRadios"
      id="optionsRadios1"
      value="option1"
    >
    <label
      class="form-check-label"
      for="optionsRadios1"
    >
      {{ formatTime(start_time)}} - {{ formatTime(end_time) }}
    </label>
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