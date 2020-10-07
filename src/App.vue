<template>
  <div id="app" class="w-screen">
    <div class="wrapper mx-auto">
      <transition name="fade">
        <new-student v-if="addingStudent"></new-student>
        <edit-student
          v-if="editingStudent"
          :editedStudent="studentBeingEdited"
        ></edit-student>
      </transition>

      <div class="utilities mt-20">
        <div class="utilities-container flex flex-row justify-between">
          <div class="search-bar flex flex-row">
            <div class="control has-icons-left">
              <input
                class="input"
                type="email"
                placeholder="Search ID.."
                v-model="search"
              />
              <span class="icon is-small is-left">
                <i class="fas fa-search"></i>
              </span>
            </div>
            <button class="button is-black is-outlined ml-4" @click="searchID">
              Search
            </button>
          </div>

          <button class="button is-primary ml-4" @click="addingStudent = true">
            + Add
          </button>
        </div>
      </div>

      <div
        class="flex flex-col students-table mx-auto mt-8 border border-black p-4"
      >
        <div class="table-descriptor student flex flex-row mb-4">
          <div class="attribute title is-4">ID</div>
          <div class="attribute title is-4">Name</div>
          <div class="attribute title is-4">SSN</div>
          <div class="attribute title is-4">Major</div>
          <div class="attribute title is-4">Age</div>
          <div class="attribute title is-4">Sex</div>
          <div class="attribute title is-4">Address</div>
          <div class="attribute title is-4">GPA</div>
          <div class="attribute title is-4">Action</div>
        </div>
        <div
          v-for="student in students"
          :key="student.id"
          class="student flex flex-row mb-4"
        >
          <div class="attribute text-sm">{{ student.id }}</div>
          <div class="attribute text-sm">{{ student.name }}</div>
          <div class="attribute text-sm">{{ student.ssn }}</div>
          <div class="attribute text-sm">{{ student.major }}</div>
          <div class="attribute text-sm">{{ student.age }}</div>
          <div class="attribute text-sm">{{ student.sex }}</div>
          <div class="attribute text-sm">{{ student.address }}</div>
          <div class="attribute text-sm">{{ student.gpa }}</div>
          <div class="attribute text-sm flex flex-row">
            <button
              class="button is-danger is-small"
              @click="deleteStudent(student.id)"
            >
              Delete
            </button>
            <button
              class="button is-info is-small"
              @click="editStudent(student)"
            >
              Edit
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { bus } from "./main";
import axios from "axios";
import NewStudent from "./components/NewStudent";
import EditStudent from "./components/EditStudent";
import "@fortawesome/fontawesome-free/js/all";
export default {
  name: "App",
  mounted() {
    axios.post("http://localhost/students.php").then(({ data }) => {
      this.students = data;
    });
    bus.$on("closeModals", () => {
      this.addingStudent = false;
      this.editingStudent = false;
    });
    bus.$on("refreshStudent", () => {
      axios.post("http://localhost/students.php").then(({ data }) => {
        this.students = data;
      });
    });
    bus.$on("updatedStudent", (payload) => {
      for (let index = 0; index < this.students.length; index++) {
        if (this.students[index].id == payload.id) {
          this.students[index] = payload;
          this.editingStudent = false;
        }
      }
      axios
        .patch("http://localhost/updateStudent.php", {
          students: this.students,
        })
        .then(() => {});
    });
  },
  data() {
    return {
      students: [],
      addingStudent: false,
      editingStudent: false,
      studentBeingEdited: {},
      search: "",
    };
  },
  components: { "new-student": NewStudent, "edit-student": EditStudent },
  methods: {
    deleteStudent(id) {
      axios.post("deleteStudent.php", { id: id }).then(() => {
        bus.$emit("refreshStudent");
      });
    },
    editStudent(student) {
      this.studentBeingEdited = student;
      this.editingStudent = true;
    },
    searchID() {
      if (this.search) {
        axios
          .get(`http://localhost/getStudent.php?id=${this.search}`)
          .then(({ data }) => {
            this.students = data;
          });
      } else {
        axios.post("http://localhost/students.php").then(({ data }) => {
          this.students = data;
        });
      }
    },
  },
};
</script>

<style lang="scss">
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;

  .search-bar {
    width: 400px;
  }

  .wrapper {
    width: 1000px;
  }

  .students-table {
    .student {
      .attribute {
        text-align: center;

        &:nth-child(1) {
          width: 5%;
        }

        &:nth-child(2) {
          width: 15%;
        }

        &:nth-child(3) {
          width: 10%;
        }

        &:nth-child(4) {
          width: 20%;
        }

        &:nth-child(5) {
          width: 7.5%;
        }

        &:nth-child(6) {
          width: 7.5%;
        }

        &:nth-child(7) {
          width: 15%;
        }

        &:nth-child(8) {
          width: 10%;
        }

        &:nth-child(8) {
          width: 10%;
        }
      }
    }
  }
}
</style>
