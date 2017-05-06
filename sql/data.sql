INSERT INTO brand (id, name) VALUES
(1, 'Ford'),
(2, 'Hyundai'),
(3, 'Skoda');

INSERT INTO model (id, brand_id, name) VALUES
(1, 1,'Fiesta'),
(2, 1, 'Focus'),
(3, 2, 'Solaris'),
(4, 2, 'i30'),
(5, 3, 'Octavia');

INSERT INTO office (id, name) VALUES
(1, 'Точка_1'),
(2, 'Точка_2'),
(3, 'Точка_3');

INSERT INTO car (id, model_id, number) VALUES
(1, 1, 'А001АА159'),
(2, 2, 'А002АА159'),
(3, 3, 'А003АА159'),
(4, 4, 'А004АА159'),
(5, 5, 'А004АА159');

INSERT INTO customer (id, last_name, first_name, middle_name, phone) VALUES
(1, 'Иванов', 'Иван', 'Иванович', '89001112201'),
(2, 'Петров', 'Петр', 'Петрович', '89001112202'),
(3, 'Сидоров', 'Иван', 'Петрович', '89001112203');

INSERT INTO orders (id, office_id, client_id, car_id, start_at, end_at) VALUES
(1, 1, 1, 1, '2017-04-24 10:00', '2017-04-28 10:00'),
(2, 1, 1, 3, '2017-04-24 10:00', '2017-05-05 10:00'),
(3, 1, 1, 2, '2017-05-01 10:00', '2017-05-05 10:00');
