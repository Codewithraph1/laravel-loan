CREATE TABLE users (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    phone VARCHAR(20) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- hashed password
    address TEXT,
    city VARCHAR(100),
    state VARCHAR(100),
    country VARCHAR(100),
    date_of_birth DATE,
    occupation VARCHAR(100),

    -- Financial info
    account_number VARCHAR(20) UNIQUE,
    balance DECIMAL(15,2) DEFAULT 0.00,
    annual_income DECIMAL(15,2),
    credit_score INT DEFAULT 0, -- can help loan approval

    -- Security
    two_fa_pin VARCHAR(10), -- for extra login or transfer verification
    profile_image VARCHAR(255), -- store image path

    -- Loan-related
    is_verified BOOLEAN DEFAULT FALSE, -- for KYC approval
    status ENUM('active','suspended','closed') DEFAULT 'active',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE loan_repayments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    loan_id BIGINT UNSIGNED NOT NULL,
    installment_number INT NOT NULL,
    amount_due DECIMAL(15,2) NOT NULL,
    amount_paid DECIMAL(15,2) DEFAULT 0.00,
    due_date DATE NOT NULL,
    paid_date DATE NULL,
    status ENUM('pending', 'paid', 'overdue', 'partial') DEFAULT 'pending',
    payment_method VARCHAR(50) NULL,
    transaction_reference VARCHAR(100) NULL,
    
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    -- Foreign Key Constraint
    FOREIGN KEY (loan_id) REFERENCES loans(id) ON DELETE CASCADE,
    
    -- Indexes for Performance
    INDEX idx_repayments_loan_id (loan_id),
    INDEX idx_repayments_due_date (due_date),
    INDEX idx_repayments_status (status),
    INDEX idx_repayments_paid_date (paid_date),
    
    -- Unique constraint to prevent duplicate installments
    UNIQUE KEY unique_loan_installment (loan_id, installment_number)
);



CREATE TABLE loans (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    
    -- Loan Details
    loan_amount DECIMAL(15,2) NOT NULL,
    interest_rate DECIMAL(5,2) DEFAULT 0.00,
    total_amount DECIMAL(15,2) DEFAULT 0.00,
    tenure_months INT NOT NULL,
    monthly_repayment DECIMAL(15,2) DEFAULT 0.00,
    
    -- Application Details
    purpose TEXT NOT NULL,
    house_address TEXT NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    
    -- Next of Kin
    next_of_kin_fullname VARCHAR(100) NOT NULL,
    next_of_kin_relationship VARCHAR(50) NOT NULL,
    next_of_kin_phone VARCHAR(20) NOT NULL,
    next_of_kin_address TEXT NOT NULL,
    
    -- Bank Details for Disbursement
    bank_name VARCHAR(100) NOT NULL,
    account_number VARCHAR(20) NOT NULL,
    account_name VARCHAR(100) NOT NULL,
    
    -- Identification
    valid_id_type VARCHAR(50) NOT NULL,
    valid_id_number VARCHAR(50) NOT NULL,
    valid_id_path VARCHAR(255) NOT NULL,
    
    -- Status and Tracking
    status ENUM(
        'pending', 
        'under_review', 
        'approved', 
        'rejected', 
        'disbursed', 
        'active', 
        'completed', 
        'defaulted'
    ) DEFAULT 'pending',
    
    admin_notes TEXT NULL,
    rejection_reason TEXT NULL,
    
    -- Dates
    application_date DATE NOT NULL,
    approval_date DATE NULL,
    disbursement_date DATE NULL,
    due_date DATE NULL,
    
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    -- Foreign Key Constraint
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    
    -- Indexes for Performance
    INDEX idx_loans_user_id (user_id),
    INDEX idx_loans_status (status),
    INDEX idx_loans_application_date (application_date),
    INDEX idx_loans_due_date (due_date)
);