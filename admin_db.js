/**
 * admin_db.js
 * A client-side "database" using localStorage to handle Trendy Threads Admin data.
 */

const DB_USERS_KEY = 'trendy_threads_users';
const DB_PRODUCTS_KEY = 'trendy_threads_products';
const DB_LOGGED_IN_USER_KEY = 'trendy_threads_admin_logged_in';

const INITIAL_USERS = [
    {
        "name": "Admin User",
        "email": "admin@example.com",
        "password": "password123",
        "phone": "",
        "role": "admin",
        "profile_pic": "",
        "orders": [
            {
                "id": "ORD-12345",
                "date": "2026-04-01 14:00:00",
                "total": 59.98,
                "payment_method": "GCash",
                "status": "Completed",
                "items": [
                    { "name": "Product 1", "price": 19.99, "qty": 1 },
                    { "name": "Product 5", "price": 39.99, "qty": 1 }
                ]
            }
        ]
    }
];

// Expanded initialization with all products from original products.json
const INITIAL_PRODUCTS = [
    { "name": "Product 1", "price": 19.99, "img": "aaq.jpg", "desc": "High-quality and stylish product.", "stock": 100 },
    { "name": "Product 2", "price": 29.99, "img": "sss.jpg", "desc": "Durable and reliable item.", "stock": 100 },
    { "name": "Product 3", "price": 24.99, "img": "xxx.jpg", "desc": "Perfect for everyday use.", "stock": 100 },
    { "name": "Product 4", "price": 34.99, "img": "zzz.jpg", "desc": "Modern and stylish design.", "stock": 100 },
    { "name": "Product 5", "price": 39.99, "img": "aaq.jpg", "desc": "Comfortable and trendy.", "stock": 100 },
    { "name": "Product 6", "price": 44.99, "img": "qaq.jpg", "desc": "Top-notch quality materials.", "stock": 100 },
    { "name": "Product 7", "price": 22.99, "img": "wwqq.jpg", "desc": "Stylish and affordable.", "stock": 100 },
    { "name": "Product 8", "price": 31.99, "img": "qwe.png", "desc": "Durable, long-lasting item.", "stock": 100 },
    { "name": "Product 9", "price": 27.99, "img": "rre.jpg", "desc": "Elegant and modern style.", "stock": 100 },
    { "name": "Product 10", "price": 36.99, "img": "qqw.png", "desc": "Perfect for everyday use.", "stock": 100 },
    { "name": "Product 11", "price": 19.99, "img": "xxx.jpg", "desc": "Comfortable and stylish.", "stock": 100 },
    { "name": "Product 12", "price": 42.99, "img": "rre.jpg", "desc": "Modern and reliable design.", "stock": 100 },
    { "name": "Product 13", "price": 28.99, "img": "eew.jpg", "desc": "High-quality and trendy.", "stock": 100 },
    { "name": "Product 14", "price": 33.99, "img": "zzz.jpg", "desc": "Stylish and durable.", "stock": 100 },
    { "name": "Product 15", "price": 37.99, "img": "asda.jpg", "desc": "Comfortable and modern design.", "stock": 100 },
    { "name": "Product 16", "price": 41.99, "img": "asd.jpg", "desc": "Durable and stylish material.", "stock": 100 },
    { "name": "Product 17", "price": 23.99, "img": "aaq.jpg", "desc": "Modern design for everyday wear.", "stock": 100 },
    { "name": "Product 18", "price": 39.99, "img": "wwqq.jpg", "desc": "Stylish and high-quality material.", "stock": 100 },
    { "name": "Product 19", "price": 31.99, "img": "wwqq.jpg", "desc": "Comfortable, trendy, and stylish.", "stock": 100 },
    { "name": "Product 20", "price": 45.99, "img": "sss.jpg", "desc": "Perfect combination of style and comfort.", "stock": 100 },
    { "name": "Product 21", "price": 20.99, "img": "sss.jpg", "desc": "Extra stylish product.", "stock": 100 },
    { "name": "Product 22", "price": 25.99, "img": "qwe.png", "desc": "High-quality item.", "stock": 100 },
    { "name": "Product 23", "price": 30.99, "img": "sss.jpg", "desc": "Reliable and modern design.", "stock": 100 },
    { "name": "Product 24", "price": 35.99, "img": "aaq.jpg", "desc": "Durable and comfortable.", "stock": 100 },
    { "name": "Product 25", "price": 40.99, "img": "asda.jpg", "desc": "Trendy and affordable.", "stock": 100 }
];

// Initialize DB if empty
if (!localStorage.getItem(DB_USERS_KEY)) {
    localStorage.setItem(DB_USERS_KEY, JSON.stringify(INITIAL_USERS));
}
if (!localStorage.getItem(DB_PRODUCTS_KEY)) {
    localStorage.setItem(DB_PRODUCTS_KEY, JSON.stringify(INITIAL_PRODUCTS));
}

const AdminDB = {
    // USER METHODS
    getUsers: () => JSON.parse(localStorage.getItem(DB_USERS_KEY) || '[]'),
    saveUsers: (users) => localStorage.setItem(DB_USERS_KEY, JSON.stringify(users)),

    findUserByEmail: (email) => {
        const users = AdminDB.getUsers();
        return users.find(u => u.email === email);
    },

    registerUser: (name, email, password, role = 'admin') => {
        const users = AdminDB.getUsers();
        if (users.find(u => u.email === email)) return { success: false, message: 'Email already registered.' };

        const newUser = {
            name, email, password, role,
            phone: '', region: '', province: '', city: '', barangay: '', street: '',
            profile_pic: '', orders: []
        };
        users.push(newUser);
        AdminDB.saveUsers(users);
        return { success: true, user: newUser };
    },

    updateUser: (email, newData) => {
        const users = AdminDB.getUsers();
        const index = users.findIndex(u => u.email === email);
        if (index !== -1) {
            users[index] = { ...users[index], ...newData };
            AdminDB.saveUsers(users);
            // If updating current user, refresh session
            const current = AdminDB.getLoggedInUser();
            if (current && current.email === email) {
                AdminDB.setLoggedInUser(users[index]);
            }
            return true;
        }
        return false;
    },

    // PRODUCT METHODS
    getProducts: () => JSON.parse(localStorage.getItem(DB_PRODUCTS_KEY) || '[]'),
    saveProducts: (products) => localStorage.setItem(DB_PRODUCTS_KEY, JSON.stringify(products)),

    addProduct: (product) => {
        const products = AdminDB.getProducts();
        products.push({ ...product, id: Date.now() });
        AdminDB.saveProducts(products);
    },

    // SESSION METHODS
    getLoggedInUser: () => JSON.parse(localStorage.getItem(DB_LOGGED_IN_USER_KEY) || 'null'),
    setLoggedInUser: (user) => localStorage.setItem(DB_LOGGED_IN_USER_KEY, JSON.stringify(user)),
    logout: () => localStorage.removeItem(DB_LOGGED_IN_USER_KEY)
};
