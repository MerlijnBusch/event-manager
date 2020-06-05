<template>
  <div class="full-page-form">
    <div class="form-holder">
      <form
        class="form"
        method="post"
        @submit.prevent="checkForm"
      >
        <h2 class="form-title">
          Event
        </h2>

        <div class="form-line">
          <label
            class="form-label"
            for="name"
          >Name</label>
          <input
            id="name"
            v-model="name"
            class="form-text-input"
            type="text"
            name="name"
            placeholder="Event name"
          >
        </div>

        <div class="form-line">
          <label
            class="form-label"
            for="description"
          >Description</label>
          <textarea
            id="description"
            v-model="description"
            class="form-text-input"
            type="description"
            name="description"
            placeholder="Event description"
          />
        </div>

        <div class="form-line">
          <input
            type="submit"
            value="Submit"
            class="submit-btn"
          >
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import API from '@/js/Api';

export default {
    data () {
        return {
            errors: [],
            name: '',
            description: ''
        };
    },
    methods: {
        checkForm: function (e) {
            this.errors = [];

            const data = {
                name: this.name,
                description: this.description
            };

            API.post(data, '/api/event');

            e.preventDefault();
        }
    }
};
</script>
