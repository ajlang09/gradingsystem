<style type="text/css">
.hide {
  display: none;
}
</style>
<template>
<div class="student-list">
  <div class="card mt-5">
    <div class="card-body">
      <h5 class="card-title">Subjects</h5>
      <hr>
      <div class="row">
        <div class="col-sm-12 mb-1">
          <label class="mb-1" for="password">Subject</label>
          <input type="id" class="form-control" v-model="search" @keyup="fetchSubjects">
        </div>
        <div class="col-sm-12 mb-1 mt-2  hide">
          <button type="submit" class="btn btn-primary" id="update-btn-subject" name="action" value="update-class-subject">Add</button>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <input type="hidden" name="subject_id" :value="selectedSubject">
          <table class="table table-bordered" v-if="subjectList.length">
            <tbody>
              <template v-for="subject in subjectList">
                <tr>
                  <td class="v-align-center"><b>{{subject.name}}</b></td>
                  <td><span class="btn btn-primary" @click="select(subject)">Select</span></td>
                </tr>
              </template>
            </tbody>
          </table>          
        </div>
      </div>
    </div>
  </div>
</div>
</template>
<script>
export default {
  data() {
    return {
      search:'',
      selectedSubject:'',
      subjectList:[],
      classId:'',
    }
  },
  created() {
    if (document.getElementById('class_id')) {
      this.classId = document.getElementById('class_id').value
    }
  },
  mounted() {
    this.fetchSubjects()
  },
  methods:{
    async fetchSubjects() {
      const url = window.apiUrl +`/search/subject?classId=${this.classId}&search=${this.search}`
      try {
        const response = await axios.get(url)
        this.subjectList = response.data
      } catch(e) {

      }
    },
    select(subject) {
      this.selectedSubject = subject.id

      setTimeout(function(){
        document.getElementById('update-btn-subject').click()
      },300)
    }
  },
}
</script>