const express = require("express");
// bodyParser is used to parse the JSON data means make it readable by JS
const bodyParser = require("body-parser");
// import your custom connection
const db = require("./db"); // Import database connection

const app = express();
// initialize bodyParser middleware make it used by our main app
app.use(bodyParser.json()); // To parse JSON requests

app.post("/students", (req, res) => {
    //  /request is your routing whenever you want to insert data you will navigate to /student route
    // in your postman if you want to insert data you will type this: http://localhost:5000/students for adding data
  const { name, age } = req.body;
//   here name ans age is your current data you want to insert
// req.body means it will be inserted throught the body
  db.query("INSERT INTO students (name, age) VALUES (?, ?)", [name, age], (err) => {
    // this is sql query string where you pass your current data in array  and err callback which checks if there is no error 
    if (err) return res.status(500).json({ error: err.message });
    // if there is error occured return res.status() this .status() is used when you want to add status code 
    // here status code is 500 means the server crashes or internal server error
    // .json() this methood help to return data in form of json
    // error: err.message; error is variable(object) created and it assigned to our current error this helps when you're debugging
    res.status(201).json({ message: "Student added successfully" });
    // if there is no failure we'll get this message 
    // 201 status code which means created means the new student created
  });
});


app.listen(5000, () => {
  console.log("Server is running on port http://localhost:5000");
});
