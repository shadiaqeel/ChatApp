<template>
  <div class="Composer">
    <textarea v-model="message" @keydown.enter="send" placeholder="Message ..."></textarea>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: ""
    };
  },
  methods: {
    send() {
      if (this.message == "") return;

      this.$emit("send", this.message);
      this.message = "";
    }
  }
};
</script>






<style lang="scss" scoped>

.Composer{


    textarea{

        width: 96%;
        margin: 10px;
        resize : none;
        border-radius: 5px;
        border : 1px solid lightgray;
        padding:10px;

    }
}
</style>
