DROP TABLE IF EXISTS attendances;
DROP TABLE IF EXISTS student_group;
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
    name            VARCHAR(50) NOT NULL,
    starts_at       DATE        NULL,
    ends_at         DATE        NULL,
    is_current_year boolean          DEFAULT FALSE,
    created_at      TIMESTAMP   NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP   NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at      TIMESTAMP   NULL DEFAULT NULL,
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

# On n'autorise qu'un seul prof responsable.
CREATE TABLE IF NOT EXISTS ues
(
    code                   VARCHAR(50)      NOT NULL,
    school_year            VARCHAR(50)      NOT NULL,
    credits                tinyint unsigned NOT NULL CHECK ( credits <= 60 ),
    title                  VARCHAR(255)     NOT NULL,
    description            TEXT             NULL,
    responsible_teacher_id VARCHAR(50)      NOT NULL,
    created_at             TIMESTAMP        NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at             TIMESTAMP        NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at             TIMESTAMP        NULL DEFAULT NULL,
    PRIMARY KEY (school_year, code),
    CONSTRAINT fk_ues_school_years FOREIGN KEY (school_year) REFERENCES school_years (name) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_ues_responsible_teacher FOREIGN KEY (responsible_teacher_id) REFERENCES teachers (id) ON DELETE RESTRICT ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS aas
(
    code           VARCHAR(50)       NOT NULL,
    ue_code        VARCHAR(50)       NOT NULL,
    school_year    VARCHAR(50)       NOT NULL,
    title          VARCHAR(255)      NOT NULL,
    hours_per_year SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    quadrimester   TINYINT UNSIGNED  NOT NULL,
    created_at     TIMESTAMP         NULL     DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP         NULL     DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at     TIMESTAMP         NULL     DEFAULT NULL,
    PRIMARY KEY (code, ue_code, school_year),
    CONSTRAINT fk_aas_ue FOREIGN KEY (school_year, ue_code) REFERENCES ues (school_year, code) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS aa_teacher
(
    aa_code     VARCHAR(50) NOT NULL,
    school_year VARCHAR(50) NOT NULL,
    teacher_id  VARCHAR(50) NOT NULL,
    ue_code     VARCHAR(50) NOT NULL,
    created_at  TIMESTAMP   NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP   NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (teacher_id, aa_code, school_year, ue_code),
    CONSTRAINT fk_aa_code FOREIGN KEY (aa_code, ue_code, school_year) REFERENCES aas (code, ue_code, school_year) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_aa_teacher FOREIGN KEY (teacher_id) REFERENCES teachers (id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS `groups`
(
    code        VARCHAR(50) NOT NULL,
    school_year VARCHAR(50) NOT NULL,
    created_at  TIMESTAMP   NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP   NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at  TIMESTAMP   NULL DEFAULT NULL,
    PRIMARY KEY (code, school_year),
    CONSTRAINT fk_groups_school_year FOREIGN KEY (school_year) REFERENCES school_years (name) ON DELETE RESTRICT ON UPDATE CASCADE
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


# En mettant ici une clé étrangère vers le prof... on n'autorise pas qu'une séance puisse être donnée par plusieurs profs.
# Idem pour le local
CREATE TABLE IF NOT EXISTS sessions
(
    id          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

    aa_code     VARCHAR(50)     NOT NULL,
    ue_code     VARCHAR(50)     NOT NULL,
    school_year VARCHAR(50)     NOT NULL,

    title       VARCHAR(255)    NULL,
    teacher_id  VARCHAR(50)     NOT NULL,
    starts_at   DATETIME        NOT NULL,
    ends_at     DATETIME        NULL,
    classroom   VARCHAR(50)     NOT NULL,
    created_at  TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP       NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at  TIMESTAMP       NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT uq_sessions UNIQUE (aa_code, ue_code, school_year, classroom, starts_at),
    CONSTRAINT fk_sessions_school_years FOREIGN KEY (school_year) REFERENCES school_years (name) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_classroom FOREIGN KEY (classroom) REFERENCES classrooms (name) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_teacher FOREIGN KEY (teacher_id) REFERENCES teachers (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_sessions_aa FOREIGN KEY (aa_code, ue_code, school_year) REFERENCES aas (code, ue_code, school_year) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS session_group
(
    session_id  BIGINT UNSIGNED NOT NULL,
    group_code  VARCHAR(50)     NOT NULL,
    school_year VARCHAR(50)     NOT NULL,
    created_at  TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP       NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at  TIMESTAMP       NULL DEFAULT NULL,
    PRIMARY KEY (session_id, group_code, school_year),
    CONSTRAINT fk_sg_session FOREIGN KEY (session_id) REFERENCES sessions (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_sg_group FOREIGN KEY (group_code, school_year) REFERENCES `groups` (code, school_year) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS student_group
(
    student_matricule VARCHAR(100) NOT NULL,
    group_code        VARCHAR(50)  NOT NULL,
    school_year       VARCHAR(50)  NOT NULL,
    created_at        TIMESTAMP    NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at        TIMESTAMP    NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at        TIMESTAMP    NULL DEFAULT NULL,
    PRIMARY KEY (student_matricule, group_code, school_year),
    CONSTRAINT fk_sg_student_matricule FOREIGN KEY (student_matricule) REFERENCES students (matricule) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_sg_group_code_school_year FOREIGN KEY (group_code, school_year) REFERENCES `groups` (code, school_year) ON DELETE CASCADE ON UPDATE CASCADE
);



CREATE TABLE IF NOT EXISTS attendances
(
    id                BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    session_id        BIGINT UNSIGNED NOT NULL,
    student_matricule VARCHAR(100)    NOT NULL,
    is_present        BOOLEAN         NOT NULL DEFAULT FALSE,
    checked_at        DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    note              TEXT            NULL,
    created_at        TIMESTAMP       NULL     DEFAULT CURRENT_TIMESTAMP,
    updated_at        TIMESTAMP       NULL     DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at        TIMESTAMP       NULL     DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE uq_attendances_session_student (session_id, student_matricule),
    CONSTRAINT fk_attendances_session FOREIGN KEY (session_id) REFERENCES sessions (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_attendances_student FOREIGN KEY (student_matricule) REFERENCES students (matricule) ON DELETE CASCADE ON UPDATE CASCADE
);
