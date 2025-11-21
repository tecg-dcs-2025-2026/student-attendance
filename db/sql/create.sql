DROP TABLE IF EXISTS attendances;
DROP TABLE IF EXISTS session_group;
DROP TABLE IF EXISTS `groups`;
DROP TABLE IF EXISTS sessions;
DROP TABLE IF EXISTS classrooms;
DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS aa_teacher;
DROP TABLE IF EXISTS aas;
DROP TABLE IF EXISTS ues;
DROP TABLE IF EXISTS teachers;
DROP TABLE IF EXISTS school_years;

CREATE TABLE IF NOT EXISTS school_years
(
    name       VARCHAR(50) NOT NULL,
    starts_at  DATE        NULL,
    ends_at    DATE        NULL,
    created_at TIMESTAMP   NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP   NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP   NULL DEFAULT NULL,
    PRIMARY KEY (name)
);

CREATE TABLE IF NOT EXISTS teachers
(
    id         VARCHAR(50)  NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name  VARCHAR(100) NOT NULL,
    email      VARCHAR(150) NULL,
    phone      VARCHAR(30)  NULL,
    created_at TIMESTAMP    NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP    NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP    NULL DEFAULT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS ues
(
    code                   VARCHAR(50)  NOT NULL,
    school_year_name       VARCHAR(50)  NOT NULL,
    credits                tinyint      NOT NULL CHECK ( credits <= 60 ),
    title                  VARCHAR(255) NOT NULL,
    description            TEXT         NULL,
    responsible_teacher_id VARCHAR(50)  NOT NULL,
    created_at             TIMESTAMP    NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at             TIMESTAMP    NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at             TIMESTAMP    NULL DEFAULT NULL,
    PRIMARY KEY (code),
    UNIQUE uq_ues_code_school_year (school_year_name, code),
    CONSTRAINT fk_ues_school_years FOREIGN KEY (school_year_name) REFERENCES school_years (name) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_ues_responsible_teacher FOREIGN KEY (responsible_teacher_id) REFERENCES teachers (id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS aas
(
    code           VARCHAR(50)       NOT NULL,
    ue_code        varchar(50)       NOT NULL,
    title          VARCHAR(255)      NOT NULL,
    hours_per_year SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    quadrimester   TINYINT UNSIGNED  NOT NULL,
    created_at     TIMESTAMP         NULL     DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP         NULL     DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at     TIMESTAMP         NULL     DEFAULT NULL,
    PRIMARY KEY (code),
    UNIQUE uq_aas_ue_code (ue_code, code),
    CONSTRAINT fk_aas_ue FOREIGN KEY (ue_code) REFERENCES ues (code) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS aa_teacher
(
    aa_code    varchar(50) NOT NULL,
    teacher_id varchar(50)     NOT NULL,
    created_at TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP       NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (aa_code),
    UNIQUE (aa_code, teacher_id),
    CONSTRAINT fk_aa_code FOREIGN KEY (aa_code) REFERENCES aas (code) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_aa_teacher FOREIGN KEY (teacher_id) REFERENCES teachers (id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS `groups`
(
    code             VARCHAR(50) NOT NULL,
    school_year_name varchar(50) NOT NULL,
    created_at       TIMESTAMP   NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at       TIMESTAMP   NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at       TIMESTAMP   NULL DEFAULT NULL,
    PRIMARY KEY (code, school_year_name),
    CONSTRAINT fk_groups_school_year FOREIGN KEY (school_year_name) REFERENCES school_years (name) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS classrooms
(
    name       VARCHAR(50) PRIMARY KEY,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE IF NOT EXISTS students
(
    matricule     VARCHAR(100)  NOT NULL,
    first_name    VARCHAR(120)  NOT NULL,
    last_name     VARCHAR(120)  NOT NULL,
    birth_date    DATE               DEFAULT (DATE_SUB(CURRENT_DATE(), INTERVAL 18 YEAR)),
    profile_photo VARCHAR(1024) NULL,
    email         VARCHAR(200)  NOT NULL UNIQUE,
    created_at    TIMESTAMP     NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP     NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at    TIMESTAMP     NULL DEFAULT NULL,
    PRIMARY KEY (matricule)
);



CREATE TABLE IF NOT EXISTS sessions
(
    id         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    aa_code      varchar(50) NOT NULL,
    title      VARCHAR(255)    NULL,
    teacher_id varchar(50)     NOT NULL,
    starts_at  DATETIME        NOT NULL,
    ends_at    DATETIME        NULL,
    classroom  VARCHAR(50)     NULL,
    created_at TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP       NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP       NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT uq_sessions UNIQUE (aa_code, teacher_id, classroom, starts_at),
    CONSTRAINT fk_classroom FOREIGN KEY (classroom) REFERENCES classrooms (name) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_st_teacher FOREIGN KEY (teacher_id) REFERENCES teachers (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_sessions_aa FOREIGN KEY (aa_code) REFERENCES aas (code) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS session_group
(
    session_id BIGINT UNSIGNED NOT NULL,
    group_code VARCHAR(50)     NOT NULL,
    created_at TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP       NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP       NULL DEFAULT NULL,
    PRIMARY KEY (session_id, group_code),
    CONSTRAINT fk_sg_session FOREIGN KEY (session_id) REFERENCES sessions (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_sg_group FOREIGN KEY (group_code) REFERENCES `groups` (code) ON DELETE CASCADE ON UPDATE CASCADE
);



CREATE TABLE IF NOT EXISTS attendances
(
    id                BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    session_id        BIGINT UNSIGNED NOT NULL,
    student_matricule varchar(100)    NOT NULL,
    is_present        BOOLEAN         NOT NULL DEFAULT FALSE,
    checked_at        DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    note              TEXT            NULL,
    created_at        TIMESTAMP       NULL     DEFAULT CURRENT_TIMESTAMP,
    updated_at        TIMESTAMP       NULL     DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at        TIMESTAMP       NULL     DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE uq_attendances_session_student (session_id, student_matricule),
    CONSTRAINT fk_attendances_session FOREIGN KEY (session_id) REFERENCES sessions (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_attendances_student FOREIGN KEY (student_matricule) REFERENCES students (matricule) ON DELETE CASCADE ON UPDATE CASCADE
);
