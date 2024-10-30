-- Insertar usuarios
INSERT INTO `users` (`id`, `fullName`, `email`, `phone`, `avatar`, `address`, `role`, `birthday`, `favourites`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `restaurant_id`) VALUES
(1, 'Pepe', 'Pepe@gmail.com', '621862453', NULL, 'Calle de Colón, 1, 46004 Valencia', 'client', '1999-05-14', NULL, NULL, '$2y$10$ipH/MwmL1A1BCap1spW7RukqCtf5UY95xDSMMJqGo3jZUCsGBHIti', NULL, '2024-06-01 12:22:14', '2024-06-01 12:22:14', NULL),
(2, 'Josefa', 'Josefa@gmail.com', '617934256', NULL, 'Avenida del Puerto, 34, 46021 Valencia', 'deliveryman', '1989-12-12', NULL, NULL, '$2y$10$ZnXOTmy40S40hzV6KO7SoONx8ZA40r9PnqBYgkfZjd4AWCxt0q/ki', NULL, '2024-06-01 12:23:52', '2024-06-01 12:23:52', NULL),
(3, 'Roberto', 'Roberto@gmail.com', '694892312', NULL, 'Calle de la Paz, 23, 46003 Valencia', 'client', '2002-01-07', NULL, NULL, '$2y$10$BKUodyhaloxarjvw5Pvz7Ot.0P3Nro6jVJfjTvUXmX2ynH4Qik8TC', NULL, '2024-06-01 12:25:28', '2024-06-01 12:25:28', NULL),
(4, 'Ana', 'Ana@gmail.com', '617984356', NULL, 'Plaza del Ayuntamiento, 7, 46002 Valencia', 'deliveryman', '2004-02-21', NULL, NULL, '$2y$10$BRUnt2uWw04.z0CyzFwfgujsDV94fWo0beQmzzBYZ8oo3PMYtZhJC', NULL, '2024-06-01 12:28:13', '2024-06-01 12:28:13', NULL),
(5, 'Joselito', 'Joselito@gmail.com', '678243191', NULL, 'Calle de Xàtiva, 5, 46002 Valencia', 'client', '2000-09-14', NULL, NULL, '$2y$10$cwsWgpzY/HmO3sjfzLZxhO/u2W8rK9TQ/ZvR6UeLKtHNS2JQkW2Mq', NULL, '2024-06-01 12:31:54', '2024-06-01 12:31:54', NULL),
(6, 'Carlos Miguel', 'kcarlos2003@gmail.com', '694572834', NULL, 'Avenida de Blasco Ibáñez, 13, 46010 Valencia', 'admin', '2003-08-26', NULL, NULL, '$2y$10$C/elNJjWtfoSXUEpqmS.cOnqqxjFrI8SRo0yusXWV5yvTm/W3k356', NULL, '2024-06-01 12:35:38', '2024-06-01 12:35:38', NULL),
(7, 'Jose\'s Restaurant', 'JosesRest@gmail.com', '682567123', NULL, 'Calle de Don Juan de Austria, 20, 460', 'restaurant', '2021-08-11', NULL, NULL, '$2y$10$mwsDskQVgIQSkxvME.XBSOqBzbEXieqLPTQ9LgovKbFk09ZQUV/HW', NULL, '2024-06-01 12:46:07', '2024-06-01 12:46:07', NULL);

-- Insertar restaurantes de kebabs
INSERT INTO restaurants (name, email, phone, address, image, schedule, has_discount, tags, description, created_at, updated_at) VALUES
('Kebab King',  'kebabking@example.com', '1234567891', 'Calle de Colón, 10, 46004 Valencia', null, '10:00-22:00', false, 'Kebab,Turkish', 'Best kebabs in town.', NOW(), NOW()),
('Istanbul Grill', 'istanbulgrill@example.com', '2345678901', 'Avenida del Puerto, 15, 46021 Valencia', null, '09:00-21:00', true, 'Kebab,Turkish', 'Authentic Turkish kebabs.', NOW(), NOW()),
('Mediterranean Delight','mediterraneandelight@example.com', '3456789012', 'Calle de la Paz, 14, 46003 Valencia', null, '08:00-20:00', false, 'Kebab,Mediterranean', 'Mediterranean style kebabs.', NOW(), NOW()),
('Kebab Palace',  'kebabpalace@example.com', '4567890123', 'Plaza del Ayuntamiento, 3, 46002 Valencia', null, '10:00-23:00', true, 'Kebab,Middle Eastern', 'Royal kebabs for everyone.', NOW(), NOW()),
('The Kebab House',  'thekebabhouse@example.com', '5678901234', 'Calle de Xàtiva, 2, 46002 Valencia', null, '11:00-22:00', false, 'Kebab,Greek', 'Delicious Greek kebabs.', NOW(), NOW()),
('Sultans Kebab', 'sultanskebab@example.com', '6789012345', 'Avenida de Blasco Ibáñez, 22, 46010 Valencia', null, '10:00-22:00', true, 'Kebab,Turkish', 'Sultans favorite kebabs.', NOW(), NOW()),
('Kebab Express', 'kebabexpress@example.com', '7890123456', 'Calle de Don Juan de Austria, 10, 46002 Valencia', null, '09:00-21:00', false, 'Kebab,Fast Food', 'Quick and tasty kebabs.', NOW(), NOW()),
('Oriental Kebab', 'orientalkebab@example.com', '8901234567', 'Gran Vía del Marqués del Turia, 12, 46005 Valencia', null, '11:00-23:00', true, 'Kebab,Asian', 'Oriental style kebabs.', NOW(), NOW()),
('Kebab Bistro', 'kebabistro@example.com', '9012345678', 'Avenida de Francia, 25, 46023 Valencia', null, '10:00-22:00', false, 'Kebab,Modern', 'Modern take on traditional kebabs.', NOW(), NOW()),
('Kebab Heaven', 'kebabheaven@example.com', '0123456789', 'Calle de la Reina, 100, 46011 Valencia', null, '12:00-21:00', true, 'Kebab,Gourmet', 'Heavenly gourmet kebabs.', NOW(), NOW());

