<template>
<div class="grades">
    <table class="table">
        <thead>
            <tr>
                <th>Subject</th>
                <th class="text-center">Midterm</th>
                <th class="text-center">Finals</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            <template v-for="(subject,key) in gradeSubjects">
            <tr>
                <td>
                    {{subject.subject}}
                    <input type="hidden" :name="`subject_id[${key}]`" :value="subject.subjectId">
                </td>
                <td  class="text-center">
                    <input type="text" class="form-control number-only text-center" :name="`midterm[${key}]`" v-model="subject.midterm" @keyup="calculateTotal(key, subject)">
                </td>
                <td  class="text-center">
                    <input type="text" class="form-control number-only text-center" :name="`finals[${key}]`"  v-model="subject.finals" @keyup="calculateTotal(key, subject)">
                </td>
                <td  class="text-center">
                    <input type="text" class="form-control number-only text-center disable" readonly  :name="`total[${key}]`"  v-model="subject.total">
                </td>
            </tr>
            </template>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td align="right"><b>Total GWA:</b></td>
                <td align="center"><b>{{gwa}}</b></td>
            </tr>
        </tfoot>
    </table>
</div>
</template>
<script>
export default {
  props:['subjects','grades'],
  data() {
    return {
      gradeSubjects:[],
      gwa:0,
    }
  },
  created() {
    if (!this.grades) {
      this.generateSubjectModel()
    }
  },
  methods: {
    generateSubjectModel() {
      let gradeSubjects = []

      _.forOwn(this.subjects,function(subject, key) {
        gradeSubjects.push({
          subject   : subject.name,
          subjectId : subject.id,
          midterm   : 0,
          finals    : 0,
          total     : 0,
        })        
      })

      this.gradeSubjects = gradeSubjects
    },
    calculateTotal(key, subject) {
      const total = (parseFloat(subject.midterm) + parseFloat(subject.finals)) / 2
      this.gradeSubjects[key].total = total
      let gwa = 0
      let summation = 0

      _.forOwn(this.gradeSubjects, function(subject) {
        summation += subject.total
      })

      this.gwa = summation / this.gradeSubjects.length
    }
  }
}
</script>