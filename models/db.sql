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