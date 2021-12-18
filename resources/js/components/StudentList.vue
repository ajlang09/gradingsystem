<style type="text/css">
.hide {
  display: none;
}
</style>
<template>
<div class="student-list">
  <div class="card mt-5">
    <div class="card-body">
      <h5 class="card-title">STUDENTS</h5>
      <hr>
      <div class="row">
        <div class="col-sm-12 mb-1">
          <label class="mb-1" for="password">Enroll student(student no.)</label>
          <input type="id" class="form-control" v-model="search" @keyup="fetchStudent">
        </div>
        <div class="col-sm-12 mb-1 mt-2  hide">
          <button type="submit" class="btn btn-primary" id="update-btn" name="action" value="update-class-enrollment">Enroll</button>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <input type="hidden" name="student_id" :value="selectedStudent">
          <table class="table table-bordered" v-if="studentList.length">
            <tbody>
              <template v-for="student in studentList">
                <tr>
                  <td class="v-align-center"><b>{{student.name}}</b></td>
                  <td class="v-align-center"><b>{{student.email}}</b></td>
                  <td><span class="btn btn-primary" @click="select(student)">Select</span></td>
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
      studentList:[],
      search:'',
      selectedStudent:'',
      classId:'',
    }
  },
  created() {
    if (document.getElementById('class_id')) {
      this.classId = document.getElementById('class_id').value
    }
  },
  async mounted() {
    await this.fetchStudent()
  },
  methods: {
    async fetchStudent() {
      const url = window.apiUrl +`/search/student?search=${this.search}&classId=${this.classId}`
      try {
        const response = await axios.get(url)
        this.studentList = response.data
      } catch(e) {

      }
    },
    select(student) {
      this.selectedStudent = student.id
      setTimeout(function(){
        document.getElementById('update-btn').click()
      },300)
    },
  }
}
</script>