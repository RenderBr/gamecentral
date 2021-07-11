/**
 * @file app.js
 * @description An example how to use MySQL in your Discord bot
 * @author HalloSouf
 * @version 1.0.0
 */

// Require all needed packages and files
const { Client, MessageEmbed } = require('discord.js');
const { createConnection } = require('mysql');
const config = require('./config.json');

const client = new Client();

// Prepare the mysql connection
let con = createConnection(config.mysql);

// Then we are going to connect to our MySQL database and we will test this on errors
con.connect(err => {
    // Console log if there is an error
    if (err) return console.log(err);

    // No error found?
    console.log(`MySQL has been connected!`);
});

// Ready event
client.on('ready', () => {
    // Log when bot is ready
    console.log(`${client.user.tag} is online!`);
});

// Message event
client.on('message', message => {

	let user = message.member.user.tag;
	let args = message.content.slice(prefix.length).trim().split(/ +/g);
	let prefix = "!";
	let command = args.shift().toLowerCase();
	
    // Execute SELECT query
    // This is an example how I designed my "settings" table. My readme.md file includes a screen with an example.
    con.query(`SELECT * FROM verifyCodes WHERE user = '` + user + `' AND verificationCode = `, (err, row) => {


        if (!message.content.startsWith(prefix)) return;
        message.channel.send(`The client ping is ` + command);


    });

});

// Login into your bot with the bot token
client.login(config.client.token);