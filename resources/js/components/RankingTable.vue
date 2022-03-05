<template>
<div class="ranking-table">
  <div class="row  mt-4">
    <div class="col-12">
      <h3>Ranking Tables</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <span class="btn btn-primary" @click="toggleGwa">TOGGLE GWA</span>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-12 col-md-3">
      <select class="form-control" v-model="filter.year" @change="fetchRanking">
        <option v-for="year in yearOption" :value="year"> {{ year }} </option>
      </select>
    </div>
    <div class="col-12 col-md-3">
      <select class="form-control" v-model="filter.semester" @change="fetchRanking">
        <option value="">Select Semester</option>
        <option value="first-semester">1st semester</option>
        <option value="second-semester">2nd semester</option>
      </select>
    </div>
    <div class="col-12 col-md-3">
      <select class="form-control" v-model="filter.type" @change="fetchRanking">
        <option value="">Select Ranking</option>
        <template v-for="classRecord in semesterClasses[filter.semester]">
          <option :value="`class-${classRecord.class_id}`">By Classes - {{ classRecord.class_name }}</option>
        </template>
        <!-- <template v-for="subject in subjects">
          <option :value="`subject-${subject.id}`">By Subject - {{subject.name}}</option>
        </template> -->
        <option value="all-student">All Student</option>
      </select>
    </div>
    <div class="col-12 col-md-3">
      <select class="form-control" v-model="filter.rank" @change="fetchRanking">
        <option value="">Select rank</option>
        <option value="deans-lister">Dean's Lister</option>
        <option value="presidents-lister">Presidents's Lister</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <table class="table">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <template v-if="showGwa">
              <th class="text-center">GWA</th>
            </template>
            <th>Rank</th>
          </tr>
        </thead>
        <tbody>
          <template v-if="!filter.rank && !rankings.length">
            <tr>
              <td align="center" colspan="10">No rankings for this year</td>
            </tr>
          </template>
          <template v-if="filter.rank && emptyRank">
            <tr>
              <td align="center" colspan="10">No rankings for this year</td>
            </tr>
          </template>
          <template v-for="(ranking,rank) in rankings">
            <template v-if="!filter.rank || filter.rank == ranking.rankSlug">
            <tr>
              <td><b>{{rank + 1}}</b></td>
              <td>{{ranking.student.name}}</td>
              <template v-if="showGwa">
                <td class="text-center">{{ranking.gwa}}</td>
              </template>
              <td>{{ranking.rank}}</td>
            </tr>
            </template>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</div>
</template>
<script>
export default {
  props:['classes', 'subjects'],
  data() {
    return {
      filter: {
        year:this.year(new Date),
        type:'',
        semester:'',
        rank:'',
      },
      yearOption: [],
      rankings:[],
      semesterClasses: {},
      showGwa:true,
      emptyRank:false,
    }
  },
  watch: {
    "filter.rank"() {
      if (!this.filter.rank) {
        return
      }

      let emptyRank = true
      const filterRank = this.filter.rank

      _.forOwn(this.rankings,function(ranking){
        if (ranking.rankSlug == filterRank) {
          emptyRank = false
        }
      })

      this.emptyRank = emptyRank
    }
  },
  async created() {
    await this.mappedClass()
    await this.generateYearOption()
    await this.fetchRanking()
  },
  methods: {
    mappedClass() {
      let semesterClasses = {}

      _.forOwn(this.classes, function(classRecord){
        if (!semesterClasses[classRecord.semester]) {
          semesterClasses[classRecord.semester] = []

        }

        semesterClasses[classRecord.semester].push(classRecord)
      })

      this.semesterClasses = semesterClasses
    },
    toggleGwa() {
      this.showGwa = !this.showGwa
    },
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
    async fetchRanking() {
      const url = window.apiUrl + `/get/ranking/table?year=${this.filter.year}&type=${this.filter.type}&semester=${this.filter.semester}`
      try {
        const response = await axios.get(url)
        this.rankings = response.data
      } catch(e) {

      }
    }
  },
}
</script>
