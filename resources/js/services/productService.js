const getProducts = async (params) => {
    let response = await axios.get('/api/products', { params });
    return response.data;
};

export {
    getProducts,
}