-- Insertar platos para los restaurantes de kebabs
INSERT INTO dishes (restaurant_id, name, price, discount, description, image, ingredients, created_at, updated_at) VALUES
(1, 'Special Kebab', 9.50, 0.00, 'A special kebab with a unique blend of spices.', null, 'Lamb, Onion, Tomato, Lettuce', NOW(), NOW()),
(1, 'Chicken Durum', 8.00, 0.00, 'Deliciously marinated chicken durum.', null, 'Chicken, Garlic Sauce, Pickles', NOW(), NOW()),
(1, 'Falafel Wrap', 7.50, 0.00, 'Crispy falafel wrapped in fresh pita.', null, 'Falafel, Hummus, Salad', NOW(), NOW()),
(1, 'Lamb Doner', 10.50, 0.00, 'Juicy and flavorful lamb doner kebab.', null, 'Lamb, Onion, Tomato, Lettuce', NOW(), NOW()),
(1, 'Mixed Grill', 13.00, 0.00, 'A mix of all our favorite grilled meats.', null, 'Lamb, Chicken, Beef, Spices', NOW(), NOW()),
(2, 'Beef Kebab', 9.00, 0.10, 'Succulent beef kebab with a side of salad.', null, 'Beef, Salad, Garlic Sauce', NOW(), NOW()),
(2, 'Vegetarian Kebab', 7.00, 0.10, 'Healthy and tasty vegetarian kebab.', null, 'Grilled Vegetables, Hummus, Pita', NOW(), NOW()),
(2, 'Spicy Chicken Kebab', 8.50, 0.10, 'Spicy chicken kebab for those who love heat.', null, 'Chicken, Chili Sauce, Onion', NOW(), NOW()),
(2, 'Lamb Kofta', 9.75, 0.10, 'Lamb kofta with aromatic herbs.', null, 'Lamb, Herbs, Spices', NOW(), NOW()),
(2, 'Kebab Platter', 12.00, 0.10, 'A platter of assorted kebabs.', null, 'Lamb, Chicken, Beef, Salad', NOW(), NOW()),
(3, 'Grilled Chicken Kebab', 8.50, 0.00, 'Tender grilled chicken kebab.', null, 'Chicken, Garlic Sauce, Lettuce', NOW(), NOW()),
(3, 'Kebab Roll', 7.00, 0.00, 'Tasty kebab roll with fresh ingredients.', null, 'Beef, Tomato, Onion, Pita', NOW(), NOW()),
(3, 'Falafel Platter', 8.25, 0.00, 'Falafel served with hummus and pita.', null, 'Falafel, Hummus, Pita', NOW(), NOW()),
(3, 'Shawarma Wrap', 8.75, 0.00, 'Classic shawarma wrap with tahini sauce.', null, 'Chicken, Tahini, Tomato, Pita', NOW(), NOW()),
(3, 'Lamb Gyro', 9.50, 0.00, 'Savory lamb gyro with tzatziki sauce.', null, 'Lamb, Tzatziki, Onion', NOW(), NOW()),
(4, 'Royal Kebab', 10.00, 0.15, 'A kebab fit for a king.', null, 'Lamb, Royal Spices, Lettuce', NOW(), NOW()),
(4, 'Chicken Souvlaki', 9.00, 0.15, 'Greek style chicken souvlaki.', null, 'Chicken, Tzatziki, Pita', NOW(), NOW()),
(4, 'Vegetarian Souvlaki', 8.00, 0.15, 'Delicious vegetarian souvlaki.', null, 'Grilled Vegetables, Tzatziki, Pita', NOW(), NOW()),
(4, 'Doner Box', 11.00, 0.15, 'Doner kebab served in a box with fries.', null, 'Lamb, Fries, Garlic Sauce', NOW(), NOW()),
(4, 'Kebab Salad', 7.50, 0.15, 'Fresh salad with kebab pieces.', null, 'Lettuce, Tomato, Cucumber, Lamb', NOW(), NOW()),
(5, 'Greek Kebab', 9.25, 0.00, 'Authentic Greek kebab with tzatziki.', null, 'Lamb, Tzatziki, Onion', NOW(), NOW()),
(5, 'Chicken Gyro', 8.75, 0.00, 'Chicken gyro with fresh vegetables.', null, 'Chicken, Tomato, Lettuce, Pita', NOW(), NOW()),
(5, 'Falafel Wrap', 7.50, 0.00, 'Crispy falafel wrap with hummus.', null, 'Falafel, Hummus, Salad', NOW(), NOW()),
(5, 'Lamb Kebab', 10.50, 0.00, 'Juicy lamb kebab with special sauce.', null, 'Lamb, Special Sauce, Lettuce', NOW(), NOW()),
(5, 'Kebab Combo', 12.00, 0.00, 'Combo of chicken and lamb kebabs.', null, 'Chicken, Lamb, Garlic Sauce, Salad', NOW(), NOW()),
(6, 'Sultans Special', 11.00, 0.20, 'The Sultan’s favorite kebab.', null, 'Lamb, Sultan’s Spices, Lettuce', NOW(), NOW()),
(6, 'Chicken Shawarma', 8.75, 0.20, 'Classic chicken shawarma wrap.', null, 'Chicken, Tahini, Onion', NOW(), NOW()),
(6, 'Vegetarian Shawarma', 7.75, 0.20, 'Healthy vegetarian shawarma.', null, 'Grilled Vegetables, Hummus, Pita', NOW(), NOW()),
(6, 'Lamb Doner', 10.25, 0.20, 'Traditional lamb doner kebab.', null, 'Lamb, Garlic Sauce, Lettuce', NOW(), NOW()),
(6, 'Kebab Feast', 13.50, 0.20, 'A feast of mixed kebabs and sides.', null, 'Lamb, Chicken, Beef, Salad', NOW(), NOW()),
(7, 'Express Kebab', 8.00, 0.00, 'Quick and delicious kebab.', null, 'Beef, Onion, Tomato, Lettuce', NOW(), NOW()),
(7, 'Chicken Kebab Wrap', 7.50, 0.00, 'Grilled chicken kebab wrap.', null, 'Chicken, Garlic Sauce, Pickles', NOW(), NOW()),
(7, 'Falafel Box', 7.25, 0.00, 'Falafel served with salad and sauce.', null, 'Falafel, Salad, Tahini', NOW(), NOW()),
(7, 'Beef Shawarma', 8.50, 0.00, 'Beef shawarma with a spicy twist.', null, 'Beef, Chili Sauce, Onion', NOW(), NOW()),
(7, 'Kebab Bowl', 9.75, 0.00, 'Kebab served in a bowl with rice.', null, 'Lamb, Rice, Salad', NOW(), NOW()),
(8, 'Oriental Kebab Platter', 10.50, 0.25, 'Oriental style kebab platter.', null, 'Lamb, Oriental Spices, Salad', NOW(), NOW()),
(8, 'Chicken Satay Kebab', 9.00, 0.25, 'Chicken kebab with satay sauce.', null, 'Chicken, Satay Sauce, Onion', NOW(), NOW()),
(8, 'Vegetable Satay', 8.00, 0.25, 'Grilled vegetables with satay sauce.', null, 'Vegetables, Satay Sauce, Pita', NOW(), NOW()),
(8, 'Lamb Skewers', 9.50, 0.25, 'Lamb skewers with oriental spices.', null, 'Lamb, Oriental Spices, Lettuce', NOW(), NOW()),
(8, 'Kebab and Rice', 10.00, 0.25, 'Kebab served with fragrant rice.', null, 'Chicken, Rice, Salad', NOW(), NOW()),
(9, 'Bistro Special', 11.50, 0.00, 'Special kebab with modern twist.', null, 'Beef, Modern Spices, Salad', NOW(), NOW()),
(9, 'Chicken Pita', 8.50, 0.00, 'Grilled chicken in pita bread.', null, 'Chicken, Tomato, Lettuce, Pita', NOW(), NOW()),
(9, 'Falafel Sandwich', 7.75, 0.00, 'Falafel sandwich with fresh vegetables.', null, 'Falafel, Hummus, Salad', NOW(), NOW()),
(9, 'Lamb Wrap', 10.00, 0.00, 'Lamb wrap with gourmet sauce.', null, 'Lamb, Gourmet Sauce, Onion', NOW(), NOW()),
(9, 'Kebab Mix', 13.00, 0.00, 'A mix of different kebabs.', null, 'Lamb, Chicken, Beef, Salad', NOW(), NOW()),
(10, 'Heavenly Kebab', 12.00, 0.30, 'Gourmet kebab that tastes heavenly.', null, 'Lamb, Gourmet Spices, Salad', NOW(), NOW()),
(10, 'Chicken Delight', 9.50, 0.30, 'Delicious chicken kebab with gourmet touch.', null, 'Chicken, Gourmet Sauce, Onion', NOW(), NOW()),
(10, 'Falafel Gourmet', 8.50, 0.30, 'Gourmet falafel with fresh ingredients.', null, 'Falafel, Hummus, Salad', NOW(), NOW()),
(10, 'Lamb Delight', 10.75, 0.30, 'Juicy lamb kebab with gourmet flavor.', null, 'Lamb, Gourmet Spices, Onion', NOW(), NOW()),
(10, 'Kebab Extravaganza', 14.00, 0.30, 'An extravagant mix of gourmet kebabs.', null, 'Lamb, Chicken, Beef, Salad', NOW(), NOW());

