import axios from "axios";
import {ref} from "vue";

export default function useTask() {
    const task = ref({
        name: '',
        categories: []
    })
    const tasks = ref({})
    const errors = ref({})

    const getTasks = async () => {
        tasks.value = (await axios.get('/api/task')).data.data
    }

    const storeTask = async () => {
        try {
            errors.value = {}
            await axios.post('/api/task', task.value)
            task.value = {
                name: '',
                categories: []
            }
            await getTasks()
        } catch (e) {
            await handleException(e)
        }
    }

    const deleteTask = async (id) => {
        if (!window.confirm('Are you sure you want to delete?'))
            return
        try {
            await axios.delete(`/api/task/${id}`)
            await getTasks()
        } catch (e) {
            await handleException(e)
        }
    }

    const handleException = (e) => {
        switch (e.response.status) {
            case 422:
                errors.value = e.response.data.errors
                break
            case 403:
                break
            default:
                console.log(e.response)
                break
        }
    }
    return {
        task,
        tasks,
        getTasks,
        storeTask,
        deleteTask,
        errors
    }
}