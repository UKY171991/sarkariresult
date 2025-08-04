-- SQLite Database setup for Sarkari Result website
-- Run this SQL script to create the database structure

-- Jobs table
CREATE TABLE IF NOT EXISTS jobs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    organization TEXT NOT NULL,
    category TEXT NOT NULL,
    posts INTEGER DEFAULT 1,
    qualification TEXT,
    state TEXT,
    last_date DATE,
    apply_link TEXT,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT DEFAULT 'active' CHECK(status IN ('active', 'inactive', 'expired'))
);

-- Results table
CREATE TABLE IF NOT EXISTS results (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    organization TEXT NOT NULL,
    category TEXT NOT NULL,
    result_type TEXT DEFAULT 'final' CHECK(result_type IN ('final', 'preliminary', 'merit_list', 'cutoff')),
    result_date DATE,
    pdf_link TEXT,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT DEFAULT 'active' CHECK(status IN ('active', 'inactive'))
);

-- Admit Cards table
CREATE TABLE IF NOT EXISTS admit_cards (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    organization TEXT NOT NULL,
    category TEXT NOT NULL,
    exam_date DATE,
    available_from DATE,
    download_link TEXT,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT DEFAULT 'coming_soon' CHECK(status IN ('available', 'coming_soon', 'expired'))
);

-- Answer Keys table
CREATE TABLE IF NOT EXISTS answer_keys (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    organization TEXT NOT NULL,
    category TEXT NOT NULL,
    exam_date DATE,
    published_date DATE,
    pdf_link TEXT,
    objection_link TEXT,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT DEFAULT 'active' CHECK(status IN ('active', 'inactive'))
);

-- Admissions table
CREATE TABLE IF NOT EXISTS admissions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    organization TEXT NOT NULL,
    category TEXT NOT NULL,
    level TEXT DEFAULT 'undergraduate' CHECK(level IN ('school', 'undergraduate', 'postgraduate', 'diploma', 'certificate')),
    state TEXT,
    last_date DATE,
    apply_link TEXT,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT DEFAULT 'active' CHECK(status IN ('active', 'inactive', 'expired'))
);

-- Syllabus table
CREATE TABLE IF NOT EXISTS syllabus (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    organization TEXT NOT NULL,
    category TEXT NOT NULL,
    exam_type TEXT,
    pdf_link TEXT,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT DEFAULT 'active' CHECK(status IN ('active', 'inactive'))
);

-- Contact Messages table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    phone TEXT,
    subject TEXT NOT NULL,
    message TEXT NOT NULL,
    ip_address TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT DEFAULT 'new' CHECK(status IN ('new', 'read', 'replied'))
);

-- Newsletter Subscriptions table
CREATE TABLE IF NOT EXISTS newsletter_subscriptions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT UNIQUE NOT NULL,
    ip_address TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT DEFAULT 'active' CHECK(status IN ('active', 'inactive'))
);

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    slug TEXT UNIQUE NOT NULL,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    status TEXT DEFAULT 'active' CHECK(status IN ('active', 'inactive'))
);

-- Users table (for admin panel)
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role TEXT DEFAULT 'editor' CHECK(role IN ('admin', 'editor')),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    last_login DATETIME,
    status TEXT DEFAULT 'active' CHECK(status IN ('active', 'inactive'))
);

-- Site Settings table
CREATE TABLE IF NOT EXISTS site_settings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    setting_key TEXT UNIQUE NOT NULL,
    setting_value TEXT,
    description TEXT,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create indexes for better performance
CREATE INDEX IF NOT EXISTS idx_jobs_category ON jobs(category);
CREATE INDEX IF NOT EXISTS idx_jobs_state ON jobs(state);
CREATE INDEX IF NOT EXISTS idx_jobs_status ON jobs(status);
CREATE INDEX IF NOT EXISTS idx_jobs_last_date ON jobs(last_date);

CREATE INDEX IF NOT EXISTS idx_results_category ON results(category);
CREATE INDEX IF NOT EXISTS idx_results_organization ON results(organization);
CREATE INDEX IF NOT EXISTS idx_results_result_date ON results(result_date);

CREATE INDEX IF NOT EXISTS idx_admit_cards_category ON admit_cards(category);
CREATE INDEX IF NOT EXISTS idx_admit_cards_exam_date ON admit_cards(exam_date);
CREATE INDEX IF NOT EXISTS idx_admit_cards_status ON admit_cards(status);

CREATE INDEX IF NOT EXISTS idx_contact_status ON contact_messages(status);
CREATE INDEX IF NOT EXISTS idx_contact_created ON contact_messages(created_at);

CREATE INDEX IF NOT EXISTS idx_newsletter_email ON newsletter_subscriptions(email);
CREATE INDEX IF NOT EXISTS idx_newsletter_status ON newsletter_subscriptions(status);

