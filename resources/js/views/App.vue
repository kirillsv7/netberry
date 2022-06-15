<template>
  <div class="container">
    <div class="row vh-100">
      <div class="col-8 m-auto">
        <h1 class="fs-3">Task list</h1>
        <div class="alert alert-danger" role="alert" v-if="Object.keys(errors).length">
          <template v-for="error in errors">
            <p class="m-0" v-for="message in error">{{ message }}</p>
          </template>
        </div>
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-6">
                <input
                    class="form-control"
                    type="text"
                    v-model="task.name">
              </div>
              <div class="col-4">
                <template v-for="category in categories">
                  <div class="form-check form-check-inline">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        :value="category.id"
                        :id="category.name"
                        v-model="task.categories">
                    <label
                        class="form-check-label"
                        :for="category.name">
                      {{ category.name }}
                    </label>
                  </div>
                </template>
              </div>
              <div class="col-2">
                <button class="btn btn-secondary" @click="storeTask">Add task</button>
              </div>
            </div>
          </div>
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
                  <button class="btn btn-sm btn-close" @click="deleteTask(task.id)"></button>
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
import {onMounted} from "vue";
import useTask from "../composable/task";
import useCategory from "../composable/category";

export default {
  setup() {
    const {task, tasks, getTasks, storeTask, deleteTask, errors} = useTask()
    const {categories, getCategories} = useCategory()

    onMounted(() => {
      getTasks()
      getCategories()
    })

    return {
      categories,
      task,
      tasks,
      storeTask,
      deleteTask,
      errors
    }
  }
}
</script>