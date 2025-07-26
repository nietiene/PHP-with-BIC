const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");
const db = require("./db"); // Import database connection

const app = express();
app.use(cors());
app.use(bodyParser.json()); // To parse JSON requests

app.post("/students", (req, res) => {
  const { name, age } = req.body;
  db.query("INSERT INTO students (name, age) VALUES (?, ?)", [name, age], (err, result) => {
    if (err) return res.status(500).json({ error: err.message });
    res.status(201).json({ message: "Student added successfully", id: result.insertId });
  });
});

app.get("/students", (req, res) => {
  db.query("SELECT * FROM students", (err, results) => {
    if (err) return res.status(500).json({ error: err.message });
    res.json(results);
  });
});

app.put("/students/:id", (req, res) => {
  const { name, age } = req.body;
  const { id } = req.params;
  db.query("UPDATE students SET name=?, age=? WHERE id=?", [name, age, id], (err, result) => {
    if (err) return res.status(500).json({ error: err.message });
    res.json({ message: "Student updated successfully" });
  });
});

app.delete("/students/:id", (req, res) => {
  const { id } = req.params;
  db.query("DELETE FROM students WHERE id=?", [id], (err, result) => {
    if (err) return res.status(500).json({ error: err.message });
    res.json({ message: "Student deleted successfully" });
  });
});

app.listen(5000, () => {
  console.log("Server is running on port 5000");
});
