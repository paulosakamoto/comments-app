<template>
  <div class="container">
    <h1>Display Comments</h1>

    <div>
      <comment v-for="(comment, index) in comments" :key="index" :comment="comment" :level="0" @commentCreated=""></comment>
    </div>

    <div class="form-group">
      <p>Add comment</p>
      <textarea v-model="text" class="form-control"></textarea>
      <button class="btn btn-success mt-4" @click="addComment">
        Add comment
      </button>
    </div>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      text: '',
      comments: []
    }
  },
  created() {
    this.fetchComments();
  },
  methods: {
    fetchComments() {
      axios.get('/api/comments').then(({data}) => {
          this.comments = data;
          console.log('comments: ', this.comments);
      });
    },
    commentCreated(comment) {
      this.comments
    },
    addComment() {
      const data = {comment: this.text};
      axios.post('/api/comments', data).then(({data}) => {
        this.comments.push(data);
        this.text = '';
      });
    },
  }
}
</script>
