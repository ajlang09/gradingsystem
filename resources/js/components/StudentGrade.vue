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
                    <input type="text" class="form-control number-only text-center" :name="`midterm[${key}]`" v-model="subject.midterms" @keyup="calculateTotal(key, subject)">
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
                <input type="hidden" name="gwa" :value="gwa">
            </tr>
        </tfoot>
    </table>
</div>
</template>
<script>
export default {
  props:['subjects','mappedgrades'],
  data() {
    return {
      gradeSubjects:[],
      gwa:0,
    }
  },
  created() {
    if (!this.mappedgrades.grades.length) {
      this.generateSubjectModel()
    }

    if (this.mappedgrades.grades.length) {
      this.parseDatas()
    }

  },
  methods: {
    parseDatas() {
      const mappedgrades = this.mappedgrades

      this.gradeSubjects = mappedgrades.grades
      this.gwa           = mappedgrades.gwa
    },
    generateSubjectModel() {
      let gradeSubjects = []

      _.forOwn(this.subjects,function(subject, key) {
        gradeSubjects.push({
          subject   : subject.name,
          subjectId : subject.id,
          midterms   : 0,
          finals    : 0,
          total     : 0,
        })        
      })

      this.gradeSubjects = gradeSubjects
    },
    calculateTotal(key, subject) {
      
      if (!subject.midterms) {
        subject.midterms = 0
        return
      }
      
      if (!subject.finals) {
        subject.finals = 0
        return
      }

      const total = (parseFloat(subject.midterms) + parseFloat(subject.finals)) / 2

      this.gradeSubjects[key].total = total
      let gwa = 0
      let summation = 0

      _.forOwn(this.gradeSubjects, function(subject) {
        summation += parseFloat(subject.total)
      })

      this.gwa = (summation / this.gradeSubjects.length).toFixed(2)
    }
  }
}
</script>