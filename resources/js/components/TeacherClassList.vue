<template>
<div class="ranking-table">
  <div class="row  mt-4">
    <div class="col-12">
      <h3>Class List</h3>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-12">
      <select class="form-control" v-model="filter.year" @change="fetchClass">
        <option v-for="year in yearOption" :value="year"> {{ year }} </option>
      </select>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-12">
      <table class="table" id="subjectList">
        <thead>
          <tr>
            <th>Class</th>
            <th class="text-center">Students</th>
            <th class="text-center"></th>
          </tr>
        </thead>
        <tbody>
          <template v-for="classRecord in classes">
            <tr>
              <td><b>{{classRecord.className}}</b></td>
              <td class="text-center">{{classRecord.studentCount}}</td>
              <td class="text-center"><a :href="`${teacherUrl}/${classRecord.classId}/${teacherId}/class/students`" class="btn btn-warning">View Students</a></td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
</template>
<script>
export default {
  data() {
    return {
      filter: {
        year:this.year(new Date),
      },
      yearOption: [],
      classes:[],
      teacherId:'',
      teacherUrl:window.apiUrl+'/teacher'
    }
  },
  async created() {
    this.teacherId = document.querySelector('meta[name="teacher_id"]').content


    await this.generateYearOption()
    await this.fetchClass()
  },
  methods: {
    generateYearOption() {
      const yearNow = parseInt(this.year(new Date)) + 10
      let yearOption = []
      for (var i = 2000; i <= yearNow; i++) {
        yearOption.push(i)
      }
      this.yearOption = yearOption
    },
    year(value) {
      if (value) {
        return moment(String(value)).format('Y')
      }
    },
    async fetchClass() {
      const url = window.apiUrl + `/teacher/${this.teacherId}/class?year=${this.filter.year}`
      try {
        const response = await axios.get(url)
        this.classes = response.data

      } catch(e) {

      }
    }
  }
}
</script>