-- Insertar comentarios
INSERT INTO comments (commentText, user_id, restaurant_id, likes, created_at, updated_at) VALUES
('Delicious kebabs, highly recommended!', 1, 1, '10', NOW(), NOW()),
('The chicken shawarma is amazing!', 2, 1, '8', NOW(), NOW()),
('Best falafel wrap I have ever had.', 3, 1, '5', NOW(), NOW()),
('Great variety of kebabs and very tasty.', 4, 2, '12', NOW(), NOW()),
('The lamb doner is just perfect.', 5, 2, '9', NOW(), NOW()),
('Love the spicy chicken kebab!', 1, 2, '7', NOW(), NOW()),
('Very fresh and delicious.', 2, 3, '6', NOW(), NOW()),
('The beef kofta is excellent.', 3, 3, '4', NOW(), NOW()),
('Amazing service and great food.', 4, 3, '11', NOW(), NOW()),
('Best kebab place in town.', 5, 4, '13', NOW(), NOW()),
('Really enjoyed the lamb wrap.', 1, 4, '8', NOW(), NOW()),
('Fantastic flavors and great portions.', 2, 4, '10', NOW(), NOW()),
('The gourmet kebab is a must try.', 3, 5, '7', NOW(), NOW()),
('Sultans Special is worth every penny.', 4, 5, '9', NOW(), NOW()),
('Loved the lamb shawarma plate.', 5, 5, '5', NOW(), NOW());

