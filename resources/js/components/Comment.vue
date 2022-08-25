<template>
  <div :style="{'padding-left': paddingLeft}">
    <div>
      <strong>{{ comment.user.name }}</strong>
    </div>
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
  computed: {
    paddingLeft() {
      return (this.level * 50) + 'px'
    }
  },
  methods: {
    reply() {
      if (!this.text) {
        return;
      }
      const data = {comment: this.text, parent_id: this.comment?.id};
      axios.post('/api/comments', data).then(({data}) => {
        this.comment.comments.push(data);
        this.$emit('commentCreated', data);
        this.text = '';
      });
    }
  }
}
</script>
