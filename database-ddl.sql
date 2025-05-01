CREATE TABLE users(
    id SERIAL NOT NULL,
    username varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    phone varchar(20),
    email_verified_at timestamp without time zone,
    password varchar(255) NOT NULL,
    remember_token varchar(100),
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone,
    role varchar(255) NOT NULL DEFAULT 'user'::character varying,
    PRIMARY KEY(id),
    CONSTRAINT users_role_check CHECK (((role)::text = ANY ((ARRAY['admin'::character varying, 'user'::character varying])::text[])))
);
CREATE UNIQUE INDEX users_email_unique ON public.users USING btree (email);
CREATE UNIQUE INDEX users_phone_unique ON public.users USING btree (phone);

CREATE TABLE students(
    id SERIAL NOT NULL,
    user_id bigint NOT NULL,
    "NIS" varchar(20),
    name varchar(100),
    gender varchar(255),
    school_origin varchar(100),
    school_type varchar(255),
    school_major varchar(100),
    graduation_year integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone,
    PRIMARY KEY(id),
    CONSTRAINT students_user_id_foreign FOREIGN key(user_id) REFERENCES users(id),
    CONSTRAINT students_gender_check CHECK (((gender)::text = ANY ((ARRAY['man'::character varying, 'woman'::character varying])::text[]))),
    CONSTRAINT students_school_type_check CHECK (((school_type)::text = ANY ((ARRAY['high_school'::character varying, 'vocational_school'::character varying])::text[])))
);
CREATE INDEX students_name_index ON public.students USING btree (name);
CREATE INDEX students_school_type_index ON public.students USING btree (school_type);
CREATE INDEX students_graduation_year_index ON public.students USING btree (graduation_year);
CREATE UNIQUE INDEX students_user_id_unique ON public.students USING btree (user_id);
CREATE UNIQUE INDEX students_nis_unique ON public.students USING btree ("NIS");

CREATE TABLE criterias(
    id SERIAL NOT NULL,
    name varchar(100) NOT NULL,
    description text,
    weight numeric(5,2) NOT NULL,
    "type" varchar(255) NOT NULL,
    school_type varchar(255) NOT NULL,
    is_active boolean NOT NULL DEFAULT true,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone,
    PRIMARY KEY(id),
    CONSTRAINT criterias_type_check CHECK (((type)::text = ANY ((ARRAY['benefit'::character varying, 'cost'::character varying])::text[]))),
    CONSTRAINT criterias_school_type_check CHECK (((school_type)::text = ANY ((ARRAY['SMA'::character varying, 'SMK'::character varying, 'All'::character varying])::text[])))
);

CREATE TABLE college_majors(
    id SERIAL NOT NULL,
    major_name varchar(100) NOT NULL,
    faculty varchar(100),
    description text,
    field_of_study varchar(100),
    career_prospects text,
    is_active boolean NOT NULL DEFAULT true,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone,
    PRIMARY KEY(id)
);

CREATE TABLE student_scores(
    id SERIAL NOT NULL,
    student_id bigint NOT NULL,
    criteria_id bigint NOT NULL,
    score numeric(5,2) NOT NULL,
    input_date timestamp without time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone,
    PRIMARY KEY(id),
    CONSTRAINT student_scores_student_id_foreign FOREIGN key(student_id) REFERENCES students(id),
    CONSTRAINT student_scores_criteria_id_foreign FOREIGN key(criteria_id) REFERENCES criterias(id)
);
CREATE UNIQUE INDEX student_scores_student_id_criteria_id_unique ON public.student_scores USING btree (student_id, criteria_id);

CREATE TABLE major_characteristics(
    id SERIAL NOT NULL,
    college_major_id bigint NOT NULL,
    criteria_id bigint NOT NULL,
    compatibility_weight numeric(5,2) NOT NULL,
    minimum_score numeric(5,2),
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone,
    PRIMARY KEY(id),
    CONSTRAINT major_characteristics_college_major_id_foreign FOREIGN key(college_major_id) REFERENCES college_majors(id),
    CONSTRAINT major_characteristics_criteria_id_foreign FOREIGN key(criteria_id) REFERENCES criterias(id),
    CONSTRAINT check_compatibility_weight CHECK (((compatibility_weight >= (0)::numeric) AND (compatibility_weight <= (1)::numeric))),
    CONSTRAINT check_minimum_score CHECK (((minimum_score IS NULL) OR ((minimum_score >= (0)::numeric) AND (minimum_score <= (100)::numeric))))
);
CREATE UNIQUE INDEX major_characteristics_college_major_id_criteria_id_unique ON public.major_characteristics USING btree (college_major_id, criteria_id);

CREATE TABLE saw_results(
    id SERIAL NOT NULL,
    student_id bigint NOT NULL,
    college_major_id bigint NOT NULL,
    final_score numeric(10,4) NOT NULL,
    rank integer,
    recommendation_reason text,
    calculation_date timestamp without time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone,
    PRIMARY KEY(id),
    CONSTRAINT saw_results_student_id_foreign FOREIGN key(student_id) REFERENCES students(id),
    CONSTRAINT saw_results_college_major_id_foreign FOREIGN key(college_major_id) REFERENCES college_majors(id)
);
CREATE UNIQUE INDEX saw_results_student_id_college_major_id_unique ON public.saw_results USING btree (student_id, college_major_id);