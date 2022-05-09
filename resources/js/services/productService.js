const getProducts = async (params) => {
    let response = await axios.get('/api/products', { params });
    return response.data;
};

const createProduct = async (data) => {
    let response = await axios.post('/api/products', data, {
        headers: {
            "Content-Type": "multipart/form-data"
        },
    });
    return response.data;
};

export {
    getProducts,
    createProduct,
}
