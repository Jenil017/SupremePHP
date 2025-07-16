-- Create database
CREATE DATABASE IF NOT EXISTS supremephp;
USE supremephp;

-- Products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price VARCHAR(50) NOT NULL,
    image VARCHAR(255),
    description TEXT,
    category VARCHAR(50)
);

-- Insert sample products (based on your products.php)
INSERT INTO products (name, price, image, description, category) VALUES
('Rayon Embroidery Thread', '₹899', 'https://images.unsplash.com/photo-1511367461989-f85a21fda167?auto=format&fit=crop&w=600&q=80', 'Premium rayon embroidery thread with exceptional luster and color vibrancy for decorative stitches and embroidery.', 'specialty'),
('Core-Spun Thread', '₹749', 'https://images.unsplash.com/photo-1468421870903-4df1664ac249?auto=format&fit=crop&w=600&q=80', 'Polyester core wrapped with cotton for strength and softness. Ideal for garments requiring both durability and comfort.', 'cotton'),
('Technical Thread', '₹1,199', 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=600&q=80', 'Specially developed for industrial applications with flame retardance and superior durability for demanding environments.', 'specialty'),
('Premium Cotton Thread', '₹649', 'https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=600&q=80', '100% long-staple cotton thread with a silky finish, perfect for quilting and fine fabric sewing projects.', 'cotton'),
('Mercerized Cotton Thread', '₹799', 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=80', 'Treated cotton with enhanced luster and strength. Perfect for decorative topstitching and embroidery work.', 'cotton'),
('All-Purpose Polyester Thread', '₹549', 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=600&q=80', 'Versatile thread offering strength and durability for many applications, including general sewing and mending.', 'polyester'),
('Heavy-Duty Polyester Thread', '₹949', 'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=600&q=80', 'Engineered for maximum strength—perfect for upholstery, outdoor applications, and heavy materials.', 'polyester'),
('Standard Nylon Thread', '₹699', 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=80', 'Excellent elasticity and strength for stretchy fabrics and leather goods. Resists abrasion effectively.', 'nylon'),
('Bonded Nylon Thread', '₹849', 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=80', 'Treated with resins for increased strength and abrasion resistance. Ideal for heavy-duty applications.', 'nylon');

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    product_name VARCHAR(255) NOT NULL,
    product_price VARCHAR(50) NOT NULL,
    product_image VARCHAR(255),
    product_description TEXT,
    customer_name VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Insert dummy orders
INSERT INTO orders (product_id, product_name, product_price, product_image, product_description, customer_name, address, phone, email, status)
VALUES
(1, 'Rayon Embroidery Thread', '₹899', 'https://images.unsplash.com/photo-1511367461989-f85a21fda167?auto=format&fit=crop&w=600&q=80', 'Premium rayon embroidery thread with exceptional luster and color vibrancy for decorative stitches and embroidery.', 'John Doe', '123 Main St, Mumbai', '9876543210', 'john@example.com', 'Pending'),
(3, 'Technical Thread', '₹1,199', 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=600&q=80', 'Specially developed for industrial applications with flame retardance and superior durability for demanding environments.', 'Jane Smith', '456 Park Ave, Delhi', '9123456789', 'jane@example.com', 'COD'),
(5, 'Mercerized Cotton Thread', '₹799', 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=80', 'Treated cotton with enhanced luster and strength. Perfect for decorative topstitching and embroidery work.', 'Amit Kumar', '789 Business Rd, Bangalore', '9988776655', 'amit@example.com', 'Delivered');

-- Admin table (optional, for login)
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert dummy admin
INSERT INTO admin (username, password) VALUES
('admin', MD5('admin123'));

-- Users table for registration/login
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert dummy user
INSERT INTO users (name, email, password) VALUES
('Test User', 'user@example.com', MD5('user123'));