-- Insert sample data
INSERT OR IGNORE INTO categories (name, slug, description) VALUES
('Railway Jobs', 'railway', 'Railway recruitment board jobs'),
('SSC Jobs', 'ssc', 'Staff Selection Commission jobs'),
('Banking Jobs', 'banking', 'Bank recruitment jobs'),
('UPSC Jobs', 'upsc', 'Union Public Service Commission jobs'),
('State Government Jobs', 'state-govt', 'State government recruitment'),
('Police Jobs', 'police', 'Police recruitment jobs'),
('Teaching Jobs', 'teaching', 'Teaching and education jobs'),
('Defense Jobs', 'defense', 'Defense and military jobs');

INSERT OR IGNORE INTO site_settings (setting_key, setting_value, description) VALUES
('site_name', 'Sarkari Result', 'Website name'),
('site_description', 'Find Latest Sarkari Job Vacancies And Sarkari Exam Results', 'Website description'),
('site_email', 'info@sarkariresult.com.cm', 'Contact email'),
('site_phone', '+91-XXXXXXXXXX', 'Contact phone'),
('whatsapp_number', '+91XXXXXXXXXX', 'WhatsApp number'),
('telegram_link', 'https://t.me/sarkariresult', 'Telegram channel link'),
('facebook_link', 'https://facebook.com/sarkariresult', 'Facebook page link'),
('twitter_link', 'https://twitter.com/sarkariresult', 'Twitter profile link');

