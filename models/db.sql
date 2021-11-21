CREATE TABLE information(
    id_information SERIAL PRIMARY KEY,
    title_information VARCHAR(255),
    description_information TEXT,
    link_video TEXT,
    step_information TEXT,
    tools_materials TEXT[]
);

ALTER TABLE information 
    ADD COLUMN image_information VARCHAR;

ALTER TABLE information 
    ADD COLUMN coin_information INTEGER;

CREATE TABLE users(
    id SERIAL PRIMARY KEY,
    email_user VARCHAR(191) NOT NULL,
    name_user VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);