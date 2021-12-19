import Vue from "vue"

// components
import RankingTable        from './components/RankingTable'
import StudentGrade        from './components/StudentGrade'
import StudentList         from './components/StudentList'
import SubjectList         from './components/SubjectList'
import TeacherSubjectList  from './components/TeacherSubjectList'
import TeacherClassList  from './components/TeacherClassList'

Vue.config.devtools = false;
Vue.config.productionTip = false;

const app = new Vue({
  el:'.components',
  components: {
    RankingTable,
    StudentList,
    SubjectList,
    StudentGrade,
    TeacherSubjectList,
    TeacherClassList,
  },
})
