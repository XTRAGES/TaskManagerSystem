const express = require('express');
const cors = require('cors');
const jwt = require('jsonwebtoken');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

app.use(cors());
app.use(bodyParser.json());

const secretKey = 'your-secret-key'; // Replace with a strong, random key

// In-memory task storage (replace with a database in a real application)
let tasks = [];

// Middleware to verify JWT token
function verifyToken(req, res, next) {
  const authHeader = req.headers.authorization;

  if (authHeader) {
    const token = authHeader.split(' ')[1];

    jwt.verify(token, secretKey, (err, user) => {
      if (err) {
        return res.sendStatus(403); // Forbidden
      }

      req.user = user;
      next();
    });
  } else {
    res.sendStatus(401); // Unauthorized
  }
}

// Login route
app.post('/login', (req, res) => {
  const { username, password } = req.body;

  // Replace with actual authentication logic (e.g., check against a database)
  if (username === 'admin' && password === 'password') {
    const user = { username: 'admin' };
    const token = jwt.sign(user, secretKey);

    res.json({ token });
  } else {
    res.sendStatus(401); // Unauthorized
  }
});

// Get tasks route (protected)
app.get('/tasks', verifyToken, (req, res) => {
  res.json(tasks);
});

// Create task route (protected)
app.post('/tasks', verifyToken, (req, res) => {
  const task = req.body;
  tasks.push(task);
  res.sendStatus(201); // Created
});

// Delete task route (protected)
app.delete('/tasks/:id', verifyToken, (req, res) => {
  const id = req.params.id;
  tasks = tasks.filter((task, index) => index !== parseInt(id));
  res.sendStatus(204); // No Content
});

app.listen(port, () => {
  console.log(`Server listening at http://localhost:${port}`);
});
