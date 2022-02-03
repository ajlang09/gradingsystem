<template>
<div class="grade-modal">
  <div class="modal fade" id="grade-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{detail.subject.subject}} - <span style="text-transform:capitalize;">{{detail.term}}</span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" :action="urlSaveGrade">
          <div class="modal-body">
            <input type="hidden" name="_token" :value="csrfToken">
            <input type="hidden" name="student_id" :value="studentid">
            <input type="hidden" name="class_id" :value="classid">
            <template v-if="detail.subject">
              <input type="hidden" name="subject_id" :value="detail.subject.subjectId">
            </template>
            <template v-if="detail.term">
              <input type="hidden" name="term" :value="detail.term">
            </template>
            <table class="table">
              <thead>
                <tr>
                  <th>Class Standing</th>
                  <th>Major Exams</th>
                  <th>Studentship</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input type="text" class="form-control  number-only" name="class_standing" :value="detail.subject.class_standing">
                  </td>
                  <td>
                    <input type="text" class="form-control  number-only" name="major_exams" :value="detail.subject.major_exams">
                  </td>
                  <td>
                    <input type="text" class="form-control number-only" name="studentship" :value="detail.subject.studentship">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <input type="hidden" id="btn-grade-modal"  data-bs-toggle="modal" data-bs-target="#grade-modal">
</div>
</template>
<script>
export default {
  props:['detail','studentid','classid'],
  data() {
    return {
      csrfToken:window.csrfToken,
      urlSaveGrade:window.apiUrl+'/student/grade'
    }
  },
  created() {
  },
  mounted() {

  },
}
</script>