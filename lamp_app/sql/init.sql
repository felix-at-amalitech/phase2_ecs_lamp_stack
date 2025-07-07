CREATE DATABASE IF NOT EXISTS fruits_db;
USE fruits_db;
CREATE TABLE fruits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    season VARCHAR(50) NOT NULL,
    nutritional_info TEXT NOT NULL,
    color VARCHAR(20) NOT NULL
);
INSERT INTO fruits (name, season, nutritional_info, color) VALUES
    ('Mango', 'March-May', 'Rich in Vitamin C and antioxidants', '#FFA500'),
    ('Pineapple', 'Year-round', 'High in fiber and Vitamin B6', '#FFD700'),
    ('Pawpaw (Papaya)', 'Year-round', 'Supports digestion with papain enzyme', '#FF6347'),
    ('Banana', 'Year-round', 'High in potassium and natural sugars', '#FFFF00'),
    ('Orange', 'November-March', 'Excellent source of Vitamin C and folate', '#FF8C00'),
    ('Coconut', 'Year-round', 'Rich in healthy fats and electrolytes', '#8B4513'),
    ('Watermelon', 'March-July', 'High water content and lycopene', '#FF1493'),
    ('Avocado', 'June-September', 'Healthy monounsaturated fats and fiber', '#228B22'),
    ('Guava', 'August-December', 'Very high in Vitamin C and antioxidants', '#FFB6C1'),
    ('Cashew Fruit', 'February-May', 'Rich in Vitamin C and natural sugars', '#DC143C'),
    ('Star Apple', 'December-April', 'Contains Vitamin C and dietary fiber', '#9370DB'),
    ('Soursop', 'June-September', 'High in Vitamin C and natural compounds', '#90EE90'),
    ('African Star Apple', 'October-February', 'Rich in Vitamin C and natural antioxidants', '#8A2BE2');
  