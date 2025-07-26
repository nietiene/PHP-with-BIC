import mysql from 'mysql2';

const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "level4",
});

db.connect((err) => {
  if (err) {
    console.error("Database connection failed:", err);
    return;
  }
  console.log("Connected to MySQL");
});

export default db;
