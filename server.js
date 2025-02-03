const express = require('express');
const bodyParser = require('body-parser');

const app = express();
const PORT = 3000;

app.use(bodyParser.json());

const USERNAME = 'testuser';
const PASSWORD = 'SecPw_1234!';

const authenticate = (req, res, next) => {
    const authHeader = req.headers.authorization;
    
    if (!authHeader || !authHeader.startsWith('Basic ')) {
        return res.status(401).json({ error: 'Unauthorized: Missing Basic Auth' });
    }

    const credentials = Buffer.from(authHeader.split(' ')[1], 'base64').toString('utf8');
    const [user, pass] = credentials.split(':');

    if (user === USERNAME && pass === PASSWORD) {
        next();
    } else {
        res.status(403).json({ error: 'Forbidden: Invalid Credentials' });
    }
};

app.post('/test', authenticate, (req, res) => {
    const { tool } = req.body;

    if (!tool) {
        return res.status(400).json({ error: 'Missing required field: tool' });
    }

    res.json([
            { id: 1, requestValue: tool },
            { id: 2, requestValue: tool },
            { id: 3, requestValue: tool },
        ]
    );
});

app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});
