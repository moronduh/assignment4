# Messenger4
messenger
# assignment4
Miranda Johnson 
Basic Messaging App
# Messenger App

## Team Members
Miranda Johnson

## App Description
A simple messenger application that allows users to send and receive messages. The app consists of:
- React Native front-end with two screens
- PHP backend with two APIs
- Optional MySQL database integration

## Features
- Send messages to other users
- Retrieve messages sent to you
- Simple and intuitive interface

## Front-end Screenshots
![Sender Screen](screenshots/sender.png)
![Receiver Screen](screenshots/receiver.png)

## Server API Documentation

### 1. Send Message
**Endpoint:** `/sendMessage.php`  
**Method:** POST  
**Content-Type:** application/json  
**Request Body:**
```json
{
    "sender": "username1",
    "recipient": "username2",
    "message": "Hello there!"
}
