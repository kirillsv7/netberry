<template>
  <div class="container">
    <div class="row vh-100">
      <div class="col-8 m-auto">
        <div class="card">
          <div class="card-body">
            <table class="table">
              <tbody>
              <tr v-for="task in tasks">
                <td>{{ task.name }}</td>
                <td>
                  <template v-for="category in task.categories">
                    <span class="text-secondary me-2">{{ category.name }}</span>
                  </template>
                </td>
                <td>
                  <button class="btn btn-sm btn-close">
                  </button>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import {onMounted, ref} from "vue";

export default {
  setup() {
    const tasks = ref({})

    const getTasks = async () => {
      tasks.value = (await axios.get('/api/task')).data
    }

    onMounted(getTasks)

    return {tasks}
  }
}
</script>