const getCategories = async () => {
    let response = await axios.get('/api/categories');
    return response.data;
};

const createCategory = async (data) => {
    let response = await axios.post('/api/categories', data);
    return response.data;
};

export {
    getCategories,
    createCategory,
}
