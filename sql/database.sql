CREATE DATABASE IF NOT EXISTS business_rating_system;
USE business_rating_system;

-- ----------------------------
-- Businesses Table
-- ----------------------------
CREATE TABLE businesses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ----------------------------
-- Ratings Table
-- ----------------------------
CREATE TABLE ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    business_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    rating DECIMAL(2,1) NOT NULL CHECK (rating BETWEEN 0 AND 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_business
        FOREIGN KEY (business_id)
        REFERENCES businesses(id)
        ON DELETE CASCADE,

    -- Enforces Rule: Email OR Phone uniqueness per business
    UNIQUE KEY unique_user_rating (business_id, email, phone)
);

-- ----------------------------
-- Performance Index
-- ----------------------------
CREATE INDEX idx_business_rating ON ratings (business_id);
