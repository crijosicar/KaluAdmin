SELECT * FROM admin_kalu.users;
      
SELECT con.mensaje AS text, con.fecha_creacion AS createdAt, user.email AS usuario_email, 
 user.name AS nombre, user.id userID 
 FROM conversaciones AS con
INNER JOIN users AS user ON (con.user_id = user.id)