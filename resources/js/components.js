import Vue from "vue"

// components
import StudentList  from './components/StudentList'
import SubjectList  from './components/SubjectList'
import StudentGrade from './components/StudentGrade'

Vue.config.devtools = false;
Vue.config.productionTip = false;

const app = new Vue({
  el:'.components',
  components: {
    StudentList,
    SubjectList,
    StudentGrade,
  },
})
