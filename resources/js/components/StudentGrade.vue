<style type="text/css">
  .hide {
    display: none;
  }
  .mpointer {
    cursor: pointer;
  }
</style>
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
            <template v-for="(subject, key in gradeSubjects.midterm">
              <tr>
                  <td>
                      {{gradeSubjects.midterm[key].subject}}
                  </td>
                  <td  class="text-center">
                    <div class="form-control mpointer" @click="openGradeModal(gradeSubjects.midterm[key], 'midterm')">
                      {{ gradeSubjects.midterm[key].midterm }}
                    </div>
                    <!-- <input type="text" class="form-control number-only text-center" :name="`midterm[${key}]`" v-model="subject.midterms" @keyup="calculateTotal(key, subject)"> -->
                  </td>
                  <td  class="text-center">
                      <div class="form-control mpointer" @click="openGradeModal(gradeSubjects.finals[key], 'finals')">
                        {{ gradeSubjects.finals[key].finals }}
                      </div>
                      <!-- <input type="text" class="form-control number-only text-center" :name="`finals[${key}]`"  v-model="subject.finals" @keyup="calculateTotal(key, subject)"> -->
                  </td>
                  <td  class="text-center">
                      <div class="form-control mpointer disable">
                        {{ (gradeSubjects.midterm[key].midterm + gradeSubjects.finals[key].finals) / 2 }}
                      </div>
                      <!-- <input type="text" class="form-control number-only text-center disable" readonly  :name="`total[${key}]`"  v-model="subject.total"> -->
                  </td>
              </tr>
            </template>
        </tbody>
        <input type="hidden" name="gwa" :value="gwa">
        <tfoot v-if="'teacher' != mode">
            <tr>
                <td></td>
                <td></td>
                <td align="right"><b>Total GWA:</b></td>
                <td align="center"><b>{{gwa}}</b></td>
            </tr>
        </tfoot>
    </table>
    <grade-modal :detail="gradeModal" :studentid="studentid" :classid="classid"/>
</div>
</template>
<script>

import GradeModal from './GradeModal'

export default {
  props:['subjects','mappedgrades', 'mode','studentid', 'classid'],
  data() {
    return {
      gradeSubjects:[],
      gwa:0,
      teacherId:'',
      gradeModal: {
        term:'',
        subject:'',
      },
    }
  },
  components: {
    GradeModal,
  },
  created() {
    // if (!this.mappedgrades.grades.length) {
    //   this.generateSubjectModel()
    // }

    console.log(this.mode)

    this.parseDatas()

    if ('teacher'== this.mode) {
      this.teacherId = document.querySelector('meta[name="teacher_id"]').content
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

      // _.forOwn(this.subjects,function(subject, key) {
      //   gradeSubjects.push({
      //     subject   : subject.name,
      //     subjectId : subject.id,
      //     useId : subject.id,
      //     midterms   : 0,
      //     finals    : 0,
      //     total     : 0,
      //   })        
      // })

      // this.gradeSubjects = gradeSubjects
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
    },
    openGradeModal(subject, term) {
      if ('student' == this.mode) {
        return
      }

      this.gradeModal= {
        term:term, 
        subject:subject, 
      }

      document.getElementById('btn-grade-modal').click()
    }
  }
}
</script>