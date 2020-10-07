<template>
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Edit Student</p>
        <button class="delete" aria-label="close" @click="closeModal"></button>
      </header>
      <section class="modal-card-body">
        <div class="field">
          <label class="label">Name</label>
          <div class="control">
            <input
              class="input"
              type="text"
              placeholder="What's the student's name.."
              v-model="student.name"
            />
          </div>
        </div>
        <div class="field">
          <label class="label">SSN</label>
          <div class="control">
            <input
              class="input"
              type="text"
              placeholder="SSN no."
              v-model="student.ssn"
            />
          </div>
        </div>
        <div class="field">
          <label class="label">Major</label>
          <div class="control">
            <input
              class="input"
              type="text"
              placeholder="Student's major.."
              v-model="student.major"
            />
          </div>
        </div>
        <div class="field">
          <label class="label">Age</label>
          <div class="control">
            <input
              class="input"
              type="text"
              placeholder="How old is the student.."
              v-model="student.age"
            />
          </div>
        </div>
        <div class="field">
          <label class="label">Sex</label>
          <div class="control">
            <v-select
              v-model="student.sex"
              :options="['M', 'F', 'Other']"
            ></v-select>
          </div>
        </div>
        <div class="field">
          <label class="label">Address</label>
          <div class="control">
            <input
              class="input"
              type="text"
              placeholder="Street name.."
              v-model="student.address"
            />
          </div>
        </div>
        <div class="field">
          <label class="label">GPA</label>
          <div class="control">
            <input
              class="input"
              type="number"
              placeholder="Student's GPA.."
              step="0.01"
              v-model="student.gpa"
            />
          </div>
        </div>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" @click="editStudent">Confirm</button>
        <button class="button" @click="closeModal">Cancel</button>
      </footer>
    </div>
  </div>
</template>

<script>
import { bus } from "../main";
import vSelect from "vue-select";
export default {
  components: { "v-select": vSelect },
  props: ["editedStudent"],
  mounted() {
    // bus.$emit("patchStudent", { updatedStudent: this.student });
  },
  data() {
    return {
      student: this.editedStudent,
    };
  },
  methods: {
    closeModal() {
      bus.$emit("closeModals");
    },
    editStudent() {
      bus.$emit("updatedStudent", this.student);
    },
  },
};
</script>

<style>
</style>