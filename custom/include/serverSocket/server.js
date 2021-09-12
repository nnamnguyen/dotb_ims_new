//handle event from js
var fs = require('fs');
var express = require('express');
var app = new express();
var options = {
    key: fs.readFileSync('ssl/key.key'),
    cert: fs.readFileSync('ssl/cert.crt'),
    requestCert: true,
    rejectUnauthorized: false
};
var server = require('https').createServer(options, app);
server.listen(9201);
var io = require('socket.io').listen(server);
io.sockets.on('connection', function (socket) {
    socket.emit('connected', 'connected');
    socket.on('login', function (data) {
        data = JSON.parse(data);
        socket.join(data.user_id);
        console.log('connect to user: ' + data.user_id);
    });
});

//handle event from php
var iophp = require('socket.io').listen(9100);
iophp.sockets.on('connection', function (socket) {
    var request = socket.handshake.query;
    if (request.is_php_client) {
        var message = JSON.parse(request.message);
        io.sockets.to(message.receiver).emit('message', JSON.stringify(message.data));
        console.log(message);
    }
});

console.log("Server socket is running on port 9201");