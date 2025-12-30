Akses Prototype UIUX Soal no.1 dibawah ini :
https://www.figma.com/design/Nl6bZN7FAE28AUhG5WWYPu/Task-Magang-TATI?node-id=1-2&t=hglU18HjEj5sPjdi-1 

Link Linkedin Tria Yunita Krismiyanto :
https://www.linkedin.com/in/tria-yunita-krismiyanto/ 

Link Github Tria Yunita Krismiyanto :
https://github.com/Triayunitak/Test-ProgrammerTATI-Tria_Yunita_Krismiyanto\

(Pastikan kamu sudah membuat database kosong bernama log_pegawai di phpMyAdmin)



databasenya ga kosong, sudah aku isi ini

tabel users:

CREATE TABLE users (

    id_user BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    user_name VARCHAR(100) NOT NULL,

    email_user VARCHAR(150) NOT NULL UNIQUE,

    user_password VARCHAR(255) NOT NULL,

    role ENUM('staff', 'kepala_bidang', 'kepala_dinas') NOT NULL,

    supervisor_id BIGINT UNSIGNED NULL,

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_supervisor

        FOREIGN KEY (supervisor_id) REFERENCES users(id_user)

        ON DELETE SET NULL

);



table daily_logs

CREATE TABLE daily_logs (

    id_logs BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    user_id BIGINT UNSIGNED NOT NULL,

    log_date DATE NOT NULL,

    activity_summary TEXT NOT NULL,

    status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',

    verified_by BIGINT UNSIGNED NULL,

    verification_note TEXT NULL,

    verified_at TIMESTAMP NULL,

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,



    CONSTRAINT fk_log_user

        FOREIGN KEY (user_id) REFERENCES users(id_user)

        ON DELETE CASCADE,



    CONSTRAINT fk_verified_by

        FOREIGN KEY (verified_by) REFERENCES users(id_user)

        ON DELETE SET NULL,



    CONSTRAINT uq_user_log_per_day

        UNIQUE (user_id, log_date)

);



usernya ada 5:

INSERT INTO users 

(id_user, user_name, email_user, user_password, role, supervisor_id, created_at, updated_at)

VALUES

-- Kepala Dinas

(1, 'Kepala Dinas', 'kadis@example.com', 'password', 'kepala_dinas', NULL, NOW(), NOW()),



-- Kepala Bidang

(2, 'Kepala Bidang 1', 'kabid1@example.com', 'password', 'kepala_bidang', 1, NOW(), NOW()),

(3, 'Kepala Bidang 2', 'kabid2@example.com', 'password', 'kepala_bidang', 1, NOW(), NOW()),



-- Staff

(4, 'Staff 1', 'staff1@example.com', 'password', 'staff', 2, NOW(), NOW()),

(5, 'Staff 2', 'staff2@example.com', 'password', 'staff', 3, NOW(), NOW());



Constraint 1 log per user per hari, UNIQUE composite index

ALTER TABLE daily_logs

ADD UNIQUE KEY uniq_user_log_date (user_id, log_date);

