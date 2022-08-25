<template>
  <div style="padding-left: 100px">
    <div>
      {{ comment.comment }}
    </div>

    <div class="form-group mt-4" @click="reply">
      <input type="text" class="form-control" v-model="text">
      <button class="btn btn-warning mt-4">
        Reply
      </button>
    </div>

    <div>
      <comment v-for="(comment, index) in comment.comments" :key="index" :comment="comment" :level="level + 1"></comment>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['comment', 'level'],
  data() {
    return {
      text: ''
    }
  },
  created() {
    console.log('comment.created: ', this.level);
  },
  methods: {
    reply() {
      const data = {comment: this.text, parent_id: this.comment?.id};
      axios.post('/api/comments', data).then(({data}) => {
        this.$emit('commentCreated', data);
        this.text = '';
      });
    }
  }
}
</script>
