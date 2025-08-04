-- Database setup for Sarkari Result website
-- Run this SQL script to create the database structure

CREATE DATABASE IF NOT EXISTS sarkariresult;
USE sarkariresult;

-- Jobs table
CREATE TABLE jobs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    organization VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    posts INT DEFAULT 1,
    qualification VARCHAR(100),
    state VARCHAR(50),
    last_date DATE,
    apply_link TEXT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive', 'expired') DEFAULT 'active'
);

-- Results table
CREATE TABLE results (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    organization VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    result_type ENUM('final', 'preliminary', 'merit_list', 'cutoff') DEFAULT 'final',
    result_date DATE,
    pdf_link TEXT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Admit Cards table
CREATE TABLE admit_cards (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    organization VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    exam_date DATE,
    available_from DATE,
    download_link TEXT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('available', 'coming_soon', 'expired') DEFAULT 'coming_soon'
);

-- Answer Keys table
CREATE TABLE answer_keys (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    organization VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    exam_date DATE,
    published_date DATE,
    pdf_link TEXT,
    objection_link TEXT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Admissions table
CREATE TABLE admissions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    organization VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    level ENUM('school', 'undergraduate', 'postgraduate', 'diploma', 'certificate') DEFAULT 'undergraduate',
    state VARCHAR(50),
    last_date DATE,
    apply_link TEXT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive', 'expired') DEFAULT 'active'
);

-- Syllabus table
CREATE TABLE syllabus (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    organization VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    exam_type VARCHAR(100),
    pdf_link TEXT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Contact Messages table
CREATE TABLE contact_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new', 'read', 'replied') DEFAULT 'new'
);

-- Newsletter Subscriptions table
CREATE TABLE newsletter_subscriptions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Categories table
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Users table (for admin panel)
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor') DEFAULT 'editor',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Site Settings table
CREATE TABLE site_settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    description TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO categories (name, slug, description) VALUES
('Railway Jobs', 'railway', 'Railway recruitment board jobs'),
('SSC Jobs', 'ssc', 'Staff Selection Commission jobs'),
('Banking Jobs', 'banking', 'Bank recruitment jobs'),
('UPSC Jobs', 'upsc', 'Union Public Service Commission jobs'),
('State Government Jobs', 'state-govt', 'State government recruitment'),
('Police Jobs', 'police', 'Police recruitment jobs'),
('Teaching Jobs', 'teaching', 'Teaching and education jobs'),
('Defense Jobs', 'defense', 'Defense and military jobs');

INSERT INTO site_settings (setting_key, setting_value, description) VALUES
('site_name', 'Sarkari Result', 'Website name'),
('site_description', 'Find Latest Sarkari Job Vacancies And Sarkari Exam Results', 'Website description'),
('site_email', 'info@sarkariresult.com.cm', 'Contact email'),
('site_phone', '+91-XXXXXXXXXX', 'Contact phone'),
('whatsapp_number', '+91XXXXXXXXXX', 'WhatsApp number'),
('telegram_link', 'https://t.me/sarkariresult', 'Telegram channel link'),
('facebook_link', 'https://facebook.com/sarkariresult', 'Facebook page link'),
('twitter_link', 'https://twitter.com/sarkariresult', 'Twitter profile link');

-- Sample admin user (password: admin123)
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@sarkariresult.com.cm', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Sample job data
INSERT INTO jobs (title, organization, category, posts, qualification, state, last_date, description) VALUES
('BSF Constable (Tradesman)', 'Border Security Force', 'defense', 3588, '10th Pass', 'All India', '2025-08-15', 'BSF recruitment for Constable Tradesman posts in various trades'),
('RRB Technician', 'Railway Recruitment Board', 'railway', 6238, 'ITI + 10th', 'All India', '2025-08-20', 'Railway recruitment for Technician posts'),
('IB ACIO Grade-II', 'Intelligence Bureau', 'central-govt', 3717, 'Graduate', 'All India', '2025-08-12', 'Intelligence Bureau recruitment for Assistant Central Intelligence Officer'),
('Bihar Police Constable', 'Bihar Police', 'police', 4361, '12th Pass', 'Bihar', '2025-08-08', 'Bihar Police recruitment for Constable Driver posts');

-- Sample result data
INSERT INTO results (title, organization, category, result_type, result_date, description) VALUES
('Railway SECR Raipur Apprentice Final Merit List 2025', 'South East Central Railway', 'railway', 'merit_list', '2025-08-04', 'Final merit list for SECR Raipur Apprentice recruitment'),
('UPSSSC Junior Assistant Final Result 2025', 'UPSSSC', 'state-govt', 'final', '2025-08-04', 'Final result for Junior Assistant posts'),
('CBSE Class 12th Supplementary Result 2025', 'CBSE', 'board', 'final', '2025-08-03', 'CBSE Board Class 12 supplementary examination result');

-- Sample admit card data
INSERT INTO admit_cards (title, organization, category, exam_date, available_from, description, status) VALUES
('SSC Stenographer Admit Card 2025', 'Staff Selection Commission', 'ssc', '2025-08-15', '2025-08-04', 'Admit card for SSC Stenographer Grade C & D examination', 'available'),
('Railway RRB NTPC Admit Card 2025', 'Railway Recruitment Board', 'railway', '2025-08-22', '2025-08-04', 'Admit card for RRB NTPC 10+2 level examination', 'available'),
('Bihar Police Constable Admit Card 2025', 'Bihar Police', 'police', '2025-08-25', '2025-08-12', 'Admit card for Bihar Police Constable examination', 'coming_soon');

-- Indexes for better performance
CREATE INDEX idx_jobs_category ON jobs(category);
CREATE INDEX idx_jobs_state ON jobs(state);
CREATE INDEX idx_jobs_status ON jobs(status);
CREATE INDEX idx_jobs_last_date ON jobs(last_date);

CREATE INDEX idx_results_category ON results(category);
CREATE INDEX idx_results_organization ON results(organization);
CREATE INDEX idx_results_result_date ON results(result_date);

CREATE INDEX idx_admit_cards_category ON admit_cards(category);
CREATE INDEX idx_admit_cards_exam_date ON admit_cards(exam_date);
CREATE INDEX idx_admit_cards_status ON admit_cards(status);

CREATE INDEX idx_contact_status ON contact_messages(status);
CREATE INDEX idx_contact_created ON contact_messages(created_at);

CREATE INDEX idx_newsletter_email ON newsletter_subscriptions(email);
CREATE INDEX idx_newsletter_status ON newsletter_subscriptions(status);
