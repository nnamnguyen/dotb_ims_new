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
//port số lẻ, là port trong config
server.listen(9211);
var io = require('socket.io').listen(server);
io.sockets.on('connection', function (socket) {
    socket.on('login', function (data) {
        data = JSON.parse(data);
        socket.join(data.user_id);
        io.sockets.emit('login', JSON.stringify({message: 'login callcenter server success!'}));
    });
});

//handle event from php
//port số chẵn
var iophp = require('socket.io').listen(9210);
iophp.sockets.on('connection', function (socket) {
    var request = socket.handshake.query;
    if (request.is_php_client) {
        var message = JSON.parse(request.message);
        if (message.message === 'connected') {
            io.sockets.broadcast.emit('connected', JSON.stringify(message.data));
        }else if (message.message === 'hangup') {
            io.sockets.broadcast.emit('hangup', JSON.stringify(message.data));
        }else if (message.message === 'comming') {
            io.sockets.broadcast.emit('comming', JSON.stringify(message.data));
        }
    }
});
