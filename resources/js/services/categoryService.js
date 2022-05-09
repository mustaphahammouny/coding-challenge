const getCategories = async () => {
    let response = await axios.get('/api/categories');
    return response.data;
};

export {
    getCategories,
}
