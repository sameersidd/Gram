<template>
  <div>
    <button
      class="btn btn-primary"
      style="width:5rem; height:2rem; padding-top:2.5px"
      @click="followUser"
      v-text="buttonText"
    >Follow</button>
  </div>
</template>

<script>
export default {
  props: ["user_id", "follows"],

  mounted() {
    console.log("Component mounted.");
  },

  data: function() {
    return { status: this.follows };
  },

  methods: {
    followUser(user_id) {
      axios
        .post("/follow/" + this.user_id)
        .then(res => {
          console.log(res);
          this.status = !this.status;
        })
        .catch(err => {
          console.log(err);
          if (err.response.status == 401) window.location = "/login";
        });
    }
  },

  computed: {
    buttonText() {
      return this.status ? "Unfollow" : "Follow";
    }
  }
};
</script>
