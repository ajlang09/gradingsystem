<template>
<div class="ranking-table">
  <div class="row  mt-4">
    <div class="col-12">
      <h3>Ranking Tables</h3>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-12">
      <select class="form-control" v-model="filter.year" @change="fetchRanking">
        <option v-for="year in yearOption" :value="year"> {{ year }} </option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <table class="table">
        <thead>
          <tr>
            <th>Rank</th>
            <th>Name</th>
            <th class="text-center">GWA</th>
          </tr>
        </thead>
        <tbody>
          <template v-if="!rankings.length">
            <tr>
              <td align="center" colspan="2">No rankings for this year</td>
            </tr>
          </template>
          <template v-for="(ranking,rank) in rankings">
            <tr>
              <td><b>{{rank + 1}}</b></td>
              <td>{{ranking.student.name}}</td>
              <td class="text-center">{{ranking.gwa}}</td>
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
      rankings:[],
    }
  },
  async created() {
    await this.generateYearOption()
    await this.fetchRanking()
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
    async fetchRanking() {
      const url = window.apiUrl + `/get/ranking/table?year=${this.filter.year}`
      try {
        const response = await axios.get(url)
        this.rankings = response.data.original
      } catch(e) {

      }
    }
  },
}
</script>