// client/screens/ReceiverScreen.js
import React, { useState } from 'react';
import { View, TextInput, Button, FlatList, Text, StyleSheet } from 'react-native';

export default function ReceiverScreen() {
  const [recipient, setRecipient] = useState('');
  const [messages, setMessages] = useState([]);

  const handleRetrieve = async () => {
    try {
      const response = await fetch(`http://your-server/retrieveMessages.php?recipient=${recipient}`);
      const result = await response.json();
      setMessages(result.messages || []);
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <View style={styles.container}>
      <Text>Retrieve Messages</Text>
      <TextInput
        style={styles.input}
        placeholder="Your Name"
        value={recipient}
        onChangeText={setRecipient}
      />
      <Button title="Retrieve Messages" onPress={handleRetrieve} />
      
      <FlatList
        data={messages}
        keyExtractor={(item, index) => index.toString()}
        renderItem={({ item }) => (
          <View style={styles.message}>
            <Text style={styles.sender}>From: {item.sender}</Text>
            <Text>{item.message}</Text>
          </View>
        )}
      />
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
  message: {
    padding: 10,
    borderBottomWidth: 1,
    borderBottomColor: '#eee',
  },
  sender: {
    fontWeight: 'bold',
  },
});