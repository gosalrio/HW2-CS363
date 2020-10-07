<template>
  <div id="app" class="w-screen">
    <div class="wrapper mx-auto">
      <transition name="fade">
        <new-student v-if="addingStudent"></new-student>
      </transition>

      <div class="utilities mt-20">
        <div class="utilities-container flex flex-row">
          <div class="control has-icons-left">
            <input class="input" type="email" placeholder="Search.." />
            <span class="icon is-small is-left">
              <i class="fas fa-search"></i>
            </span>
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
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { bus } from "./main";
import axios from "axios";
import NewStudent from "./components/NewStudent";
import "@fortawesome/fontawesome-free/js/all";
export default {
  name: "App",
  mounted() {
    axios.post("http://localhost/students.php").then(({ data }) => {
      this.students = data;
    });
    bus.$on("closeNewStudent", () => {
      this.addingStudent = false;
    });
  },
  data() {
    return {
      students: [],
      addingStudent: false,
    };
  },
  components: { "new-student": NewStudent },
};
</script>

<style lang="scss">
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
          width: 25%;
        }

        &:nth-child(8) {
          width: 10%;
        }
      }
    }
  }
}
</style>
