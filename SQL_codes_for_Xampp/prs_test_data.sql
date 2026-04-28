
USE prs_database;

-- Insert roles
INSERT INTO Roles (role_name) VALUES 
('Public'),
('Merchant'),
('GovernmentOfficial');

-- Insert users
INSERT INTO Users (role_id, username, password_hash, email, national_id, prs_id)
VALUES
(1, 'user1', SHA2('password123', 256), 'user1@example.com', 'GR12345678', UUID()),
(2, 'merchant1', SHA2('merchantpass', 256), 'merchant1@example.com', 'GR87654321', UUID()),
(3, 'gov1', SHA2('securepass', 256), 'gov1@example.com', 'GR11223344', UUID());

-- Insert vaccination records
INSERT INTO Vaccination_Records (user_id, vaccine_type, dose_number, vaccination_date, vaccination_center, region)
VALUES
(1, 'Pfizer', 1, '2024-01-15', 'Health Center A', 'Athens'),
(1, 'Pfizer', 2, '2024-02-15', 'Health Center A', 'Athens');

-- Insert documents
INSERT INTO Documents (user_id, document_type, document_path)
VALUES
(1, 'PDF', '/uploads/vaccine_cert_user1.pdf'),
(2, 'Image', '/uploads/business_license_merchant1.jpg');

-- Insert audit logs
INSERT INTO Audit_Logs (user_id, action, ip_address)
VALUES
(1, 'Logged in', '192.168.1.100'),
(2, 'Updated stock info', '192.168.1.101'),
(3, 'Viewed vaccination data', '192.168.1.102');

-- Insert encryption keys
INSERT INTO Encryption_Keys (user_id, key_label, encryption_key)
VALUES
(1, 'User1Key', 'EncryptedKey123456'),
(3, 'GovKey', 'GovSecureKey7890');