INSERT INTO restaurant_user (user_id, restaurant_id, rating, created_at, updated_at)
SELECT u.user_id, r.restaurant_id, FLOOR(RAND() * 5) + 1 AS rating, NOW() AS created_at, NOW() AS updated_at
FROM (
    SELECT 1 AS user_id UNION ALL
    SELECT 2 UNION ALL
    SELECT 3 UNION ALL
    SELECT 4 UNION ALL
    SELECT 5 UNION ALL
    SELECT 6 UNION ALL
    SELECT 7
) AS u
CROSS JOIN (
    SELECT 1 AS restaurant_id UNION ALL
    SELECT 2 UNION ALL
    SELECT 3 UNION ALL
    SELECT 4 UNION ALL
    SELECT 5 UNION ALL
    SELECT 6 UNION ALL
    SELECT 7 UNION ALL
    SELECT 8 UNION ALL
    SELECT 9 UNION ALL
    SELECT 10
) AS r;


DELIMITER //

CREATE FUNCTION unaccent(text VARCHAR(255)) RETURNS VARCHAR(255)
BEGIN
    DECLARE output VARCHAR(255);
    SET output = text;
    SET output = REPLACE(output, 'Á', 'A');
    SET output = REPLACE(output, 'É', 'E');
    SET output = REPLACE(output, 'Í', 'I');
    SET output = REPLACE(output, 'Ó', 'O');
    SET output = REPLACE(output, 'Ú', 'U');
    SET output = REPLACE(output, 'á', 'a');
    SET output = REPLACE(output, 'é', 'e');
    SET output = REPLACE(output, 'í', 'i');
    SET output = REPLACE(output, 'ó', 'o');
    SET output = REPLACE(output, 'ú', 'u');
    SET output = REPLACE(output, 'Ñ', 'N');
    SET output = REPLACE(output, 'ñ', 'n');
    RETURN output;
END //

DELIMITER ;
