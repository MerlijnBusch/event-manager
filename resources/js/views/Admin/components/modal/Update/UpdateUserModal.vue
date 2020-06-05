<template>
  <transition name="modal-fade">
    <div class="admin-modal-backdrop">
      <div
        class="admin-modal"
        role="dialog"
        aria-labelledby="modalTitle"
        aria-describedby="modalDescription"
      >
        <header
          id="modalTitle"
          class="admin-modal-header"
        >
          <slot name="header">
            <p
              class="admin-modal-title"
            >
              Update Block
            </p>

            <button
              type="button"
              class="admin-modal-btn-close"
              aria-label="Close modal"
              @click="close"
            >
              x
            </button>
          </slot>
        </header>
        <section
          id="modalDescription"
          class="admin-modal-body"
        >
          <slot name="body">
            <form
              class="form"
              method="post"
              @submit.prevent="checkForm"
            >
              <div class="form-line admin-from-submit">
                <input
                  type="submit"
                  value="Submit"
                  class="submit-btn admin-form-submit"
                >
              </div>
            </form>
          </slot>
        </section>
        <footer class="admin-modal-footer">
          <slot name="footer">
            <button
              type="button"
              class="admin-modal-btn-green"
              aria-label="Close modal"
              @click="close"
            >
              Close
            </button>
          </slot>
        </footer>
      </div>
    </div>
  </transition>
</template>

<script>
import API from '../../../../../Api';

export default {
    data () {
        return {

        };
    },
    name: 'UpdateUserModal',
    props: ['id'],
    methods: {
        close () {
            this.$emit('close');
        },
        checkForm: function (e) {

        },
        setFormData (data) {
            console.log(data);
        }
    },
    watch: {
        id: async function (newVal, oldVal) {
            this.setFormData(await API.get('/api/admin/user/' + this.id));
        }
    },
    async mounted () {
        this.setFormData(await API.get('/api/admin/user/' + this.id));
    }
};
</script>
