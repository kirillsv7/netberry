import axios from "axios";
import {ref} from "vue";

export default function useCategory() {
    const categories = ref({})

    const getCategories = async () => {
        categories.value = (await axios.get('/api/category')).data
    }

    return {
        categories,
        getCategories
    }
}