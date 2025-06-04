// client/screens/SenderScreen.js
import React, { useState } from 'react';
import { View, TextInput, Button, Alert, StyleSheet, Text } from 'react-native';

export default function SenderScreen() {
  const [sender, setSender] = useState('');
  const [recipient, setRecipient] = useState('');
  const [message, setMessage] = useState('');

  const handleSend = async () => {
    try {
      const response = await fetch('http://your-server/sendMessage.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          sender,
          recipient,
          message,
        }),
      });
      const result = await response.json();
      Alert.alert('Success', 'Message sent successfully');
      setMessage('');
    } catch (error) {
      Alert.alert('Error', 'Failed to send message');
    }
  };

  return (
    <View style={styles.container}>
      <Text>Send a Message</Text>
      <TextInput
        style={styles.input}
        placeholder="Your Name"
        value={sender}
        onChangeText={setSender}
      />
      <TextInput
        style={styles.input}
        placeholder="Recipient"
        value={recipient}
        onChangeText={setRecipient}
      />
      <TextInput
        style={[styles.input, styles.messageInput]}
        placeholder="Your Message"
        value={message}
        onChangeText={setMessage}
        multiline
      />
      <Button title="Send Message" onPress={handleSend} />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 20,
  },
  input: {
    borderWidth: 1,
    borderColor: '#ccc',
    padding: 10,
    marginBottom: 10,
    borderRadius: 5,
  },
  messageInput: {
    height: 100,
  },
});