-- Sample admin user (password: admin123)
-- Password hash for 'admin123': $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
INSERT OR IGNORE INTO users (username, email, password, role) VALUES
('admin', 'admin@sarkariresult.com.cm', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Sample job data
INSERT OR IGNORE INTO jobs (title, organization, category, posts, qualification, state, last_date, description) VALUES
('BSF Constable (Tradesman)', 'Border Security Force', 'defense', 3588, '10th Pass', 'All India', '2025-08-15', 'BSF recruitment for Constable Tradesman posts in various trades'),
('RRB Technician', 'Railway Recruitment Board', 'railway', 6238, 'ITI + 10th', 'All India', '2025-08-20', 'Railway recruitment for Technician posts'),
('IB ACIO Grade-II', 'Intelligence Bureau', 'central-govt', 3717, 'Graduate', 'All India', '2025-08-12', 'Intelligence Bureau recruitment for Assistant Central Intelligence Officer'),
('Bihar Police Constable', 'Bihar Police', 'police', 4361, '12th Pass', 'Bihar', '2025-08-08', 'Bihar Police recruitment for Constable Driver posts'),
('Indian Navy SSC Officer', 'Indian Navy', 'defense', 150, 'Graduate', 'All India', '2025-08-25', 'Indian Navy Short Service Commission Officer recruitment'),
('IBPS Clerk XV', 'Institute of Banking Personnel Selection', 'banking', 10277, 'Graduate', 'All India', '2025-09-10', 'IBPS Clerk 15th recruitment for Clerical Cadre posts');

-- Sample result data
INSERT OR IGNORE INTO results (title, organization, category, result_type, result_date, description) VALUES
('Railway SECR Raipur Apprentice Final Merit List 2025', 'South East Central Railway', 'railway', 'merit_list', '2025-08-04', 'Final merit list for SECR Raipur Apprentice recruitment'),
('UPSSSC Junior Assistant Final Result 2025', 'UPSSSC', 'state-govt', 'final', '2025-08-04', 'Final result for Junior Assistant posts under advertisement 08/2022'),
('CBSE Class 12th Supplementary Result 2025', 'CBSE', 'board', 'final', '2025-08-03', 'CBSE Board Class 12 supplementary examination result'),
('Bihar ITI CAT 2025 1st Round Allotment Result', 'Bihar ITI', 'technical', 'merit_list', '2025-08-03', 'First round seat allotment for Bihar ITI Common Admission Test'),
('IBPS Clerk 14 Reserve List 2025', 'IBPS', 'banking', 'merit_list', '2025-08-02', 'Reserve list for IBPS Clerk XIV recruitment');

-- Sample admit card data
INSERT OR IGNORE INTO admit_cards (title, organization, category, exam_date, available_from, description, status) VALUES
('SSC Stenographer Admit Card 2025', 'Staff Selection Commission', 'ssc', '2025-08-15', '2025-08-04', 'Admit card for SSC Stenographer Grade C & D examination', 'available'),
('Railway RRB NTPC Admit Card 2025', 'Railway Recruitment Board', 'railway', '2025-08-22', '2025-08-04', 'Admit card for RRB NTPC 10+2 level examination', 'available'),
('Bihar Police Constable Admit Card 2025', 'Bihar Police', 'police', '2025-08-25', '2025-08-12', 'Admit card for Bihar Police Constable Driver examination', 'coming_soon'),
('DSSSB Assistant Teacher Admit Card 2025', 'DSSSB', 'teaching', '2025-08-18', '2025-08-04', 'Admit card for DSSSB Assistant Teacher posts', 'available'),
('NEET PG Admit Card 2025', 'NTA', 'medical', '2025-08-30', '2025-08-10', 'Admit card for NEET PG entrance examination', 'coming_soon');

-- Sample answer key data
INSERT OR IGNORE INTO answer_keys (title, organization, category, exam_date, published_date, description) VALUES
('NTA CSIR UGC NET June Answer Key 2025', 'National Testing Agency', 'research', '2025-07-25', '2025-08-04', 'Official answer key for CSIR UGC NET June 2025 examination'),
('Haryana TET 2024 Answer Key', 'Haryana Board of Education', 'teaching', '2025-07-20', '2025-08-03', 'Answer key for Haryana Teacher Eligibility Test 2024'),
('Bihar BSPHCL Answer Key 2025', 'Bihar State Power Holding Company', 'state-govt', '2025-07-28', '2025-08-03', 'Answer key for BSPHCL Computer Centre and Store Assistant posts'),
('UPPSC RO/ARO Pre Answer Key 2025', 'Uttar Pradesh Public Service Commission', 'state-govt', '2025-07-30', '2025-08-02', 'Preliminary examination answer key for Review Officer posts'),
('Bihar BTSC Dresser Answer Key 2025', 'Bihar Technical Service Commission', 'medical', '2025-07-22', '2025-08-02', 'Answer key for BTSC Dresser posts recruitment');

-- Sample admission data
INSERT OR IGNORE INTO admissions (title, organization, category, level, state, last_date, description) VALUES
('OFSS Bihar 11th Intermediate Spot Admission 2025-27', 'OFSS Bihar', 'school', 'school', 'Bihar', '2025-08-10', 'Spot admission for Class 11th Intermediate in Bihar'),
('IIM CAT 2025 Admission', 'Indian Institute of Management', 'management', 'postgraduate', 'All India', '2025-09-20', 'Common Admission Test for MBA programs in IIMs'),
('CLAT 2026 Admission', 'National Law School', 'law', 'undergraduate', 'All India', '2025-11-15', 'Common Law Admission Test for law programs'),
('NVS Class 6 Admission 2026', 'Navodaya Vidyalaya Samiti', 'school', 'school', 'All India', '2025-08-25', 'Lateral entry test for Class 6 in Navodaya Vidyalayas'),
('Bihar CET B.Ed 2025', 'Bihar CET Board', 'education', 'postgraduate', 'Bihar', '2025-08-30', 'Combined Entrance Test for B.Ed admission in Bihar');

-- Update triggers for updated_at columns
CREATE TRIGGER IF NOT EXISTS update_jobs_timestamp 
    AFTER UPDATE ON jobs
    FOR EACH ROW
    BEGIN
        UPDATE jobs SET updated_at = CURRENT_TIMESTAMP WHERE id = NEW.id;
    END;

CREATE TRIGGER IF NOT EXISTS update_results_timestamp 
    AFTER UPDATE ON results
    FOR EACH ROW
    BEGIN
        UPDATE results SET updated_at = CURRENT_TIMESTAMP WHERE id = NEW.id;
    END;

CREATE TRIGGER IF NOT EXISTS update_admit_cards_timestamp 
    AFTER UPDATE ON admit_cards
    FOR EACH ROW
    BEGIN
        UPDATE admit_cards SET updated_at = CURRENT_TIMESTAMP WHERE id = NEW.id;
    END;

CREATE TRIGGER IF NOT EXISTS update_answer_keys_timestamp 
    AFTER UPDATE ON answer_keys
    FOR EACH ROW
    BEGIN
        UPDATE answer_keys SET updated_at = CURRENT_TIMESTAMP WHERE id = NEW.id;
    END;

CREATE TRIGGER IF NOT EXISTS update_admissions_timestamp 
    AFTER UPDATE ON admissions
    FOR EACH ROW
    BEGIN
        UPDATE admissions SET updated_at = CURRENT_TIMESTAMP WHERE id = NEW.id;
    END;

CREATE TRIGGER IF NOT EXISTS update_syllabus_timestamp 
    AFTER UPDATE ON syllabus
    FOR EACH ROW
    BEGIN
        UPDATE syllabus SET updated_at = CURRENT_TIMESTAMP WHERE id = NEW.id;
    END;

CREATE TRIGGER IF NOT EXISTS update_site_settings_timestamp 
    AFTER UPDATE ON site_settings
    FOR EACH ROW
    BEGIN
        UPDATE site_settings SET updated_at = CURRENT_TIMESTAMP WHERE id = NEW.id;
    END;
